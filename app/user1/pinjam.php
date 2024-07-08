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

// Query untuk mengambil data buku yang sudah dipinjam 
$queryDipinjam = "SELECT b.id_buku, b.judul_buku, b.pengarang, b.img, p.tanggal_pinjam, p.tanggal_kembali, p.status
                  FROM buku b
                  INNER JOIN peminjaman p ON b.id_buku = p.id_buku
                  WHERE p.id_user = $id_user AND p.status = 'Dipinjam'";
$resultDipinjam = $koneksi->query($queryDipinjam);

// Query untuk mengambil data buku yang sudah dikembalikan
$queryDikembalikan = "SELECT b.id_buku, b.judul_buku, b.pengarang, b.img, p.tanggal_pinjam, p.tanggal_kembali, p.status, p.denda
                      FROM buku b
                      INNER JOIN peminjaman p ON b.id_buku = p.id_buku
                      WHERE p.id_user = $id_user AND p.status = 'Dikembalikan'";
$resultDikembalikan = $koneksi->query($queryDikembalikan);

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
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>

                        <div id="Dikembalikan" data-tab-content>
                            <div class="row" id="book-list">
                                <?php while ($book = $resultDikembalikan->fetch_assoc()) : ?>
                                    <div class="col-md-3">
                                        <div class="product-item">
                                            <figure class="product-style">
                                                <img src="<?= $book['img']; ?>" alt="Books" class="product-item">
                                                <a href="detailbuku.php?id=<?= $book['id_buku']; ?>" class="add-to-cart" data-product-tile="add-to-cart">
                                                    <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Detail Buku</button></a>
                                            </figure>
                                            <figcaption>
                                                <h3><?= $book['judul_buku']; ?></h3>
                                                <span>Status: <?= $book['status']; ?></span>
                                                <p><span>Tanggal Pinjam: <?= $book['tanggal_pinjam']; ?></span></p>
                                                <p><span>Tanggal Kembali: <?= $book['tanggal_kembali']; ?></span></p>
                                                <p><span>Denda : <?= $book['denda']; ?></span></p>
                                            </figcaption>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>

                </div><!--inner-tabs-->

            </div>
        </div>
    </section>

    <?php @include('footer.php'); ?>

    <script src="../../assets/home/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../../assets/home/js/plugins.js"></script>
    <script src="../../assets/home/js/script.js"></script>
    <script>
        $(document).ready(function() {
            // Mengatur fungsi tab
            $('.tabs li').click(function() {
                var tab_id = $(this).attr('data-tab-target');

                // Menghapus kelas active dari semua tab
                $('.tabs li').removeClass('active');
                $('.tab-content').removeClass('active');

                // Menambahkan kelas active ke tab yang dipilih
                $(this).addClass('active');
                $(tab_id).addClass('active');
            });
        });
    </script>

</body>

</html>