const DataTablesManager = {
  initTable(selector, ajaxUrl, options = {}) {
    return new DataTable(selector, {
      ajax: ajaxUrl,
      processing: true,
      serverSide: true,
      scrollX: true,
      ...options,
    });
  },

  bindFilterButton(buttonId, table, columnIdx, filterValue) {
    Utils.on("click", buttonId, () => {
      table.column(columnIdx).search(filterValue).draw();
    });
  },

  init() {
    const usersTable = this.initTable("#users_table", "/isds/includes/datatables.php?users_table");
    this.bindFilterButton("#u_admin", usersTable, 5, "Admin");
    this.bindFilterButton("#u_vip", usersTable, 5, "VIP");
    this.bindFilterButton("#u_employee", usersTable, 5, "Employee");

    const helpdesksTable = this.initTable("#helpdesks_table", "/isds/includes/datatables.php?helpdesks_table");
    this.bindFilterButton("#h_open", helpdesksTable, 4, "Open");
    this.bindFilterButton("#h_pending", helpdesksTable, 4, "Pending");
    this.bindFilterButton("#h_completed", helpdesksTable, 4, "Completed");
    // Add remaining filters...

    const meetingsTable = this.initTable("#meetings_table", "/isds/includes/datatables.php?meetings_table");
    this.bindFilterButton("#m_pending", meetingsTable, 4, "Pending");
    // Add remaining filters...

    this.initTable("#tbl_request_types", "/isds/includes/datatables.php?tbl_request_types", {
      pageLength: 5,
      lengthChange: false,
    });

    this.initTable("#csf_report_table", "/isds/includes/datatables.php?csf_report_table", {
      layout: { topStart: { buttons: ["colvis", "excel"] } },
    });

    this.initTable("#mjr_report_table", "/isds/includes/datatables.php?helpdesks_report_table=mjr", {
      layout: { topStart: { buttons: ["colvis", "excel"] } },
      order: [[2, "asc"]],
    });

    this.initTable("#accomplishment_report_table", "/isds/includes/datatables.php?accomplishment_report_table", {
      layout: {
        topStart: {
          buttons: [
            "colvis",
            "excel",
            {
              extend: "pdfHtml5",
              text: "PDF",
              orientation: "landscape",
              pageSize: "A4",
              title: "ACCOMPLISHMENT REPORT AS OF _____________",
              exportOptions: { columns: ":visible" },
              customize: (doc) => {
                doc.content.push({
                  text: "Prepared by:\n\n_________________________\n\n\nApproved by:\n\n_________________________",
                  alignment: "left",
                  fontSize: 12,
                  italics: true,
                  margin: [0, 20, 0, 0],
                });
              },
            },
          ],
        },
      },
    });
  },
};