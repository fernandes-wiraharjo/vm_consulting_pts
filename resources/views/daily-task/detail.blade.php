@extends('layout.master')

@section('title', 'Daily Task')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    <!-- Page header -->
    <div class="mb-5">
      <h3 class="mb-0 ">Daily Task - {{ $user->name }} - {{ date('D, d M Y', strtotime($date)) }}</h3>
      <div id="total-hour" data-total-hour="{{ $total_hour }}"></div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-md-flex border-bottom-0">
        <div class="flex-grow-1">
          <a href="{{ route('daily-task::create', ['date' => $date]) }}" class="btn btn-sm btn-primary">Add</a>
        </div>
        <div class="mt-3 mt-md-0 d-flex align-items-center">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('daily-task::index') }}">Daily Task</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ date('D, d M Y', strtotime($date)) }}</li>
          </ol>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive table-card">
          <table id="table-daily-task-detail" class="table text-nowrap table-centered mt-0 w-100">
            <thead class="table-light">
              <th>Job Number</th>
              <th>Description</th>
              <th>Duration</th>
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
        Are you sure want to <strong>delete</strong> daily task <strong id="name"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
        <a id="delete" class="btn btn-danger">Yes</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
@vite('resources/js/daily-task/detail.js')
@endsection
