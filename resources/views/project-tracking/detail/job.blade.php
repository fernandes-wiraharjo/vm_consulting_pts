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
          <h3 class="m-0">{{ $job->code }}</h3>
        </div>
        <div class="mt-3 mt-md-0 d-flex align-items-center">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('project-tracking::index') }}">Project Tracking</a></li>
            <li class="breadcrumb-item active" aria-current="page" id="job-code">{{ $job->code }}</li>
          </ol>
        </div>
      </div>
      <div class="card-header border-top border-2 border-bottom-0">
        <div class="row">
          <div class="col-12 col-sm-8 col-lg-5 mb-2 mb-sm-0">
            <input type="text" class="form-control" id="filter-date" placeholder="Filter Date">
          </div>
          <div class="col-12 col-sm-4">
            <button class="btn btn-outline-dark border-1" id="btn-reset-filter">Reset</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive table-card">
          <table id="table-job-detail" class="table text-nowrap table-centered mt-0 w-100">
            <thead class="table-light">
              <th>User</th>
              <th>Total Hours</th>
              <th>Total Costs</th>
              <th>Action</th>
            </thead>
            <tbody>
            </tbody>
            <tfoot class="table-light d-none">
              <tr>
                <th></th>
                <th>Grand Total Costs</th>
                <th id="grand-total-cost"></th>
                <th></th>
              </tr>
            </tfoot>
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
@vite('resources/js/project-tracking/detail/job.js')
@endsection
