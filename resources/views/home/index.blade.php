@extends('layout.master')

@section('title', 'Home')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h3 class="mb-0 ">Home</h3>
    </div>
  </div>
</div>
<div class="bg-primary rounded-3">
  <div class="row mb-5 ">
    <div class="col-lg-12 col-md-12 col-12">
      <div class="p-6 d-lg-flex justify-content-between align-items-center ">
        <div class="d-md-flex align-items-center">
          <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Image" class="rounded-circle avatar avatar-xl">
          <div class="ms-md-4 mt-3 mt-md-0 lh-1">
            <h3 class="text-white mb-0">Good afternoon, Jitu Chauhan</h3>
            <small class="text-white"> Here is what’s happening with your projects today:</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
