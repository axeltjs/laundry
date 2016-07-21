<?php include '../_header2.php'; ?>

<?php 
$hak_akses = $_SESSION['hak_akses'];
if ($hak_akses == 'admin') {
}elseif($hak_akses =='operator'){
}elseif($hak_akses == 'kasir'){
	header('location:../index.php'); 
}


	if (isset($_POST['submit'])) {
		$kode = $_POST['kode'];
		$nm_barang = $_POST['nm_barang'];
		$satuan = $_POST['satuan'];
		$harga = $_POST['harga'];
		mysqli_query($koneksi,"UPDATE tb_barang SET nm_barang = '$nm_barang', satuan = '$satuan', harga = '$harga' WHERE kd_barang = '$kode' ");

		echo "<script type='text/javascript'> alert('Data berhasil diubah!'); </script>";
		$ini->redirect('barang_list.php');
	}

?>

<?php $id = $_GET['id'];
	$get = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE kd_barang = '$id' ");
	$rs = mysqli_fetch_array($get); ?>

<h2>Edit barang</h2>

<form method="post">
	<table class="table-form">
		<tr>
			<td>Kode barang</td>
			<td><input name="kode" value="<?php echo $rs['kd_barang']; ?>" readonly="readonly" required></td>
		</tr>
		<tr>
			<td>Nama barang</td>
			<td><input name="nm_barang" value="<?php echo $rs['nm_barang']; ?>" required></td>
		</tr>
		<tr>
			<td>Satuan</td>
			<td>
				<select name="satuan" required>
					<option value="<?php echo $rs['satuan']; ?>">-- Pilih Satuan --</option>
					<option value="Pcs">Pcs</option>
					<option value="Dos">Dos</option>
					<option value="Btl">Botol</option>
					<option value="Lsn">Lusin</option>
					<option value="lbr">Lembar</option>
					<option value="Ktk">Kotak</option>
					<option value="Kg">Kg</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Harga</td>
			<td><input type="number" name="harga" value="<?php echo $rs['harga']; ?>" required></td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="btn" type="submit" value="Submit" name="submit">
			</td>
		</tr>
	</table>
</form>

<?php include '../_footer2.php'; ?>