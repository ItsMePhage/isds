$(function () {

  ("use strict");

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim();
    if (all) {
      return $(el);
    } else {
      return $(el).first();
    }
  };

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      $(el).each(function () {
        $(this).on(type, listener);
      });
    } else {
      $(el).on(type, listener);
    }
  };

  /**
   * Easy on scroll event listener
   */
  const onscroll = (el, listener) => {
    $(el).on("scroll", listener);
  };

  /**
   * Sidebar toggle
   */
  on("click", ".toggle-sidebar-btn", function () {
    $("body").toggleClass("toggle-sidebar");
  });

  /**
   * Navbar links active state on scroll
   */
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

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
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

  /**
   * Back to top button
   */
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

  /**
   * Initiate tooltips
   */
  $('[data-bs-toggle="tooltip"]').tooltip();

  /**
   * Autoresize echart charts
   */
  const mainContainer = $("#main");
  if (mainContainer.length) {
    setTimeout(() => {
      new ResizeObserver(function () {
        $(".echart").each(function () {
          echarts.getInstanceByDom($(this)[0]).resize();
        });
      }).observe(mainContainer[0]);
    }, 200);
  }

  /**
   * Autohighlight aside navigations
   */
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

  /**
   * Loading overlay
   */

  new DataTable("#mock_data", {
    ajax: "includes/datatables.php?MOCK_DATA",
    processing: true,
    serverSide: true
  });

  grecaptcha.ready(function () {
    grecaptcha.execute(window.sitekey).then(function (token) {
      $(".captcha-token").val(token);
    });
  });

  $(".form-validation").on("submit", function (e) {
    e.preventDefault();

    Swal.fire({
      title: "Loading",
      html: "Please wait...",
      allowOutsideClick: false,
      didOpen: function () {
        Swal.showLoading();
      }
    });

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "/isds/includes/process.php",
      data: formData,
      dataType: "json",
      success: function (response) {
        setTimeout(function () {
          Swal.fire({
            icon: response.status,
            title: response.message,
            showConfirmButton: false,
            timer: 1000
          }).then(function () {
            if (response.redirect) {
              window.location.href = response.redirect;
            }
            if (response.reload) {
              window.reload();
            }
          });
        }, 1000);

        grecaptcha.ready(function () {
          grecaptcha.execute(window.sitekey).then(function (token) {
            $(".captcha-token").val(token);
          });
        });
      }
    });
  });

  /**
   * Logout button
   */
  $(".logout").on('click', function (e) {
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

  /**
    * Initiate select
    */
  $(".select-init").each(function (index, element) {
    let select_data = $(element).attr("id");

    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        select_data: select_data,
      },
      dataType: "json",
      success: function (response) {
        var len = response.length;
        for (var i = 0; i < len; i++) {
          var id = response[i]["id"];
          var name = response[i]["name"];
          $("#" + select_data).append(
            "<option value='" + id + "'>" + name + "</option>"
          );
        }
      },
    });
  });

  $('#request_type_id').on('change', function () {
    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        select_data: 'category_id',
        request_type_id: $(this).val()
      },
      dataType: "json",
      success: function (response) {
        var len = response.length;
        $('#category_id').empty();
        $('#sub_category_id').empty();
        $('#sub_category_id').append(
          "<option value='' selected disabled>choose...</option>"
        );
        for (var i = 0; i < len; i++) {
          var id = response[i]["id"];
          var name = response[i]["name"];
          $('#category_id').append(
            "<option value='" + id + "'>" + name + "</option>"
          );
        }
      },
    });
  });

  $('#category_id').on('change', function () {
    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        select_data: 'sub_category_id',
        category_id: $(this).val()
      },
      dataType: "json",
      success: function (response) {
        var len = response.length;
        $('#sub_category_id').empty();
        for (var i = 0; i < len; i++) {
          var id = response[i]["id"];
          var name = response[i]["name"];
          $('#sub_category_id').append(
            "<option value='" + id + "'>" + name + "</option>"
          );
        }
      },
    });
  });

  $('#time_start').on('change', function () {
    var timeStart = $(this).val();
    var timeEnd = $('#time_end').val();

    if (timeStart) {
      var startParts = timeStart.split(':');
      var startHours = parseInt(startParts[0], 10);
      var startMinutes = parseInt(startParts[1], 10);

      if (timeEnd) {
        var endParts = timeEnd.split(':');
        var endHours = parseInt(endParts[0], 10);
        var endMinutes = parseInt(endParts[1], 10);

        var startTotalMinutes = startHours * 60 + startMinutes;
        var endTotalMinutes = endHours * 60 + endMinutes;

        if (endTotalMinutes <= startTotalMinutes) {
          endHours = (startHours + 1) % 24;
          var newTimeEnd = ('0' + endHours).slice(-2) + ':' + ('0' + startMinutes).slice(-2);
          $('#time_end').val(newTimeEnd);
        }
      } else {
        var newEndHours = (startHours + 1) % 24;
        var newEndTime = ('0' + newEndHours).slice(-2) + ':' + ('0' + startMinutes).slice(-2);
        $('#time_end').val(newEndTime);
      }
    }
  });

  $('#time_end').on('change', function () {
    var timeStart = $('#time_start').val();
    var timeEnd = $(this).val();
    if (timeStart && timeEnd) {
      var startParts = timeStart.split(':');
      var endParts = timeEnd.split(':');

      var startHours = parseInt(startParts[0], 10);
      var startMinutes = parseInt(startParts[1], 10);

      var endHours = parseInt(endParts[0], 10);
      var endMinutes = parseInt(endParts[1], 10);

      var startTotalMinutes = startHours * 60 + startMinutes;
      var endTotalMinutes = endHours * 60 + endMinutes;

      if (startTotalMinutes > endTotalMinutes) {
        var newStartHours = (endHours - 1 + 24) % 24;

        var newTimeStart = ('0' + newStartHours).slice(-2) + ':' + ('0' + endMinutes).slice(-2);

        $('#time_start').val(newTimeStart);
      }
    }
  });
});

