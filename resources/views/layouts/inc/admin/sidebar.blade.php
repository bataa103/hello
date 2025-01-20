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

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Management</h4>
                </li>

                <!-- User Control -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#user-control" class="collapsed" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <p>User Control</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="user-control">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.users.index') }}">
                                    <span class="sub-item">View All Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.create') }}">
                                    <span class="sub-item">Add New User</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- User Plan Management -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#user-plan-management" class="collapsed" aria-expanded="false">
                        <i class="fas fa-list-alt"></i>
                        <p>User Plan Management</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="user-plan-management">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.plan.index') }}">
                                    <span class="sub-item">View All Plans</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Message Management -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#message-management" class="collapsed" aria-expanded="false">
                        <i class="fas fa-envelope"></i>
                        <p>Message Management</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="message-management">
                        <ul class="nav nav-collapse">
                            <li>
                                {{-- <a href="{{ route('admin.messages.index') }}"> --}}
                                    <span class="sub-item">View All Messages</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>



                <!-- Additional Sections -->
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.reports') }}">
                        <i class="fas fa-chart-bar"></i>
                        <p>Reports & Analytics</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.income.index') }}">
                        <i class="fas fa-dollar-sign"></i>
                        <p>Income Management</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.savings') }}">
                        <i class="fas fa-piggy-bank"></i>
                        <p>Savings Tracker</p>
                    </a>
                </li> --}}
            </ul>
        </div>
        <div class="sidebar-footer position-absolute bottom-5 w-100">
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
