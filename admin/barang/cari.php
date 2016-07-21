<?php
include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;
	error_reporting(0);
	$cari = $_GET['nama'];

	if (empty($cari)) {
		$where = "";
	}else{
		$where = "WHERE nm_barang LIKE '%$cari%' OR kd_barang LIKE '%$cari%' ";
	}
?>

<table class="table">
	<tr>
		<td>No</td>
		<td>Kode barang</td>
		<td>Nama barang</td>
		<td>Stok</td>
		<td>Satuan</td>
		<td>Harga Satuan</td>
		<td>Tanggal Update</td>
		<td>Aksi</td>
	</tr>
	<?php $get = mysqli_query($koneksi,"SELECT * FROM tb_barang $where ORDER BY kd_barang ASC");
	$no = 1;
	foreach($get as $rs): ?>

	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $rs['kd_barang']; ?></td>
		<td><?php echo $rs['nm_barang']; ?></td>
		<td><?php echo $rs['stok']; ?></td>
		<td><?php echo $rs['satuan']; ?></td>
		<td><?php echo $rs['harga']; ?></td>
		<td><?php echo $ini->tgl($rs['tgl_stok']); ?></td>
		<td><a class="btn-success" href="barang_edit.php?id=<?php echo $rs['kd_barang']; ?>">Edit</a> |
			<a class="btn-danger" onclick="return confirm('Yakin ingin menghapus data <?php echo $rs['nm_barang']; ?> ?')" href="barang_list.php?aksi=delete&id=<?php echo $rs['kd_barang']; ?>">Hapus</a>
		</td>
	</tr>

	<?php $no++;endforeach; ?>
</table>
