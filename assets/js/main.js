$(function () {
  "use strict";

  // Initialize all modules
  UI.init();
  DataTablesManager.init();
  Forms.init();
  Actions.init();
  Dropdowns.init();
  Charts.init();
  Print.init();
  Calendar.init();

  // Logout handler
  Utils.on("click", ".logout", (e) => {
    e.preventDefault();
    Swal.fire({
      title: "Are you sure?",
      text: "You will be logged out!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, logout",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          icon: "success",
          title: "See you again!",
          showConfirmButton: false,
          timer: 1000,
        }).then(() => {
          window.location.href = "../includes/logout.php";
        });
      }
    });
  });
});