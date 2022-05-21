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
                                <form class="form-horizontal" action="<?php echo base_url() ?>keranjang/shopping/proses_order" method="post" name="frmCO" id="frmCO">
                                    <div class="form-group has-success has-feedback mb-2">
                                        <label class="control-label col-xs-3" for="inputEmail">Email:</label>
                                        <div class="col-xs-9">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group has-success has-feedback mb-2">
                                        <label class="control-label col-xs-3" for="firstName">Nama :</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap">
                                        </div>
                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group has-success has-feedback mb-2">
                                        <label class="control-label col-xs-3" for="lastName">Alamat:</label>
                                        <div class="col-xs-9">
                                            <!-- <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat"> -->
                                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" rows="3"></textarea>
                                        </div>

                                    </div>
                                    <div class="form-group has-success has-feedback mb-2">
                                        <label class="control-label col-xs-3" for="phoneNumber">Telp/No HP:</label>
                                        <div class="col-xs-9">
                                            <input type="tel" class="form-control" name="telp" id="telp" placeholder="No Telp">
                                        </div>
                                        <div class="form-group has-success has-feedback mb-2">
                                            <div class="col-xs-offset-3 col-xs-9">
                                                <button type="submit" class="btn btn-primary mt-2">Proses Order</button>
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