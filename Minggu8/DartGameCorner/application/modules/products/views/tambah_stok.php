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
                                <label class="form-label" for="nama_produk">Nama Produk</label>
                                <select class="form-control" name="nama_produk" id="nama_produk">
                                    <option value="">Pilih Nama Produk</option>
                                    <option value="Game Online">Game Online</option>
                                    <option value="Akun Game Online">Akun Game Online</option>
                                </select>
                                <?= form_error('nama_produk', '<small class="text-danger pl-3">', '</small>'); ?>
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