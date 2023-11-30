<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title') | VM Consulting</title>
  <!-- Libs CSS -->
  <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/@mdi/font/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}">
  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
  <!-- Pages CSS -->
  @yield('css')
</head>

<body>
  <main id="main-wrapper" class="main-wrapper">
    <!-- Header -->
    <div class="header">
      @include('layout.header')
    </div>

    <!-- Sidebar -->
    <div class="navbar-vertical navbar nav-dashboard">
      @include('layout.sidebar')
    </div>

    <!-- Page Content -->
    <div id="app-content">
      <div class="app-content-area">
        <div class="container-fluid">
          @yield('content')
        </div>
      </div>
    </div>
  </main>

  <!-- Libs JS -->
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/libs/feather-icons/dist/feather.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
  <!-- Theme JS -->
  <script src="{{ asset('assets/js/theme.min.js') }}"></script>
  <!-- jsvectormap -->
  <script src="{{ asset('assets/libs/jsvectormap/dist/js/jsvectormap.min.js') }}"></script>
  <script src="{{ asset('assets/libs/jsvectormap/dist/maps/world.js') }}"></script>
  <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/js/vendors/chart.js') }}"></script>
  <!-- Pages JS -->
  @yield('js')
</body>

</html>
