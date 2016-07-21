<?php
include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;
error_reporting(0);
	$cari = $_GET['nama'];

	if (empty($cari)) {
		$where = "";
	}else{
		$where = "WHERE id_jenis LIKE '%$cari%' OR nm_jenis LIKE '%$cari%' ";
	}
?>

<table class="table">
	<tr>
		<td>No</td>
		<td>Kode Jenis</td>
		<td>Nama Jenis</td>
		<td>Aksi</td>
	</tr>
	<?php $get = $ini->get('tb_jenis','*',$where,'order by id_jenis asc');
	$no = 1;
	foreach($get as $rs): ?>

	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $rs['id_jenis']; ?></td>
		<td><?php echo $rs['nm_jenis']; ?></td>
		<td><a class="btn-success" href="jenis_edit.php?id=<?php echo $rs['id_jenis']; ?>">Edit</a> |
			<a class="btn-danger" onclick="return confirm('Yakin ingin menghapus data <?php echo $rs['nm_jenis']; ?> ?')" href="jenis_list.php?aksi=delete&id=<?php echo $rs['id_jenis']; ?>">Hapus</a>
		</td>
	</tr>

	<?php $no++;endforeach; ?>
</table>
