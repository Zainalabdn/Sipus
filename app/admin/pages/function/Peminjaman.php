<?php
session_start();
include "../../../../config/koneksi.php";

$act = isset($_GET['act']) ? $_GET['act'] : '';

if ($act == "konfirmasi" && isset($_GET['id'])) {
    $id_peminjaman = mysqli_real_escape_string($koneksi, $_GET['id']); // Escape input for security
    $query = "UPDATE peminjaman SET status = 'Dipinjam' WHERE id_peminjaman = '$id_peminjaman'";
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['berhasil'] = "Peminjaman berhasil dikonfirmasi.";
    } else {
        $_SESSION['gagal'] = "Peminjaman gagal dikonfirmasi.";
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if ($act == "tolak" && isset($_GET['id'])) {
    $id_peminjaman = mysqli_real_escape_string($koneksi, $_GET['id']); // Escape input for security
    $query = "UPDATE peminjaman SET status = 'Ditolak' WHERE id_peminjaman = '$id_peminjaman'";
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['berhasil'] = "Peminjaman berhasil ditolak.";
    } else {
        $_SESSION['gagal'] = "Peminjaman gagal ditolak.";
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

?>
