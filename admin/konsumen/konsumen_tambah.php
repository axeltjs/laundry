<?php include '../_header2.php'; ?>
<?php 
	
	if (isset($_POST['submit'])) {
		$kode = $_POST['kode'];
		$nm_konsumen = $_POST['nm_konsumen'];
		$alamat = $_POST['alamat'];
		$telp = $_POST['telp'];

		mysqli_query($koneksi,"INSERT INTO tb_konsumen VALUES('$kode','$nm_konsumen','$alamat','$telp')");

		echo "<script type='text/javascript'> alert('Data berhasil ditambahkan!'); </script>";
		$ini->redirect('konsumen_list.php');
	}

 ?>
<h2>Tambah Konsumen</h2>

<form method="post">
	<table class="table-form">
		<tr>
			<td>Kode Konsumen</td>
			<td><input name="kode" value="<?php
			$get = mysqli_query($ini->connection,"SELECT * FROM tb_konsumen ORDER BY kd_konsumen DESC LIMIT 0,1 ");
		$rs = mysqli_fetch_array($get);
		$ambil = substr($rs['kd_konsumen'], 1,4) + 1;
		$jadi = "K".sprintf("%04s",$ambil);
		echo $jadi;
		?>" readonly="readonly" required></td>
		</tr>
		<tr>
			<td>Nama Konsumen</td>
			<td><input name="nm_konsumen" required></td>
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