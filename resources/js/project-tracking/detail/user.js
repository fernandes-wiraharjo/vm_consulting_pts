$(document).ready(function () {
  let urlParams = new URLSearchParams(window.location.search);
  const filterStartDate = urlParams.get('startDate');
  const filterEndDate = urlParams.get('endDate');

  function loadData(filterStartDate, filterEndDate) {
    const fileName = $("#job-code").text() + ' ' + $("#user-name").text();

    $('#table-job-detail-user').DataTable({
      dom: "<'row'<'col-sm-12 col-md-7 d-flex align-items-center ps-5'Bl><'col-sm-12 col-md-5'f>>" +
          "<'row'<'col-sm-12 px-5 py-2 total-cost'>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>" +
          "<'row'<'col-sm-12 px-5 py-3 total-cost'>>",
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
          data: "date",
          name: "date"
        },
        {
          data: "description",
          name: "description"
        },
        {
          data: "hour",
          name: "hour"
        },
        {
          data: "rate_per_hour",
          name: "rate_per_hour"
        },
        {
          data: "cost",
          name: "cost"
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
            columns: [0, 1, 2, 3, 4],
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
        type: 'total-cost'
      },
      success: function(data){
        $("div.total-cost").html(`
          <h4 class='m-0'>Total Costs : ${data}</h4>
        `);

        $("#total-cost").text(data);
      }
    });
  }

  loadData(filterStartDate, filterEndDate);

  let filter = $("#filter-date").flatpickr({
    mode: "range",
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d F Y",
    defaultDate: [filterStartDate, filterEndDate],
    onChange: function(dates) {
      if (dates.length == 2) {
        const startDate = formatDate(dates[0]);
        const endDate = formatDate(dates[1]);

        $('#table-job-detail-user').DataTable().destroy();
        loadData(startDate, endDate);
      }
    }
  });

  $("#btn-reset-filter").click(function() {
    if (filterStartDate && filterEndDate) {
      let url = window.location.href;
      window.location.href = url.split('?')[0];
    } else {
      filter.clear();
      $('#table-job-detail-user').DataTable().destroy();
      loadData();
    }
  });
});
