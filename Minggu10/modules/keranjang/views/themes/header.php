<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initialscale=1">
    <!-- The above 3 meta tags *must* come first in the head; anyother head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Komang.My.ID Shop Online</title>
    <link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url() ?>assets/asie/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url() ?>assets/custom.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/jquery/jqueryui.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy these 2lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsivefile-warning.js"></script><![endif]-->
    <script src="<?php echo base_url() ?>assets/asie/js/ieemulation-modes-warning.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
 <scriptsrc="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 <![endif]-->

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">

    <!-- Jquery -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-custom navbar-fixedtop">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" ariaexpanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    < class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="<?php echo base_url() ?>assets/logos.png"></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="<?php echo base_url() ?>">Home</a></li>
                    <li><a href="<?php echo base_url() ?>page/tentang"><i class="glyphicon glyphicon-user"></i> Tentang</a></li>
                    <li><a href="<?php echo base_url() ?>page/cara_bayar"><i class="glyphicon glyphiconbriefcase"></i> Cara Bayar</a></li>
                    <li><a href="<?php echo base_url() ?>shopping/tampil_cart"><i class="glyphicon glyphiconshopping-cart"></i> Keranjang Belanja</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
    <!-- Begin page content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="list-group">
                    <a class="list-groupitem"><strong>KATEGORI</strong></a>
                    <a href="<?php echo base_url() ?>shopping/index/" class="list-group-item">Semua</a>
                    <?php
                    foreach ($kategori as $row) {
                    ?>
                        <a href="<?php echo base_url() ?>shopping/index/<?php echo $row['id_produk']; ?>" class="list-group-item"><?php echo $row['nama_kategori']; ?></a>
                    <?php } ?>
                </div><br>
                <div class="list-group">
                    <a href="<?php echo base_url() ?>shopping/tampil_cart" class="list-group-item"><strong><i class="glyphicon glyphiconshopping-cart"></i> KERANJANG BELANJA</strong></a>
                    <?php
                    $cart = $this->cart->contents();
                    // If cart is empty, this will show below message.
                    if (empty($cart)) {
                    ?>
                        <a class="list-group-item">Keranjang Belanja Kosong</a>
                        <?php
                    } else {
                        $grand_total = 0;
                        foreach ($cart as $item) {
                            $grand_total += $item['subtotal'];
                        ?>
                            <a class="list-group-item"><?php echo $item['name']; ?> (<?php echo $item['qty']; ?> x <?php echo number_format($item['price'], 0, ",", "."); ?>)=<?php echo number_format($item['subtotal'], 0, ",", "."); ?></a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-9">
                <div class="row">