-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 08:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `abs`
--

CREATE TABLE `abs` (
  `abs_id` int(11) NOT NULL,
  `abs_bln` varchar(20) NOT NULL,
  `abs_bl` varchar(5) NOT NULL,
  `abs_th` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `absensi_id` int(11) NOT NULL,
  `abs_id` int(11) NOT NULL,
  `karyawan_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `absensi_h` int(11) NOT NULL,
  `absensi_s` int(11) NOT NULL,
  `absensi_i` int(11) NOT NULL,
  `absensi_a` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_adm` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto_adm` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_adm`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `foto_adm`) VALUES
(1, 'superadmin', '21232f297a57a5a743894a0e4a801fc3', 'super admin', 'superadmin@admin.com', '0123456789', 'indah_jkt48.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `akun_kode` varchar(20) NOT NULL,
  `akun_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`akun_kode`, `akun_nama`) VALUES
('1-1100', 'CASH IN BANK'),
('1-1200', 'PETTY CASH'),
('1-1300', 'ACCOUNT RECEIVABLE'),
('1-1400', 'ALLOWANCE FOR DUBTFUL DEBT'),
('1-1500', 'MERCHANDISE INVENTORY'),
('1-1600', 'STORE SUPPLIES'),
('1-1700', 'PREPAID INSURANCE'),
('1-1800', 'PREPAID RENT'),
('1-1900', 'PREPAID TAX'),
('1-1911', 'PREPAID ADVERTISING'),
('1-1912', 'PREPAID EXPENSE'),
('1-1913', 'PPN INCOME'),
('1-1914', 'PREPAID PPN'),
('1-1915', 'FURNITUR AND FIXTURE'),
('1-1916', 'LINTEREST RECEIVABLE'),
('1-1917', 'NOTES RECEIVABLE'),
('1-1918', 'MARKETABLE SECURITIES'),
('1-1919', 'SUPPLIES'),
('1-1920', 'OFFICE SUPPLIES'),
('1-2100', 'LONG TERN INVESTMENT'),
('1-2110', 'INVESTMENT IN BOND'),
('1-2120', 'INVESTMENT IN COMMON STOCK'),
('1-2130', 'TEMPORARY INVESTMENT'),
('1-2200', 'EQUIPMENT AT COST'),
('1-2300', 'EQUIPMENT ACCUM DEP'),
('1-2400', 'STORE EQUIPMENT'),
('1-2500', 'STORE EQUIPMENT ACCUM DEP'),
('1-2600', 'OFFICE EQUIPMENT'),
('1-2700', 'OFFICE EQUIPMENT ACCUM DEP'),
('1-2800', 'BUILDING'),
('1-2810', 'BUILDING ACCUM DEP'),
('1-2820', 'LAND'),
('1-2830', 'LAND ACCUM DEP'),
('1-2900', 'MACHINE'),
('1-2910', 'MACHINE ACCUM DEP'),
('1-2920', 'MOTOR VEHICLE'),
('1-2930', 'MOTOR VEHICLE ACCUM DEP'),
('1-2940', 'VAT IN (PPN INCOME)'),
('1-3100', 'GOODWILL'),
('1-3200', 'FRANCHISE'),
('1-3400', 'LEASING'),
('2-1100', 'ACCOUNT PAYABLE'),
('2-1200', 'EXPENSE PAYABLE'),
('2-1300', 'INCOME TAX PAYABLE'),
('2-1400', 'PPN PAYABLE'),
('2-1500', 'PPN OUTCOME (VAT OUT)'),
('2-1600', 'DIVIDEND PAYABLE'),
('2-1700', 'BANK PAYABLE'),
('2-1800', 'INTEREST PAYABLE'),
('2-1900', 'NOTES PAYABLE'),
('2-1910', 'SALARIES PAYABLE'),
('2-1920', 'TAX PAYABLE'),
('2-1930', 'ACCRUED EXPENSE'),
('2-1940', 'UNEARNED RENT'),
('2-1950', 'UNEARNED REVENUE'),
('2-2100', 'BANK BCA LOAN'),
('2-2200', 'BOND PAYABLE'),
('2-2300', 'MORTGAGE PAYABLE'),
('3-1100', 'PAID UP CAPITAL'),
('3-1200', 'CAPITAL STOCK'),
('3-1300', 'DEVIDEND'),
('3-1400', 'PRIVE'),
('3-1500', 'INCOME SUMMARY'),
('3-1600', 'COMMON STOCK'),
('3-1700', 'PREFERRED STOCK'),
('3-1800', 'RETAINED EARNING'),
('4-1100', 'SALES'),
('4-1200', 'SALES RETURN'),
('4-1300', 'SALES RETURN AND ALLOWANCES'),
('4-1400', 'SALES DISCOUNT'),
('4-1500', 'COMMOSION INCOME'),
('4-1600', 'CONSIGNMENT INCOME'),
('4-1700', 'FARE INCOME'),
('4-1800', 'FEES EARNED'),
('4-1900', 'INCOME FROM JOINT VENTURE'),
('4-1910', 'INTEREST INCOME'),
('4-1920', 'OTHER INCOME'),
('4-1930', 'RECOVERY INCOME'),
('4-1940', 'RENT INCOME'),
('4-1950', 'PURCHASE'),
('4-1960', 'PURCHASE RETURN'),
('4-1970', 'PURCHASE DISCOUNT'),
('5-1100', 'COST OF GOOD SOLD'),
('5-1200', 'FREIGHT PAID / FREIGHT IN'),
('5-2100', 'ADVERTISING EXPENSE'),
('5-2200', 'TELEPHONE AND ELECTRIC EXPENSE'),
('5-2400', 'STORE SUPPLIES EXPENSE'),
('5-2500', 'BAD DEBT EXPENSE'),
('5-2600', 'DEPRECIATION EXPENSE'),
('5-2700', 'INSUANCE EXPENSE'),
('5-2710', 'RENT EXPENSE'),
('5-2800', 'WAGES AND SALARIES EXPENSE'),
('5-2810', 'OTHER OPERATING EXPENSE'),
('5-2820', 'OFFICE SALARIES EXPENSE'),
('5-2830', 'STORE SALERIES EXPENSE'),
('5-2840', 'SALESMEN SALESRIES EXPENSE'),
('5-2850', 'SUPPLIES EXPENSE'),
('5-2860', 'OFFICE SUPPLIES EXPENSE'),
('5-2870', 'ADMINISTRATIVE EXPENSE'),
('5-2880', 'MISCELANIOUS EXPENSE'),
('5-2890', 'MOTOR VEHICLE EXPENSE'),
('5-2900', 'UTILITIES EXPENSE'),
('5-2910', 'DEPRECIATION EXP OF BUILDING'),
('5-2920', 'DEPRECIATION EXP OF EQUIPMENT'),
('5-2930', 'DEPRECIATION EXP OF FURNITURE AND FIXTURE'),
('5-2940', 'DEPRECIATION EXP OF MACHINE'),
('5-2950', 'DEPRECIATION EXP OF MOTOR VEHICLE'),
('5-2960', 'DEPRECIATION EXP OF OFFICE EQUIPMENT'),
('5-2970', 'DEPRECIATION EXP OF STORE EQUIPMENT'),
('5-2980', 'FREIGHT OUT'),
('5-3100', 'INTEREST REVENUE'),
('5-3200', 'INTEREST EXPENSE'),
('5-3300', 'BANK SERVICE CHARGE'),
('5-3910', 'INCOME TAX EXPENSE');

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE `bagian` (
  `bagian_id` varchar(6) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `bagian_nama` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `bagian_gaji` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `bagian_lembur` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`bagian_id`, `bagian_nama`, `bagian_gaji`, `bagian_lembur`) VALUES
('BGN001', 'Cleaning Service', '2700000', '25000'),
('BGN002', 'Karyawan', '3500000', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `direktur`
--

CREATE TABLE `direktur` (
  `id_dir` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto_dir` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `direktur`
--

INSERT INTO `direktur` (`id_dir`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `foto_dir`) VALUES
(1, 'direktur', '4fbfd324f5ffcdff5dbf6f019b02eca8', 'direktur admin', 'direktur@admin.com', '0123456789', 'user_logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `gaji_karyawan`
--

CREATE TABLE `gaji_karyawan` (
  `gaj_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `karyawan_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `abs_id` int(11) NOT NULL,
  `gaj_lembur` int(11) NOT NULL,
  `gaj_tjg` int(11) NOT NULL,
  `gaj_pot` int(11) NOT NULL,
  `gaj_stt` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `gaj_pok` int(11) NOT NULL,
  `gaj_bersih` int(11) NOT NULL,
  `gaj_pay` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `gaj_tgl` date NOT NULL,
  `gaj_ket` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `jurnal_trx` varchar(8) NOT NULL,
  `jurnal_reff` varchar(50) NOT NULL,
  `akun_kode` varchar(20) NOT NULL,
  `jurnal_tgl` date NOT NULL,
  `jurnal_jml` int(11) NOT NULL,
  `jurnal_ket` text NOT NULL,
  `jurnal_bl` varchar(5) NOT NULL,
  `jurnal_th` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `karyawan_id` varchar(20) NOT NULL,
  `karyawan_nama` varchar(100) NOT NULL,
  `karyawan_jk` enum('Laki-Laki','Perempuan') NOT NULL,
  `karyawan_alamat` text NOT NULL,
  `karyawan_telp` varchar(20) NOT NULL,
  `karyawan_tgllhr` date NOT NULL,
  `karyawan_tptlhr` varchar(100) NOT NULL,
  `karyawan_foto` text NOT NULL,
  `karyawan_masuk` date NOT NULL,
  `bagian_id` varchar(6) NOT NULL,
  `karyawan_status` enum('Aktif','Nonaktif') NOT NULL,
  `karyawan_create` date NOT NULL,
  `karyawan_pass` text NOT NULL,
  `id_adm` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lembur`
--

CREATE TABLE `lembur` (
  `lembur_id` int(11) NOT NULL,
  `lembur_tgl` date NOT NULL,
  `lembur_jam` double(2,1) NOT NULL,
  `karyawan_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `lembur_mulai` time NOT NULL,
  `lembur_selesai` time NOT NULL,
  `lembur_bl` varchar(5) NOT NULL,
  `lembur_th` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id_mng` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto_mng` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id_mng`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `foto_mng`) VALUES
(1, 'manager', '1d0258c2440a8d19e716292b231e3190', 'manager admin', 'manager@admin.com', '0123456789', 'user_logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `potongan`
--

CREATE TABLE `potongan` (
  `pot_id` int(11) NOT NULL,
  `karyawan_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `pot_tgl` date NOT NULL,
  `pot_jml` int(11) NOT NULL,
  `pot_ket` text NOT NULL,
  `pot_bl` varchar(5) NOT NULL,
  `pot_th` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `nama_website` varchar(100) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `status_website` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `nama_website`, `nama_pemilik`, `status_website`) VALUES
(1, 'Aplikasi Penggajian Karyawan', 'IkoAlmasDevGame', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tunjangan`
--

CREATE TABLE `tunjangan` (
  `tjg_id` int(11) NOT NULL,
  `karyawan_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tjg_tgl` date NOT NULL,
  `tjg_jml` int(11) NOT NULL,
  `tjg_ket` text NOT NULL,
  `tjg_bl` varchar(5) NOT NULL,
  `tjg_th` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `karyawan_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `user_akses` varchar(20) NOT NULL,
  `user_stt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abs`
--
ALTER TABLE `abs`
  ADD PRIMARY KEY (`abs_id`);

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`absensi_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_adm`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`akun_kode`);

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`bagian_id`);

--
-- Indexes for table `direktur`
--
ALTER TABLE `direktur`
  ADD PRIMARY KEY (`id_dir`);

--
-- Indexes for table `gaji_karyawan`
--
ALTER TABLE `gaji_karyawan`
  ADD PRIMARY KEY (`gaj_no`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`jurnal_trx`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`karyawan_id`);

--
-- Indexes for table `lembur`
--
ALTER TABLE `lembur`
  ADD PRIMARY KEY (`lembur_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id_mng`);

--
-- Indexes for table `potongan`
--
ALTER TABLE `potongan`
  ADD PRIMARY KEY (`pot_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tunjangan`
--
ALTER TABLE `tunjangan`
  ADD PRIMARY KEY (`tjg_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abs`
--
ALTER TABLE `abs`
  MODIFY `abs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `absensi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `direktur`
--
ALTER TABLE `direktur`
  MODIFY `id_dir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lembur`
--
ALTER TABLE `lembur`
  MODIFY `lembur_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id_mng` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `potongan`
--
ALTER TABLE `potongan`
  MODIFY `pot_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tunjangan`
--
ALTER TABLE `tunjangan`
  MODIFY `tjg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
