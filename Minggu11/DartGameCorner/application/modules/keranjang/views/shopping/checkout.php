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
                                <form class="form-horizontal" action="<?php echo base_url() ?>keranjang/shopping/proses_order" method="post" name="frmCO" id="frmCO">
                                    <div class="form-group has-success has-feedback mb-2">
                                        <label class="control-label col-xs-3" for="inputEmail">Email :</label>
                                        <div class="col-xs-9">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group has-success has-feedback mb-2">
                                        <label class="control-label col-xs-3" for="firstName">Nama :</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap">
                                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group has-success has-feedback mb-2">
                                        <label class="control-label col-xs-3" for="lastName">Alamat :</label>
                                        <div class="col-xs-9">
                                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" rows="3"></textarea>
                                            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
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
                                        <div class="col-xs-offset-3 col-xs-9">
                                            <button type="submit" class="btn btn-primary mt-2">Proses Order</button>
                                            <a href="<?= base_url('payment/snap'); ?>" class="btn btn-primary mt-2">Pay!</a>
                                        </div>
                                    </div>
                                </form>
                            <?php
                            } else {
                                echo "<h5>Shopping Cart masih kosong</h5>";
                            }
                            ?>
                        </div>

                    </div>
                </div>