const Forms = {
  handleSubmit(e) {
    e.preventDefault();
    const form = $(e.target);
    grecaptcha.execute(window.sitekey).then((token) => {
      this.showLoading();
      const formData = form.serialize() + "&captcha-token=" + token;
      Utils.postData(
        "/isds/includes/process.php",
        formData,
        (response) => {
          setTimeout(() => {
            this.showResponse(response);
          }, 1000);
        }
      );
    });
  },

  showLoading() {
    Swal.fire({
      title: "Loading",
      html: "Please wait...",
      allowOutsideClick: false,
      didOpen: () => Swal.showLoading(),
    });
  },

  showResponse(response) {
    Swal.fire({
      icon: response.status,
      title: response.message,
      showConfirmButton: false,
      timer: 1000,
    }).then(() => {
      if (response.redirect) window.location.href = response.redirect;
      else if (response.reload) window.location.reload(true);
    });
  },

  init() {
    Utils.on("submit", ".form-validation", this.handleSubmit.bind(this));
  },
};