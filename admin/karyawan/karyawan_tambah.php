<?php include '../_header2.php'; ?>
<?php 
	
	if (isset($_POST['submit'])) {
		$nik = $_POST['nik'];
		$nm_karyawan = $_POST['nm_karyawan'];
		$alamat = $_POST['alamat'];
		$telp = $_POST['telp'];
		$jenkel = $_POST['jenkel'];

		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$password2 = md5($_POST['password2']);
		$typeuser = $_POST['typeuser'];

		$q_nik = mysqli_query($koneksi,"SELECT * FROM tb_karyawan WHERE nik = '$nik' ");
		$q_htg = mysqli_num_rows($q_nik);

		$q_usr = mysqli_query($koneksi,"SELECT * FROM tb_login WHERE username = '$username' ");
		$q_htg_usr = mysqli_num_rows($q_usr);

		if ($q_htg > 0) {
			echo "<script type='text/javascript'> alert('NIK tidak dapat dipakai! harap ulangi'); </script>";
			$ini->redirect('index.php');
		}elseif($q_htg_usr > 0) {
			echo "<script type='text/javascript'> alert('USERNAME tidak dapat dipakai! harap ulangi'); </script>";
			$ini->redirect('index.php');
		}elseif ($password != $password2) {
			echo "<script type='text/javascript'> alert('Password tidak cocok!, harap ulangi'); </script>";
			$ini->redirect('index.php');
		}else{

		mysqli_query($koneksi,"INSERT INTO tb_karyawan VALUES('$nik','$nm_karyawan','$alamat','$telp','$jenkel')");

		mysqli_query($koneksi,"INSERT INTO tb_login VALUES('$username','$password','$typeuser','$nik')");

		echo "<script type='text/javascript'> alert('Data berhasil ditambahkan!'); </script>";
		$ini->redirect('index.php');
		}
	}

 ?>
<h2>Tambah Karyawan</h2>

<form method="post">
	<div id="warning2"></div>
	<table class="table-form">
		<tr>
			<td style="background-color:#376a88; color:#fff" colspan="2">Data Karyawan</td>
		</tr>
		<tr>
			<td>NIK</td>
			<td><input name="nik" id="nik" onblur="cek2()" maxlength="20" required></td>
		</tr>
		<tr>
			<td>Nama Karyawan</td>
			<td><input name="nm_karyawan" required></td>
		</tr>
		<tr>
			<td>Alamat Karyawan</td>
			<td><textarea name="alamat" required></textarea></td>
		</tr>
		<tr>
			<td>Telpon Karyawan</td>
			<td>
				<input name="telp" required>
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
			<td><input type="text" name="username" id="username" onblur="cek()" required></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password" required></td>
		</tr>
		<tr>
			<td>Re-Type Password</td>
			<td><input type="password" name="password2" required></td>
		</tr>
		<tr>
			<td>Type User (Hak Akses)</td>
			<td>
				<select name="typeuser">
					<option value="admin">Admin</option>
					<option value="operator">Operator</option>
					<option value="kasir">Kasir</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="btn" type="submit" id="submit" value="Submit" name="submit">
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">
function cek() {
	var username = $("#username").val();
		$.ajax({
			type:"GET",
			url:"cek.php",
			data:"username="+username,
			success:function(html){
				$("#warning").html(html);
			}
		});
	}

function cek2() {
	var nik = $("#nik").val();
		$.ajax({
			type:"GET",
			url:"cek2.php",
			data:"nik="+nik,
			success:function(html){
				$("#warning2").html(html);
			}
		});
	}
</script>

<?php include '../_footer2.php'; ?>