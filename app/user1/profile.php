<?php 
include "../../config/koneksi.php";

session_start();

if (!isset($_SESSION['Anggota'])) {
    header("Location: ../../function/Process.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<style>
    .card {
        max-width: 500px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }
    .card-header {
        font-family: 'Quicksand', sans-serif;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }
    .card-body {
        text-align: left;
    }
</style>

<?php @include('head.php');?>

<body>
<div class="content-wrapper text-center">
    <section class="content-header my-5">
        <div class="card">
            <div class="card-header">
                <h1>
                    Identitas Profile
                </h1>
            </div>
            <div class="card-body">
                <form action="function/profile.php?aksi=edit" method="POST" enctype="multipart/form-data">
                <?php
                        include "../../config/koneksi.php";

                        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE  role = ''");
                        $row = mysqli_fetch_assoc($query);
                        ?>
                    <div class="form-group">
                        <label for="nameApp">Nama Pengguna</label>
                        <input type="text" class="form-control form-control-sm" id="nameApp" value="<?= $row['nama_app']; ?>" name="App" required>
                    </div>
                    <div class="form-group">
                        <label for="alamaT">NIS</label>
                        <textarea class="form-control form-control-sm" style="height: 80px; resize: none;" name="Alamat" required><?= $row['alamat_app']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="alamaT">Alamat Lengkap</label>
                        <textarea class="form-control form-control-sm" style="height: 80px; resize: none;" name="Alamat" required><?= $row['alamat_app']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="emaiL">Email</label>
                        <input type="email" class="form-control form-control-sm" id="emaiL" value="<?= $row['email_app']; ?>" name="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="telP">Nomor Telpon</label>
                        <input type="number" class="form-control form-control-sm" id="telP" value="<?= $row['nomor_hp']; ?>" name="Telp" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script src="path/to/plugins.js"></script>
<script src="path/to/script.js"></script>

<script>
    <?php
    if (isset($_SESSION['berhasil']) && $_SESSION['berhasil'] <> '') {
        echo "swal({
            icon: 'success',
            title: 'Berhasil',
            text: '$_SESSION[berhasil]'
        })";
    }
    $_SESSION['berhasil'] = '';
    ?>
    <?php
    if (isset($_SESSION['gagal']) && $_SESSION['gagal'] <> '') {
        echo "swal({
                icon: 'error',
                title: 'Gagal',
                text: '$_SESSION[gagal]'
              })";
    }
    $_SESSION['gagal'] = '';
    ?>
    $('.btn-del').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        swal({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Apakah anda yakin ingin menghapus data administrator ini ?',
            buttons: true,
            dangerMode: true,
            buttons: ['Tidak, Batalkan !', 'Iya, Hapus']
        }).then((willDelete) => {
            if (willDelete) {
                document.location.href = href;
            } else {
                swal({
                    icon: 'error',
                    title: 'Dibatalkan',
                    text: 'Data administrator tersebut tetap aman !'
                })
            }
        });
    });
</script>

</body>
</html>