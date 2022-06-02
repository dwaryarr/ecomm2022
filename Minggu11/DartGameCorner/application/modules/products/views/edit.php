        <!-- Main Frame -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row">
                        <h1 class="mt-4"><?= $judul ?></h1>
                        <!-- form edit produk -->
                        <?php if ($this->session->flashdata('flash')) {
                            echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
                        } ?>
                        <div class="col-md-6">
                            <?= form_open_multipart('products/edit/' . $id_produk); ?>
                            <div class="form-group mb-3">
                                <label class="form-label" for="gambar">Gambar</label>
                            </div>
                            <div class="form-group mb-3">
                                <img src="<?= base_url('assets/images/produk/') . $products['gambar']; ?>" alt="userimage" width="150px" class="image-thumbnail">
                            </div>
                            <div class="form-group mb-3">
                                <input type="file" class="form-control" id="gambar" name="gambar">
                                <?= form_error('gambar', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="nama_produk">Nama Produk</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" value="<?= $products['nama_produk']; ?>">
                                <?= form_error('nama_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" value="<?= $products['harga']; ?>">
                                <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class=" form-group mb-3">
                                <label class="form-label" for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok" value="<?= $products['stok']; ?>">
                                <?= form_error('stok', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class=" form-group mb-3">
                                <label class="form-label" for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Produk" rows="3"><?= $products['keterangan']; ?></textarea>
                                <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class=" form-group mb-3">
                                <label class="form-label" for="kategori">Kategori</label>
                                <select class="form-control" id="kategori" name="kategori">
                                    <option value="<?= $products['kategori']; ?>"><?= $products['kategori']; ?></option>
                                    <?php foreach ($kategori as $k) : ?>
                                        <option value="<?= $k['nama_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                                <button type="submit" value="upload" class="btn btn-primary mt-3">Simpan</button>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>