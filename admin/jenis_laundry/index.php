<?php

session_start();
$hak_akses = $_SESSION['hak_akses'];
if ($hak_akses != 'admin') {
    header('location:../index.php');
} else {
    header('location:../jenis_laundry/jenis_list.php');
}
