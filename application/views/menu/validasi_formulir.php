<style>
.swal2-popup-wide {
    padding: 1.5rem;
}

.swal2-popup-wide .swal2-html-container {
    margin: 1em 0;
}

.swal2-popup textarea.form-control {
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

.swal2-popup textarea {
    width: 100% !important;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.form-select-lg {
    padding: 0.5rem 1rem;
    font-size: 1rem;
    width: 100%;
}
</style>

<!-- Sweetalert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<section>
    <div class="container">
        <div class="row mt-5">
            <div class="mb-3">
                <h2><b>Uji Etik Penelitian</b></h2>
                <h6>List semua permohonan</h6>
            </div>

            <?php if ($this->session->userdata('level') != 'member') { ?>





            <div class="table-responsive">
                <table id="dataTable" class="table table-striped text-center">
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
                            <td class="text-center">
                                <a href="<?= base_url() ?>uploads/<?= $r->surat_pernyataan_mandiri ?>" download>
                                    <span class="badge bg-secondary" style="cursor: pointer;">Unduh</span>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url() ?>uploads/<?= $r->formulir_etik ?>" download>
                                    <span class="badge bg-secondary" style="cursor: pointer;">Unduh</span>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url() ?>uploads/<?= $r->proposal ?>" download>
                                    <span class="badge bg-secondary" style="cursor: pointer;">Unduh</span>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url() ?>uploads/<?= $r->bukti_pembayaran ?>" download>
                                    <span class="badge bg-secondary" style="cursor: pointer;">Unduh</span>
                                </a>
                            </td>

                            <td>
                                <?php 
                                    $statusClass = '';
                                    switch($r->status) {
                                        case 'belum diperiksa':
                                            $statusClass = 'badge bg-secondary';
                                            break;
                                        case 'belum diperbaiki':
                                            $statusClass = 'badge bg-warning';
                                            break;
                                        case 'ditolak':
                                            $statusClass = 'badge bg-danger';
                                            break;
                                        case 'disetujui':
                                            $statusClass = 'badge bg-success';
                                            break;
                                        case 'sudah diperbaiki':
                                            $statusClass = 'badge bg-warning';
                                            break;
                                    }
                                ?>
                                <span class="<?= $statusClass ?>"><?= $r->status ?></span>

                                <?php if ($r->status == "disetujui") { ?>
                                <br><br>
                                <span class="badge bg-info text-white" style="cursor: pointer;"
                                    onclick="showApprovedFiles(<?= $r->id_sop ?>)">
                                    Lihat File Persetujuan
                                </span>
                                <?php } else if($r->status == "sudah diperbaiki") { ?>
                                <br><br>
                                <span class="badge bg-info text-white" style="cursor: pointer;"
                                    onclick="showRevisionFiles(<?= $r->id_sop ?>)">
                                    Lihat File Revisi
                                </span>
                                <?php } ?>
                            </td>
                            <td class="text-center">

                                <?php if ($r->status == "belum diperbaiki" || $r->status == "sudah diperbaiki") { ?>
                                <?php if (!empty($r->pesan)) { ?>
                                <span class="badge bg-info text-white" style="cursor: pointer;"
                                    onclick="showMessage('<?= htmlspecialchars($r->pesan, ENT_QUOTES) ?>', <?= $r->id_sop ?>)">
                                    Lihat Pesan
                                </span>
                                <?php } ?>
                                <?php } else { ?>
                                <span class="badge bg-secondary">-</span>
                                <?php } ?>
                            </td>
                            <td><?= $r->created_at ?></td>
                            <td><?= $r->updated_at ?></td>

                            <?php if($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'superadminpetugas') { ?>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm"
                                    onclick="showUpdatePopup('<?= $r->id_sop ?>')">Update</button>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


        </div>
        <?php } else if ($this->session->userdata('level') == 'member') { ?>
        <?php $no = 1; foreach($query as $r) { ?>

        <div class="card mb-3">
            <div class="card-body">
                <small><?= $r->kategori ?></small>
                <h5 class="card-title"><b>
                        <?= $r->judul ?>
                    </b><br></h5>
                <div class="card-text mt-3">
                    <h6><b>Nama Pengaju: </b> <br> <small><?= $r->nama ?></small></h6>
                    <a href="<?= base_url('menu/formulir_detail/') ?><?= $r->id_sop ?>" class="btn btn-primary">Detail
                        <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
</section>


<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>




<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "paging": true,
        "searching": true,
        "responsive": true,
        "lengthChange": true,
        "pageLength": 10,
        "language": {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ entri",
            "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
            "paginate": {
                "next": "Berikutnya",
                "previous": "Sebelumnya"
            }
        }
    });
});

function showUpdatePopup(id_sop) {
    Swal.fire({
        title: 'Update Status',
        html: `
            <div class="container-fluid">
                <div class="mb-3">
                    <select id="status" class="form-select form-select-lg mb-3">
                        <option value="">Pilih Status</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                        <option value="belum diperbaiki">Diperbaiki</option>
                    </select>
                </div>
                
                <div id="pesanContainer" style="display:none;">
                    <div class="mb-3">
                        <textarea 
                            class="form-control" 
                            id="pesan" 
                            rows="4"
                            style="width: 100%;"
                            placeholder="Masukkan pesan perbaikan"
                        ></textarea>
                        <div class="form-text mb-3">
                            Jelaskan apa saja yang perlu diperbaiki
                        </div>
                    </div>
                </div>

                <div id="fileContainer" style="display:none;">
                    <div class="mb-3">
                        <label for="fileUpload" class="form-label">Upload File (Maksimal 5 file)</label>
                        <input type="file" class="form-control" id="fileUpload" multiple 
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png"
                            onchange="validateFiles(this)">
                        <div class="form-text">
                            Format yang diizinkan: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG (Maks. 2MB per file)
                        </div>
                    </div>
                </div>
            </div>
        `,
        customClass: {
            popup: 'swal2-popup-wide',
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        width: '32rem',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal',
        buttonsStyling: false,
        didOpen: () => {
            document.getElementById('status').addEventListener('change', function(e) {
                const pesanContainer = document.getElementById('pesanContainer');
                const fileContainer = document.getElementById('fileContainer');
                const pesan = document.getElementById('pesan');

                if (e.target.value === 'belum diperbaiki') {
                    pesanContainer.style.display = 'block';
                    fileContainer.style.display = 'block';
                    pesan.style.display = 'block';
                } else if (e.target.value === 'disetujui') {
                    pesanContainer.style.display = 'none';
                    fileContainer.style.display = 'block';
                    pesan.style.display = 'none';
                } else {
                    pesanContainer.style.display = 'none';
                    fileContainer.style.display = 'none';
                    pesan.style.display = 'none';
                }
            });
        },
        preConfirm: () => {
            const status = document.getElementById('status').value;
            const pesan = document.getElementById('pesan').value;
            const fileInput = document.getElementById('fileUpload');
            const files = fileInput.files;

            if (status === "") {
                Swal.showValidationMessage('Harap pilih status!');
                return false;
            }

            if (status === "belum diperbaiki" && pesan.trim() === "") {
                Swal.showValidationMessage('Harap isi pesan untuk status diperbaiki!');
                return false;
            }

            if (status === "disetujui" && files.length === 0) {
                Swal.showValidationMessage('Harap upload file untuk status disetujui!');
                return false;
            }

            return {
                status,
                pesan,
                files
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('id_sop', id_sop);
            formData.append('status', result.value.status);
            formData.append('pesan', result.value.pesan);

            const files = result.value.files;
            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            Swal.showLoading();
            fetch('<?= base_url('menu/update_status') ?>', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(async response => {
                    const responseText = await response.text();
                    if (!response.ok) {
                        throw new Error(
                            `HTTP error! status: ${response.status}, body: ${responseText}`);
                    }
                    try {
                        return JSON.parse(responseText);
                    } catch (e) {
                        throw new Error('Server response was not in JSON format');
                    }
                })
                .then(data => {
                    Swal.hideLoading();
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            customClass: {
                                confirmButton: 'btn btn-success'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Terjadi kesalahan!');
                    }
                })
                .catch(error => {
                    Swal.hideLoading();
                    console.error('Full error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: error.message,
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                });
        }
    });
}

function validateFiles(input) {
    if (input.files.length > 5) {
        alert('Maksimal 5 file yang dapat diupload!');
        input.value = '';
        return;
    }

    const maxSize = 2 * 1024 * 1024; // 2MB
    for (let i = 0; i < input.files.length; i++) {
        if (input.files[i].size > maxSize) {
            alert('File ' + input.files[i].name + ' melebihi 2MB!');
            input.value = '';
            return;
        }
    }
}
</script>

<script>
function showMessage(message, id_sop) {
    fetch('<?= base_url('menu/get_pesan_files/') ?>' + id_sop)
        .then(response => response.json())
        .then(files => {
            console.log('Fetched files:', files);

            let filesHtml = '';
            if (files && files.length > 0) {
                filesHtml = `
                    <div class="mt-4">
                        <h6>File Pendukung:</h6>
                        <ul class="list-unstyled">
                `;
                files.forEach(file => {
                    const fileName = file.file_name || '';
                    const originalName = file.original_name || fileName;
                    const fileUrl = '<?= base_url('uploads/pesan_files/') ?>' + fileName;

                    filesHtml += `
                        <li class="mb-2">
                            <a href="${fileUrl}" 
                               target="_blank"
                               class="btn btn-sm btn-outline-primary"
                               title="${originalName}">
                                ${originalName}
                            </a>
                        </li>`;
                });
                filesHtml += `
                        </ul>
                    </div>`;
            }

            // Only show upload form for non-admin users
            const userLevel = '<?= $this->session->userdata('level') ?>';
            const uploadFormHtml = (userLevel !== 'superadmin' && userLevel !== 'petugas') ? `
                <div class="mt-4">
                    <h6 class="mb-3">Upload File Perbaikan:</h6>
                    
                    <div class="mb-3">
                        <label class="form-label">Surat Pernyataan Mandiri</label>
                        <input type="file" class="form-control mb-2" id="surat_mandiri" accept=".pdf,.doc,.docx">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Formulir Etik</label>
                        <input type="file" class="form-control mb-2" id="formulir_etik" accept=".pdf,.doc,.docx">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Proposal</label>
                        <input type="file" class="form-control mb-2" id="proposal" accept=".pdf,.doc,.docx">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bukti Pembayaran</label>
                        <input type="file" class="form-control mb-2" id="bukti_pembayaran" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    </div>

                    <div class="form-text mb-3">
                        Format yang diizinkan: PDF, DOC, DOCX (Maks. 2MB per file)<br>
                        Format Bukti Pembayaran: PDF, DOC, DOCX, JPG, JPEG, PNG
                    </div>

                    <button type="button" class="btn btn-primary" onclick="submitRevision(${id_sop})">
                        Submit Perbaikan
                    </button>
                </div>
            ` : '';

            Swal.fire({
                title: 'Pesan Perbaikan',
                html: `
                    <div class="text-start">
                        <p>${message}</p>
                        ${filesHtml}
                        ${uploadFormHtml}
                    </div>
                `,
                icon: 'info',
                customClass: {
                    popup: 'swal2-popup-wide',
                    confirmButton: 'btn btn-secondary'
                },
                width: '40rem',
                buttonsStyling: false,
                confirmButtonText: 'Tutup',
            });
        })
        .catch(error => {
            console.error('Error fetching files:', error);
            Swal.fire({
                title: 'Error',
                text: 'Gagal mengambil data file pendukung',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        });
}
</script>

<script>
function submitRevision(id_sop) {
    const formData = new FormData();
    formData.append('id_sop', id_sop);
    formData.append('status', 'sudah diperbaiki');

    // Get all revision files
    const fileFields = [
        'surat_mandiri',
        'formulir_etik',
        'proposal',
        'bukti_pembayaran'
    ];

    let hasFiles = false;
    fileFields.forEach(field => {
        const fileInput = document.getElementById(field);
        if (fileInput && fileInput.files[0]) {
            formData.append(field, fileInput.files[0]);
            hasFiles = true;
        }
    });

    if (!hasFiles) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Harap upload minimal satu file perbaikan!',
            customClass: {
                confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });
        return;
    }

    // Debug: Log FormData contents
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }

    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin mengirim file perbaikan ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Kirim',
        cancelButtonText: 'Batal',
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.showLoading();

            fetch('<?= base_url('menu/update_revisi') ?>', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(async response => {
                    const responseText = await response.text();
                    if (!response.ok) {
                        throw new Error(
                            `HTTP error! status: ${response.status}, body: ${responseText}`);
                    }
                    try {
                        return JSON.parse(responseText);
                    } catch (e) {
                        throw new Error('Server response was not in JSON format');
                    }
                })
                .then(data => {
                    Swal.hideLoading();
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message || 'File perbaikan berhasil dikirim',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Terjadi kesalahan pada server!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.hideLoading();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: error.message || 'Terjadi kesalahan saat mengirim file',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                });
        }
    });
}
</script>

<script>
function showApprovedFiles(id_sop) {
    // Gunakan URL lengkap dari PHP
    fetch('<?= base_url('menu/get_disetujui_files/') ?>' + id_sop)
        .then(response => response.json())
        .then(files => {
            let filesHtml = '';
            if (files.length > 0) {
                filesHtml = `
                    <div class="mt-4">
                        <h6>File Disetujui:</h6>
                        <ul class="list-unstyled">`;

                files.forEach(file => {
                    filesHtml += `
                        <li class="mb-2">
                            <a href="<?= base_url('uploads/disetujui_files/') ?>${file.file_name}" 
                               target="_blank"
                               class="btn btn-sm btn-outline-primary">
                                ${file.original_name}
                            </a>
                        </li>`;
                });

                filesHtml += `
                        </ul>
                    </div>`;
            } else {
                filesHtml = '<div class="text-center">Tidak ada file yang tersedia</div>';
            }

            Swal.fire({
                title: 'File yang Disetujui',
                html: filesHtml,
                icon: 'info',
                customClass: {
                    popup: 'swal2-popup-wide',
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false,
                confirmButtonText: 'Tutup'
            });
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error',
                text: 'Gagal memuat file yang disetujui',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        });
}
</script>

<script>
function showRevisionFiles(id_sop) {
    fetch('<?= base_url('menu/get_revision_files/') ?>' + id_sop)
        .then(response => response.json())
        .then(files => {
            let filesHtml = '';
            if (files && files.length > 0) {
                filesHtml = `
                    <div class="mt-4">
                        <h6>File Revisi:</h6>
                        <ul class="list-unstyled">
                `;
                files.forEach(file => {
                    const fileName = file.file_name || '';
                    const originalName = file.original_name || fileName;
                    const fileUrl = '<?= base_url('uploads/revisi_files/') ?>' + fileName;

                    filesHtml += `
                        <li class="mb-2">
                            <a href="${fileUrl}" 
                               target="_blank"
                               class="btn btn-sm btn-outline-primary"
                               title="${originalName}">
                                ${originalName}
                            </a>
                        </li>`;
                });
                filesHtml += `
                        </ul>
                    </div>`;
            } else {
                filesHtml = '<div class="text-center">Tidak ada file yang tersedia</div>';
            }

            Swal.fire({
                title: 'File Revisi',
                html: filesHtml,
                icon: 'info',
                customClass: {
                    popup: 'swal2-popup-wide',
                    confirmButton: 'btn btn-primary'
                },
                width: '40rem',
                buttonsStyling: false,
                confirmButtonText: 'Tutup'
            });
        })
        .catch(error => {
            console.error('Error fetching files:', error);
            Swal.fire({
                title: 'Error',
                text: 'Gagal memuat file revisi',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        });
}
</script>