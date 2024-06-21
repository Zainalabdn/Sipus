<?php
session_start();
include '../../../../config/koneksi.php'; // Adjust this path as per your file structure

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $judul = $_POST['bookTitle'];
    $author = $_POST['bookAuthor'];
    $isbn = $_POST['bookIsbn'];
    $description = $_POST['bookDescription'];
    $publisher = $_POST['bookPublisher'];
    $published_date = $_POST['bookPublishedDate'];
    $categories = $_POST['bookCategories'];

    // File upload handling
    $target_dir = "../uploads/";
    $gambar = basename($_FILES["book-image"]["name"]);
    $target_file = $target_dir . $gambar;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        $filename_parts = pathinfo($gambar);
        $counter = 1;
        do {
            $new_filename = $filename_parts['filename'] . '_' . $counter . '.' . $filename_parts['extension'];
            $target_file = $target_dir . $new_filename;
            $counter++;
        } while (file_exists($target_file));
        $gambar = $new_filename;
    }

    // Check file size
    if ($_FILES["book-image"]["size"] > 500000) {
        echo "File terlalu besar.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Gagal mengunggah gambar.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["book-image"]["tmp_name"], $target_file)) {
            echo "Gambar berhasil diunggah sebagai: " . htmlspecialchars($gambar);
        } else {
            echo "Ada kesalahan saat mengunggah gambar.";
            exit();
        }
    }

    // Insert data into database if file upload is successful
    if ($uploadOk == 1) {
        $stmt = $koneksi->prepare("INSERT INTO books (judul, author, isbn, description, publisher, published_date, categories, image, user_nama) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $judul, $author, $isbn, $description, $publisher, $published_date, $categories, $gambar, $user_nama);

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
