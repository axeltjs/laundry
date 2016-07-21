<?php include '../_header2.php'; ?>

<?php 
$hak_akses = $_SESSION['hak_akses'];
if ($hak_akses != 'admin') {
	header('location:../index.php');
}

	if ($_GET['aksi'] == 'delete') {
		$id = $_GET['id'];
		$ini->delete('tb_tarif','id_jenis_pakaian',$id);
		echo "<script type='text/javascript'> alert('Data berhasil dihapus!'); </script>";
		$ini->redirect('tarif_list.php');
	}

 ?>

<h2>Data Tarif Laundry</h2>

<a class="btn" href="tarif_tambah.php">Tambah Tarif</a>

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