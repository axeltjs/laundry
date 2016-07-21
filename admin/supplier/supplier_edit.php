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
		$nm_supplier = $_POST['nm_supplier'];
		$alamat = $_POST['alamat'];
		$telp = $_POST['telp'];

		mysqli_query($koneksi,"UPDATE tb_supplier SET nm_supplier = '$nm_supplier',
														alamat = '$alamat',
														telp = '$telp'
														WHERE id_supplier = '$kode' ");

		echo "<script type='text/javascript'> alert('Data berhasil diubah!'); </script>";
		$ini->redirect('supplierlist.php');
	}

	$id = $_GET['id'];
	$get = mysqli_query($koneksi,"SELECT * FROM tb_supplier WHERE id_supplier = '$id' ");
	$rs = mysqli_fetch_array($get);
?>

<h2>Edit Supplier</h2>

<form method="post">
	<table class="table-form">
		<tr>
			<td>ID Supplier</td>
			<td><input name="kode" value="<?php echo $rs['id_supplier']; ?>" readonly="readonly" required></td>
		</tr>
		<tr>
			<td>Nama Supplier</td>
			<td><input name="nm_supplier" value="<?php echo $rs['nm_supplier'] ?>" required></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><textarea name="alamat" required><?php echo $rs['alamat']; ?></textarea></td>
		</tr>
		<tr>
			<td>Telpon</td>
			<td><input name="telp" value="<?php echo $rs['telp']; ?>" required></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" class="btn" value="Submit" name="submit">
			</td>
		</tr>
	</table>
</form>

<?php include '../_footer2.php'; ?>