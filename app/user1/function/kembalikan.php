<?php
session_start();
include "../../../config/koneksi.php";

// Pastikan metode permintaan adalah GET dan ada parameter id_buku yang diterima
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_buku = $_GET['id'];

    // Pastikan pengguna sudah login dan ambil id_user dari session
    if (isset($_SESSION['id_user'])) {
        $id_user = $_SESSION['id_user'];

        // Update status peminjaman menjadi "Dikembalikan"
        $stmt = $koneksi->prepare("UPDATE peminjaman SET status = 'Minta Dikembalikan' WHERE id_buku = ? AND id_user = ?");
        $stmt->bind_param("ii", $id_buku, $id_user);

        if ($stmt->execute()) {
            $successMessage = "Buku berhasil dikembalikan!";
            $_SESSION['kembali_berhasil'] = $successMessage;
        } else {
            $_SESSION['kembali_gagal'] = "Gagal melakukan pengembalian buku.";
        }

        $stmt->close();
    } else {
        $_SESSION['kembali_gagal'] = "Pengguna tidak terautentikasi.";
    }
} else {
    $_SESSION['kembali_gagal'] = "Gagal melakukan pengembalian buku.";
}

// Redirect kembali ke halaman detail buku
header("Location: ../pinjam.php?id=");
exit();
?>
