<?php include '../_header2.php'; ?>
<?php 
	
	if (isset($_POST['submit'])) {
		$nik = $_POST['nik'];
		$nm_karyawan = $_POST['nm_karyawan'];
		$alamat = $_POST['alamat'];
		$telp = $_POST['telp'];
		$jenkel = $_POST['jenkel'];

		$username = $_POST['username'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		$typeuser = $_POST['typeuser'];

		if ($password != $password2) {
			echo "<script type='text/javascript'> alert('Password tidak cocok!, harap ulangi'); </script>";
			$ini->redirect('index.php');
		}else{

		mysqli_query($koneksi,"UPDATE tb_karyawan SET nm_karyawan = '$nm_karyawan',
														alamat = '$alamat',
														telp = '$telp',
														jenkel = '$jenkel'
														WHERE nik = '$nik' ");
		if (empty($password) or empty($password2)) {
			mysqli_query($koneksi,"UPDATE tb_login SET
													typeuser = '$typeuser'
													WHERE username = '$username' ");
		}else{
		mysqli_query($koneksi,"UPDATE tb_login SET password = md5('$password'),
													typeuser = '$typeuser'
													WHERE username = '$username' ");
		}
		echo "<script type='text/javascript'> alert('Data berhasil ditambahkan!'); </script>";
		$ini->redirect('index.php');
		}
	}

 ?>

 <?php $nik = $_GET['nik'];
	$get = mysqli_query($koneksi,"SELECT k.*,u.* FROM tb_karyawan k LEFT JOIN
								  tb_login u ON u.nik = k.nik WHERE k.nik = '$nik' ");
	$rs = mysqli_fetch_array($get); ?>

<h2>Tambah Karyawan</h2>

<form method="post">
	<div id="warning2"></div>
	<table class="table-form">
		<tr>
			<td style="background-color:#376a88; color:#fff" colspan="2">Data Karyawan</td>
		</tr>
		<tr>
			<td>NIK</td>
			<td><input name="nik" id="nik" onblur="cek2()" value="<?php echo $rs['nik']; ?>" readonly="readonly" maxlength="20" required></td>
		</tr>
		<tr>
			<td>Nama Karyawan</td>
			<td><input name="nm_karyawan" value="<?php echo $rs['nm_karyawan'] ?>" required></td>
		</tr>
		<tr>
			<td>Alamat Karyawan</td>
			<td><textarea name="alamat" required><?php echo $rs['alamat']; ?></textarea></td>
		</tr>
		<tr>
			<td>Telpon Karyawan</td>
			<td>
				<input name="telp" value="<?php echo $rs['telp']; ?>" required>
			</td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>
				<select name="jenkel" required>
					<option value="L">Laki - Laki</option>
					<option value="P">Perempuan</option>
				</select>
			</td>
		</tr>
	</table>
<div id="warning"></div>
	<table class="table-form">
		<tr>
			<td style="background-color:#376a88; color:#fff" colspan="2">Login Karyawan</td>
		</tr>
		<tr>
			<td>Username</td>
			<td><input type="text" name="username" value="<?php echo $rs['username'] ?>" readonly="readonly" id="username" onblur="cek()" required></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password" ></td>
		</tr>
		<tr>
			<td>Re-Type Password</td>
			<td><input type="password" name="password2" ></td>
		</tr>
		<tr>
			<td>Type User (Hak Akses)</td>
			<td>
				<select name="typeuser">
					<option value="<?php echo $rs['typeuser']; ?>"> -- Pilih Hak Akses -- </option>
					<option value="admin">Admin</option>
					<option value="operator">Operator</option>
					<option value="kasir">Kasir</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="btn" type="submit" value="Submit" name="submit">
			</td>
		</tr>
	</table>
</form>

<?php include '../_footer2.php'; ?>