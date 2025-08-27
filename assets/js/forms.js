// forms.js - Form Handling and Validation

$(function () {
  "use strict";

  // Form submission with reCAPTCHA
  $(".form-validation").on("submit", function (e) {
    e.preventDefault();

    var form = $(this);

    grecaptcha.execute(window.sitekey).then(function (token) {
      Swal.fire({
        title: "Loading",
        html: "Please wait...",
        allowOutsideClick: false,
        didOpen: function () {
          Swal.showLoading();
        },
      });

      // Serialize form and append captcha token
      var formData = form.serialize() + "&captcha-token=" + token;

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
              } else if (response.reload) {
                window.location.reload(true);
              }
            });
          }, 1000);
        },
      });
    });
  });

  // Time validation for meeting forms
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

});