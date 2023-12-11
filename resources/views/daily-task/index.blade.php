@extends('layout.master')

@section('title', 'Daily Task')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h3 class="mb-0 ">Daily Task</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('daily-task::create') }}" class="btn btn-sm btn-primary">Add</a>
      </div>
      <div class="card-body">
        <div class="table-responsive table-card">
          <table id="table-daily-task" class="table text-nowrap table-centered mt-0 w-100">
            <thead class="table-light">
              <th>Date</th>
              <th>Total Hours</th>
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
@vite('resources/js/daily-task/index.js')
@endsection
