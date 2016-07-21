<?php session_start();
	include 'admin/modul.php';
	$ini = new modul;
	error_reporting(0);
	$koneksi = $ini->connection;

	if (isset($_POST['submit'])) {
		$username = mysqli_real_escape_string($koneksi,$_POST['username']);
		$password = mysqli_real_escape_string($koneksi,$_POST['password']);
			$get = mysqli_query($koneksi,"SELECT * FROM tb_login WHERE username = '$username' AND password = md5('$password') ");
			$rs = mysqli_fetch_array($get);
		$count = mysqli_num_rows($get);
		if ($count < 1) {
			$error = "<div class='err'><i class='fa fa-warning'></i> Username atau Password salah!</div>";
		}else{
			$_SESSION['username'] = $rs['username'];
			$_SESSION['nik'] = $rs['nik'];
			$_SESSION['hak_akses'] = $rs['typeuser'];
			$ini->redirect('admin/index.php');
		}
	}
 ?>
<html>
<head>
	<title>Login Sistem Informasi Laundry</title>
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png" />
	<link rel="stylesheet" type="text/css" href="assets/font/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>
<body>
	
	<form method="POST">
		<a href="index.php"><img src="assets/img/logo1.png" height="60" width="160"></a>
		<br>
		<br>
		<table>
			<tr>
				<td><div class="logo"><i class="fa fa-user"></i></div> <input type="text" autofocus name="username" placeholder="Username"></td>
			</tr>
			<tr>
				<td><div class="logo"><i class="fa fa-lock"></i></div><input type="password" name="password" placeholder="Password"></td>
			</tr>
			<tr>
				<td><input class="btn" type="submit" name="submit" value="Login"></td>
			</tr>
		</table>
		<?php echo $error; ?>
	</form>
</body>
</html>