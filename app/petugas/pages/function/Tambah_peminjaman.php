<?php
// Pastikan file ini hanya diakses melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include koneksi ke database
    include "../../../../config/koneksi.php";

    // Ambil data dari form
    $id_buku = $_POST['judul_buku']; // Ini adalah id_buku dari dropdown
    $id_user = $_POST['id_user']; // Ini adalah id_user dari dropdown
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $status = 'Dipinjam'; // Set status default

    // Query untuk menyimpan data peminjaman
    $query = "INSERT INTO peminjaman (id_buku, id_user, tanggal_pinjam, tanggal_kembali, status) 
              VALUES ('$id_buku', '$id_user', '$tanggal_pinjam', '$tanggal_kembali', '$status')";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil disimpan, arahkan kembali ke halaman sebelumnya atau halaman sukses
        header("location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Jika ada error saat menyimpan
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi database
    mysqli_close($koneksi);
}
?>
