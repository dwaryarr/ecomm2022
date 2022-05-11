        <!-- Main Frame -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row">
                        <h1 class="mt-4"><?= $judul ?></h1>
                        <!-- form tambah produk -->
                        <?php if ($this->session->flashdata('flash')) {
                            echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
                        } ?>
                        <div class="col-md-6">
                            <?= form_open_multipart('products/tambah'); ?>
                            <div class="form-group mb-3">
                                <label class="form-label" for="gambar">Gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar">
                                <?= form_error('gambar', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="nama_produk">Nama Produk</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk">
                                <?= form_error('nama_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga">
                                <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok">
                                <?= form_error('stok', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Produk" rows="3"></textarea>
                                <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="kategori">Kategori</label>
                                <select class="form-control" id="kategori" name="kategori">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Game Online">Game Online</option>
                                    <option value="Akun Game Online">Akun Game Online</option>
                                </select>
                                <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                                <button type="submit" value="upload" class="btn btn-primary mt-3">Tambah</button>
                                <script></script>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>