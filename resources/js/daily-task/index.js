$(document).ready(function () {
  function loadData(filterUser = '') {
    $("#table-daily-task").DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      stateServe: true,
      ajax: {
        url: "/daily-task",
        data: {
          userId: filterUser
        }
      },
      columns: [
        {
          data: "date",
          name: "date"
        },
        {
          data: "total_hour",
          name: "total_hour",
          searchable: false
        },
        {
          data: "action",
          name: "action",
          orderable: false,
          searchable: false
        }
      ]
    });
  }

  loadData();

  $(".filter-user").select2({
    placeholder: "Filter User",
    minimumInputLength: 0
  });

  $(".filter-user").on("change", function () {
    const userId = $(this).val();
    $("#table-daily-task").DataTable().destroy();
    loadData(userId);
  });

  $("#btn-reset-filter").click(function() {
    $('.filter-user').val($("#id-user").val()).trigger('change.select2');
    $("#table-daily-task").DataTable().destroy();
    loadData();
  });
});
