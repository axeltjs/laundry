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

		mysqli_query($koneksi,"UPDATE tb_tarif SET id_jenis = '$id_jenis',
								nm_pakaian = '$nm_pakaian',
								tarif = '$tarif' WHERE id_jenis_pakaian = '$kode' ");

		echo "<script type='text/javascript'> alert('Data berhasil ditambahkan!'); </script>";
		$ini->redirect('tarif_list.php');
	}

	$id = $_GET['id'];
	$get = mysqli_query($koneksi,"SELECT t.*, j.nm_jenis FROM tb_tarif t LEFT JOIN tb_jenis j ON j.id_jenis = t.id_jenis 
									WHERE id_jenis_pakaian = '$id' ");
	$rs = mysqli_fetch_array($get);

 ?>
<h2>Ubah Tarif Laundry</h2>

<form method="post">
	<table class="table-form">
		<tr>
			<td>Kode Tarif</td>
			<td><input name="kode" value="<?php echo $rs['id_jenis_pakaian'] ?>" readonly="readonly" required></td>
		</tr>
		<tr>
			<td>Nama Jenis Laundry</td>
			<td>
				<select name="id_jenis" required>
					<option value="<?php echo $rs['id_jenis'] ?>">-- Pilih Jenis --</option>
					<?php 
						$get = $ini->get('tb_jenis','*','','order by id_jenis asc');
						foreach($get as $rs1):
					 ?>
					<option value="<?php echo $rs1['id_jenis'] ?>"><?php echo $rs1['nm_jenis'] ?></option>
				<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Nama Pakaian</td>
			<td><input name="nm_pakaian" value="<?php echo $rs['nm_pakaian'] ?>" required></td>
		</tr>
		<tr>
			<td>Tarif</td>
			<td><input type="number" min="0" name="tarif" value="<?php echo $rs['tarif'] ?>" required></td>
		</tr>
		
		<tr>
			<td colspan="2">
				<input type="submit" class="btn" value="Submit" name="submit">
			</td>
		</tr>
	</table>
</form>

<?php include '../_footer2.php'; ?>