-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2024 pada 01.47
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
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `kategori_buku`, `deskripsi`, `penerbit_buku`, `pengarang`, `tahun_terbit`, `isbn`, `jumlah_buku`, `averageRating`, `img`, `language`) VALUES
(31, 'Membangun Warnet dan Game Center Sendiri', 'a', 'Lorem', 'Penerbit Andi', 'Wahana Komputer', '2019', 2147483647, '9', '5', 'http://books.google.com/books/content?id=kgz-XM5uRiYC&printsec=frontcover&img=1&zoom=1&edge=curl&imgtk=AFLRE70bAYa_uwfdtjhefKXDPoJawKXf1m7rV3DCXCN-TRmLRF_dfopAROWVVfU1kHL2Tambpl9zK6tjfsEkKsL8Mhw120nTAe7L4aVJzAF2j3SCOWISyZsWsxMiYoKgIiS9id8-I4ZV&source=gbs_', 'id'),
(32, 'Aku ingin bunuh Harry Potter!', 'Fiction / General, Juvenile Fiction / General', 'A fan tribute to Harry Potter, looking at all that can be learned by reading these books, and examing the influence of Rowling\'s books.', 'DAR! Mizan', 'Andhy Romdani', '2021', 2147483647, '2', '4.5', 'http://books.google.com/books/content?id=X5Q48SktnasC&printsec=frontcover&img=1&zoom=1&edge=curl&imgtk=AFLRE72hOZx_40P31eBnaM85Eur0si7VMQlYeAyPOjqYYSyaDI2WXnGBkMaJZX7mS_muvXnlaHrw_WaY550WXPf86LC7P-J4ZlZ4ymn9HBXUOLtpHR7nUfrKWq0drYu1bqtXMU8YaX4y&source=gbs_', 'id'),
(33, 'Game Terbaik Facebook', 'Biografi', 'Lorem', 'Elex Media Komputindo', 'George Broderick', '2002', 2147483647, '3', '3', 'http://books.google.com/books/content?id=fL66Hc6wr9YC&printsec=frontcover&img=1&zoom=1&edge=curl&imgtk=AFLRE73uRTOkIj7K_Rz_1l56vVfgbMF_-5o0ZWJMEpc9I3qw9_tFfEbbTDMVMGebqDzjsQBkzlt1cqZUfUq3oG1kZHH3KuyoxdsKZMJluCMVlw7IxZHU-TBePWIXcKHLpCv5qllw-hFI&source=gbs_', 'id'),
(34, 'Dunia ajaib Harry Potter', 'Tafsir', 'lorem', 'Gramedia Pustaka Utama', 'David Colbert', '2006', 2147483647, '3', '2', 'http://books.google.com/books/content?id=ZAokf__5QOcC&printsec=frontcover&img=1&zoom=1&edge=curl&imgtk=AFLRE71dwRDIuHQ_9bUsFL_Buq_jK8vPAtSTBt2rO4-_jMVEoLwzIiwqs--h9GPKWsVOH2_e488rRNXtwIU57iec51q9JCvg4lQGOBUhFXLPJhLWLlE99hppqMiRgY3LMZ5_7wXJkYB-&source=gbs_', 'id');

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
(1, 'E-LIBRARY', 'Jl. Ring Road Utara, Ngringin, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281', 'ELIBRARY@e-library.com', '6281221545666');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_buku`, `id_user`, `username`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(3, 34, 1, '', '2024-07-06', '2024-07-07', 'Dipinjam'),
(4, 34, 1, '', '2024-07-06', '2024-07-20', 'Dipinjam'),
(5, 31, 3, '', '2024-07-07', '2024-07-08', 'Dipinjam'),
(6, 34, 3, '', '2024-07-07', '2024-07-17', 'Dipinjam');

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
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `denda` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, '2024-06-23', '23:02:00', '02:02:00', 'baca'),
(7, '2024-06-19', '03:03:00', '08:03:00', 'nh'),
(12, '2024-06-19', '23:38:00', '07:00:00', 'baca'),
(3, '2024-06-23', '23:02:00', '02:02:00', 'baca'),
(19, '2024-06-17', '12:10:00', '16:14:00', 'Membaca');

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
(3, 'Reza  Saputra', 'Petugas', 'Pengembalian', 'kembali gak', 'Sudah dibaca', '18-06-2024'),
(6, 'Reza  Saputra', 'Administrator', 'Mengembalikan', 'as', 'Sudah dibaca', '25-06-2024');

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
(1, '-', '-', 'Administrator', 'admin', 0, '', 'admin', '-', '-', 'Iya', 'Admin', '04-05-2021', '08-07-2024 ( 06:35:26 )'),
(2, '-', '-', 'Petugas', 'petugas', 0, '', 'petugas', '-', '-', 'Iya', 'Petugas', '18-06-2024', '23-06-2024 ( 13:14:45 )'),
(3, 'AP001', '100011', 'Reza  Saputra', 'reza', 831232132, 'reza@gmail.com', 'Reza', 'Lulus', 'Desa Sambiroto, Kecamatan Tayu, Kabupatem Pati', 'Tidak', 'Anggota', '08-08-2022', '08-07-2024 ( 06:32:48 )'),
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
(19, 'AP017', '1600016', 'Aldi Nugroho', 'aldi', 889012345, 'aldi@example.com', 'aldi123', 'Lulus', 'Bogor', 'Tidak', 'Anggota', '2023-02-05', '2024-06-19 10:30:18'),
(26, '-', '-', 'Azizi Egatri M', 'azizi', 0, '', 'qwe', '-', '-', 'Iya', 'Admin', '23-06-2024', '23-06-2024 ( 12:42:45 )'),
(27, 'AP018', '', 'qweqwe', 'qwe', 0, '', 'qwe', '', '', 'Tidak', 'Anggota', '25-06-2024', '27-06-2024 ( 20:52:10 )');

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
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_peminjaman` (`id_peminjaman`);

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
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
  MODIFY `id_pemberitahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`);

--
-- Ketidakleluasaan untuk tabel `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD CONSTRAINT `pengunjung_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
