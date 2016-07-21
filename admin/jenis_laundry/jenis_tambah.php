<?php include '../_header2.php'; ?>
<?php 
	$hak_akses = $_SESSION['hak_akses'];
if ($hak_akses != 'admin') {
	header('location:../index.php');
}
	
	if (isset($_POST['submit'])) {
		$kode = $_POST['kode'];
		$nm_jenis = $_POST['nm_jenis'];
		mysqli_query($koneksi,"INSERT INTO tb_jenis VALUES('$kode','$nm_jenis')");

		echo "<script type='text/javascript'> alert('Data berhasil ditambahkan!'); </script>";
		$ini->redirect('jenis_list.php');
	}

 ?>
<h2>Tambah Jenis Laundry</h2>

<form method="post">
	<table class="table-form">
		<tr>
			<td>Kode Jenis</td>
			<td><input name="kode" value="<?php
			$get = mysqli_query($ini->connection,"SELECT * FROM tb_jenis ORDER BY id_jenis DESC LIMIT 0,1 ");
		$rs = mysqli_fetch_array($get);
		$ambil = substr($rs['id_jenis'], 2,3) + 1;
		$jadi = "JL".sprintf("%03s",$ambil);
		echo $jadi;
			?>" readonly="readonly" required></td>
		</tr>
		<tr>
			<td>Nama Jenis</td>
			<td><input name="nm_jenis" required></td>
		</tr>
		
		<tr>
			<td colspan="2">
				<input class="btn" type="submit" value="Submit" name="submit">
			</td>
		</tr>
	</table>
</form>

<?php include '../_footer2.php'; ?>