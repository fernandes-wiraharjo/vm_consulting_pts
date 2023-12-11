@extends('layout.master')

@section('title', 'Edit Daily Task')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h3 class="mb-0 ">Edit Daily Task</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ route('daily-task::update', ['jobDetailId' => $daily_task->id]) }}">
          @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Job Number <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <select class="form-select @if ($errors->has('job_number')) is-invalid @endif" name="job_number">
                <option selected hidden disabled></option>
                @foreach ($jobs as $job)
                <option value="{{ $job->id }}" {{ (collect(old('job_number'))->contains($job->id)) || $job->id == $daily_task->id_job ? 'selected':'' }}>{{ $job->code }}</option>
                @endforeach
              </select>
              @if($errors->has('job_number'))
                <div class="invalid-feedback">{{ $errors->first('job_number') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Description <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <textarea name="description" class="form-control @if ($errors->has('description')) is-invalid @endif">{{ old('description') ?? $daily_task->description }}</textarea>
              @if($errors->has('description'))
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Date <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <input type="text" name="date" class="form-control date @if ($errors->has('date')) is-invalid @endif" value="{{ old('date') ?? $daily_task->date }}">
              @if($errors->has('date'))
                <div class="invalid-feedback">{{ $errors->first('date') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Hour <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <input type="text" name="hour" class="form-control hour @if ($errors->has('hour')) is-invalid @endif" value="{{ old('hour') ?? $daily_task->hour }}">
              @if($errors->has('hour'))
                <div class="invalid-feedback">{{ $errors->first('hour') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <button class="btn btn-info me-2" type="submit">Save</button>
              <a href="{{ url()->previous() }}" class="btn btn-outline-dark">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/libs/flatpickr/flatpickr.js') }}"></script>
@vite('resources/js/daily-task/create.js')
@endsection
