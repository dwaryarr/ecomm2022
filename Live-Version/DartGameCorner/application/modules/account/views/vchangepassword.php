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
                            <?= form_open_multipart('account/edit/changepassword'); ?>
                            <div class="form-group mb-3">
                                <label class="form-label" for="currentPassword">Current Password</label>
                                <input type="password" class="form-control" id="currentPassword" name="currentPassword">
                                <?= form_error('currentPassword', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="newPassword1">New Password</label>
                                <input type="password" class="form-control" id="newPassword1" name="newPassword1">
                                <?= form_error('newPassword1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="newPassword2">Repeat Password</label>
                                <input type="password" class="form-control" id="newPassword2" name="newPassword2">
                                <?= form_error('newPassword2', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class=" form-group mb-3">
                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>