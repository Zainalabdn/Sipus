<?php
include "../../../../config/koneksi.php";

if ($_GET['aksi'] == "tanggal_pinjam") {
    $tanggal_pinjam = $_POST['tanggal_pinjam'];

    // Header HTML
    echo "<html>";
    echo "<head>";
    echo "<title>Laporan Perpustakaan - Tanggal Peminjaman</title>";
    echo "<link rel='stylesheet' href='../../../../assets/dist/css/custom.css'>";
    echo "<link rel='stylesheet' href='../../../../assets/bower_components/bootstrap/dist/css/bootstrap.min.css'>";
    echo "<link rel='stylesheet' href='../../../../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'>";
    echo "<link rel='icon' type='icon' href='../../../../assets/dist/img/logo_app.png'>";
    echo "</head>";
    echo "<body onload='window.print()' style='font-family: Quicksand, sans-serif'>";

    // Logo dan Judul
    echo "<img src='../../../../assets/dist/img/logo_app.png' style='height: 90px; width: 90px; margin-top: 10px; margin-left: 10px; margin-bottom: -50px;'>";
    echo "<img src='../../../../assets/dist/img/LOGO-PERPUSNAS.png' style='display: block; margin-left: auto; width: 90px; margin-bottom: -70px; margin-top: -38px; margin-right: 5px;'>";
    echo "<h3 class='text-center' style='font-family: Quicksand, sans-serif; margin-top: -30px;'>.:: Laporan Perpustakaan ::.</h3>";

    // Informasi Kontak
    $sql2 = mysqli_query($koneksi, "SELECT * FROM identitas");
    $row = mysqli_fetch_assoc($sql2);
    echo "<p style='font-size: 12px;' class='text-center'>" . $row['alamat_app'] . "<br> Email : " . $row['email_app'] . " | Nomor Telpon : " . $row['nomor_hp'] . " </p>";
    echo "<hr>";

    // Tabel Data Peminjaman
    echo "<table class='table table-striped table-bordered'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>No</th>";
    echo "<th>Judul Buku</th>";
    echo "<th>Nama Anggota</th>";
    echo "<th>Tanggal Peminjaman</th>";
    echo "<th>Tanggal Pengembalian</th>";
    echo "<th>Status</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Query untuk mendapatkan data peminjaman
    $query = mysqli_query($koneksi, "SELECT peminjaman.*, buku.judul_buku, user.fullname, user.username FROM peminjaman 
                                     JOIN buku ON peminjaman.id_buku = buku.id_buku 
                                     JOIN user ON peminjaman.id_user = user.id_user
                                     WHERE tanggal_pinjam = '$tanggal_pinjam'");
    $no = 1;
    while ($row = mysqli_fetch_assoc($query)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row['judul_buku'] . "</td>";
        echo "<td>" . $row['fullname'] . "</td>";
        echo "<td>" . $row['tanggal_pinjam'] . "</td>";
        echo "<td>";
        if ($row['tanggal_kembali'] == null) {
            echo "-";
        } else {
            echo $row['tanggal_kembali'];
        }
        echo "</td>";
        echo "<td>" . $row['status'] . "</td>"; // Pastikan ada kolom 'status' di tabel peminjaman
        echo "</tr>";
    }

    // Tutup tag tbody dan table
    echo "</tbody>";
    echo "</table>";

    // Informasi Tambahan
    echo "<p style='text-align: center;'>Laporan Perpustakaan Berdasarkan Tanggal Peminjaman (" . $tanggal_pinjam . ")</p>";

    // Script JavaScript
    echo "<script src='../../../../assets/bower_components/jquery/dist/jquery.min.js'></script>";
    echo "<script src='../../../../assets/bower_components/bootstrap/dist/js/bootstrap.min.js'></script>";

    // Tutup tag body dan html
    echo "</body>";
    echo "</html>";
}

elseif($_GET['aksi'] == "tanggal_kembali") {
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // Header HTML
    echo "<html>";
    echo "<head>";
    echo "<title>Laporan Perpustakaan - Tanggal Pengembalian</title>";
    echo "<link rel='stylesheet' href='../../../../assets/dist/css/custom.css'>";
    echo "<link rel='stylesheet' href='../../../../assets/bower_components/bootstrap/dist/css/bootstrap.min.css'>";
    echo "<link rel='stylesheet' href='../../../../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'>";
    echo "<link rel='icon' type='icon' href='../../../../assets/dist/img/logo_app.png'>";
    echo "</head>";
    echo "<body onload='window.print()' style='font-family: Quicksand, sans-serif'>";

    // Logo dan Judul
    echo "<img src='../../../../assets/dist/img/logo_app.png' style='height: 90px; width: 90px; margin-top: 10px; margin-left: 10px; margin-bottom: -50px;'>";
    echo "<img src='../../../../assets/dist/img/LOGO-PERPUSNAS.png' style='display: block; margin-left: auto; width: 90px; margin-bottom: -70px; margin-top: -38px; margin-right: 5px;'>";
    echo "<h3 class='text-center' style='font-family: Quicksand, sans-serif; margin-top: -30px;'>.:: Laporan Perpustakaan ::.</h3>";

    // Informasi Kontak
    $sql2 = mysqli_query($koneksi, "SELECT * FROM identitas");
    $row = mysqli_fetch_assoc($sql2);
    echo "<p style='font-size: 12px;' class='text-center'>" . $row['alamat_app'] . "<br> Email : " . $row['email_app'] . " | Nomor Telpon : " . $row['nomor_hp'] . " </p>";
    echo "<hr>";

    // Tabel Data Pengembalian
    echo "<table class='table table-striped table-bordered'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>No</th>";
    echo "<th>Nama Anggota</th>";
    echo "<th>Judul Buku</th>";
    echo "<th>Tanggal Peminjaman</th>";
    echo "<th>Tanggal Pengembalian</th>";
    echo "<th>Status</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Query untuk mendapatkan data pengembalian
    $query = mysqli_query($koneksi, "SELECT peminjaman.*, buku.judul_buku, user.fullname, user.username FROM peminjaman
                                    JOIN buku ON peminjaman.id_buku = buku.id_buku 
                                    JOIN user ON peminjaman.id_user = user.id_user
                                    WHERE tanggal_kembali = '$tanggal_kembali'");
       $no = 1;
    while ($row = mysqli_fetch_assoc($query)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row['fullname'] . "</td>";
        echo "<td>" . $row['judul_buku'] . "</td>";
        echo "<td>" . $row['tanggal_pinjam'] . "</td>";
        echo "<td>";
        if ($row['tanggal_kembali'] == null) {
            echo "-";
        } else {
            echo $row['tanggal_kembali'];
        }
        echo "</td>";
        echo "<td>" . $row['status'] . "</td>"; // Pastikan ada kolom 'status' di tabel peminjaman
        echo "</tr>";
    }

    // Tutup tag tbody dan table
    echo "</tbody>";
    echo "</table>";

    // Informasi Tambahan
    echo "<p style='text-align: center;'>Laporan Perpustakaan Berdasarkan Tanggal Pengembalian (" . $tanggal_kembali . ")</p>";

    // Script JavaScript
    echo "<script src='../../../../assets/bower_components/jquery/dist/jquery.min.js'></script>";
    echo "<script src='../../../../assets/bower_components/bootstrap/dist/js/bootstrap.min.js'></script>";

    // Tutup tag body dan html
    echo "</body>";
    echo "</html>";

} 