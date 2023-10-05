<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      @role('admin')
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('admin.roles.index') }}" class="nav-link">Roles</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('admin.permissions.index') }}" class="nav-link">Permissions</a>
        </li>
      @endrole

        <!-- Settings Dropdown -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="/profile" class="nav-link">{{ Auth::user()->name }}</a> 
          </li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a class="nav-link" href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
              </a>
            </form>
          </li>
        </ul>
      
    </ul>
  </nav>