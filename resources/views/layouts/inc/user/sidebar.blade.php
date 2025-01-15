      <!-- Sidebar -->
      <div class="sidebar sidebar-style-2" data-background-color="white">
          <div class="sidebar-logo">
              <!-- Logo Header -->
              <div class="logo-header" data-background-color="white">
                  <a href="index.html" class="logo">
                      <img src="assets/img/kaiadmin/logo_dark.svg" alt="navbar brand" class="navbar-brand"
                          height="20" />
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
                          <a href="{{route('user.dashboard')}}">
                              <i class="fas fa-home"></i>
                              <p>Миний санхүү</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('user.income.index') }}">
                              <span class="letter-icon">$</span>
                              <p>Орлого</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('user.expense.index') }}">
                              <span class="letter-icon">$</span>
                              <p>Зарлага</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('user.credit.index') }}">
                              <span class="letter-icon">Bt</span>
                              <p>Данс</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="">
                              <span class="letter-icon">Bt</span>
                              <p>Зарлагын төрөл</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="">
                              <span class="letter-icon">Bt</span>
                              <p>Зарлагын төрөл</p>
                          </a>
                      </li>
                  </ul>
              </div>
              <div class="sidebar-footer">
                  <form method="POST" action="{{ route('logout') }}" class="inline">
                      @csrf
                      <button type="submit" class="btn btn-danger w-100 text-left">
                          <i class="fas fa-sign-out-alt"></i>
                          <span>Log Out</span>
                      </button>
                  </form>
              </div>
          </div>
      </div>
      <!-- End Sidebar -->
