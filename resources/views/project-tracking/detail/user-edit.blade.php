@extends('layout.master')

@section('title', 'Project Tracking')

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
      <div class="card-header d-md-flex">
        <div class="flex-grow-1">
          <h3 class="m-0">{{ $job->code }} - {{ $user->name }}</h3>
        </div>
        <div class="mt-3 mt-md-0 d-flex align-items-center">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('project-tracking::index') }}">Project Tracking</a></li>
            <li class="breadcrumb-item"><a href="{{ route('project-tracking::detailPerJob', ['jobId' => $job->id]) }}">{{ $job->code }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('project-tracking::detailPerUser', ['jobId' => $job->id, 'userId' => $user->id]) }}">{{ $user->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
          </ol>
        </div>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('project-tracking::updateDetailPerUser', ['jobId' => $job->id, 'userId' => $user->id, 'jobDetailId' => $job_detail->id]) }}">
          @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Date</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" value="{{ date('d M Y', strtotime($job_detail->date)) }}" disabled readonly>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Description</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" value="{{ $job_detail->description }}" disabled readonly>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Hour</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control hour" value="{{ $job_detail->hour }}" disabled readonly>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Rate per Hour <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control autonumeric rate-per-hour @if ($errors->has('rate_per_hour')) is-invalid @endif" name="rate_per_hour" value="{{ $job_detail->rate_per_hour }}" autocomplete="off">
              @if($errors->has('rate_per_hour'))
                <div class="invalid-feedback">{{ $errors->first('rate_per_hour') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Cost</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control cost @if ($errors->has('cost')) is-invalid @endif" name="cost" data-value="{{ $job_detail->cost }}" readonly style="background-color: #e2e8f0;">
              @if($errors->has('cost'))
                <div class="invalid-feedback">{{ $errors->first('cost') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <button class="btn btn-info me-2" type="submit">Save</button>
              <a href="{{ route('project-tracking::detailPerUser', ['jobId' => $job->id, 'userId' => $user->id]) }}" class="btn btn-outline-dark">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/libs/autonumeric/autoNumeric.min.js') }}"></script>
@vite('resources/js/project-tracking/detail/user-edit.js')
@endsection
