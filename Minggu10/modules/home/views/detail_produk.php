<div class="container">
    <div class="row-lg mt-5">
        <h2>Detail Produk</h2>
        <img src="<?= base_url('assets/images/produk/') . $products['gambar']; ?>" class="rounded" width="50%">
    </div>
    <div class="row-lg mt-5">
        <div class="card">
            <div class=" card-body">
                <h5 class="card-title"><?= $products['nama_produk']; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= $products['kategori']; ?></h6>
                <div class="card mb-2" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Keterangan</h5>
                        <p class="card-text"><?= $products['keterangan']; ?></p>
                    </div>
                </div>
                <h6>Harga : Rp. <?php echo number_format($products['harga'], 0, ",", "."); ?></h6>
                <a href="#" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i> Tambah ke Keranjang</a>
                <a href="<?= base_url() ?>home" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
</div>
</div>