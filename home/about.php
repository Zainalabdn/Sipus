<?php 
include "../config/koneksi.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php @include('head.php');?>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

<?php @include('navbar.php');?>
<hr>
<section id="about-library" class="leaf-pattern-overlay">
    <div class="corner-pattern-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-5">
                        <figure>
                            <img src="../assets/home/images/1.jpg" alt="library" class="single-image" style="width: 100%; max-width: 1000px;">
							<img src="../assets/home/images/2.jpg" alt="library" class="single-image" style="width: 100%; max-width: 1000px;">
                        </figure>
                    </div>

                    <div class="col-md-5">
                        <div class="app-info">
                            <h2 class="section-title divider">About Our School Library</h2>
                            <p>Welcome to our school library! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sed ptibus
                                liberolectus nonet psryroin. Amet sed lorem posuere sit iaculis amet, ac urna.
                                Adipiscing fames semper erat ac in suspendisse iaculis.</p>
                            <p>We provide a wide range of books and resources to support learning and exploration for students and teachers alike. Our library is a hub of knowledge and creativity.</p>
                            <p>Visit us today and explore the world of books!</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php @include('footer.php'); ?>
    
<script src="../assets/home/js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
<script src="../assets/home/js/plugins.js"></script>
<script src="../assets/home/js/script.js"></script>

</body>

</html>
