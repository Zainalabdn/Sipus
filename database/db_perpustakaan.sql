-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2024 pada 18.23
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(125) NOT NULL,
  `kategori_buku` varchar(125) NOT NULL,
  `deskripsi` text NOT NULL,
  `penerbit_buku` varchar(125) NOT NULL,
  `pengarang` varchar(125) NOT NULL,
  `tahun_terbit` varchar(125) NOT NULL,
  `isbn` int(50) NOT NULL,
  `j_buku_baik` varchar(125) NOT NULL,
  `j_buku_rusak` varchar(125) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `kategori_buku`, `deskripsi`, `penerbit_buku`, `pengarang`, `tahun_terbit`, `isbn`, `j_buku_baik`, `j_buku_rusak`, `img`) VALUES
(8, 'The Hobbit', 'Novel', 'A children\'s fantasy novel by J.R.R. Tolkien.', 'Allen & Unwin', 'J.R.R. Tolkien', '1937', 2147483647, '25', '0', 'https://cdn.gramedia.com/uploads/items/9789792286335_The-Hobbit.jpg'),
(9, 'Brave New World', 'Novel', 'A dystopian novel by Aldous Huxley.', 'Chatto & Windus', 'Aldous Huxley', '1932', 2147483647, '12', '1', 'https://cdn.gramedia.com/uploads/images/1/28946/big_covers/ID_HCO2015MTH11BNWO.jpeg'),
(10, 'The Lord of the Rings', 'Novel', 'An epic high-fantasy novel by J.R.R. Tolkien.', 'Allen & Unwin', 'J.R.R. Tolkien', '1954', 2147483647, '30', '3', 'https://cdn.gramedia.com/uploads/items/9786020332277_Lord-Of-The-Rings_Dua-Menara-The-Two-Towers-Cover-Baru.jpg'),
(12, 'Moby-Dick', 'Novel', 'A novel by Herman Melville.', 'Richard Bentley', 'Herman Melville', '1851', 2147483647, '20', '2', 'https://cdn.gramedia.com/uploads/picture_meta/2023/5/17/84g7aqupmucegtgegdyz5q.jpg'),
(13, 'Frankenstein', 'Novel', 'A novel by Mary Shelley.', 'Lackington, Hughes, Harding, Mavor & Jones', 'Mary Shelley', '1818', 2147483647, '15', '1', 'https://cdn.gramedia.com/uploads/picture_meta/2024/2/19/57jgmeb2nfbopzuagetb2z.jpg'),
(14, 'The Picture of Dorian Gray', 'Novel', 'A novel by Oscar Wilde.', 'Ward, Lock and Company', 'Oscar Wilde', '1890', 2147483647, '18', '0', 'https://cdn.gramedia.com/uploads/items/9786020634371_The_Picture_of_Dorian_Gray_cov.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `identitas`
--

CREATE TABLE `identitas` (
  `id_identitas` int(11) NOT NULL,
  `nama_app` varchar(50) NOT NULL,
  `alamat_app` text NOT NULL,
  `email_app` varchar(125) NOT NULL,
  `nomor_hp` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_app`, `alamat_app`, `email_app`, `nomor_hp`) VALUES
(1, 'Perpustakaan SMAN Pati', 'Jl. P. Sudirman No.24, Puri, Plangitan, Kec. Pati, Kabupaten Pati, Jawa Tengah', 'perpussmanpati@e-perpus.com', '6281221545666');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kode_kategori` varchar(50) NOT NULL,
  `nama_kategori` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kode_kategori`, `nama_kategori`) VALUES
(1, 'KT-001', 'Novel '),
(2, 'KT-002', 'Cergam'),
(3, 'KT-003', 'Ensiklopedi'),
(4, 'KT-004', 'Biografi'),
(5, 'KT-005', 'Catatan Harian'),
(6, 'KT-006', 'Karya Ilmiah'),
(7, 'KT-007', 'Tafsir'),
(8, 'KT-008', 'Panduan (how to)'),
(9, 'KT-009', 'Majalah'),
(10, 'KT-010', 'Antologi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemberitahuan`
--

CREATE TABLE `pemberitahuan` (
  `id_pemberitahuan` int(11) NOT NULL,
  `isi_pemberitahuan` varchar(255) NOT NULL,
  `level_user` varchar(125) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemberitahuan`
--

INSERT INTO `pemberitahuan` (`id_pemberitahuan`, `isi_pemberitahuan`, `level_user`, `status`) VALUES
(1, '<i class=\'fa fa-exchange\'></i> #Reza  Saputra Telah meminjam Buku', 'Admin', 'Belum dibaca'),
(2, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Belum dibaca');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `nama_anggota` varchar(125) NOT NULL,
  `judul_buku` varchar(125) NOT NULL,
  `tanggal_peminjaman` varchar(125) NOT NULL,
  `tanggal_pengembalian` varchar(50) NOT NULL,
  `kondisi_buku_saat_dipinjam` varchar(125) NOT NULL,
  `kondisi_buku_saat_dikembalikan` varchar(125) NOT NULL,
  `denda` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `nama_anggota`, `judul_buku`, `tanggal_peminjaman`, `tanggal_pengembalian`, `kondisi_buku_saat_dipinjam`, `kondisi_buku_saat_dikembalikan`, `denda`) VALUES
(1, 'Reza  Saputra', 'Cantik Itu Luka', '08-08-2022', '08-08-2022', 'Baik', 'Baik', 'Tidak ada');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `kode_penerbit` varchar(125) NOT NULL,
  `nama_penerbit` varchar(50) NOT NULL,
  `verif_penerbit` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `kode_penerbit`, `nama_penerbit`, `verif_penerbit`) VALUES
(1, 'P001', 'Gramedia Pustaka Utama', 'Terverifikasi'),
(2, 'P002', 'Mizan Pustaka', 'Terverifikasi'),
(3, 'P003', 'Bentang Pustaka', 'Terverifikasi'),
(4, 'P004', 'Erlangga', 'Terverifikasi'),
(5, 'P005', 'Republika', 'Terverifikasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_user` int(11) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `waktu_masuk` time NOT NULL,
  `waktu_keluar` time DEFAULT NULL,
  `keperluan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengunjung`
--

INSERT INTO `pengunjung` (`id_user`, `tanggal_kunjungan`, `waktu_masuk`, `waktu_keluar`, `keperluan`) VALUES
(3, '2024-06-19', '23:02:00', '02:02:00', 'baca'),
(7, '2024-06-19', '03:03:00', '08:03:00', 'nh'),
(12, '2024-06-19', '23:38:00', '07:00:00', 'baca'),
(3, '2024-06-20', '23:41:00', '00:41:00', 'nh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
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
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `penerima`, `pengirim`, `judul_pesan`, `isi_pesan`, `status`, `tanggal_kirim`) VALUES
(2, 'Fauzan Aditya Putra', 'Petugas', 'Pengembalian', 'terlambat', 'Sudah dibaca', '18-06-2024'),
(3, 'Reza  Saputra', 'Administrator', 'Pengembalian', 'kembali gak', 'Belum dibaca', '18-06-2024');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `kode_user`, `nis`, `fullname`, `username`, `notelp`, `email`, `password`, `kelas`, `alamat`, `verif`, `role`, `join_date`, `terakhir_login`) VALUES
(1, '-', '-', 'Administrator', 'admin', 0, '', 'admin', '-', '-', 'Iya', 'Admin', '04-05-2021', '20-06-2024 ( 22:46:15 )'),
(2, '-', '-', 'Petugas', 'petugas', 0, '', 'petugas', '-', '-', 'Iya', 'Petugas', '18-06-2024', ''),
(3, 'AP001', '100011', 'Reza  Saputra', 'reza', 831232132, 'reza@gmail.com', 'Reza', 'Lulus', 'Desa Sambiroto, Kecamatan Tayu, Kabupatem Pati', 'Tidak', 'Anggota', '08-08-2022', '18-06-2024 ( 15:11:42 )'),
(4, 'AP002', '54353', 'Fauzan Aditya Putra', 'zan', 85321341, 'user@example.com', 'secret', 'Lulus', 'klaten', 'Tidak', 'Anggota', '2024-06-19', ''),
(5, 'AP003', '200022', 'Dewi Lestari', 'dewi', 812345678, 'dewi@example.com', 'dewi123', 'Lulus', 'Jl. Mawar No. 10, Bandung', 'Tidak', 'Anggota', '2023-03-15', ''),
(6, 'AP004', '300033', 'Ahmad Syahid', 'ahmad', 856789012, 'ahmad@example.com', 'rahasia', 'Lulus', 'Surabaya', 'Tidak', 'Anggota', '2022-11-20', '2024-06-17 09:30:21'),
(7, 'AP005', '400044', 'Siti Nurjanah', 'siti', 899001122, 'siti@example.com', 'siti123', 'Lulus', 'Yogyakarta', 'Tidak', 'Anggota', '2023-01-10', ''),
(8, 'AP006', '500055', 'Rudi Setiawan', 'rudi', 877665544, 'rudi@example.com', 'rudi123', 'Lulus', 'Jakarta', 'Tidak', 'Anggota', '2022-09-25', '2024-06-18 11:45:36'),
(9, 'AP007', '600066', 'Lina Wijaya', 'lina', 878787878, 'lina@example.com', 'lina123', 'Lulus', 'Bandung', 'Tidak', 'Anggota', '2022-12-05', ''),
(10, 'AP008', '700077', 'Fitri Indah', 'fitri', 889900112, 'fitri@example.com', 'fitri123', 'Lulus', 'Semarang', 'Tidak', 'Anggota', '2023-02-18', ''),
(11, 'AP009', '800088', 'Hendri Kurniawan', 'hendri', 877788899, 'hendri@example.com', 'hendri123', 'Lulus', 'Solo', 'Tidak', 'Anggota', '2022-10-30', '2024-06-19 08:20:15'),
(12, 'AP010', '900099', 'Nina Rahman', 'nina', 812345678, 'nina@example.com', 'nina123', 'Lulus', 'Malang', 'Tidak', 'Anggota', '2022-11-05', ''),
(13, 'AP011', '1000010', 'Budi Santoso', 'budi', 823456789, 'budi@example.com', 'budi123', 'Lulus', 'Surakarta', 'Tidak', 'Anggota', '2023-04-22', '2024-06-18 14:55:10'),
(14, 'AP012', '1100011', 'Sari Wijaya', 'sari', 834567890, 'sari@example.com', 'sari123', 'Lulus', 'Jakarta Selatan', 'Tidak', 'Anggota', '2022-09-15', ''),
(15, 'AP013', '1200012', 'Rizki Pratama', 'rizki', 845678901, 'rizki@example.com', 'rizki123', 'Lulus', 'Bandung Barat', 'Tidak', 'Anggota', '2023-01-08', '2024-06-17 16:45:30'),
(16, 'AP014', '1300013', 'Wulan Sari', 'wulan', 856789012, 'wulan@example.com', 'wulan123', 'Lulus', 'Bekasi', 'Tidak', 'Anggota', '2022-12-10', ''),
(17, 'AP015', '1400014', 'Dedi Firmansyah', 'dedi', 867890123, 'dedi@example.com', 'dedi123', 'Lulus', 'Depok', 'Tidak', 'Anggota', '2023-03-28', '2024-06-18 09:10:25'),
(18, 'AP016', '1500015', 'Rini Cahyani', 'rini', 878901234, 'rini@example.com', 'rini123', 'Lulus', 'Tangerang', 'Tidak', 'Anggota', '2022-11-25', ''),
(19, 'AP017', '1600016', 'Aldi Nugroho', 'aldi', 889012345, 'aldi@example.com', 'aldi123', 'Lulus', 'Bogor', 'Tidak', 'Anggota', '2023-02-05', '2024-06-19 10:30:18');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  ADD PRIMARY KEY (`id_pemberitahuan`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indeks untuk tabel `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id_identitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  MODIFY `id_pemberitahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD CONSTRAINT `pengunjung_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
