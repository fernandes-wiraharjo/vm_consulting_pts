@extends('layout.master')

@section('title', 'Daily Task')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/select2.min.css') }}">
<style>
  .select2-container, .select2-selection, .select2-selection__arrow {
    height: 100% !important;
  }
  .select2-selection {
    display: flex !important;
    align-items: center !important;
  }
</style>
@endsection

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
      @if (auth()->user()->role()->name === 'admin')
      <input type="hidden" id="id-user" value="{{ auth()->user()->id }}">
      <div class="card-header border-top border-2 border-bottom-0">
        <div class="row">
          <div class="col-12 col-sm-8 col-lg-5 mb-2 mb-sm-0">
            <select class="form-select filter-user">
              <option></option>
              @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ $user->id === auth()->user()->id ? 'selected' : '' }}>{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 col-sm-4">
            <button class="btn btn-outline-dark border-1" id="btn-reset-filter">Reset</button>
          </div>
        </div>
      </div>
      @endif
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
<script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
@vite('resources/js/daily-task/index.js')
@endsection
