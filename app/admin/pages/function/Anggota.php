<?php
session_start();
include "../../../../config/koneksi.php";


// Process the action based on $_GET['aksi']
if ($_GET['aksi'] == "tambah") {
    // Retrieve all necessary POST data
    $kode_user = $_POST['kodeAnggota'];
    $nis = $_POST['nis'];
    $fullname = $_POST['namaLengkap'];
    $username = strtolower(addslashes($_POST['username']));
    $password = $_POST['password'];
    $kls = $_POST['kelas'];
    $jrs = isset($_POST['jurusan']) ? $_POST['jurusan'] : '';
    $kelas = $kls . $jrs;
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $notelp = $_POST['notelp'];


    $verif = "Tidak";
    $role = "Anggota";
    $join_date = date('Y-m-d');

    // Prepare the SQL statement
    $stmt = $koneksi->prepare("INSERT INTO user (kode_user, nis, fullname, username, password, kelas, alamat, email, notelp, verif, role, join_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $kode_user, $nis, $fullname, $username, $password, $kelas, $alamat, $email, $notelp, $verif, $role, $join_date);
    
    // Execute the statement and check the result
    if ($stmt->execute()) {
        $_SESSION['berhasil'] = "Anggota berhasil ditambahkan!";
    } else {
        $_SESSION['gagal'] = "Anggota gagal ditambahkan!";
    }
    $stmt->close();
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else if ($_GET['aksi'] == "edit") {
    // Retrieve all necessary POST data
    $id_user = $_POST['idUser'];
    $nis = htmlspecialchars($_POST['nis']);
    $nama_lengkap = htmlspecialchars(addslashes($_POST['namaLengkap']));
    $username = htmlspecialchars(strtolower($_POST['uSername']));
    $password = htmlspecialchars(trim($_POST['pAssword']));
    $kelas = htmlspecialchars(addslashes($_POST['kElas']));
    $alamat = htmlspecialchars(addslashes($_POST['aLamat']));
    $email = $_POST['email'];
    $notelp = $_POST['notelp'];

    // Prepare and execute the SQL update statement
    $stmt = $koneksi->prepare("UPDATE user SET nis = ?, fullname = ?, username = ?, password = ?, kelas = ?, alamat = ?, email = ?, notelp = ? WHERE id_user = ?");
    $stmt->bind_param("ssssssssi", $nis, $nama_lengkap, $username, $password, $kelas, $alamat, $email, $notelp, $id_user);

    if ($stmt->execute()) {
        $_SESSION['berhasil'] = "Data anggota berhasil dirubah!";
    } else {
        $_SESSION['gagal'] = "Data anggota gagal dirubah!";
    }
    $stmt->close();
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else if ($_GET['aksi'] == "hapus") {
    // Handle delete action
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
