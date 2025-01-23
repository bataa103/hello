<!-- Sidebar -->
<div class="sidebar sidebar-style-2" data-background-color="white">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="white">
            <img src="{{ asset('admin/assets/image/brandlogo.svg') }}" alt="navbar brand"
                class=" rounded-lg border border-navbar-brand" height="70px" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-info">
                <li class="nav-item active">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ url('/') }}" method="GET" class="m-0">
                        <button type="submit" class="btn btn-light d-flex align-items-center">
                            <i class="bi bi-house-door-fill text-primary me-2"></i>
                            <span>Welcome Page</span>
                        </button>
                    </form>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="bi bi-person"></i>
                        <span class="sub-item">Хэрэглэгчид</span>
                    </a>
                </li>

                <!-- User Plan Management -->
                <li class="nav-item">
                    <a href="{{ route('admin.plan.index') }}">
                        <i class="bi bi-person-vcard-fill"></i>
                        <span class="sub-item">Хэрэглэгдийн төлөвлөгөө</span>
                    </a>
                </li>
                <!-- Message Management -->
                <li class="nav-item">
                    <a href="{{ route('admin.messages.index') }}">
                        <i class="bi bi-envelope"></i>
                        <span class="sub-item">Захидал</span>
                    </a>
                </li>

            </ul>
        </div>
        <div id="hidden-div" style="display: none;">
            <p>This is an invisible div.</p>
        </div>


        <div class="sidebar-footer position-absolute bottom-5 w-100" style="margin-top: 200px;">
            <div
                class="user-info d-flex justify-content-between align-items-center bg-light p-3 rounded shadow-sm w-100">
                <!-- User Icon and Name -->
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-circle text-primary fs-4 me-2"></i>
                    <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
                </div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-dark d-flex align-items-center">
                        <i class="bi bi-box-arrow-right text-white me-2"></i>
                        <span>Гарах</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Sidebar -->
