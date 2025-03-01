<div class="navbar-nav align-items-center ms-auto">
    <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <img class="rounded-circle me-lg-2" src="<?php echo base_url() ?>assets/img/user.jpg" alt=""
                style="width: 40px; height: 40px;">
            <span class="d-none d-lg-inline-flex">
                <?= ucfirst(session()->get('username')) ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
            <a href="<?= site_url('/logout') ?>" class="dropdown-item">Log Out</a>
        </div>
    </div>
</div>