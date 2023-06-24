<aside class="main-sidebar sidebar-light-primary elevation-2">
    <!-- Brand Logo -->
    <a href="./index.php" class="brand-link">
    <img src="dist/img/mgmboscologo.jpg" alt="MGM Bosco Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MGM Bosco</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- User login Info --->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="dist/img/personlogo.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="info">
          <a href="./profil_user.php" class="d-block"><?php echo $_SESSION['nama'];?></a>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group mt-3" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">Home</li>
          <li class="nav-item">
            <a href="./index.php" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Dashboard
                <i class="far nav-icon"></i>
              </p>
            </a>
          </li>
          <li class="nav-header">Data Audit</li>
          <li class="nav-item">
            <a href="./auditplan.php" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Audit Plan
                <i class="far nav-icon"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./auditprogram.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Audit Program
                <i class="far nav-icon"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./postaudit.php" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Post Audit
                <i class="far nav-icon"></i>
              </p>
            </a>
          </li>
          <li class="nav-header">Schedule</li>
          <li class="nav-item">
            <a href="./calendar.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Calendar
                <i class="far nav-icon"></i>
              </p>
            </a>
          </li>
          <li class="nav-header">Akun</li>
          <li class="nav-item">
            <a href="./profil_user.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
                <i class="far nav-icon"></i>
              </p>
            </a>
          </li>
          <li class="nav-header">End Session</li>
          <li class="nav-item">
            <a href="./logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
                <i class="far nav-icon"></i>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>