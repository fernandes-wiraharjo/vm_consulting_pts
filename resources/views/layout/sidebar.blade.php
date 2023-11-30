<div class="h-100" data-simplebar>
  <!-- Brand logo -->
  <a class="navbar-brand" href="{{ route('home') }}" style="padding: 15px 1.5rem">
    <h4 class="m-0" style="font-size: 20px">VM Consulting</h4>
  </a>
  <!-- Navbar nav -->
  <ul class="navbar-nav flex-column" id="sideNavbar">
    <!-- Nav item -->
    <li class="nav-item">
      <a href="{{ route('home') }}" class="nav-link has-arrow {{ in_array(Route::currentRouteName(), ['home']) ? 'active' : '' }}">
        <i data-feather="home" class="nav-icon me-2 icon-xxs">
        </i> Home
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link has-arrow">
        <i data-feather="menu" class="nav-icon me-2 icon-xxs">
        </i> Menu
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link has-arrow">
        <i data-feather="menu" class="nav-icon me-2 icon-xxs">
        </i> Menu
      </a>
    </li>
  </ul>
</div>
