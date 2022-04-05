<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Administrator</div>
                    <a class="nav-link" href="<?= base_url() ?>admin/dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <!-- Actions Sidebar -->
                    <div class="sb-sidenav-menu-heading"><i class="fa-solid fa-location-arrow me-2"></i> Action</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Produk
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="#"><i class="fa-solid fa-plus me-2"></i>Tambah Data</i>
                                <a class="nav-link" href="#"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Data</a>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        User
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link" href="#"><i class="fa-solid fa-address-book me-2"></i>User List</a>
                            <!-- <a class="nav-link" href="#">User Setting</a> -->
                        </nav>
                    </div>
                    <!-- End of Actions Sidebar -->
                    <!-- Settings Sidebar -->
                    <div class="sb-sidenav-menu-heading"><i class="fa-solid fa-wrench me-2"></i> Setting</div>
                    <a class="nav-link" href="<?= base_url() ?>admin/profile">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Profile
                    </a>
                    <a class="nav-link collapsed" href="<?= base_url() ?>account/recovery">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Recovery Password
                    </a>
                    <!--End of Settings Sidebar -->
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <b><?= $user['name']; ?></b>
            </div>
        </nav>
    </div>