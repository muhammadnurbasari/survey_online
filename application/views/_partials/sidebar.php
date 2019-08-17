

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laptop-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Ipem Survei</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">


      <!-- query menu -->
      <?php 
        $role_id = $this->session->userdata('role_id');
        
        if ($role_id == 1) { ?>
          <!-- masuk sebagai administrator -->
          <div class="sidebar-heading">
            Administrator
          </div>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin'); ?>">
              <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('user/create_angket'); ?>">
              <i class="fas fa-fw fa-calendar-plus"></i>
            <span>Create Angket</span></a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="<?= base_url('angket'); ?>">
              <i class="fas fa-fw fa-sticky-note"></i>
            <span>Daftar Angket</span></a>
          </li>
        <?php }else{?>
          <!-- masuk sebagai surveyor -->
          <div class="sidebar-heading">
            Surveyor
          </div>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('user/create_angket'); ?>">
              <i class="fas fa-fw fa-calendar-plus"></i>
            <span>Create Angket</span></a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="<?= base_url('angket'); ?>">
              <i class="fas fa-fw fa-sticky-note"></i>
            <span>Angket</span></a>
          </li>
        <?php } ?>


      <!-- Nav Item - Logout -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
          <span>Logout</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->