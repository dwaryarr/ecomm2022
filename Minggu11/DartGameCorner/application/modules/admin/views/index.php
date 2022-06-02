        <!-- Main Frame -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4 bg-light p-2">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Stok Produk
                                </div>
                                <!-- <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Keterangan</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Keterangan</th>
                                            <th>Stok</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($products as $p) : ?>
                                            <tr>
                                                <td><?= $p['nama_produk']; ?></td>
                                                <td><?= $p['keterangan']; ?></td>
                                                <td><?= $p['stok']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table> -->
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4 bg-light">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Grafik Penjualan
                                </div>
                                <div class="card-body">asdas</div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 bg-light">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Transaksi Terbaru
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Keterangan</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Keterangan</th>
                                        <th>Stok</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($products as $p) : ?>
                                        <tr>
                                            <td><?= $p['nama_produk']; ?></td>
                                            <td><?= $p['keterangan']; ?></td>
                                            <td><?= $p['stok']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>