$(document).ready(function () {
  function loadData(filterStartDate = '', filterEndDate = '') {
    $('#table-job-detail-user').DataTable({
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
    });
  }

  loadData();

  function formatDate(dateString) {
    const dateObject = new Date(dateString);

    // Ambil komponen tanggal, bulan, dan tahun
    const year = dateObject.getFullYear();
    const month = String(dateObject.getMonth() + 1).padStart(2, '0'); // Tambah 1 karena bulan dimulai dari 0
    const day = String(dateObject.getDate()).padStart(2, '0');

    // Bentuk string dalam format "YYYY-MM-DD"
    const formattedDate = `${year}-${month}-${day}`;
    return formattedDate;
  }

  let filter = $("#filter-date").flatpickr({
    mode: "range",
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d F Y",
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
    filter.clear();
    $('#table-job-detail-user').DataTable().destroy();
    loadData();
  });
});
