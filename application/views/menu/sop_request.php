<style>
#header {
    background: rgba(222, 0, 0, 0.95);
    height: 60px;
    box-shadow: 1px 2px 5px rgba(0, 0, 0, 0.2);
}
</style>

<section>
    <div class="container">

        <div class="row mt-5">

            <div class="col-12 col-sm-10 col-md-10 mx-auto">
                <!-- <div class="alert alert-warning text-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i> Website masih dalam pengembangan, untuk melakukan
                    pengajuan layanan silahkan kunjungi link berikut.
                    <br><a
                        href="https://docs.google.com/forms/d/e/1FAIpQLSfcuYD9WGyGCq4EcAU-qdt79NwKA0VNC3PgFuSYx-8yJo1NVw/viewform"
                        target="_blank" class="btn btn-danger mt-2"><i class="bi bi-pencil-square"></i> Ajukan</a>
                </div> -->
                <!-- <div class=" top-50 start-50 translate-middle"> -->
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="history.go(-1)"><i
                                        class="bi bi-arrow-left-circle-fill"></i> Back</button>
                            </div>
                        </div>
                        <div class="text-center"><b>FORM PERMOHONAN UJI ETIK PENELITIAN</b></div>
                        <hr>
                        <form action="" method="POST" class="needs-validation" enctype="multipart/form-data">
                            <div class="row my-3">
                                <label for="judul" class="col-sm-3 col-form-label">Judul Penelitian dalam Bahasa
                                    Indonesia<b class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control <?= $this->session->flashdata('judul_invalid')||form_error('judul') ? 'is-invalid' : ''; ?>"
                                            id="judul" name="judul" placeholder="Judul Penelitian"
                                            value="<?= set_value('judul'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $this->session->flashdata('judul_invalid'); ?>
                                            <?= form_error('judul'); ?>
                                        </div>
                                        <label for="judul">Masukkan Judul Penelitian</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <label for="judul_inggris" class="col-sm-3 col-form-label">Judul Penelitian dalam Bahasa
                                    Inggris<b class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control <?= $this->session->flashdata('judul_inggris_invalid')||form_error('judul_inggris') ? 'is-invalid' : ''; ?>"
                                            id="judul_inggris" name="judul_inggris" placeholder="Judul Penelitian"
                                            value="<?= set_value('judul_inggris'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $this->session->flashdata('judul_inggris_invalid'); ?>
                                            <?= form_error('judul_inggris'); ?>
                                        </div>
                                        <label for="judul">Masukkan Judul Penelitian dalam Bahasa Inggris</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kategori" class="col-sm-3 col-form-label">Kategori Penelitian<b
                                        class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <div class="form-floating">
                                        <select
                                            class="form-select <?= $this->session->flashdata('kategori_invalid') ? 'is-invalid' : ''; ?>"
                                            id="kategori" name="kategori" aria-label="Floating label select example">
                                            <option <?= empty(set_value('kategori')) ? 'selected' : '' ?>>Pilih
                                            </option>
                                            <option <?= set_value('kategori')=='Etik Uji Hewan' ? 'selected' : '' ?>
                                                value="Etik Uji Hewan">Etik Uji Hewan</option>
                                            <option
                                                <?= set_value('kategori')=='Etik Uji Sosial Humaniora' ? 'selected' : '' ?>
                                                value="Etik Uji Sosial Humaniora">Etik Uji Sosial Humaniora</option>
                                            <option <?= set_value('kategori')=='Etik Uji Klinik' ? 'selected' : '' ?>
                                                value="Etik Uji Klinik">Etik Uji Klinik</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $this->session->flashdata('kategori_invalid'); ?>
                                        </div>
                                        <label for="kategori">Kategori Penelitian</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="sumber_dana" class="col-sm-3 col-form-label">Sumber Pendanaan<b
                                        class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <div class="form-floating">
                                        <select
                                            class="form-select <?= $this->session->flashdata('sumber_dana_invalid') ? 'is-invalid' : ''; ?>"
                                            id="sumber_dana" name="sumber_dana"
                                            aria-label="Floating label select example">
                                            <option <?= empty(set_value('sumber_dana')) ? 'selected' : '' ?>>
                                                Pilih</option>
                                            <option <?= set_value('sumber_dana')=='Mandiri' ? 'selected' : '' ?>
                                                value="Mandiri">Penelitian mandiri dan tidak didanai dari manapun (S1,
                                                S2, atau S3)</option>
                                            <option <?= set_value('sumber_dana')=='Hibah/beasiswa' ? 'selected' : '' ?>
                                                value="Hibah/beasiswa">Penelitian dengan hibah/beasiswa</option>
                                            <option <?= set_value('sumber_dana')=='Lainnya' ? 'selected' : '' ?>
                                                value="Lainnya">Lainnya</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $this->session->flashdata('sumber_dana_invalid'); ?>
                                        </div>
                                        <label for="sumber_dana">Sumber Pendanaan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pemberi_hibah" class="col-sm-3 col-form-label">Pemberi Hibah/Beasiswa<b
                                        class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <div class="form-floating">
                                        <select
                                            class="form-select <?= $this->session->flashdata('pemberi_hibah_invalid') ? 'is-invalid' : ''; ?>"
                                            id="pemberi_hibah" name="pemberi_hibah"
                                            aria-label="Floating label select example">
                                            <option <?= empty(set_value('pemberi_hibah')) ? 'selected' : '' ?>>
                                                Pilih</option>
                                            <option <?= set_value('pemberi_hibah')=='Pemerintah' ? 'selected' : '' ?>
                                                value="Pemerintah">Pemerintah</option>
                                            <option <?= set_value('pemberi_hibah')=='Swasta' ? 'selected' : '' ?>
                                                value="Swasta">Swasta</option>
                                            <option <?= set_value('pemberi_hibah')=='Lainnya' ? 'selected' : '' ?>
                                                value="Lainnya">Lainnya</option>
                                            <option
                                                <?= set_value('pemberi_hibah')=='Bukan hibah/beasiswa' ? 'selected' : '' ?>
                                                value="Bukan hibah/beasiswa">Bukan hibah/beasiswa</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $this->session->flashdata('pemberi_hibah_invalid'); ?>
                                        </div>
                                        <label for="pemberi_hibah">Sebutkan pemberi hibah/beasiswa dan nilainya</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="surat_pernyataan_mandiri" class="col-sm-3 col-form-label">Surat Pernyataan
                                    Penelitian Mandiri</label>
                                <div class="col-sm-9">
                                    <div class="mb-3">
                                        <label for="surat_pernyataan_mandiri" class="form-label">Bagi penelitian mandiri
                                            dan tidak didanai dari manapun (S1, S2, atau S3) mohon upload surat
                                            pernyataan yang ditandatangani di atas materai.</label>
                                        <input
                                            class="form-control <?= $this->session->flashdata('surat_pernyataan_mandiri_invalid') ? 'is-invalid' : ''; ?>"
                                            type="file" id="surat_pernyataan_mandiri" name="surat_pernyataan_mandiri"
                                            accept="application/pdf">
                                        <div class="invalid-feedback">
                                            <?= $this->session->flashdata('surat_pernyataan_mandiri_invalid'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="formulir_etik" class="col-sm-3 col-form-label">Formulir Etik<b
                                        class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <div class="mb-3">
                                        <label for="formulir_etik" class="form-label">Upload Formulir Etik</label>
                                        <input
                                            class="form-control <?= $this->session->flashdata('formulir_etik_invalid') ? 'is-invalid' : ''; ?>"
                                            type="file" id="formulir_etik" name="formulir_etik"
                                            accept="application/pdf">
                                        <div class="invalid-feedback">
                                            <?= $this->session->flashdata('formulir_etik_invalid'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="proposal" class="col-sm-3 col-form-label">Proposal Penelitian<b
                                        class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <div class="mb-3">
                                        <label for="proposal" class="form-label">Upload Proposal Penelitian (judul,
                                            tujuan, prosedur penelitian dan instrumen)</label>
                                        <input
                                            class="form-control <?= $this->session->flashdata('proposal_invalid') ? 'is-invalid' : ''; ?>"
                                            type="file" id="proposal" name="proposal" accept="application/pdf">
                                        <div class="invalid-feedback">
                                            <?= $this->session->flashdata('proposal_invalid'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="bukti_pembayaran" class="col-sm-3 col-form-label">Bukti Pembayaran<b
                                        class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <div class="mb-3">
                                        <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                                        <input
                                            class="form-control <?= $this->session->flashdata('bukti_pembayaran_invalid') ? 'is-invalid' : ''; ?>"
                                            type="file" id="bukti_pembayaran" name="bukti_pembayaran"
                                            accept="application/pdf,image/*">
                                        <div class="invalid-feedback">
                                            <?= $this->session->flashdata('bukti_pembayaran_invalid'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-danger my-3">
                                <b>*</b>Wajib diisi
                            </div>
                            <div class="text-center">
                                <?= $this->session->flashdata('success') ? '<script>alert("Berhasil submit")</script>' : ''; ?>
                                <button type="submit" class="btn btn-danger"><i class="bi bi-pencil-square"></i>
                                    Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</section>