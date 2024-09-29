<section id="auth">
<div class="container">
    <?php if ($this->session->userdata('success')) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->userdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php elseif ($this->session->userdata('danger')) : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->userdata('danger') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif ?>
    <div class="row">
        <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-auto">
            <!-- <div class=" top-50 start-50 translate-middle"> -->
                <div class="card shadow">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-3">
                          <a href="<?= base_url() ?>" class="btn btn-sm btn-outline-danger"><i class="bi bi-house-fill"></i> Home</a>
                        </div> 
                        <div class="col-6 ms-auto text-end">
                          <a href="<?= base_url('auth') ?>" class="btn btn-sm btn-outline-danger">Have an account? Login here</a>
                        </div> 
                      </div>                 
                      <div class="text-center"><b>USER REGISTRATION</b></div>
                      <hr>
                      <form action="<?= base_url('auth/user_registration') ?>" method="POST" class="needs-validation">
                        <div class="row mb-3">
                          <label for="nama" class="col-sm-2 col-form-label">Fullname</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= $this->session->userdata('nama_invalid')||form_error('nama') ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= set_value('nama'); ?>">
                            <div class="invalid-feedback">
                              <?= form_error('nama'); ?>
                              <?= $this->session->userdata('nama_invalid'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="email" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control <?= $this->session->userdata('email_invalid')||form_error('email') ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= set_value('email'); ?>">
                            <div class="invalid-feedback">
                              <?= form_error('email'); ?>
                              <?= $this->session->userdata('email_invalid'); ?>
                            </div>
                          </div>
                        </div>
                        <!-- <div class="row mb-3">
                          <label for="password" class="col-sm-2 col-form-label">Password</label>                          
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="password">
                            <input type="checkbox" class="form-check-input" id="showPass" onclick="lihatPass()">
                            <label class="form-check-label" for="showPass">Show Password</label>
                          </div>
                        </div> -->
                        <div class="row mb-3">
                          <label for="hp" class="col-sm-2 col-form-label">Mobile Phone</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= $this->session->userdata('hp_invalid')||form_error('hp') ? 'is-invalid' : ''; ?>" id="hp" name="hp" value="<?= set_value('hp'); ?>">
                            <div class="invalid-feedback">
                              <?= form_error('hp'); ?>
                              <?= $this->session->userdata('hp_invalid'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="org" class="col-sm-2 col-form-label">Organization</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= $this->session->userdata('org_invalid')||form_error('org') ? 'is-invalid' : ''; ?>" id="org" name="org" value="<?= set_value('org'); ?>">
                            <div class="invalid-feedback">
                              <?= form_error('org'); ?>
                              <?= $this->session->userdata('org_invalid'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="negara" class="col-sm-2 col-form-label">Country</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= $this->session->userdata('negara_invalid')||form_error('negara') ? 'is-invalid' : ''; ?>" id="negara" name="negara" value="<?= set_value('negara'); ?>">
                            <div class="invalid-feedback">
                              <?= form_error('negara'); ?>
                              <?= $this->session->userdata('negara_invalid'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="kota" class="col-sm-2 col-form-label">City</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= $this->session->userdata('kota_invalid')||form_error('kota') ? 'is-invalid' : ''; ?>" id="kota" name="kota" value="<?= set_value('kota'); ?>">
                            <div class="invalid-feedback">
                              <?= form_error('kota'); ?>
                              <?= $this->session->userdata('kota_invalid'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn btn-danger"><i class="bi bi-pencil-square"></i> Register as User</button>
                        </div>
                      </form>
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </div>    
</div>
<svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
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