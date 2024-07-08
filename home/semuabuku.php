<?php
include "../config/koneksi.php";

// Fetch all genres from the kategori table
$genreQuery = "SELECT * FROM kategori";
$genreResult = $koneksi->query($genreQuery);
?>
<!DOCTYPE html>
<html lang="en">
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
                        <h2 class="section-title">Koleksi Buku</h2>
                    </div>
                    <ul class="tabs">
                        <li data-tab-target="#all-genre" class="active tab">Semua Kategori</li>
                        <?php while ($genre = $genreResult->fetch_assoc()) : ?>
                            <li data-tab-target="#<?= strtolower($genre['nama_kategori']); ?>" class="tab"><?= $genre['nama_kategori']; ?></li>
                        <?php endwhile; ?>
                    </ul>

                    <div class="tab-content">
                        <div class="row height d-flex justify-content-center align-items-center">
                            <div class="col-md-6">
                                <div class="action-menu">
                                    <input type="text" class="form-control form-input" placeholder="Search..." id="searchInput">
                                </div>
                            </div>
                        </div>
                        <div id="searchResults"></div>
                        <div id="all-genre" data-tab-content class="active">
                            <div class="row" id="book-list">
                                <?php
                                $query = "SELECT * FROM buku";
                                $result = $koneksi->query($query);
                                while ($book = $result->fetch_assoc()) : ?>
                                    <div class="col-md-3">
                                        <div class="product-item">
                                            <figure class="product-style">
                                                <img src="<?= $book['img']; ?>" alt="Books" class="product-item">
                                                <a href="detailbuku.php?id=<?= $book['id_buku']; ?>" class="add-to-cart" data-product-tile="add-to-cart">
                                                    <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Detail Buku</button></a>
                                            </figure>
                                            <figcaption>
                                                <h3><?= $book['judul_buku']; ?></h3>
                                                <span><?= $book['pengarang']; ?></span>
                                            </figcaption>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <?php
                        $genreResult->data_seek(0); // Reset genre result set
                        while ($genre = $genreResult->fetch_assoc()) : ?>
                            <div id="<?= strtolower($genre['nama_kategori']); ?>" data-tab-content>
                                <div class="row">
                                    <?php
                                    $query = "SELECT * FROM buku WHERE kategori_buku = '" . $genre['nama_kategori'] . "'";
                                    $result = $koneksi->query($query);
                                    while ($book = $result->fetch_assoc()) : ?>
                                        <div class="col-md-3">
                                            <div class="product-item">
                                                <figure class="product-style">
                                                    <img src="<?= $book['img']; ?>" alt="Books" class="product-item">
                                                    <a href="detailbuku.php?id=<?= $book['id_buku']; ?>" class="add-to-cart" data-product-tile="add-to-cart">
                                                        <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Detail Buku</button></a>
                                                </figure>
                                                <figcaption>
                                                    <h3><?= $book['judul_buku']; ?></h3>
                                                    <span><?= $book['pengarang']; ?></span>
                                                </figcaption>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php @include('footer.php'); ?>

    <script src="../assets/home/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../assets/home/js/plugins.js"></script>
    <script src="../assets/home/js/script.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: 'search_books.php',
                        method: 'GET',
                        data: { search: query },
                        success: function(data) {
                            var books = JSON.parse(data);
                            var bookList = $('#book-list');
                            bookList.empty();
                            books.forEach(function(book) {
                                var bookItem = '<div class="col-md-3">' +
                                    '<div class="product-item">' +
                                    '<figure class="product-style">' +
                                    '<img src="' + book.img + '" alt="Books" class="product-item">' +
                                    '<a href="detailbuku.php?id=' + book.id_buku + '" class="add-to-cart" data-product-tile="add-to-cart">' +
                                    '<button type="button" class="add-to-cart" data-product-tile="add-to-cart">Detail Buku</button></a>' +
                                    '</figure>' +
                                    '<figcaption>' +
                                    '<h3>' + book.judul_buku + '</h3>' +
                                    '<span>' + book.pengarang + '</span>' +
                                    '</figcaption>' +
                                    '</div>' +
                                    '</div>';
                                bookList.append(bookItem);
                            });
                        }
                    });
                } else {
                    $('#searchResults').html('');
                }
            });
        });
    </script>

</body>
</html>
