<?php 
	include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;

		$id_rincian = $_GET['kode'];

		mysqli_query($koneksi,"DELETE FROM rincian_transaksi WHERE id_rincian = '$id_rincian' ");