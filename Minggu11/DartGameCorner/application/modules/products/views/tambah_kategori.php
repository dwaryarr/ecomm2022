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
                            <?= form_open_multipart('products/tambahkategori'); ?>
                            <div class="form-group mb-3">
                                <label class="form-label" for="nama_kategori">Nama Produk</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Nama Produk">
                                <?= form_error('nama_kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" value="upload" class="btn btn-primary mt-3">Tambah</button>
                                <script></script>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($kategori as $k) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $k['nama_kategori']; ?></td>
                                            <td>
                                                <a href="<?= base_url('products/hapuskategori/') . $k['id_kategori']; ?>" class="badge bg-danger"><i class="fas fa-trash-can"></i> Delete</a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>