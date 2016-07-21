<?php
include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;
error_reporting(0);
	$cari = $_GET['nama'];

	if (empty($cari)) {
		$where = "";
	}else{
		$where = "WHERE t.id_jenis_pakaian LIKE '%$cari%' OR j.nm_jenis LIKE '%$cari%' OR t.nm_pakaian LIKE '%$cari%' ";
	}
?>

<table class="table">
	<tr>
		<td>No</td>
		<td>Kode Pakaian</td>
		<td>Nama Jenis</td>
		<td>Nama Pakaian</td>
		<td>Tarif</td>
		<td>Aksi</td>
	</tr>
	<?php $get = $ini->get('tb_tarif t LEFT JOIN tb_jenis j ON j.id_jenis = t.id_jenis','t.*, j.nm_jenis',$where,'order by t.id_jenis_pakaian asc');
	$no = 1;
	foreach($get as $rs): ?>

	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $rs['id_jenis_pakaian']; ?></td>
		<td><?php echo $rs['nm_jenis']; ?></td>
		<td><?php echo $rs['nm_pakaian']; ?></td>
		<td><?php echo number_format($rs['tarif']); ?></td>
		<td><a class="btn-success" href="tarif_edit.php?id=<?php echo $rs['id_jenis_pakaian']; ?>">Edit</a>
			<a class="btn-danger" onclick="return confirm('Yakin ingin menghapus data <?php echo $rs['nm_jenis']; ?> ?')" href="tarif_list.php?aksi=delete&id=<?php echo $rs['id_jenis_pakaian']; ?>">Hapus</a>
		</td>
	</tr>

	<?php $no++;endforeach; ?>
</table>
