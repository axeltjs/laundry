<?php include '../_header2.php'; ?>

<?php 
$hak_akses = $_SESSION['hak_akses'];
if ($hak_akses != 'admin') {
	header('location:../index.php');
}

	if (isset($_POST['submit'])) {
		$kode = $_POST['kode'];
		$nm_jenis = $_POST['nm_jenis'];
		mysqli_query($koneksi,"UPDATE tb_jenis SET nm_jenis = '$nm_jenis' WHERE id_jenis = '$kode' ");

		echo "<script type='text/javascript'> alert('Data berhasil diubah!'); </script>";
		$ini->redirect('jenis_list.php');
	}

?>

<?php $id = $_GET['id'];
	$get = mysqli_query($koneksi,"SELECT * FROM tb_jenis WHERE id_jenis = '$id' ");
	$rs = mysqli_fetch_array($get); ?>

<h2>Edit Jenis Laundry</h2>

<form method="post">
	<table class="table-form">
		<tr>
			<td>Kode Jenis</td>
			<td><input name="kode" value="<?php echo $rs['id_jenis']; ?>" readonly="readonly" required></td>
		</tr>
		<tr>
			<td>Nama Jenis</td>
			<td><input name="nm_jenis" value="<?php echo $rs['nm_jenis']; ?>" required></td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="btn" type="submit" value="Submit" name="submit">
			</td>
		</tr>
	</table>
</form>

<?php include '../_footer2.php'; ?>