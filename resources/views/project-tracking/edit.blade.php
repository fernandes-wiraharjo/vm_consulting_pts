@extends('layout.master')

@section('title', 'Edit Project Tracking')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h3 class="mb-0 ">Edit Project Tracking</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ route('project-tracking::update', ['jobId' => $job->id]) }}">
          @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Client <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <select class="form-select @if ($errors->has('client')) is-invalid @endif" name="client">
                <option selected hidden disabled></option>
                @foreach ($clients as $client)
                <option value="{{ $client->id }}" {{ (collect(old('client'))->contains($client->id)) || $client->id == $job->id_client ? 'selected':'' }}>{{ $client->name }}</option>
                @endforeach
              </select>
              @if($errors->has('client'))
                <div class="invalid-feedback">{{ $errors->first('client') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Job Number <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control @if ($errors->has('job_number')) is-invalid @endif" name="job_number" value="{{ old('job_number') ?? $job->code }}">
              @if($errors->has('job_number'))
                <div class="invalid-feedback">{{ $errors->first('job_number') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Description</label>
            <div class="col-sm-12 col-md-7">
              <textarea name="description" class="form-control @if ($errors->has('description')) is-invalid @endif">{{ old('description') ?? $job->description }}</textarea>
              @if($errors->has('description'))
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Status <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7 d-flex align-items-center">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="open" value="open" {{ $job->status === 'open' ? 'checked' : '' }}>
                <label class="form-check-label" for="open">Open</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="close" value="close" {{ $job->status === 'close' ? 'checked' : '' }}>
                <label class="form-check-label" for="close">Close</label>
              </div>
              @if($errors->has('description'))
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <button class="btn btn-info me-2" type="submit">Save</button>
              <a href="{{ route('project-tracking::index') }}" class="btn btn-outline-dark">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
