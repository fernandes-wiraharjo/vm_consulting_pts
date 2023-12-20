@extends('layout.master')

@section('title', 'Add User')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h3 class="mb-0 ">Add User</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ route('user::store') }}">
          @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Role <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <select class="form-select @if ($errors->has('role')) is-invalid @endif" name="role">
                <option selected hidden disabled></option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ (collect(old('role'))->contains($role->id)) ? 'selected':'' }}>{{ $role->name }}</option>
                @endforeach
              </select>
              @if($errors->has('role'))
                <div class="invalid-feedback">{{ $errors->first('role') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Position <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <select class="form-select @if ($errors->has('role')) is-invalid @endif" name="position">
                <option selected hidden disabled></option>
                @foreach ($positions as $position)
                <option value="{{ $position->id }}" {{ (collect(old('position'))->contains($position->id)) ? 'selected':'' }}>{{ $position->name }}</option>
                @endforeach
              </select>
              @if($errors->has('position'))
                <div class="invalid-feedback">{{ $errors->first('position') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Name <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name') }}">
              @if($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Rate per Hour <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control autonumeric @if ($errors->has('rate_per_hour')) is-invalid @endif" name="rate_per_hour" value="{{ old('rate_per_hour') }}" autocomplete="off">
              @if($errors->has('rate_per_hour'))
                <div class="invalid-feedback">{{ $errors->first('rate_per_hour') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Username <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control @if ($errors->has('user_name')) is-invalid @endif" name="user_name" value="{{ old('user_name') }}">
              @if($errors->has('user_name'))
                <div class="invalid-feedback">{{ $errors->first('user_name') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Password <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <input type="password" class="form-control @if ($errors->has('password')) is-invalid @endif" name="password">
              @if($errors->has('password'))
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <button class="btn btn-primary me-2" type="submit">Submit</button>
              <a href="{{ route('user::index') }}" class="btn btn-outline-dark">Cancel</a>
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
@vite('resources/js/user/index.js')
@endsection
