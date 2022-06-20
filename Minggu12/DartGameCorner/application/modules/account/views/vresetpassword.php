<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <div class="login-logo text-decoration-none">
                                    <h1><a href="<?= base_url() ?>"><img src="<?= base_url('assets/images/logo.png') ?>" alt="" width="30" height="24" class="d-inline-block mb-2">
                                            <b>Dart</b>GameCorner</a></h1>
                                </div>
                                <h3 class="text-center font-weight-light my-4">Password Reset</h3>
                            </div>
                            <div class="card-body">
                                <div class="small mb-3 text-muted">Enter your new password for <?= $this->session->userdata('reset_email'); ?>.</div>
                                <?php if ($this->session->flashdata('flash')) {
                                    echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
                                } ?>
                                <form method="POST" action="<?= base_url('account/recovery/resetpassword'); ?>">
                                    <?= form_error('newpassword1', '<small class="text-danger">', '</small>'); ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="newpassword1" name="newpassword1" type="password" placeholder="New Password" />
                                        <label for="newpassword1">New Password</label>
                                    </div>
                                    <?= form_error('newpassword2', '<small class="text-danger">', '</small>'); ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="newpassword2" name="newpassword2" type="password" placeholder="Repeat New Password" />
                                        <label for="newpassword2">Repeat New Password</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button type="submit" class="btn btn-primary">Reset Password</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="<?= base_url() ?>account/register">Need an account? Sign up!</a></div>
                                <a href="<?= base_url(); ?>home">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>