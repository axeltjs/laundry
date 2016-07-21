<?php 
	include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;

	$kode = $_GET['kode'];
	$id_jenis_pakaian = $_GET['id_jenis_pakaian'];
	$jumlah = $_GET['jumlah'];
	$satuan = $_GET['satuan'];
	$subtotal = $_GET['subtotal'];

	$ambil = mysqli_query($koneksi,"SELECT * FROM rincian_transaksi WHERE id_jenis_pakaian = '$id_jenis_pakaian' AND no_transaksi = '$kode' ");

	$rec = mysqli_num_rows($ambil);

	if ($rec == 1) {
		mysqli_query($koneksi,"UPDATE rincian_transaksi SET jumlah = jumlah + '$jumlah',
							  total = total + '$subtotal' WHERE no_transaksi = '$kode' AND id_jenis_pakaian = '$id_jenis_pakaian' ");
		
	}else{
		mysqli_query($koneksi,"INSERT INTO rincian_transaksi (no_transaksi,id_jenis_pakaian,jumlah,satuan,total)
				 VALUES ('$kode','$id_jenis_pakaian','$jumlah','$satuan','$subtotal') ");
	}


	$get = mysqli_query($koneksi,"SELECT rt.*, t.tarif, j.nm_jenis
								  FROM rincian_transaksi rt 
								  LEFT JOIN tb_tarif t ON t.id_jenis_pakaian = rt.id_jenis_pakaian
								  LEFT JOIN tb_jenis j ON j.id_jenis = t.id_jenis
								  WHERE rt.no_transaksi = '$kode' ");

	?>

	<table class="table">

 	<tr>
 		<td>No</td>
 		<td>Nama Jenis</td>
 		<td>Jumlah</td>
 		<td>Satuan</td>
 		<td>Sub Total</td>
 		<td>Aksi</td>
 	</tr>
 	<?php $no=1; while($rs = mysqli_fetch_array($get)): ?>
 	<tr>
 		<td><?php echo $no; ?></td>
 		<td><?php echo $rs['nm_jenis'] ?></td>
 		<td><?php echo $rs['jumlah'] ?></td>
 		<td><?php echo $rs['satuan']; ?></td>
 		<td><?php echo $rs['total'];  ?></td>
 		<td><a class="btn-danger" onclick="hapus('<?php echo $rs['id_rincian']; ?>')"><i class="fa fa-trash"></i></a></td>
 	</tr>
 	<?php $no++; endwhile; ?>
 	<tr>
 		<td>Grand Total</td>
 		<?php $q_total = mysqli_query($koneksi,"SELECT SUM(total) as total 
 			FROM rincian_transaksi WHERE no_transaksi = '$kode' ");
			$end_total = mysqli_fetch_array($q_total);
			$e_total = $end_total['total']; ?>
 		<td colspan="5"><input readonly="readonly" required value="<?php echo $e_total; ?>" name="total"></td>
 	</tr>
 </table> 