<div class="container-fluid px-5 mt-5">
    <div class="row-lg mt-5">
        <center>
            <h2><?= $nama ?></h2>
        </center>
    </div>
    <div class="row mt-5">
        <div class="col-md-3">
            <a href="#" class="pop">
                <img src="<?= base_url('assets/images/produk/') . $products['gambar']; ?>" class="rounded mb-3" style="max-width: 100%;">
            </a>
            <center>
                <h4>How to Order?</h4>
            </center>
            <ol>
                <li>Isi form pemesanan dengan lengkap.</li>
                <li>Masukan Email dan Nomor Telp/HP yang valid dan aktif.</li>
                <li>Masukan Keterangan dengan ID/Username/NickName In-Game yang sesuai dengan akun game online anda.</li>
                <li>Klik tombol Beli! untuk melanjutkan pembayaran.</li>
            </ol>
            <p>
                Setelah menyelesaikan pembayaran, Produk Virtual akan langsung diproses oleh Admin.
            </p>
        </div>
        <div class="col-md-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title" id="nama_produk"><?= $products['nama_produk']; ?></h5>
                    <h6 class="card-subtitle m-2 text-muted"><?= $products['kategori']; ?></h6>
                    <div class="card m-2" style="width: 18rem;">
                        <div class="card-body bg-light">
                            <h5 class="card-title">Keterangan</h5>
                            <p class="card-text"><?= $products['keterangan']; ?></p>
                        </div>
                    </div>
                    <h6>Harga : Rp. <?php echo number_format($products['harga'], 0, ",", "."); ?></h6>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-light">
                <?php if ($this->session->flashdata('flash')) {
                    echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
                } ?>
                <form class="form-horizontal" action="<?= base_url() ?>home/payment/proses_order" method="post" name="frmCO" id="payment-form">
                    <input type="hidden" name="result_type" id="result-type" value="">
                    <input type="hidden" name="result_data" id="result-data" value="">
                    <input type="hidden" name="id_order" id="id_order" value="<?= $order['id_order']; ?>">
                    <input type="hidden" name="role" id="role" value="public">
                    <div class="form-group has-success has-feedback m-2">
                        <label class="control-label col-xs-3" for="inputEmail">Email :</label>
                        <div class="col-xs-9">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group has-success has-feedback m-2">
                        <label class="control-label col-xs-3" for="firstName">Nama :</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
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
                        <?php
                        $grand_total = 0;
                        $grand_total = $grand_total + $products['harga'];
                        ?>
                        <input type="hidden" name="id_produk" id="id_produk" value="<?= $products['id_produk']; ?>">
                        <input type="hidden" name="produk" id="produk" value="<?= $products['nama_produk']; ?>">
                        <input type="hidden" name="total_bayar" id="total_bayar" value="<?= $grand_total ?>">
                    </div>
                </form>
                <div class="d-grid gap-2 d-md-block mx-auto m-2">
                    <button type="submit" id="pay-button" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i> Beli!</button>
                    <a href="<?= base_url() ?>home" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Zoom Image -->
<div class="modal fade" id="imagemodal" tabindex="-1" aria-labelledby="imagemodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title" id="imagemodalLabel">Preview</h5>
                <button type="button" class="btn-close btn-danger bg-red" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" class="imagepreview center" style="max-width: 1105px;">
            </div>
        </div>
    </div>
</div>

<script>
    // Zoom Images
    $(function() {
        $('.pop').on('click', function() {
            $('.imagepreview').attr('src', $(this).find('img').attr('src'));
            $('#imagemodal').modal('show');
        });
    });
</script>

<script type="text/javascript">
    $('#pay-button').click(function(event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        var id_order = $('#id_order').val();
        var id_produk = $('#id_produk').val();
        var produk = $('#produk').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var telp = $('#telp').val();
        var kota = $('#kota').val();
        var keterangan = $('#keterangan').val();
        var total_bayar = $('#total_bayar').val();

        $.ajax({
            type: "POST",
            url: '<?= site_url() ?>home/payment/token',
            data: {
                id_order: id_order,
                id_produk: id_produk,
                produk: produk,
                name: name,
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