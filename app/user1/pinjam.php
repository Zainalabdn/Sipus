<?php
session_start();

// Ensure the user is logged in before accessing this page
if (!isset($_SESSION['username'])) {
    header("Location: ../../function/Process.php");
    exit();
}

include "../../config/koneksi.php";

// Get the user ID from the session
$id_user = $_SESSION['id_user'];

// Query to get the list of books borrowed and returned by the user
$query = "SELECT buku.*, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali, peminjaman.status
          FROM peminjaman
          INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
          WHERE peminjaman.id_user = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

// Initialize arrays to store borrowed and returned books
$buku_dipinjam = [];
$buku_dikembalikan = [];

while ($row = $result->fetch_assoc()) {
    if ($row['status'] == 'Dipinjam') {
        $buku_dipinjam[] = $row;
    } else if ($row['status'] == 'Dikembalikan') {
        $buku_dikembalikan[] = $row;
    }
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

    <?php include('head.php'); ?>
</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

    <?php include('navbar.php'); ?>

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
                                <?php foreach ($buku_dipinjam as $book) : ?>
                                    <div class="col-md-3">
                                        <div class="product-item">
                                            <figure class="product-style">
                                                <img src="<?= htmlspecialchars($book['img']); ?>" alt="Books" class="book-image">
                                            </figure>
                                            <figcaption>
                                                <h3><?= htmlspecialchars($book['judul_buku']); ?></h3>
                                                <span>Status: <?= htmlspecialchars($book['status']); ?></span>
                                                <span>Tanggal Pinjam: <?= htmlspecialchars($book['tanggal_pinjam']); ?></span>
                                                <p><span>Harus Dikembalikan Sebelum <?= htmlspecialchars($book['tanggal_kembali']); ?></span></p>
                                                <div class="btn-wrap">
                                                    <a href="#" class="btn-accent-arrow kembalikan-btn" data-bs-toggle="modal" data-bs-target="#modalKembalikan<?= htmlspecialchars($book['id_buku']); ?>">Kembalikan <i class="icon icon-ns-arrow-right"></i></a>
                                                </div>
                                                <div class="modal fade" id="modalKembalikan<?= htmlspecialchars($book['id_buku']); ?>" tabindex="-1" aria-labelledby="modalKembalikanLabel<?= htmlspecialchars($book['id_buku']); ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalKembalikanLabel<?= htmlspecialchars($book['id_buku']); ?>">Kembalikan Buku</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Anda yakin ingin mengembalikan buku <strong><?= htmlspecialchars($book['judul_buku']); ?></strong>?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <a href="function/kembalikan.php?id=<?= htmlspecialchars($book['id_buku']); ?>" class="btn btn-primary">Ya, Kembalikan</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div><!-- grid -->
                        </div><!-- product-list -->
                        <div id="Dikembalikan" data-tab-content>
                            <div class="row" id="returned-book-list">
                                <?php foreach ($buku_dikembalikan as $book) : ?>
                                    <div class="col-md-3">
                                        <div class="product-item">
                                            <figure class="product-style">
                                                <img src="<?= htmlspecialchars($book['img']); ?>" alt="Books" class="book-image">
                                            </figure>
                                            <figcaption>
                                                <h3><?= htmlspecialchars($book['judul_buku']); ?></h3>
                                                <span>Status: <?= htmlspecialchars($book['status']); ?></span>
                                                <span>Tanggal Pinjam: <?= htmlspecialchars($book['tanggal_pinjam']); ?></span>
                                                <p><span>Dikembalikan Pada <?= htmlspecialchars($book['tanggal_kembali']); ?></span></p>
                                            </figcaption>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div><!-- grid -->
                        </div><!-- returned-product-list -->
                    </div><!-- tab-content -->
                </div><!-- col-md-12 -->
            </div><!-- row -->
        </div><!-- container -->
    </section><!-- borrowed-books -->

    <?php include 'footer.php'; ?> <!-- Make sure the path to include the footer.php file is correct -->
</body>

</html>