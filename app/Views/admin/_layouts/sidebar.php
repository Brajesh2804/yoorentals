<?php helper('custom'); ?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <?php if(is_privilege(1)){ ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <?php } ?>

        <!-- Members Menu -->
        <?php if(is_privilege(2) || is_privilege(3) || is_privilege(4)){ ?>
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center"
                data-bs-toggle="collapse"
                href="#membersMenu"
                aria-expanded="false">

                <span class="menu-title">Members</span>
                <i class="mdi mdi-account-multiple"></i> 
            </a>

            <div class="collapse" id="membersMenu">
                <ul class="nav flex-column sub-menu ps-3">

                    <?php if(is_privilege(2)){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/members/adminindex') ?>">
                            Admins
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(is_privilege(3)){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('users/members/userindex') ?>">
                            Users
                        </a>
                    </li>
                    <?php } ?>

                    <!-- <?php if(is_privilege(4)){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/products') ?>">
                            Products
                        </a>
                    </li>
                    <?php } ?> -->

                </ul>
            </div>
        </li>
        <?php } ?>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="menu-title">Settings</span>
                <i class="mdi mdi-cog menu-icon"></i>
            </a>
        </li>

    </ul>
</nav>