$(document).ready(function () {
  $('#table-role').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    stateServe: true,
    ajax: {
      url: "/role"
    },
    columns: [
      {
        data: "code",
        name: "code"
      },
      {
        data: "name",
        name: "name"
      },
      {
        data: "action",
        name: "action",
        orderable: false,
        searchable: false
      }
    ],
  });

  $("#table-role").on("click", ".btn-delete", function() {
    const name = $(this).data("name");
    const url = $(this).data("url");

    $("#name").text(name);
    $("#delete").attr("href", url);
    $("#modal-confirmation-delete").modal("show");
  });
});
