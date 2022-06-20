    <!-- Main Frame -->
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4"><?= $judul ?></h1>
                <div class="row mt-4">
                    <div class="kotak2">
                        <?php
                        $grand_total = 0;
                        if ($cart = $this->cart->contents()) {
                            foreach ($cart as $item) {
                                $grand_total = $grand_total + $item['subtotal'];
                            }
                            echo "<h4>Total Belanja: Rp." . number_format($grand_total, 0, ",", ".") . "</h4>";
                        ?>
                            <?php if ($this->session->flashdata('flash')) {
                                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
                            } ?>
                            <form class="form-horizontal" action="<?php echo base_url() ?>keranjang/proses_order" method="post" name="frmCO" id="frmCO">
                                <div class="form-group has-success has-feedback mb-2">
                                    <label class="control-label col-xs-3" for="inputEmail">Email :</label>
                                    <div class="col-xs-9">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= $email ?>">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group has-success has-feedback mb-2">
                                    <label class="control-label col-xs-3" for="firstName">Nama :</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap" value="<?= $user['name']; ?>">
                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group has-success has-feedback mb-2">
                                    <label class="control-label col-xs-3" for="lastName">Kota :</label>
                                    <div class="col-xs-9">
                                        <textarea class="form-control" id="kota" name="kota" placeholder="Kota" rows="3"></textarea>
                                        <?= form_error('kota', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group has-success has-feedback mb-2">
                                    <label class="control-label col-xs-3" for="phoneNumber">Telp/No HP :</label>
                                    <div class="col-xs-9">
                                        <input type="tel" class="form-control" name="telp" id="telp" placeholder="No Telp">
                                        <?= form_error('telp', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group has-success has-feedback mb-2">
                                    <label class="control-label col-xs-3" for="keterangan">Keterangan :</label>
                                    <p style="color: red; font-size: 10pt;"> *Harap isi keterangan dengan username atau id target layanan yang dipesan!</p>
                                    <div class="col-xs-9">
                                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" rows="3"></textarea>
                                        <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group has-success has-feedback mb-2">
                                    <label class="control-label col-xs-3" for="totalBayar">Total Bayar :</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" name="total_bayar" id="total_bayar" value="<?= $grand_total ?>" readonly>
                                    </div>
                                </div>
                                <!-- <div class="form-group has-success has-feedback mb-2">
                                    <div class="col-xs-offset-3 col-xs-9">
                                        <button type="submit" class="btn btn-primary mt-2">Proses Order</button>
                                    </div>
                                </div> -->
                            </form>
                            <form id="payment-form" method="post" action="<?= site_url() ?>payment/finish">
                                <input type="hidden" name="result_type" id="result-type" value="">
                                <input type="hidden" name="result_data" id="result-data" value="">
                            </form>
                            <button id="pay-button" class="btn btn-primary mt-2">Pay!</button>
                        <?php
                        } else {
                            echo "<h5>Shopping Cart masih kosong</h5>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $('#pay-button').click(function(event) {
                    event.preventDefault();
                    $(this).attr("disabled", "disabled");

                    var name = $('#name').val();
                    var email = $('#email').val();
                    var telp = $('#telp').val();
                    var kota = $('#kota').val();
                    var keterangan = $('#keterangan').val();
                    var total_bayar = $('#total_bayar').val();

                    $.ajax({
                        type: "POST",
                        url: '<?= site_url() ?>payment/token',
                        data: {
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

                                onSuccess: function(result) {
                                    changeResult('success', result);
                                    console.log(result.status_message);
                                    console.log(result);
                                    $("#payment-form").submit();
                                },
                                onPending: function(result) {
                                    changeResult('pending', result);
                                    console.log(result.status_message);
                                    $("#payment-form").submit();
                                },
                                onError: function(result) {
                                    changeResult('error', result);
                                    console.log(result.status_message);
                                    $("#payment-form").submit();
                                }
                            });
                        }
                    });
                });
            </script>