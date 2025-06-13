<nav class="navbar">
  <div class="navbar-content">

    <div class="logo-mini-wrapper">
      <img src="{{ asset('assets/images/logo-mini-light.png') }}" class="logo-mini logo-mini-light" alt="logo">
      <img src="{{ asset('assets/images/logo-mini-dark.png') }}" class="logo-mini logo-mini-dark" alt="logo">
    </div>

    <form class="search-form">
      <div class="input-group">
        <div class="input-group-text">
          <i data-lucide="search"></i>
        </div>
        <input type="text" class="form-control" placeholder="Search here...">
      </div>
    </form>

    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
          <img class="w-30px h-30px rounded-circle" src="https://placehold.co/30x30" alt="profile">
        </a>
        <div class="dropdown-menu p-0">
          <div class="d-flex flex-column align-items-center border-bottom px-4 py-3">
            <img class="w-80px h-80px rounded-circle mb-2" src="https://placehold.co/80x80" alt="">
            <div class="text-center">
              <p class="fs-16px fw-bolder mb-0">Admin STH</p>
              <p class="fs-12px text-secondary">admin@sthnetwork.com</p>
            </div>
          </div>
          <ul class="list-unstyled p-1">
            <li>
              <a href="#" class="dropdown-item py-2">
                <i class="me-2" data-lucide="log-out"></i>
                Log Out
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>

    <a href="#" class="sidebar-toggler">
      <i data-lucide="menu"></i>
    </a>
  </div>
</nav>
