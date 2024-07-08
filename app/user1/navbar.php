<?php
include "../../config/koneksi.php";
?>
<style>
    /* Style for the user account link */
    .user-account {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    /* Style for the dropdown menu */
    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        background-color: #F3F2EC;
        min-width: 200px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 9999;
    }

    /* Style for dropdown items */
    .dropdown-menu a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-menu a:hover {
        background-color: #C5A992;
    }

    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
</style>
<div id="header-wrap">
    <div class="top-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="social-links">
                        <ul>
                            <li>
                                <a><i class=""></i></a>
                            </li>
                            <li>
                                <a><i class=""></i></a>
                            </li>
                            <li>
                                <a><i class=""></i></a>
                            </li>
                            <li>
                                <a><i class=""></i></a>
                            </li>
                        </ul>
                    </div><!--social-links-->
                </div>
                <div class="col-md-6">
                    <div class="right-element">
                        
                        
                        <div class="overlay"></div>
                        <a href="#" class="user-account for-buy">
                            <i class="icon icon-user"></i>
                            <span><?= $_SESSION['fullname']; ?></span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="#">Profile</a>
                            <a href="#">Settings</a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </div><!--top-right-->
                </div>
            </div>
        </div>
    </div><!--top-content-->

    <header id="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="main-logo">
                    <h3 href="../index.html" class="outline-dark">E-Library</h3>
                    </div>
                </div>
                <div class="col-md-10">
                    <nav id="navbar">
                        <div class="main-menu stellarnav">
                            <ul class="menu-list">
                                <li class="menu-item"><a href="home.php" class="nav-link">Home</a></li>
                                <li class="menu-item has-sub">
                                    <a href="#pages" class="nav-link">Buku</a>
                                    <ul class="submenu">
                                        <li><a href="semuabuku.php" class="nav-link">List Buku</a></li>
                                        <li><a href="pinjam.php" class="nav-link">Buku Dipinjam</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item"><a href="contact.php" class="nav-link">Contact</a></li>
                                <li class="menu-item"><a href="about.php" class="nav-link">About</a></li>
                            </ul>
                            <div class="hamburger">
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</div><!--header-wrap-->

<!-- Include jQuery and Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js"></script>

<!-- Custom JavaScript to handle submenu -->
<script>
    $(document).ready(function() {
        $('.has-sub').hover(function() {
            $(this).children('.submenu').stop(true, true).slideDown(200);
        }, function() {
            $(this).children('.submenu').stop(true, true).slideUp(200);
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const userAccount = document.querySelector(".user-account");
        const dropdownMenu = document.querySelector(".dropdown-menu");

        userAccount.addEventListener("click", function(event) {
            event.preventDefault();
            dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
        });

        // Close the dropdown if the user clicks outside of it
        window.addEventListener("click", function(event) {
            if (!userAccount.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.style.display = "none";
            }
        });
    });
</script>
