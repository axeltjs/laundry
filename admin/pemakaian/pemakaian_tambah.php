<?php include '../_header2.php'; ?>
<?php 
	
	if (isset($_POST['submit'])) {
		$kode = $_POST['kode'];
		$kd_barang = $_POST['kd_barang'];
		$jumlah = $_POST['jumlah'];
		$nik = $_SESSION['nik'];


		$ambil = mysqli_query($koneksi,"SELECT stok FROM tb_barang WHERE kd_barang = '$kd_barang' ");
		$res = mysqli_fetch_array($ambil);

		if ($res['stok'] < $jumlah) {
			echo "<script type='text/javascript'> alert('Data gagal ditambahkan!, karena stok tidak sesuai'); </script>";
				$ini->redirect('pemakaian_list.php');
		}else{
			
			mysqli_query($koneksi,"INSERT INTO tb_pemakaian VALUES('$kode','$nik','$kd_barang','$jumlah')");
			mysqli_query($koneksi,"UPDATE tb_barang SET stok = stok - '$jumlah' WHERE kd_barang = '$kd_barang' ");

			echo "<script type='text/javascript'> alert('Data berhasil ditambahkan!'); </script>";
			$ini->redirect('pemakaian_list.php');

		}
	}

 ?>
<h2>Tambah Pemakaian</h2>

<form method="post">
	<table class="table-form">
		<tr>
			<td>Kode Pemakaian</td>
			<td><input name="kode" value="<?php
			$get = mysqli_query($ini->connection,"SELECT * FROM tb_pemakaian ORDER BY kd_pengeluaran DESC LIMIT 0,1 ");
		$rs = mysqli_fetch_array($get);
		$ambil = substr($rs['kd_pengeluaran'], 1,4) + 1;
		$jadi = "U".sprintf("%04s",$ambil);
		echo $jadi;
			?>" readonly="readonly" required></td>
		</tr>
		<tr>
			<td>Nama Barang</td>
			<td>
				<select name="kd_barang" required>
					<?php $get = $ini->get('tb_barang','*','WHERE stok > 0','ORDER BY kd_barang');
					foreach($get as $rs): ?>
					<option value="<?php echo $rs['kd_barang']; ?>"> <?php echo $rs['nm_barang']; ?></option>
				<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Jumlah</td>
			<td><input required type="number" min="1" name="jumlah"></td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="btn" type="submit" value="Submit" name="submit">
			</td>
		</tr>
	</table>
</form>

<?php include '../_footer2.php'; ?>