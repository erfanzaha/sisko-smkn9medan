-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 28, 2022 at 06:37 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2021_web_cake_sistem_informasi_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_auth` int(11) NOT NULL,
  `nama_admin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `id_auth`, `nama_admin`, `email`, `created_at`, `updated_at`) VALUES
(2, 22, 'Administrator', 'administrator@gmail.com', '2021-03-18 21:35:08', '2021-03-18 21:35:08'),
(3, 30, 'admin2', 'admin2@gmail.com', '2022-02-14 16:38:29', '2022-02-14 16:38:29');

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
CREATE TABLE IF NOT EXISTS `auth` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `username`, `password`, `level`, `created_at`, `updated_at`) VALUES
(20, 'intankartini', '5f4dcc3b5aa765d61d8327deb882cf99', 'guru', '2021-03-21 11:22:31', '2021-04-02 22:09:28'),
(15, 'laharanick', '5f4dcc3b5aa765d61d8327deb882cf99', 'guru', '2021-03-20 13:07:24', '2021-04-07 21:53:40'),
(19, 'zaidanhamdany', '5f4dcc3b5aa765d61d8327deb882cf99', 'guru', '2021-04-03 03:45:55', '2021-04-03 03:45:55'),
(22, 'administrator', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin', '2021-03-18 21:35:08', '2021-03-18 21:35:08'),
(24, 'alfandi', '5f4dcc3b5aa765d61d8327deb882cf99', 'siswa', '2021-03-21 03:28:51', '2021-04-12 01:41:45'),
(28, 'novia', '5f4dcc3b5aa765d61d8327deb882cf99', 'siswa', '2021-04-03 04:24:10', '2021-04-11 19:36:19'),
(27, 'orangtuafandi', '5f4dcc3b5aa765d61d8327deb882cf99', 'orang tua', '2021-03-21 11:21:56', '2021-03-21 11:21:56'),
(29, 'admin2', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin', '2022-02-14 16:38:29', '2022-02-14 16:38:29');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

DROP TABLE IF EXISTS `berita`;
CREATE TABLE IF NOT EXISTS `berita` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `isi_berita` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `title`, `tanggal`, `isi_berita`, `admin`, `gambar`, `created_at`, `updated_at`) VALUES
(2, 'Pendamping SMK PK dari Unimed Selenggarakan FGD dan Workshop di SMK Negeri 9 Medan', '2021-12-21', 'Dalam rangkaian tugas program pendampingan Sekolah Menengah Kejuruan Pusat Keunggulan (SMK-PK), Universitas Negeri Medan (Unimed) melaksanakan Focus Group Discussion (FGD) dan Workshop Pengembangan Konten Multimedia Untuk Penguatan Medsos dan Digital Marketing Sekolah di SMK Negeri 9 Medan, Jalan Patriot No 20A Medan Sunggal, Selasa (21/12/2021).\n\nPemateri yang dihadirkan dalam kegiatan adalah Dekan Fakultas Teknik Prof. Dr. Harun Sitompul, M.Pd memaparkan tentang Dinamika SMK, Redefenisi Profil Lulusan SMK sesuai dengan kebutuhan industri 4.0 dan Doni Prima memaparkan tentang Pengembangan Konten Multimedia untuk Penguatan Medsos dan Digital Marketing.\n\nKepala SMK Negeri 9 Medan Sukardi, S.Pd, MM yang diwakili Wakil Kepala SMK Negeri 9 Medan Bidang Kurikulum Novelman Manurung, ST mengatakan dengan adanya media sosial dapat digunakan untuk mensosialisasikan tentang kegiatan di SMK Negeri 9 Medan.\n\n“Media sosial memiliki peran strategis untuk menyampaikan informasi mengenai berbagai persoalan. Oleh karena itu, penggunaan media sosial untuk mensosialisasikan pengetahuan mengenai berbagai kegiatan SMK Negeri 9 Medan agar lebih optimal,” ujar Novelman.\nSementara itu Dr. Ir. Syafiatun Siregar, S.T, M.T yang merupakan Ketua Tim Pendamping Program SMK Pusat Keunggulan mengatakan semoga rangkaian acara kegiatan berjalan dengan baik.\n\nAdapun rangkaian kegiatan yang dilakukan adalah Pembukaan, menyanyikan lagu Indonesia Raya, Doa, Kata Sambutan Ketua Tim Pendamping Program SMK Pusat Keunggulan sekaligus laporan kegiatan FGD, Kata Sambutan dari Kepala SMK Negeri 9 Medan, paparan nara sumber I dan II, sesi tanya jawab serta penutup.\n\nTurut hadir dalam acara tersebut, Wakil Kepala SMK N 9 Medan Bidang Humas Ramzil Gempita Hidayat, S.Pd, Wakil Kepala SMK N 9 Medan Kesiswaan Muhammad Arif Wijaya, S.Pd, Wakil Kepala SMK N 9 Medan Bidang Sarana dan Prasarana, Teresia Sinaga, S.Pd, Seluruh Ketua Program Keahlian SMK Negeri 9 Medan serta guru-guru. (Tim Humas)', 'administrator', '1.jpg', '2021-03-21 02:35:51', '2021-03-21 03:16:35'),
(3, 'Siswa SMK mampu membangun Start Up', '2021-12-20', 'SMK Negeri 9 Medan kembali menggelar kegiatan Implementasi Pelaksanaan Pembelajaran Pada Sekolah Pusat Keunggulan (SMK PK) Bersama Guru Tamu dari Dudika dengan tema siswa SMK Mampu Membangun Startup bertempat di Nine Hall SMK Negeri 9 Medan, Sabtu 18 Desember 2021.\n\nAcara yang dibuka langsung Kepala Sekolah SMK Negeri 9 Medan, Sukardi, S.Pd, MM diwakili oleh Wakil Kepala Sekolah Bidang Humas, Ramzil Gempita Hidayat, S.Pd, didampingi Ketua Program Keahlian Rekayasa Perangkat Lunak (RPL) Roy Hendro Siburian, S.Kom.\n\nDengan adanya program guru tamu dari Industri, Dunia Usaha dan Dunia Kerja (Dudika) diharapkan dapat menambah khasanah keilmuan bagi para peserta didik yang berada dikelas XII sebagai bentuk persiapan untuk memasuki dunia kerja.\n\nPada kegiatan guru tamu kali ini, jurusan Rekayasa Perangkat Lunak (RPL) SMK Negeri 9 Medan bekerjasama dengan PT Literasia Edutekno Digital diwakili  Ikhsan Jauhari sebagai Direktur Kreatif.\n\nDalam pemaparannya, Ikhsan Jauhari memberikan banyak informasi terkait tahapan-tahapan dalam membangun startup untuk pemula.\n\nWakil Kepala Sekolah Bidang Humas Ramzil Gempita Hidayat, S.Pd mengungkapkan bahwa program ini merupakan program penguatan kurikulum dengan Dudika pada Sekolah Pusat Keunggulan SMK.\n\n“Program ini akan terus kami laksanakan secara berjenjang, kurikulum yang kuat dan pengalaman yang luas dari siswa agar mampu membangun inkubator startup dibidang programing”.\n\nSMK Negeri 9 Medan mengagendakan secara rutin untuk mengundang Industri yang relevan dengan kompetensi keahlian yang ada, tambah Humas SMK Negeri 9 Medan Ramzil Gempita Hidayat, S.Pd.\n\nPeserta yang hadir adalah 128 orang siswa kelas XII jurusan Rekayasa Perangkat Lunak (RPL) didampingi guru produktif Rekayasa Perangkat Lunak. (Tim Humas)', 'administrator', '2.jpg', '2021-03-21 02:37:14', '2021-03-21 03:15:58'),
(5, 'Ini Syarat Daftar SNMPTN 2022 bagi Siswa dan Sekolah', '2021-12-14', 'Seleksi penerimaan mahasiswa baru Perguruan Tinggi Negeri (PTN) 2022 mulai disosialisasikan bulan ini. Lembaga Tes Masuk Perguruan Tinggi (LTMPT) menyebutkan, penerimaan mahasiswa baru 2022 masih akan dilakukan melalui 3 jalur, yaitu:\n\n    Seleksi Nasional Masuk Perguruan Tinggi Negeri (SNMPTN)\n    Seleksi Bersama Masuk Perguruan Tinggi Negeri (SBMPTN)\n    Jalur Mandiri\n\nSosialisasi daring soal penerimaan mahasiswa baru perguruan tinggi negeri 2022 digelar LTMPT melalui siaran Youtube, Sabtu (11/12/2021), dan disampaikan oleh Ketua Pelaksana LTMPT Prof Dr Budi Prasetyo Widyobroto. Budi mengatakan, secara umum, ketentuan seleksi penerimaan mahasiswa baru PTN 20211 sama seperti ketentuan 2021. “Prinsipnya masih sama dengan tahun 2021,” kata Budi. Hal yang berbeda dari tahun sebelumnya yakni terkait jadwal dan materi SBMPTN. Dalam kesempatan tersebut, Budi menjelaskan syarat-syarat yang harus dipenuhi sekolah dan siswa untuk mendaftar SNMPTN 2022.\n\nSyarat bagi sekolah\n\nPersyaratan bagi sekolah yang hendak mengikuti SNMPTN 2022 adalah sebagai berikut:\n\n1. SMA/MA/SMK yang mempunyai NPSN\n\n2. Ketentuan akreditasi:\n\nAkreditasi A: 40 persen terbaik di sekolahnya Akreditasi B: 25 persen terbaik di sekolahnya Akreditasi C dan lainnya: 5 persen terbaik di sekolahnya. Budi menjelaskan, artinya, jika suatu sekolah memiliki akreditasi A, maka jatahnya adalah 40 persen siswa terbaik di sekolahnya. Sementara, siswa lainnya tidak bisa mendaftar.\n\nAdapun untuk sekolah dengan akreditasi B dan C jatahnya lebih sedikit.\n\n3. Mengisi Pangkalan Data Sekolah dan Siswa (PDSS). Data siswa diisikan hanya yang eligible atau sesuai ketentuan. “Sekali lagi sekolah hanya mengisikan data PDSS bagi siswa yang eligible, tidak semua siswa harus dimasukkan,” ujar Budi. Syarat-syarat tersebut, kata Budi, masih sama seperti SNMPTN 2021. Budi mengatakan, untuk kuota sekolah, terkait jumlah siswa yang bisa mengikuti SNMPTN akan diumumkan pada 28 Desember 2021.\n\nSyarat bagi siswa\n\nAdapun syarat bagi siswa yang bisa mengikuti SNMPTN 2022 adalah siswa SMA/MA/SMK kelas terakhir (kelas 12) pada tahun 2022 yang memiliki prestasi unggul.\n\nAdapun persyaratan lengkapnya bagi siswa yaitu:\n\n    Memiliki prestasi akademik dan memenuhi persyaratan yang ditentukan oleh masing-masing\n    PTN Memiliki NISN dan terdaftar di PDSS\n    Memiliki nilai rapor semester 1-5 yang telah diisikan di PDSS\n    Peserta yang memilih program studi bidang seni dan olahraga wajib mengunggah portofolio.\n    Pemilihan program studi\n\nUntuk memilih program studi, Budi menjelaskan, setiap siswa dapat memilih dua program studi dari satu PTN atau dua PTN. Jika memilih dua program studi, maka salah satu harus berada di PTN pada provinsi yang sama dengan SMA/MA/SMK asalnya.\nJika memilih satu program studi, dapat memilih PTN yang berada di provinsi manapun. LTMPT menyarankan tidak lintas minat (tergantung PTN yang dituju).\n\n“Kami wanti-wanti atau memberi pesan kepada adik-adik yang sosial atau IPS jangan mengambil program studi IPA karena dari pengalaman yang sudah-sudah banyak yang gagal,” kata Budi.\n\nPemeringkatan siswa\n\nBudi menjelaskan, ada ketentuan dalam hal membuat pemeringkatan siswa. Pemeringkatan siswa dilakukan oleh sekolah yang pada dasarnya memperhitungkan nilai mata pelajaran sebagai berikut:\n\nJurusan IPA: Matematika, Bahasa Indonesia, Bahasa Inggris, Kimia, Fisika, dan Biologi\nJurusan IPS: Matematika, Bahasa Indonesia, Bahasa Inggris, Sosiologi, Ekonomi, dan Geografi Jurusan Bahasa: Matematika, Bahasa Indonesia, Bahasa Inggris, Sastra Indonesia, Antropologi, dan salah satu bahasa asing\n\nSMK: Matematika, Bahasa Indonesia, Bahasa Inggris, dan kompetensi keahlian.\n\nSekolah dapat menambahkan kriteria lain berupa prestasi akademik dalam menentukan peringkat siswa bila ada nilai yang sama. Jumlah siswa yang masuk dalam pemeringkatan sesuai dengan ketentuan kuota akreditasi sekolah. Tahapan pemeringkatan siswa oleh sekolah secara lengkap dapat dilihat pada informasi SNMPTN 2022 yang bisa diunduh di laman www.ltmpt.ac.id. (Kompas', 'administrator', '3.jpg', '2021-03-21 03:19:00', '2021-03-21 03:19:00'),
(6, 'Penyelarasan Kurikulum Implementasi Link and Supermatch SMK Pusat Keunggulan SMKN 9 Medan', '2021-12-04', 'SMKN 9 Medan adakan program workshop Implementasi Link and Supermatch, penyelarasan kurikulum sebagai wujud komitmen untuk melaksanakan program SMK Pusat Keunggulan. Sesuai dengan keputusan Menteri Pendidikan, Kebudayaan, Riset dan Teknologi RI No. 165/M/2021 tentang program sekolah menengah kejuruan Pusat Keunggulan bahwa SMK Pusat Keunggulan melaksanakan kemitraan Link and Super Match secara menyeluruh sesuai kesepakatan dengan dunia kerja. Acara diselenggarakan pada tanggal 12 Desember 2021 secara luring di ruang guru SMK Negeri 9 Medan.\n\nKegiatan workshop Penyelarasan Kurikulum di SMK Negeri 9 Medan dibuka secara resmi oleh Kepala SMKN 9 Medan Sukardi, S.P.d, MM didampingi Wakil Kepala Sekolah Bidang Hubungan Industri Ramzil Gempita Hidayat, S.P.d, Wakil Kepala Sekolah Bidang Kurikulum Novelman Manurung, ST dan Konsultan Pendidikan Tut Wuri Handayani Sumatera Utara, Dra. Hj. Ermidawati, M.Pd.\n\nSukardi, S.Pd, MM, Kepala SMKN 9 Medan menjelaskan bahwa tujuan diadakannya kegiatan tersebut adalah agar kurikulum SMK sesuai tuntutan dan budaya kerja yang berlaku di DUDIKA, sehingga lulusan SMK memiliki kompetensi dan etos kerja yang sesuai dengan kebutuhan DUDIKA serta menghasilkan tenaga kerja yang memiliki keterampilan, pengetahuan, dan etos kerja sesuai standar industri.\n\n“Harus ada perubahan pada konsep  kerjasama  SMK  dengan industri terutama pada kurikulumnya, sehingga ada win-win solution dimana SDM yang dibutuhkan DUDIKA dan yang di sediakan sekolah “match”, oleh karena itu diadakan Workshop Link and Supermatch”, tambah kepala SMKN 9 Medan Sukardi, S.Pd, MM.\n\nKegiatan dilaksanakan dengan rangkaian acara sambutan pengantar penyelarasan kurikulum, penandatanganan MoU, cara penyusunan capaian pembelajaran  dan bahan ajar, penyusunan capaian pembelajaran, penyusunan bahan ajar. Kegiatan dilakukan dengan model berkelompok dimana masing-masing jurusan didampingi oleh DUDIKA.   \n\nKegiatan tersebut dihadiri oleh 30 orang peserta termasuk didalamnya 6 perwakilan DUDIKA diantaranya dari Semut Advertising, PT Literasia Edutekno Digital, PT. DreamArch Animasi Utama, Panti Jompo FO Shi An, CV. Digital Global Network dan Indigo Space Medan.\n\n“SMK diberi keleluasaan memilih DUDIKA untuk melatih siswanya, dengan harapan siswa tersebut mempunyai skill yang nantinya bisa digunakan di Dunia Kerja”, terang Anditya, ST Pimpinan PT DreamArch Animasi Utama.\n\nSetelah paparan materi, acara dilanjutkan dengan diskusi bersama DUDIKA di masing-masing program keahlian. (Tim Humas)', 'administrator', '4.jpg', '2021-03-21 03:19:16', '2021-03-21 03:19:16'),
(7, 'Siswa SMK Negeri 9 Medan Juara I Lomba AKSI Tingkat Provsu', '2021-11-23', 'Siswa/I SMK Negeri 9 Medan meraih Juara I atas prestasi lomba Apresiasi Kebangsaan Siswa/i Indonesia (AKSI) SMK Tingkat Provinsi Sumatera Utara.\n\nKegiatan yang diselenggarakan Dinas Pendidikan Sumatera Utara (Disdik) Sumut di Wing Hotel Kualanamu pada hari Selasa s.d. Jumat (tanggal 16 s.d. 19 November 2021).\n\nAtas prestasi tersebut 3 orang siswa didampingi Wakil Kepala Sekolah Bidang Kesiswaan Muhammad Arief Wijaya, S.Pd menerima Piala dari Kepala Dinas Pendidikan Provinsi Sumatera Utara Prof Drs Syaifuddin MA. PhD diwakili Kabid Pembinaan SMK Ichsanul Arifin Siregar, S.STP.\n\nAdapun siswa yang mendapat juara atas nama Teresa Gusti Arifin kelas II Animasi 1.\n\nKepala SMK Negeri 9 Medan Sukardi, S.Pd, MM, Selasa (22/11/2021) menjelaskan, kegiatan Lomba AKSI ini untuk meningaktkan karakter siswa-siswi dalam bersikap dan cinta kepada nilai-nilai Kebangsaan NKRI yakni Nasionalisme, Kemandirian, Religius dan Gotong Royong.\n\n“Diharapkan kepada para siswa-siswi SMK Negeri 9 Medan agar meningkatkan kemampuan bersikap dan berkarakter serta diterapkan di lingkungan sekolah,” tegas Kepala Sekolah. (Tim)', 'administrator', '5.jpg', '2021-03-21 03:19:30', '2021-03-21 03:19:30'),
(8, 'Perguruan Tinggi Kedinasan Dengan Beasiswa Full ', '2022-01-31', 'Untuk yang ingin bersekolah atau menyekolahkan putra/putri yang lulus SMA/K Tahun ini mungkin ingin mencari Perguruan Tinggi Ikatan Dinas dan Beasiswa Penuh.\nBeasiswa ikatan dinas adalah Ikatan Dinas Jurusan IPS, Ikatan Dinas Jurusan IPA dan Ikatan Dinas Lulusan SMK.\nBerikut ini sekolah-sekolah yang memiliki ikatan dinas yang dihimpun di jejaring sosial adalah sebagai berikut:\n\n    Akademi Ilmu Pemasyarakatan Jakarta, Jalan Raya Gandul Cinere, Jakarta selatan, website www.depkumham.go.id\n    Akademi Kimia Analis Jawa Barat, Jalan Ir H Juanda 7, Bogor, website www.aka.ac.idn\n    Akademi Pimpinan Perusahaan Jakarta, Jalan Timbul 34, Cipedak, Jagakarsa, Jakarta Selatan, website www.app-jakarta.ac.id\n    AKAMIGAS-STEM – Akademi Minyak dan Gas Bumi (Sekolah Tinggi Enerji dan Mineral) di bawah Kementerian Energi dan Sumber Daya Mineral RI. Lokasi kuliah Cepu, Jawa Tengah (Kawasan Rig dan pengeboran minyak) – Info bisa dilihat di www.akamigas-stem.esdm.go.id\n    Akmil – Akademi Militer RI. Untuk pendaftaran bisa search di www.akmil.go.id\n    Akpol – Akademi Kepolisian RI. Untuk pendaftaran bisa search di www.penerimaanp olri.go.id\n    Akademi Meteorologi dan Geofisika (AMG), BMG, Jalan Perhubungan I No 5, Komplek Metro, Pondok Betung, Bintaro, Tangerang, website www.amg.ac.id\n    Sekolah Tinggi Ilmu Statistik (STIS), BPS, Jalan Otto Iskandardinata No 64C, Jakarta Timur, website www.stis.ac.id\n    Sekolah Tinggi AKuntansi Negara (STAN), Jalan Bintaro Utama Sektor V, Bintaro Jaya, Tangerang, website www.stan.ac.id\n    MMTC – Sekolah Tinggi Multi Media Training Center di bawah Kementerian Komunikasi dan Informatika RI (Kominfo) Pendaftaran online di www.mmtc.ac.id Lokasi kuliah di Yogyakarta\n    Politeknik Kesehatan DEPKES Surabaya, Jalan Pucang Jajar Tengah 56, Surabaya, website www.poltekkesdepkes-sby.ac.id dan banyak lagi sekolah kesehatan gratis seperti ini.\n    Sekolah Tinggi Ilmu Administrasi, Jalan Cimandiri 34-38, Bandung, website www.lan.go.id\n    Sekolah Tinggi Manajemen Industri Jakarta, Jalan Letjen Suprapto 26, Cempaka Putih, Jakarta Pusat, website www.stmi.ac.id.\n    Sekolah Tinggi Pariwisata Bandung, Jalan Dr Setiabudi 186, Bandung, website www.stp- bandung.ac.id\n    Sekolah Tinggi Penerbangan Indonesia, Curug Banten, Jalan Raya PLP Curug, Tangerang, website www.stpicurug.ac.id\n    Sekolah Tinggi Perikanan Jakarta, Jalan AUP, Pasar Minggu, Jakarta Selatan, website www.stp.dkp.go.id.\n    Sekolah Tinggi Pertanahan Nasional Yogyakarta, Jalan Tata Bumi 5, Banyuraden, Gamping, Sleman, Yogyakarta, website www.stpn.ac.id\n    Sekolah Tinggi Sandi Negara (STSN), Jalan Raya Haji Usa, Desa Putat Nutug, Ciseeng, Bogor, website www.stsn-nci.ac.id\n    Sekolah Tinggi Teknologi Tekstil Jawa Barat, Jalan Jakarta No 31, Bandung, website www.stttekstil.ac.id\n    Sekolah Tinggi Transportasi Darat Jawa Barat, jalan Raya Setu Km 3,5 Cibuntu, Cibitung, Bekasi, Jawa barat, website www.sttd.wetpaint.\n    STPDN/IPDN – Institut Pemerintahan Dalam Negeri di bawah Kementerian Dalam Negeri RI. Untuk pendaftaran bisa search di www.bkd.prov.go.id\n    STPN – Sekolah Tinggi Pertanahan Nasional di bawah Badan Pertanahan Nasional RI. Pendaftaran online di www.stpn.ac.id Lokasi kuliah Yogyakarta', 'administrator', '6.jpg', '2021-03-21 03:19:51', '2021-03-21 03:19:51'),
(9, 'SMK Negeri 9 Medan ikuti LKS Tingkat Nasional 2020 secara Daring', '2020-10-21', 'SMK Negeri 9 Medan mengikuti Lomba Ketrampilan Siswa (LKS) SMK tingkat Nasional XVIII Tahun 2020, kali pertamanya kegitan LKS Nasional yang di adakan secara Virtual secara Nasional hal ini dikarenakan Indonesia masih dalam masa pandemi Cofid-19 yang mengaruskan kita semua bekerja dari rumah. Termasuk juga kegiatan LKS Nasional tahun ini dimana setip peserta harus melaksankan kegiatan Lomba di rumah masing-masing yang sudah diatur dalam panduan dan petunjuk teknis LKS ke XVIII Tahun 2020.\n\nKali ini SMK Negeri 9 Medan mewakili Sumatera Utara mengikuti 2 Bidang Lomba yaitu Keperawatan Kesehatan dan Sosial yang di ikuti oleh Nur Aisyah Putri perwakilan dari Kelas XII PS-3 sedangkan bidang Teknologi Informasi Piranti Lunak untuk Bisnis diikuti oleh M.Irvan Amir Fauzan siregar perwakilan dari kelas XII RPL-1.\n\nKedua bidang lomba sudah dipersiapkan sejak 2 Bulan yang lalu yang di bimbing oleh guru SMK Negeri 9 Medan beserta TIM yang selalu mendukung dan mensupport kegiatan LKS ini.\n\nAdapun kegiatan LKS ini dilaksankan mulai 18-24 Oktober 2020, walaupun dimasa pandemi kalimantan selatan sebagai tuan rumah tetap melaksanakan kegiatan LKS yang dilakukan secara Virtual/Daring.\n\nSemoga SMK Negeri 9 Medan Tahun ini mendapatkan hasil yang terbaik dari tahun-tahun sebelumnya. Amin', 'administrator', '7.jpg', '2021-03-21 03:20:07', '2021-03-21 03:20:07'),
(10, 'Sosialisasi Program Anti Perundungan SMK-PK SMKN 9 Medan', '2021-09-25', '\n\nAcara Sosialisasi Program Anti Perundungan SMK-Pusat Keunggulan yang dilaksanakan pada hari Sabtu tanggal 25 Oktober 2021 di SMK Negeri 9 Medan”, berjalan dengan baik. Kegiatan ini bertujuan untuk memberikan pemahaman kepada warga sekolah khususnya siswa-siswi tentang arti perundungan dan dampak yang timbul jika hal itu tidak dipahami secara menyeluruh bagaimana harus dihadapi. Oleh karena itu kegiatan ini dirasa sangat perlu untuk mendapatkan perhatian khusus dengan terus secara konsisten membimbing dan membina siswa untuk selalu berfikir positif dan menghargai orang lain sebagai wujud hasil dari pendidikan yang berkarakter ( Soft Skill ).\n\nKami para Guru yakin dengan usaha, tekat yang kuat serta ketulusan diiringi do’a terbaik akan bisa menghasilkan lulusan dengan karakter kuat yang positif thinking, berjiwa besar, dan menjadi manusia yang memanusiakan manusia. Maju terus SMKN 9 Medan tercinta! salam SMK-Bisa-Hebat !!!', 'administrator', 'el4.jpg', '2021-03-21 03:20:23', '2021-03-21 03:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

DROP TABLE IF EXISTS `guru`;
CREATE TABLE IF NOT EXISTS `guru` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_auth` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `nip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nuptk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_guru` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmpt_lhr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmt_jabatan` date NOT NULL,
  `pangkat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmt_pangkat` date NOT NULL,
  `no_hp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_di_pt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tamat_thn_di_pt` year(4) NOT NULL,
  `sts_keguruan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bdg_studi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmt_tugas_di_sklh` date NOT NULL,
  `masa_kerja_keseluruhan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cttn_mutasi_kepeg` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lulus_sertifikasi` date NOT NULL,
  `pensiun_tmt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kenaikan_gaji_berkala` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `id_auth`, `id_mapel`, `nip`, `nuptk`, `npwp`, `nama_guru`, `gender`, `tmpt_lhr`, `tanggal_lahir`, `alamat`, `agama`, `jabatan`, `tmt_jabatan`, `pangkat`, `tmt_pangkat`, `no_hp`, `nama_pt`, `jurusan_di_pt`, `tamat_thn_di_pt`, `sts_keguruan`, `bdg_studi`, `tmt_tugas_di_sklh`, `masa_kerja_keseluruhan`, `cttn_mutasi_kepeg`, `tgl_lulus_sertifikasi`, `pensiun_tmt`, `kenaikan_gaji_berkala`, `created_at`, `updated_at`) VALUES
(12, 15, 5, '0887766554234', '12345', '123', 'Nico Gawa Lahara', 'laki - laki', 'medan', '2021-03-18', 'Jl. Jangka no 24', 'Islam', 'Kepala Sekolah', '2020-01-01', 'Pembina Tk.1,  IV/b', '2019-12-12', '0822345678', 'Panca Budi', 'SI', 2017, 'PNS', 'PBO', '2020-01-20', '-', '-', '2019-12-20', '-', '-', '2021-03-18 00:42:29', '2021-04-07 21:53:40'),
(18, 20, 3, '8843123456788', '12345678', '12345678', 'Intan Kartini Lubis', 'perempuan', 'medan', '2021-03-20', 'Jl. Klambir V', 'Islam', 'guru', '2020-01-14', 'Penata Muda Tk.I, III/b', '2020-01-01', '9876534567', 'panca budi', 'SI', 2018, 'GTT', 'Bahasa Indonesia', '2020-01-17', '-', '-', '2020-01-02', '-', '-', '2021-03-18 19:30:15', '2021-04-02 22:09:28'),
(17, 19, 1, '88234567877', '1234567890', '1234567890', 'Zaidan Hamdany', 'laki - laki', 'medan', '2000-02-16', 'Jl. Gaperta', 'Islam', 'Kepala Jurusan RPL', '2019-07-16', 'Penata Tk.1 III/d', '2019-07-25', '9876543234', 'Universitas Negeri Medan', 'PTIK', 2019, 'PNS', 'Matematika', '2019-07-25', '-', '-', '2019-07-01', '-', '-', '2021-03-18 19:19:48', '2021-04-03 03:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pembayaran`
--

DROP TABLE IF EXISTS `jadwal_pembayaran`;
CREATE TABLE IF NOT EXISTS `jadwal_pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `jumlah_tagihan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_pembayaran`
--

INSERT INTO `jadwal_pembayaran` (`id`, `keterangan`, `tanggal_jatuh_tempo`, `jumlah_tagihan`, `created_at`, `updated_at`) VALUES
(1, 'TESTING PEMBAYARAN', '2021-03-22', 50000, '2021-03-22 13:02:19', '2021-03-22 13:52:52'),
(2, 'TESTING PEMBAYARAN', '2021-03-22', 30000, '2021-03-22 13:07:15', '2021-03-22 13:49:34'),
(6, 'Pembayaran 1', '2021-03-22', 40000, '2021-03-22 14:12:36', '2021-03-22 14:12:36'),
(4, 'SPP 1', '2021-03-22', 10000, '2021-03-22 13:16:09', '2021-03-22 14:56:09'),
(5, 'SPP 2', '2021-03-22', 60000, '2021-03-22 13:16:57', '2021-03-22 14:56:40'),
(7, 'oke pembayaran', '2021-03-22', 60000, '2021-03-22 14:50:27', '2021-03-22 14:50:27'),
(8, 'pembayaran lagi', '2021-03-22', 60000, '2021-03-22 14:51:28', '2021-03-22 14:51:28'),
(9, 'SPP 3', '2021-03-22', 70000, '2021-03-22 14:52:13', '2021-03-22 14:57:24'),
(10, 'pembayaran 2', '2021-03-22', 60000, '2021-03-22 14:53:21', '2021-03-22 14:53:21'),
(11, 'pembayaran 2', '2021-03-22', 60000, '2021-03-22 14:54:13', '2021-03-22 14:54:13'),
(12, 'pembayaran 2', '2021-03-22', 60000, '2021-03-22 14:55:05', '2021-03-22 14:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

DROP TABLE IF EXISTS `kegiatan`;
CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `gambar`, `keterangan`, `tanggal`, `created_at`, `updated_at`) VALUES
(2, '11.jpg', 'Kegiatan 1', '2021-03-21', '2021-03-21 01:58:28', '2021-03-21 02:07:12'),
(3, '12.jpg', 'Kegiatan 2', '2021-03-21', '2021-03-21 01:58:47', '2021-03-21 01:58:47'),
(5, '14.jpg', 'Kegiatan 4', '2021-03-21', '2021-03-21 01:59:22', '2021-03-21 01:59:22'),
(6, '15.jpg', 'Kegiatna 5', '2021-03-21', '2021-03-21 01:59:34', '2021-03-21 01:59:34'),
(7, '16.jpg', 'Kegiatan 6', '2021-03-21', '2021-03-21 01:59:47', '2021-03-21 01:59:47'),
(8, '17.jpg', 'Kegiatan 7', '2021-03-22', '2021-03-21 02:00:00', '2021-03-21 02:00:00'),
(9, '18.jpg', 'Kegiatan 8', '2021-03-21', '2021-03-21 02:00:14', '2021-03-21 02:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE IF NOT EXISTS `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `jurusan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'RPL / TKJ / PS / DKV / AN / MM',
  `kelas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'VII-1 / VIII-1 / IX-1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `jurusan`, `kelas`, `created_at`, `updated_at`) VALUES
(14, 'RPL', 'X RPL 1', '2021-04-11 20:12:27', '2021-04-11 20:12:27'),
(13, 'RPL', 'XI RPL 1', '2021-04-10 23:14:19', '2021-04-10 23:14:19'),
(11, 'RPL', 'XII RPL 1', '2021-03-17 01:56:04', '2021-03-17 01:56:04'),
(5, 'TKJ', 'X TKJ 1', '2021-03-17 01:56:11', '2021-03-17 01:56:11'),
(10, 'TKJ', 'XI TKJ 1', '2021-03-17 01:54:45', '2021-03-17 01:54:45'),
(7, 'TKJ', 'XII TKJ 1', '2021-03-17 01:53:23', '2021-03-17 01:53:23'),
(15, 'PS', 'X PS 1', '2021-04-11 20:12:39', '2021-04-11 20:12:39'),
(16, 'PS', 'XI PS 1', '2021-04-11 20:12:47', '2021-04-11 20:12:47'),
(24, 'PS', 'XII PS 1', '2021-04-12 03:19:08', '2021-04-12 03:19:08'),
(18, 'DKV', 'X DKV 1', '2021-04-11 20:13:07', '2021-04-11 20:13:07'),
(19, 'DKV', 'XI DKV 1', '2021-04-11 20:14:25', '2021-04-11 20:14:25'),
(20, 'DKV', 'XII DKV 1', '2021-04-11 20:15:41', '2021-04-11 20:15:41'),
(21, 'AN', 'X AN 1', '2021-04-11 20:16:00', '2021-04-11 20:16:00'),
(22, 'AN', 'XI AN 1', '2021-04-11 20:16:41', '2021-04-11 20:16:41'),
(23, 'AN', 'XII AN 1', '2021-04-11 20:17:48', '2021-04-11 20:17:48'),
(25, 'MM', 'X MM 1', NULL, NULL),
(26, 'MM', 'XI MM 1', NULL, NULL),
(27, 'MM', 'XII MM 1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_yang_diajar`
--

DROP TABLE IF EXISTS `kelas_yang_diajar`;
CREATE TABLE IF NOT EXISTS `kelas_yang_diajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas_yang_diajar`
--

INSERT INTO `kelas_yang_diajar` (`id`, `id_guru`, `id_kelas`, `id_tahun_ajaran`, `created_at`, `updated_at`) VALUES
(2, 12, 11, 1, '2021-03-20 00:22:36', '2021-03-20 00:22:36'),
(3, 18, 5, 1, '2021-03-20 00:22:41', '2021-03-20 00:22:41'),
(4, 17, 10, 1, '2021-03-20 00:22:49', '2021-03-20 00:22:49'),
(5, 18, 11, 1, '2021-03-21 15:35:35', '2021-03-21 15:35:35'),
(6, 18, 10, 1, '2021-03-21 15:35:45', '2021-03-21 15:35:45'),
(7, 12, 10, 1, '2021-03-20 00:22:36', '2021-03-20 00:22:36');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

DROP TABLE IF EXISTS `mata_pelajaran`;
CREATE TABLE IF NOT EXISTS `mata_pelajaran` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mata_pelajaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `mata_pelajaran`, `created_at`, `updated_at`) VALUES
(1, 'matematika', NULL, NULL),
(3, 'ips', '2021-03-14 00:14:18', '2021-03-14 00:14:18'),
(4, 'Bahasa Indonesia', '2022-02-14 16:40:51', '2022-02-14 16:40:51'),
(5, 'PBO', '2021-03-14 00:25:48', '2021-03-14 00:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(14, '2021_03_05_164527_create_auth', 1),
(15, '2021_03_05_164904_create_admin', 1),
(16, '2021_03_05_164917_create_guru', 1),
(17, '2021_03_05_165049_create_kelas', 1),
(18, '2021_03_05_165058_create_notifikasi', 1),
(19, '2021_03_05_165111_create_siswa_kelas', 1),
(20, '2021_03_05_165120_create_wali_kelas', 1),
(21, '2021_03_05_165149_create_mata_pelajaran', 1),
(22, '2021_03_05_165200_create_nilai', 1),
(23, '2021_03_05_165221_create_siswa', 1),
(24, '2021_03_05_165833_create_pembayaran', 1),
(25, '2021_03_05_165846_create_jadwal_pembayaran', 1),
(26, '2021_03_05_165903_create_orang_tua', 1),
(27, '2021_03_05_175742_create_profil_sekolah', 1),
(28, '2021_03_05_175753_create_kegiatan', 1),
(29, '2021_03_05_175802_create_berita', 1),
(30, '2021_04_10_144255_create_tahun_ajaran_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

DROP TABLE IF EXISTS `nilai`;
CREATE TABLE IF NOT EXISTS `nilai` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_mapel` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nilai_tugas` double NOT NULL,
  `nilai_mid` double NOT NULL,
  `nilai_uas` double NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `id_mapel`, `id_guru`, `id_kelas`, `id_siswa`, `nilai_tugas`, `nilai_mid`, `nilai_uas`, `id_tahun_ajaran`, `created_at`, `updated_at`) VALUES
(1, 3, 18, 10, 2, 80, 99, 90, 1, '2021-03-21 21:47:53', '2021-04-12 15:33:10'),
(2, 1, 17, 10, 2, 90, 90, 90, 1, '2021-04-03 03:55:55', '2021-04-12 15:30:23'),
(3, 3, 18, 10, 3, 85, 80, 80, 1, '2021-04-03 04:27:16', '2021-04-12 15:33:21'),
(4, 1, 17, 10, 3, 99, 99, 99, 1, '2021-04-03 04:28:13', '2021-04-12 15:30:42'),
(5, 5, 12, 10, 2, 85, 80, 80, 1, '2021-04-07 21:41:26', '2021-04-12 15:40:09'),
(6, 5, 12, 10, 3, 99, 99, 99, 1, '2021-04-07 21:41:48', '2021-04-12 15:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

DROP TABLE IF EXISTS `notifikasi`;
CREATE TABLE IF NOT EXISTS `notifikasi` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_auth` int(11) NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

DROP TABLE IF EXISTS `orang_tua`;
CREATE TABLE IF NOT EXISTS `orang_tua` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_auth` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nama_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmpt_lhr_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir_ayah` date NOT NULL,
  `agama_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penghasilan_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hidup_meninggal_ayah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmpt_lhr_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir_ibu` date NOT NULL,
  `agama_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penghasilan_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hidup_meninggal_ibu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_wali` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmpt_lhr_wali` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lhr_wali` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama_wali` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan_wali` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_wali` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penghasilan_wali` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_wali` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_wali` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orang_tua`
--

INSERT INTO `orang_tua` (`id`, `id_auth`, `id_siswa`, `nama_ayah`, `tmpt_lhr_ayah`, `tanggal_lahir_ayah`, `agama_ayah`, `pendidikan_ayah`, `pekerjaan_ayah`, `penghasilan_ayah`, `alamat_ayah`, `no_hp_ayah`, `hidup_meninggal_ayah`, `nama_ibu`, `tmpt_lhr_ibu`, `tanggal_lahir_ibu`, `agama_ibu`, `pendidikan_ibu`, `pekerjaan_ibu`, `penghasilan_ibu`, `alamat_ibu`, `no_hp_ibu`, `hidup_meninggal_ibu`, `nama_wali`, `tmpt_lhr_wali`, `tgl_lhr_wali`, `agama_wali`, `pendidikan_wali`, `pekerjaan_wali`, `penghasilan_wali`, `alamat_wali`, `no_hp_wali`, `created_at`, `updated_at`) VALUES
(1, 27, 4, 'Ayah Fandi', 'rantau prapat', '1961-03-19', 'Islam', 's1', 'programmer', 'Rp. 8.000.000,-', 'jl. tani asli', '009876543234', 'masih hidup', 'Ibu Fandi', 'pematang siantar', '1971-03-19', 'Islam', 's1', 'ibu rumah tangga', '-', 'jl. tani asli', '23456789876', 'masih hidup', '--', '-', '-', '-', '-', '-', '-', '-', '-', '2021-03-19 20:51:09', '2021-03-21 11:21:56'),
(2, 29, 3, 'ayah nopi', 'medan', '1962-03-31', 'islam', 's1', 'direktur', '25000000', 'jl. jangka', '081234567890', 'masih hidup', 'ibu nopi', 'medan', '1972-03-15', 'islam', 's1', 'wirausaha', '10000000', 'jl. jangka', '089876123467', 'masih hidup', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_jadwal_pembayaran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `status_pembayaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_pembayaran` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `status_kembalian` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_jadwal_pembayaran`, `id_siswa`, `status_pembayaran`, `jumlah_pembayaran`, `tanggal_pembayaran`, `status_kembalian`, `created_at`, `updated_at`) VALUES
(1, 10, 3, 'sudah dibayar', '60000', '2021-03-23', NULL, NULL, '2021-03-22 15:26:33'),
(2, 4, 3, 'belum dibayar', '0', NULL, NULL, '2021-03-22 14:56:09', '2021-03-22 14:56:09'),
(3, 5, 3, 'belum dibayar', '0', NULL, NULL, '2021-03-22 14:56:40', '2021-03-22 14:56:40'),
(4, 9, 3, 'belum dibayar', '0', NULL, NULL, '2021-03-22 14:57:24', '2021-03-22 14:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `profil_sekolah`
--

DROP TABLE IF EXISTS `profil_sekolah`;
CREATE TABLE IF NOT EXISTS `profil_sekolah` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profil_sekolah`
--

INSERT INTO `profil_sekolah` (`id`, `tipe`, `title`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'alamat', 'alamat', 'Jl. Patriot No.20 A Medan\r\nSumatera Utara – Indonesia, 20127', NULL, NULL),
(2, 'website', 'website', 'www.smkn9medan.sch.id', NULL, NULL),
(3, 'email', 'email', 'smkn09medan@gmail.com', NULL, NULL),
(4, 'no_telp', 'no_telp', '061-8454350', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_auth` int(11) NOT NULL,
  `nisn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipd` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_siswa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('laki - laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kewarganegaraan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anak_ke` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jlh_saudara_kandung` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jlh_saudara_tiri` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jlh_saudara_angkat` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anak_yatim_piatu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bahasa_dirumah` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinggal_dengan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jrk_tgl_ke_sklh` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gol_darah` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyakit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelainan_jasmani` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinggi_badan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_badan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_sekolah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_no_sttb` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lama_bljr` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diterima_dikelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diterima_tgl` date NOT NULL,
  `jurusan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kesenian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `olahraga` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lain_lain` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `id_auth`, `nisn`, `nipd`, `nama_siswa`, `email`, `gender`, `tanggal_lahir`, `tempat_lahir`, `agama`, `alamat`, `no_hp`, `kewarganegaraan`, `anak_ke`, `jlh_saudara_kandung`, `jlh_saudara_tiri`, `jlh_saudara_angkat`, `anak_yatim_piatu`, `bahasa_dirumah`, `tinggal_dengan`, `jrk_tgl_ke_sklh`, `gol_darah`, `penyakit`, `kelainan_jasmani`, `tinggi_badan`, `berat_badan`, `asal_sekolah`, `tgl_no_sttb`, `lama_bljr`, `diterima_dikelas`, `diterima_tgl`, `jurusan`, `kesenian`, `olahraga`, `organisasi`, `lain_lain`, `created_at`, `updated_at`) VALUES
(4, 24, '998877234567', '123456790', 'M. Alfandi Hasibuan', 'alfandihsb@gmail.com', 'laki - laki', '1999-05-02', 'Siantar', 'Islam', 'Jl. Tani Asli Sekali', '0822345678', 'Puerto Rico', '2', '3', '0', '0', '-', 'Indonesia', 'Orangtua', '3 KM', 'A', 'Covid-19', '-', '165 cm', '65 kg', 'SMK Negeri 1 Purwokerto', '131215, 12345678', '1,5 tahun', '2', '2016-01-01', 'RPL', 'rapper', 'ga bisa', 'pemuda pancasilat', '-', '2021-03-19 12:09:15', '2021-04-12 01:41:45'),
(3, 28, '09876543456666', '0987654321', 'Novia Mahara', 'noviamahara@mail.com', 'perempuan', '2021-04-03', 'Medan', 'Islam', 'Jl. Gaperta', '9876543234', 'Indonesia', '2', '1', '0', '0', '-', 'Indonesia', 'Orangtua', '3 km', 'B', '-', '-', '163 cm', '70 kg', 'SMP Negeri 7 Medan', '120619, 9865321', '3 tahun', '1', '2019-07-12', 'RPL', '-', '-', '-', '-', '2021-04-03 04:24:10', '2021-04-11 19:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_kelas`
--

DROP TABLE IF EXISTS `siswa_kelas`;
CREATE TABLE IF NOT EXISTS `siswa_kelas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kelas` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa_kelas`
--

INSERT INTO `siswa_kelas` (`id`, `id_kelas`, `id_tahun_ajaran`, `id_siswa`, `created_at`, `updated_at`) VALUES
(1, 10, 1, 4, '2021-04-12 01:41:45', '2021-04-12 01:41:45'),
(2, 10, 1, 3, '2021-04-11 19:36:19', '2021-04-11 19:36:19'),
(7, 15, 3, 3, '2021-04-12 03:13:51', '2021-04-12 03:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

DROP TABLE IF EXISTS `tahun_ajaran`;
CREATE TABLE IF NOT EXISTS `tahun_ajaran` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun_ajaran`, `created_at`, `updated_at`) VALUES
(1, '2020 / 2021', '2021-04-11 00:29:37', '2021-04-11 00:29:37'),
(3, '2021 / 2022', '2021-04-11 19:17:12', '2021-04-11 19:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `wali_kelas`
--

DROP TABLE IF EXISTS `wali_kelas`;
CREATE TABLE IF NOT EXISTS `wali_kelas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kelas` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wali_kelas`
--

INSERT INTO `wali_kelas` (`id`, `id_kelas`, `id_guru`, `id_tahun_ajaran`, `created_at`, `updated_at`) VALUES
(15, 14, 12, 3, '2021-04-11 20:19:49', '2021-04-11 20:19:49'),
(12, 11, 12, 1, '2021-03-18 18:45:59', '2021-03-18 18:45:59'),
(13, 10, 17, 1, '2021-03-18 19:19:58', '2021-03-18 19:31:19'),
(14, 5, 18, 1, '2021-03-18 19:33:42', '2021-03-18 19:33:42'),
(16, 16, 18, 3, '2021-04-11 20:20:06', '2021-04-11 20:20:06'),
(18, 15, 17, 3, '2021-04-12 03:15:26', '2021-04-12 03:15:26');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
