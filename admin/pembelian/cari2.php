<?php include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;
error_reporting(0);
	$nama = $_GET['nama'];

	if (empty($nama)) {
		$where = "WHERE p.sts != 1";
	}else{
		$where = "WHERE s.nm_supplier LIKE '%$nama%' AND p.sts != 1  OR k.nm_karyawan LIKE '%$nama%' AND p.sts != 1 OR p.no_pembelian LIKE '%$nama%' AND p.sts != 1 ";
	}
	?>
	<br>
	<br>
<table class="table">
	<tr>
		<td>No Pembelian</td>
		<td>Nama Karyawan</td>
		<td>Nama Supplier</td>
		<td>Tanggal</td>
		<td>Aksi</td>
	</tr>
<?php

 $get = mysqli_query($koneksi,"SELECT p.*, k.nm_karyawan, s.nm_supplier 
						 FROM tb_pembelian p LEFT JOIN tb_karyawan k ON k.nik = p.nik
						 LEFT JOIN tb_supplier s ON s.id_supplier = p.id_supplier
						 $where
						 ORDER BY p.no_pembelian ASC");
	while($rs = mysqli_fetch_array($get)): ?>
	<tr>
		<td><?php echo $rs['no_pembelian']  ?></td>
		<td><?php echo $rs['nm_karyawan'] ?></td>
		<td><?php echo $rs['nm_supplier'] ?></td>
		<td><?php echo $ini->tgl($rs['tgl_pembelian']); ?></td>
		<td><a class="btn-success" href="cetak.php?kode=<?php echo $rs['no_pembelian']; ?>"><i class="fa fa-download"></i></a></td>
	</tr>
<?php endwhile; ?>
</table>