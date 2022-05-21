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
                            <?= form_open_multipart('admin/userlist/edit/' . $id); ?>
                            <div class="form-group mb-3">
                                <label class="form-label" for="image">Photo Profile</label>
                            </div>
                            <div class="form-group mb-3">
                                <img src="<?= base_url('assets/images/profile/') . $user['image']; ?>" alt="userimage" width="150px" class="image-thumbnail">
                            </div>
                            <div class="form-group mb-3">
                                <input type="file" class="form-control" id="image" name="image">
                                <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Produk" value="<?= $user['name']; ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Harga" value="<?= $user['email']; ?>" readonly>
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="is_active">Role_id </label>
                                <input class="form-input" type="number" name="role_id" id="role_id" value="<?= $user['role_id']; ?>" checked>

                                <!-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" id="role_id" name="role_id" id="role_id" value="1" autocomplete="off" checked>
                                    <label class="btn btn-outline-primary" for="role_id">Admin</label>
                                    <input type="radio" class="btn-check" id="role_id" name="role_id" id="role_id" value="2" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="role_id">Member</label>
                                </div> -->
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="is_active">Active? </label>
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                            </div>
                            <div class=" form-group mb-3">
                                <button type="submit" value="upload" class="btn btn-primary mt-3">Simpan</button>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>