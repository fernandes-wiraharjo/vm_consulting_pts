@extends('layout.master')

@section('title', 'Add Project Tracking')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h3 class="mb-0 ">Add Project Tracking</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ route('project-tracking::store') }}">
          @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Client <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <select class="form-select @if ($errors->has('client')) is-invalid @endif" name="client">
                <option selected hidden disabled></option>
                @foreach ($clients as $client)
                <option value="{{ $client->id }}" {{ (collect(old('client'))->contains($client->id)) ? 'selected':'' }}>{{ $client->name }}</option>
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
              <input type="text" class="form-control @if ($errors->has('job_number')) is-invalid @endif" name="job_number" value="{{ old('job_number') }}">
              @if($errors->has('job_number'))
                <div class="invalid-feedback">{{ $errors->first('job_number') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Description</label>
            <div class="col-sm-12 col-md-7">
              <textarea name="description" class="form-control @if ($errors->has('description')) is-invalid @endif">{{ old('description') }}</textarea>
              @if($errors->has('description'))
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <button class="btn btn-primary me-2" type="submit">Submit</button>
              <a href="{{ route('project-tracking::index') }}" class="btn btn-outline-dark">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
