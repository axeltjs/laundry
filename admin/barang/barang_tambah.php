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
		$stok = $_POST['stok'];
		$tgl = date('Y-m-d');
		$harga = $_POST['harga'];
		$satuan = $_POST['satuan'];
		mysqli_query($koneksi,"INSERT INTO tb_barang VALUES('$kode','$nm_barang','$stok','$tgl','$satuan','$harga')");

		echo "<script type='text/javascript'> alert('Data berhasil ditambahkan!'); </script>";
		$ini->redirect('barang_list.php');
	}

 ?>
<h2>Tambah barang</h2>

<form method="post">
	<table class="table-form">
		<tr>
			<td>Kode barang</td>
			<td><input name="kode" value="<?php
			$get = mysqli_query($ini->connection,"SELECT * FROM tb_barang ORDER BY kd_barang DESC LIMIT 0,1 ");
		$rs = mysqli_fetch_array($get);
		$ambil = substr($rs['kd_barang'], 2,3) + 1;
		$jadi = "BR".sprintf("%03s",$ambil);
		echo $jadi;?>" readonly="readonly" required></td>
		</tr>
		<tr>
			<td>Nama barang</td>
			<td><input name="nm_barang" required></td>
		</tr>
		<tr>
			<td>Stok</td>
			<td><input type="number" min="0" name="stok"></td>
		</tr>
		<tr>
			<td>Satuan</td>
			<td>
				<select name="satuan" required>
					<option value="-">-- Pilih Satuan --</option>
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
			<td><input type="number" name="harga" required></td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="btn" type="submit" value="Submit" name="submit">
			</td>
		</tr>
	</table>
</form>

<?php include '../_footer2.php'; ?>