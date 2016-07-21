<?php
include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;
	error_reporting(0);
	$cari = $_GET['nama'];

	if (empty($cari)) {
		$where = "";
	}else{
		$where = "WHERE b.nm_barang LIKE '%$cari%' OR k.nm_karyawan LIKE '%$cari%' OR p.kd_pengeluaran LIKE '%$cari%' ";
	}
?>


<table class="table">
	<tr>
		<td>No</td>
		<td>Kode Pemakaian</td>
		<td>Nama Karyawan</td>
		<td>Nama Barang</td>
		<td>Jumlah</td>
		<td>Aksi</td>
	</tr>
	<?php $get = mysqli_query($koneksi,"SELECT b.nm_barang, k.nm_karyawan, p.kd_pengeluaran, p.jumlah FROM tb_pemakaian p 
								LEFT JOIN tb_barang b ON b.kd_barang = p.kd_barang 
								LEFT JOIN tb_karyawan k ON k.nik = p.nik $where");
	$no = 1;
	foreach($get as $rs): ?>

	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $rs['kd_pengeluaran']; ?></td>
		<td><?php echo $rs['nm_karyawan']; ?></td>
		<td><?php echo $rs['nm_barang'] ?></td>
		<td><?php echo $rs['jumlah']; ?></td>
		<td><a class="btn-danger" onclick="return confirm('Yakin ingin menghapus data <?php echo $rs['kd_pengeluaran']; ?> ?')" href="pemakaian_list.php?aksi=delete&id=<?php echo $rs['kd_pengeluaran']; ?>">Hapus</a>
		</td>
	</tr>

	<?php $no++;endforeach; ?>
</table>