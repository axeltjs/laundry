<?php 
	include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;

	$id_jenis_pakaian = $_GET['id'];
	$jumlah = $_GET['jumlah'];
	$diskon = $_GET['diskon'];

	$get = mysqli_query($koneksi,"SELECT * FROM tb_tarif WHERE id_jenis_pakaian = '$id_jenis_pakaian' ");
	$rs = mysqli_fetch_array($get);

	$tarif = $rs['tarif'];

	$hitung = ($tarif * $jumlah);

	$bagi = ($hitung / 100);
	$hasil = ($bagi * $diskon);

	$end = ($hitung - $hasil);

	echo $end;