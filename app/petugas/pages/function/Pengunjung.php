<?php
session_start();
include "../../../../config/koneksi.php";

// Define the $act variable using $_GET['act']
$act = isset($_GET['act']) ? $_GET['act'] : '';

if ($act == "tambah") {
    $id_user = $_POST['id_user'];
    $tanggalKunjungan = $_POST['tanggalKunjungan']; // Assuming tanggalKunjungan is sent as YYYY-MM-DD
    $waktuMasuk = $_POST['waktuMasuk'];
    $waktuKeluar = $_POST['waktuKeluar'];
    $keperluan = $_POST['keperluan'];

    $query = "INSERT INTO pengunjung (id_user, tanggal_kunjungan, waktu_masuk, waktu_keluar, keperluan) VALUES ('$id_user', '$tanggalKunjungan', '$waktuMasuk', '$waktuKeluar', '$keperluan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['berhasil'] = "Pengunjung berhasil ditambahkan!";
    } else {
        $_SESSION['gagal'] = "Pengunjung gagal ditambahkan!";
    }
    header("location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if ($act == 'edit') {
    $id_user = $_POST['id_user'];
    $tanggalKunjungan = $_POST['tanggalKunjungan']; // Assuming tanggalKunjungan is sent as YYYY-MM-DD
    $waktuMasuk = $_POST['waktuMasuk'];
    $waktuKeluar = $_POST['waktuKeluar'];
    $keperluan = $_POST['keperluan'];


    $query = "UPDATE pengunjung SET tanggal_kunjungan='$tanggalKunjungan', waktu_masuk='$waktuMasuk', waktu_keluar='$waktuKeluar', keperluan='$keperluan' WHERE id_user='$id_user'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['berhasil'] = "Data pengunjung berhasil diubah!";
    } else {
        $_SESSION['gagal'] = "Data pengunjung gagal diubah!";
    }
    header("location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if ($act == 'hapus') {
    $id_pengunjung = $_GET['id'];

    $query = "DELETE FROM pengunjung WHERE id_pengunjung='$id_pengunjung'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['berhasil'] = "Data pengunjung berhasil dihapus!";
    } else {
        $_SESSION['gagal'] = "Data pengunjung gagal dihapus!";
    }
    header("location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
