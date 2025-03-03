const Dropdowns = {
  updateOptions(url, data, categorySelector, subCategorySelector) {
    Utils.fetchData(url, data, (response) => {
      const len = response.length;
      $(categorySelector).empty().append("<option value='' selected disabled>choose...</option>");
      $(subCategorySelector).empty().append("<option value='' selected disabled>choose...</option>");
      response.forEach(({ id, name }) => {
        $(categorySelector).append(`<option value='${id}'>${name}</option>`);
      });
    });
  },

  initDropdowns(selector, url, dataKey) {
    $(selector).each(function () {
      const selectId = $(this).attr("id");
      Utils.fetchData(
        url,
        { [dataKey]: selectId },
        (response) => {
          response.forEach(({ id, name }) => {
            $(`#${selectId}`).append(`<option value='${id}'>${name}</option>`);
          });
        }
      );
    });
  },

  init() {
    this.initDropdowns(".select-init", "/isds/includes/fetch.php", "select_data");

    $("#request_types_id").on("change", () => {
      this.updateOptions(
        "/isds/includes/fetch.php",
        { select_data: "categories_id", request_types_id: $("#request_types_id").val() },
        "#categories_id",
        "#sub_categories_id"
      );
    });

    $("#categories_id").on("change", () => {
      this.updateOptions(
        "/isds/includes/fetch.php",
        { select_data: "sub_categories_id", categories_id: $("#categories_id").val() },
        "#sub_categories_id",
        "#sub_categories_id"
      );
    });

    // Similar handlers for upd_request_types_id and upd_categories_id...
  },
};