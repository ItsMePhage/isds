const Calendar = {
  initCalendar(selector, eventsUrl) {
    if ($(selector).length) {
      const calendar = new FullCalendar.Calendar(document.querySelector(selector), {
        events: eventsUrl,
      });
      calendar.render();
    }
  },

  init() {
    this.initCalendar("#calendar", "/isds/includes/fetch.php?meetings");
    this.initCalendar("#cal_meetings_a", "/isds/includes/fetch.php?allmeetings");
  },
};