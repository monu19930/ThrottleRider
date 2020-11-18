<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="{{route('admin-dashboard')}}">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.riders')}}">
              <span data-feather="file"></span>
              Riders
            </a>                
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.bikes')}}">
              <span data-feather="file"></span>
              Bikes
            </a>                
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.rides')}}">
              <span data-feather="file"></span>
              Rides
            </a>                
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.groups')}}">
              <span data-feather="file"></span>
              Groups
            </a>                
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.events')}}">
              <span data-feather="file"></span>
              Events
            </a>                
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.suppliers')}}">
              <span data-feather="shopping-cart"></span>
              Suppliers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.tips')}}">
              <span data-feather="users"></span>
              Tips
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.polls')}}">
              <span data-feather="bar-chart-2"></span>
              Polls
            </a>
          </li>
        </ul>        
      </div>
    </nav>