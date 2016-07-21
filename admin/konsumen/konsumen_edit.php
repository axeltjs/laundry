<?php include '../_header2.php'; ?>

<?php 
	
	if (isset($_POST['submit'])) {
		$kode = $_POST['kode'];
		$nm_konsumen = $_POST['nm_konsumen'];
		$alamat = $_POST['alamat'];
		$telp = $_POST['telp'];

		mysqli_query($koneksi,"UPDATE tb_konsumen SET nm_konsumen = '$nm_konsumen',
														alamat = '$alamat',
														telp = '$telp'
														WHERE kd_konsumen = '$kode' ");

		echo "<script type='text/javascript'> alert('Data berhasil diubah!'); </script>";
		$ini->redirect('konsumen_list.php');
	}

	$id = $_GET['id'];
	$get = mysqli_query($koneksi,"SELECT * FROM tb_konsumen WHERE kd_konsumen = '$id' ");
	$rs = mysqli_fetch_array($get);
?>

<h2>Edit Konsumen</h2>

<form method="post">
	<table class="table-form">
		<tr>
			<td>ID Konsumen</td>
			<td><input name="kode" value="<?php echo $rs['kd_konsumen']; ?>" readonly="readonly" required></td>
		</tr>
		<tr>
			<td>Nama Konsumen</td>
			<td><input name="nm_konsumen" value="<?php echo $rs['nm_konsumen'] ?>" required></td>
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
				<input class="btn" type="submit" value="Submit" name="submit">
			</td>
		</tr>
	</table>
</form>

<?php include '../_footer2.php'; ?>