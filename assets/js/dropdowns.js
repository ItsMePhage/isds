// dropdowns.js - Dynamic Dropdown Management

$(function () {
  "use strict";

  // Initialize select dropdowns
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
        if (typeof select_data_val !== 'undefined' && select_data_val.length > 0) {
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

  // Helper functions for cascading dropdowns
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

  // Cascading dropdowns for request forms
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

  // Cascading dropdowns for update forms
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

});