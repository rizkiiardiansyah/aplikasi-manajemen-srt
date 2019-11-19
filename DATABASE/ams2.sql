-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2019 at 06:25 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_disposisi`
--

CREATE TABLE `tbl_disposisi` (
  `id_disposisi` int(10) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `isi_disposisi` mediumtext NOT NULL,
  `sifat` varchar(100) NOT NULL,
  `batas_waktu` date NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_disposisi`
--

INSERT INTO `tbl_disposisi` (`id_disposisi`, `tujuan`, `isi_disposisi`, `sifat`, `batas_waktu`, `catatan`, `id_surat`, `id_user`) VALUES
(2, 'Nur Hafid', 'Segera Koordinasi Pelaksanaan Zakat Fitrah', 'Segera', '2016-06-12', 'Segera Laksanakan', 11, 5),
(3, 'Ani Triastuti, S.E., S.Pd', 'Segera hadiri undangan', 'Penting', '2016-05-17', 'Mohon hadir tepat waktu', 14, 5),
(4, 'Karawang', 'Kewajiban', 'Segera', '2019-08-25', 'sfsadad', 21, 1),
(6, 'cikampek', 'wdwwd', 'Segera', '2019-08-25', 'wdwdw', 0, 1),
(8, 'cikampek', 'wdwwd', 'Segera', '2019-08-25', 'wdwdw', 0, 1),
(9, 'cikampek', 'wdwwd', 'Segera', '2019-08-25', 'wdwdw', 0, 1),
(10, 'cikampek', 'wdwwd', 'Segera', '2019-08-25', 'wdwdw', 0, 1),
(11, 'cikampek', 'wdwwd', 'Segera', '2019-08-25', 'wdwdw', 0, 1),
(12, 'cikampek', 'wdwwd', 'Segera', '2019-08-25', 'wdwdw', 0, 1),
(13, 'cikampek', 'wdwwd', 'Segera', '2019-08-25', 'wdwdw', 0, 1),
(14, 'cikampek', 'wdwwd', 'Segera', '2019-08-25', 'wdwdw', 0, 1),
(15, 'cikampek', 'wdwwd', 'Segera', '2019-08-25', 'wdwdw', 0, 1),
(16, 'cikampek', 'wdwwd', 'Segera', '2019-08-25', 'wdwdw', 0, 1),
(17, 'cikampek', 'wdwwd', 'Segera', '2019-08-25', 'wdwdw', 0, 1),
(18, 'cikampek', 'sdSDSD', 'Segera', '2019-08-15', 'SDSd', 0, 1),
(19, 'Karawang', 'sdsDS', 'Segera', '2019-09-18', 'bfsfgsf', 0, 1),
(20, 'Karawang', 'sdsDS', 'Segera', '2019-09-18', 'bfsfgsf', 0, 1),
(21, 'Karawang', 'sdsDS', 'Segera', '2019-09-18', 'bfsfgsf', 0, 1),
(22, 'Karawang', 'sdsDS', 'Segera', '2019-09-18', 'bfsfgsf', 0, 1),
(23, 'Karawang', 'sdsDS', 'Segera', '2019-09-18', 'bfsfgsf', 0, 1),
(24, 'Karawang', 'asasasas', 'Segera', '2019-09-18', 'bfsfgsf', 0, 1),
(25, 'wdwdw', 'wdwdw', 'Biasa', '2019-09-18', 'wdwd', 0, 1),
(27, 'asasas', 'asasas', 'Biasa', '2019-09-18', 'asasas', 34, 1),
(28, 'Cinta', 'gagagga', 'Penting', '2019-08-25', 'adadad', 34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instansi`
--

CREATE TABLE `tbl_instansi` (
  `id_instansi` tinyint(1) NOT NULL,
  `institusi` varchar(150) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kepsek` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_instansi`
--

INSERT INTO `tbl_instansi` (`id_instansi`, `institusi`, `nama`, `status`, `alamat`, `kepsek`, `nip`, `website`, `email`, `logo`, `id_user`) VALUES
(1, 'Kementrian Sumber Daya Manusia', 'Badan Kepegawaian Sumber Daya Manusia', 'Aktif', 'Jln. Veteran', 'Rizki Ardiansyah S.kom', '12100318022323', 'https://textcode.blogspot.com', 'e.rizkiardiansyah@gmail.com', '1547445930878.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_klasifikasi`
--

CREATE TABLE `tbl_klasifikasi` (
  `id_klasifikasi` int(5) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `uraian` mediumtext NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_klasifikasi`
--

INSERT INTO `tbl_klasifikasi` (`id_klasifikasi`, `kode`, `nama`, `uraian`, `id_user`) VALUES
(1, '420', 'PENDIDIKAN', 'PENDIDIKAN', 1),
(2, '420.1', 'Pendidikan Khusus Klasifikasi disini Pendidikan Putra/I Irja', 'Pendidikan Khusus Klasifikasi disini Pendidikan Putra/I Irja', 1),
(3, '421', 'Sekolah', 'Sekolah', 1),
(4, '421.1', 'Pra Sekolah', 'Pra Sekolah', 1),
(5, '421.2', 'Sekolah Dasar', 'Sekolah Dasar', 1),
(6, '421.3', 'Sekolah Menengah', 'Sekolah Menengah', 1),
(7, '421.4', 'Sekolah Tinggi', 'Sekolah Tinggi', 1),
(8, '421.5', 'Sekolah Kejuruan', 'Sekolah Kejuruan', 1),
(9, '421.6', 'Kegiatan Sekolah, Dies Natalis Lustrum', 'Kegiatan Sekolah, Dies Natalis Lustrum', 1),
(10, '421.7', 'Kegiatan Pelajar', 'Kegiatan Pelajar', 1),
(11, '421.71', 'Reuni Darmawisata', 'Reuni Darmawisata', 1),
(12, '421.72', 'Pelajar Teladan', 'Pelajar Teladan', 1),
(13, '421.73', 'Resimen Mahasiswa', 'Resimen Mahasiswa', 1),
(14, '421.8', 'Sekolah Pendidikan Luar Biasa', 'Sekolah Pendidikan Luar Biasa', 1),
(15, '421.9', 'PLS / Pemberantasan Buta Huruf', 'PLS / Pemberantasan Buta Huruf', 1),
(16, '422', 'Administrasi Sekolah', 'Administrasi Sekolah', 1),
(17, '422.1', 'Persyaratan Masuk Sekolah, Testing, Ujian,Pendaftaran, Mapras', 'Persyaratan Masuk Sekolah, Testing, Ujian,Pendaftaran, Mapras', 1),
(18, '422.2', 'Tahun Pelajaran', 'Tahun Pelajaran', 1),
(19, '422.3', 'Hari Libur', 'Hari Libur', 1),
(20, '422.4', 'Uang Sekolah, Klasifikasi Disini SPP', 'Uang Sekolah, Klasifikasi Disini SPP', 1),
(21, '422.5', 'Beasiswa', 'Beasiswa', 1),
(22, '423', 'Metode Belajar', 'Metode Belajar', 1),
(23, '423.1', 'Kuliah', 'Kuliah', 1),
(24, '423.2', 'Ceramah, Simposium', 'Ceramah, Simposium', 1),
(25, '423.3', 'Diskusi', 'Diskusi', 1),
(26, '423.4', 'Kuliah Lapangan, Widyawisata, KKN, Studi Tur', 'Kuliah Lapangan, Widyawisata, KKN, Studi Tur', 1),
(27, '423.5', 'Kurikulum', 'Kurikulum', 1),
(28, '423.6', 'Karya Tulis', 'Karya Tulis', 1),
(29, '423.7', 'Ujian', 'Ujian', 1),
(30, '424', 'Tenaga Pengajar, Guru, Dosen, Dekan, Rektor', 'Tenaga Pengajar, Guru, Dosen, Dekan, Rektor', 1),
(31, '425', 'Sarana Pendidikan', 'Sarana Pendidikan', 1),
(32, '425.1', 'Gedung', 'Gedung', 1),
(33, '425.11', 'Gedung Sekolah', 'Gedung Sekolah', 1),
(34, '425.12', 'Kampus', 'Kampus', 1),
(35, '425.13', 'Pusat Kegiatan Mahasiswa', 'Pusat Kegiatan Mahasiswa', 1),
(36, '425.2', 'Buku', 'Buku', 1),
(37, '425.3', 'Perlengkapan Sekolah', 'Perlengkapan Sekolah', 1),
(38, '426', 'Keolahragaan', 'Keolahragaan', 1),
(39, '426.1', 'Cabang Olah Raga', 'Cabang Olah Raga', 1),
(40, '426.2', 'Sarana', 'Sarana', 1),
(41, '426.21', 'Gedung Olah Raga', 'Gedung Olah Raga', 1),
(42, '426.22', 'Stadion', 'Stadion', 1),
(43, '426.23', 'Lapangan', 'Lapangan', 1),
(44, '426.24', 'Kolam renang', 'Kolam renang', 1),
(45, '426.3', 'Pesta Olah Raga, Klasifikasi nya: PON, Porsade, Olimpiade,', 'Pesta Olah Raga, Klasifikasi nya: PON, Porsade, Olimpiade,', 1),
(46, '426.4', 'KONI', 'KONI', 1),
(47, '427', 'Kepramukaan Meliputi: Organisasi dan Kegiatan Remaja', 'Kepramukaan Meliputi: Organisasi dan Kegiatan Remaja', 1),
(48, '428', 'Kepramukaan', 'Kepramukaan', 1),
(49, '429', 'Pendidikan Kedinasan Untuk Depdagri', 'Pendidikan Kedinasan Untuk Depdagri', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sett`
--

CREATE TABLE `tbl_sett` (
  `id_sett` tinyint(1) NOT NULL,
  `surat_masuk` tinyint(2) NOT NULL,
  `surat_keluar` tinyint(2) NOT NULL,
  `referensi` tinyint(2) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sett`
--

INSERT INTO `tbl_sett` (`id_sett`, `surat_masuk`, `surat_keluar`, `referensi`, `id_user`) VALUES
(1, 5, 20, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_keluar`
--

CREATE TABLE `tbl_surat_keluar` (
  `id_surat` int(10) NOT NULL,
  `no_agenda` int(10) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_catat` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_surat_keluar`
--

INSERT INTO `tbl_surat_keluar` (`id_surat`, `no_agenda`, `tujuan`, `no_surat`, `isi`, `kode`, `tgl_surat`, `tgl_catat`, `file`, `keterangan`, `id_user`) VALUES
(6, 34121434, 'cikampek', '12121313', 'gggtgeg', '', '2019-09-19', '2019-09-17', '7806-1547445930878.png', 'rgtrgeg', 1),
(7, 4574574, 'cikampek', '1212211312', 'jbgjgk', '', '2019-09-01', '2019-09-17', '7699-1547445930878.png', 'jgugkguuk', 1),
(8, 4574574, 'cikampek', '1212131354', 'nkj.kj', '', '2019-09-18', '2019-09-17', '3516-1547445930878.png', 'hgkhggjh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_masuk`
--

CREATE TABLE `tbl_surat_masuk` (
  `id_surat` int(10) NOT NULL,
  `no_agenda` int(10) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(30) NOT NULL,
  `indeks` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_surat_masuk`
--

INSERT INTO `tbl_surat_masuk` (`id_surat`, `no_agenda`, `no_surat`, `asal_surat`, `isi`, `kode`, `indeks`, `tgl_surat`, `tgl_diterima`, `file`, `keterangan`, `id_user`) VALUES
(11, 1, '001/PPH/VI/2016', 'Pondok Pesantren Hidayatullah Nganjuk', 'Permohonan Zakat Fitrah', '421.7', 'A.1', '2016-06-09', '2016-07-24', '601-surat masuk 1.jpg', 'Penting', 5),
(12, 2, '074 / BAZNAZ.JTM / IV / 2016', 'Badan Amil Zakat Nasional Provinsi Jawa Timur', 'Pencairan Dana Bantuan Sebesar Rp. 800.000,- (Delapan Ratus Ribu Rupiah) dari Baznaz.', '422.4', 'A.2', '2016-04-07', '2016-07-24', '7523-surat masuk 2.jpg', 'Penting', 5),
(13, 3, '3 / XI/M.BIG/2016', 'Musyawarah Guru Mata Pelajaran Bahasa Inggris', 'Surat edaran pertemuan rutin musyawarah guru mata pelajaran bahasa inggris.', '420', 'A.3', '2016-04-19', '2016-07-24', '', '-', 5),
(14, 4, '560/402.1/411.203/2016', 'Dinas Sosial Tenaga Kerja Dan Transmigrasi Daerah Kabupaten Nganjuk', 'Surat undangan untuk menghadiri acara Pameran Bursa Kerja Untuk Percepatan Penempatan Tenaga Kerja / Job Fair Tahun 2016', '421', 'A.2', '2016-05-12', '2016-07-24', '', 'Segera laksanakan', 5),
(15, 1, '12121', 'Cikampek', 'sdedqe', '1', '121111', '2019-08-21', '2019-08-24', '1935-1547445930878.png', 'eqerqer', 1),
(16, 121111212, '3413434', 'Cikampek', 'dwjehwehwie', '12', 'etrw3r23r3', '2019-08-28', '2019-08-24', '1236-1547445930878.png', 'sdasdasd', 1),
(17, 1121212, '12121212', 'Cikampek', 'fsdfsfe', '22', '222', '2019-08-22', '2019-08-24', '4506-1547445930878.png', '2ewewe', 1),
(18, 222222222, '22222222222222222', 'CIkampek', 'fererer', '12121', '121212', '2019-08-22', '2019-08-24', '1027-1547445930878.png', '2e23232', 1),
(19, 12121212, '1212121212', 'Cikampek', 'dqeqerqe', '429', 'aeewqw', '2019-08-28', '2019-08-24', '4605-1547445930878.png', 'xaxass', 1),
(21, 123, '2321323', 'CIkampek', 'bchsbchdbkc', '', 'dferferfr', '2019-08-25', '2019-08-25', '345-1547445930878.png', 'vdfvfdv', 1),
(22, 1212212, '32323', 'Cikampek', 'sfwefwef', '', '121111', '2019-09-01', '2019-09-02', '', 'fwefwefe', 1),
(23, 22132312, '1122', 'vvdsd', 'vfvv', '', 'aeewqw', '2019-09-01', '2019-09-02', '', 'dcaddfadf', 1),
(24, 12232323, '323', 'CIkampek', 'efafwefwe', '', '121111', '2019-09-01', '2019-09-02', '', 'dsfsdfsdf', 1),
(25, 12121313, '111212', 'CIkampek', 'gsserer', '', 'aeewqw', '2019-08-14', '2019-09-06', '4226-1547445930878.png', 'erwerwer', 1),
(26, 121313, '121211212', 'CIkampek', 'dfsefwef', '', '121111', '2019-08-14', '2019-09-06', '6473-1547445930878.png', 'fsfwefrwe', 1),
(27, 1212121, '1212211312232', 'Cikampek', 'dfwefe', '', 'etrw3r23r3', '2019-08-22', '2019-09-06', '6712-1547445930878.png', 'dfsdfwef', 1),
(28, 1212121, '1212211312232655', 'Cikampek', 'dfwefe', '', 'etrw3r23r3', '2019-08-22', '2019-09-06', '9517-1547445930878.png', 'dfsdfwef', 1),
(29, 1212121, '1212211312232655777', 'Cikampek', 'dfwefe', '', 'etrw3r23r3', '2019-08-22', '2019-09-06', '2672-1547445930878.png', 'dfsdfwef', 1),
(30, 3235325, '121214444', 'CIkampek', 'ertrtert', '', 'qwqw11212', '2019-08-08', '2019-09-06', '4411-1547445930878.png', 'rtrt34t34', 1),
(31, 678676, '1212211312222', 'CIkampek', 'mknckdcndc', '', 'qwqw11212', '2019-08-25', '2019-09-06', '495-1547445930878.png', 'kncknd', 1),
(32, 12121213, '11121212', 'CIkampek', 'fvfvfv', '', 'aeewqw', '2019-08-22', '2019-09-06', '9073-1547445930878.png', 'dcsdcdsc', 1),
(33, 12121213, '11121212666', 'CIkampek', 'fvfvfv', '', 'aeewqw', '2019-08-22', '2019-09-06', '1477-1547445930878.png', 'dcsdcdsc', 1),
(34, 4523525, '1212211312444', 'Cikampek', 'gegege', '', 'ergergerg', '2019-08-08', '2019-09-06', '8642-1547445930878.png', 'rtgergerg', 1),
(43, 3243243, '4523523523', 'Cikampek', 'fgrsgrg', '', 'aeewqw', '2019-09-10', '2019-09-08', '8430-Foto Seluruh Badan1.jpg', 'rtgwrtrt', 1),
(44, 2312421, '3423ererwer', 'erwerwer', 'wererwerwer', '', 'wefewwef', '2019-09-17', '2019-09-11', '4492-SISTEM PEMBAYARAN PEMERIKSAAN KESEHATAN.docx', 'erwerwer', 1),
(45, 232312323, '3413434452452', 'Cikampek', 'dfgwegewg', '', 'aeewqw', '2019-09-20', '2019-09-13', '5102-DAFTAR HASIL STUDI 2.pdf', 'fgwgewg', 1),
(47, 23124422, '12121313', 'CIkampek', 'xcsasd', '', 'aeewqw', '2019-09-18', '2019-09-16', '9393-1547445930878.png', 'xczcC', 1),
(48, 1414134, '121213132222', 'CIkampek', 'wrtwrtr', '', 'srwrtwrt', '2019-09-18', '2019-09-16', '7256-1547445930878.png', 'wrtwtwrt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama`, `nip`, `admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '-', 1),
(2, 'disposisi', '13bb8b589473803f26a02e338f949b8c', 'Petugas Disposisi', '-', 3),
(3, 'admin1', '21232f297a57a5a743894a0e4a801fc3', 'Cahyadi', '-', 2),
(4, 'admin2', '21232f297a57a5a743894a0e4a801fc3', 'Cahyadi', '-', 2),
(5, 'zakaria', 'b1c21019afd435194216c87f414e6cce', 'kasir', '-', 2),
(6, 'admin5', 'b1c21019afd435194216c87f414e6cce', 'Cahyadi', '-', 2),
(7, 'username', '14c4b06b824ec593239362517f538b29', 'user', '123123', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jns_pembayaran`
--

CREATE TABLE `tb_jns_pembayaran` (
  `id_jns_pembayaran` int(11) NOT NULL,
  `jns_pembayaran` varchar(31) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jns_pembayaran`
--

INSERT INTO `tb_jns_pembayaran` (`id_jns_pembayaran`, `jns_pembayaran`) VALUES
(1, 'Tunai'),
(2, 'Cash Bertahap'),
(3, 'Angsuran Bulanan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sppjb`
--

CREATE TABLE `tb_sppjb` (
  `id_sppjb` int(11) NOT NULL,
  `tgl_sppjb` date NOT NULL,
  `nm_pembeli` varchar(31) NOT NULL,
  `tp_lahir` varchar(31) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `pekerjaan` varchar(31) NOT NULL,
  `alamat` varchar(31) NOT NULL,
  `no_ktp` varchar(31) NOT NULL,
  `id_jns_pembayaran` int(11) NOT NULL,
  `no_kavling` varchar(31) NOT NULL,
  `jalan` varchar(31) NOT NULL,
  `kelurahan` varchar(31) NOT NULL,
  `kecamatan` varchar(31) NOT NULL,
  `kota` varchar(31) NOT NULL,
  `propinsi` varchar(31) NOT NULL,
  `luas_tanah` varchar(31) NOT NULL,
  `utara` varchar(31) NOT NULL,
  `selatan` varchar(31) NOT NULL,
  `barat` varchar(31) NOT NULL,
  `timur` varchar(31) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sppjb`
--

INSERT INTO `tb_sppjb` (`id_sppjb`, `tgl_sppjb`, `nm_pembeli`, `tp_lahir`, `tgl_lahir`, `pekerjaan`, `alamat`, `no_ktp`, `id_jns_pembayaran`, `no_kavling`, `jalan`, `kelurahan`, `kecamatan`, `kota`, `propinsi`, `luas_tanah`, `utara`, `selatan`, `barat`, `timur`) VALUES
(1, '2018-05-17', 'Yefrizal', 'Jambi', '1974-02-27', 'PNS', 'JL. Dewi 3 No. 3', '1471102702740001', 2, 'F.1 dan F.2 (Lihat Site Plan)', 'JL. Palembang', 'Sialang Rampai', 'Tenayan Raya', 'Pekanbaru', 'Riau', '260 (m2)', '20 M', '19 M', '14 M', '13 M'),
(2, '2018-05-22', 'Jundi', 'Pekanbaru', '2018-05-22', 'PNS', 'JL.HT', '08765434567876543', 1, 'a1 a3', 'JL. Tamrin', 'Rejosari', 'Tenayan Raya', 'Pekanbaru', 'Riau', '123', '45', '12', '11', '19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `image`) VALUES
(18, 'Joseph', 'Harman', '1.jpg'),
(19, 'John', 'Moss', '4.jpg'),
(20, 'Lillie', 'Ferrarium', '3.jpg'),
(21, 'Yolanda', 'Green', '5.jpg'),
(22, 'Cara', 'Gariepy', '7.jpg'),
(23, 'Christine', 'Johnson', '11.jpg'),
(24, 'Alana', 'Decruze', '12.jpg'),
(25, 'Krista', 'Correa', '13.jpg'),
(26, 'Charles', 'Martin', '14.jpg'),
(70, 'Cindy', 'Canady', '18211.jpg'),
(73, 'Daphne', 'Frost', '8288.jpg'),
(69, 'Frank', 'Lemons', '22610.jpg'),
(66, 'Margaret', 'Ault', '14365.jpg'),
(71, 'Christina', 'Wilke', '9248.jpg'),
(68, 'Roy', 'Newton', '27282.jpg'),
(74, 'dcdcd', 'dcdcd', '1649141237.png'),
(75, 'dcdcd', 'dcdcd', '1339944295.png'),
(76, 'dcdcddddd', 'cccc', '91018005.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  ADD PRIMARY KEY (`id_disposisi`);

--
-- Indexes for table `tbl_instansi`
--
ALTER TABLE `tbl_instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indexes for table `tbl_klasifikasi`
--
ALTER TABLE `tbl_klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indexes for table `tbl_sett`
--
ALTER TABLE `tbl_sett`
  ADD PRIMARY KEY (`id_sett`);

--
-- Indexes for table `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_jns_pembayaran`
--
ALTER TABLE `tb_jns_pembayaran`
  ADD PRIMARY KEY (`id_jns_pembayaran`);

--
-- Indexes for table `tb_sppjb`
--
ALTER TABLE `tb_sppjb`
  ADD PRIMARY KEY (`id_sppjb`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  MODIFY `id_disposisi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_klasifikasi`
--
ALTER TABLE `tbl_klasifikasi`
  MODIFY `id_klasifikasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
  MODIFY `id_surat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  MODIFY `id_surat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_jns_pembayaran`
--
ALTER TABLE `tb_jns_pembayaran`
  MODIFY `id_jns_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_sppjb`
--
ALTER TABLE `tb_sppjb`
  MODIFY `id_sppjb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
