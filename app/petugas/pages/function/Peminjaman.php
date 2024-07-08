<?php
session_start();
include "../../../../config/koneksi.php";

// Initialize action variable
$act = isset($_GET['act']) ? $_GET['act'] : '';

// Function to redirect with referrer
function redirect_back()
{
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

// Confirmation of borrowing
if ($act == "konfirmasipinjam" && isset($_GET['id'])) {
    $id_peminjaman = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = "UPDATE peminjaman SET status = 'Dipinjam' WHERE id_peminjaman = '$id_peminjaman'";

    if (mysqli_query($koneksi, $query)) {
        // Retrieve the book ID
        $query_buku_id = mysqli_query($koneksi, "SELECT id_buku FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'");
        if ($query_buku_id && mysqli_num_rows($query_buku_id) > 0) {
            $row_buku_id = mysqli_fetch_assoc($query_buku_id);
            $id_buku = $row_buku_id['id_buku'];

            // Check if the book quantity is greater than 0 before reducing it
            $query_check_quantity = mysqli_query($koneksi, "SELECT jumlah_buku FROM buku WHERE id_buku = '$id_buku'");
            if ($query_check_quantity && mysqli_num_rows($query_check_quantity) > 0) {
                $row_quantity = mysqli_fetch_assoc($query_check_quantity);
                if ($row_quantity['jumlah_buku'] > 0) {
                    // Update book quantity
                    $query_update_buku = "UPDATE buku SET jumlah_buku = jumlah_buku - 1 WHERE id_buku = '$id_buku'";
                    if (mysqli_query($koneksi, $query_update_buku)) {
                        $_SESSION['berhasil'] = "Peminjaman berhasil dikonfirmasi.";
                    } else {
                        $_SESSION['gagal'] = "Gagal memperbarui jumlah buku.";
                    }
                } else {
                    $_SESSION['gagal'] = "Buku tidak tersedia untuk dipinjam.";
                }
            } else {
                $_SESSION['gagal'] = "Gagal memeriksa jumlah buku.";
            }
        } else {
            $_SESSION['gagal'] = "Gagal mengambil data buku.";
        }
    } else {
        $_SESSION['gagal'] = "Peminjaman gagal dikonfirmasi.";
    }
    redirect_back();
}

// Confirmation of return
if ($act == "konfirmasikembali" && isset($_GET['id'])) {
    $id_peminjaman = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Retrieve book ID
    $query_buku_id = mysqli_query($koneksi, "SELECT id_buku FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'");
    if ($query_buku_id && mysqli_num_rows($query_buku_id) > 0) {
        $row_buku_id = mysqli_fetch_assoc($query_buku_id);
        $buku_id = $row_buku_id['id_buku'];

        // Retrieve return date
        $query_tanggal_kembali = mysqli_query($koneksi, "SELECT tanggal_kembali FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'");
        if ($query_tanggal_kembali && mysqli_num_rows($query_tanggal_kembali) > 0) {
            $row_tanggal_kembali = mysqli_fetch_assoc($query_tanggal_kembali);
            $tanggal_kembali = $row_tanggal_kembali['tanggal_kembali'];
            $today = date('Y-m-d');

            // Calculate penalty if return is late
            $denda = 0;
            if ($today > $tanggal_kembali) {
                $tanggal_kembali_obj = new DateTime($tanggal_kembali);
                $today_obj = new DateTime($today);
                $late_days = $today_obj->diff($tanggal_kembali_obj)->days;
                $denda = $late_days * 1000; // 1000 per late day
            }

            // Update peminjaman status, denda, and buku quantity
            $query_update_peminjaman = "UPDATE peminjaman SET status = 'Dikembalikan', denda = '$denda' WHERE id_peminjaman = '$id_peminjaman'";
            if (mysqli_query($koneksi, $query_update_peminjaman)) {
                $query_update_buku = "UPDATE buku SET jumlah_buku = jumlah_buku + 1 WHERE id_buku = '$buku_id'";
                mysqli_query($koneksi, $query_update_buku);

                $_SESSION['berhasil'] = $denda > 0
                    ? "Pengembalian berhasil dikonfirmasi. Dikenakan denda sebesar Rp. " . number_format($denda, 0, ',', '.')
                    : "Pengembalian berhasil dikonfirmasi.";
            } else {
                $_SESSION['gagal'] = "Pengembalian gagal dikonfirmasi.";
            }
        } else {
            $_SESSION['gagal'] = "Gagal mengambil tanggal kembali.";
        }
    } else {
        $_SESSION['gagal'] = "Gagal mengambil data buku.";
    }
    redirect_back();
}
if ($act == "tolakpinjam" && isset($_GET['id'])) {
    $id_peminjaman = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Delete the borrowing record
    $query_delete_peminjaman = "DELETE FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'";
    if (mysqli_query($koneksi, $query_delete_peminjaman)) {
        $_SESSION['berhasil'] = "Peminjaman berhasil ditolak.";
    } else {
        $_SESSION['gagal'] = "Gagal menolak peminjaman.";
    }
    redirect_back();
}
// Rejection of return
if ($act == "tolakkembali" && isset($_GET['id'])) {
    $id_peminjaman = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Update peminjaman status to 'Dipinjam'
    $query_update_peminjaman = "UPDATE peminjaman SET status = 'Dipinjam' WHERE id_peminjaman = '$id_peminjaman'";
    if (mysqli_query($koneksi, $query_update_peminjaman)) {
        $_SESSION['berhasil'] = "Penolakan pengembalian berhasil. Status peminjaman dikembalikan ke 'Dipinjam'.";
    } else {
        $_SESSION['gagal'] = "Penolakan pengembalian gagal.";
    }
    redirect_back();
}

?>