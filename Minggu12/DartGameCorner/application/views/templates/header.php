<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- My CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>vendor/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <!-- AOS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/aos/dist/aos.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>vendor/fontawesome/css/all.min.css">
    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Rf3Tf-5xhSG3pqie"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo.png" type="image/x-icon">
    <title><?php echo $judul; ?> - DartGameCorner
    </title>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="" width="30" height="24" class="d-inline-block align-text-top">
                <b>Dart</b>GameCorner
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>"><i class="fa-solid fa-house"></i> Home</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach ($kategori as $k) : ?>
                                <li><a class="dropdown-item" href="<?= base_url('home/kategori/' . $k['id_kategori']) ?>"><?= $k['nama_kategori']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>home/about"><i class="fa-solid fa-circle-info"></i> About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>account/login"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
                    </li>
                </ul>
                <!-- Toggle DarkMode -->
                <div class="form-check form-switch me-3">
                    <label class="form-check-label ms-3" for="lightSwitch">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-brightness-high" viewBox="0 0 16 16">
                            <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                        </svg>
                    </label>
                    <input class="form-check-input" type="checkbox" id="lightSwitch" />
                </div>

                <form class="d-flex" action="" method="post">
                    <input class="form-control me-2" type="search" placeholder="Search.." aria-label="Search" name="keyword" autocomplete="off" autofocus>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>