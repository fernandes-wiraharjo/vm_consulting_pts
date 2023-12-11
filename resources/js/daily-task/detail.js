$(document).ready(function () {
  $('#table-daily-task-detail').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    stateServe: true,
    ajax: {
      url: window.location.href
    },
    columns: [
      {
        data: "code",
        name: "jobs.code"
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
        data: "action",
        name: "action",
        orderable: false,
        searchable: false
      }
    ],
  });

  $("#table-daily-task-detail").on("click", ".btn-delete", function() {
    const name = $(this).data("name");
    const url = $(this).data("url");

    $("#name").text(name);
    $("#delete").attr("href", url);
    $("#modal-toggle-activate").modal("show");
  });
});
