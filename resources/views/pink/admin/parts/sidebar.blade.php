<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @can('View Sliders')
            <li class="nav-item">
              <a href="{{ route('admin.sliders.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sliders</p>
              </a>
            </li>
          @endcan

          @can('View PortfolioCategories')
            <li class="nav-item">
              <a href="{{ route('admin.portfolio-categories.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Categories (portfolio)</p>
              </a>
            </li>
          @endcan

          @can('View Portfolio')
            <li class="nav-item">
              <a href="{{ route('admin.portfolio.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Portfolio</p>
              </a>
            </li>
          @endcan
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>