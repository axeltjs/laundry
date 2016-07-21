<?php
include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;
error_reporting(0);
	$cari = $_GET['nama'];

	if (empty($cari)) {
		$where = "";
	}else{
		$where = "WHERE kd_konsumen LIKE '%$cari%' OR nm_konsumen LIKE '%$cari%' OR alamat LIKE '%$cari%' OR telp LIKE '%$cari%' ";
	}
?>

<table class="table">
	<tr>
		<td>No</td>
		<td>Kode Konsumen</td>
		<td>Nama Konsumen</td>
		<td>Alamat</td>
		<td>Telpon</td>
		<td>Aksi</td>
	</tr>
	<?php $get = $ini->get('tb_konsumen','*',$where,'order by kd_konsumen asc');
	$no = 1;
	foreach($get as $rs): ?>

	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $rs['kd_konsumen']; ?></td>
		<td><?php echo $rs['nm_konsumen']; ?></td>
		<td><?php echo $rs['alamat']; ?></td>
		<td><?php echo $rs['telp']; ?></td>
		<td><a class="btn-success" href="konsumen_edit.php?id=<?php echo $rs['kd_konsumen']; ?>">Edit</a> |
			<a class="btn-danger" onclick="return confirm('Yakin ingin menghapus data <?php echo $rs['nm_konsumen']; ?> ?')" href="konsumen_list.php?aksi=delete&id=<?php echo $rs['kd_konsumen']; ?>">Hapus</a>
		</td>
	</tr>

	<?php $no++;endforeach; ?>
</table>