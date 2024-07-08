<?php
session_start();

// Pastikan pengguna sudah login sebelum mengakses halaman ini
if (!isset($_SESSION['username'])) {
    header("Location: ../../function/Process.php");
    exit();
}

include "../../config/koneksi.php";

// Ambil ID pengguna dari sesi
$id_user = $_SESSION['id_user'];

// Query untuk mengambil daftar buku yang dipinjam oleh pengguna
$query = "SELECT buku.*, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali
        FROM peminjaman
        INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
        WHERE peminjaman.id_user = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

// Inisialisasi array untuk menyimpan buku yang dipinjam
$buku_dipinjam = [];

while ($row = $result->fetch_assoc()) {
    $buku_dipinjam[] = $row;
}

$stmt->close();
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Yang Dipinjam</title>
    <style>
        .book-image {
            width: 100%;
            max-width: 350px;
            height: auto;
            object-fit: cover;
        }
    </style>
    <?php include 'head.php'; ?> <!-- Pastikan path include file head.php sudah benar -->
</head>
<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">
    <?php include 'navbar.php'; ?> <!-- Pastikan path include file navbar.php sudah benar -->

    <section id="borrowed-books" class="bookshelf pb-5 mb-5">
        <div class="section-header align-center">
            <h2 class="section-title">Buku Yang Dipinjam</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="inner-content">
                    <div class="product-list" data-aos="fade-up">
                        <div class="grid product-grid">
                            <?php foreach ($buku_dipinjam as $buku): ?>
                                <div class="product-item">
                                    <figure class="product-style">
                                        <img src="<?= $buku['img']; ?>" alt="Book Cover" class="product-item book-image">
                                    </figure>
                                    <figcaption>
                                        <h3><?= $buku['judul_buku']; ?></h3>
                                        <div class="item-details">
                                            <p><strong>Status:</strong> Dipinjam</p>
                                            <p><strong>Tanggal pinjam:</strong> <?= $buku['tanggal_pinjam']; ?></p>
                                            <p><strong>Batas waktu:</strong> <?= $buku['tanggal_kembali']; ?></p>
                                        </div>
                                        <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Kembalikan</button>
                                    </figcaption>
                                </div>
                            <?php endforeach; ?>
                        </div><!-- grid -->
                    </div><!-- product-list -->
                </div><!-- inner-content -->
            </div><!-- row -->
        </div><!-- container -->
    </section><!-- borrowed-books -->

    <?php include 'footer.php'; ?> <!-- Pastikan path include file footer.php sudah benar -->
</body>
</html>
