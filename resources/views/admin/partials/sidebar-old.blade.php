    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">

        <ul id="admin-menu"  class="nav flex-column">

          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          
          <li class="nav-item ">
            
            <a class="nav-link nav-link-collapse" href="#menu-users" role="button" data-toggle="collapse">
              <span data-feather="users"></span>
              {{__('Users')}}
            </a>

            <div class="collapse" id="menu-users" data-parent="#admin-menu">
              <a class="collapse-item" href="{{route('admin.users.index')}}">
                {{ __('All Users') }}
              </a>
              
              <a class="collapse-item" href="{{route('admin.users.create')}}">
                {{ __('Create User') }}
              </a>

            </div>
          </li>

          <li class="nav-item ">
            
            <a class="nav-link nav-link-collapse" href="#menu-posts" role="button" data-toggle="collapse">
              <span data-feather="edit"></span>
              {{__('Posts')}}
            </a>

            <div class="collapse" id="menu-posts" data-parent="#admin-menu">
              <a class="collapse-item" href="#">
                {{ __('All Posts') }}
              </a>
              
              <a class="collapse-item" href="#">
                {{ __('Create Post') }}
              </a>

            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>

          
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>