@extends('layout.master')

@section('title', 'Project Tracking')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/buttons.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h3 class="mb-0 ">Project Tracking</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-md-flex border-bottom-0">
        <div class="flex-grow-1">
          <h3 class="m-0">{{ $job->code }} - {{ $user->name }}</h3>
        </div>
        <div class="mt-3 mt-md-0 d-flex align-items-center">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('project-tracking::index') }}">Project Tracking</a></li>
            <li class="breadcrumb-item"><a id="job-code" href="{{ route('project-tracking::detailPerJob', ['jobId' => $job->id]) }}">{{ $job->code }}</a></li>
            <li class="breadcrumb-item active" aria-current="page" id="user-name">{{ $user->name }}</li>
          </ol>
        </div>
      </div>
      <div class="card-header border-top border-2 border-bottom-0">
        <div class="row">
          <div class="col-10 col-sm-8 col-lg-5">
            <input type="text" class="form-control" id="filter-date" placeholder="Filter Date">
          </div>
          <div class="col-2 col-sm-4">
            <button class="btn btn-outline-dark border-1" id="btn-reset-filter">Reset</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive table-card">
          <table id="table-job-detail-user" class="table text-nowrap table-centered mt-0 w-100">
            <thead class="table-light">
              <th>Date</th>
              <th>Description</th>
              <th>Hour</th>
              <th>Rate per Hour</th>
              <th>Cost</th>
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
@endsection

@section('js')
<script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs5/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs5/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs5/js/export.js') }}"></script>
<script src="{{ asset('assets/libs/flatpickr/flatpickr.js') }}"></script>
@vite('resources/js/project-tracking/detail/user.js')
@endsection
