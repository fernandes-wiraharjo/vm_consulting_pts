@extends('layout.master')

@section('title', 'Edit User Rate')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h3 class="mb-0 ">Edit User Rate</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ route('user-rate::update', ['userRateId' => $user_rate->id]) }}">
          @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">User <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <select class="form-select @if ($errors->has('user')) is-invalid @endif" name="user">
                <option selected hidden disabled></option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ (collect(old('user'))->contains($user->id)) || $user->id == $user_rate->id_user ? 'selected':'' }}>{{ $user->name }}</option>
                @endforeach
              </select>
              @if($errors->has('user'))
                <div class="invalid-feedback">{{ $errors->first('user') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Rate per Hour <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control autonumeric @if ($errors->has('rate_per_hour')) is-invalid @endif" name="rate_per_hour" value="{{ old('rate_per_hour') ?? $user_rate->default_rate_per_hour }}" autocomplete="off">
              @if($errors->has('rate_per_hour'))
                <div class="invalid-feedback">{{ $errors->first('rate_per_hour') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <button class="btn btn-info me-2" type="submit">Save</button>
              <a href="{{ route('user-rate::index') }}" class="btn btn-outline-dark">Cancel</a>
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
@vite('resources/js/user-rate/index.js')
@endsection
