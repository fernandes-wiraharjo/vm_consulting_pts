$(document).ready(function () {
  $('#table-job-detail').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    stateServe: true,
    ajax: {
      url: window.location.pathname
    },
    columns: [
      {
        data: "user_name",
        name: "users.name"
      },
      {
        data: "total_hour",
        name: "total_hour"
      },
      {
        data: "total_cost",
        name: "total_cost"
      },
      {
        data: "action",
        name: "action",
        orderable: false,
        searchable: false
      }
    ],
  });
});
