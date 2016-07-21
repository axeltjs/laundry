<?php include '../_header2.php'; ?>

<?php
$hak_akses = $_SESSION['hak_akses'];
if ($hak_akses == 'admin') {
}elseif($hak_akses =='operator'){
}elseif($hak_akses == 'kasir'){
	header('location:../index.php'); 
}


	if ($_GET['aksi'] == 'delete') {
		$id = $_GET['id'];
		$ini->delete('tb_barang','kd_barang',$id);
		echo "<script type='text/javascript'> alert('Data berhasil dihapus!'); </script>";
		$ini->redirect('barang_list.php');
	}

 ?>

<h2>Data barang</h2>

<a style="float:left;" class="btn" href="barang_tambah.php">Tambah barang</a>
<input style="float:right;" type="text" onchange="carilagi()"
onkeypress="carilagi()" id="nama" placeholder="Pencarian ..." > 
<br>
<br>
<br>
<body onload="showit()"></body>
<div id="tb"></div>


<script type="text/javascript">
	function showit(){
		$.ajax({
			type:"GET",
			url:"cari.php",
			data:"nama=",
			success:function(html){
				$("#tb").html(html);
			}
		})
	}

function carilagi(){
		var nama = $("#nama").val();
		$.ajax({
			type:"GET",
			url:"cari.php",
			data:"nama="+nama,
			success:function(html){
				$("#tb").html(html);
			}
		})
	}
</script>

<?php include '../_footer2.php'; ?>