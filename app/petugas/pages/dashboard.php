<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Dashboard
            <small>
                <!-- function hari, tanggal, bulan, tahun -->
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
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="alert alert-secondary" style="color: #383d41; background-color: #e2e3e5; border-color: #d6d8db;">
            <marquee behavior="" direction="">Selamat Datang, <?= $_SESSION['fullname']; ?> di Administrator E-Library.</marquee>
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <?php
                include "../../config/koneksi.php";
                $query_anggota = mysqli_query($koneksi, "SELECT * FROM user WHERE role = 'Anggota'");
                $row_anggota = mysqli_num_rows($query_anggota);
                ?>
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= $row_anggota; ?></h3>
                        <p>Data Anggota</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="anggota" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <?php
                include "../../config/koneksi.php";
                $query_buku = mysqli_query($koneksi, "SELECT * FROM buku");
                $row_buku = mysqli_num_rows($query_buku);
                ?>
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= $row_buku; ?></h3>
                        <p>Data Buku</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <a href="data-buku" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <?php
                include "../../config/koneksi.php";
                $query_peminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman");
                $row_peminjaman = mysqli_num_rows($query_peminjaman);
                ?>
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= $row_peminjaman; ?></h3>
                        <p>Data Peminjaman</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <a href="data-peminjaman" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <?php
                include "../../config/koneksi.php";
                $query_penerbit = mysqli_query($koneksi, "SELECT * FROM penerbit");
                $row_penerbit = mysqli_num_rows($query_penerbit);
                ?>
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3><?= $row_penerbit; ?></h3>
                        <p>Data Penerbit</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-building"></i>
                    </div>
                    <a href="penerbit" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <?php
                include "../../config/koneksi.php";
                $query_admin = mysqli_query($koneksi, "SELECT * FROM user WHERE role IN ('Admin', 'Petugas')");
                $row_admin = mysqli_num_rows($query_admin);
                ?>
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3><?= $row_admin; ?></h3>
                        <p>Data Administrator</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-shield"></i>
                    </div>
                    <a href="administrator" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <?php
                include "../../config/koneksi.php";
                $query_pengunjung = mysqli_query($koneksi, "SELECT * FROM pengunjung");
                $row_pengunjung = mysqli_num_rows($query_pengunjung);
                ?>
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3><?= $row_pengunjung; ?></h3>
                        <p>Data Pengunjung</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="data-pengunjung" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <?php
                include "../../config/koneksi.php";
                $query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
                $row_kategori = mysqli_num_rows($query_kategori);
                ?>
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= $row_kategori; ?></h3>
                        <p>Data Katalog</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-tags"></i>
                    </div>
                    <a href="kategori-buku" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
