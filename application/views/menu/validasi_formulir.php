<style>
#header {
    background: rgba(222, 0, 0, 0.95);
    height: 60px;
    box-shadow: 1px 2px 5px rgba(0, 0, 0, 0.2);
}


th {
    white-space: nowrap;
    padding: 15px;
}

td {
    text-align: center;
    white-space: nowrap;
    padding: 15px;
}
</style>

<section>
    <div class="container">

        <div class="row mt-5">

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Pengaju</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Sumber Dana</th>
                            <th scope="col">Pemberi Hibah</th>
                            <th scope="col">Surat Pernyataan Mandiri</th>
                            <th scope="col">Formulir Etik</th>
                            <th scope="col">Proposal</th>
                            <th scope="col">Bukti Pembayaran</th>
                            <th scope="col">Status</th>
                            <th scope="col">Pesan</th>
                            <th scope="col">Dibuat</th>
                            <th scope="col">Diupdate</th>
                            <?php if($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'superadminpetugas') { ?>
                            <th>Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($query as $r) { ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $r->nama ?></td>
                            <td><?= $r->judul ?></td>
                            <td><?= $r->kategori ?></td>
                            <td><?= $r->sumber_dana ?></td>
                            <td><?= $r->pemberi_hibah ?></td>
                            <td><a href="<?= base_url() ?>uploads/<?= $r->surat_pernyataan_mandiri ?>" download><button
                                        type="button" class="btn btn-outline-secondary">Unduh</button></a>
                            </td>
                            <td><a href="<?= base_url() ?>uploads/<?= $r->formulir_etik ?>" download><button
                                        type="button" class="btn btn-outline-secondary">Unduh</button>
                                </a>
                            </td>
                            <td><a href="<?= base_url() ?>uploads/<?= $r->proposal ?>" download><button type="button"
                                        class="btn btn-outline-secondary">Unduh</button></a></td>
                            <td><a href="<?= base_url() ?>uploads/<?= $r->bukti_pembayaran ?>" download><button
                                        type="button" class="btn btn-outline-secondary">Unduh</button></a></td>
                            <td><?= $r->status ?></td>
                            <td><?= $r->pesan ?></td>
                            <td><?= $r->created_at ?></td>
                            <td><?= $r->updated_at ?></td>
                            <?php if($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'superadminpetugas') { ?>
                            <td><button type="button" class="btn btn-warning btn-sm">Update</button>
                                <button type="button" class="btn btn-primary btn-sm">Approve</button>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>