<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <div class="login-logo text-decoration-none">
                                    <h1><a href="<?= base_url() ?>"><img src="<?= base_url('assets/images/logo.png') ?>" alt="" width="30" height="24" class="d-inline-block mb-2">
                                            <b>Dart</b>GameCorner</a></h1>
                                </div>
                                <h3 class="text-center font-weight-light my-4">Create Account</h3>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('account/register'); ?>" method="POST">
                                    <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="name" name="name" type="text" placeholder="Enter your first name" value="<?= set_value('name'); ?>" />
                                        <label for="inputFirstName">Full Name</label>
                                    </div>
                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" value="<?= set_value('email'); ?>" />
                                        <label for="inputEmail">Email address</label>
                                    </div>
                                    <div class="row mb-3">
                                        <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="password1" name="password1" type="password" placeholder="Create a password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="password2" name="password2" type="password" placeholder="Confirm password" />
                                                <label for="inputPasswordConfirm">Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid"><button type="submit" class="btn btn-primary btn-block">Register</button></div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="<?= base_url() ?>account/login">Have an account? Go to login</a></div>
                                <a href="<?= base_url(); ?>home">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>