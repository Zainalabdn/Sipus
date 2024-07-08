<head>
	<?php
	include "../../config/koneksi.php";

	$sql = mysqli_query($koneksi, "SELECT * FROM identitas");
	$row1 = mysqli_fetch_assoc($sql);
	?>
	<title>Home | <?= $row1['nama_app']; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="author" content="">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="../../assets/home/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="../../assets/home/icomoon/icomoon.css">
	<link rel="stylesheet" type="text/css" href="../../assets/home/css/vendor.css">
	<link rel="stylesheet" type="text/css" href="../../assets/home/style.css">
	<link rel="icon" type="icon" href="../../assets/dist/img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>