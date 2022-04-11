        <!-- Main Frame -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><?= $judul ?></h1>
                    <div class="row">
                        <div class="col-lg">
                            <?php if (validation_errors()) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= validation_errors(); ?>
                                </div>
                            <?php endif; ?>
                            <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newSubMenuModal">Add New SubMenu</a>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($products as $p) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><img src="<?= base_url('assets/images/') . $p['gambar']; ?>" alt="poster" width="75px"></td>
                                            <td><?= $p['nama_produk']; ?></td>
                                            <td>Rp. <?= $p['harga']; ?></td>
                                            <td><?= $p['stok']; ?></td>
                                            <td><?= $p['keterangan']; ?></td>
                                            <td><?= $p['kategori']; ?></td>
                                            <td>
                                                <a href="#" class="badge bg-success">Edit</a>
                                                <a href="#" class="badge bg-danger">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newSubMenuModalLabel">Add New SubMenu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url('menu/submenu') ?>" method="POST">
                                <div class="modal-body">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="SubMenu Title" id="title" name="title">
                                    </div>
                                    <div class="input-group mt-3">
                                        <select name="menu_id" id="menu_id" class="form-control">
                                            <option value="">Select Menu</option>
                                            <?php foreach ($menu as $m) : ?>
                                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="input-group mt-3">
                                        <input type="text" class="form-control" placeholder="SubMenu Url" id="url" name="url">
                                    </div>
                                    <div class="input-group mt-3">
                                        <input type="text" class="form-control" placeholder="SubMenu Icon" id="icon" name="icon">
                                    </div>
                                    <div class="input-group mt-3 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                                            Active?
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>