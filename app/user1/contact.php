<!DOCTYPE html>
<html lang="en">

<head>
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

        /* Styling for section title divider */
        .section-title {
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 2px;
            background: #000;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

    <?php @include('navbar.php');?>

    <section id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="title-element text-center mb-5">
                        <h2 class="section-title">Contact Information</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="contact-info">
                        <p><strong>Address:</strong> Jl. Ring Road Utara, Ngringin, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281</p>
                        <p><strong>Email:</strong> admin@gmail.com</p>
                        <p><strong>Phone:</strong> +62 8234 5678 900</p>
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
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.7219020200245!2d110.392152276491!3d-7.763057744324027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a597a7b6d3a2f%3A0xc8cf0fa3b3d7d6eb!2sJl.%20Ring%20Road%20Utara%2C%20Ngringin%2C%20Condongcatur%2C%20Kec.%20Depok%2C%20Kabupaten%20Sleman%2C%20Daerah%20Istimewa%20Yogyakarta%2055281!5e0!3m2!1sen!2sid!4v1688572618769!5m2!1sen!2sid"
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../assets/home/js/plugins.js"></script>
    <script src="../assets/home/js/script.js"></script>
    
</body>

</html>
