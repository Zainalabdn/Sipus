<?php
session_start();
include "../../../../config/koneksi.php";

if ($_GET['act'] == "tambah") {
    // Fetching form data
    $judul_buku = $_POST['judulBuku'];
    $kategori_buku = $_POST['kategoriBuku'];
    $penerbit_buku = $_POST['penerbitBuku'];
    $pengarang = $_POST['pengarang'];
    $tahun_terbit = $_POST['tahunTerbit'];
    $isbn = $_POST['iSbn'];
    $deskripsi = $_POST['deskripsi']; 
    $j_buku_baik = $_POST['jumlahBukuBaik'];
    $j_buku_rusak = $_POST['jumlahBukuRusak'];
    $img = '';
    
    // Image upload handling
    if ($_FILES['img']['name'] != '') {
        $target_dir = "../../../../assets/img/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
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

    
    // Prepare and bind parameters for insertion
    $stmt = $koneksi->prepare("INSERT INTO buku (judul_buku, kategori_buku, penerbit_buku, pengarang, tahun_terbit, isbn, deskripsi, j_buku_baik, j_buku_rusak, img) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $judul_buku, $kategori_buku, $penerbit_buku, $pengarang, $tahun_terbit, $isbn, $deskripsi, $j_buku_baik, $j_buku_rusak, $img);

    // Execute the statement and check the result
    if ($stmt->execute()) {
        $_SESSION['berhasil'] = "Buku berhasil ditambahkan!";
    } else {
        $_SESSION['gagal'] = "Buku gagal ditambahkan!";
    }
    $stmt->close();
    $koneksi->close();

    // Redirect back to the previous page
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
    $j_buku_baik = $_POST['jumlahBukuBaik'];
    $j_buku_rusak = $_POST['jumlahBukuRusak'];
    $img = $_POST['img_lama']; // Default to the existing image if not updated

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
        $stmt = $koneksi->prepare("UPDATE buku SET judul_buku=?, kategori_buku=?, penerbit_buku=?, pengarang=?, tahun_terbit=?, isbn=?, deskripsi=?, j_buku_baik=?, j_buku_rusak=?, img=? WHERE id_buku=?");
        $stmt->bind_param("ssssssssssi", $judul_buku, $kategori_buku, $penerbit_buku, $pengarang, $tahun_terbit, $isbn, $deskripsi, $j_buku_baik, $j_buku_rusak, $img, $id_buku);
    } else {
        // If no new image is uploaded or link is provided, exclude the image field
        $stmt = $koneksi->prepare("UPDATE buku SET judul_buku=?, kategori_buku=?, penerbit_buku=?, pengarang=?, tahun_terbit=?, isbn=?, deskripsi=?, j_buku_baik=?, j_buku_rusak=? WHERE id_buku=?");
        $stmt->bind_param("sssssssssi", $judul_buku, $kategori_buku, $penerbit_buku, $pengarang, $tahun_terbit, $isbn, $deskripsi, $j_buku_baik, $j_buku_rusak, $id_buku);
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
} elseif ($_GET['act'] == "hapus") {
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
