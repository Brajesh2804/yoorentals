<?php helper('custom'); ?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <?php if (is_privilege(1, 1)) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>
        <?php } ?>

        <!-- Members Menu -->
        <?php if (is_privilege(2, 1) || is_privilege(3, 1) || is_privilege(4, 1)) { ?>
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#membersMenu" aria-expanded="false">

                    <span class="menu-title">Members</span>
                    <i class="mdi mdi-account-multiple"></i>
                </a>

                <div class="collapse" id="membersMenu">
                    <ul class="nav flex-column sub-menu ps-3">

                        <?php if (is_privilege(2, 1)) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('admin/members/adminindex') ?>">
                                    Admins
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (is_privilege(3, 1)) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('users/members/userindex') ?>">
                                    Users
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
        <?php } ?>

        <?php if (is_privilege(4, 1) || is_privilege(9, 1)) { ?>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#productMenu">
                    <span class="menu-title">Products</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-package-variant menu-icon"></i>
                </a>

                <div class="collapse" id="productMenu">
                    <ul class="nav flex-column sub-menu">

                        <?php if (is_privilege(4, 1)) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('users/members/adsindex') ?>">
                                    Manage Ads
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (is_privilege(9, 1)) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('admin/category') ?>">
                                    Categories
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </li>
        <?php } ?>

        <?php if (is_privilege(6, 1)) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/subscribers') ?>">
                    Subscribers
                </a>
            </li>
        <?php } ?>

        <?php if (is_privilege(5, 1)) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/messages') ?>">
                    Messages
                </a>
            </li>
        <?php } ?>

        <?php if (is_privilege(10, 1)) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/settings') ?>">
                    <span class="menu-title">Settings</span>
                    <i class="mdi mdi-cog menu-icon"></i>
                </a>
            </li>
        <?php } ?>

    </ul>
</nav>