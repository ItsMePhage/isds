// navigation.js - Navigation and UI Components

$(function () {
  "use strict";

  // Sidebar toggle
  on("click", ".toggle-sidebar-btn", function () {
    $("body").toggleClass("toggle-sidebar");
  });

  // Navbar active links
  let navbarlinks = $("#navbar .scrollto");
  const navbarlinksActive = () => {
    let position = $(window).scrollTop() + 200;
    navbarlinks.each(function () {
      let navbarlink = $(this);
      if (!navbarlink.attr("href")) return;
      let section = $(navbarlink.attr("href"));
      if (!section.length) return;
      if (
        position >= section.offset().top &&
        position <= section.offset().top + section.outerHeight()
      ) {
        navbarlink.addClass("active");
      } else {
        navbarlink.removeClass("active");
      }
    });
  };
  $(window).on("load", navbarlinksActive);
  onscroll(document, navbarlinksActive);

  // Header scroll effect
  let selectHeader = $("#header");
  if (selectHeader.length) {
    const headerScrolled = () => {
      if ($(window).scrollTop() > 100) {
        selectHeader.addClass("header-scrolled");
      } else {
        selectHeader.removeClass("header-scrolled");
      }
    };
    $(window).on("load", headerScrolled);
    onscroll(document, headerScrolled);
  }

  // Back to top button
  let backtotop = $(".back-to-top");
  if (backtotop.length) {
    const toggleBacktotop = () => {
      if ($(window).scrollTop() > 100) {
        backtotop.addClass("active");
      } else {
        backtotop.removeClass("active");
      }
    };
    $(window).on("load", toggleBacktotop);
    onscroll(document, toggleBacktotop);
  }

  // Initialize tooltips
  $('[data-bs-toggle="tooltip"]').tooltip();

  // Navigation active state based on current URL
  var currentUrl = window.location.href;
  var currentUrl = currentUrl.split("/").pop();

  $(".nav-link").each(function () {
    var linkUrl = $(this).attr("href");
    if (linkUrl == currentUrl) {
      $(this).removeClass("collapsed");
    } else {
      $(this).addClass("collapsed");
    }
  });

  $(".nav-content a").each(function () {
    var href = $(this).attr("href");
    if (href == currentUrl) {
      $(this).addClass("active");
      $(this).closest(".nav-content").addClass("show");
      $(this).closest(".nav-item").find(".nav-link").removeClass("collapsed");
    }
  });

  // Logout functionality
  $(".logout").on("click", function (e) {
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
        }).then(function () {
          window.location.href = "../includes/logout.php";
        });
      }
    });
  });
});