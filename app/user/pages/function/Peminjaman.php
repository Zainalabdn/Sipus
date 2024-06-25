<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../../../../config/koneksi.php";

if ($_GET['aksi'] == "pinjam") {

    if (empty($_POST['judulBuku'])) {
        $_SESSION['gagal'] = "Peminjaman buku gagal, Kamu belum memilih buku yang akan dipinjam !";
        header("location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } elseif (empty($_POST['kondisiBukuSaatDipinjam'])) {
        $_SESSION['gagal'] = "Peminjaman buku gagal, Kamu belum memilih kondisi buku yang akan dipinjam !";
        header("location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {

        include "Pemberitahuan.php";

        $nama_anggota = mysqli_real_escape_string($koneksi, $_POST['namaAnggota']);
        $judul_buku = mysqli_real_escape_string($koneksi, $_POST['judulBuku']);
        $tanggal_peminjaman = mysqli_real_escape_string($koneksi, $_POST['tanggalPeminjaman']);
        $kondisi_buku_saat_dipinjam = mysqli_real_escape_string($koneksi, $_POST['kondisiBukuSaatDipinjam']);

        $query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE nama_anggota = '$nama_anggota' AND judul_buku = '$judul_buku' AND tanggal_pengembalian = ''");
        $cek = mysqli_num_rows($query);

        if ($cek > 0) {
            $_SESSION['gagal'] = "Peminjaman buku gagal, Kamu telah meminjam buku ini sebelumnya !";
            header("location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $sql = "INSERT INTO peminjaman(nama_anggota, judul_buku, tanggal_peminjaman, kondisi_buku_saat_dipinjam)
            VALUES('$nama_anggota','$judul_buku','$tanggal_peminjaman','$kondisi_buku_saat_dipinjam')";
            $result = mysqli_query($koneksi, $sql);
            
            $sql2 = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul_buku = '$judul_buku'");
$data = mysqli_fetch_array($sql2);
// Escape special characters in a string for use in an SQL statement
$judul = mysqli_real_escape_string($koneksi, $data['judul_buku']);
$author = mysqli_real_escape_string($koneksi, $data['pengarang']);
$isbn = mysqli_real_escape_string($koneksi, $data['isbn']);
$description = mysqli_real_escape_string($koneksi, $data['deskripsi']);
$publisher = mysqli_real_escape_string($koneksi, $data['penerbit_buku']);
$published_date = mysqli_real_escape_string($koneksi, $data['tahun_terbit']);
$categories = mysqli_real_escape_string($koneksi, $data['kategori_buku']);
$jumlah_buku = mysqli_real_escape_string($koneksi, $data['jumlah_buku']);
$average = mysqli_real_escape_string($koneksi, $data['averageRating']);
$img = mysqli_real_escape_string($koneksi, $data['img']);
$language = mysqli_real_escape_string($koneksi, $data['language']);

$proses_buku = (int)$jumlah_buku - 1;
$perubahan_buku = (string)$proses_buku;

// Prepare the SQL statement
$stmt = $koneksi->prepare("UPDATE buku SET judul_buku = ?, kategori_buku = ?, deskripsi = ?, penerbit_buku = ?, pengarang = ?, tahun_terbit = ?, isbn = ?, jumlah_buku = ?, averageRating = ?, img = ?, language = ? WHERE judul_buku = ?");
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($koneksi->error));
}

// Bind parameters
$stmt->bind_param('ssssssisssss', $judul, $categories, $description, $publisher, $author, $published_date, $isbn, $perubahan_buku, $average, $img, $language, $judul);

// Execute the statement
$stmt->execute();

if ($stmt->error) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

// Close the statement
$stmt->close();

                // Send notif to admin
                InsertPemberitahuanPeminjaman();

                if ($result) {
                    $_SESSION['berhasil'] = "Peminjaman buku berhasil !";
                    header("location: " . $_SERVER['HTTP_REFERER']);
                    exit();
                } else {
                    $_SESSION['gagal'] = "Terjadi masalah dalam pengiriman data peminjaman !";
                    header("location: " . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            }
        }
    }
    elseif ($_GET['aksi'] == "pengembalian") {

    include "Pemberitahuan.php";

    if ($_POST['kondisiBukuSaatDikembalikan'] == "Baik") {
        $denda = "Tidak ada";
    } elseif ($_POST['kondisiBukuSaatDikembalikan'] == "Rusak") {
        $denda = "Rp 20.000";
    } elseif ($_POST['kondisiBukuSaatDikembalikan'] == "Hilang") {
        $denda = "Rp 50.000";
    }

    $judul_buku = mysqli_real_escape_string($koneksi, $_POST['judulBuku']);
    $tanggal_pengembalian = mysqli_real_escape_string($koneksi, $_POST['tanggalPengembalian']);
    $kondisiBukuSaatDikembalikan = mysqli_real_escape_string($koneksi, $_POST['kondisiBukuSaatDikembalikan']);

    $ambil_id = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE judul_buku = '$judul_buku'");
    $row = mysqli_fetch_assoc($ambil_id);

    if ($row) {
        $id_peminjaman = $row['id_peminjaman'];

        $query = "UPDATE peminjaman SET tanggal_pengembalian = '$tanggal_pengembalian', kondisi_buku_saat_dikembalikan = '$kondisiBukuSaatDikembalikan', denda = '$denda' WHERE id_peminjaman = $id_peminjaman";
        $sql = mysqli_query($koneksi, $query);

        if ($sql) {
            // Send notif to admin
            $sql = "INSERT INTO peminjaman(nama_anggota, judul_buku, tanggal_peminjaman, kondisi_buku_saat_dipinjam)
            VALUES('$nama_anggota','$judul_buku','$tanggal_peminjaman','$kondisi_buku_saat_dipinjam')";
            $result = mysqli_query($koneksi, $sql);
            
            $sql2 = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul_buku = '$judul_buku'");
$data = mysqli_fetch_array($sql2);
// Escape special characters in a string for use in an SQL statement
$judul = mysqli_real_escape_string($koneksi, $data['judul_buku']);
$author = mysqli_real_escape_string($koneksi, $data['pengarang']);
$isbn = mysqli_real_escape_string($koneksi, $data['isbn']);
$description = mysqli_real_escape_string($koneksi, $data['deskripsi']);
$publisher = mysqli_real_escape_string($koneksi, $data['penerbit_buku']);
$published_date = mysqli_real_escape_string($koneksi, $data['tahun_terbit']);
$categories = mysqli_real_escape_string($koneksi, $data['kategori_buku']);
$jumlah_buku = mysqli_real_escape_string($koneksi, $data['jumlah_buku']);
$average = mysqli_real_escape_string($koneksi, $data['averageRating']);
$img = mysqli_real_escape_string($koneksi, $data['img']);
$language = mysqli_real_escape_string($koneksi, $data['language']);

$proses_buku = (int)$jumlah_buku + 1;
$perubahan_buku = (string)$proses_buku;

// Prepare the SQL statement
$stmt = $koneksi->prepare("UPDATE buku SET judul_buku = ?, kategori_buku = ?, deskripsi = ?, penerbit_buku = ?, pengarang = ?, tahun_terbit = ?, isbn = ?, jumlah_buku = ?, averageRating = ?, img = ?, language = ? WHERE judul_buku = ?");
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($koneksi->error));
}

// Bind parameters
$stmt->bind_param('ssssssisssss', $judul, $categories, $description, $publisher, $author, $published_date, $isbn, $perubahan_buku, $average, $img, $language, $judul);

// Execute the statement
$stmt->execute();

if ($stmt->error) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

// Close the statement
$stmt->close();

                // Send notif to admin
                InsertPemberitahuanPeminjaman();


            $_SESSION['berhasil'] = "Pengembalian buku berhasil !";
            header("location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['gagal'] = "Pengembalian buku gagal !";
            header("location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        $_SESSION['gagal'] = "Data peminjaman tidak ditemukan!";
        header("location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

function UpdateDataPeminjaman()
{
    include "../../../../config/koneksi.php";

    $nama_lama = mysqli_real_escape_string($koneksi, $_SESSION['fullname']);
    $nama_anggota = mysqli_real_escape_string($koneksi, $_POST['Fullname']);

    // Mencari nama dalam database berdasarkan session nama lengkap
    $query1 = mysqli_query($koneksi, "SELECT * FROM user WHERE fullname = '$nama_lama'");
    $row = mysqli_fetch_assoc($query1);

    if ($row) {
        // membuat variable dari hasil query1
        $nama_lama = $row['fullname'];

        // Fungsi update nama anggota pada table peminjaman
        $query = "UPDATE peminjaman SET nama_anggota = '$nama_anggota' WHERE nama_anggota = '$nama_lama'";
        $sql = mysqli_query($koneksi, $query);

        if ($sql) {
            $_SESSION['berhasil'] = "Data peminjaman berhasil diupdate!";
            header("location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['gagal'] = "Gagal mengupdate data peminjaman!";
            header("location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        $_SESSION['gagal'] = "Data pengguna tidak ditemukan!";
        header("location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>
