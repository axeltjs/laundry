<?php include '../_header2.php'; ?>

<?php 

	if ($_GET['aksi'] == 'delete') {
		$id = $_GET['id'];
		$ini->delete('tb_pemakaian','kd_pengeluaran',$id);
		echo "<script type='text/javascript'> alert('Data berhasil dihapus!'); </script>";
		$ini->redirect('pemakaian_list.php');
	}

 ?>

<h2>Data Pemakaian Barang</h2>

<a class="btn" href="pemakaian_tambah.php">Tambah Pemakaian</a>
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