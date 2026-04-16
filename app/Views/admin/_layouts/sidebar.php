<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="menu-title">Authentication</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-lock menu-icon"></i>
      </a>

      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">

          <!-- Users List -->
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('admin/usergroup') ?>"> User Group</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/users') ?>">
              Users List
            </a>
          </li>

          <!--  Member List Dropdown Start -->
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#memberSubMenu" aria-expanded="false">
              Member List
              <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="memberSubMenu">
              <ul class="nav flex-column ms-3">

                <li class="nav-item">
                  <a class="nav-link" href="<?= base_url('admin/members') ?>">
                    All Members
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="<?= base_url('admin/active-members') ?>">
                    Active Members
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="<?= base_url('admin/inactive-members') ?>">
                    Inactive Members
                  </a>
                </li>

              </ul>
            </div>
          </li>
          <!-- 🔥 Member List Dropdown End -->

          <!-- Logout -->
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/logout') ?>" onclick="return confirm('Are You Sure?')">
              Logout
            </a>
          </li>

        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        <span class="menu-title">Settings</span>
        <i class="mdi mdi-file-document-box menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>