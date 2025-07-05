<?php
session_start();
include "../../../../config/koneksi.php";

if ($_GET['act'] == 'tambah') {
    // Retrieve form data
    $judul = $_POST['bookTitle'];
    $author = $_POST['bookAuthor'];
    $isbn = $_POST['bookIsbn'];
    $description = $_POST['bookDescription'];
    $publisher = $_POST['bookPublisher'];
    $published_date = $_POST['bookPublishedDate'];
    $categories = $_POST['bookCategories'];
    $gambar = $_POST['bookImage'];
    $average =  $_POST['bookAverageRating'];
    $language = $_POST['bookLanguage'];
    $jumlah_buku = '1';

    $stmt = $koneksi->prepare("INSERT INTO buku (judul_buku, kategori_buku, deskripsi, penerbit_buku, pengarang, tahun_terbit, isbn, jumlah_buku, averageRating, img, language)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($koneksi->error));
    }
    
    $stmt->bind_param('ssssssissss', $judul, $categories, $description, $publisher, $author, $published_date, $isbn, $jumlah_buku, $average, $gambar, $language);

    if ($stmt->execute()) {
        $_SESSION['berhasil'] = "Data buku berhasil Ditambakan!";
    } else {
        $_SESSION['gagal'] = "Data buku gagal Ditambakan!";
    }

    $stmt->close();

    $koneksi->close();
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} elseif($_GET['act'] == "edit") {
    $id_buku = $_POST['id_buku'];
    $judul_buku = $_POST['judulBuku'];
    $kategori_buku = $_POST['kategoriBuku'];
    $penerbit_buku = $_POST['penerbitBuku'];
    $pengarang = $_POST['pengarang'];
    $tahun_terbit = $_POST['tahunTerbit'];
    $isbn = $_POST['iSbn'];
    $deskripsi = $_POST['deskripsi']; 
    $jumlah_buku = $_POST['jumlahBuku'];
    $img = $_POST['img_lama']; 
    
    // Check if a new image file is uploaded
    if ($_FILES['img']['name'] != '') {
        $target_dir = "../../../../assets/img/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        
        // Attempt to upload the new image
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            $img = $target_file;
        } else {
            $_SESSION['gagal'] = "Image upload failed!";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } elseif (!empty($_POST['img_link'])) {
        // If no new file is uploaded, but a link is provided
        $img = $_POST['img_link'];
    }

    // Prepare the SQL query to update the book details
    if (!empty($img)) {
        // If a new image is uploaded or link is provided
        $stmt = $koneksi->prepare("UPDATE buku SET judul_buku=?, kategori_buku=?, penerbit_buku=?, pengarang=?, tahun_terbit=?, isbn=?, deskripsi=?, jumlah_buku=?, img=? WHERE id_buku=?");
        $stmt->bind_param("sssssssssi", $judul_buku, $kategori_buku, $penerbit_buku, $pengarang, $tahun_terbit, $isbn, $deskripsi, $jumlah_buku, $img, $id_buku);
    } else {
        // If no new image is uploaded or link is provided, exclude the image field
        $stmt = $koneksi->prepare("UPDATE buku SET judul_buku=?, kategori_buku=?, penerbit_buku=?, pengarang=?, tahun_terbit=?, isbn=?, deskripsi=?, jumlah_buku=? WHERE id_buku=?");
        $stmt->bind_param("ssssssssi", $judul_buku, $kategori_buku, $penerbit_buku, $pengarang, $tahun_terbit, $isbn, $deskripsi, $jumlah_buku, $id_buku);
    }

    // Execute the statement and check the result
    if ($stmt->execute()) {
        $_SESSION['berhasil'] = "Data buku berhasil diedit!";
    } else {
        $_SESSION['gagal'] = "Data buku gagal diedit: " . $stmt->error;
    }
    $stmt->close();
    $koneksi->close();

    // Redirect back to the previous page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
elseif ($_GET['act'] == "hapus") {
    $id_buku = $_GET['id'];

    // Prepare and bind parameters for delete
    $stmt = $koneksi->prepare("DELETE FROM buku WHERE id_buku=?");
    $stmt->bind_param("i", $id_buku);

    // Execute the statement and check the result
    if ($stmt->execute()) {
        $_SESSION['berhasil'] = "Data buku berhasil dihapus!";
    } else {
        $_SESSION['gagal'] = "Data buku gagal dihapus!";
    }
    $stmt->close();
    $koneksi->close();

    // Redirect back to the previous page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

?>





