<?php 

	include '../modul.php';
	$ini = new modul;
	$koneksi = $ini->connection;

		$no_pembelian = $_GET['kode'];
		$kd_barang = $_GET['kd_barang'];
		$jumlah = $_GET['jumlah'];

		$ambil = mysqli_query($koneksi,"SELECT * FROM rincian_pembelian WHERE no_pembelian = '$no_pembelian' AND kd_barang = '$kd_barang' ");

		$rec = mysqli_num_rows($ambil);

	if ($rec == 1) {
		mysqli_query($koneksi,"UPDATE rincian_pembelian SET jumlah = jumlah + '$jumlah' WHERE no_pembelian = '$no_pembelian' AND kd_barang = '$kd_barang' ");
		//update stok
		mysqli_query($koneksi,"UPDATE tb_barang SET stok = stok + '$jumlah' WHERE kd_barang = '$kd_barang' ");
		
	}else{
		mysqli_query($koneksi,"INSERT INTO rincian_pembelian (no_pembelian,kd_barang,jumlah) VALUES('$no_pembelian','$kd_barang','$jumlah') ");
		//update stok
		mysqli_query($koneksi,"UPDATE tb_barang SET stok = stok + '$jumlah' WHERE kd_barang = '$kd_barang' ");
	}

		//show it

		$get = mysqli_query($koneksi,"SELECT r.*,b.nm_barang, b.harga FROM rincian_pembelian r 
										LEFT JOIN tb_barang b ON b.kd_barang = r.kd_barang
										WHERE r.no_pembelian = '$no_pembelian' ");

 ?>

 <table class="table">

 	<tr>
 		<td>No</td>
 		<td>Nama Barang</td>
 		<td>Jumlah</td>
 		<td>Sub Total</td>
 		<td>Aksi</td>
 	</tr>
 	<?php $no=1; while($rs = mysqli_fetch_array($get)): ?>
 	<tr>
 		<td><?php echo $no; ?></td>
 		<td><?php echo $rs['nm_barang'] ?></td>
 		<td><?php echo $rs['jumlah'] ?></td>
 		<td><?php echo ($rs['harga'] * $rs['jumlah'])  ?></td>
 		<td><a class="btn-danger" onclick="hapus('<?php echo $rs['no_rincian']; ?>')"><i class="fa fa-trash"></i></a></td>
 	</tr>
 	<?php $no++; endwhile; ?>
 	<tr>
 		<td>Total</td>
 		<?php $q_total = mysqli_query($koneksi,"SELECT SUM(b.harga * r.jumlah) as total FROM rincian_pembelian r 
										LEFT JOIN tb_barang b ON b.kd_barang = r.kd_barang
										WHERE r.no_pembelian = '$no_pembelian'");
			$end_total = mysqli_fetch_array($q_total);
			$e_total = $end_total['total']; ?>
 		<td colspan="4"><input readonly="readonly" required value="<?php echo $e_total; ?>" name="total"></td>
 	</tr>
 </table>