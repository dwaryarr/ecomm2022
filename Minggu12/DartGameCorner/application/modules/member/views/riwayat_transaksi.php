        <!-- Main Frame -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Riwayat Transaksi</h1>
                    <ol class="breadcrumb mb-4">
                    </ol>
                    <div class="row">
                        <div class="card mb-4 bg-light">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Riwayat Transaksi Terbaru
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID Order</th>
                                            <th>Nama Produk</th>
                                            <th>Qty</th>
                                            <th>Total Harga</th>
                                            <th>Tanggal Order</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (array_reverse($riwayat) as $rt) : ?>
                                            <tr data-aos="fade-up" data-aos-offset="50" data-aos-duration="1000">
                                                <td><?= $rt['id_order']; ?></td>
                                                <td><?= $rt['nama_produk']; ?></td>
                                                <td><?= $rt['qty']; ?></td>
                                                <td>Rp. <?php echo number_format($rt['total_harga'], 0, ",", "."); ?></td>
                                                <td><?= $rt['tgl_order']; ?></td>
                                                <td>
                                                    <a href="#" class="badge bg-success" data-bs-toggle="modal" data-bs-target="#detailTrxModal<?= $rt['id_order']; ?>"><i class="fas fa-pen-to-square"></i> Detail</a>
                                                    <!-- Detail Transaksi Modal -->
                                                    <div class="modal fade" id="detailTrxModal<?= $rt['id_order']; ?>" tabindex="-1" aria-labelledby="detailTrxModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-light">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="detailTrxModalLabel">Detail Transaksi</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table table-bordered">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th>ID</th>
                                                                                <td><?= $rt['id_order']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Layanan</th>
                                                                                <td><?= $rt['nama_produk']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Target</th>
                                                                                <td><?= 'VALOR' ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Note</th>
                                                                                <td><?= 'NLALALALAL' ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Harga</th>
                                                                                <td>Rp. <?php echo number_format($rt['total_harga'], 0, ",", "."); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Status</th>
                                                                                <td><?= 'Sukses' ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Platform</th>
                                                                                <td><?= 'Website' ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Tanggal Order</th>
                                                                                <td><?= $rt['tgl_order']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Proses</th>
                                                                                <td><?= '1 Menit' ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>