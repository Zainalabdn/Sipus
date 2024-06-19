<?php
include "koneksi.php";
function getNextClass($currentClass) {
    // Pemetaan kelas saat ini ke kelas berikutnya
    $classMapping = [
        "X - Administrasi Perkantoran" => "XI - Administrasi Perkantoran",
        "X - Farmasi" => "XI - Farmasi",
        "X - Perbankan" => "XI - Perbankan",
        "X - Rekayasa Perangkat Lunak" => "XI - Rekayasa Perangkat Lunak",
        "X - Tata Boga" => "XI - Tata Boga",
        "X - Teknik Kendaraan Ringan" => "XI - Teknik Kendaraan Ringan",
        "X - Teknik Komputer dan Jaringan" => "XI - Teknik Komputer dan Jaringan",
        "X - Teknik Sepeda Motor" => "XI - Teknik Sepeda Motor",
        "XI - Administrasi Perkantoran" => "XII - Administrasi Perkantoran",
        "XI - Farmasi" => "XII - Farmasi",
        "XI - Perbankan" => "XII - Perbankan",
        "XI - Rekayasa Perangkat Lunak" => "XII - Rekayasa Perangkat Lunak",
        "XI - Tata Boga" => "XII - Tata Boga",
        "XI - Teknik Kendaraan Ringan" => "XII - Teknik Kendaraan Ringan",
        "XI - Teknik Komputer dan Jaringan" => "XII - Teknik Komputer dan Jaringan",
        "XI - Teknik Sepeda Motor" => "XII - Teknik Sepeda Motor"
    ];

    return isset($classMapping[$currentClass]) ? $classMapping[$currentClass] : "Lulus";
}

function updateClasses($koneksi) {
    // Ambil data anggota dari database
    $query = mysqli_query($koneksi, "SELECT id_user, kelas FROM user WHERE role = 'Anggota'");
    while ($row = mysqli_fetch_assoc($query)) {
        $newClass = getNextClass($row['kelas']);
        if ($newClass == "Lulus") {
            // Tandai siswa sebagai lulus
            $updateQuery = "UPDATE user SET kelas = 'Lulus' WHERE id_user = " . $row['id_user'];
            mysqli_query($koneksi, $updateQuery);
        } else {
            // Update kelas di database
            $updateQuery = "UPDATE user SET kelas = '$newClass' WHERE id_user = " . $row['id_user'];
            mysqli_query($koneksi, $updateQuery);
        }
    }

    echo "Pembaruan kelas selesai.";
}

if (isset($_GET['update_classes'])) {
    updateClasses($koneksi);
}
?>
