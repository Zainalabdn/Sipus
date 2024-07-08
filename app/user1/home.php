<?php
session_start();
if ($_SESSION['level'] != "Anggota") {
    $_SESSION['masuk_dulu'] = "Silahkan masuk terlebih dahulu !!";
    header("location: ../../masuk");
}
?>

<!DOCTYPE html>
<html lang="en">

<?php @include('head.php'); ?>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">
	
		<?php @include('navbar.php'); ?>

		<?php @include('billboard.php'); ?>

		<section id="client-holder" data-aos="fade-up">
			<div class="container">
				<div class="row">
					<div class="inner-content">
						<div class="logo-wrap">
							<div class="grid">
								<a><img src="../../assets/home/images/client-image1.png" alt="client"></a>
								<a><img src="../../assets/home/images/client-image2.png" alt="client"></a>
								<a><img src="../../assets/home/images/client-image3.png" alt="client"></a>
								<a><img src="../../assets/home/images/client-image4.png" alt="client"></a>
								<a><img src="../../assets/home/images/client-image5.png" alt="client"></a>
							</div>
						</div><!--image-holder-->
					</div>
				</div>
			</div>
		</section>

		<?php @include('buku.php'); ?>

		<section id="quotation" class="align-center pb-5 mb-5">
			<div class="inner-content">
				<h2 class="section-title divider">Quote of the day</h2>
				<blockquote data-aos="fade-up">
					<q>“The more that you read, the more things you will know. The more that you learn, the more places
						you’ll go.”</q>
					<div class="author-name">Dr. Seuss</div>
				</blockquote>
			</div>
		</section>

		<!-- Peminjaman Modal -->
		<div class="modal fade" id="peminjamanModal" tabindex="-1" aria-labelledby="peminjamanModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="peminjamanModalLabel">Peminjaman Buku</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="peminjamanForm">
							<div class="mb-3">
								<label for="bookId" class="form-label">Book ID</label>
								<input type="text" class="form-control" id="bookId" name="bookId" required>
							</div>
							<div class="mb-3">
								<label for="borrowerName" class="form-label">Borrower Name</label>
								<input type="text" class="form-control" id="borrowerName" name="borrowerName" required>
							</div>
							<div class="mb-3">
								<label for="borrowDate" class="form-label">Borrow Date</label>
								<input type="date" class="form-control" id="borrowDate" name="borrowDate" required>
							</div>
							<div class="mb-3">
								<label for="returnDate" class="form-label">Return Date</label>
								<input type="date" class="form-control" id="returnDate" name="returnDate" required>
							</div>
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php @include('footer.php'); ?>

		<!-- Bootstrap CSS -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
		<!-- Bootstrap JS and dependencies -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function() {
				$('#peminjamanForm').on('submit', function(e) {
					e.preventDefault();

					// Serialize the form data
					var formData = $(this).serialize();

					// AJAX request
					$.ajax({
						type: 'POST',
						url: 'path_to_your_php_handler.php', // Update with your PHP file path
						data: formData,
						success: function(response) {
							// Handle success
							alert('Peminjaman successful!');
							$('#peminjamanModal').modal('hide');
						},
						error: function() {
							// Handle error
							alert('Peminjaman failed!');
						}
					});
				});
			});
		</script>
</body>

</html>