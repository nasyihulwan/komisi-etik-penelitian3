<section id="auth">
    <div class="container">
        <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php elseif ($this->session->flashdata('danger')) : ?>
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
                                <a href="<?= base_url() ?>" class="btn btn-sm btn-outline-danger"><i
                                        class="bi bi-house-fill"></i> Home</a>
                            </div>

                            <div class="col-6 ms-auto text-end">
                                <a href="<?= base_url('auth') ?>" class="btn btn-sm btn-outline-danger">Have an account?
                                    Login here</a>
                            </div>
                        </div>
                        <div class="text-center"><b>Lupa Password</b></div>
                        <hr>
                        <form action="<?= base_url('auth/lupa_password') ?>" method="POST" class="needs-validation">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text"
                                    class="form-control <?= $this->session->flashdata('email_invalid')||form_error('email') ? 'is-invalid' : ''; ?>"
                                    id="email" name="email" value="<?= set_value('email'); ?>">
                                <div class="form-text">We'll never share your email with anyone else.</div>
                                <div class="invalid-feedback">
                                    <?= form_error('email') ?>
                                    <?= $this->session->flashdata('email_invalid'); ?>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-danger"><i class="bi bi-arrow-return-right"></i>
                                    Kirim Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
        </defs>
        <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
        </g>
        <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
        </g>
        <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
        </g>
    </svg>
</section>