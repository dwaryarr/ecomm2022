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
                            <?= form_open_multipart('products/tambahstok'); ?>
                            <div class="form-group mb-3">
                                <label class="form-label" for="id_produk">Nama Produk</label>
                                <select class="form-control" name="id_produk" id="id_produk">
                                    <option value="">Pilih Nama Produk</option>
                                    <?php foreach ($products as $p) : ?>
                                        <option value="<?= $p['id_produk']; ?>"><?= $p['nama_produk']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok">
                                <?= form_error('stok', '<small class="text-danger pl-3">', '</small>'); ?>
                                <button type="submit" value="upload" class="btn btn-primary mt-3">Tambah</button>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>