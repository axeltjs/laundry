<?php
include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;
error_reporting(0);
	$cari = $_GET['nama'];

	if (empty($cari)) {
		$where = "";
	}else{
		$where = "WHERE id_supplier LIKE '%$cari%' OR nm_supplier LIKE '%$cari%' OR alamat LIKE '%$cari%' OR telp LIKE '%$cari%' ";
	}
?>
<table class="table">
	<tr>
		<td>No</td>
		<td>ID Supplier</td>
		<td>Nama Supplier</td>
		<td>Alamat</td>
		<td>Telpon</td>
		<td>Aksi</td>
	</tr>
	<?php $get = $ini->get('tb_supplier','*',$where,'order by id_supplier asc');
	$no = 1;
	foreach($get as $rs): ?>

	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $rs['id_supplier']; ?></td>
		<td><?php echo $rs['nm_supplier']; ?></td>
		<td><?php echo $rs['alamat']; ?></td>
		<td><?php echo $rs['telp']; ?></td>
		<td><a class="btn-success" href="supplier_edit.php?id=<?php echo $rs['id_supplier']; ?>">Edit</a> |
			<a class="btn-danger" onclick="return confirm('Yakin ingin menghapus data <?php echo $rs['nm_supplier']; ?> ?')" href="supplierlist.php?aksi=delete&id=<?php echo $rs['id_supplier']; ?>">Hapus</a>
		</td>
	</tr>

	<?php $no++;endforeach; ?>
</table>