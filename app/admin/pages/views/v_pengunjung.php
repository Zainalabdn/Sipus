<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Data Pengunjung
            <small>
                <script type='text/javascript'>
                    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                    var date = new Date();
                    var day = date.getDate();
                    var month = date.getMonth();
                    var thisDay = date.getDay(),
                        thisDay = myDays[thisDay];
                    var yy = date.getYear();
                    var year = (yy < 1000) ? yy + 1900 : yy;
                    document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                </script>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Data Pengunjung</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Data Pengunjung</h3>
                        <div class="form-group m-b-2 text-right" style="margin-top: -20px; margin-bottom: -5px;">
                            <button type="button" onclick="tambahPengunjung()" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Pengunjung</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengunjung</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Waktu Masuk</th>
                                    <th>Waktu Keluar</th>
                                    <th>Keperluan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                include "../../config/koneksi.php";

                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT pengunjung.*, user.fullname FROM pengunjung INNER JOIN user ON pengunjung.id_user = user.id_user");
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['fullname']; ?></td>
                                        <td><?= $row['tanggal_kunjungan']; ?></td>
                                        <td><?= $row['waktu_masuk']; ?></td>
                                        <td><?= $row['waktu_keluar']; ?></td>
                                        <td><?= $row['keperluan']; ?></td>
                                        <td>
                                            <a href="#" data-target="#modalEditPengunjung<?= $row['id_pengunjung']; ?>" data-toggle="modal" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="pages/function/Pengunjung.php?act=hapus&id=<?= $row['id_pengunjung']; ?>" class="btn btn-danger btn-sm btn-del"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="modalEditPengunjung<?= $row['id_pengunjung']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="border-radius: 5px;">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Edit Pengunjung ( <?= $row['fullname']; ?> )</h4>
                                                </div>
                                                <form action="pages/function/Pengunjung.php?act=edit" method="POST">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_pengunjung" value="<?= $row['id_pengunjung']; ?>">
                                                        <div class="form-group">
                                                            <label>Nama Pengunjung <small style="color: red;">* Wajib diisi</small></label>
                                                            <input type="text" class="form-control" value="<?= $row['fullname']; ?>" name="namaPengunjung" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Kunjungan <small style="color: red;">* Wajib diisi</small></label>
                                                            <input type="datetime-local" class="form-control" value="<?= $row['tanggal_kunjungan']; ?>" name="tanggalKunjungan" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Waktu Masuk <small style="color: red;">* Wajib diisi</small></label>
                                                            <input type="time" class="form-control" value="<?= $row['waktu_masuk']; ?>" name="waktuMasuk" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Waktu Keluar</label>
                                                            <input type="time" class="form-control" value="<?= $row['waktu_keluar']; ?>" name="waktuKeluar">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Keperluan <small style="color: red;">* Wajib diisi</small></label>
                                                            <input type="text" class="form-control" value="<?= $row['keperluan']; ?>" name="keperluan" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /. Modal Edit -->
                                <?php
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="modalTambahPengunjung">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Tambah Pengunjung</h4>
            </div>
            <form action="pages/function/Pengunjung.php?act=tambah" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Pengunjung <small style="color: red;">* Wajib diisi</small></label>
                        <select class="form-control select2" name="id_user" required>
                            <option selected disabled>-- Harap Pilih Pengunjung --</option>
                            <?php
                            include "../../config/koneksi.php";

                            $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE role = 'Anggota';");
                            while ($data = mysqli_fetch_array($sql)) {
                            ?>
                                <option value="<?= $data['id_user']; ?>"><?= $data['fullname']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kunjungan <small style="color: red;">* Wajib diisi</small></label>
                        <input type="datetime-local" class="form-control" name="tanggalKunjungan" required>
                    </div>
                    <div class="form-group">
                        <label>Waktu Masuk <small style="color: red;">* Wajib diisi</small></label>
                        <input type="time" class="form-control" name="waktuMasuk" required>
                    </div>
                    <div class="form-group">
                        <label>Waktu Keluar</label>
                        <input type="time" class="form-control" name="waktuKeluar">
                    </div>
                    <div class="form-group">
                        <label>Keperluan <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Keperluan" name="keperluan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    function tambahPengunjung() {
        $('#modalTambahPengunjung').modal('show');
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
<!-- Notif Gagal -->
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
                text: 'Apakah anda yakin ingin menghapus data pengunjung ini ?',
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
                        text: 'Data pengunjung tersebut aman !'
                    })
                }
            });
    })
</script>