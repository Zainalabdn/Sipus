<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Data Peminjaman
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
            <li class="active">Data Peminjaman</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#peminjaman" data-toggle="tab">Data Peminjaman Buku</a></li>
                        <li><a href="#per-pengembalian" data-toggle="tab">Permintaan Peminjaman</a></li>
                        <li><a href="#pengembalian" data-toggle="tab">Permintaan Pengembalian</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="peminjaman">
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Buku</th>
                                            <th>Nama Anggota</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Status</th>
                                            <th>Denda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "../../config/koneksi.php";

                                        $no = 1;
                                        $query = mysqli_query($koneksi, "SELECT peminjaman.*, buku.judul_buku, user.fullname, user.username FROM peminjaman 
                                                                          JOIN buku ON peminjaman.id_buku = buku.id_buku 
                                                                          JOIN user ON peminjaman.id_user = user.id_user
                                                                          WHERE peminjaman.status = 'Dipinjam'");
                                        while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= htmlspecialchars($row['judul_buku']); ?></td>
                                                <td><?= htmlspecialchars($row['fullname']); ?></td>
                                                <td><?= htmlspecialchars($row['tanggal_pinjam']); ?></td>
                                                <td><?= htmlspecialchars($row['tanggal_kembali']); ?></td>
                                                <td><?= htmlspecialchars($row['status']); ?></td>
                                                <td><?= htmlspecialchars($row['denda']); ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Content for Permintaan Pengembalian -->
                        <div class="tab-pane" id="per-pengembalian">
                            <div class="box-body table-responsive">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Buku</th>
                                            <th>Nama Anggota</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "../../config/koneksi.php";
                                        $no = 1;
                                        $query = mysqli_query($koneksi, "SELECT peminjaman.*, buku.judul_buku, user.fullname FROM peminjaman 
                                                  JOIN buku ON peminjaman.id_buku = buku.id_buku 
                                                  JOIN user ON peminjaman.id_user = user.id_user 
                                                  WHERE peminjaman.status = 'Minta Peminjaman'");
                                        while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= htmlspecialchars($row['judul_buku']); ?></td>
                                                <td><?= htmlspecialchars($row['fullname']); ?></td>
                                                <td><?= htmlspecialchars($row['tanggal_pinjam']); ?></td>
                                                <td><?= htmlspecialchars($row['tanggal_kembali']); ?></td>
                                                <td>
                                                    <a href="pages/function/Peminjaman.php?act=konfirmasipinjam&id=<?= $row['id_peminjaman']; ?>" class="btn btn-success btn-sm">Konfirmasi</a>
                                                    <a href="pages/function/Peminjaman.php?act=tolakpinjam&id=<?= $row['id_peminjaman']; ?>" class="btn btn-danger btn-sm">Tolak</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="pengembalian">
                            <!-- Content for Permintaan Pengembalian -->
                            <div class="box-body table-responsive">
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Buku</th>
                                            <th>Nama Anggota</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "../../config/koneksi.php";
                                        $no = 1;
                                        $query = mysqli_query($koneksi, "SELECT peminjaman.*, buku.judul_buku, user.fullname FROM peminjaman 
                                                  JOIN buku ON peminjaman.id_buku = buku.id_buku 
                                                  JOIN user ON peminjaman.id_user = user.id_user 
                                                  WHERE peminjaman.status = 'Minta Pengembalian'");
                                        while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= htmlspecialchars($row['judul_buku']); ?></td>
                                                <td><?= htmlspecialchars($row['fullname']); ?></td>
                                                <td><?= htmlspecialchars($row['tanggal_pinjam']); ?></td>
                                                <td><?= htmlspecialchars($row['tanggal_kembali']); ?></td>
                                                <td>
                                                    <a href="pages/function/Peminjaman.php?act=konfirmasikembali&id=<?= $row['id_peminjaman']; ?>" class="btn btn-success btn-sm">Konfirmasi</a>
                                                    <a href="pages/function/Peminjaman.php?act=tolakkembali&id=<?= $row['id_peminjaman']; ?>" class="btn btn-danger btn-sm">Tolak</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

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
                text: 'Apakah anda yakin ingin menghapus data kategori buku ini ?',
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
                        text: 'Data kategori buku tersebut aman !'
                    })
                }
            });
    })
</script>