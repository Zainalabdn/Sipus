<?php
session_start();
include "config/koneksi.php";

$sql = mysqli_query($koneksi, "SELECT * FROM identitas");
$row1 = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pendaftaran | <?= $row1['nama_app']; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">
    <!-- Icon -->
    <link rel="icon" type="icon" href="assets/dist/img/logo_app.png">
    <!-- Custom -->
    <link rel="stylesheet" href="assets/dist/css/custom.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="assets/dist/css/toastr.min.css">
</head>

<body class="hold-transition login-page" style="font-family: 'Quicksand', sans-serif;">
    <div class="login-box">
        <div class="login-logo">
            <a href="masuk"><b>Sipus</b></a>
            <a href="index.php" style="position: absolute; top: 10px; left: 10px;"><i class="fa fa-arrow-left"></i></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body" style="border-radius: 10px;">
            <img src="assets/dist/img/logo.png" height="80px" width="80px"
                style="display: block; margin-left: auto; margin-right: auto; margin-top: -12px; margin-bottom: 5px;">

            <form name="formLogin" action="function/Process.php?aksi=daftar" method="POST" enctype="multipart/form-data"
                onsubmit="return validateForm()">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="fullname" placeholder="Nama Lengkap" id="fullname">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="Nama Pengguna" id="username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="nis" placeholder="NIS" id="nis">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="notelp" placeholder="No Telepon" id="notelp">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Email" id="email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <select class="form-control" name="kelas" id="kelas">
                        <option selected disabled>Silahkan pilih kelas</option>
                        <!-- X -->
                        <option value="X - Administrasi Perkantoran">X - Administrasi Perkantoran</option>
                        <option value="X - Farmasi">X - Farmasi</option>
                        <option value="X - Perbankan">X - Perbankan</option>
                        <option value="X - Rekayasa Perangkat Lunak">X - Rekayasa Perangkat Lunak</option>
                        <option value="X - Tata Boga">X - Tata Boga</option>
                        <option value="X - Teknik Kendaraan Ringan">X - Teknik Kendaraan Ringan</option>
                        <option value="X - Teknik Komputer dan Jaringan">X - Teknik Komputer dan Jaringan</option>
                        <option value="X - Teknik Sepeda Motor">X - Teknik Sepeda Motor</option>
                        <!-- XI -->
                        <option disabled>------------------------------------------</option>
                        <option value="XI - Administrasi Perkantoran">XI - Administrasi Perkantoran</option>
                        <option value="XI - Farmasi">XI - Farmasi</option>
                        <option value="XI - Perbankan">XI - Perbankan</option>
                        <option value="XI - Rekayasa Perangkat Lunak">XI - Rekayasa Perangkat Lunak</option>
                        <option value="XI - Tata Boga">XI - Tata Boga</option>
                        <option value="XI - Teknik Kendaraan Ringan">XI - Teknik Kendaraan Ringan</option>
                        <option value="XI - Teknik Komputer dan Jaringan">XI - Teknik Komputer dan Jaringan</option>
                        <option value="XI - Teknik Sepeda Motor">XI - Teknik Sepeda Motor</option>
                        <!-- XII -->
                        <option disabled>------------------------------------------</option>
                        <option value="XII - Administrasi Perkantoran">XII - Administrasi Perkantoran</option>
                        <option value="XII - Farmasi">XII - Farmasi</option>
                        <option value="XII - Perbankan">XII - Perbankan</option>
                        <option value="XII - Rekayasa Perangkat Lunak">XII - Rekayasa Perangkat Lunak</option>
                        <option value="XII - Tata Boga">XII - Tata Boga</option>
                        <option value="XII - Teknik Kendaraan Ringan">XII - Teknik Kendaraan Ringan</option>
                        <option value="XII - Teknik Komputer dan Jaringan">XII - Teknik Komputer dan Jaringan</option>
                        <option value="XII - Teknik Sepeda Motor">XII - Teknik Sepeda Motor</option>
                        
                    </select>
                    <span class="glyphicon glyphicon-education form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="alamat" placeholder="Alamat" id="alamat">
                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Kata Sandi" id="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar Sekarang</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p style="font-size: 11px;">- ATAU -</p>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="button" onclick="Masuk()" class="btn btn-block btn-success btn-flat"><i
                                class="fa fa-sign-in"></i> Sudah mempunyai akun ? Masuk</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Fungsi mengarahkan kehalaman masuk -->
    <script>
        function Masuk() {
            window.location.href = "masuk";
        }
    </script>
    <!-- Toastr -->
    <script src="assets/dist/js/toastr.min.js"></script>
    <!-- -->
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    <!-- -->
    <script>
        function validateForm() {
            var fields = ['fullname', 'username', 'nis', 'notelp', 'email', 'kelas', 'alamat', 'password'];
            for (var i = 0; i < fields.length; i++) {
                if (document.forms["formLogin"][fields[i]].value == "") {
                    toastr.error(fields[i] + " harus diisi !!");
                    document.forms["formLogin"][fields[i]].focus();
                    return false;
                }
            }
        }
    </script>
</body>

</html>
