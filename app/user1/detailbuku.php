<?php
session_start();
include "../../config/koneksi.php";

    

if (isset($_GET['id'])) {
    $id_buku = intval($_GET['id']);
    $stmt = $koneksi->prepare("SELECT * FROM buku WHERE id_buku = ?");
    $stmt->bind_param("i", $id_buku);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Book not found.";
        exit();
    }

    $stmt->close();
} else {
    echo "Invalid request.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku: <?= $book['judul_buku']; ?></title>
    <style>
        .book-image {
            width: 100%;
            max-width: 350px;
            height: auto;
            object-fit: cover;
        }
    </style>
    <?php @include('head.php'); ?>
</head>

<body>
    <?php @include('navbar.php'); ?>

    <section id="best-selling" class="leaf-pattern-overlay">
        <div class="corner-pattern-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <figure class="products-thumb">
                                <img src="<?= $book['img']; ?>" alt="book" class="single-image book-image">
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <div class="product-entry">
                                <div class="author-name"><?= $book['kategori_buku']; ?></div>
                                <h2 class="item-title"><?= $book['judul_buku']; ?></h2>
                                <div class="products-content">
                                    <div class="author-name"><?= $book['pengarang']; ?></div>
                                    <h3 class="item-title"><?= $book['tahun_terbit']; ?></h3>
                                    <p><?= $book['deskripsi']; ?></p>
                                    <div class="item-price">Tersedia: <?= $book['jumlah_buku']; ?></div>
                                    <div class="btn-wrap">
                                        <a href="#" class="btn-accent-arrow pinjam-btn" data-bs-toggle="modal"
                                            data-bs-target="#modalPinjam"
                                            data-book-id="<?= $book['id_buku']; ?>">Pinjam<i
                                                class="icon icon-ns-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php @include('footer.php'); ?>

    <!-- Modal -->
    <div class="modal fade" id="modalPinjam" tabindex="-1" aria-labelledby="modalPinjamLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPinjamLabel">Form Peminjaman Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPinjam" action="function/peminjaman.php" method="POST">
                        <div class="mb-3">
                            <label for="tanggalPinjam" class="form-label">Tanggal Pinjam</label>
                            <input type="date" class="form-control" id="tanggalPinjam" name="tanggal_pinjam" value="" onchange="hitungTanggalKembali()" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggalKembali" class="form-label">Tanggal Kembali</label>
                            <input type="teks" class="form-control" id="tanggalKembali" name="tanggal_kembali" value="" required readonly>
                        </div>
                        <input type="hidden" id="idBuku" name="id_buku" value="<?= $book['id_buku']; ?>">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function hitungTanggalKembali() {
            var tanggalPinjam = document.getElementById("tanggalPinjam").value;
            if (tanggalPinjam) {
                var tanggal = new Date(tanggalPinjam);
                tanggal.setDate(tanggal.getDate() + 7);
                var dd = String(tanggal.getDate()).padStart(2, '0');
                var mm = String(tanggal.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = tanggal.getFullYear();
                
                var tanggalKembali = yyyy + '-' + mm + '-' + dd;
                document.getElementById("tanggalKembali").value = tanggalKembali;
            }
        }
    </script>


    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Show SweetAlert based on session messages
        <?php
        if (isset($_SESSION['pinjam_berhasil']) && $_SESSION['pinjam_berhasil'] != '') {
            echo "Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '" . $_SESSION['pinjam_berhasil'] . "',
                showConfirmButton: false,
                timer: 3000
            });";
            $_SESSION['pinjam_berhasil'] = '';
        }

        if (isset($_SESSION['pinjam_gagal']) && $_SESSION['pinjam_gagal'] != '') {
            echo "Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '" . $_SESSION['pinjam_gagal'] . "',
                showConfirmButton: false,
                timer: 3000
            });";
            $_SESSION['pinjam_gagal'] = '';
        }
        ?>
    </script>

    <script src="../../assets/home/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="../../assets/home/js/plugins.js"></script>
    <script src="../../assets/home/js/script.js"></script>
</body>

</html>
