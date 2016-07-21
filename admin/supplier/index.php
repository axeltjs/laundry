<?php 
session_start();
$hak_akses = $_SESSION['hak_akses'];
if ($hak_akses == 'admin') {
	header('location:supplierlist.php'); 
}elseif($hak_akses =='operator'){
	header('location:supplierlist.php'); 
}elseif($hak_akses == 'kasir'){
	header('location:../index.php'); 
}
