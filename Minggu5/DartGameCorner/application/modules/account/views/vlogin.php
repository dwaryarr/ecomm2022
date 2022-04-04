<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <div class="login-logo text-decoration-none">
                                    <a href="<?= base_url() ?>"><b>Dart</b>GameCorner</a>
                                </div>
                                <h3 class="text-center font-weight-light my-4">Login</h3>
                            </div>
                            <div class="card-body">
                                <?php if ($this->session->flashdata('sukses')) {
                                    echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('sukses') . '</p>';
                                } ?>
                                <form action="<?= base_url('account/login') ?>" method="post">
                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="email" id="email" name="email" placeholder="name@example.com" value="<?= set_value('email') ?>" />
                                        <label for="inputEmail">Email address</label>
                                    </div>
                                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Password" />
                                        <label for="inputPassword">Password</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                        <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="<?= base_url() ?>account/recovery">Forgot Password?</a>
                                        <button type="submit" value="Login" name="btnSubmit" class="btn btn-primary btn-block">Login</button>
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