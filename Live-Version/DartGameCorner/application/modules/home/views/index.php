<div class="container">
    <div class="row-lg mt-5">
        <center>
            <h2>
                Welcome to the Home Page, <?= $nama; ?>!</h2>
        </center>
    </div>
    <div class="row mt-5">
        <?php foreach ($products as $row) : ?>
            <div class="col-md-3 mb-5">
                <div class="card-group">
                    <div class="card bg-light cardmovie" style="border :none">
                        <a href="<?= base_url(); ?>products/detail/<?= $row['id_produk']; ?>" class="text-decoration-none">
                            <img src="<?= base_url('assets/images/produk/') . $row['gambar']; ?>" height="300px" class="card-img-top rounded">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row["nama_produk"]; ?></h5>
                            </div>
                        </a>
                        <div class="card-text text-muted ms-2">
                            <h6><?= $row["keterangan"]; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>