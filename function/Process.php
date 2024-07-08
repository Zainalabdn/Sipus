<?php
session_start();
include "../config/koneksi.php";

if ($_GET['aksi'] == "masuk") {

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");

    $cek = mysqli_num_rows($data);

    if ($cek > 0) {
        $row = mysqli_fetch_assoc($data);

        if ($row['role'] == "Admin") {
            // Jika level user yang login adalah admin maka arahkan user ke halaman admin
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['status'] = "Login";
            $_SESSION['level'] = "Admin";

            // 
            date_default_timezone_set('Asia/Jakarta');

            $id_user = $_SESSION['id_user'];
            $tanggal = date('d-m-Y');
            $jam = date('H:i:s');

            $query = "UPDATE user SET terakhir_login = '$tanggal ( $jam )'";
            $query .= "WHERE id_user = $id_user";

            $sql = mysqli_query($koneksi, $query);

            header("location: ../admin");
        } elseif ($row['role'] == "Petugas") {
            // Jika level user yang login adalah petugas maka arahkan user ke halaman petugas
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['level'] = "Petugas";
            $_SESSION['status'] = "Login";

            date_default_timezone_set('Asia/Jakarta');

            $id_user = $_SESSION['id_user'];
            $tanggal = date('d-m-Y');
            $jam = date('H:i:s');

            $query = "UPDATE user SET terakhir_login = '$tanggal ( $jam )' WHERE id_user = $id_user";
            $sql = mysqli_query($koneksi, $query);

            header("location: ../petugas");
        }
        else if ($row['role'] == "Anggota") {
            // Jika level user yang login adalah user maka arahkan user kehalaman user
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['level'] = "Anggota";
            $_SESSION['status'] = "Login";

            // 
            date_default_timezone_set('Asia/Jakarta');

            $id_user = $_SESSION['id_user'];
            $tanggal = date('d-m-Y');
            $jam = date('H:i:s');

            $query = "UPDATE user SET terakhir_login = '$tanggal ( $jam )'";
            $query .= "WHERE id_user = $id_user";

            $sql = mysqli_query($koneksi, $query);

            header("location: ../user");
        } else {
            // JIka login gagal tampilkan sebuah pesan gagal login melalui session
            // Dan aktifkan session pada halaman login
            $_SESSION['user_tidak_terdaftar'] = "Maaf, User tidak terdaftar pada database !!";

            header("location: ../masuk");
        }
    } else {
        // JIka login gagal tampilkan sebuah pesan gagal login melalui session
        // Dan aktifkan session pada halaman login
        $_SESSION['gagal_login'] = "Nama Pengguna atau Kata Sandi salah !!";

        header("location: ../masuk");
    }
} elseif ($_GET['aksi'] == "daftar") {
    include "../config/koneksi.php";

    $fullname = $_POST['fullname'];
    $username = addslashes(strtolower($_POST['username']));
    $username1 = str_replace(' ', '', $username);
    $nis = $_POST['nis'];
    $notelp = $_POST['notelp'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $verif = "Tidak";
    $role = "Anggota";
    $join_date = date('d-m-Y');

    $query = mysqli_query($koneksi, "SELECT max(kode_user) as kodeTerakhir FROM user");
    $data = mysqli_fetch_array($query);
    $kodeTerakhir = $data['kodeTerakhir'];

    // Taking the last 3 digits of the max kode_user and converting to an integer
    $urutan = (int) substr($kodeTerakhir, 2, 3);

    // Incrementing the integer value to get the next user code
    $urutan++;

    // Forming the new user code
    $huruf = "AP";
    $Anggota = $huruf . sprintf("%03s", $urutan);

    $sql = "INSERT INTO user(kode_user, nis, fullname, username, notelp, email, password, kelas, alamat, verif, role, join_date)
            VALUES('$Anggota', '$nis', '$fullname', '$username1', '$notelp', '$email', '$password', '$kelas', '$alamat', '$verif', '$role', '$join_date')";
    
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        $_SESSION['berhasil'] = "Pendaftaran Berhasil!";
        header("location: ../masuk");
    } else {
        $_SESSION['gagal'] = "Pendaftaran Gagal!";
        header("location: ../daftar");
    }
}