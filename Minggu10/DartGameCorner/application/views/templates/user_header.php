<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>vendor/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <!-- My CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- SBAdmin CSS -->
    <link href="<?= base_url() ?>assets/css/sb_styles.css" rel="stylesheet" />
    <title><?php echo $judul; ?> - DartGameCorner
    </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo.png" type="image/x-icon">
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand" href="">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="" width="30" height="24" class="d-inline-block align-text-top">
            <b>Dart</b>GameCorner
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" method="POST" action="<?= base_url('products'); ?>">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." name="keyword" aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <a class="btn btn-outline-success" href="<?= base_url() ?>keranjang/shopping/tampil_cart"><i class="fa-solid fa-cart-shopping"></i><span class="top-0 p-1 translate-middle badge rounded-circle bg-danger"><?= $this->cart->total_items() ?></span> Keranjang Belanja</a>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="<?= base_url('assets/images/profile/') . $user['image']; ?>" alt="userimage" class="rounded" width="30px" height="30px"> <?= $user['name']; ?></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= base_url(); ?>account/login/logout"><i class="fa-solid fa-arrow-right-to-bracket"></i> Logout</a></li>
                    <!-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li> -->
                </ul>
            </li>
        </ul>
    </nav>