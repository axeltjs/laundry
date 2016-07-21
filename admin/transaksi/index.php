<?php include '../_header2.php'; ?>

<?php 

	$nik = $_SESSION['nik'];

	$rs_sup = mysqli_query($koneksi,"SELECT * FROM tb_konsumen ORDER BY kd_konsumen DESC LIMIT 0,1");
	$sup = mysqli_fetch_array($rs_sup);
	$id_sup = $sup['kd_konsumen'];

	$rs_cek = mysqli_query($koneksi,"SELECT * FROM tb_transaksi ORDER BY no_transaksi DESC LIMIT 0,1");
	$cek = mysqli_fetch_array($rs_cek);

	if ($cek['sts'] == 0 or empty($cek)) {
		$get = mysqli_query($ini->connection,"SELECT * FROM tb_transaksi ORDER BY no_transaksi DESC LIMIT 0,1 ");
		$rs = mysqli_fetch_array($get);
		$ambil = substr($rs["no_transaksi"], 1, 4) + 1;
		$jadi = "T".sprintf("%04s",$ambil);

		$tgl = date('Y-m-d');

		$kode = $jadi;
		mysqli_query($koneksi,"INSERT INTO tb_transaksi VALUES('$kode','$id_sup','$nik','$tgl','$tgl','0','1') ");
	}else{
		$kode = $cek['no_transaksi'];
	}

 ?>

 <?php if (isset($_POST['submit'])) {
 	$kd_konsumen = $_POST['kd_konsumen'];
 	$nik = $_SESSION['nik'];
 	$tgl_transaksi = $_POST['tgl_transaksi'];
 	$tgl_ambil = $_POST['tgl_ambil'];
 	$diskon = $_POST['diskon'];

 	mysqli_query($koneksi,"UPDATE `db_laundry`.`tb_transaksi` SET 
			`kd_konsumen` = '$kd_konsumen',
			`nik` = '$nik',
			`tgl_transaksi` = '$tgl_transaksi',
			`tgl_ambil` = '$tgl_ambil',
			`diskon` = '$diskon',
			`sts` = '0' WHERE `tb_transaksi`.`no_transaksi` = '$kode'; ");
		$ini->redirect('index.php');
 } ?>

<h2>Transaksi Laundry</h2>
<a class="btn" href="data_transaksi.php">Data Transaksi</a>
<br>
<br>
<body onload="loading()"></body>
<form method="POST">
<table class="table-form">
	
	<tr>
		<td>No. Transaksi</td>
		<td><input type="text" name="kode" id="kode" value="<?php echo $kode ?>" required readonly="readonly"></td>
		<td>&nbsp;</td>
		<td>Tanggal Transaksi</td>
		<td><input type="date" name="tgl_transaksi" required></td>
		<td>&nbsp;</td>
		
	</tr>
	
	<tr>
		<td>Pelanggan</td>
		<td><select name="kd_konsumen">
			<?php $get = $ini->get('tb_konsumen','*','','Order by nm_konsumen asc');
			foreach($get as $record):
			 ?>
			<option value="<?php echo $record['kd_konsumen']; ?>"><?php echo $record['nm_konsumen'] ?></option>
		<?php endforeach; ?>
		</select></td>
		<td>&nbsp;</td>
		<td>Tanggal Ambil</td>
		<td><input type="date" name="tgl_ambil" required></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
	<tr>
		<td>Jenis Laundry</td>
		<td><select id="id_jenis_pakaian" name="id_jenis_pakaian">
			<?php $get2 = mysqli_query($koneksi,"SELECT t.*, j.nm_jenis FROM tb_tarif t 
										LEFT JOIN tb_jenis j ON j.id_jenis = t.id_jenis");
			foreach($get2 as $record2):
			 ?>
			<option value="<?php echo $record2['id_jenis_pakaian']; ?>"><?php echo $record2['nm_jenis']." (".$record2['nm_pakaian'].")" ?></option>
		<?php endforeach; ?>
		</select></td>
		<td>&nbsp;</td>
		<td>Jumlah satuan Pakaian</td>
		<td><input type="number" id="jumlah" onblur="awal()" name="jumlah" min="1"></td>
		<td>&nbsp;</td>	
	</tr>
	<tr>
			<td>Satuan</td>
			<td>
				<select name="satuan" id="satuan" required>
					<option value="Kg">Kg</option>
					<option value="Pcs">Pcs</option>
					<option value="Lsn">Lsn</option>
				</select>
			</td>
			<td>&nbsp;</td>
			<td>Diskon</td>
		<td><input type="number" id="diskon" min="0" max="100" name="diskon" value="0" onblur="akhir()" > <i class="fa fa-percent"></i></td>
		<td>&nbsp;</td>
		</tr>

	<tr>
		<td>Total</td>
		<td><input type="number" min="1" readonly="readonly" id="subtotal" name="subtotal" required></td>
		<td><a class="btn-success" onclick="res()"><i class="fa fa-plus"></i></a></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>

	</tr>
	<tr>
		<td colspan="6"><input class="btn" type="submit" name="submit" value="Selesai"></td>
	</tr>
</table>

<div id="table"></div>
</form>

<script type="text/javascript">
	function awal() {
		var id = $("#id_jenis_pakaian").val();
		var jumlah = $("#jumlah").val();
		$.ajax({
			type:"GET",
			url:"hitung_awal.php",
			data:"id="+id+"&jumlah="+jumlah,
			success:function(html){
				$("#subtotal").val(html);
			}
		});
	}

	function akhir() {
		var id = $("#id_jenis_pakaian").val();
		var jumlah = $("#jumlah").val();
		var diskon = $("#diskon").val();
		$.ajax({
			type:"GET",
			url:"hitung_akhir.php",
			data:"id="+id+"&jumlah="+jumlah+"&diskon="+diskon,
			success:function(html){
				$("#subtotal").val(html);
			}
		});
	}

	function res() {
		var kode = $("#kode").val();
		var id_jenis_pakaian = $("#id_jenis_pakaian").val();
		var jumlah = $("#jumlah").val();
		var satuan = $("#satuan").val();
		var subtotal = $("#subtotal").val();
		if (jumlah == null) {
			alert('Satuan Bobot Pakaian tidak boleh kurang dari 1!');
		}else if(jumlah == 0){
			alert('Satuan Bobot Pakaian tidak boleh kurang dari 1!');
		}else if(subtotal == null){
			alert('Sub Total masih kosong atau 0!');
		}else if(subtotal == 0){
			alert('Sub Total masih kosong atau 0!');
		}else{
			$.ajax({
			type:"GET",
			url:"result_count.php",
			data:"kode="+kode+"&id_jenis_pakaian="+id_jenis_pakaian+"&jumlah="+jumlah+"&satuan="+satuan+"&subtotal="+subtotal,
			success:function(html){
				loading();
				$("#jumlah").val(null);
				$("#subtotal").val(null);
			}
		});
		}
	}

	function loading(){
		var kode = $("#kode").val();
		$.ajax({
			type:"GET",
			url:"result_load.php",
			data:"kode="+kode,
			success:function(html){
				$("#table").html(html);
			}
		});
	}

	function hapus(id){
		$.ajax({
			type:"GET",
			url:"hapus.php",
			data:"kode="+id,
			success:function(html){
				loading();
			}
		})
	}
</script>

<?php include '../_footer2.php'; ?>