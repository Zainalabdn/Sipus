<?php
session_start();
include "../../../../config/koneksi.php";

$act = isset($_GET['act']) ? $_GET['act'] : '';

if ($act == "konfirmasipinjam" && isset($_GET['id'])) {
    $id_peminjaman = mysqli_real_escape_string($koneksi, $_GET['id']); // Escape input for security
    $query = "UPDATE peminjaman SET status = 'Dipinjam' WHERE id_peminjaman = '$id_peminjaman'";
    if (mysqli_query($koneksi, $query)) {
        // Update jumlah_buku in buku table (assuming buku_id is related to the peminjaman)
        $query_update_buku = "UPDATE buku SET jumlah_buku = jumlah_buku - 1 WHERE id_buku = (SELECT buku_id FROM peminjaman WHERE id_peminjaman = '$id_peminjaman')";
        mysqli_query($koneksi, $query_update_buku);

        $_SESSION['berhasil'] = "Peminjaman berhasil dikonfirmasi.";
    } else {
        $_SESSION['gagal'] = "Peminjaman gagal dikonfirmasi.";
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if ($act == "konfirmasikembali" && isset($_GET['id'])) {
    $id_peminjaman = mysqli_real_escape_string($koneksi, $_GET['id']); // Escape input for security

    // Retrieve the buku_id related to this peminjaman
    $query_buku_id = mysqli_query($koneksi, "SELECT id_buku FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'");
    $row_buku_id = mysqli_fetch_assoc($query_buku_id);
    $buku_id = $row_buku_id['id_buku'];

    // Retrieve the expected return date and calculate penalty if late
    $query_tanggal_kembali = mysqli_query($koneksi, "SELECT tanggal_kembali FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'");
    $row_tanggal_kembali = mysqli_fetch_assoc($query_tanggal_kembali);
    $tanggal_kembali = $row_tanggal_kembali['tanggal_kembali'];
    $today = date('Y-m-d');

    // Calculate penalty (denda) if return is late
    if ($today > $tanggal_kembali) {
        $tanggal_kembali_obj = new DateTime($tanggal_kembali);
        $today_obj = new DateTime($today);
        $late_days = $today_obj->diff($tanggal_kembali_obj)->days;
        $denda = $late_days * 1000; // 1000 for each late day
    } else {
        $denda = 0;
    }

    // Update status, denda, and jumlah_buku in peminjaman and buku tables
    $query_update_peminjaman = "UPDATE peminjaman SET status = 'Dikembalikan', denda = '$denda' WHERE id_peminjaman = '$id_peminjaman'";
    if (mysqli_query($koneksi, $query_update_peminjaman)) {
        // Update jumlah_buku in buku table
        $query_update_buku = "UPDATE buku SET jumlah_buku = jumlah_buku + 1 WHERE id_buku = '$buku_id'";
        mysqli_query($koneksi, $query_update_buku);

        if ($denda > 0) {
            $_SESSION['berhasil'] = "Pengembalian berhasil dikonfirmasi. Dikenakan denda sebesar Rp. " . number_format($denda, 0, ',', '.');
        } else {
            $_SESSION['berhasil'] = "Pengembalian berhasil dikonfirmasi.";
        }
    } else {
        $_SESSION['gagal'] = "Pengembalian gagal dikonfirmasi.";
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

?>
