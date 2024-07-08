<?php
include "../config/koneksi.php";

$stmt = $koneksi->prepare("SELECT * FROM buku ORDER BY id_buku DESC LIMIT 2");
$stmt->execute();
$result = $stmt->get_result();

$books = [];
while ($row = $result->fetch_assoc()) {
	$books[] = $row;
}

$stmt->close();
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<section id="billboard">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<button class="prev slick-arrow">
					<i class="icon icon-arrow-left"></i>
				</button>

				<div class="main-slider pattern-overlay">
					<?php foreach ($books as $book) : ?>
						<div class="slider-item">
							<div class="banner-content">
								<h2 class="banner-title"><?= $book['judul_buku']; ?></h2>
								<p><?= substr($book['deskripsi'], 0, 50); ?><?= strlen($book['deskripsi']) > 200 ? "..." : ""; ?></p>
								<div class="btn-wrap">
									<a href="detailbuku.php?id=<?= $book['id_buku']; ?>" class="btn btn-outline-accent btn-accent-arrow">Read More<i class="icon icon-ns-arrow-right"></i></a>
								</div>
							</div><!--banner-content-->
							<img src="<?= $book['img']; ?>" alt="<?= $book['judul_buku']; ?>" class="banner-image img-fluid w-25">
						</div><!--slider-item-->
					<?php endforeach; ?>
				</div><!--slider-->
				<button class="next slick-arrow">
					<i class="icon icon-arrow-right"></i>
				</button>
			</div>
		</div>
	</div>
</section>
</body>

</html>