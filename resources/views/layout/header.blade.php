<div class="navbar-custom navbar navbar-expand-lg">
  <div class="container-fluid px-0">
    <a class="navbar-brand d-block d-md-none" href="{{ route('home') }}">
      <h4 class="m-0" style="font-size: 20px">VM Consulting</h4>
    </a>

    <a id="nav-toggle" href="dashboard-analytics.html#!" class="ms-auto ms-md-0 me-0 me-lg-3 ">
      <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
        class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">
        <path
          d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
      </svg>
    </a>

    <!--Navbar nav -->
    <ul class="navbar-nav navbar-right-wrap ms-lg-auto d-flex nav-top-wrap align-items-center ms-4 ms-lg-0">
      <li>
        <h5 class="m-0 me-3">{{ auth()->user()->name }}</h5>
      </li>
      <li>
        <a href="dashboard-analytics.html#" class="form-check form-switch theme-switch btn btn-ghost btn-icon rounded-circle mb-0 ">
          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
          <label class="form-check-label" for="flexSwitchCheckDefault"></label>
        </a>
      </li>

      <!-- List -->
      <li class="dropdown ms-2">
        <a class="rounded-circle" href="dashboard-analytics.html#!" role="button" id="dropdownUser"
          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="avatar avatar-md">
            <img alt="avatar" src="{{ asset('assets/images/avatar/user.jpg') }}" class="rounded-circle">
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
          <ul class="list-unstyled">
            <li>
              <a class="dropdown-item" href="{{ route('do-logout') }}">
                <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>Sign Out
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>
