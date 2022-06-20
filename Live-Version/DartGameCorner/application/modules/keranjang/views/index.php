<!-- Main Frame -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $judul ?></h1>
            <div class="row">
                <?php if ($this->session->flashdata('flash')) {
                    echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
                } ?>
                <form action="<?= base_url() ?>payment/proses_order" method="post" name="frmShopping" id="payment-form" class="form-horizontal" enctype="multipart/form-data">
                    <?php
                    if ($cart = $this->cart->contents()) {
                    ?>
                        <table class="table">
                            <tr id="main_heading">
                                <td width="2%">No</td>
                                <td width="10%">Gambar</td>
                                <td width="33%">Item</td>
                                <td width="17%">Harga</td>
                                <td width="8%">Qty</td>
                                <td width="20%">Jumlah</td>
                                <td width="10%">Hapus</td>
                            </tr>
                            <?php
                            // Create form and send all values in "keranjang/update_cart" function.
                            $grand_total = 0;
                            $i = 1;
                            foreach ($cart as $item) :
                                $grand_total = $grand_total + $item['subtotal'];
                            ?>
                                <input type="hidden" name="cart[<?= $item['id']; ?>][id]" value="<?= $item['id']; ?>" />
                                <input type="hidden" name="cart[<?= $item['id']; ?>][rowid]" value="<?= $item['rowid']; ?>" />
                                <input type="hidden" name="cart[<?= $item['id']; ?>][name]" value="<?= $item['name']; ?>" />
                                <input type="hidden" name="cart[<?= $item['id']; ?>][price]" value="<?= $item['price']; ?>" />
                                <input type="hidden" name="cart[<?= $item['id']; ?>][gambar]" value="<?= $item['gambar']; ?>" />
                                <input type="hidden" name="cart[<?= $item['id']; ?>][qty]" value="<?= $item['qty']; ?>" />
                                <input type="hidden" name="produk" id="produk" value="<?= $item['name']; ?>">
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><img class="img-responsive" width="75px" src="<?= base_url() . 'assets/images/produk/' . $item['gambar']; ?>" /></td>
                                    <td><?= $item['name']; ?></td>
                                    <td><?= number_format($item['price'], 0, ",", "."); ?></td>
                                    <td><?= $item['qty']; ?></td>
                                    <td><?= number_format($item['subtotal'], 0, ",", ".") ?></td>
                                    <td><a href="<?= base_url() ?>keranjang/hapus/<?= $item['rowid']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-can"></i></a></td>
                                <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <td colspan="3"><b>Order Total: Rp. <?= number_format($grand_total, 0, ",", "."); ?></b></td>
                                    <td colspan="4" align="right">
                                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#resetModal">Kosongkan Cart</a>
                                        <!-- <a href="<?= base_url(); ?>keranjang/check_out" class='btn btn-sm btn-primary'>Check Out</a> -->
                                </tr>
                        </table>
                        <input type="hidden" name="total_bayar" id="total_bayar" value="<?= $grand_total ?>">
                        <input type="hidden" name="result_type" id="result-type" value="">
                        <input type="hidden" name="result_data" id="result-data" value="">
                        <input type="hidden" name="id_order" id="id_order" value="<?= $order['id_order']; ?>">
                        <input type="hidden" name="role" id="role" value="User">
                        <div class="form-group has-success has-feedback m-2">
                            <label class="control-label col-xs-3" for="inputEmail">Email :</label>
                            <div class="col-xs-9">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= $email; ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group has-success has-feedback m-2">
                            <label class="control-label col-xs-3" for="firstName">Nama :</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" value="<?= $user['name']; ?>">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group has-success has-feedback m-2">
                            <label class="control-label col-xs-3" for="lastName">Kota :</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="kota" id="kota" placeholder="Kota">
                                <?= form_error('kota', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group has-success has-feedback m-2">
                            <label class="control-label col-xs-3" for="phoneNumber">Telp/No HP :</label>
                            <div class="col-xs-9">
                                <input type="tel" class="form-control" name="telp" id="telp" placeholder="No Telp">
                                <?= form_error('telp', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group has-success has-feedback m-2">
                            <label class="control-label col-xs-3" for="keterangan">Keterangan :</label>
                            <p style="color: red; font-size: 10pt;"> *Harap isi keterangan dengan username atau id target layanan yang dipesan serta catatan untuk Admin!
                                <br>Contoh: JohnDoe#SEA / 1234567(0123) / johndoe99
                            </p>
                            <div class="col-xs-9">
                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" rows="3"></textarea>
                                <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo "<h3 id='kosong'>Keranjang Belanja masih kosong</h3>";
                    }
                    ?>
                </form>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mx-auto m-2">
                    <button type="submit" id="pay-button" class="btn btn-success"><i class="fa-solid fa-money-bill-wave"></i> Check-out</button>
                </div>
                <!-- New Modal -->
                <div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-light">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newMenuModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url() ?>keranjang/hapus/all" method="POST">
                                <div class="modal-body">
                                    Anda yakin mau mengosongkan Cart?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end -->
            </div>
        </div>

        <script>
            var paybutton = document.getElementById("pay-button");
            var kosong = document.getElementById("kosong");
            // When the user scrolls down 20px from the top of the document, show the button
            paybutton.style.display = "block"; // Show the button
            if (kosong != null) {
                paybutton.style.display = "none";
            }
        </script>

        <script type="text/javascript">
            $('#pay-button').click(function(event) {
                event.preventDefault();
                $(this).attr("disabled", "disabled");
                var id_order = $('#id_order').val();
                var id_produk = $('#id_produk').val();
                var produk = $('#produk').val();
                var nama = $('#nama').val();
                var email = $('#email').val();
                var telp = $('#telp').val();
                var kota = $('#kota').val();
                var keterangan = $('#keterangan').val();
                var total_bayar = $('#total_bayar').val();

                $.ajax({
                    type: "POST",
                    url: '<?= site_url() ?>payment/token',
                    data: {
                        id_order: id_order,
                        id_produk: id_produk,
                        produk: produk,
                        nama: nama,
                        email: email,
                        telp: telp,
                        kota: kota,
                        keterangan: keterangan,
                        total_bayar: total_bayar
                    },
                    cache: false,

                    success: function(data) {
                        //location = data;

                        console.log('token = ' + data);

                        var resultType = document.getElementById('result-type');
                        var resultData = document.getElementById('result-data');

                        function changeResult(type, data) {
                            $("#result-type").val(type);
                            $("#result-data").val(JSON.stringify(data));
                            //resultType.innerHTML = type;
                            //resultData.innerHTML = JSON.stringify(data);
                        }

                        snap.pay(data, {
                            autoCloseDelay: 15,
                            onSuccess: function(result) {
                                changeResult('success', result);
                                console.log(result.status_message);
                                console.log(result);
                                $("#payment-form").submit();
                                Swal.fire(
                                    'Transaksi Berhasil!',
                                    'Pesanan akan segera diproses.',
                                    'success'
                                )
                            },
                            onPending: function(result) {
                                changeResult('pending', result);
                                console.log(result.status_message);
                                console.log(result);
                                $("#payment-form").submit();
                                Swal.fire(
                                    'Transaksi Berhasil!',
                                    'Pesanan akan segera diproses.',
                                    'success'
                                )
                            },
                            onError: function(result) {
                                changeResult('error', result);
                                console.log(result.status_message);
                                console.log(result);
                                $("#payment-form").submit();
                                Swal.fire(
                                    'Transaksi Gagal!',
                                    'Silahkan Coba lagi beberapa saat.',
                                    'error'
                                )
                            }
                        });
                    }
                });
            });
        </script>