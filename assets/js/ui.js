const UI = {
  init() {
    this.toggleSidebar();
    this.handleNavbarLinks();
    this.handleHeaderScroll();
    this.handleBackToTop();
    this.initTooltips();
    this.highlightActiveNav();
  },

  toggleSidebar() {
    Utils.on("click", ".toggle-sidebar-btn", () => {
      $("body").toggleClass("toggle-sidebar");
    });
  },

  handleNavbarLinks() {
    const navbarlinks = $("#navbar .scrollto");
    const updateActiveLinks = () => {
      const position = $(window).scrollTop() + 200;
      navbarlinks.each(function () {
        const link = $(this);
        const section = $(link.attr("href"));
        if (
          section.length &&
          position >= section.offset().top &&
          position <= section.offset().top + section.outerHeight()
        ) {
          link.addClass("active");
        } else {
          link.removeClass("active");
        }
      });
    };
    $(window).on("load", updateActiveLinks);
    Utils.onScroll(document, updateActiveLinks);
  },

  handleHeaderScroll() {
    const header = Utils.select("#header");
    if (header.length) {
      const toggleHeader = () => {
        header.toggleClass("header-scrolled", $(window).scrollTop() > 100);
      };
      $(window).on("load", toggleHeader);
      Utils.onScroll(document, toggleHeader);
    }
  },

  handleBackToTop() {
    const backtotop = Utils.select(".back-to-top");
    if (backtotop.length) {
      const toggleBackToTop = () => {
        backtotop.toggleClass("active", $(window).scrollTop() > 100);
      };
      $(window).on("load", toggleBackToTop);
      Utils.onScroll(document, toggleBackToTop);
    }
  },

  initTooltips() {
    $('[data-bs-toggle="tooltip"]').tooltip();
  },

  highlightActiveNav() {
    const currentUrl = window.location.href.split("/").pop();
    $(".nav-link").each(function () {
      $(this).toggleClass("collapsed", $(this).attr("href") !== currentUrl);
    });
    $(".nav-content a").each(function () {
      const href = $(this).attr("href");
      if (href === currentUrl) {
        $(this).addClass("active").closest(".nav-content").addClass("show");
        $(this).closest(".nav-item").find(".nav-link").removeClass("collapsed");
      }
    });
  },
};