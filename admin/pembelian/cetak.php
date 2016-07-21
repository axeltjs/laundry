<?php 
include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;

	header('content-type=application/vhd.ms-excel');
	header('content-disposition:attachment;filename=Laporan_Pembelian.xls');

$kode = $_GET['kode'];

$get = mysqli_query($koneksi, "SELECT p.*, k.nm_karyawan, b.* ,rp.*, s.nm_supplier 
						 FROM tb_pembelian p LEFT JOIN tb_karyawan k ON k.nik = p.nik
						 LEFT JOIN tb_supplier s ON s.id_supplier = p.id_supplier
						 LEFT JOIN rincian_pembelian rp ON rp.no_pembelian = p.no_pembelian
						 LEFT JOIN tb_barang b ON b.kd_barang = rp.kd_barang 
						 WHERE p.no_pembelian = '$kode'
						 ORDER BY p.no_pembelian ASC");
$rs = mysqli_fetch_array($get);
?>

<table border='1'>
	<tr>
		<td>Tanggal Pembelian</td>
		<td><?php echo $ini->tgl($rs['tgl_pembelian']); ?></td>
	</tr>
	<tr>
		<td>Nama Petugas</td>
		<td><?php echo $rs['nm_karyawan']; ?></td>
	</tr>
	<tr>
		<td>Nama Supplier</td>
		<td><?php echo $rs['nm_supplier']; ?></td>
	</tr>
</table>

<table border='1'>
	<tr>
		<td colspan="5">Rincian Data Barang</td>
	</tr>
	<tr>
		<td width="2%">No</td>
		<td>Kode</td>
		<td>Nama Barang</td>
		<td>Jumlah</td>
		<td>Sub Total</td>
	</tr>
	<?php 
	$no = 1;
	$query =  mysqli_query($koneksi, "SELECT p.*, k.nm_karyawan, b.* ,rp.*, s.nm_supplier 
						 FROM tb_pembelian p LEFT JOIN tb_karyawan k ON k.nik = p.nik
						 LEFT JOIN tb_supplier s ON s.id_supplier = p.id_supplier
						 LEFT JOIN rincian_pembelian rp ON rp.no_pembelian = p.no_pembelian
						 LEFT JOIN tb_barang b ON b.kd_barang = rp.kd_barang 
						 WHERE p.no_pembelian = '$kode'
						 ORDER BY p.no_pembelian ASC");
	while ($re = mysqli_fetch_array($query)): ?>
	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $re['kd_barang']; ?></td>
		<td><?php echo $re['nm_barang']; ?></td>
		<td><?php echo $re['jumlah']; ?></td>
		<td><?php echo ($re['jumlah'] * $re['harga']); ?></td>
	</tr>
	<?php $no++; endwhile; ?>
	<tr>
		<td colspan="5">Total : <?php echo $rs['total']; ?></td>
	</tr>
</table>