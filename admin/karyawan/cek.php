<?php 
	include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;

	$username = $_GET['username'];

	$get = mysqli_query($koneksi,"SELECT * FROM tb_login WHERE username = '$username' ");
	$rs = mysqli_num_rows($get);

	if ($rs < 1) {
		echo '<p style="margin:5px; color:#fff; border:1px solid #42a44e; border-radius:3px; background-color:#5ae063; padding:7px;"><i class="fa fa-check"></i> Username dapat digunakan</p>';
	}else{
		echo '<p style="margin:5px; color:#fff; border:1px solid #a44242; border-radius:3px; background-color:#e05a5a; padding:7px;"><i class="fa fa-warning"></i> Username tidak dapat digunakan</p>';
	}	
 ?>



 