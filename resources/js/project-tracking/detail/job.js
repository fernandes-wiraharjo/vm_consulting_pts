$(document).ready(function () {
  function loadData(filterStartDate = '', filterEndDate = '') {
    const fileName = $("#job-code").text();

    $('#table-job-detail').DataTable({
      dom: "<'row'<'col-sm-12 col-md-7 d-flex align-items-center ps-5'Bl><'col-sm-12 col-md-5'f>>" +
          "<'row'<'col-sm-12 px-5 py-2 grand-total-cost'>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>" +
          "<'row'<'col-sm-12 px-5 py-3 grand-total-cost'>>",
      responsive: true,
      processing: true,
      serverSide: true,
      stateServe: true,
      ajax: {
        url: window.location.pathname,
        data: {
          startDate: filterStartDate,
          endDate: filterEndDate
        }
      },
      columns: [
        {
          data: "user_name",
          name: "users.name"
        },
        {
          data: "total_hour",
          name: "total_hour",
          searchable: false
        },
        {
          data: "total_cost",
          name: "total_cost",
          searchable: false
        },
        {
          data: "action",
          name: "action",
          orderable: false,
          searchable: false
        }
      ],
      buttons: [
        {
          extend: "excelHtml5",
          title: function () {
            return exportDatatableHelper.generateFilename(fileName, filterStartDate, filterEndDate);
          },
          filename: function () {
            return exportDatatableHelper.generateFilename(fileName, filterStartDate, filterEndDate);
          },
          action: exportDatatableHelper.newExportAction,
          className: "btn btn-warning",
          text: "Export",
          titleAttr: "Excel",
          footer: true,
          exportOptions: {
            modifier: {
              page: "all",
            },
            columns: [0, 1, 2],
            orthogonal: "export",
          }
        },
      ],
    });

    $.ajax({
      type: "GET",
      url: window.location.pathname,
      data: {
        startDate: filterStartDate,
        endDate: filterEndDate,
        type: 'grand-total-cost'
      },
      success: function(data){
        $("div.grand-total-cost").html(`
          <h4 class='m-0'>Grand Total Costs : ${data}</h4>
        `);

        $("#grand-total-cost").text(data);
      }
    });
  }

  loadData();

  let filter = $("#filter-date").flatpickr({
    mode: "range",
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d F Y",
    onChange: function(dates) {
      if (dates.length == 2) {
        const startDate = formatDate(dates[0]);
        const endDate = formatDate(dates[1]);

        $('#table-job-detail').DataTable().destroy();
        loadData(startDate, endDate);
      }
    }
  });

  $("#btn-reset-filter").click(function() {
    filter.clear();
    $('#table-job-detail').DataTable().destroy();
    loadData();
  });
});
