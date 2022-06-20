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
                                <div class="card-header mb-2">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Stok Produk
                                </div>
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
                        <div class="col-xl-6">
                            <div class="card mb-4 bg-light">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Kategori Produk Virtual Terlaris
                                </div>
                                <div class="card-body">
                                    <div width="100%" class="bg-light">
                                        <table border="0" width="100%">
                                            <tr>
                                                <td>
                                                    <center>
                                                        <div id="container" style="min-width: 310px; height:518px; max-width:600px;"></div>
                                                    </center>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        <th>Nama Pembeli</th>
                                        <th>Email Pembeli</th>
                                        <th>Nama Produk</th>
                                        <th>Qty</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Order</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach (array_reverse($riwayattrx) as $rt) : ?>
                                        <tr>
                                            <td><?= $rt['id_order']; ?></td>
                                            <td><?= $rt['name']; ?></td>
                                            <td><?= $rt['email']; ?></td>
                                            <td><?= $rt['nama_produk']; ?></td>
                                            <td><?= $rt['qty']; ?></td>
                                            <td>Rp. <?php echo number_format($rt['total'], 0, ",", "."); ?></td>

                                            <td><?= $rt['tgl_order']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function() {
                        <?php
                        //Edit jika dihosting
                        $conn = mysqli_connect('localhost', 'root', '', 'ecomm2022');
                        $query = "SELECT k.nama_kategori,(count(dot.stok)) AS stok FROM kategori k, products p,detail_order dot WHERE k.nama_kategori=p.kategori AND dot.id_produk=p.id_produk GROUP BY k.nama_kategori;";
                        $datagrafik = "[";
                        $hasil = mysqli_query($conn, $query);
                        while ($data = mysqli_fetch_array($hasil)) {
                            $datagrafik = $datagrafik . "['" . $data['nama_kategori'] . "'," . $data['stok'] . "], ";
                        }
                        $datagrafik = $datagrafik . "]";
                        ?>
                        $('#container').highcharts({
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: 1,
                                plotShadow: false
                            },
                            title: {
                                text: ''
                            },
                            tooltip: {
                                pointFormat: 'Total : <b>{point.percentage:.2f} %</b>'
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    point: {
                                        events: {
                                            click: function() {
                                                location.href = '#';
                                            }
                                        }
                                    },
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>: {point.percentage:.2f}  %',
                                        style: {
                                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                        }
                                    }
                                }
                            },
                            <?php
                            echo "series: [{
                type: 'pie',
                name: 'Browser share',
                data: $datagrafik
            }]";
                            ?>,
                        });
                    });
                </script>

                <script type="text/javascript">
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var data = {
                        labels: [$p = mysqli_fetch_array($penjualan)]
                    }
                </script>