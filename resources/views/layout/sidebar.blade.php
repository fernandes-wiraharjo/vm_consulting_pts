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
    @if (auth()->user()->role()->code === 'ADM')
    <li class="nav-item">
      <a href="{{ route('role::index') }}" class="nav-link has-arrow {{ in_array(Route::currentRouteName(), ['role::index', 'role::create', 'role::edit']) ? 'active' : '' }}">
        <i data-feather="settings" class="nav-icon me-2 icon-xxs">
        </i> Role
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('position::index') }}" class="nav-link has-arrow {{ in_array(Route::currentRouteName(), ['position::index', 'position::create', 'position::edit']) ? 'active' : '' }}">
        <i data-feather="credit-card" class="nav-icon me-2 icon-xxs">
        </i> Position
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('user::index') }}" class="nav-link has-arrow {{ in_array(Route::currentRouteName(), ['user::index', 'user::create', 'user::edit']) ? 'active' : '' }}">
        <i data-feather="users" class="nav-icon me-2 icon-xxs">
        </i> User
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('client::index') }}" class="nav-link has-arrow {{ in_array(Route::currentRouteName(), ['client::index', 'client::create', 'client::edit', 'client::detail']) ? 'active' : '' }}">
        <i data-feather="briefcase" class="nav-icon me-2 icon-xxs">
        </i> Client
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('project-tracking::index') }}" class="nav-link has-arrow {{ in_array(Route::currentRouteName(), ['project-tracking::index', 'project-tracking::create', 'project-tracking::edit', 'project-tracking::detailPerJob', 'project-tracking::detailPerUser', 'project-tracking::editDetailPerUser']) ? 'active' : '' }}">
        <i data-feather="file-text" class="nav-icon me-2 icon-xxs">
        </i> Project Tracking
      </a>
    </li>
    @endif
    <li class="nav-item">
      <a href="{{ route('daily-task::index') }}" class="nav-link has-arrow {{ in_array(Route::currentRouteName(), ['daily-task::index', 'daily-task::detail', 'daily-task::create', 'daily-task::edit']) ? 'active' : '' }}">
        <i data-feather="check-square" class="nav-icon me-2 icon-xxs">
        </i> Daily Task
      </a>
    </li>
  </ul>
</div>
