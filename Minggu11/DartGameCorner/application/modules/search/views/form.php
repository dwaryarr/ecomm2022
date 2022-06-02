<html>

<head>
    <title>GET DATA with AJAX</title>
    <script>
        var baseurl = "<?php echo base_url("index.php/"); ?>"; //Buat variabel baseurl untuk nanti di akses pada file config.js
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url("assets/js/config_search.js"); ?>"></script> <!-- Load file process.js -->
</head>

<body>
    <h1>FORM SEARCH PRODUK</h1>
    <hr>
    <form>
        <table>
            <tr>
                <td>Nama Produk</td>
                <td>:</td>
                <td><input type="text" name="nama_produk" id="nama_produk" autocomplete="off"> <button type="button" id="btn-search">Cari</button> <span id="loading">LOADING...</span></td>
            </tr>
            <!-- <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama" id="nama" autocomplete="off"></td>
            </tr> -->
            <tr>
                <td>Harga</td>
                <td>:</td>
                <td><input type="text" name="harga" id="harga" autocomplete="off"></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td>:</td>
                <td><input type="text" name="stok" id="stok" autocomplete="off"></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><input type="text" name="keterangan" id="keterangan" autocomplete="off"></td>
            </tr>
        </table>
    </form>
</body>

</html>