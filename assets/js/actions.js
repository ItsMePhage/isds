const Actions = {
    confirmAction(title, text, confirmText, callback) {
      Swal.fire({
        title,
        text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: confirmText,
      }).then((result) => {
        if (result.isConfirmed) {
          Forms.showLoading();
          callback();
        }
      });
    },
  
    deleteUser(id) {
      this.confirmAction("Are you sure?", "You are trying to delete this user.", "Yes, delete", () => {
        grecaptcha.execute(window.sitekey).then((token) => {
          Utils.postData(
            "/isds/includes/process.php",
            { del_user: true, users_id: id, "captcha-token": token },
            Forms.showResponse
          );
        });
      });
    },
  
    resetUserPassword(id) {
      this.confirmAction("Are you sure?", "You are trying to reset the password of this user.", "Yes, reset", () => {
        grecaptcha.execute(window.sitekey).then((token) => {
          Utils.postData(
            "/isds/includes/process.php",
            { reset_password: true, users_id: id, "captcha-token": token },
            Forms.showResponse
          );
        });
      });
    },
  
    deleteHelpdesk(id) {
      this.confirmAction("Are you sure?", "You are trying to delete this item.", "Yes, delete", () => {
        grecaptcha.execute(window.sitekey).then((token) => {
          Utils.postData(
            "/isds/includes/process.php",
            { del_helpdesk: true, helpdesks_id: id, "captcha-token": token },
            Forms.showResponse
          );
        });
      });
    },
  
    deleteMeeting(id) {
      this.confirmAction("Are you sure?", "You are trying to delete this item.", "Yes, delete", () => {
        grecaptcha.execute(window.sitekey).then((token) => {
          Utils.postData(
            "/isds/includes/process.php",
            { del_meeting: true, meetings_id: id, "captcha-token": token },
            Forms.showResponse
          );
        });
      });
    },
  
    viewHelpdesk(id) {
      Utils.fetchData(
        "/isds/includes/fetch.php",
        { view_helpdesks: true, helpdesks_id: id },
        (response) => {
          $("#view_date_requested").val(response.date_requested);
          $("#view_requested_by_name").val(response.requested_by_name);
          // Populate other fields...
          $("#viewhelpdesksmodal").modal("show");
        }
      );
    },
  
    updateHelpdesk(id) {
      Utils.fetchData(
        "/isds/includes/fetch.php",
        { upd_helpdesk: true, helpdesks_id: id },
        (response) => {
          $("#upd_date_requested").val(response.date_requested);
          $("#upd_requested_by").val(response.requested_by);
          // Populate other fields...
          $("#updhelpdesksmodal").modal("show");
        }
      );
    },
  
    init() {
      window.delusersbtn = this.deleteUser.bind(this);
      window.rstusersbtn = this.resetUserPassword.bind(this);
      window.delhelpdesksbtn = this.deleteHelpdesk.bind(this);
      window.delmeetingsbtn = this.deleteMeeting.bind(this);
      window.viewhelpdesksbtn = this.viewHelpdesk.bind(this);
      window.updhelpdesksbtn = this.updateHelpdesk.bind(this);
      // Add updmeetingsbtn, updusersbtn similarly if needed...
    },
  };