<?php include '../_header2.php'; ?>

<?php 

	if ($_GET['aksi'] == 'delete') {
		$id = $_GET['nik'];
		$ini->delete('tb_karyawan','nik',$id);
		echo "<script type='text/javascript'> alert('Data berhasil dihapus!'); </script>";
		$ini->redirect('index.php');
	}

 ?>

<h2>Data Karyawan</h2>
<?php if ($hak_akses == "admin") : ?>
<a class="btn" href="karyawan_tambah.php">Tambah Karyawan</a>

<?php endif; ?>
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