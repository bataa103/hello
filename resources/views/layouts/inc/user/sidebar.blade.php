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
                          <a href="index.html">
                              <i class="fas fa-home"></i>
                              <p>Миний санхүү</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a data-bs-toggle="collapse" href="#income-management" class="collapsed"
                              aria-expanded="false">
                              <i class="fas fa-dollar-sign"></i>
                              <p>Орлого</p>
                              <span class="caret"></span>
                          </a>
                          <div class="collapse" id="income-management">
                              <ul class="nav nav-collapse">
                                  <li>
                                      {{-- <a href="{{ route('admin.income.index') }}">
                                    <span class="sub-item">View All Incomes</span>
                                </a> --}}
                                  </li>
                                  <li>
                                      {{-- <a href="{{ route('admin.income.create') }}">
                                    <span class="sub-item">Add New Income</span>
                                </a> --}}
                                  </li>
                              </ul>
                          </div>
                      </li>

                      <li class="nav-item">
                          <a href="components/breadcrumb.html">
                              <span class="letter-icon">$</span>
                              <p>Зарлага</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{route('user.credit.index')}}">
                              <span class="letter-icon">Bt</span>
                              <p>Данс</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="components/buttons.html">
                              <span class="letter-icon">Bt</span>
                              <p>Зарлагын төрөл</p>
                          </a>
                      </li>

                  </ul>
              </div>
          </div>
      </div>
      <!-- End Sidebar -->
