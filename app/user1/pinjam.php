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

    <?php @include('head.php'); ?>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

    <?php @include('navbar.php'); ?>
    <section id="popular-books" class="bookshelf py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header align-center">
                        <div class="title">
                            <span>Some quality items</span>
                        </div>
                        <h2 class="section-title">Buku Dipinjam</h2>
                    </div>
                    <ul class="tabs">
                        <li data-tab-target="#Dipinjam" class="active tab">Dipinjam</li>
                        <li data-tab-target="#Dikembalikan" class="tab">Dikembalikan</li>
                    </ul>
                    <div class="tab-content">
                        <div id="Dipinjam" data-tab-content class="active">
                            <div class="row" id="book-list">
                                <?php while ($book = $resultDipinjam->fetch_assoc()) : ?>
                                    <div class="col-md-3">
                                        <div class="product-item">
                                            <figure class="product-style">
                                                <img src="<?= $book['img']; ?>" alt="Books" class="product-item">
                                            </figure>
                                            <figcaption>
                                                <h3><?= $book['judul_buku']; ?></h3>
                                                <span>Status: <?= $book['status']; ?></span>
                                                <span>Tanggal Pinjam: <?= $book['tanggal_pinjam']; ?></span>
                                                <p><span>Harus Dikembalikan Sebelum <?= $book['tanggal_kembali']; ?></span></p>
                                                <div class="btn-wrap">
                                                    <a href="#" class="btn-accent-arrow kembalikan-btn" data-bs-toggle="modal" data-bs-target="#modalKembalikan<?= $book['id_buku']; ?>">Kembalikan <i class="icon icon-ns-arrow-right"></i></a>
                                                </div>
                                                <div class="modal fade" id="modalKembalikan<?= $book['id_buku']; ?>" tabindex="-1" aria-labelledby="modalKembalikanLabel<?= $book['id_buku']; ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalKembalikanLabel<?= $book['id_buku']; ?>">Kembalikan Buku</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Anda yakin ingin mengembalikan buku <strong><?= $book['judul_buku']; ?></strong>?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <a href="function/kembalikan.php?id=<?= $book['id_buku']; ?>" class="btn btn-primary">Ya, Kembalikan</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </div>
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