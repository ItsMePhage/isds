// datatables.js - DataTables Configuration and Management

$(function () {
  "use strict";

  // Helper function to bind filter buttons
  function bindFilterButton(buttonId, table, columnIdx, filterValue) {
    $(buttonId).on("click", function () {
      table.column(columnIdx).search(filterValue).draw();
    });
  }

  // Users table
  var users_table = new DataTable("#users_table", {
    ajax: "/isds/includes/datatables.php?users_table",
    processing: true,
    serverSide: true,
    scrollX: true,
  });

  bindFilterButton("#u_admin", users_table, 5, "Admin");
  bindFilterButton("#u_vip", users_table, 5, "VIP");
  bindFilterButton("#u_employee", users_table, 5, "Employee");

  // Helpdesks table
  var helpdesks_table = new DataTable("#helpdesks_table", {
    ajax: "/isds/includes/datatables.php?helpdesks_table",
    processing: true,
    serverSide: true,
    scrollX: true,
    order: [[0, 'desc']],
  });

  bindFilterButton("#h_open", helpdesks_table, 4, "Open");
  bindFilterButton("#h_pending", helpdesks_table, 4, "Pending");
  bindFilterButton("#h_completed", helpdesks_table, 4, "Completed");
  bindFilterButton("#h_prerepair", helpdesks_table, 4, "Pre-repair");
  bindFilterButton("#h_cancelled", helpdesks_table, 4, "Cancelled");
  bindFilterButton("#h_unserviceable", helpdesks_table, 4, "Unserviceable");

  // Meetings table
  var meetings_table = new DataTable("#meetings_table", {
    ajax: "/isds/includes/datatables.php?meetings_table",
    processing: true,
    serverSide: true,
    scrollX: true,
  });

  bindFilterButton("#m_pending", meetings_table, 4, "Pending");
  bindFilterButton("#m_scheduled", meetings_table, 4, "Scheduled");
  bindFilterButton("#m_unavailable", meetings_table, 4, "Unavailable");
  bindFilterButton("#m_cancelled", meetings_table, 4, "Cancelled");

  // Configuration tables
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

  // Report tables with export functionality
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

  var mjr_report_table = new DataTable("#mjr_report_table", {
    layout: {
      topStart: {
        buttons: ['colvis', 'excel']
      }
    },
    ajax: "/isds/includes/datatables.php?helpdesks_report_table=mjr",
    processing: true,
    serverSide: true,
    scrollX: true,
    order: [[2, 'asc']]
  });

  var ois_report_table = new DataTable("#ois_report_table", {
    layout: {
      topStart: {
        buttons: ['colvis', 'excel']
      }
    },
    ajax: "/isds/includes/datatables.php?helpdesks_report_table=ois",
    processing: true,
    serverSide: true,
    scrollX: true,
    order: [[2, 'asc']]
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
            title: 'DTI6 ISDS Generated Accomplishment Report',
            exportOptions: {
              columns: ':visible'
            },
          }
        ]
      }
    },
    ajax: "/isds/includes/datatables.php?accomplishment_report_table",
    processing: true,
    serverSide: true,
    scrollX: true,
    order: [[0, 'desc']]
  });

});