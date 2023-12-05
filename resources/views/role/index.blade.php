@extends('layout.master')

@section('title', 'Role')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h3 class="mb-0 ">Role</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('role::create') }}" class="btn btn-sm btn-primary">Add</a>
      </div>
      <div class="card-body">
        <div class="table-responsive table-card">
          <table id="table-role" class="table text-nowrap table-centered mt-0 w-100">
            <thead class="table-light">
              <th>Code</th>
              <th>Name</th>
              <th>Status</th>
              <th>Action</th>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-toggle-activate" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to <strong id="status"></strong> role <strong id="name"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
        <a id="delete" class="btn">Yes</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
@vite('resources/js/role/index.js')
@endsection
