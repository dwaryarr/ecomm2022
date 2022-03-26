<div class="login-box">
    <div class="login-logo">
        <a href="<?= base_url() ?>"><b>Dart</b>GameCorner</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <?php if ($this->session->flashdata('sukses')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('sukses') . '</p>';
            } ?>
            <form action="<?= base_url('account/login') ?>" method="post">
                <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= set_value('email') ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" value="Login" name="btnSubmit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
                <center>
                    <br>
                    <a href="<?= base_url(); ?>account/register" class="text-center">Register a new membership</a>

            </form>
            <br>
            <a href="<?= base_url(); ?>home">Back to Home</a>
            </center>
        </div>

        <!-- <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
        </p> -->
    </div>
    <!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->