$(document).ready(function () {
  $('#table-daily-task').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    stateServe: true,
    ajax: {
      url: "/daily-task"
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
});
