<?php
session_start();
include "../config/koneksi.php";

// Query to fetch all books
$sql = "SELECT * FROM buku";
$result = mysqli_query($koneksi, $sql);

$books = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }
}

mysqli_close($koneksi);
?>
<!DOCTYPE html>
<html lang="en">

<?php @include('head.php');?>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

<?php @include('navbar.php');?>

<?php @include('billboard.php');?>

	<section id="client-holder" data-aos="fade-up">
		<div class="container">
			<div class="row">
				<div class="inner-content">
					<div class="logo-wrap">
						<div class="grid">
							<a><img src="../assets/home/images/client-image1.png" alt="client"></a>
							<a><img src="../assets/home/images/client-image2.png" alt="client"></a>
							<a><img src="../assets/home/images/client-image3.png" alt="client"></a>
							<a><img src="../assets/home/images/client-image4.png" alt="client"></a>
							<a><img src="../assets/home/images/client-image5.png" alt="client"></a>
						</div>
					</div><!--image-holder-->
				</div>
			</div>
		</div>
	</section>
	<?php @include('buku.php');?>

	<section id="quotation" class="align-center pb-5 mb-5">
		<div class="inner-content">
			<h2 class="section-title divider">Quote of the day</h2>
			<blockquote data-aos="fade-up">
				<q>Semakin banyak Anda membaca, semakin banyak hal yang Anda ketahui. Semakin banyak Anda belajar, semakin banyak tempat yang akan Anda kunjungi.</q>
				<div class="author-name">Dr. Seuss</div>
			</blockquote>
		</div>
	</section>




	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="footer-item">
						<div class="company-brand">
							<img src="../assets/img/Sipus.png" alt="logo" class="footer-logo" style="width:60%">
							<p></p>
						</div>
					</div>
				</div>

				<div class="col-md-2">
					<div class="footer-menu">
						<h5>About Us</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">About us</a>
							</li>
					</div>
				</div>

				<div class="col-md-2">
					<div class="footer-menu">
						<h5>Discover</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="home.php">Home</a>
							</li>
							<li class="menu-item">
								<a href="semuabuku.php">Books</a>
							</li>
					</div>

				</div>
				<div class="col-md-2">
					<div class="footer-menu">
						<h5>My account</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="../login.php">Sign In</a>
							</li>
					</div>
				</div>

				<div class="col-md-2">

					<div class="footer-menu">
						<h5>Help</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">Help center</a>
							</li>
							<li class="menu-item">
								<a href="contact.php">Contact us</a>
							</li>
						</ul>
					</div>

				</div>

			</div>
			<!-- / row -->

		</div>
	</footer>

	

	<script src="../assets/home/js/jquery-1.11.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
		crossorigin="anonymous"></script>
	<script src="../assets/home/js/plugins.js"></script>
	<script src="../assets/home/js/script.js"></script>

</body>

</html>