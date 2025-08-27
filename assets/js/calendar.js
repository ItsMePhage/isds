// calendar.js - Calendar Functions using FullCalendar

$(function () {
  "use strict";

  // Main calendar for meetings
  if ($("#calendar").length) {
    var calendarEl = document.querySelector("#calendar");

    var calendar = new FullCalendar.Calendar(calendarEl, {
      events: "/isds/includes/fetch.php?meetings",
    });

    calendar.render();

    var calendarjQ = $(calendarEl);
  }

  // Calendar for all meetings
  if ($("#cal_meetings_a").length) {
    var calendarEl = document.querySelector("#cal_meetings_a");

    var calendar = new FullCalendar.Calendar(calendarEl, {
      events: "/isds/includes/fetch.php?allmeetings",
    });

    calendar.render();

    var calendarjQ = $(calendarEl);
  }

});