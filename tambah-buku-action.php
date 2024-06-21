<?php
session_start();
include './config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // File upload handling
    $targetDirectory = "./uploads/"; // Specify the directory where you want to store uploaded images
    $targetFile = $targetDirectory . basename($_FILES["bookImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["bookImage"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["bookImage"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["bookImage"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["bookImage"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Process other form data if file upload is successful
    if ($uploadOk == 1) {
        $judul = $_POST['bookTitle'];
        $author = $_POST['bookAuthor'];
        $isbn = $_POST['bookIsbn'];
        $description = $_POST['bookDescription'];
        $publisher = $_POST['bookPublisher'];
        $published_date = $_POST['bookPublishedDate'];
        $categories = $_POST['bookCategories'];
        $gambar = basename($_FILES["bookImage"]["name"]); // Use the uploaded file name

        $stmt = $koneksi->prepare("INSERT INTO buku (judul_buku, pengarang, isbn, deskripsi, penerbit_buku, tahun_terbit, kategori_buku, img) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $judul, $author, $isbn, $description, $publisher, $published_date, $categories, $gambar);

        if ($stmt->execute()) {
            echo "Buku berhasil ditambahkan.";
            header("Location: ../table-books.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $koneksi->close();
}
?>
