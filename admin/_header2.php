<?php 
session_start();
    include 'modul.php';
    $ini = new modul();
    error_reporting(0);
    $koneksi = $ini->connection;
    $hak_akses = $_SESSION['hak_akses'];

    if (empty($_SESSION['username'])) {
        echo '<script type="text/javascript"> alert("Harap Login terlebih dahulu!"); </script>';
        $ini->redirect('../../login.php');
    }
 ?>
<html>
<head>
	<title>Sistem Informasi Laundry</title>
	<link rel="shortcut icon" type="image/x-icon" href="../../assets/img/logo3.png" />
	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../../assets/font/css/font-awesome.css">
	<link rel="shortcut icon" type="image/x-icon" href="../assets/img/logo3.png" />
	<!--<link rel="stylesheet" type="text/css" href="assets/font/css/font-awesome.min.css">-->
</head>
<body>
	<div class="container">
		<div class="header">
			<h2><a href="../index.php">Radja Q-Lau</a></h2>
			<a class="a" href="../../logout.php"> <i class="fa fa-sign-out"></i> Logout</a>
		</div>
		<div class="menu">
	<ul>
		
	<?php if ($hak_akses == 'admin') : ?>
	
		<a href="<?php $ini->url('admin/transaksi'); ?>"><li><i class="fa fa-money"></i> Transaksi</li></a>
		<a href="<?php $ini->url('admin/pembelian'); ?>"><li><i class="fa fa-shopping-cart"></i> Pembelian Barang</li></a>
		<a href="<?php $ini->url('admin/pemakaian'); ?>"><li><i class="fa fa-shopping-basket"></i> Pemakaian Barang</li></a>
		<a href="<?php $ini->url('admin/jenis_laundry'); ?>"><li><i class="fa fa-tasks"></i> Data Jenis Laundry</li></a>
		<a href="<?php $ini->url('admin/tarif'); ?>"><li><i class="fa fa-ticket"></i> Data Tarif per Jenis</li></a>
		<a href="<?php $ini->url('admin/barang'); ?>"><li><i class="fa fa-cubes"></i> Data Barang</li></a>
		<a href="<?php $ini->url('admin/konsumen'); ?>"><li><i class="fa fa-users"></i> Data Konsumen</li></a>
		<a href="<?php $ini->url('admin/supplier'); ?>"><li><i class="fa fa-truck"></i> Data Supplier</li></a>
		<a href="<?php $ini->url('admin/karyawan'); ?>"><li><i class="fa fa-user"></i> Data Karyawan</li></a>
	
	<?php elseif ($hak_akses == 'operator') : ?>
		
		<a href="<?php $ini->url('admin/transaksi'); ?>"><li><i class="fa fa-money"></i></i> Transaksi</li></a>
		<a href="<?php $ini->url('admin/pembelian'); ?>"><li><i class="fa fa-shopping-cart"></i> Pembelian Barang</li></a>
		<a href="<?php $ini->url('admin/pemakaian'); ?>"><li><i class="fa fa-shopping-basket"></i> Pemakaian Barang</li></a>
		<a href="<?php $ini->url('admin/barang'); ?>"><li><i lass="fa fa-cubes"></i> Data Barang</li></a>
		<a href="<?php $ini->url('admin/konsumen'); ?>"><li><i class="fa fa-users"></i> Data Konsumen</li></a>
		<a href="<?php $ini->url('admin/supplier'); ?>"><li><i class="fa fa-truck"></i> Data Supplier</li></a>
		<a href="<?php $ini->url('admin/karyawan'); ?>"><li><i class="fa fa-user"></i> Data Karyawan</li></a>
	
	<?php else: ?>
		
		<a href="<?php $ini->url('admin/transaksi'); ?>"><li><i class="fa fa-money"></i> Transaksi</li></a>
		<a href="<?php $ini->url('admin/pemakaian'); ?>"><li><i class="fa fa-shopping-basket"></i> Pemakaian Barang</li></a>
		<a href="<?php $ini->url('admin/konsumen'); ?>"><li><i class="fa fa-users"></i> Data Konsumen</li></a>
		<a href="<?php $ini->url('admin/karyawan'); ?>"><li><i class="fa fa-user"></i> Data Karyawan</li></a>
		
	<?php endif; ?>
	</ul>
</div>
<div class="jumbotron">
