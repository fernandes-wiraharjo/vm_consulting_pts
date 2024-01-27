$(document).ready(function () {
  $('#table-daily-task-detail').DataTable({
    dom: "<'row'<'col-sm-12 col-md-7 d-flex align-items-center ps-5'Bl><'col-sm-12 col-md-5'f>>" +
          "<'row'<'col-sm-12 px-5 py-2 total-hour'>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>" +
          "<'row'<'col-sm-12 px-5 py-3 total-hour'>>",
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

  const totalHour = $("#total-hour").data("total-hour");
  $("div.total-hour").html(`
    <h4 class='m-0'>Total Hour : ${totalHour}</h4>
  `);

  $("#table-daily-task-detail").on("click", ".btn-delete", function() {
    const name = $(this).data("name");
    const url = $(this).data("url");

    $("#name").text(name);
    $("#delete").attr("href", url);
    $("#modal-toggle-activate").modal("show");
  });
});
