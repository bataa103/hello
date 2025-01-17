      <!-- Sidebar -->
      <div class="sidebar sidebar-style-2" data-background-color="white">
          <div class="sidebar-logo">
              <!-- Logo Header -->
              <div class="logo-header" data-background-color="white">
                  <a href="{{ route('user.dashboard') }}" class="logo">
                      <img src="{{ asset('admin/assets/image/brandlogo.png') }}" alt="navbar brand"
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
                          <a href="{{ route('user.dashboard') }}">

                              <p>Миний санхүү</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('user.income.index') }}">
                              <i class="bi bi-box-arrow-in-down"></i>
                              <p>Орлого</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('user.expense.index') }}">
                              <i class="bi bi-box-arrow-up"></i>
                              <p>Зарлага</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('user.credit.index') }}">
                              <i class="bi bi-bank"></i>
                              <p>Данс</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="">
                              <i class="bi bi-list-columns"></i>
                              <p>Орлогын төрөл</p>
                          </a>

                      </li>
                      <li class="nav-item">
                          <a href="">
                              <i class="bi bi-receipt"></i>
                              <p>Зарлагын төрөл</p>
                          </a>
                      </li>

                  </ul>
              </div>
              <div class="sidebar-footer">
                  <form method="POST" action="{{ route('logout') }}" class="inline">
                      @csrf
                      <button type="submit" class="bg-blue-900 btn btn-danger w-100 text-left">
                          <i class="fas fa-sign-out-alt"></i>
                          <span>Гарах</span>
                      </button>
                  </form>
              </div>

          </div>
      </div>
      <!-- End Sidebar -->
