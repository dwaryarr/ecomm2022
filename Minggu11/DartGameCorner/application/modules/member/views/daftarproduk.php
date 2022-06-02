        <!-- Main Frame -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><?= $judul ?></h1>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <?php foreach ($kategori as $k) : ?>
                                <li><a class="dropdown-item" href="<?= base_url('member/daftarproduk/kategori/' . $k['id_kategori']) ?>"><?= $k['nama_kategori']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
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
                                        <th scope="col">#</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($products as $p) : ?>
                                        <tr>
                                            <th scope="row"><?= ++$start; ?></th>
                                            <td><img src="<?= base_url('assets/images/produk/') . $p['gambar']; ?>" alt="poster" width="75px"></td>
                                            <td><?= $p['nama_produk']; ?></td>
                                            <td>Rp. <?php echo number_format($p['harga'], 0, ",", "."); ?></td>
                                            <td><?= $p['stok']; ?></td>
                                            <td><?= $p['keterangan']; ?></td>
                                            <td><?= $p['kategori']; ?></td>
                                            <td>
                                                <?= anchor('keranjang/shopping/tambah/' . $p['id_produk'], '<div class="badge bg-success"><i class="fa-solid fa-cart-plus"></i> Add to Cart</div>') ?>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?= $this->pagination->create_links(); ?>
                        </div>
                    </div>
                    <!-- <div class="row">
                    </div> -->
                </div>