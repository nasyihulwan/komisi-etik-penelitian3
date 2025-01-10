<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= isset($title) ? $title : 'Komisi Etik Penelitian | Universitas Pendidikan Indonesia'; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('assets/img/favicon.ico') ?>" rel="icon">
    <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/aos/aos.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Bootslander
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
    .section-title {
        margin-bottom: 0 !important;
    }
    </style>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/img/UPI-Logo-white.png" alt=""
                        class="img-fluid"></a>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li class="dropdown"><a href="#"><span>Beranda</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li>
                                <a class="nav-link scrollto <?= $page=='home' ? 'active' : '' ?>"
                                    href="<?= base_url() ?>">Pengantar</a>
                            </li>
                            <li>
                                <a class="nav-link scrollto <?= $page=='home' ? 'active' : '' ?>"
                                    href="#">Pengumuman</a>
                            </li>
                            <li>
                                <a class="nav-link scrollto <?= $page=='home' ? 'active' : '' ?>"
                                    href="<?= base_url('berita') ?>">Berita</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li>
                                <a class="nav-link scrollto <?= $page=='home' ? 'active' : '' ?>"
                                    href="<?= base_url('sejarah') ?>">Sejarah</a>
                            </li>
                            <li>
                                <a href="<?= base_url('struktur_organisasi') ?>">Struktur Organisasi</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Panduan</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= base_url('bagan_alir') ?>">Bagan Alir </a></li>
                            <li><a href="#">Panduan Pengguna untuk Peneliti</a></li>
                            <li><a href="#">Panduan Pengguna Invited Reviewer</a></li>
                            <li><a href="<?= base_url('tarif') ?>">Tarif</a></li>
                            <li><a href="<?= base_url('estimasi_waktu') ?>">Estimasi Waktu</a></li>
                            <li><a href="#">Reviewer</a></li>
                            <li><a href="<?= base_url('perpanjangan') ?>">Prosedur Alur Perpanjangan Surat Pernyataan
                                    Etik</a></li>
                            <li><a href="<?= base_url('lupa_password') ?>">Panduan Pengguna Lupa Password</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Dokumen Persyaratan</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>

                            <li><a href="<?= base_url() ?>assets/file/Formulir Pengajuan Telaah Etik Baru Fix.docx"
                                    download>Formulir Pengajuan Telaah Etik Baru</a>
                            </li>
                            <li><a href="<?= base_url() ?>assets/file/Formulir Pernyataan Pendanaan.docx">Formulir
                                    Pernyataan
                                    Pendanaan</a>
                            </li>
                            <li><a href="<?= base_url() ?>assets/file/KOMITMEN ETIK PENELITIAN.docx">Komitmen Etik
                                    Penelitian</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Referensi</span> <i class="bi bi-chevron-down"></i></a>

                    </li>

                    <li><a class="nav-link scrollto" href="<?= base_url('contact') ?>">Kontak Kami</a></li>

                    <?php if($this->session->userdata('level') == 'member'): ?>
                    <li class="dropdown"><a href="#"><span>Pengajuan Layanan</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li>
                                <a class="nav-link scrollto <?= $page=='sop' ? 'active' : '' ?>"
                                    href="<?= base_url('menu/sop_request') ?>">Pengajuan SOP</a>
                            </li>
                            <li>
                                <a class="nav-link scrollto" href="<?= base_url('menu/validasi_formulir') ?>">Validasi
                                    Formulir</a>
                            </li>
                        </ul>
                    </li>
                    <?php endif ?>

                    <?php if($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'petugas'): ?>
                    <li>
                        <a class="nav-link scrollto" href="<?= base_url('menu/validasi_formulir') ?>">Validasi
                            Formulir</a>
                    </li>
                    <?php endif ?>

                    <?php if($this->session->userdata('level') == 'member'): ?>
                    <li class="dropdown"><a href="#"><span><?= $this->session->userdata('nama') ?></span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= base_url('auth/logout') ?>">Logout</a></li>
                        </ul>
                    </li>
                    <?php elseif($this->session->userdata('level') == 'superadmin'): ?>
                    <li class="dropdown"><a href="#"><span>Superadmin</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= base_url('auth/logout') ?>">Logout</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="dropdown"><a href="#"><span>Pengguna</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= base_url('auth') ?>">User Login</a></li>
                            <li><a href="<?= base_url('auth/user_registration') ?>">User Registration</a></li>
                        </ul>
                    </li>
                    <!-- <li class="dropdown"><a href="#"><span>Reviewer</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="#">Reviewer Login</a></li>
                <li><a href="#">Reviewer Registration</a></li>
              </ul>
            </li> -->
                    <?php endif ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header>