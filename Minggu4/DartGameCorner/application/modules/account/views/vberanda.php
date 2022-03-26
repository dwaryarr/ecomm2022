<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> Beranda | Tutorial Simple Login Register CodeIgniter
    </title>
</head>

<body>
    <h1>Selamat Datang di Situs kami.</h1>
    <p>
        Silakan klik link
        <?php echo anchor('account/login', 'Masuk'); ?>
        untuk masuk ke dalam sistem atau
        <?php echo anchor('account/register', 'Daftar'); ?>
        untuk mendaftar.
    </p>
</body>

</html>