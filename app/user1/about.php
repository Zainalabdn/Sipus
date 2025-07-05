<?php 
include "../../config/koneksi.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php @include('head.php');?>
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        #about-library {
            position: relative;
            width: 100%;
            min-height: 100vh;
            padding: 80px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            text-align: center;
        }

        .container, .row {
            height: 100%;
        }

        @media (max-width: 768px) {
            .app-info {
                padding: 30px 20px;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
        @media (max-width: 480px) {
            .section-title {
                font-size: 1.8rem;
            }
            
            .app-info p {
                font-size: 1rem;
            }
        }
    </style>
<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

<?php @include('navbar.php');?>
<hr>
<section id="about-library" class="leaf-pattern-overlay">
    <div class="corner-pattern-overlay"></div>
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-10">
                <div class="row justify-content-center">
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <div class="app-info text-center">
                            <h2 class="section-title divider">About Sipus</h2>
                            <p>
                                We provide a wide range of books and resources to support learning and exploration
                                for students and teachers alike. Our library is a hub of knowledge and creativity.
                            </p>
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
