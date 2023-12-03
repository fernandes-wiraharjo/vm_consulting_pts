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
  <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/izitoast/css/iziToast.min.css') }}">
  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
  <!-- Pages CSS -->
  @yield('css')
</head>

<body>
  <main id="main-wrapper" class="main-wrapper" @if (session('success')) data-notif-success="{{session('success')}}" @else data-notif-success="" @endif 
    @if (session('failed')) data-notif-failed="{{session('failed')}}" @else data-notif-failed="" @endif>
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
  <script src="{{ asset('assets/libs/datatables/media/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/libs/izitoast/js/iziToast.min.js') }}"></script>
  <!-- Theme JS -->
  <script src="{{ asset('assets/js/theme.min.js') }}"></script>
  <!-- izi toast -->
  <script>
    const messageNotifSuccess = $('body #main-wrapper').data("notif-success");
    const messageNotifFailed = $('body #main-wrapper').data("notif-failed");

    if (messageNotifSuccess != "") {
      iziToast.success({
        title: 'Success',
        message: messageNotifSuccess,
        position: 'topRight',
      });
    }

    if (messageNotifFailed != "") {
      iziToast.error({
        title: 'Failed',
        message: messageNotifFailed,
        position: 'topRight',
      });
    }
  </script>
  <!-- Pages JS -->
  @yield('js')
</body>

</html>
