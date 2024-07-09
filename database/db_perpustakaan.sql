-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2024 at 06:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(125) DEFAULT NULL,
  `kategori_buku` varchar(125) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `penerbit_buku` varchar(125) DEFAULT NULL,
  `pengarang` varchar(125) DEFAULT NULL,
  `tahun_terbit` varchar(125) DEFAULT NULL,
  `isbn` int(50) DEFAULT NULL,
  `jumlah_buku` varchar(125) DEFAULT NULL,
  `averageRating` varchar(125) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `kategori_buku`, `deskripsi`, `penerbit_buku`, `pengarang`, `tahun_terbit`, `isbn`, `jumlah_buku`, `averageRating`, `img`, `language`) VALUES
(50, 'Harry Potter dan Orde Phoenix', 'Novel', '', 'Gramedia Pustaka Utama', 'J. K. Rowling', '2004', 2147483647, '1', '4.5', 'http://books.google.com/books/content?id=qCLFw5injs8C&printsec=frontcover&img=1&zoom=1&edge=curl&imgtk=AFLRE71zJdlo7Yk04B4i-Ni7cSl1rEjOZWXTxkr2l-oaGkwhQEin5OZCFsnC8Ql_SKTU9J42feUC13kg6kv6MukG7IGvawh_PVztAz96dW3vBAUDVF5FDyQYWGJiQjnnbIsahpHs_YhR&source=gbs_', 'id'),
(51, 'Harry Potter dan Relikui Kematian', 'Novel', '', 'Gramedia Pustaka Utama', 'JK Rowling', '2008', 2147483647, '10', '4.5', 'http://books.google.com/books/content?id=3sSVzLsHIb8C&printsec=frontcover&img=1&zoom=1&edge=curl&imgtk=AFLRE70VDcEIO1aZRptHuuchn2bUo0wKbktpKlytt7BVkckm2y0pemh0tSlb_Cw0STMEyOKf1jzRVVV5vtltYWIK-ZdYTiN50iIWF8uVUZGrmR8zl9Rgn7b5r1vFjC6ed9j5Rnzl0_RN&source=gbs_', 'id');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id_identitas` int(11) NOT NULL,
  `nama_app` varchar(50) NOT NULL,
  `alamat_app` text NOT NULL,
  `email_app` varchar(125) NOT NULL,
  `nomor_hp` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_app`, `alamat_app`, `email_app`, `nomor_hp`) VALUES
(1, 'E-LIBRAR', 'Jl. Ring Road Utara, Ngringin, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281', 'ELIBRARY@e-library.com', '628122154566');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kode_kategori` varchar(50) NOT NULL,
  `nama_kategori` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kode_kategori`, `nama_kategori`) VALUES
(2, 'KT-002', 'Cergam'),
(3, 'KT-003', 'Ensiklopedi'),
(4, 'KT-004', 'Biografi'),
(7, 'KT-007', 'Tafsir'),
(9, 'KT-009', 'Majalah'),
(10, 'KT-010', 'Antologi'),
(11, 'KT-011', 'Novel');

-- --------------------------------------------------------

--
-- Table structure for table `pemberitahuan`
--

CREATE TABLE `pemberitahuan` (
  `id_pemberitahuan` int(11) NOT NULL,
  `isi_pemberitahuan` varchar(255) NOT NULL,
  `level_user` varchar(125) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `kode_penerbit` varchar(125) NOT NULL,
  `nama_penerbit` varchar(50) NOT NULL,
  `verif_penerbit` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `kode_penerbit`, `nama_penerbit`, `verif_penerbit`) VALUES
(2, 'P002', 'Mizan Pustaka', 'Terverifikasi'),
(3, 'P003', 'Bentang Pustaka', 'Terverifikasi'),
(4, 'P004', 'Erlanggaz', 'Terverifikasi'),
(6, 'P006', 'Gramedia Prambanan', 'Terverifikasi');

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_user` int(11) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `waktu_masuk` time NOT NULL,
  `waktu_keluar` time DEFAULT NULL,
  `keperluan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id_user`, `tanggal_kunjungan`, `waktu_masuk`, `waktu_keluar`, `keperluan`) VALUES
(3, '2024-06-23', '23:02:00', '02:02:00', 'baca'),
(7, '2024-06-19', '03:03:00', '08:03:00', 'nh'),
(12, '2024-06-19', '23:38:00', '07:00:00', 'baca'),
(3, '2024-06-23', '23:02:00', '02:02:00', 'baca'),
(19, '2024-06-17', '12:10:00', '16:14:00', 'Membaca');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `judul_pesan` varchar(50) NOT NULL,
  `isi_pesan` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal_kirim` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `penerima`, `pengirim`, `judul_pesan`, `isi_pesan`, `status`, `tanggal_kirim`) VALUES
(2, 'Fauzan Aditya Putra', 'Petugas', 'Pengembalian', 'terlambat', 'Sudah dibaca', '18-06-2024'),
(3, 'Reza  Saputra', 'Petugas', 'Pengembalian', 'kembali gak', 'Sudah dibaca', '18-06-2024'),
(6, 'Reza  Saputra', 'Administrator', 'Mengembalikan', 'as', 'Sudah dibaca', '25-06-2024');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `kode_user` varchar(25) NOT NULL,
  `nis` char(20) NOT NULL,
  `fullname` varchar(125) NOT NULL,
  `username` varchar(50) NOT NULL,
  `notelp` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `verif` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `join_date` varchar(125) NOT NULL,
  `terakhir_login` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `kode_user`, `nis`, `fullname`, `username`, `notelp`, `email`, `password`, `kelas`, `alamat`, `verif`, `role`, `join_date`, `terakhir_login`) VALUES
(1, '-', '-', 'Administrator', 'admin', 0, '', 'admin', '-', '-', 'Iya', 'Admin', '04-05-2021', '09-07-2024 ( 11:50:41 )'),
(2, '-', '-', 'Petugas', 'petugas', 0, '', 'petugas', '-', '-', 'Iya', 'Petugas', '18-06-2024', '09-07-2024 ( 11:31:30 )'),
(3, 'AP001', '100011', 'Reza  Saputra', 'reza', 831232132, 'reza@gmail.com', 'Reza', 'XI - Farmasi', 'Desa Sambiroto, Kecamatan Tayu, Kabupatem Pati', 'Tidak', 'Anggota', '08-08-2022', '09-07-2024 ( 10:59:10 )'),
(4, 'AP002', '54353', 'Fauzan Aditya Putra', 'zan', 85321341, 'user@example.com', 'secret', 'X - Teknik Kendaraan Ringan', 'klaten', 'Tidak', 'Anggota', '2024-06-19', '08-07-2024 ( 16:14:34 )'),
(5, 'AP003', '200022', 'Dewi Lestari', 'dewi', 812345678, 'dewi@example.com', 'dewi123', 'Lulus', 'Jl. Mawar No. 10, Bandung', 'Tidak', 'Anggota', '2023-03-15', ''),
(6, 'AP004', '300033', 'Ahmad Syahid', 'ahmad', 856789012, 'ahmad@example.com', 'rahasia', 'Lulus', 'Surabaya', 'Tidak', 'Anggota', '2022-11-20', '2024-06-17 09:30:21'),
(7, 'AP005', '400044', 'Siti Nurjanah', 'siti', 899001122, 'siti@example.com', 'siti123', 'XI - Teknik Komputer dan Jaringan', 'Yogyakarta', 'Tidak', 'Anggota', '2023-01-10', ''),
(8, 'AP006', '500055', 'Rudi Setiawan', 'rudi', 877665544, 'rudi@example.com', 'rudi123', 'Lulus', 'Jakarta', 'Tidak', 'Anggota', '2022-09-25', '2024-06-18 11:45:36'),
(9, 'AP007', '600066', 'Lina Wijaya', 'lina', 878787878, 'lina@example.com', 'lina123', 'XI - Teknik Kendaraan Ringan', 'Bandung', 'Tidak', 'Anggota', '2022-12-05', ''),
(10, 'AP008', '700077', 'Fitri Indah', 'fitri', 889900112, 'fitri@example.com', 'fitri123', 'XII - Teknik Komputer dan Jaringan', 'Semarang', 'Tidak', 'Anggota', '2023-02-18', ''),
(11, 'AP009', '800088', 'Hendri Kurniawan', 'hendri', 877788899, 'hendri@example.com', 'hendri123', 'Lulus', 'Solo', 'Tidak', 'Anggota', '2022-10-30', '2024-06-19 08:20:15'),
(12, 'AP010', '900099', 'Nina Rahman', 'nina', 812345678, 'nina@example.com', 'nina123', 'Lulus', 'Malang', 'Tidak', 'Anggota', '2022-11-05', ''),
(13, 'AP011', '1000010', 'Budi Santoso', 'budi', 823456789, 'budi@example.com', 'budi123', 'XII - Teknik Sepeda Motor', 'Surakarta', 'Tidak', 'Anggota', '2023-04-22', '2024-06-18 14:55:10'),
(14, 'AP012', '1100011', 'Sari Wijaya', 'sari', 834567890, 'sari@example.com', 'sari123', 'XII - Perbankan', 'Jakarta Selatan', 'Tidak', 'Anggota', '2022-09-15', ''),
(15, 'AP013', '1200012', 'Rizki Pratama', 'rizki', 845678901, 'rizki@example.com', 'rizki123', 'Lulus', 'Bandung Barat', 'Tidak', 'Anggota', '2023-01-08', '2024-06-17 16:45:30'),
(16, 'AP014', '1300013', 'Wulan Sari', 'wulan', 856789012, 'wulan@example.com', 'wulan123', 'Lulus', 'Bekasi', 'Tidak', 'Anggota', '2022-12-10', ''),
(17, 'AP015', '1400014', 'Dedi Firmansyah', 'dedi', 867890123, 'dedi@example.com', 'dedi123', 'Lulus', 'Depok', 'Tidak', 'Anggota', '2023-03-28', '2024-06-18 09:10:25'),
(18, 'AP016', '1500015', 'Rini Cahyani', 'rini', 878901234, 'rini@example.com', 'rini123', 'Lulus', 'Tangerang', 'Tidak', 'Anggota', '2022-11-25', ''),
(19, 'AP017', '1600016', 'Aldi Nugroho', 'aldi', 889012345, 'aldi@example.com', 'aldi123', 'XI - Rekayasa Perangkat Lunak', 'Bogor', 'Tidak', 'Anggota', '2023-02-05', '2024-06-19 10:30:18'),
(28, 'AP019', '', 'qwer', 'qwer', 0, '', 'qwer', '', '', 'Tidak', 'Anggota', '08-07-2024', '08-07-2024 ( 23:46:32 )'),
(31, 'AP020', '22114789', 'Andre jangrek', 'andrr', 2147483647, 'andrea@gmail.com', '123', 'XII - Rekayasa Perangkat Lunak', 'Gupolo', 'Tidak', 'Anggota', '09-07-2024', '09-07-2024 ( 11:06:48 )'),
(32, 'AP021', '22114789', 'andreas', 'andre', 2147483647, 'qwe@s', 'andre', 'X - Farmasi', 'Klaten', 'Tidak', 'Anggota', '09-07-2024', '09-07-2024 ( 11:31:07 )');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  ADD PRIMARY KEY (`id_pemberitahuan`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id_identitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  MODIFY `id_pemberitahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD CONSTRAINT `pengunjung_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
