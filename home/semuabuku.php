<?php
include "../config/koneksi.php";

// Fetch all books from the database
$search = '';
$query = "SELECT * FROM buku";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM buku WHERE judul_buku LIKE '%$search%' OR pengarang LIKE '%$search%'";
}
$result = $koneksi->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<style>

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
                        <h2 class="section-title">Koleksi Buku</h2>
                    </div>
                    <ul class="tabs">
                        <li data-tab-target="#all-genre" class="active tab">All Genre</li>
                        <li data-tab-target="#business" class="tab">Business</li>
                        <li data-tab-target="#technology" class="tab">Technology</li>
                        <li data-tab-target="#romantic" class="tab">Romantic</li>
                        <li data-tab-target="#adventure" class="tab">Adventure</li>
                        <li data-tab-target="#fictional" class="tab">Fictional</li>
                    </ul>

                    <div class="tab-content">
                        <div class="row height d-flex justify-content-center align-items-center">
                            <div class="col-md-6">
                                <div class="action-menu">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="search" id="search-input" class="form-control form-input" placeholder="Search...">
                                </div>
                            </div>
                        </div>
                        <div id="all-genre" data-tab-content class="active">
                            <div class="row" id="book-list">
                                <?php while ($book = $result->fetch_assoc()) : ?>
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

                    </div>

                </div><!--inner-tabs-->

            </div>
        </div>
    </section>

    <?php @include('footer.php'); ?>

    <script src="../assets/home/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../assets/home/js/plugins.js"></script>
    <script src="../assets/home/js/script.js"></script>
    <script>
        document.getElementById('search-input').addEventListener('input', function() {
            var searchQuery = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'search_books.php?search=' + searchQuery, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var books = JSON.parse(xhr.responseText);
                    var bookList = document.getElementById('book-list');
                    bookList.innerHTML = '';
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
                        bookList.insertAdjacentHTML('beforeend', bookItem);
                    });
                }
            };
            xhr.send();
        });
    </script>

</body>

</html>
