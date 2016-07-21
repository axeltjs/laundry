<?php include '../_header2.php'; ?>
<?php 
	$hak_akses = $_SESSION['hak_akses'];
if ($hak_akses != 'admin') {
	header('location:../index.php');
}

	if (isset($_POST['submit'])) {
		$kode = $_POST['kode'];
		$id_jenis = $_POST['id_jenis'];
		$nm_pakaian = $_POST['nm_pakaian'];
		$tarif = $_POST['tarif'];
		mysqli_query($koneksi,"INSERT INTO tb_tarif VALUES('$kode','$id_jenis','$nm_pakaian','$tarif')");

		echo "<script type='text/javascript'> alert('Data berhasil ditambahkan!'); </script>";
		$ini->redirect('tarif_list.php');
	}

 ?>
<h2>Tambah Tarif Laundry</h2>

<form method="post">
	<table class="table-form">
		<tr>
			<td>Kode Tarif</td>
			<td><input name="kode" value="<?php

			$get = mysqli_query($ini->connection,"SELECT * FROM tb_tarif ORDER BY id_jenis_pakaian DESC LIMIT 0,1 ");
		$rs = mysqli_fetch_array($get);
		$ambil = substr($rs['id_jenis_pakaian'], 2,3) + 1;
		$jadi = "JP".sprintf("%03s",$ambil);
		echo $jadi; ?>" readonly="readonly" required></td>
		</tr>
		<tr>
			<td>Nama Jenis Laundry</td>
			<td>
				<select name="id_jenis" required>
					<?php 
						$get = $ini->get('tb_jenis','*','','order by id_jenis asc');
						foreach($get as $rs):
					 ?>
					<option value="<?php echo $rs['id_jenis'] ?>"><?php echo $rs['nm_jenis'] ?></option>
				<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Nama Pakaian</td>
			<td><input name="nm_pakaian" required></td>
		</tr>
		<tr>
			<td>Tarif</td>
			<td><input type="number" min="0" name="tarif" required></td>
		</tr>
		
		<tr>
			<td colspan="2">
				<input class="btn" type="submit" value="Submit" name="submit">
			</td>
		</tr>
	</table>
</form>

<?php include '../_footer2.php'; ?>