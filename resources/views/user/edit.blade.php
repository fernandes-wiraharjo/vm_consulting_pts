@extends('layout.master')

@section('title', 'Edit User')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h3 class="mb-0 ">Edit User</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ route('user::update', ['userId' => $user->id]) }}">
          @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Role <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <select class="form-select @if ($errors->has('role')) is-invalid @endif" name="role">
                <option selected hidden disabled></option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ (collect(old('role'))->contains($role->id)) || $role->id == $user->id_role ? 'selected':'' }}>{{ $role->name }}</option>
                @endforeach
              </select>
              @if($errors->has('role'))
                <div class="invalid-feedback">{{ $errors->first('role') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Name <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name') ?? $user->name }}">
              @if($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Username <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control @if ($errors->has('user_name')) is-invalid @endif" name="user_name" value="{{ old('user_name') ?? $user->user_name }}">
              @if($errors->has('user_name'))
                <div class="invalid-feedback">{{ $errors->first('user_name') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Password</label>
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
              <button class="btn btn-info me-2" type="submit">Save</button>
              <a href="{{ route('user::index') }}" class="btn btn-outline-dark">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
