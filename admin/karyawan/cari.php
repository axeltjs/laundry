<?php
session_start();
include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;
	error_reporting(0);
	$cari = $_GET['nama'];
	$hak_akses = $_SESSION['hak_akses'];
$nik = $_SESSION['nik'];

	if (empty($cari)) {
		$where = "";
	}else{
		$where = "AND tb_karyawan.nm_karyawan LIKE '%$cari%' OR tb_karyawan.nik LIKE '%$cari%' ";
	}
?>
<table class="table">
	<tr>
		<td>No</td>
		<td>NIK</td>
		<td>Nama Karyawan</td>
		<td>Alamat</td>
		<td>Telp</td>
		<td>Jenis Kelamin</td>
		<td>Aksi</td>
	</tr>
	<?php 

	if ($hak_akses == "admin") {
		$get = mysqli_query($koneksi,"SELECT tb_karyawan.* 
							 FROM tb_karyawan LEFT JOIN tb_login ON tb_login.nik = tb_karyawan.nik
							  WHERE tb_login.typeuser = 'Operator' OR tb_login.typeuser = 'Kasir' OR tb_login.nik = '$nik' $where 
							  ORDER BY tb_karyawan.nm_karyawan ASC");
	}else{
		$get = mysqli_query($koneksi,"SELECT tb_karyawan.* 
							  FROM tb_karyawan LEFT JOIN tb_login ON tb_login.nik = tb_karyawan.nik
							  WHERE tb_login.nik = '$nik' $where 
							  ORDER BY tb_karyawan.nm_karyawan ASC ");
	}
	
	$no = 1;
	while($rs = mysqli_fetch_array($get)): ?>

	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $rs['nik']; ?></td>
		<td><?php echo $rs['nm_karyawan']; ?></td>
		<td><?php echo $rs['alamat']; ?></td>
		<td><?php echo $rs['telp']; ?></td>
		<td><?php echo $ini->jk($rs['jenkel']); ?></td>
		<td><a class="btn-success" href="karyawan_edit.php?nik=<?php echo $rs['nik']; ?>">Edit</a> 
			<?php if ($_SESSION['nik'] == $rs['nik']): ?>
				
			<?php else: ?>

			|
			<a class="btn-danger" onclick="return confirm('Yakin ingin menghapus data <?php echo $rs['nm_karyawan']; ?> ?')" href="index.php?aksi=delete&nik=<?php echo $rs['nik']; ?>">Hapus</a>

		<?php endif; ?>
		</td>
	</tr>

	<?php $no++;endwhile;; ?>
</table>