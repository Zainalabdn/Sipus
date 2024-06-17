<?php
session_start();
include "../../../../config/koneksi.php";

if ($_GET['aksi'] == "tambah") {
    $kode_anggota = $_POST['kodeAnggota'];
    $nis = $_POST['nis'];
    $fullname = $_POST['namaLengkap'];
    $username = strtolower(addslashes($_POST['username']));
    $password = $_POST['password'];
    $kls = $_POST['kelas'];
    $jrs = isset($_POST['jurusan']) ? $_POST['jurusan'] : ''; // Check if 'jurusan' is set
    $kelas = $kls . $jrs;
    $alamat = $_POST['alamat'];
    $verif = "Tidak";
    $role = "Anggota";
    $join_date = date('d-m-Y');

    $stmt = $koneksi->prepare("INSERT INTO user (kode_user, nis, fullname, username, password, kelas, alamat, verif, role, join_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $kode_anggota, $nis, $fullname, $username, $password, $kelas, $alamat, $verif, $role, $join_date);
    
    if ($stmt->execute()) {
        $_SESSION['berhasil'] = "Anggota berhasil ditambahkan!";
    } else {
        $_SESSION['gagal'] = "Anggota gagal ditambahkan!";
    }
    $stmt->close();
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else if ($_GET['aksi'] == "edit") {

    $id_user = $_POST['idUser'];
    $nis = htmlspecialchars($_POST['nis']);
    $nama_lengkap = htmlspecialchars(addslashes($_POST['namaLengkap']));
    $username = htmlspecialchars(strtolower($_POST['uSername']));
    $password = htmlspecialchars(trim($_POST['pAssword']));
    $kelas = htmlspecialchars(addslashes($_POST['kElas']));
    $alamat = htmlspecialchars(addslashes($_POST['aLamat']));

    $stmt = $koneksi->prepare("UPDATE user SET nis = ?, fullname = ?, username = ?, password = ?, kelas = ?, alamat = ? WHERE id_user = ?");
    $stmt->bind_param("ssssssi", $nis, $nama_lengkap, $username, $password, $kelas, $alamat, $id_user);

    if ($stmt->execute()) {
        $_SESSION['berhasil'] = "Data anggota berhasil dirubah!";
    } else {
        $_SESSION['gagal'] = "Data anggota gagal dirubah!";
    }
    $stmt->close();
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else if ($_GET['aksi'] == "hapus") {
    $id_user = $_GET['id'];

    $stmt = $koneksi->prepare("DELETE FROM user WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);

    if ($stmt->execute()) {
        $_SESSION['berhasil'] = "Anggota berhasil di hapus!";
    } else {
        $_SESSION['gagal'] = "Anggota gagal di hapus!";
    }
    $stmt->close();
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>