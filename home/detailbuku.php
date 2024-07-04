<?php
include "../config/koneksi.php";

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
    $koneksi->close();
} else {
    echo "Invalid request.";
    exit();
}
$total_books = $book['j_buku_baik'] + $book['j_buku_rusak'];
?>
<!DOCTYPE html>
<html lang="en">

<?php @include('head.php'); ?>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

    <?php @include('navbar.php'); ?>
    <section id="best-selling" class="leaf-pattern-overlay">
        <div class="corner-pattern-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-8">

                    <div class="row">

                        <div class="col-md-6">
                            <figure class="products-thumb">
                                <img src="<?= $book['img']; ?>" alt="book" class="single-image">
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <div class="product-entry">
                            <div class="author-name"><?= $book['kategori_buku']; ?></div>
                                <h2 class="section-title divider"><?= $book['judul_buku']; ?></h2>

                                <div class="products-content">
                                    <div class="author-name"><?= $book['pengarang']; ?></div>
                                    <h3 class="item-title"><?= $book['tahun_terbit']; ?></h3>
                                    <p><?= $book['deskripsi']; ?></p>
                                    <div class="item-price">Tersedia: <?= $total_books; ?></div>
                                    <div class="btn-wrap">
                                        <a href="#" class="btn-accent-arrow">Pinjam<i class="icon icon-ns-arrow-right"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- / row -->

                </div>

            </div>
        </div>
    </section>

    <?php @include('footer.php'); ?>

    <script src="../assets/home/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../assets/home/js/plugins.js"></script>
    <script src="../assets/home/js/script.js"></script>

</body>

</html>