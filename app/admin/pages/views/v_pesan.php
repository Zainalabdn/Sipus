<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            <!-- Content Header removed -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Main content removed -->
    </section>
    <!-- /.content -->
</div>
<!-- -->
<form action="pages/function/Pesan.php?aksi=kirim" enctype="multipart/form-data" method="POST">
    <div class="modal fade" id="modalKirimPesan">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 5px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Kirim Pesan</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="pengirim" value="<?= $_SESSION['fullname']; ?>">
                    <div class="form-group">
                        <label>Nama Penerima <small style="color: red;">* Wajib diisi</small></label>
                        <select class="form-control" name="namaPenerima">
                            <option selected disabled>-- Pilih Penerima --</option>
                            <?php
                            include "../../config/koneksi.php";

                            $nama_saya = $_SESSION['fullname'];
                            $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE fullname != '$nama_saya'");
                            while ($data = mysqli_fetch_array($sql)) {
                            ?>
                                <option value="<?= $data['fullname']; ?>">[ <?= $data['kode_user']; ?> ] <?= $data['fullname']; ?> ( <?= $data['role']; ?> )</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Judul Pesan <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" name="judulPesan" class="form-control" placeholder="Masukan Judul Pesan" required>
                    </div>
                    <div class="form-group">
                        <label>Isi Pesan <small style="color: red;">* Wajib diisi</small></label>
                        <textarea name="isiPesan" class="form-control" style="height: 100px; resize: none;" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Kirim Email? <small>(Centang jika ingin kirim via email)</small></label>
                        <input type="checkbox" name="sendEmail" value="1">
                    </div>
                    <div id="emailFields" style="display: none;">
                        <div class="form-group">
                            <label>Subject Email <small style="color: red;">* Wajib diisi</small></label>
                            <input type="text" name="emailSubject" class="form-control" placeholder="Masukan Judul Email">
                        </div>
                        <div class="form-group">
                            <label>Isi Email <small style="color: red;">* Wajib diisi</small></label>
                            <textarea name="emailContent" class="form-control" style="height: 100px; resize: none;" placeholder="Masukkan Isi Email"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>
<script>
    function kirimPesan() {
        $('#modalKirimPesan').modal('show');
    }
</script>
<!-- jQuery 3 -->
<script src="../../assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../assets/dist/js/sweetalert.min.js"></script>
<!-- Pesan Berhasil Edit -->
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
</script>
<!-- Pesan Gagal Edit -->
<script>
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
</script>
<!-- Swal Hapus Data -->
<script>
    $('.btn-del').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        swal({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Apakah anda yakin ingin menghapus pesan ini ?',
                buttons: true,
                dangerMode: true,
                buttons: ['Tidak, Batalkan !', 'Iya, Hapus']
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.location.href = href;
                } else {
                    swal({
                        icon: 'error',
                        title: 'Dibatalkan',
                        text: 'Pesan tersebut tetap aman !'
                    })
                }
            });
    })
</script>
