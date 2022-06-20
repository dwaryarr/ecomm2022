<div class="container mt-5">
    <div class="row mt-5">
        <center>
            <h2><?= $nama ?></h2>
        </center>

        <form action="">
            <div class="form-group has-success has-feedback m-2">
                <div class="col-xs-9">
                    <input type="text" class="form-control" name="cari_transaksi" id="cari_transaksi" placeholder="Id Transaksi / Id Order">
                    <?= form_error('cari_transaksi', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped mt-5">
            <thead>
                <tr>
                    <th>Id Order</th>
                    <th>Id Transaksi</th>
                    <th>Total Bayar</th>
                    <th>Payment Type</th>
                    <th>Bank</th>
                    <th>VA Number</th>
                    <th>Transaction Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payment as $p) : ?>
                <tr>
                        <td><?= $p['id_order']; ?></td>
                        <td><?= $p['id_transaksi']; ?></td>
                        <td><?= $p['gross_amount']; ?></td>
                        <td><?= $p['payment_type']; ?></td>
                        <td><?= $p['bank']; ?></td>
                        <td><?= $p['va_number']; ?></td>
                        <td><?= $p['transaction_time']; ?></td>
                        <td><?php
                            if ($p['status_code'] == "200") {
                            ?>
                                <label for="" class="badge bg-success">Success</label>
                            <?php
                            } else {
                            ?>
                                <label for="" class="badge bg-warning">Pending</label>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <a href="<?= $p['pdf_url']; ?>" target="_blank" class="btn btn-success btn-sm">Download</a>
                        </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>