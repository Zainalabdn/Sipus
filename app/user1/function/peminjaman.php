<?php
session_start();
include "../../../config/koneksi.php";

// Pastikan metode permintaan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form peminjaman
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $id_buku = $_POST['id_buku'];

    // Pastikan pengguna sudah login dan ambil id_user dari session
    if (isset($_SESSION['id_user'])) {
        $id_user = $_SESSION['id_user'];

        // Simpan data peminjaman ke dalam tabel peminjaman
        $stmt = $koneksi->prepare("INSERT INTO peminjaman (id_buku, id_user, tanggal_pinjam, tanggal_kembali, status) VALUES (?, ?, ?, ?, 'Dipinjam')");
        $stmt->bind_param("iiss", $id_buku, $id_user, $tanggal_pinjam, $tanggal_kembali);

        if ($stmt->execute()) {
            $successMessage = "Buku berhasil dipinjam!";
            $_SESSION['pinjam_berhasil'] = $successMessage;
        } else {
            $_SESSION['pinjam_gagal'] = "Gagal melakukan peminjaman.";
        }

        $stmt->close();
    } else {
        $_SESSION['pinjam_gagal'] = "Pengguna tidak terautentikasi.";
    }
} else {
    $_SESSION['pinjam_gagal'] = "Gagal melakukan peminjaman.";
}

// Redirect kembali ke halaman detail buku
header("Location: ../detailbuku.php?id=" . $id_buku);
exit();
?>
