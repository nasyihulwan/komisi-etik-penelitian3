<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
<style>
.card {
    border-radius: 8px;
    border: 1px solid #dee2e6;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    background: #fff;
}

.card-header {
    background: #fff;
    border-bottom: 1px solid #dee2e6;
    padding: 15px 20px;
}

.card-title {
    font-size: 1.25rem;
    margin: 0;
    font-weight: 500;
}

.card-body {
    padding: 20px;
}

.proposal-section {
    margin-bottom: 20px;
}

.proposal-section-title {
    font-weight: 500;
    margin-bottom: 5px;
    color: #212529;
}

.proposal-section-content {
    color: #495057;
    margin-bottom: 5px;
}

.member-item {
    margin-bottom: 8px;
}

/* Timeline Styles */
.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline::before {
    content: '';
    position: absolute;
    width: 2px;
    background: #dee2e6;
    top: 0;
    bottom: 0;
    left: 110px;
}

.timeline-item {
    position: relative;
    margin-bottom: 25px;
}

.timeline-date {
    width: 95px;
    text-align: right;
    position: absolute;
    left: 0;
    top: 10px;
    font-size: 0.85rem;
    color: #6c757d;
}

.timeline-badge {
    position: absolute;
    left: 101px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
}

.timeline-badge.success {
    background: #28a745;
}

.timeline-badge i {
    color: white;
    font-size: 12px;
}

.timeline-content {
    margin-left: 140px;
    padding-top: 5px;
}

.timeline-title {
    margin: 0;
    font-size: 1rem;
    font-weight: 500;
    color: #212529;
}

.timeline-file {
    margin-top: 8px;
    font-size: 0.9rem;
    color: #6c757d;
}

.review-card {
    margin-top: 10px;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    background: #f8f9fa;
}

.review-header {
    padding: 10px 15px;
    border-bottom: 1px solid #dee2e6;
    background: #fff;
    font-weight: 500;
}

.review-content {
    padding: 15px;
}

.download-btn {
    display: inline-block;
    padding: 6px 12px;
    margin-top: 10px;
    background: #6c757d;
    color: white;
    border-radius: 4px;
    text-decoration: none;
    font-size: 0.9rem;
}
</style>

<section>
    <div class="container">
        <div class="row mt-5">

            <div class="d-flex justify-content-end mb-3">
                <a href="<?= base_url() ?>menu/validasi_formulir" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
            <!-- Proposal Card -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title"><b>Permohonan Etik Penelitian</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="proposal-section">
                            <div class="proposal-section-title"><b>Kategori</b></div>
                            <div class="proposal-section-content"><?= $sop['kategori'] ?></div>
                        </div>

                        <div class="proposal-section">
                            <div class="proposal-section-title"><b>Judul dalam Bahasa Indonesia</b></div>
                            <div class="proposal-section-content"><?= $sop['judul'] ?></div>
                        </div>
                        <div class="proposal-section">
                            <div class="proposal-section-title"><b>Judul dalam Bahasa Inggris</b></div>
                            <div class="proposal-section-content"><?= $sop['judul_inggris'] ?></div>
                        </div>
                        <div class="proposal-section">
                            <div class="proposal-section-title"><b>Sumber Dana</b></div>
                            <div class="proposal-section-content"><?= $sop['sumber_dana'] ?></div>
                        </div>

                        <div class="proposal-section">
                            <div class="proposal-section-title"><b>Pemberi Hibah</b></div>
                            <div class="proposal-section-content"><?= $sop['pemberi_hibah'] ?></div>
                        </div>

                        <div class="proposal-section">
                            <div class="proposal-section-title"><b>Pemohon</b></div>
                            <div class="proposal-section-content"><?= $member['nama'] ?></div>
                            <div class="proposal-section-content"><?= $member['email'] ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline Card -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title"><b>Status Terakhir</b></h5>
                        <?php
                        // Ambil elemen pertama dari $history (jika ada)
                        $item = isset($history[0]) ? $history[0] : null;
                        // Periksa apakah elemen pertama memenuhi kondisi
                        if ($item['status'] == 'belum diperbaiki' && !$item['has_submitted_revision'] && !$item['has_approved'] ): ?>
                        <span class="badge bg-info text-white" style="cursor: pointer;"
                            onclick="showMessage('<?= htmlspecialchars($sop['pesan'], ENT_QUOTES) ?>', <?= $sop['id_sop'] ?>)">
                            Upload Revisi
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <?php foreach ($history as $item): ?>
                            <div class="timeline-item">
                                <div class="timeline-badge <?= $item['badge_class'] ?>">
                                    <i class="bi bi-<?= $item['badge_icon'] ?>"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        <?= $item['title'] ?>
                                        <span class="timeline-date"><?= $item['date'] ?></span>
                                    </div>
                                    <?php if ($item['has_revision'] && empty($item['has_submitted_revision'])): ?>

                                    <div class="review-card">
                                        <div class="review-header">
                                            Hasil Review
                                        </div>
                                        <div class="review-content">
                                            <?= $item['review_message'] ?>
                                            <?php foreach ($item['review_files'] as $file): ?>
                                            <a href="<?= base_url($file['path']) ?>" class="download-btn">
                                                <i class="bi bi-download"></i>
                                                <?= $file['name'] ?>
                                            </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ($item['has_submitted_revision']): ?>

                                    <div class="review-card">
                                        <div class="review-header">
                                            File Revisi
                                        </div>
                                        <div class="review-content">
                                            <?php foreach ($item['revision_files'] as $file): ?>
                                            <a href="<?= base_url($file['path']) ?>" class="download-btn">
                                                <i class="bi bi-download"></i>
                                                <?= $file['name'] ?>
                                            </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ($item['has_approved']): ?>
                                    <div class="review-card">
                                        <div class="review-header">
                                            File Persetujuan
                                        </div>
                                        <div class="review-content">
                                            <?php foreach ($item['approval_files'] as $file): ?>
                                            <a href="<?= base_url($file['path']) ?>" class="download-btn">
                                                <i class="bi bi-download"></i>
                                                <?= $file['name'] ?>
                                            </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function showMessage(message, id_sop) {
    fetch('<?= base_url('menu/get_pesan_files/') ?>' + id_sop)
        .then(response => response.json())
        .then(files => {
            console.log('Fetched files:', files);

            let filesHtml = '';

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