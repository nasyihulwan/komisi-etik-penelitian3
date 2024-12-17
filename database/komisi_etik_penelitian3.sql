-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 09:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `komisi_etik_penelitian3`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `gambar_header` varchar(255) NOT NULL,
  `text_header` text NOT NULL,
  `gambar_middle` varchar(255) DEFAULT NULL,
  `text_middle` text DEFAULT NULL,
  `gambar_footer` varchar(255) DEFAULT NULL,
  `text_footer` text DEFAULT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `slug`, `gambar_header`, `text_header`, `gambar_middle`, `text_middle`, `gambar_footer`, `text_footer`, `datetime`) VALUES
(1, 'Prof. Budi Mulyanti Ingatkan Pentingnya Peneliti Memiliki Ethical Clearance\r\n\r\n', 'prof-budi-mulyanti-ingatkan-pentingnya-peneliti-memiliki-ethical-clearance', 'ethical_clearance_header.jpg', 'Ethical Clearence merupakan instrumen pengukuran dalam keberterimaan secara etik dalam suatu rangkaian proses penelitian, yang bertujuan untuk melindungi subjek. Sehingga, disaat melakukan penelitian, perspektif kita harus menggunakan perspektif pemenuhan hak asasi manusia. Kita perlu memastikan bahwa penelitian yang sedang kita lakukan tidak mengekspliotasi subjek partisipan, tidak melakukan pelanggaran pada hak subjek partisipan, memberikan hak kepada partisipan untuk mengeluarkan pendapat, hak mendapatkan perlindungan privasinya, dan hak untuk tidak dieksploitasi. Hal ini merupakan sesuatu yang sangat penting, mengingat penelitian yang baik bukan semata-mata penelitian yang bisa diselesaikan, tetapi memenuhi hak subjek partisipan.\r\n\r\nKetua Pengurus Komisi Etik Penelitian Universitas Pendidikan Indonesia Periode 2023-2028 Prof. Dr. Budi Mulyanti, M.T., menyampaikan pernyataan tegas tersebut dalam sebuah wawancara, setelah menerima Surat Keputusan Rektor Universitas Pendidikan Indonesia Nomor 1745/UN40/HK/2023 Tentang Pengurus Komisi Etik Penelitian Universitas Pendidikan Indonesia Periode 2023-2028 di Gedung University Centre (UC) UPI, Ruang Teleconference lantai 1, Kampus UPI Jalan Dr. Setiabudhi Nomor 229 Bandung, Senin, (2/10/2023).\r\n\r\nDalam pernyataannya Prof. Budi Mulyanti menambahkan, ”Artinya, ethical clearance menjadi sebuah bentuk proteksi pertama untuk memastikan apakah penelitian ini bisa dilakukan atau tidak. Selain aspek metodologis, yang harus diperhatikan juga adalah aspek etikanya. Kadang-kadang satu penelitian bisa gagal dilakukan karena walaupun secara metodologi bisa dilakukan, tapi dia tidak bisa memenuhi aspek etikanya. Kita tentu tidak ingin UPI nanti dianggap menjadi lembaga yang tidak memperdulikan hak-hak dari partisipan tadi.” Prof. Budi Mulyanti menyatakan, agar para peneliti sebelum melakukan penelitiannya harus meminta izin terlebih dahulu. Perizinan tersebut apakah penelitian tersebut melanggar atau tidak terhadap subjek yang diteliti, terutama pada manusia dan hewan, dengan adanya surat ethical clearance yang menyatakan bahwa penelitian tersebut tidak melanggar atau tidak akan merugikan subjek, maka penelitian dapat dilanjutkan.\r\n\r\nNamun apabila Komisi Etik Penelitian meyakini akan adanya kerugian terhadap subjek manusia atau hewan, maka peneliti tersebut tidak dapat melakukan penelitian selanjutnya, atau peneliti harus merubah subjek penelitiannya.\r\n\r\n“Jadi intinya bahwa ethical clearance ini adalah untuk melindungi subjek penelitian terutama adalah hewan dan manusia agar tidak merugikan subjek. Subjek itu bukan betul-betul jadi objek tapi dia adalah subjeknya,” ungkap Prof. Budi Mulyanti.\r\n\r\nProf. Budi Mulyanti menambahkan, diterbitkannya ethical clearance, merupakan keharusan bagi seorang peneliti, ditambah ini merupakan tuntutan bagi perguruan tinggi yang ingin menuju World Class University. Jika UPI ingin memiliki predikat WCU, maka salah satu syarat agar dapat memenuhi predikat tersebut adalah penelitian-penelitian yang dilakukan oleh UPI harus memilki surat ethical clearance. Beberapa jurnal internasional memiliki persyaratan agar sebelum publish harus melampirkan surat ethical clearance pada risetnya.\r\n\r\nAdapun susunan Pengurus Komisi Etik Penelitian UPI Periode 2023-2028, yaitu Prof. Dr. .M. Solehuddin. M.Pd., M.A., sebagai Pengarah; Prof. Dr. Bunyamin Maftuh, M.Pd., M.A., sebagai Penanggung Jawab; kemudian Prof. Dr. Budi Mulyanti, M.T., sebagai Ketua Komisi Etik Penelitian UPI; Dr. Pipit Pitriani, M.Kes, Ph.D., sebagai Sekretaris dan para anggotanya terdiri dari Prof. Dr. Ahman, M.P.d., Prof. Dr. Elly Malihah, M.Si., Prof. Dr. Ida Hamidah, M.Si., dr. Hamidie Ronald Daniel Ray, M.Pd., Ph.D., Prof. Vina Adriany, Ph. D., dan Prof. Dr. Topik Hidayat, M.Si., Ph.D. (dodiangg/foto:arum)', NULL, NULL, NULL, NULL, '2024-09-28 16:47:43'),
(2, 'Kunjungan Komisi Etik Penelitian Universitas Pendidikan Indonesia (UPI) ke Universitas Malaya', 'kunjungan-komisi-etik-penelitian-upi-ke-universitas-malaya', 'gambar_header_kunjungan.jpg', 'Pada 7 November 2024, Komisi Etik Penelitian Universitas Pendidikan Indonesia (UPI) melakukan kunjungan resmi ke Komisi Etik Penelitian Universitas Malaya, Malaysia. Kunjungan ini bertujuan untuk mempererat hubungan kerja sama antar universitas sekaligus bertukar informasi dan pengalaman mengenai pengelolaan etika penelitian.\r\n\r\nDalam pertemuan tersebut, Prof. Dr. Budi Mulyanti, M.Si selaku pihak dari UPI disambut hangat oleh Assoc. Prof. Dr. Raida Abu Bakar dari Universitas Malaya. Kedua belah pihak berdiskusi mengenai berbagai topik penting, termasuk kebijakan etika penelitian, prosedur pengajuan izin etik, dan upaya meningkatkan kualitas penelitian berbasis ', 'gambar_middle_kunjungan.jpg', 'Selain itu, kunjungan ini juga menjadi momen simbolis dengan pertukaran plakat sebagai tanda persahabatan dan kolaborasi antara kedua institusi. Kegiatan ini diharapkan dapat menjadi awal dari kerja sama lebih lanjut dalam berbagai bidang penelitian dan akademik.\r\n\r\nKegiatan ini diharapkan dapat menjadi awal dari kerja sama lebih lanjut dalam berbagai bidang penelitian dan akademik.Komisi Etik Penelitian UPI berkomitmen untuk terus meningkatkan standar etika penelitian melalui kolaborasi dengan institusi internasional. Kunjungan ini merupakan langkah nyata untuk memperkuat jaringan global dan berbagi praktik terbaik dalam mendukung penelitian yang bertanggung jawab dan berkualitas.', NULL, NULL, '2024-12-13 14:23:29'),
(3, 'Komisi Etik UPI Adakan Pembekalan Penulisan Proposal untuk Ethical Approval', 'komisi-etik-upi-adakan-pembekalan-penulisan-proposal-untuk-ethical-approval', 'default.jpg', 'Bandung, [10 september 2024] – Komisi Etik Universitas Pendidikan Indonesia (UPI) menyelenggarakan kegiatan pembekalan penulisan proposal penelitian bagi para dosen, mahasiswa, dan peneliti di lingkungan FPTI dengan fokus pada persiapan mendapatkan ethical approval. Acara ini bertujuan untuk meningkatkan pemahaman dan keterampilan peserta dalam menyusun proposal yang sesuai dengan standar etika penelitian.\r\n\r\nMengusung tema “Membangun Penelitian Beretika untuk Dampak yang Lebih Bermakna”, pembekalan ini menghadirkan narasumber dari Komisi Etik UPI serta pakar etika penelitian yang berpengalaman di tingkat nasional. Peserta mendapatkan panduan komprehensif mengenai elemen penting yang harus ada dalam proposal penelitian, seperti metode penelitian yang beretika, pengelolaan data, serta prinsip perlindungan subjek penelitian.\r\n\r\nKetua Komisi Etik UPI, dalam sambutannya menyampaikan bahwa persetujuan etik merupakan prasyarat penting untuk memastikan penelitian tidak hanya memberikan kontribusi ilmiah, tetapi juga menghormati nilai-nilai kemanusiaan. “Kami ingin membantu para peneliti menyusun proposal yang memenuhi standar internasional, sehingga penelitian mereka dapat memberikan manfaat yang maksimal tanpa melanggar prinsip etika,” ujar beliau.\r\n\r\nSesi pembekalan mencakup beberapa topik utama:\r\n\r\nPrinsip-Prinsip Dasar Etika Penelitian – Termasuk aspek perlindungan subjek, informed consent, dan pengelolaan risiko.\r\nFormat dan Struktur Proposal untuk Ethical Approval – Penjelasan tentang komponen proposal yang harus dilengkapi, seperti deskripsi penelitian, metode, dan analisis risiko.\r\nStudi Kasus dan Evaluasi Proposal – Peserta diajak mempelajari contoh proposal dan mendapatkan masukan dari para ahli.\r\nSalah satu peserta, mengungkapkan manfaat dari pembekalan ini. “Kegiatan ini memberikan panduan yang sangat jelas tentang bagaimana menyusun proposal penelitian yang beretika. Ini akan mempermudah kami mendapatkan persetujuan dari Komisi Etik,” ujarnya.\r\n\r\nKomisi Etik UPI juga berkomitmen untuk mendampingi para peneliti melalui konsultasi individu bagi mereka yang memerlukan bantuan lebih lanjut dalam menyusun proposal. Ke depan, pelatihan serupa akan menjadi agenda rutin untuk mendukung ekosistem penelitian yang bertanggung jawab di lingkungan UPI.\r\n\r\nDengan adanya pembekalan ini, UPI berharap seluruh penelitian yang dilakukan di universitas dapat memenuhi standar etika dan memberikan kontribusi yang signifikan bagi pengembangan ilmu pengetahuan dan kesejahteraan masyarakat.', NULL, NULL, NULL, NULL, '2024-09-20 14:04:15'),
(4, 'Kegiatan Evaluasi dan Persiapan Sosialisasi Komisi Etik Goes to Fakultas/Kamda', 'kegiatan-evaluasi-dan-persiapan-sosialisasi-komisi-etik-goes-to-fakultas-kamda', 'gambar_header_sosialisasi.jpg', 'Tahun 2025 merupakan tahun ke 2 komisi etik melaksanakan dan menerima pembuatan dan evaluasi tentang etik penelitian. Saat ini terdapat antrean pengajuan etik yang perlu diproses. Oleh karena itu, Komisi Etik Penelitian Manusia menghentikan penerimaan pengajuan surat kelayakan etik hingga waktu yang belum ditentukan. \r\n\r\nAntrean ini juga berdampak pada durasi review dan penerbitan surat kelayakan etik. Bagi pengusul yang telah mengajukan surat kelayakan etik dan tidak berkenan menunggu, kami persilakan untuk mengajukan pengunduran atau penarikan berkas.', NULL, NULL, NULL, NULL, '2024-12-16 08:14:07'),
(5, 'Komisi Etik Penelitian UPI Dorong Para Peneliti untuk Ajukan Proposal dan Persetujuan Etik', 'komisi-etik-penelitian-upi-dorong-para-peneliti-untuk-ajukan-proposal-dan-persetujuan-etik', 'default.jpg', 'Bandung, [20 0ktober 2024] – Komisi Etik Penelitian Universitas Pendidikan Indonesia (UPI) mengajak para peneliti, baik dosen maupun mahasiswa, untuk lebih aktif dalam menyusun proposal penelitian dan mendapatkan persetujuan etik sebagai bagian dari standar penelitian yang bertanggung jawab. Langkah ini merupakan upaya strategis untuk memastikan setiap penelitian yang dilakukan memenuhi prinsip etika penelitian.\r\n\r\nKetua Komisi Etik Penelitian UPI, menegaskan bahwa persetujuan etik merupakan syarat penting untuk menjamin pelaksanaan penelitian yang menghormati hak, keselamatan, dan kesejahteraan subjek penelitian. “Kami mengundang para peneliti di UPI untuk mengajukan proposal mereka ke Komisi Etik. Persetujuan etik bukan sekadar formalitas, tetapi bagian dari upaya menjaga kualitas dan akuntabilitas penelitian yang dilakukan di lingkungan universitas,” ujarnya.\r\n\r\nUntuk mempermudah proses, Komisi Etik Penelitian UPI telah menyediakan panduan lengkap terkait pengajuan proposal dan standar persetujuan etik. Panduan ini mencakup langkah-langkah penyusunan proposal yang sesuai dengan prinsip-prinsip etika, seperti menghormati privasi subjek penelitian, memastikan persetujuan yang terinformasi, dan meminimalkan risiko pada subjek.\r\n\r\nSejumlah peneliti yang telah mendapatkan persetujuan etik menyampaikan manfaatnya, termasuk meningkatkan kredibilitas penelitian di tingkat nasional dan internasional. Salah satu peneliti, mengungkapkan bahwa proses ini membantu memperkuat desain penelitiannya dan membuka peluang untuk publikasi di jurnal bereputasi.\r\n\r\nSebagai bagian dari upaya meningkatkan partisipasi, Komisi Etik Penelitian UPI juga akan mengadakan workshop dan seminar tentang etika penelitian. Kegiatan ini bertujuan untuk memberikan pemahaman yang lebih mendalam kepada para peneliti tentang pentingnya etika dalam setiap tahap penelitian, mulai dari perencanaan hingga pelaporan hasil.\r\n\r\nDengan adanya persetujuan etik, UPI berharap dapat mendorong budaya penelitian yang bertanggung jawab, beretika, dan berdaya saing tinggi. “Kami ingin memastikan bahwa semua penelitian yang dilakukan di UPI tidak hanya bermanfaat bagi ilmu pengetahuan, tetapi juga memberikan dampak positif bagi masyarakat,” tutup Ketua Komisi Etik Penelitian', NULL, NULL, NULL, NULL, '2024-10-24 11:17:40'),
(6, 'Sosialisasi Etik Penelitian di Lingkungan UPI', 'sosialisasi-etik-penelitian-di-lingkungan-upi', 'gambar_header_lingkungan_upi.jpg', 'Komisi Etik Universitas Pendidikan Indonesia (UPI) menggelar kegiatan sosialisasi yang bertujuan untuk meningkatkan pemahaman sivitas akademika terhadap prinsip-prinsip etika akademik dan profesionalisme. Kegiatan ini dilaksanakan sebagai bagian dari komitmen UPI dalam menjaga integritas dan mutu akademik.\r\n\r\nSosialisasi yang dihadiri oleh dosen, peneliti dan mahasiswa ini mengangkat tema “Etika Akademik sebagai Pilar Utama Penyelenggaraan Pendidikan yang Bermartabat”. Dalam acara tersebut, Komisi Etik UPI memaparkan berbagai peraturan, pedoman, dan contoh kasus yang berkaitan dengan pelanggaran etika penelitian.\r\n\r\nKetua Komisi Etik UPI, Prof. Dr. Budi Mulyanti, M.Si, dalam sambutannya menyampaikan pentingnya memahami dan menerapkan etika dalam seluruh aspek penyelenggaraan pendidikan. \"Etika penelitian tidak hanya sebatas mematuhi peraturan, tetapi juga mencerminkan nilai-nilai integritas, keadilan, dan tanggung jawab. Dengan sosialisasi ini, kami berharap seluruh sivitas akademika UPI dapat bekerja sama dalam menjaga reputasi dan kualitas universitas,\" ungkapnya.\r\n\r\nKegiatan ini diisi dengan sesi diskusi interaktif, di mana peserta diberikan kesempatan untuk menyampaikan pertanyaan, pendapat, dan masukan terkait isu-isu etika yang sering terjadi. Beberapa isu yang menjadi perhatian utama meliputi plagiarisme, konflik kepentingan, dan pelanggaran tata kelola akademik.\r\nSebagai langkah lanjutan, Komisi Etik UPI berencana untuk mengadakan pelatihan khusus bagi dosen dan tenaga kependidikan, serta menyusun proposal agar sesuai etika penelitian Dengan demikian, diharapkan nilai-nilai etika dapat tertanam sejak awal di lingkungan akademik.\r\n\r\nMelalui kegiatan sosialisasi ini, UPI menegaskan komitmennya untuk terus mengedepankan nilai-nilai etika dalam mendukung visi menjadi universitas pelopor dan unggul di tingkat global.\r\n', NULL, NULL, NULL, NULL, '2024-12-16 08:21:18'),
(7, 'Pentingnya Etika dalam Penelitian: Membangun Kepercayaan dan Tanggung Jawab Ilmiah\r\n', 'pentingnya-etika-dalam-penelitian-membangun-kepercayaan-dan-tanggung-jawab-ilmiah', 'gambar_header_pentingnya.jpg', 'Etika dalam penelitian merupakan fondasi utama yang menjamin integritas, kepercayaan, dan keberlanjutan ilmu pengetahuan. Tanpa pedoman etika yang kuat, penelitian berisiko melanggar hak asasi manusia, menimbulkan dampak negatif bagi masyarakat, atau menghasilkan hasil yang tidak valid.', 'gambar_middle_pentingnya.jpg', 'Berikut adalah beberapa alasan pentingnya etika dalam penelitian:\r\n\r\n1. Perlindungan Subjek Penelitian\r\nEtika penelitian bertujuan untuk melindungi subjek penelitian, baik manusia, hewan, maupun lingkungan. Prinsip seperti informed consent (persetujuan berdasarkan informasi) memastikan bahwa partisipasi subjek bersifat sukarela, dengan pemahaman penuh terhadap tujuan, risiko, dan manfaat penelitian.\r\n\r\n2. Menjaga Kepercayaan Publik\r\nPenelitian yang mematuhi standar etika membangun kepercayaan antara peneliti, masyarakat, dan institusi. Masyarakat cenderung mendukung penelitian yang dilakukan secara transparan dan bertanggung jawab.\r\n\r\n3. Meningkatkan Kualitas Ilmu Pengetahuan\r\nEtika mendorong peneliti untuk mengikuti metode yang jujur dan valid, menghindari plagiarisme, fabrikasi, atau manipulasi data. Penelitian yang beretika menghasilkan temuan yang kredibel dan dapat diuji ulang oleh peneliti lain.\r\n\r\n4. Menghindari Dampak Negatif\r\nTanpa etika, penelitian berpotensi merugikan subjek atau masyarakat. Contoh kasus pelanggaran etika seperti eksperimen tanpa persetujuan subjek atau penggunaan data secara tidak bertanggung jawab menjadi peringatan penting akan bahaya penelitian yang tidak etis.\r\n\r\n5. Memenuhi Standar Global\r\nBanyak jurnal ilmiah dan institusi pendanaan menuntut penelitian yang diajukan telah mendapat persetujuan etik. Hal ini menunjukkan bahwa etika bukan hanya kewajiban moral, tetapi juga prasyarat untuk diterima di komunitas ilmiah internasional.\r\n\r\n6. Tanggung Jawab Sosial\r\nPenelitian sering kali berdampak pada masyarakat luas. Etika penelitian memastikan bahwa peneliti mempertimbangkan dampak sosial, budaya, dan lingkungan dari hasil penelitian mereka, sehingga penelitian dapat memberikan manfaat nyata tanpa merugikan pihak lain.', NULL, NULL, '2024-12-16 08:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id_members` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kota` text DEFAULT NULL,
  `negara` varchar(255) DEFAULT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `org` text DEFAULT NULL,
  `level` enum('','superadmin','petugas','member') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id_members`, `email`, `password`, `nama`, `kota`, `negara`, `hp`, `org`, `level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'ali.rahmat.9b.smpn8@gmail.com', '$2y$10$eHyd0U4.DYEg6tT1BbWBeek9zkKx12kP0i5CaiEkgD2zg1xZtabUS', 'Ali Rahmat Hidayatulloh', 'Bandung', 'Indonesia', '082112726622', 'UPI', '', '2024-05-28 16:57:26', '2024-05-28 16:57:26', NULL),
(6, 'nasyihulwan@upi.edu', '$2y$10$znjDHD5sYIH5ESorCX5soeYm7u1ur81p1iQ7Dt6CBZy6WYWkUabi2', 'Nasyih', 'Bandung', 'Indonesia', '089604129300', 'Universitas Pendidikan Indonesia', 'superadmin', '2024-09-22 18:26:04', '2024-09-22 18:26:04', NULL),
(7, 'mmhdnnas@gmail.com', '$2y$10$.Z0hLRKBAD/R7CI7sclGnOPA8oVskJUtIYyUtrlkvZZDI1gXwMdGu', 'Muhammad Nasyih Ulwan', 'Bandung', 'Indonesia', '089604129300', 'UPI', 'member', '2024-09-28 13:29:35', '2024-09-28 13:29:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sop-request`
--

CREATE TABLE `sop-request` (
  `id_sop` int(255) NOT NULL,
  `judul` text NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `sumber_dana` varchar(255) NOT NULL,
  `pemberi_hibah` varchar(255) NOT NULL,
  `surat_pernyataan_mandiri` text DEFAULT NULL,
  `formulir_etik` text NOT NULL,
  `proposal` text NOT NULL,
  `bukti_pembayaran` text NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` enum('belum diperiksa','sedang diperiksa','disetujui','ditolak') NOT NULL DEFAULT 'belum diperiksa',
  `pesan` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `id_members` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sop-request`
--

INSERT INTO `sop-request` (`id_sop`, `judul`, `kategori`, `sumber_dana`, `pemberi_hibah`, `surat_pernyataan_mandiri`, `formulir_etik`, `proposal`, `bukti_pembayaran`, `token`, `status`, `pesan`, `created_at`, `updated_at`, `deleted_at`, `id_members`) VALUES
(9, 'Test', 'Etik Uji Hewan', 'Mandiri', 'Pemerintah', '1731592834_TATA_TERTIB_PANITIA_ODWH_TEKNIK_KOMPUTER.pdf', '1731592834_TATA_TERTIB_PANITIA_ODWH_TEKNIK_KOMPUTER.pdf', '1731592834_TATA_TERTIB_PANITIA_ODWH_TEKNIK_KOMPUTER.pdf', '1731592834_TATA_TERTIB_PANITIA_ODWH_TEKNIK_KOMPUTER.pdf', '', 'belum diperiksa', NULL, '2024-11-14 21:00:34', '2024-11-14 21:00:34', NULL, 7),
(10, 'Test', 'Etik Uji Sosial Humaniora', 'Hibah/beasiswa', 'Pemerintah', '1731593919_TATA_TERTIB_PANITIA_ODWH_TEKNIK_KOMPUTER.pdf', '1731593919_TATA_TERTIB_PANITIA_ODWH_TEKNIK_KOMPUTER.pdf', '1731593919_TATA_TERTIB_PANITIA_ODWH_TEKNIK_KOMPUTER.pdf', '1731593919_TATA_TERTIB_PANITIA_ODWH_TEKNIK_KOMPUTER.pdf', '', 'belum diperiksa', NULL, '2024-11-14 21:18:39', '2024-11-14 21:18:39', NULL, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_members`);

--
-- Indexes for table `sop-request`
--
ALTER TABLE `sop-request`
  ADD PRIMARY KEY (`id_sop`),
  ADD KEY `id_members` (`id_members`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id_members` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sop-request`
--
ALTER TABLE `sop-request`
  MODIFY `id_sop` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sop-request`
--
ALTER TABLE `sop-request`
  ADD CONSTRAINT `sop-request_ibfk_1` FOREIGN KEY (`id_members`) REFERENCES `members` (`id_members`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
