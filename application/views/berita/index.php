<section id="hero">


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

</section><!-- End Hero -->

<section id="website" class="website">
    <div class="container mt-4">
        <div class="row">
            <div class="section-title" data-aos="fade-up">
                <h2 class="mb-3">Berita</h2>
                <!-- Looping Berita -->
                <?php foreach ($berita as $b): ?>
                <div class="col-md-12 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="row g-0">
                            <!-- Bagian Gambar -->
                            <div class="col-md-4">
                                <img src="<?= base_url('uploads/berita/' . $b['gambar_header']); ?>"
                                    class="img-fluid rounded-start w-100" style="height: 200px; object-fit: cover;"
                                    alt="Gambar Berita">
                            </div>

                            <!-- Bagian Konten -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <!-- <span class="badge bg-info text-white mb-2">KABAR ISOLA</span> -->
                                    <h5 class="card-title">
                                        <a href="<?= site_url('berita/detail/' . $b['slug']); ?>"
                                            class="text-decoration-none text-dark">
                                            <?= $b['judul']; ?>
                                        </a>
                                    </h5>
                                    <small class="text-muted">
                                        <?= date('d/m/Y', strtotime($b['datetime'])); ?>
                                    </small>
                                    <br>
                                    <p2 class="card-text mt-2 text-secondary">
                                        <?= word_limiter($b['text_header'], 45); ?>
                                    </p2>
                                    <a href="<?= site_url('berita/' . $b['slug']); ?>" class="text-primary fw-bold">Read
                                        More &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

</section><!-- End Details Section -->