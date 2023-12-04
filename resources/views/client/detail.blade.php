@extends('layout.master')

@section('title', 'Detail Client')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
      <h3 class="mb-0 ">Detail Client</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body border-bottom">
        <div class="d-flex justify-content-between ">
          <div>
            <div class="mt-1">
              <h3 class="mb-0 fs-4" id="view-detail-company-name">{{ $client->name }}</h3>
              <p class="mb-0">{{ $client->code }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body ">
        <h4 class="mb-0">About Company</h4>
        <p>{{ $client->description ?? '-' }}</p>
        
        <h4 class="mb-0">PIC</h4>
        <p>{{ $client->pic ?? '-' }}</p>
        
        <h4 class="mb-0">Email</h4>
        <p>{{ $client->email ?? '-' }}</p>
        
        <h4 class="mb-0">Phone</h4>
        <p>{{ $client->phone ?? '-' }}</p>
        
        <h4 class="mb-0">Address</h4>
        <p>{{ $client->address ?? '-' }}</p>
      </div>
    </div>
  </div>
</div>
@endsection
