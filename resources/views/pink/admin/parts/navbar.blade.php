<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    {!! $menuInNavbar->asUl(['class' => 'navbar-nav']) !!}

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
  </nav>