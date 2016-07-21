<?php 
	include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;

		$no_pembelian = $_GET['kode'];

		mysqli_query($koneksi,"DELETE FROM rincian_pembelian WHERE no_rincian = '$no_pembelian' ");