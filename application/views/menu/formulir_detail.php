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
                            <div class="proposal-section-title"><b>Judul</b></div>
                            <div class="proposal-section-content"><?= $sop['judul'] ?></div>
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
                                    <?php if ($item['has_review']): ?>
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

                                    <?php if ($item['has_revision']): ?>
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