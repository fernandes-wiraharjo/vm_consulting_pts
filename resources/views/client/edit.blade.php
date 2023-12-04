@extends('layout.master')

@section('title', 'Edit Client')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h3 class="mb-0 ">Edit Client</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ route('client::update', ['clientId' => $client->id]) }}">
          @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Code <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control @if ($errors->has('code')) is-invalid @endif" name="code" value="{{ old('code') ?? $client->code }}">
              @if($errors->has('code'))
                <div class="invalid-feedback">{{ $errors->first('code') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Name <span class="text-danger">(*)</span></label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name') ?? $client->name }}">
              @if($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Email</label>
            <div class="col-sm-12 col-md-7">
              <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email') ?? $client->email }}">
              @if($errors->has('email'))
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Phone Number</label>
            <div class="col-sm-12 col-md-7">
              <input type="number" class="form-control @if ($errors->has('phone')) is-invalid @endif" name="phone" value="{{ old('phone') ?? $client->phone }}">
              @if($errors->has('phone'))
                <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">PIC</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control @if ($errors->has('pic')) is-invalid @endif" name="pic" value="{{ old('pic') ?? $client->pic }}">
              @if($errors->has('pic'))
                <div class="invalid-feedback">{{ $errors->first('pic') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Address</label>
            <div class="col-sm-12 col-md-7">
              <textarea name="address" class="form-control @if ($errors->has('address')) is-invalid @endif">{{ old('address') ?? $client->address }}</textarea>
              @if($errors->has('address'))
                <div class="invalid-feedback">{{ $errors->first('address') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-end col-12 col-md-3 col-lg-3">Description</label>
            <div class="col-sm-12 col-md-7">
              <textarea name="description" class="form-control @if ($errors->has('description')) is-invalid @endif">{{ old('description') ?? $client->description }}</textarea>
              @if($errors->has('description'))
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <button class="btn btn-info me-2" type="submit">Save</button>
              <a href="{{ route('client::index') }}" class="btn btn-outline-dark">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
