$(document).ready(function () {
  $('#table-job-detail-user').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    stateServe: true,
    ajax: {
      url: window.location.pathname
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
});
