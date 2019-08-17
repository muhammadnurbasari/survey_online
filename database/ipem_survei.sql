-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2019 at 08:22 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipem_survei`
--

-- --------------------------------------------------------

--
-- Table structure for table `angket`
--

CREATE TABLE `angket` (
  `id_angket` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `judul` varchar(80) NOT NULL,
  `share` varchar(15) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angket`
--

INSERT INTO `angket` (`id_angket`, `tanggal`, `judul`, `share`, `is_active`, `publish`, `created_by`, `update_by`) VALUES
(2, '2019-08-03', 'Fasilitas Laboratorium komputer Insan Pembangunan', 'Public', 1, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `angket_detail_interval`
--

CREATE TABLE `angket_detail_interval` (
  `id_interval` int(11) NOT NULL,
  `nama_interval` varchar(25) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angket_detail_interval`
--

INSERT INTO `angket_detail_interval` (`id_interval`, `nama_interval`, `id_pertanyaan`) VALUES
(1, 'sangat buruk', 1),
(2, 'buruk', 1),
(3, 'cukup baik', 1),
(4, 'baik', 1),
(5, 'sangat baik', 1),
(6, 'sangat buruk', 2),
(7, 'buruk', 2),
(8, 'cukup baik', 2),
(9, 'baik', 2),
(10, 'sangat baik', 2),
(11, 'sangat buruk', 3),
(12, 'buruk', 3),
(13, 'cukup baik', 3),
(14, 'baik', 3),
(15, 'sangat baik', 3),
(16, 'sangat buruk', 4),
(17, 'buruk', 4),
(18, 'cukup baik', 4),
(19, 'baik', 4),
(20, 'sangat baik', 4);

-- --------------------------------------------------------

--
-- Table structure for table `angket_detail_pertanyaan`
--

CREATE TABLE `angket_detail_pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `pertanyaan` varchar(128) NOT NULL,
  `id_angket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angket_detail_pertanyaan`
--

INSERT INTO `angket_detail_pertanyaan` (`id_pertanyaan`, `pertanyaan`, `id_angket`) VALUES
(1, 'Tata letak meja dan kursi ?', 2),
(2, 'tata letak proyektor ?', 2),
(3, 'kinerja komputer ?', 2),
(4, 'instalasi listrik ( kabel ) ?', 2);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_ptk` int(11) NOT NULL,
  `id_ikatan_kerja` char(1) NOT NULL,
  `nm_ptk` varchar(50) NOT NULL,
  `nidn` char(10) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `jk` char(1) NOT NULL,
  `tmpt_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nik` char(16) NOT NULL,
  `niy_nigk` varchar(30) NOT NULL,
  `nuptk` char(16) NOT NULL,
  `id_stat_pegawai` smallint(16) NOT NULL,
  `id_jns_ptk` smallint(6) NOT NULL,
  `id_bid_pengawas` int(11) NOT NULL,
  `id_agama` smallint(16) NOT NULL,
  `jln` varchar(80) NOT NULL,
  `rt` tinyint(2) NOT NULL,
  `rw` tinyint(2) NOT NULL,
  `nm_dsn` varchar(40) NOT NULL,
  `ds_kel` varchar(40) NOT NULL,
  `id_wil` char(15) NOT NULL,
  `kode_pos` char(6) NOT NULL,
  `no_tel_rmh` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `id_stat_aktif` smallint(2) NOT NULL,
  `sk_cpns` varchar(40) NOT NULL,
  `tgl_sk_cpns` date NOT NULL,
  `sk_angkat` varchar(40) NOT NULL,
  `tmt_sk_angkat` date NOT NULL,
  `id_lemb_angkat` smallint(2) NOT NULL,
  `id_pangkat_gol` smallint(2) NOT NULL,
  `id_keahlian_lab` smallint(6) NOT NULL,
  `id_sumber_gaji` smallint(2) NOT NULL,
  `nm_ibu_kandung` varchar(50) NOT NULL,
  `stat_kawin` tinyint(4) NOT NULL,
  `nm_suami_istri` varchar(50) NOT NULL,
  `nip_suami_istri` char(18) NOT NULL,
  `id_pekerjaan_suami_istri` int(11) NOT NULL,
  `tmt_pns` date NOT NULL,
  `a_lisensi_kepsek` tinyint(4) NOT NULL,
  `jml_sekolah_binaan` smallint(6) NOT NULL,
  `a_diklat_awas` tinyint(4) NOT NULL,
  `akta_ijin_ajar` char(1) NOT NULL,
  `nira` char(30) NOT NULL,
  `stat_data` int(11) NOT NULL,
  `mampu_handle_kk` int(11) NOT NULL,
  `a_braille` tinyint(4) NOT NULL,
  `a_bhs_isyarat` tinyint(4) NOT NULL,
  `npwp` char(15) NOT NULL,
  `kewarganegaraan` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_ptk`, `id_ikatan_kerja`, `nm_ptk`, `nidn`, `nip`, `jk`, `tmpt_lahir`, `tgl_lahir`, `nik`, `niy_nigk`, `nuptk`, `id_stat_pegawai`, `id_jns_ptk`, `id_bid_pengawas`, `id_agama`, `jln`, `rt`, `rw`, `nm_dsn`, `ds_kel`, `id_wil`, `kode_pos`, `no_tel_rmh`, `no_hp`, `email`, `id_sp`, `id_stat_aktif`, `sk_cpns`, `tgl_sk_cpns`, `sk_angkat`, `tmt_sk_angkat`, `id_lemb_angkat`, `id_pangkat_gol`, `id_keahlian_lab`, `id_sumber_gaji`, `nm_ibu_kandung`, `stat_kawin`, `nm_suami_istri`, `nip_suami_istri`, `id_pekerjaan_suami_istri`, `tmt_pns`, `a_lisensi_kepsek`, `jml_sekolah_binaan`, `a_diklat_awas`, `akta_ijin_ajar`, `nira`, `stat_data`, `mampu_handle_kk`, `a_braille`, `a_bhs_isyarat`, `npwp`, `kewarganegaraan`) VALUES
(1, '', 'nyoman', '1020304050', '', '', '', '0000-00-00', '', '', '', 0, 0, 0, 0, '', 0, 0, '', '', '', '', '', '', 'nyoman@gmail.com', 0, 0, '', '0000-00-00', '', '0000-00-00', 0, 0, 0, 0, '', 0, '', '', 0, '0000-00-00', 0, 0, 0, '', '', 0, 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dosen_pt`
--

CREATE TABLE `dosen_pt` (
  `id_reg_ptk` int(11) NOT NULL,
  `id_ptk` int(11) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `id_thn_ajaran` int(11) NOT NULL,
  `id_sms` int(11) NOT NULL,
  `no_srt_tgs` varchar(20) NOT NULL,
  `tgl_srt_tgs` date NOT NULL,
  `tmt_srt_tgs` date NOT NULL,
  `a_sp_homebase` tinyint(4) NOT NULL,
  `a_aktif_bln_1` tinyint(4) NOT NULL,
  `a_aktif_bln_2` tinyint(4) NOT NULL,
  `a_aktif_bln_3` tinyint(4) NOT NULL,
  `a_aktif_bln_4` tinyint(4) NOT NULL,
  `a_aktif_bln_5` tinyint(4) NOT NULL,
  `a_aktif_bln_6` tinyint(4) NOT NULL,
  `a_aktif_bln_7` tinyint(4) NOT NULL,
  `a_aktif_bln_8` tinyint(4) NOT NULL,
  `a_aktif_bln_9` tinyint(4) NOT NULL,
  `a_aktif_bln_10` tinyint(4) NOT NULL,
  `a_aktif_bln_11` tinyint(4) NOT NULL,
  `a_aktif_bln_12` tinyint(4) NOT NULL,
  `id_jns_keluar` char(1) NOT NULL,
  `tgl_ptk_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_surveyor` int(11) DEFAULT NULL,
  `id_responden_mhs` int(11) DEFAULT NULL,
  `id_responden_dosen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `email`, `password`, `id_surveyor`, `id_responden_mhs`, `id_responden_dosen`) VALUES
(3, 'm.nurbasari@gmail.com', '$2y$10$oH/JzB6zyTvNnue.KTubYO8uIKwe1VbpCDMXHzA2Bt.3aMlWF3DWO', 2, NULL, NULL),
(5, 'mae1996lani@gmail.com', '$2y$10$mfNcMOutxDQ72nm0Kol4a.vUSj9FvJ07sp/Wj85OcREVrd1IkpZgS', 3, NULL, NULL),
(8, 'nyoman@gmail.com', '$2y$10$5WFft1.EPCuSub3KyyXqf.bOGlvdZBXTAMbSCMN772cQcRRZQoK8q', NULL, NULL, 1),
(9, 'bayu@gmail.com', '$2y$10$PQbdWE.QaKfONAdwFA9/s.Pa4bP.SvG5C.hWzFQ8H7gxvjOm2yO9O', NULL, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_pd` int(11) NOT NULL,
  `nm_pd` varchar(50) NOT NULL,
  `jk` char(1) NOT NULL,
  `nisn` char(10) NOT NULL,
  `nik` char(16) NOT NULL,
  `tmpt_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `id_agama` smallint(11) NOT NULL,
  `id_kk` int(11) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `jln` varchar(80) NOT NULL,
  `rt` smallint(11) NOT NULL,
  `rw` smallint(11) NOT NULL,
  `nm_dsn` varchar(40) NOT NULL,
  `ds_kel` varchar(40) NOT NULL,
  `id_wil` char(8) NOT NULL,
  `kode_pos` char(5) NOT NULL,
  `id_jns_tinggal` smallint(11) NOT NULL,
  `id_alat_transport` smallint(11) NOT NULL,
  `telepon_rumah` varchar(20) NOT NULL,
  `telepon_seluler` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `a_terima_kps` tinyint(4) NOT NULL,
  `no_kps` varchar(40) NOT NULL,
  `stat_pd` char(1) NOT NULL,
  `nm_ayah` varchar(50) NOT NULL,
  `tgl_lahir_ayah` date NOT NULL,
  `id_jenjang_pendidikan_ayah` smallint(6) NOT NULL,
  `id_pekerjaan_ayah` int(11) NOT NULL,
  `id_penghasilan_ayah` int(11) NOT NULL,
  `id_kebutuhan_khusus_ayah` int(11) NOT NULL,
  `nm_ibu_kandung` varchar(50) NOT NULL,
  `tgl_lahir_ibu` date NOT NULL,
  `id_jenjang_pendidikan_ibu` smallint(6) NOT NULL,
  `id_penghasilan_ibu` int(11) NOT NULL,
  `id_pekerjaan_ibu` int(11) NOT NULL,
  `id_kebutuhan_khusus_ibu` int(11) NOT NULL,
  `nm_wali` varchar(30) NOT NULL,
  `tgl_lahir_wali` date NOT NULL,
  `id_jenjang_pendidikan_wali` smallint(6) NOT NULL,
  `id_pekerjaan_wali` int(11) NOT NULL,
  `id_penghasilan_wali` int(11) NOT NULL,
  `kewarganegaraan` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_pd`, `nm_pd`, `jk`, `nisn`, `nik`, `tmpt_lahir`, `tgl_lahir`, `id_agama`, `id_kk`, `id_sp`, `jln`, `rt`, `rw`, `nm_dsn`, `ds_kel`, `id_wil`, `kode_pos`, `id_jns_tinggal`, `id_alat_transport`, `telepon_rumah`, `telepon_seluler`, `email`, `a_terima_kps`, `no_kps`, `stat_pd`, `nm_ayah`, `tgl_lahir_ayah`, `id_jenjang_pendidikan_ayah`, `id_pekerjaan_ayah`, `id_penghasilan_ayah`, `id_kebutuhan_khusus_ayah`, `nm_ibu_kandung`, `tgl_lahir_ibu`, `id_jenjang_pendidikan_ibu`, `id_penghasilan_ibu`, `id_pekerjaan_ibu`, `id_kebutuhan_khusus_ibu`, `nm_wali`, `tgl_lahir_wali`, `id_jenjang_pendidikan_wali`, `id_pekerjaan_wali`, `id_penghasilan_wali`, `kewarganegaraan`) VALUES
(1, 'abas', '', '', '', '', '0000-00-00', 0, 0, 0, '', 0, 0, '', '', '', '', 0, 0, '', '', 'abas@gmail.com', 0, '', '', '', '0000-00-00', 0, 0, 0, 0, '', '0000-00-00', 0, 0, 0, 0, '', '0000-00-00', 0, 0, 0, ''),
(2, 'agus', '', '', '', '', '0000-00-00', 0, 0, 0, '', 0, 0, '', '', '', '', 0, 0, '', '', 'agus@gmail.com', 0, '', '', '', '0000-00-00', 0, 0, 0, 0, '', '0000-00-00', 0, 0, 0, 0, '', '0000-00-00', 0, 0, 0, ''),
(3, 'bayu pradana', '', '', '', '', '0000-00-00', 0, 0, 0, '', 0, 0, '', '', '', '', 0, 0, '', '', 'bayu@gmail.com', 0, '', '', '', '0000-00-00', 0, 0, 0, 0, '', '0000-00-00', 0, 0, 0, 0, '', '0000-00-00', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_pt`
--

CREATE TABLE `mahasiswa_pt` (
  `id_reg_pd` int(11) NOT NULL,
  `id_sms` int(11) NOT NULL,
  `id_pd` int(11) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `id_jns_daftar` tinyint(4) NOT NULL,
  `nipd` varchar(18) NOT NULL,
  `tgl_masuk_sp` date NOT NULL,
  `id_jns_keluar` char(1) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `ket` varchar(128) NOT NULL,
  `skhun` char(20) NOT NULL,
  `a_pernah_paud` tinyint(4) NOT NULL,
  `a_pernah_tk` tinyint(4) NOT NULL,
  `mulai_smt` varchar(5) NOT NULL,
  `sks_diakui` tinyint(4) NOT NULL,
  `jalur_skripsi` tinyint(4) NOT NULL,
  `judul_skripsi` varchar(250) NOT NULL,
  `bln_awal_bimbingan` date NOT NULL,
  `bln_akhir_bimbingan` date NOT NULL,
  `sk_yudisium` varchar(30) NOT NULL,
  `tgl_sk_yudisium` date NOT NULL,
  `ipk` float NOT NULL,
  `no_seri_ijazah` varchar(40) NOT NULL,
  `sert_prof` varchar(40) NOT NULL,
  `a_pindah_mhs_asing` tinyint(4) NOT NULL,
  `nm_pt_asal` varchar(50) NOT NULL,
  `nm_prodi_asal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa_pt`
--

INSERT INTO `mahasiswa_pt` (`id_reg_pd`, `id_sms`, `id_pd`, `id_sp`, `id_jns_daftar`, `nipd`, `tgl_masuk_sp`, `id_jns_keluar`, `tgl_keluar`, `ket`, `skhun`, `a_pernah_paud`, `a_pernah_tk`, `mulai_smt`, `sks_diakui`, `jalur_skripsi`, `judul_skripsi`, `bln_awal_bimbingan`, `bln_akhir_bimbingan`, `sk_yudisium`, `tgl_sk_yudisium`, `ipk`, `no_seri_ijazah`, `sert_prof`, `a_pindah_mhs_asing`, `nm_pt_asal`, `nm_prodi_asal`) VALUES
(1, 1, 1, 1, 1, '2015804244', '0000-00-00', '', '0000-00-00', '', '', 0, 0, '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0000-00-00', 0, '', '', 0, '', ''),
(2, 2, 2, 2, 0, '2015804255', '0000-00-00', '', '0000-00-00', '', '', 0, 0, '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0000-00-00', 0, '', '', 0, '', ''),
(3, 3, 3, 0, 0, '2015804266', '0000-00-00', '', '0000-00-00', '', '', 0, 0, '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0000-00-00', 0, '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_angket` int(11) NOT NULL,
  `id_responden_dosen` varchar(10) DEFAULT NULL,
  `id_responden_mhs` varchar(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_angket`, `id_responden_dosen`, `id_responden_mhs`) VALUES
(1, 2, NULL, '2015804244'),
(2, 2, NULL, '2015804255'),
(3, 2, '1020304050', NULL),
(4, 2, NULL, '2015804266');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_detail`
--

CREATE TABLE `nilai_detail` (
  `id_nilai_detail` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `id_nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_detail`
--

INSERT INTO `nilai_detail` (`id_nilai_detail`, `nilai`, `id_nilai`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 1),
(4, 3, 1),
(5, 4, 2),
(6, 5, 2),
(7, 5, 2),
(8, 4, 2),
(9, 5, 3),
(10, 4, 3),
(11, 4, 3),
(12, 5, 3),
(13, 4, 4),
(14, 5, 4),
(15, 4, 4),
(16, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `surveyor`
--

CREATE TABLE `surveyor` (
  `surveyor_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surveyor`
--

INSERT INTO `surveyor` (`surveyor_id`, `name`, `password`, `email`, `image`, `role_id`, `created_date`, `is_active`) VALUES
(2, 'muhammad nur basari', '$2y$10$s742aGZ4PT6KzCh/zmOk7OsKwL6eu9e1fkRSw9BU0jLfnoRG77.Yy', 'm.nurbasari@gmail.com', 'IMG_20190801_171252.jpg', 1, '2019-07-17', 1),
(3, 'Diah Maelani', '$2y$10$UvTqcpdRzBJxjMUMu8S3s.q8.3rSnUYLinmQH6.tP7Sd/yY5dV3We', 'mae1996lani@gmail.com', 'PhotoGrid_1463199691925.jpg', 2, '2019-07-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `surveyor_role`
--

CREATE TABLE `surveyor_role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surveyor_role`
--

INSERT INTO `surveyor_role` (`role_id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Surveyor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angket`
--
ALTER TABLE `angket`
  ADD PRIMARY KEY (`id_angket`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `angket_detail_interval`
--
ALTER TABLE `angket_detail_interval`
  ADD PRIMARY KEY (`id_interval`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indexes for table `angket_detail_pertanyaan`
--
ALTER TABLE `angket_detail_pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_angket` (`id_angket`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_ptk`),
  ADD UNIQUE KEY `nidn` (`nidn`);

--
-- Indexes for table `dosen_pt`
--
ALTER TABLE `dosen_pt`
  ADD PRIMARY KEY (`id_reg_ptk`),
  ADD KEY `id_ptk` (`id_ptk`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_pd`);

--
-- Indexes for table `mahasiswa_pt`
--
ALTER TABLE `mahasiswa_pt`
  ADD PRIMARY KEY (`id_reg_pd`),
  ADD UNIQUE KEY `nipd` (`nipd`),
  ADD KEY `id_pd` (`id_pd`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_angket` (`id_angket`),
  ADD KEY `id_responden_dosen` (`id_responden_dosen`),
  ADD KEY `id_responden_mhs` (`id_responden_mhs`);

--
-- Indexes for table `nilai_detail`
--
ALTER TABLE `nilai_detail`
  ADD PRIMARY KEY (`id_nilai_detail`),
  ADD KEY `id_nilai` (`id_nilai`);

--
-- Indexes for table `surveyor`
--
ALTER TABLE `surveyor`
  ADD PRIMARY KEY (`surveyor_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `surveyor_role`
--
ALTER TABLE `surveyor_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angket`
--
ALTER TABLE `angket`
  MODIFY `id_angket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `angket_detail_interval`
--
ALTER TABLE `angket_detail_interval`
  MODIFY `id_interval` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `angket_detail_pertanyaan`
--
ALTER TABLE `angket_detail_pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dosen_pt`
--
ALTER TABLE `dosen_pt`
  MODIFY `id_reg_ptk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `nilai_detail`
--
ALTER TABLE `nilai_detail`
  MODIFY `id_nilai_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `surveyor`
--
ALTER TABLE `surveyor`
  MODIFY `surveyor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `surveyor_role`
--
ALTER TABLE `surveyor_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `angket`
--
ALTER TABLE `angket`
  ADD CONSTRAINT `angket_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `surveyor` (`surveyor_id`);

--
-- Constraints for table `angket_detail_interval`
--
ALTER TABLE `angket_detail_interval`
  ADD CONSTRAINT `angket_detail_interval_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `angket_detail_pertanyaan` (`id_pertanyaan`);

--
-- Constraints for table `angket_detail_pertanyaan`
--
ALTER TABLE `angket_detail_pertanyaan`
  ADD CONSTRAINT `angket_detail_pertanyaan_ibfk_1` FOREIGN KEY (`id_angket`) REFERENCES `angket` (`id_angket`);

--
-- Constraints for table `dosen_pt`
--
ALTER TABLE `dosen_pt`
  ADD CONSTRAINT `dosen_pt_ibfk_1` FOREIGN KEY (`id_ptk`) REFERENCES `dosen` (`id_ptk`);

--
-- Constraints for table `mahasiswa_pt`
--
ALTER TABLE `mahasiswa_pt`
  ADD CONSTRAINT `mahasiswa_pt_ibfk_1` FOREIGN KEY (`id_pd`) REFERENCES `mahasiswa` (`id_pd`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_responden_dosen`) REFERENCES `dosen` (`nidn`),
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_responden_mhs`) REFERENCES `mahasiswa_pt` (`nipd`),
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`id_angket`) REFERENCES `angket` (`id_angket`);

--
-- Constraints for table `nilai_detail`
--
ALTER TABLE `nilai_detail`
  ADD CONSTRAINT `nilai_detail_ibfk_1` FOREIGN KEY (`id_nilai`) REFERENCES `nilai` (`id_nilai`);

--
-- Constraints for table `surveyor`
--
ALTER TABLE `surveyor`
  ADD CONSTRAINT `surveyor_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `surveyor_role` (`role_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
