$(document).ready(function () {
  $('#table-client').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    stateServe: true,
    ajax: {
      url: "/client"
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
        data: "email",
        name: "email"
      },
      {
        data: "is_active",
        name: "is_active",
        orderable: false,
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

  $("#table-client").on("click", ".btn-delete", function() {
    const name = $(this).data("name");
    const url = $(this).data("url");

    $("#name").text(name);
    $("#delete").attr("href", url);
    $("#modal-toggle-activate").modal("show");
  });
});
