$(document).ready(function () {
  function loadData(filterStartDate = '', filterEndDate = '') {
    $('#table-job-detail').DataTable({
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
