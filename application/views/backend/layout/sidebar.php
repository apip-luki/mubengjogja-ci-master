<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fab fa-app-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/index'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Main Menu
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/index/artikel'); ?>">
            <i class="fas fa-fw fa-rss"></i>
            <span>Article</span></a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/index/kategori'); ?>">
            <i class="fas fa-fw fa-tag"></i>
            <span>Category</span></a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/index/user'); ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span></a>
    </li>
    <!-- <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Seting Web
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTree" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Konfigurasi</span>
        </a>
        <div id="collapseTree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Setings:</h6>
                <a class="collapse-item" href="<?= base_url('admin/index/meta'); ?>">Meta</a>
                <a class="collapse-item" href="<?= base_url('admin/index/meta/logo'); ?>">Logo</a>
                <a class="collapse-item" href="<?= base_url('admin/index/meta/favicon'); ?>">Favicon</a>
            </div>
        </div>
    </li> -->
    <hr class="sidebar-divider">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
