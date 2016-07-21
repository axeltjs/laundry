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

		mysqli_query($koneksi,"INSERT INTO tb_supplier VALUES('$kode','$nm_supplier','$alamat','$telp')");

		echo "<script type='text/javascript'> alert('Data berhasil ditambahkan!'); </script>";
		$ini->redirect('supplierlist.php');
	}

 ?>
<h2>Tambah Supplier</h2>

<form method="post">
	<table class="table-form">
		<tr>
			<td>ID Supplier</td>
			<td><input name="kode" value="<?php 
			$get = mysqli_query($ini->connection,"SELECT * FROM tb_supplier ORDER BY id_supplier DESC LIMIT 0,1 ");
		$rs = mysqli_fetch_array($get);
		$ambil = substr($rs['id_supplier'], 2,3) + 1;
		$jadi = "SP".sprintf("%03s",$ambil);
		echo $jadi;

			?>" readonly="readonly" required></td>
		</tr>
		<tr>
			<td>Nama Supplier</td>
			<td><input name="nm_supplier" required></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><textarea name="alamat" required></textarea></td>
		</tr>
		<tr>
			<td>Telpon</td>
			<td><input name="telp" required></td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="btn" type="submit" value="Submit" name="submit">
			</td>
		</tr>
	</table>
</form>

<?php include '../_footer2.php'; ?>