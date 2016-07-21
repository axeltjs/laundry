<?php include '../_header2.php'; ?>

<?php 
if ($hak_akses == 'admin') {
	
}elseif($hak_akses =='operator'){

}elseif($hak_akses == 'kasir'){
	header('location:../index.php'); 
}

	$nik = $_SESSION['nik'];

	$rs_sup = mysqli_query($koneksi,"SELECT * FROM tb_supplier ORDER BY id_supplier DESC LIMIT 0,1");
	$sup = mysqli_fetch_array($rs_sup);
	$id_sup = $sup['id_supplier'];

	$rs_cek = mysqli_query($koneksi,"SELECT * FROM tb_pembelian ORDER BY no_pembelian DESC LIMIT 0,1");
	$cek = mysqli_fetch_array($rs_cek);

	if ($cek['sts'] == 0 or empty($cek)) {
		$get = mysqli_query($ini->connection,"SELECT * FROM tb_pembelian ORDER BY no_pembelian DESC LIMIT 0,1 ");
		$rs = mysqli_fetch_array($get);
		$ambil = substr($rs["no_pembelian"], 1, 4) + 1;
		$jadi = "P".sprintf("%04s",$ambil);

		$tgl = date('Y-m-d');

		$kode = $jadi;
		mysqli_query($koneksi,"INSERT INTO tb_pembelian VALUES('$kode','$nik','$id_sup','$tgl','0','1') ");
	}else{
		$kode = $cek['no_pembelian'];
	}
?>

<?php 
	if (isset($_POST['submit'])) {
		$kode = $_POST['kode'];
		$id_supplier = $_POST['id_supplier'];
		$tgl_pembelian = $_POST['tgl_pembelian'];
		$total = $_POST['total'];

		$nik = $_SESSION['nik'];
		$kd_barang = $_POST['kd_barang'];
		$jumlah = $_POST['jumlah'];

		mysqli_query($koneksi,"UPDATE `db_laundry`.`tb_pembelian` SET 
			`id_supplier` = '$id_supplier',
			`tgl_pembelian` = '$tgl_pembelian', 
			`total` = '$total',
			`sts` = '0' WHERE `tb_pembelian`.`no_pembelian` = '$kode'; ");
		echo "<script type='text/javascript'> alert('Pembelian berhasil !'); </script>";
		$ini->redirect('index.php');
	}

 ?>
<h2>Pembelian Barang</h2>
<body onload="showit()"></body>
<a class="btn" href="data_pembelian.php">Data Pembelian</a>
<br>
<br>
<form method="POST">
<table class="table-form">
	
	<tr>
		<td>No. Pembelian</td>
		<td><input type="text" name="kode" id="kode" value="<?php echo $kode; ?>" required readonly="readonly"></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Tanggal Pembelian</td>
		<td><input type="date" name="tgl_pembelian" required></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Supplier</td>
		<td><select name="id_supplier">
			<?php $get = $ini->get('tb_supplier','*','','Order by nm_supplier asc');
			foreach($get as $record):
			 ?>
			<option value="<?php echo $record['id_supplier']; ?>"><?php echo $record['nm_supplier'] ?></option>
		<?php endforeach; ?>
		</select></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
	<tr>
		<td>Barang</td>
		<td><select id="kd_barang" name="kd_barang">
			<?php $get2 = $ini->get('tb_barang','*','','Order by nm_barang asc');
			foreach($get2 as $record2):
			 ?>
			<option value="<?php echo $record2['kd_barang']; ?>"><?php echo $record2['nm_barang'] ?></option>
		<?php endforeach; ?>
		</select></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Jumlah</td>
		<td><input type="number" id="jumlah" name="jumlah" min="1"></td>	
		<td><a class="btn-success" onclick="tambah()"><i class="fa fa-plus"></i></a></td>
	</tr>
	<tr>
		<td colspan="3"><input class="btn" type="submit" name="submit" value="Selesai"></td>
	</tr>
</table>

<div id="table"></div>
</form>


<script type="text/javascript">
	function tambah() {
		var kode = $("#kode").val();
		var kd_barang = $("#kd_barang").val();
		var jumlah = $("#jumlah").val();
		if (jumlah == null) {
			alert('Jumlah barang tidak boleh kurang dari 1!');
		}else if(jumlah == 0){
			alert('Jumlah barang tidak boleh kurang dari 1!');
		}else{
			$.ajax({
			type:"GET",
			url:"tambah.php",
			data:"kode="+kode+"&kd_barang="+kd_barang+"&jumlah="+jumlah,
			success:function(html){
				$("#table").html(html);
				$("#jumlah").val(1);
			}
		})
		}
	}

	function showit() {
		var kode = $("#kode").val();
		$.ajax({
			type:"GET",
			url:"show.php",
			data:"kode="+kode,
			success:function(html){
				$("#table").html(html);
			}
		})
	}

	function hapus(id){
		$.ajax({
			type:"GET",
			url:"hapus.php",
			data:"kode="+id,
			success:function(html){
				showit();
			}
		})
	}
</script>
<?php include '../_footer2.php'; ?>