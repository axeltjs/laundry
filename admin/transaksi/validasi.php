<?php include '../_header2.php'; ?>
<?php 

    $kode = $_GET['kode'];

    if(isset($_POST['submit'])){
        //post
        $nama = $_POST['pengambil'];
        $kontak = $_POST['kontak_pengambil'];
        $tanggal = $_POST['tanggal_ambil'];
        $kode = $_POST['kode'];

        // security purposes
        $get = mysqli_query($koneksi, "SELECT * FROM tb_transaksi WHERE no_transaksi = '$kode'");
        $result = mysqli_fetch_array($get);
        if(!isset($result)){
            return $ini->redirect('/admin/transaksi');
        }
        // insert if okay
        mysqli_query($koneksi, "UPDATE tb_transaksi SET nama_pengambil = '$nama', kontak_pengambil = '$kontak', tanggal_ambil = '$tanggal' 
                                WHERE no_transaksi = '$kode'");
        return $ini->redirect('/admin/transaksi');
    }
?>
<h2>Validasi Transaksi Laundry</h2>
<a class="btn" href="/admin/transaksi/data_transaksi.php">Data Transaksi</a>
<br>
<br>
<form method="POST">
<table class="table-form">
	<tr>
		<td>No. Transaksi</td>
		<td><input type="text" name="kode" id="kode" value="<?php echo $kode; ?>" required readonly="readonly" ></td>
	</tr>
	<tr>
        <td>Nama Pengambil</td>
        <td><input type="text" name="pengambil" placeholder="ex: John"></td>
    </tr>
	<tr>
        <td>Kontak Pengambil</td>
        <td><input type="text" name="kontak_pengambil" placeholder="ex: 08123345567"></td>
    </tr>
	<tr>
        <td>Tanggal Ambil</td>
        <td><input type="date" name="tanggal_ambil"></td>
    </tr>
	<tr>
        <td colspan="2"> 
            <input type="submit" name="submit" value="Simpan" class="btn">    
        </td>
    </tr>
</table>
</form>
<?php include '../_footer2.php'; ?>