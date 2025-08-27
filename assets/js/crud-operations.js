// crud-operations.js - CRUD Operations (Create, Read, Update, Delete)

$(function () {
  "use strict";

  // Delete user function
  window.delusersbtn = function (id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You are trying to delete this user.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Loading",
          html: "Please wait...",
          allowOutsideClick: false,
          didOpen: function () {
            Swal.showLoading();
          },
        });

        grecaptcha.execute(window.sitekey).then(function (token) {
          $.ajax({
            type: "POST",
            url: "/isds/includes/process.php",
            data: {
              del_user: true,
              users_id: id,
              "captcha-token": token,
            },
            dataType: "json",
            success: function (response) {
              setTimeout(function () {
                Swal.fire({
                  icon: response.status,
                  title: response.message,
                  showConfirmButton: false,
                  timer: 1000,
                }).then(function () {
                  if (response.redirect) {
                    window.location.href = response.redirect;
                  } else if (response.reload) {
                    window.location.reload(true);
                  }
                });
              }, 1000);
            },
          });
        });
      }
    });
  };

  // Reset user password function
  window.rstusersbtn = function (id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You are trying to reset the password of this user.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, reset",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Loading",
          html: "Please wait...",
          allowOutsideClick: false,
          didOpen: function () {
            Swal.showLoading();
          },
        });

        grecaptcha.execute(window.sitekey).then(function (token) {
          $.ajax({
            type: "POST",
            url: "/isds/includes/process.php",
            data: {
              reset_password: true,
              users_id: id,
              "captcha-token": token,
            },
            dataType: "json",
            success: function (response) {
              setTimeout(function () {
                Swal.fire({
                  icon: response.status,
                  title: response.message,
                  showConfirmButton: false,
                  timer: 1000,
                }).then(function () {
                  if (response.redirect) {
                    window.location.href = response.redirect;
                  } else if (response.reload) {
                    window.location.reload(true);
                  }
                });
              }, 1000);
            },
          });
        });
      }
    });
  };

  // Delete helpdesk function
  window.delhelpdesksbtn = function (id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You are trying to delete this item.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Loading",
          html: "Please wait...",
          allowOutsideClick: false,
          didOpen: function () {
            Swal.showLoading();
          },
        });

        grecaptcha.execute(window.sitekey).then(function (token) {
          $.ajax({
            type: "POST",
            url: "/isds/includes/process.php",
            data: {
              del_helpdesk: true,
              helpdesks_id: id,
              "captcha-token": token,
            },
            dataType: "json",
            success: function (response) {
              setTimeout(function () {
                Swal.fire({
                  icon: response.status,
                  title: response.message,
                  showConfirmButton: false,
                  timer: 1000,
                }).then(function () {
                  if (response.redirect) {
                    window.location.href = response.redirect;
                  } else if (response.reload) {
                    window.location.reload(true);
                  }
                });
              }, 1000);
            },
          });
        });
      }
    });
  };

  // Delete meeting function
  window.delmeetingsbtn = function (id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You are trying to delete this item.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Loading",
          html: "Please wait...",
          allowOutsideClick: false,
          didOpen: function () {
            Swal.showLoading();
          },
        });

        grecaptcha.execute(window.sitekey).then(function (token) {
          $.ajax({
            type: "POST",
            url: "/isds/includes/process.php",
            data: {
              del_meeting: true,
              meetings_id: id,
              "captcha-token": token,
            },
            dataType: "json",
            success: function (response) {
              setTimeout(function () {
                Swal.fire({
                  icon: response.status,
                  title: response.message,
                  showConfirmButton: false,
                  timer: 1000,
                }).then(function () {
                  if (response.redirect) {
                    window.location.href = response.redirect;
                  } else if (response.reload) {
                    window.location.reload(true);
                  }
                });
              }, 1000);
            },
          });
        });
      }
    });
  };

});