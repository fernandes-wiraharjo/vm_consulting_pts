$(document).ready(function () {
  $('#table-project-tracking').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    stateServe: true,
    ajax: {
      url: "/project-tracking"
    },
    columns: [
      {
        data: "created_date",
        name: "created_date"
      },
      {
        data: "code",
        name: "code"
      },
      {
        data: "description",
        name: "description"
      },
      {
        data: "client_name",
        name: "clients.name"
      },
      {
        data: "status",
        name: "status"
      },
      {
        data: "total_hours",
        name: "total_hours"
      },
      {
        data: "total_costs",
        name: "total_costs"
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
    order: [[0, 'desc']],
  });

  $("#table-project-tracking").on("click", ".btn-delete", function() {
    const name = $(this).data("name");
    const isActive = $(this).data("is-active");
    const btnColor = $(this).data("btn-color");
    const url = $(this).data("url");

    let status = 'Activate';
    if (isActive) {
      status = 'Deactive';
    }

    $("#name").text(name);
    $("#status").text(status);
    $("#delete").attr("href", url);
    $("#delete").addClass(btnColor);
    $("#modal-toggle-activate").modal("show");
  });
});
