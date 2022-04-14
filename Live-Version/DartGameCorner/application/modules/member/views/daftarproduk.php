        <!-- Main Frame -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><?= $judul ?></h1>
                    <div class="row">
                        <div class="col-lg">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($products as $p) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><img src="<?= base_url('assets/images/produk/') . $p['gambar']; ?>" alt="poster" width="75px"></td>
                                            <td><?= $p['nama_produk']; ?></td>
                                            <td>Rp. <?php echo number_format($p['harga'], 0, ",", "."); ?></td>
                                            <td><?= $p['stok']; ?></td>
                                            <td><?= $p['keterangan']; ?></td>
                                            <td><?= $p['kategori']; ?></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="row">
                    </div> -->
                </div>