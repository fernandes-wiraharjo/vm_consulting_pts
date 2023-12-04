$(document).ready(function () {
  $('#table-user').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    stateServe: true,
    ajax: {
      url: "/user"
    },
    columns: [
      {
        data: "name",
        name: "name"
      },
      {
        data: "user_name",
        name: "user_name"
      },
      {
        data: "role_name",
        name: "roles.name"
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

  $("#table-user").on("click", ".btn-delete", function() {
    const name = $(this).data("name");
    const isActive = $(this).data("is-active");
    const btnColor = $(this).data("btn-color");
    const url = $(this).data("url");

    let status = 'activate';
    if (isActive) {
      status = 'deactive';
    }

    $("#name").text(name);
    $("#status").text(status);
    $("#delete").attr("href", url);
    $("#delete").addClass(btnColor);
    $("#modal-toggle-activate").modal("show");
  });
});
