<!DOCTYPE html>
<html lang="en">

<?php @include('head.php');?>

<style>
    /* Styling for Contact Information section */
    #contact {
        background-color: #F3F2EC;
        padding: 80px 0;
    }

    .contact-info {
        margin-top: 30px;
    }

    .contact-info p {
        margin-bottom: 10px;
    }

    /* Styling for Map section */
    #map {
        padding: 80px 0;
    }

    .map-responsive {
        overflow: hidden;
        padding-bottom: 56.25%;
        position: relative;
        height: 0;
    }

    .map-responsive iframe {
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        position: absolute;
    }
</style>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

<?php @include('navbar.php');?>

<section id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="title-element text-center mb-5">
                    <h2 class="section-title divider">Contact Information</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="contact-info">
                    <p><strong>Address:</strong> 123 Main Street, City, Country</p>
                    <p><strong>Email:</strong> info@example.com</p>
                    <p><strong>Phone:</strong> +1 234 567 890</p>
                </div>
            </div>
            <div class="col-md-8">
                <!-- You can add additional contact information or content here -->
            </div>
        </div>
    </div>
</section>

<section id="map">
    <div class="container">
        <div class="row justify-content-center">
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
