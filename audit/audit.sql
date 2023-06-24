-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2023 at 11:00 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `audit`
--

-- --------------------------------------------------------

--
-- Table structure for table `auditplan`
--

CREATE TABLE `auditplan` (
  `kode` int(11) NOT NULL,
  `perusahaan` varchar(100) NOT NULL,
  `auditjob` varchar(100) NOT NULL,
  `auditor` varchar(50) NOT NULL,
  `startdate` date NOT NULL,
  `budget` int(11) NOT NULL,
  `actual` int(11) NOT NULL,
  `targetdate` date NOT NULL,
  `status` enum('Plan','Running','Done') NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auditplan`
--

INSERT INTO `auditplan` (`kode`, `perusahaan`, `auditjob`, `auditor`, `startdate`, `budget`, `actual`, `targetdate`, `status`, `datecreated`) VALUES
(41, 'PT Mulia Utama', 'Petty Cash, AR, Operation,  Claim Customer, Mekanik & Teknik, Purchasing', 'Cahyadi', '2023-03-10', 5000000, 4000000, '2023-04-05', 'Done', '2023-03-25 03:11:43'),
(42, 'PT Indah Permai', 'Operasional, Sparepart, Outstanding AR dan Marketing', 'Budi', '2023-03-23', 3000000, 0, '2023-04-12', 'Done', '2023-03-25 03:12:49'),
(43, 'PT Tanjung Sari', 'Petty Cash, AR, Operation, Purchasing', 'Salomo', '2023-03-25', 5000000, 0, '2023-04-10', 'Running', '2023-03-25 03:13:34'),
(44, 'PT Jaya Indah', 'Sparepart, Outstanding AR, Claim Customer, HRD', 'Jemry', '2023-03-23', 8000000, 0, '2023-04-12', 'Plan', '2023-03-25 03:14:14'),
(47, 'PT Bosco Utama', 'Purchasing, Operasional', 'Jemry', '2023-04-10', 70000000, 0, '2023-04-30', 'Running', '2023-04-10 10:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `auditprogram`
--

CREATE TABLE `auditprogram` (
  `kode` int(11) NOT NULL,
  `kode_auditplan` int(11) NOT NULL,
  `strategy` varchar(150) NOT NULL,
  `program` varchar(200) NOT NULL,
  `tools` varchar(50) NOT NULL,
  `schedule` date NOT NULL,
  `statuspr` enum('Not Yet','On Progress','Done') NOT NULL,
  `result` enum('OK','NOT OK','N/A') NOT NULL,
  `note` varchar(150) DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auditprogram`
--

INSERT INTO `auditprogram` (`kode`, `kode_auditplan`, `strategy`, `program`, `tools`, `schedule`, `statuspr`, `result`, `note`, `datecreated`) VALUES
(57, 42, 'Memastikan proses maintenance pada kendaraan sudah sesuai dengan SOP', 'Melakuan konfirmasi kepada user', 'DC', '2023-03-28', 'Done', 'OK', '', '2023-03-25 03:15:49'),
(58, 42, 'Memastikan proses maintenance pada kendaraan sudah sesuai dengan SOP', 'Mengolah data (mencari pola penggantian part yang tidak sesuai', 'DC', '2023-03-28', 'Done', 'OK', '', '2023-03-25 03:16:27'),
(59, 42, 'Memastikan proses maintenance pada kendaraan sudah sesuai dengan SOP', 'Tarik data cost maintenance periode Agustus s.d November 2022', 'DC', '2023-04-03', 'On Progress', 'NOT OK', '', '2023-03-25 03:17:01'),
(60, 42, 'Memastikan transakasi marketing (Enternteiment, komisi etc) sudah dilakukan sesuai dengan SOP', 'Apabila terdapat ketidaksesuaian telusuri penyebabnya dan konfirmasikan kepada PIC terkait.', 'DC', '2023-04-03', 'On Progress', 'NOT OK', '', '2023-03-26 20:15:15'),
(61, 42, 'Memastikan transakasi marketing (Enternteiment, komisi etc) sudah dilakukan sesuai dengan SOP', 'Mengolah data pengeluaran marketing', 'DC', '2023-04-05', 'On Progress', 'NOT OK', '', '2023-03-26 20:17:15'),
(62, 42, 'Memastikan customer PT Indah permai sudah teradministrasi dengan benar', 'Apabila terdapat ketidaksesuaian telusuri penyebabnya dan konfirmasikan kepada PIC terkait.', 'DC', '2023-04-05', 'On Progress', 'N/A', '', '2023-03-26 20:19:23'),
(63, 42, 'Memastikan Penanganan Inventory dan scrap sesuai dengan prosedur.', 'Lakukan Stock Opname Inventory dan Scrap.', 'ET', '2023-04-04', 'Done', 'OK', '', '2023-03-26 20:29:33'),
(64, 42, 'Memastikan Penanganan Inventory dan scrap sesuai dengan prosedur.', 'Periksa kecocokan saldo fisik barang hasil stock opanme dengan saldo system.', 'ET', '2023-04-04', 'Done', 'OK', '', '2023-03-26 20:30:24'),
(65, 42, 'Memastikan Penanganan Inventory dan scrap sesuai dengan prosedur.', 'Periksa apakah uang hasil penjualan barang scrap sudah disetor ke finance.', 'ET', '2023-04-04', 'Done', 'OK', '', '2023-03-26 20:30:56'),
(70, 42, 'Memastikan penanganan Account Receivable telah sesuai dengan prosedur.', 'Periksa dan Review apakah bagian AR pernah melakukan visit customer terhadap AR yang outstanding.', 'ET', '2023-04-05', 'Done', 'OK', '', '2023-03-26 21:05:43'),
(71, 42, 'Memastikan penanganan Account Receivable telah sesuai dengan prosedur.', 'Periksa dan Review apakah bagian AR melakukan Follow up baik sebelum Over due ke customer.', 'ET', '2023-04-05', 'Done', 'OK', '', '2023-03-26 21:06:24'),
(72, 43, 'Memastikan Penanganan Prosedur Purchasing sesuai dengan prosedur.', 'Lakukan proses Pitching ke vendor lain atau vendor yang telah dipilih.', 'PU', '2023-04-07', 'Done', 'OK', '', '2023-03-26 21:07:06'),
(73, 43, 'Memastikan setiap proses Billing telah sesuai dengan Perjanjian Kerjasama (LOA).', 'Meminta data Letter of Aggrement dan Perjanjian Kerjasama dengan Customer.', 'PU', '2023-04-08', 'Done', 'OK', '', '2023-03-26 21:07:42'),
(80, 47, 'Purchasing sesuai dengan operasional perusahaan', 'Memastikan bahwa purchasing dilaksanakan sesuai dengan SOP yang berlaku', 'FR', '2023-04-20', 'Done', 'N/A', '', '2023-04-10 10:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `postaudit`
--

CREATE TABLE `postaudit` (
  `kode` int(11) NOT NULL,
  `kode_auditplan` int(11) NOT NULL,
  `scope` varchar(150) NOT NULL,
  `finding` varchar(150) NOT NULL,
  `amount` int(11) NOT NULL,
  `lossrecovery` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `root` varchar(150) NOT NULL,
  `risk` varchar(150) NOT NULL,
  `rekomen` varchar(150) NOT NULL,
  `weakness` enum('Human Resource','Improve System','SOP','FRAUD') NOT NULL,
  `target` date NOT NULL,
  `respon` enum('Not Yet','On Progress','Done') NOT NULL,
  `note` varchar(150) DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postaudit`
--

INSERT INTO `postaudit` (`kode`, `kode_auditplan`, `scope`, `finding`, `amount`, `lossrecovery`, `sisa`, `root`, `risk`, `rekomen`, `weakness`, `target`, `respon`, `note`, `datecreated`) VALUES
(24, 42, 'Marketing', 'Data pengeluaran tidak sesuai', 2000000, 1000000, 1000000, 'Kesahalan perhitungan', 'Keliru untuk pelaporan', 'Lebih teliti dan hati-hati', 'Human Resource', '2023-05-15', 'On Progress', '', '2023-03-26 20:39:10'),
(25, 42, 'Sparepart', 'Uang hasil penjualan yang disetor kurang', 5000000, 0, 0, 'Manipulasi', 'Merugikan perusahaan', 'Evaluasi karyawan dan penuntutan', 'FRAUD', '2023-04-07', 'Not Yet', '', '2023-03-26 21:12:24'),
(26, 42, 'Sparepart', 'Stock Opname gagal', 2000000, 0, 0, 'Kesalahan sistem', 'Sistem opname eror', 'Perbaikan', 'Improve System', '2023-04-07', 'Not Yet', '', '2023-03-26 21:13:18'),
(27, 42, 'Operasional', 'Konfirmasi user tidak sesuai alur', 1000000, 1000000, 0, 'Alur tidak urut', 'Bahaya ringan', 'Lebih diperhatikan SOP-nya', 'SOP', '2023-03-05', 'Done', '', '2023-03-26 21:14:47'),
(28, 43, 'Purchasing', 'Data perjanjian tertunda', 2000000, 1000000, 1000000, 'Waktu bertabrakan', 'Berpengaruh terhadap keberjalanan kerjasama selanjutnya', 'Atur waktu', 'Human Resource', '2023-04-10', 'On Progress', '', '2023-03-26 21:16:24'),
(31, 47, 'Purchasing', 'Biaya kurang', 5000000, 2000000, 3000000, 'Teledor', 'bahaya ringan', 'harus lebih teliti lagi', 'SOP', '2023-04-27', 'On Progress', '', '2023-04-10 10:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `nama`, `email`, `password`, `status`) VALUES
('admin', 'admin pertama', 'adminpertama@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('admin2', 'admin kedua', 'admin2@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('admin3', 'admin ketiga', 'admin3@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('budi', 'budi123', 'budi@gmail.com', '00dfc53ee86af02e742515cdcf075ed3', 'user'),
('farah', 'farah tisti', 'farah@gmail.com', '9b0f4d720720fd55436ac7f07ac8a840', 'user'),
('mahastra', 'mahasta hangga', 'mahastra@gmail.com', '7c542652153535c251ff513e82b93a42', 'user'),
('wildan', 'wildan niti', 'wildan@gmail.com', 'af6b3aa8c3fcd651674359f500814679', 'user'),
('wita', 'wita nimala', 'wita@gmail.com', '9757bb3cf28a5797e08ff7247bcc5ff0', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auditplan`
--
ALTER TABLE `auditplan`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `auditprogram`
--
ALTER TABLE `auditprogram`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `postaudit`
--
ALTER TABLE `postaudit`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auditplan`
--
ALTER TABLE `auditplan`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `auditprogram`
--
ALTER TABLE `auditprogram`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `postaudit`
--
ALTER TABLE `postaudit`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
