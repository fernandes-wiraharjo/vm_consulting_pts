<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sign In | VM Consulting</title>
  <!-- Libs CSS -->
  <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/@mdi/font/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}">
  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
</head>

<body>
  <!-- container -->
  <main class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0 min-vh-100">
      <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
        @if (session('failed'))
        <div class="alert alert-danger" role="alert">
          {{ session('failed') }}
        </div>
        @endif
        <!-- Card -->
        <div class="card smooth-shadow-md">
          <!-- Card body -->
          <div class="card-body p-6">
            <div class="mb-4">
              <a href="#"><h3 class="m-0">VM Consulting</h3></a>
              <p class="mb-6">Please enter your user information</p>
            </div>
            <!-- Form -->
            <form action="{{ route('do-login') }}" method="POST">
              @csrf
              <!-- Email -->
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" class="form-control @if ($errors->has('username')) is-invalid @endif" name="username" value="{{ old('username') }}" autofocus>
                @if($errors->has('username'))
                  <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                @endif
              </div>
              <!-- Password -->
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control @if ($errors->has('password')) is-invalid @endif" name="password">
                @if($errors->has('password'))
                  <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                @endif
              </div>

              <!-- Button -->
              <div class="d-grid mt-5">
                <button type="submit" class="btn btn-primary">Sign in</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Scripts -->
  <!-- Libs JS -->
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/libs/feather-icons/dist/feather.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
  <!-- Theme JS -->
  <script src="{{ asset('assets/js/theme.min.js') }}"></script>
</body>

</html>
