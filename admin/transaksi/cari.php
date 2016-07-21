<?php
include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;
error_reporting(0);
	$cari = $_GET['cari'];

	if (empty($cari)) {
		$where = "WHERE tb_transaksi.sts != 1";
	}else{
		$where = "WHERE tb_transaksi.tgl_transaksi LIKE '%$cari%' AND tb_transaksi.sts != 1 OR tb_transaksi.tgl_ambil LIKE '%$cari%' AND tb_transaksi.sts != 1";
	}
?>
<table class="table">
	<tr>
		<td>No Transaksi</td>
		<td>Nama Karyawan</td>
		<td>Nama Konsumen</td>
		<td>Tanggal Transaksi</td>
		<td>Tanggal Ambil</td>
		<td>Total Biaya</td>
		<td>Aksi</td>
	</tr>
	<?php 
 $get = mysqli_query($koneksi,"SELECT tb_transaksi.*, c.nm_karyawan, kon.nm_konsumen FROM tb_transaksi 
 	LEFT JOIN tb_konsumen kon ON kon.kd_konsumen = tb_transaksi.kd_konsumen 
 	LEFT JOIN tb_karyawan c ON c.nik = tb_transaksi.nik 
 	LEFT JOIN rincian_transaksi rt ON rt.no_transaksi = tb_transaksi.no_transaksi
 	$where
 	GROUP BY tb_transaksi.no_transaksi
 	ORDER BY tb_transaksi.no_transaksi ASC");
	while($rs = mysqli_fetch_array($get)): ?>
	<tr>
		<td><?php echo $no_trans = $rs['no_transaksi']  ?></td>
		<td><?php echo $rs['nm_karyawan'] ?></td>
		<td><?php echo $rs['nm_konsumen'] ?></td>
		<td><?php echo $ini->tgl($rs['tgl_transaksi']) ?></td>
		<td><?php echo $ini->tgl($rs['tgl_ambil']) ?></td>
		<td><?php $rs_tot = mysqli_query($koneksi, "SELECT SUM(rt.total) as total 
			FROM rincian_transaksi as rt WHERE no_transaksi = '$no_trans'
			GROUP BY no_transaksi ");
			$rec = mysqli_fetch_array($rs_tot);
			echo number_format($rec['total']); ?></td>
		<td><a class="btn-success" href="cetak.php?kode=<?php echo $rs['no_transaksi']; ?>"><i class="fa fa-download"></i></a></td>
	</tr>
<?php endwhile; ?>
</table>

