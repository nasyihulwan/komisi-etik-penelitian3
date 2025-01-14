<section id="auth">
    <div class="container">
        <?php if ($this->session->flashdata('danger')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('danger') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif ?>
        <div class="row">
            <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <a href="<?= base_url() ?>" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-house-fill"></i> Home
                                </a>
                            </div>
                        </div>
                        <div class="text-center"><b>Reset Password</b></div>
                        <hr>
                        <form action="<?= base_url('auth/do_reset_password') ?>" method="POST" class="needs-validation">
                            <input type="hidden" name="token" value="<?= $token ?>">

                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div class="form-text">Minimal 6 karakter</div>
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirm_password"
                                    name="confirm_password" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-check-circle"></i> Reset Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>