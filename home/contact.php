<!DOCTYPE html>
<html lang="en">

<?php @include('head.php');?>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

<?php @include('navbar.php');?>
    <section id="subscribe">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <div class="row">

                        <div class="col-md-6">

                            <div class="title-element">
                                <h2 class="section-title divider">Subscribe to our newsletter</h2>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="subscribe-content" data-aos="fade-up">
                                <p>Sed eu feugiat amet, libero ipsum enim pharetra hac dolor sit amet, consectetur. Elit
                                    adipiscing enim pharetra hac.</p>
                                <form id="form" action="subscribe.php" method="POST">
                                    <input type="text" name="email" placeholder="Enter your email address here">
                                    <button class="btn-subscribe">
                                        <span>send</span>
                                        <i class="icon icon-send"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <div class="map-responsive">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.001454128012!2d144.9537363153171!3d-37.816279379751664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf577c8f4fd8e6c34!2sFederation%20Square!5e0!3m2!1sen!2sau!4v1627463373702!5m2!1sen!2sau" 
                            width="600" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
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
