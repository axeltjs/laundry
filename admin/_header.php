<?php 
session_start();
    include 'modul.php';
    $ini = new modul();
    error_reporting(0);
    $koneksi = $ini->connection;
    $hak_akses = $_SESSION['hak_akses'];

    if (empty($_SESSION['username'])) {
        echo '<script type="text/javascript"> alert("Harap Login terlebih dahulu!"); </script>';
        $ini->redirect('../login.php');
    }
 ?>
<html>
<head>
	<title>Sistem Informasi Laundry</title>
	<link rel="shortcut icon" type="image/x-icon" href="../assets/img/logo.png" />
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/font/css/font-awesome.min.css">
	<link rel="shortcut icon" type="image/x-icon" href="../assets/img/logo.png" />
</head>
<body>
	<div class="container">
		<div class="header">
			<h2><a href="index.php">Dr. Laundry</a></h2>
			<a class="a" href="<?php $ini->url('logout.php'); ?>">Logout</a>
		</div>
		<div class="menu">
	<ul>
		<?php if ($hak_akses == 'admin') : ?>
		<a href="<?php $ini->url('admin/transaksi'); ?>"><li><i class="fa fa-circle-o"></i> Transaksi</li></a>
		<a href="<?php $ini->url('admin/pembelian'); ?>"><li><i class="fa fa-circle-o"></i> Pembelian Barang</li></a>
		<a href="<?php $ini->url('admin/pemakaian'); ?>"><li><i class="fa fa-circle-o"></i> Pemakaian Barang</li></a>
		<a href="<?php $ini->url('admin/jenis_laundry'); ?>"><li><i class="fa fa-circle-o"></i> Data Jenis Laundry</li></a>
		<a href="<?php $ini->url('admin/tarif'); ?>"><li><i class="fa fa-circle-o"></i> Data Tarif per Jenis</li></a>
		<a href="<?php $ini->url('admin/barang'); ?>"><li><i class="fa fa-circle-o"></i> Data Barang</li></a>
		<a href="<?php $ini->url('admin/konsumen'); ?>"><li><i class="fa fa-circle-o"></i> Data Konsumen</li></a>
		<a href="<?php $ini->url('admin/supplier'); ?>"><li><i class="fa fa-circle-o"></i> Data Supplier</li></a>
		<a href="<?php $ini->url('admin/karyawan'); ?>"><li><i class="fa fa-circle-o"></i> Data Karyawan</li></a>
		<?php elseif ($hak_akses == 'operator') : ?>
		
		<a href="<?php $ini->url('admin/transaksi'); ?>"><li><i class="fa fa-circle-o"></i> Transaksi</li></a>
		<a href="<?php $ini->url('admin/pembelian'); ?>"><li><i class="fa fa-circle-o"></i> Pembelian Barang</li></a>
		<a href="<?php $ini->url('admin/pemakaian'); ?>"><li><i class="fa fa-circle-o"></i> Pemakaian Barang</li></a>
		<a href="<?php $ini->url('admin/barang'); ?>"><li><i class="fa fa-circle-o"></i> Data Barang</li></a>
		<a href="<?php $ini->url('admin/konsumen'); ?>"><li><i class="fa fa-circle-o"></i> Data Konsumen</li></a>
		<a href="<?php $ini->url('admin/supplier'); ?>"><li><i class="fa fa-circle-o"></i> Data Supplier</li></a>
		<a href="<?php $ini->url('admin/karyawan'); ?>"><li><i class="fa fa-circle-o"></i> Data Karyawan</li></a>
		
		<?php else: ?>
		
		<a href="<?php $ini->url('admin/transaksi'); ?>"><li><i class="fa fa-circle-o"></i> Transaksi</li></a>
		<a href="<?php $ini->url('admin/pemakaian'); ?>"><li><i class="fa fa-circle-o"></i> Pemakaian Barang</li></a>
		<a href="<?php $ini->url('admin/konsumen'); ?>"><li><i class="fa fa-circle-o"></i> Data Konsumen</li></a>
		<a href="<?php $ini->url('admin/karyawan'); ?>"><li><i class="fa fa-circle-o"></i> Data Karyawan</li></a>
		
		<?php endif; ?>
	</ul>
</div>
<div class="jumbotron">