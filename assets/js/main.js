$(function () {
  ("use strict");

  function generateHSLColors(count) {
    let colors = [];
    const hue = 221;
    const saturation = 50;

    for (let i = 0; i < count; i++) {
      let lightness = 20 + i * (50 / count);
      colors.push(`hsl(${hue}, ${saturation}%, ${lightness}%)`);
    }

    return colors;
  }

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

  // Initialize DataTables
  var helpdesks_table = new DataTable("#helpdesks_table", {
    ajax: "/isds/includes/datatables.php?helpdesks_table",
    processing: true,
    serverSide: true,
    scrollX: true,
  });

  var tbl_meetings = new DataTable("#tbl_meetings", {
    ajax: "/isds/includes/datatables.php?tbl_meetings",
    processing: true,
    serverSide: true,
    scrollX: true,
  });

  var admin_helpdesks_table = new DataTable("#admin_helpdesks_table", {
    ajax: "/isds/includes/datatables.php?admin_helpdesks_table",
    processing: true,
    serverSide: true,
    scrollX: true,
  });

  var tbl_meetings_a = new DataTable("#tbl_meetings_a", {
    ajax: "/isds/includes/datatables.php?tbl_meetings_a",
    processing: true,
    serverSide: true,
    scrollX: true,
  });

  var users_table = new DataTable("#users_table", {
    ajax: "/isds/includes/datatables.php?users_table",
    processing: true,
    serverSide: true,
    scrollX: true,
  });

  var tbl_request_types = new DataTable("#tbl_request_types", {
    ajax: "/isds/includes/datatables.php?tbl_request_types",
    processing: true,
    serverSide: true,
    scrollX: true,
    pageLength: 5,
    lengthChange: false,
  });

  var tbl_categories = new DataTable("#tbl_categories", {
    ajax: "/isds/includes/datatables.php?tbl_categories",
    processing: true,
    serverSide: true,
    scrollX: true,
    pageLength: 5,
    lengthChange: false,
  });

  var tbl_sub_categories = new DataTable("#tbl_sub_categories", {
    ajax: "/isds/includes/datatables.php?tbl_sub_categories",
    processing: true,
    serverSide: true,
    scrollX: true,
    pageLength: 5,
    lengthChange: false,
  });

  var csf_report_table = new DataTable("#csf_report_table", {
    layout: {
      topStart: {
        buttons: ['colvis', 'excel']
      }
    },
    ajax: "/isds/includes/datatables.php?csf_report_table",
    processing: true,
    serverSide: true,
    scrollX: true,

  });

  var helpdesks_report_table = new DataTable("#helpdesks_report_table", {
    layout: {
      topStart: {
        buttons: ['colvis', 'excel']
      }
    },
    ajax: "/isds/includes/datatables.php?helpdesks_report_table",
    processing: true,
    serverSide: true,
    scrollX: true,

  });

  var accomplishment_report_table = new DataTable("#accomplishment_report_table", {
    layout: {
      topStart: {
        buttons: [
          'colvis',
          'excel',
          {
            extend: 'pdfHtml5',
            text: 'PDF',
            orientation: 'landscape',
            pageSize: 'A4',
            title: 'ACCOMPLISHMENT REPORT AS OF _____________',
            exportOptions: {
              columns: ':visible' // Export only visible columns
            },
            customize: function (doc) {
              // Add custom quote after the table
              doc.content.push({
                text: "Prepared by:\n\n_________________________\n\n\nApproved by:\n\n_________________________",
                alignment: 'left',
                fontSize: 12,
                italics: true,
                margin: [0, 20, 0, 0] // Adds spacing before text
              });
            }
          }
        ]
      }
    },
    ajax: "/isds/includes/datatables.php?accomplishment_report_table",
    processing: true,
    serverSide: true,
    scrollX: true,

  });

  // Function to bind click events for filtering
  function bindFilterButton(buttonId, table, columnIdx, filterValue) {
    $(buttonId).on("click", function () {
      table.column(columnIdx).search(filterValue).draw();
    });
  }

  // Bind filter buttons for Helpdesks
  bindFilterButton("#u_admin", users_table, 5, "Admin");
  bindFilterButton("#u_vip", users_table, 5, "VIP");
  bindFilterButton("#u_employee", users_table, 5, "Employee");

  // Bind filter buttons for Helpdesks
  bindFilterButton("#h_open", helpdesks_table, 4, "Open");
  bindFilterButton("#h_pending", helpdesks_table, 4, "Pending");
  bindFilterButton("#h_completed", helpdesks_table, 4, "Completed");
  bindFilterButton("#h_prerepair", helpdesks_table, 4, "Pre-repair");

  // Bind filter buttons for Meetings
  bindFilterButton("#m_pending", tbl_meetings, 4, "Pending");
  bindFilterButton("#m_scheduled", tbl_meetings, 4, "Scheduled");
  bindFilterButton("#m_unavailable", tbl_meetings, 4, "Unavailable");
  bindFilterButton("#m_cancelled", tbl_meetings, 4, "Cancelled");

  // Bind filter buttons for Meetings
  bindFilterButton("#m_pending", tbl_meetings_a, 5, "Pending");
  bindFilterButton("#m_scheduled", tbl_meetings_a, 5, "Scheduled");
  bindFilterButton("#m_unavailable", tbl_meetings_a, 5, "Unavailable");
  bindFilterButton("#m_cancelled", tbl_meetings_a, 5, "Cancelled");

  grecaptcha.ready(function () {
    grecaptcha.execute(window.sitekey).then(function (token) {
      window.captchaToken = token;
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
      },
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
            timer: 1000,
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
      },
    });
  });

  /**
   * Logout button
   */
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


  // $(".generate-zoom").on("click", function (e) {
  //   e.preventDefault();

  //   Swal.fire({
  //     title: "Loading",
  //     html: "Please wait...",
  //     allowOutsideClick: false,
  //     didOpen: function () {
  //       Swal.showLoading();
  //     },
  //   });

  //   var topic = $("#upd_topic").val();
  //   var date_scheduled = $("#upd_date_scheduled").val();
  //   var time_start = $("#upd_time_start").val();
  //   var time_end = $("#upd_time_end").val();

  //   $.ajax({
  //     type: "POST",
  //     url: "/isds/includes/zoom/RO/create-meeting.php",
  //     data: {
  //       topic: topic,
  //       date_scheduled: date_scheduled,
  //       time_start: time_start,
  //       time_end: time_end,
  //     },
  //     dataType: "json",
  //     success: function (response) {
  //       setTimeout(function () {
  //         Swal.fire({
  //           icon: response.status,
  //           title: response.message,
  //           showConfirmButton: false,
  //           timer: 1000,
  //         }).then(function () {
  //           $("#upd_meeting_details").html(response.zoom_details);
  //         });
  //       }, 1000);
  //     },
  //   });
  // });

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
        if (select_data_val.length > 0) {
          for (var i = 0; i < len; i++) {
            var id = response[i]["id"];
            var name = response[i]["name"];
            $("#" + select_data).append(
              "<option value='" +
              id +
              "' " +
              (id == select_data_val[index] ? "selected" : "") +
              ">" +
              name +
              "</option>"
            );
          }
        } else {
          for (var i = 0; i < len; i++) {
            var id = response[i]["id"];
            var name = response[i]["name"];
            $("#" + select_data).append(
              "<option value='" + id + "'>" + name + "</option>"
            );
          }
        }
      },
    });
  });

  function updateOptions(url, data, categorySelector, subCategorySelector) {
    $.ajax({
      url: url,
      type: "GET",
      data: data,
      dataType: "json",
      success: function (response) {
        populateOptions(response, categorySelector, subCategorySelector);
      },
      error: function (xhr, status, error) {
        console.error(`Error: ${status} - ${error}`);
        alert("An error occurred while fetching data. Please try again.");
      },
    });
  }

  function populateOptions(response, categorySelector, subCategorySelector) {
    const len = response.length;
    $(categorySelector)
      .empty()
      .append("<option value='' selected disabled>choose...</option>");
    $(subCategorySelector)
      .empty()
      .append("<option value='' selected disabled>choose...</option>");

    for (let i = 0; i < len; i++) {
      const { id, name } = response[i];
      $(categorySelector).append(
        `<option value='${id}'>${name}</option>`
      );
    }
  }

  $("#request_types_id").on("change", function () {
    updateOptions(
      "/isds/includes/fetch.php",
      { select_data: "categories_id", request_types_id: $(this).val() },
      "#categories_id",
      "#sub_categories_id"
    );
  });

  $("#categories_id").on("change", function () {
    updateOptions(
      "/isds/includes/fetch.php",
      { select_data: "sub_categories_id", categories_id: $(this).val() },
      "#sub_categories_id",
      "#sub_categories_id"
    );
  });

  $("#upd_request_types_id").on("change", function () {
    updateOptions(
      "/isds/includes/fetch.php",
      { select_data: "categories_id", request_types_id: $(this).val() },
      "#upd_categories_id",
      "#upd_sub_categories_id"
    );
  });

  $("#upd_categories_id").on("change", function () {
    updateOptions(
      "/isds/includes/fetch.php",
      { select_data: "sub_categories_id", categories_id: $(this).val() },
      "#upd_sub_categories_id",
      "#upd_sub_categories_id"
    );
  });

  $("#time_start").on("change", function () {
    var timeStart = $(this).val();
    var timeEnd = $("#time_end").val();

    if (timeStart) {
      var startParts = timeStart.split(":");
      var startHours = parseInt(startParts[0], 10);
      var startMinutes = parseInt(startParts[1], 10);

      if (timeEnd) {
        var endParts = timeEnd.split(":");
        var endHours = parseInt(endParts[0], 10);
        var endMinutes = parseInt(endParts[1], 10);

        var startTotalMinutes = startHours * 60 + startMinutes;
        var endTotalMinutes = endHours * 60 + endMinutes;

        if (endTotalMinutes <= startTotalMinutes) {
          endHours = (startHours + 1) % 24;
          var newTimeEnd =
            ("0" + endHours).slice(-2) + ":" + ("0" + startMinutes).slice(-2);
          $("#time_end").val(newTimeEnd);
        }
      } else {
        var newEndHours = (startHours + 1) % 24;
        var newEndTime =
          ("0" + newEndHours).slice(-2) + ":" + ("0" + startMinutes).slice(-2);
        $("#time_end").val(newEndTime);
      }
    }
  });

  $("#time_end").on("change", function () {
    var timeStart = $("#time_start").val();
    var timeEnd = $(this).val();
    if (timeStart && timeEnd) {
      var startParts = timeStart.split(":");
      var endParts = timeEnd.split(":");

      var startHours = parseInt(startParts[0], 10);
      var startMinutes = parseInt(startParts[1], 10);

      var endHours = parseInt(endParts[0], 10);
      var endMinutes = parseInt(endParts[1], 10);

      var startTotalMinutes = startHours * 60 + startMinutes;
      var endTotalMinutes = endHours * 60 + endMinutes;

      if (startTotalMinutes > endTotalMinutes) {
        var newStartHours = (endHours - 1 + 24) % 24;

        var newTimeStart =
          ("0" + newStartHours).slice(-2) + ":" + ("0" + endMinutes).slice(-2);

        $("#time_start").val(newTimeStart);
      }
    }
  });

  // window.delhelpdesksbtn = function (id) {
  //   console.log("Helpdesk ID: " + id);

  //   Swal.fire({
  //     title: "Are you sure?",
  //     text: "You are trying to delete this item.",
  //     icon: "warning",
  //     showCancelButton: true,
  //     confirmButtonColor: "#3085d6",
  //     cancelButtonColor: "#d33",
  //     confirmButtonText: "Yes, delete",
  //   }).then((result) => {
  //     if (result.isConfirmed) {
  //       Swal.fire({
  //         title: "Loading",
  //         html: "Please wait...",
  //         allowOutsideClick: false,
  //         didOpen: function () {
  //           Swal.showLoading();
  //         },
  //       });

  //       $.ajax({
  //         type: "POST",
  //         url: "/isds/includes/process.php",
  //         data: {
  //           del_helpdesks: true,
  //           helpdesks_id: id,
  //           "captcha-token": captchaToken,
  //         },
  //         dataType: "json",
  //         success: function (response) {
  //           setTimeout(function () {
  //             Swal.fire({
  //               icon: response.status,
  //               title: response.message,
  //               showConfirmButton: false,
  //               timer: 1000,
  //             }).then(function () {
  //               if (response.redirect) {
  //                 window.location.href = response.redirect;
  //               }
  //               if (response.reload) {
  //                 window.reload();
  //               }
  //             });
  //           }, 1000);

  //           grecaptcha.ready(function () {
  //             grecaptcha.execute(window.sitekey).then(function (token) {
  //               $(".captcha-token").val(token);
  //             });
  //           });
  //         },
  //       });
  //     }
  //   });
  // };

  window.delhelpdesksbtn = function (id, requestNumber) {
    console.log("Helpdesk ID: " + id);

    Swal.fire({
      title: "Are you sure?",
      html: `<p class="swal-text">You are trying to delete this item.<br>Please type \"<b>${requestNumber}</b>\" to confirm deletion.</p>`,
      input: "text",
      inputPlaceholder: `Type '${requestNumber}' to confirm`,
      showCancelButton: true,
      confirmButtonText: "I understand, delete",
      confirmButtonColor: "#d33",
      cancelButtonColor: "#6c757d",
      icon: "warning",
      inputValidator: (inputValue) => {
        if (inputValue.trim() !== requestNumber) {
          return "The request number does not match.";
        }
      }
    }).then((result) => {
      if (!result.isConfirmed) return;

      Swal.fire({
        title: "Processing...",
        html: "Please wait...",
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading(),
      });

      grecaptcha.ready(() => {
        grecaptcha.execute(window.sitekey).then((captchaToken) => {
          $.ajax({
            type: "POST",
            url: "/isds/includes/process.php",
            data: {
              del_helpdesks: true,
              helpdesks_id: id,
              request_number: requestNumber,
              "captcha-token": captchaToken,
            },
            dataType: "json",
            success: function (response) {
              Swal.fire({
                icon: response.status,
                title: response.message,
                showConfirmButton: false,
                timer: 1500,
              }).then(() => {
                if (response.redirect) {
                  window.location.href = response.redirect;
                } else if (response.reload) {
                  window.location.reload();
                }
              });
            },
            error: function () {
              Swal.fire({
                title: "Error",
                text: "Failed to process request. Please try again.",
                icon: "error",
              });
            }
          });
        });
      });
    });
  };

  function printForm(formType, jsonData) {
    var encodedData = encodeURIComponent(JSON.stringify(jsonData));
    var printWindow = window.open(`../forms/${formType}-form.php?data=${encodedData}`, "_blank");

    printWindow.onload = function () {
      printWindow.print();
      printWindow.onafterprint = function () {
        printWindow.close();
      };
    };
  }

  // Specific functions calling the generic one
  window.printoisbtn = function (jsonData) {
    printForm("ois", jsonData);
  };

  window.printmjrbtn = function (jsonData) {
    printForm("mjr", jsonData);
  };

  window.printpribtn = function (jsonData) {
    printForm("pri", jsonData);
  };


  window.viewhelpdesksbtn = function (id) {
    console.log("Helpdesk ID: " + id);

    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        view_helpdesks: true,
        helpdesks_id: id,
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        $("#view_date_requested").val(response.date_requested);
        $("#view_requested_by_name").val(response.requested_by_name);
        $("#view_request_type").val(response.request_type);
        $("#view_category").val(response.category);
        $("#view_sub_category").val(response.sub_category);
        $("#view_complaint").val(response.complaint);
        $("#view_datetime_preferred").val(response.datetime_preferred);
        $("#view_status").val(response.status);
        $("#view_property_number").val(response.property_number);
        $("#view_priority_level").val(response.priority_level);
        $("#view_medium").val(response.medium);
        $("#view_datetime_start").val(response.datetime_start);
        $("#view_is_pullout").prop('checked', response.is_pullout);
        $("#view_datetime_end").val(response.datetime_end);
        $("#view_is_turnover").prop('checked', response.is_turnover);
        $("#view_diagnosis").val(response.diagnosis);
        $("#view_action_taken").val(response.action_taken);
        $("#view_remarks").val(response.remarks);
      },
    });

    $("#viewhelpdesksmodal").modal("toggle");
    $("#viewhelpdesksmodal").modal("show");
  };


  window.updhelpdesksbtn = function (id) {
    console.log("Helpdesk ID: " + id);

    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        upd_helpdesks: true,
        helpdesks_id: id,
      },
      dataType: "json",
      success: function (response) {
        console.log(response);

        $("#upd_date_requested").val(response.date_requested);
        $("#upd_requested_by").val(response.requested_by);
        $("#upd_request_types_id").val(response.request_types_id);

        // Fetch and update categories
        $.ajax({
          url: "/isds/includes/fetch.php",
          type: "GET",
          data: {
            select_data: "categories_id",
            request_types_id: response.request_types_id,
          },
          dataType: "json",
          success: function (categoriesResponse) {
            updateSelectOptions(
              "#upd_categories_id",
              categoriesResponse,
              response.categories_id
            );

            // Fetch and update sub-categories
            $.ajax({
              url: "/isds/includes/fetch.php",
              type: "GET",
              data: {
                select_data: "sub_categories_id",
                categories_id: response.categories_id,
              },
              dataType: "json",
              success: function (subCategoriesResponse) {
                updateSelectOptions(
                  "#upd_sub_categories_id",
                  subCategoriesResponse,
                  response.sub_categories_id
                );
              },
            });
          },
        });

        $("#upd_complaint").val(response.complaint);
        let fh_datetime_preferred = new Date(response.datetime_preferred);

        function pad(n) {
          return n < 10 ? "0" + n : n;
        }

        let h_datetime_preferred =
          fh_datetime_preferred.getFullYear() +
          "-" +
          pad(fh_datetime_preferred.getMonth() + 1) +
          "-" +
          pad(fh_datetime_preferred.getDate()) +
          "T" +
          pad(fh_datetime_preferred.getHours()) +
          ":" +
          pad(fh_datetime_preferred.getMinutes());

        $("#upd_datetime_preferred").val(h_datetime_preferred);
        $("#upd_h_statuses_id").val(response.h_statuses_id);
        $("#upd_property_number").val(response.property_number);
        $("#upd_priority_levels_id").val(response.priority_levels_id);
        $("#upd_repair_types_id").val(response.repair_types_id);
        $("#upd_repair_classes_id").val(response.repair_classes_id);
        $("#upd_mediums_id").val(response.mediums_id);
        let fh_datetime_start = new Date(response.datetime_start);

        function pad(n) {
          return n < 10 ? "0" + n : n;
        }

        let h_datetime_start =
          fh_datetime_start.getFullYear() +
          "-" +
          pad(fh_datetime_start.getMonth() + 1) +
          "-" +
          pad(fh_datetime_start.getDate()) +
          "T" +
          pad(fh_datetime_start.getHours()) +
          ":" +
          pad(fh_datetime_start.getMinutes());

        $("#upd_datetime_start").val(h_datetime_start);
        let fh_datetime_end = new Date(response.datetime_end);

        function pad(n) {
          return n < 10 ? "0" + n : n;
        }

        let h_datetime_end =
          fh_datetime_end.getFullYear() +
          "-" +
          pad(fh_datetime_end.getMonth() + 1) +
          "-" +
          pad(fh_datetime_end.getDate()) +
          "T" +
          pad(fh_datetime_end.getHours()) +
          ":" +
          pad(fh_datetime_end.getMinutes());

        $("#upd_datetime_end").val(h_datetime_end);

        $("#upd_is_pullout").prop("checked", response.is_pullout == 1);
        $("#upd_is_turnover").prop("checked", response.is_turnover == 1);

        $("#upd_diagnosis").val(response.diagnosis);
        $("#upd_action_taken").val(response.action_taken);
        $("#upd_remarks").val(response.remarks);

        $("#upd_helpdesks_id").val(response.id);
      },
    });

    function updateSelectOptions(selectId, optionsData, selectedValue) {
      var len = optionsData.length;
      $(selectId).empty();
      $(selectId).append(
        "<option value='' selected disabled>choose...</option>"
      );

      for (var i = 0; i < len; i++) {
        var id = optionsData[i]["id"];
        var name = optionsData[i]["name"];
        $(selectId).append("<option value='" + id + "'>" + name + "</option>");
      }

      $(selectId).val(selectedValue);
    }

    $("#updhelpdesksmodal").modal("toggle");
    $("#updhelpdesksmodal").modal("show");
  };

  window.delmeetingsbtn = function (id) {
    console.log("meeting ID: " + id);

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

        $.ajax({
          type: "POST",
          url: "/isds/includes/process.php",
          data: {
            del_meetings: true,
            meetings_id: id,
            "captcha-token": captchaToken,
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
          },
        });
      }
    });
  };

  window.updmeetingsbtn = function (id) {
    console.log("Meeting ID: " + id);

    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        upd_meetings: true,
        meetings_id: id,
      },
      dataType: "json",
      success: function (response) {
        console.log(response);

        $("#upd_date_requested").val(response.date_requested);
        $("#upd_requested_by").val(response.requested_by);
        $("#upd_topic").val(response.topic);
        $("#upd_date_schedule").val(response.date_schedule);
        $("#upd_time_start").val(response.time_start);
        $("#upd_time_end").val(response.time_end);
      },
    });

    $("#updmeetingsmodal").modal("toggle");
    $("#updmeetingsmodal").modal("show");
  };

  window.updusersbtn = function (id) {
    console.log("user ID: " + id);

    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        upd_users: true,
        users_id: id,
      },
      dataType: "json",
      success: function (response) {
        console.log(response);

        $("#upd_id_number").val(response.id_number);
        $("#upd_first_name").val(response.first_name);
        $("#upd_middle_name").val(response.middle_name);
        $("#upd_last_name").val(response.last_name);
        $("#upd_date_birth").val(response.date_birth);
        $("#upd_sex").val(response.sex);
        $("#upd_is_pwd").prop("checked", response.is_pwd == 1);
        $("#upd_phone").val(response.phone);
        $("#upd_email").val(response.email);
        $("#upd_address").val(response.address);
        $("#upd_designation").val(response.designation);
        $("#upd_offices_id").val(response.offices_id);
        $("#upd_divisions_id").val(response.divisions_id);
        $("#upd_client_types_id").val(response.client_types_id);
        $("#upd_roles_id").val(response.roles_id);
        $("#upd_id").val(response.id);
      },
    });

    $("#updusersmodal").modal("toggle");
    $("#updusersmodal").modal("show");
  };

  window.rstusersbtn = function (id) {
    console.log("meeting ID: " + id);

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

        $.ajax({
          type: "POST",
          url: "/isds/includes/process.php",
          data: {
            reset_password: true,
            users_id: id,
            "captcha-token": captchaToken,
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
          },
        });
      }
    });
  };

  function chart_month() {
    $.ajax({
      url: "/isds/includes/fetch.php", // Replace with your server endpoint
      type: "GET",
      data: {
        chart_month: true, // Example parameter to identify the request
      },
      dataType: "json",
      success: function (response) {
        var seriesData = response.series;
        var labelsData = response.labels;

        var options = {
          title: {
            text: 'Helpdesks Per Month',
            align: 'left'
          },
          dataLabels: {
            enabled: true,
          },
          series: [
            {
              name: "Desktops",
              data: seriesData,
            },
          ],
          chart: {
            height: 350,
            type: "line",
            toolbar: {
              show: true,
              tools: {
                download: true,
                selection: false,
                zoom: false,
                zoomin: false,
                zoomout: false,
                pan: false,
                reset: false,
              },
              autoSelected: "zoom",
            },
          },
          stroke: {
            curve: "straight",
          },
          xaxis: {
            categories: labelsData,
          },
          colors: generateHSLColors(response.series.length),
        };

        var chart = new ApexCharts(
          document.querySelector("#chart_month"),
          options
        );
        chart.render();
      },
      error: function (error) {
        console.error("Error fetching data:", error);
      },
    });
  }
  if ($("#chart_month").length) {
    chart_month();
  }


  function chart_category() {
    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        chart_category: true,
      },
      dataType: "json",
      success: function (response) {
        var seriesData = response.series;
        var labelsData = response.labels;

        var options = {
          title: {
            text: 'Helpdesks Per Category',
            align: 'left'
          },
          dataLabels: {
            enabled: true,
            textAnchor: "start",
            formatter: function (val, opt) {
              return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val;
            },
            offsetX: 0,
          },
          series: [
            {
              data: seriesData,
            },
          ],
          chart: {
            type: "bar",
            height: 350,
            toolbar: {
              show: true,
              tools: {
                download: true,
              },
              autoSelected: "zoom",
            },
          },
          plotOptions: {
            bar: {
              distributed: true,
              horizontal: true,
              borderRadius: 4,
              borderRadiusApplication: "end",
              dataLabels: {
                position: "bottom",
              },
            },
          },
          colors: generateHSLColors(response.series.length),
          xaxis: {
            categories: labelsData,
          },
          yaxis: {
            labels: {
              show: false,
            },
          },
        };

        var chart = new ApexCharts(
          document.querySelector("#chart_category"),
          options
        );
        chart.render();
      },
      error: function (error) {
        console.error("Error fetching data:", error);
      },
    });
  }
  if ($("#chart_category").length) {
    chart_category();
  }

  function chart_division() {
    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        chart_division: true,
      },
      dataType: "json",
      success: function (response) {
        var seriesData = response.series;
        var labelsData = response.labels;

        var options = {
          title: {
            text: 'Helpdesks Per Division',
            align: 'left'
          },
          dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
              return opt.w.globals.labels[opt.dataPointIndex] + ": " + val.toFixed(2) + "%";
            },
          },
          series: seriesData,
          chart: {
            type: "donut",
            height: 350,
            toolbar: {
              show: true,
              tools: {
                download: true,
              },
              autoSelected: "zoom",
            },
          },
          labels: labelsData,
          responsive: [
            {
              breakpoint: 480,
              options: {
                chart: {
                  width: 200,
                },
                legend: {
                  position: "bottom",
                },
              },
            },
          ],
          colors: generateHSLColors(response.series.length),
        };

        var chart = new ApexCharts(
          document.querySelector("#chart_division"),
          options
        );
        chart.render();
      },
      error: function (error) {
        console.error("Error fetching data:", error);
      },
    });
  }
  if ($("#chart_division").length) {
    chart_division();
  }

  function chart_sex() {
    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        chart_sex: true,
      },
      dataType: "json",
      success: function (response) {
        var seriesData = response.series;
        var labelsData = response.labels;

        var options = {
          title: {
            text: 'Helpdesks Per Sex',
            align: 'left'
          },
          dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
              console.log(val);
              return opt.w.globals.labels[opt.dataPointIndex] + ": " + val.toFixed(2) + "%";
            },
          },
          series: seriesData,
          chart: {
            type: "pie",
            height: 350,
            toolbar: {
              show: true,
              tools: {
                download: true,
              },
              autoSelected: "zoom",
            },
          },
          labels: labelsData,
          responsive: [
            {
              breakpoint: 480,
              options: {
                chart: {
                  width: 200,
                },
                legend: {
                  position: "bottom",
                },
              },
            },
          ],
          colors: generateHSLColors(response.series.length),
        };

        var chart = new ApexCharts(
          document.querySelector("#chart_sex"),
          options
        );
        chart.render();
      },
      error: function (error) {
        console.error("Error fetching data:", error);
      },
    });
  }
  if ($("#chart_sex").length) {
    chart_sex();
  }

  if ($("#calendar").length) {
    var calendarEl = document.querySelector("#calendar");

    var calendar = new FullCalendar.Calendar(calendarEl, {
      events: "/isds/includes/fetch.php?meetings",
    });

    calendar.render();

    var calendarjQ = $(calendarEl);
  }

  if ($("#cal_meetings_a").length) {
    var calendarEl = document.querySelector("#cal_meetings_a");

    var calendar = new FullCalendar.Calendar(calendarEl, {
      events: "/isds/includes/fetch.php?allmeetings",
    });

    calendar.render();

    var calendarjQ = $(calendarEl);
  }
});
