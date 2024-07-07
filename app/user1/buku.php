<section id="featured-books" class="py-5 my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="section-header align-center">
                    <div class="title">
                        <span>Some quality items</span>
                    </div>
                    <h2 class="section-title">Buku Terbaru</h2>
                </div>
                <div class="product-list" data-aos="fade-up">
                    <div class="row">
                        <?php
                        include "../../config/koneksi.php";

                        // Fetch the latest 8 books
                        $query = "SELECT * FROM buku ORDER BY id_buku DESC LIMIT 8";
                        $result = $koneksi->query($query);

                        // Store the fetched books in an array
                        $books = [];
                        while ($row = $result->fetch_assoc()) {
                            $books[] = $row;
                        }

                        $koneksi->close();
                        ?>
                        <?php foreach ($books as $book) : ?>
                            <div class="col-md-3">
                                <div class="product-item">
                                    <figure class="product-style">
                                        <img src="<?= $book['img']; ?>" alt="<?= $book['judul_buku']; ?>" class="product-item">
                                        <a href="detailbuku.php?id=<?= $book['id_buku']; ?>" class="add-to-cart" data-product-tile="add-to-cart">
                                        <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Detail Buku</button></a>
                                    </figure>
                                    <figcaption>
                                        <h3><?= $book['judul_buku']; ?></h3>
                                        <span><?= $book['pengarang']; ?></span>
                                    </figcaption>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div><!--ft-books-slider-->
                </div><!--grid-->


            </div><!--inner-content-->
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="btn-wrap align-right">
                    <a href="semuabuku.php" class="btn-accent-arrow">Lihat Semua Buku<i class="icon icon-ns-arrow-right"></i></a>
                </div>

            </div>
        </div>
    </div>
</section>