// modals.js - Modal Operations (View & Edit)

$(function () {
  "use strict";

  // View helpdesk details
  window.viewhelpdesksbtn = function (id) {
    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        view_helpdesks: true,
        helpdesks_id: id,
      },
      dataType: "json",
      success: function (response) {
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

  // Update helpdesk
  window.updhelpdesksbtn = function (id) {
    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        upd_helpdesk: true,
        helpdesks_id: id,
      },
      dataType: "json",
      success: function (response) {
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
        $("#upd_datetime_preferred").val(formatDatetimeForInput(response.datetime_preferred));
        $("#upd_h_statuses_id").val(response.h_statuses_id);
        $("#upd_property_number").val(response.property_number);
        $("#upd_priority_levels_id").val(response.priority_levels_id);
        $("#upd_repair_types_id").val(response.repair_types_id);
        $("#upd_repair_classes_id").val(response.repair_classes_id);
        $("#upd_mediums_id").val(response.mediums_id);
        $("#upd_datetime_start").val(formatDatetimeForInput(response.datetime_start));
        $("#upd_datetime_end").val(formatDatetimeForInput(response.datetime_end));
        $("#upd_is_pullout").prop("checked", response.is_pullout == 1);
        $("#upd_is_turnover").prop("checked", response.is_turnover == 1);
        $("#upd_diagnosis").val(response.diagnosis);
        $("#upd_action_taken").val(response.action_taken);
        $("#upd_remarks").val(response.remarks);
        $("#upd_serviced_by").val(response.serviced_by);
        $("#upd_helpdesk_id").val(response.id);
      },
    });

    $("#updhelpdesksmodal").modal("toggle");
    $("#updhelpdesksmodal").modal("show");
  };

  // Update meeting
  window.updmeetingsbtn = function (id) {
    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        upd_meeting: true,
        meetings_id: id,
      },
      dataType: "json",
      success: function (response) {
        $("#upd_date_requested").val(response.date_requested);
        $("#upd_requested_by").val(response.requested_by);
        $("#upd_topic").val(response.topic);
        $("#upd_date_scheduled").val(response.date_scheduled);
        $("#upd_time_start").val(response.time_start);
        $("#upd_time_end").val(response.time_end);
        $("#upd_hosts_id").val(response.hosts_id);
        $("#upd_m_statuses_id").val(response.m_statuses_id);
        $("#upd_meeting_details").val(response.meeting_details);
        $("#upd_meeting_id").val(id);
      },
      error: function (xhr, status, error) {
        console.error("Error fetching meeting data:", error);
      }
    });

    $("#updmeetingsmodal").modal("show");
  };

  // Update user
  window.updusersbtn = function (id) {
    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        upd_user: true,
        users_id: id,
      },
      dataType: "json",
      success: function (response) {
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

  // Helper function to update select options
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

});