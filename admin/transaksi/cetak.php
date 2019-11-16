<?php 
include '../modul.php';
    $ini = new modul();
    $koneksi = $ini->connection;

    // header('content-type=application/vhd.ms-excel');
    // header('content-disposition:attachment;filename=Laporan_Transaksi.xls');

$kode = $_GET['kode'];

$get = mysqli_query($koneksi, "SELECT tb_transaksi.*, jen.nm_jenis, rt.*, c.nm_karyawan, tar.tarif, kon.nm_konsumen FROM tb_transaksi 
 	LEFT JOIN tb_konsumen kon ON kon.kd_konsumen = tb_transaksi.kd_konsumen 
 	LEFT JOIN tb_login c ON c.nik = tb_transaksi.nik 
 	LEFT JOIN rincian_transaksi rt ON rt.no_transaksi = tb_transaksi.no_transaksi
 	LEFT JOIN tb_tarif tar ON tar.id_jenis_pakaian = rt.id_jenis_pakaian
 	LEFT JOIN tb_jenis jen ON jen.id_jenis = tar.id_jenis
 	WHERE tb_transaksi.no_transaksi = '$kode'
 	GROUP BY tb_transaksi.no_transaksi") or die(mysqli_error($koneksi));
$rs = mysqli_fetch_array($get);
?>

<script>
	window.print();
</script>
<h1>Radja Q-Lau</h1><br>
<h4>Terima kasih telah menjadi Pelanggan di Radja Q-Lau</h4>
<table width="100%">
	<tr>
		<td width="5%">Nama Pelanggan</td>
		<td width="1%">:</td>
		<td width="80%"><?php echo $rs['nm_konsumen']; ?></td>
	</tr>
	<tr>
		<td>Tanggal Transaksi</td>
		<td><?php echo $ini->tgl($rs['tgl_transaksi']); ?></td>
	</tr>
	<tr>
		<td>Tanggal Pengambilan</td>
		<td><?php echo $ini->tgl($rs['tgl_ambil']); ?></td>
	</tr>
	<tr>
		<td>Nama Petugas</td>
		<td><?php echo $rs['nm_karyawan']; ?></td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td>No</td>
		<td>Jenis Laundry</td>
		<td>Harga</td>
		<td>Bobot Satuan Laundry</td>
		<td>Sub Total</td>
	</tr>
	<?php 
        $query = mysqli_query($koneksi, "SELECT tb_transaksi.*, jen.nm_jenis, rt.*, c.nm_karyawan, tar.tarif, kon.nm_konsumen FROM tb_transaksi 
 	LEFT JOIN tb_konsumen kon ON kon.kd_konsumen = tb_transaksi.kd_konsumen 
 	LEFT JOIN tb_login c ON c.nik = tb_transaksi.nik 
 	LEFT JOIN rincian_transaksi rt ON rt.no_transaksi = tb_transaksi.no_transaksi
 	LEFT JOIN tb_tarif tar ON tar.id_jenis_pakaian = rt.id_jenis_pakaian
 	LEFT JOIN tb_jenis jen ON jen.id_jenis = tar.id_jenis
 	WHERE tb_transaksi.no_transaksi = '$kode'")or die(mysqli_error($koneksi));
        $no = 1;
        while ($rec = mysqli_fetch_array($query)):
     ?>
	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $rec['nm_jenis']; ?></td>
		<td><?php echo number_format($rec['tarif']); ?></td>
		<td><?php echo $rec['jumlah'].' '.$rec['satuan']; ?></td>
		<td><?php echo number_format($rec['total']); ?></td>
	</tr>
	<?php ++$no; endwhile; ?>
	<tr>
		<td colspan="5">Total : <?php 
            $q = mysqli_query($koneksi, "SELECT SUM(total) as total FROM tb_transaksi 
 	LEFT JOIN tb_konsumen kon ON kon.kd_konsumen = tb_transaksi.kd_konsumen 
 	LEFT JOIN tb_login c ON c.nik = tb_transaksi.nik 
 	LEFT JOIN rincian_transaksi rt ON rt.no_transaksi = tb_transaksi.no_transaksi
 	LEFT JOIN tb_tarif tar ON tar.id_jenis_pakaian = rt.id_jenis_pakaian
 	LEFT JOIN tb_jenis jen ON jen.id_jenis = tar.id_jenis
 	WHERE tb_transaksi.no_transaksi = '$kode'
 	GROUP BY tb_transaksi.no_transaksi");
            $rsq = mysqli_fetch_array($q);
            echo number_format($rsq['total']) or die(mysqli_error($koneksi));
          ?></td>
	</tr>
</table>

