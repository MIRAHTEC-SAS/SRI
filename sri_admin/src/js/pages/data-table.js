//[Data Table Javascript]

//Project:	CRMi - Responsive Admin Template
//Primary use:   Used only for the Data Table

$(function () {
  "use strict";

  $("#example1").DataTable();
  $("#example2").DataTable({
    paging: true,
    lengthChange: false,
    searching: false,
    ordering: true,
    info: true,
    autoWidth: false,
    dom: "Bfrtip",
    buttons: [
      { extend: "csv", exportOptions: { columns: ":not(:last-child)" } },
      { extend: "excel", exportOptions: { columns: ":not(:last-child)" } },
      { extend: "pdf", exportOptions: { columns: ":not(:last-child)" } },
    ],
    language: { url: "//cdn.datatables.net/plug-ins/2.2.0/i18n/fr-FR.json" },
  });

  $("#example").DataTable({
    dom: "Bfrtip",
    buttons: [
      { extend: "csv", exportOptions: { columns: ":not(:last-child)" } },
      { extend: "excel", exportOptions: { columns: ":not(:last-child)" } },
      { extend: "pdf", exportOptions: { columns: ":not(:last-child)" } },
    ],
    language: { url: "//cdn.datatables.net/plug-ins/2.2.0/i18n/fr-FR.json" },
  });

  $("#tickets").DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    dom: "Bfrtip",
    buttons: [
      { extend: "csv", exportOptions: { columns: ":not(:last-child)" } },
      { extend: "excel", exportOptions: { columns: ":not(:last-child)" } },
      { extend: "pdf", exportOptions: { columns: ":not(:last-child)" } },
    ],
    language: { url: "//cdn.datatables.net/plug-ins/2.2.0/i18n/fr-FR.json" },
  });

  $("#productorder").DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    dom: "Bfrtip",
    buttons: [
      { extend: "csv", exportOptions: { columns: ":not(:last-child)" } },
      { extend: "excel", exportOptions: { columns: ":not(:last-child)" } },
      { extend: "pdf", exportOptions: { columns: ":not(:last-child)" } },
    ],
    language: { url: "//cdn.datatables.net/plug-ins/2.2.0/i18n/fr-FR.json" },
  });

  $("#complex_header").DataTable();

  //--------Individual column searching

  // Setup - add a text input to each footer cell
  $("#example5 tfoot th").each(function () {
    var title = $(this).text();
    $(this).html('<input type="text" placeholder="Search ' + title + '" />');
  });

  // DataTable
  var table = $("#example5").DataTable();

  // Apply the search
  table.columns().every(function () {
    var that = this;

    $("input", this.footer()).on("keyup change", function () {
      if (that.search() !== this.value) {
        that.search(this.value).draw();
      }
    });
  });

  //---------------Form inputs
  var table = $("#example6").DataTable();

  $("#data-update").click(function () {
    var data = table.$("input, select").serialize();
    alert(
      "The following data would have been submitted to the server: \n\n" +
        data.substr(0, 120) +
        "..."
    );
    return false;
  });
}); // End of use strict
