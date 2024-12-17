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
    <div class="container">

        <!-- Bagian Header -->
        <div class="section-title" data-aos="fade-up">
            <h2>Berita</h2>
            <p><?= $berita['judul'] ?></p>

            <!-- Waktu Upload Berita -->
            <p class="text-muted" style="font-size: 14px;">
                <i class="bi bi-clock"></i> Diunggah pada: <?= date('d F Y, H:i', strtotime($berita['datetime'])) ?>
            </p>

            <!-- Gambar Header -->
            <?php if (!empty($berita['gambar_header'])): ?>
            <div class="text-center">
                <img src="<?= base_url('uploads/berita/' . $berita['gambar_header']) ?>" alt="Gambar Header Berita"
                    class="img-fluid rounded my-3" style="max-width: 600px; height: auto;">
            </div>
            <?php endif; ?>

            <!-- Teks Header -->
            <?php if (!empty($berita['text_header'])): ?>
            <div class="mb-3" style="text-align: justify;">
                <p2><?= nl2br($berita['text_header']) ?></p2>
            </div>
            <?php endif; ?>

            <!-- Bagian Middle -->
            <?php if (!empty($berita['gambar_middle']) || !empty($berita['text_middle'])): ?>
            <div class="middle-content mb-3" style="text-align: justify;">
                <?php if (!empty($berita['gambar_middle'])): ?>
                <div class="text-center mb-2">
                    <img src="<?= base_url('uploads/berita/' . $berita['gambar_middle']) ?>" alt="Gambar Middle Berita"
                        class="img-fluid rounded mb-2" style="max-width: 600px; height: auto;">
                </div>
                <?php endif; ?>

                <?php if (!empty($berita['text_middle'])): ?>
                <p2><?= nl2br($berita['text_middle']) ?></p2>
                <?php endif; ?>
            </div>

            <?php endif; ?>

            <!-- Bagian Footer -->
            <?php if (!empty($berita['gambar_footer']) || !empty($berita['text_footer'])): ?>
            <div class="footer-content my-5" style="text-align: justify;">
                <?php if (!empty($berita['gambar_footer'])): ?>
                <div class="text-center mb-3">
                    <img src="<?= base_url('uploads/berita/' . $berita['gambar_footer']) ?>" alt="Gambar Footer Berita"
                        class="img-fluid rounded" style="max-width: 600px; height: auto;">
                </div>
                <?php endif; ?>

                <?php if (!empty($berita['text_footer'])): ?>
                <p2><?= nl2br($berita['text_footer']) ?></p2>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section><!-- End Details Section -->