<?php
session_start();
include'koneksi.php';

if(isset($_POST['login'])){
	$nim = mysqli_real_escape_string($koneksi, $_POST['nim']);
	$kode_akses = mysqli_real_escape_string($koneksi, $_POST['kode_akses']);
	$data_akses = mysqli_query($koneksi, "SELECT * FROM registrasi WHERE nim='$nim' and kode_akses='$kode_akses'");
	$r = mysqli_fetch_array($data_akses);
	$nim = $r['nim'];
	$kode_akses = $r['kode_akses'];
	$nama_mhs = $r['nama_mhs'];
	$jurusan = $r['jurusan'];
	$kampus = $r['kampus'];
	$level = $r['level'];
	if( mysqli_num_rows($data_akses) === 1 ){
		$_SESSION["login"] = true;
		$_SESSION['nim'] = $nim;
		$_SESSION['nama_mhs'] = $nama_mhs;
		$_SESSION['jurusan'] = $jurusan;
		$_SESSION['kampus'] = $kampus;
		$_SESSION['level'] = $level;
		header('location:sistem');
	}else{
		echo "<script type='text/javascript'>
		setTimeout(function () {
			swal({
				title: 'Kode Akses Salah',
				type: 'warning',
				timer: 3200,
				showConfirmButton: true
				});
				},10);
				window.setTimeout(function(){
					window.location.replace('index.php');
					},3000);
					</script>";
				}
			}
$pengaturan = mysqli_query($koneksi,"SELECT * FROM pengaturan");
$gusmint = mysqli_fetch_array($pengaturan);
$title = $gusmint['lembaga'];
?>

<!DOCTYPE html>
<html lang="en">
			<head>
				<title><?php echo $title; ?></title>
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta itemprop="description" content="pemungutan suara online merupakan aplikasi berbasis web online praktis yang digunakan untuk pemilihan calon pemimpin" />
				<link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
				<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
				<!--===============================================================================================-->	
				<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
				<!--===============================================================================================-->
				<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
				<!--===============================================================================================-->
				<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
				<!--===============================================================================================-->
				<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
				<!--===============================================================================================-->	
				<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
				<!--===============================================================================================-->
				<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
				<!--===============================================================================================-->
				<link rel="stylesheet" type="text/css" href="css/util.css">
				<link rel="stylesheet" type="text/css" href="css/main.css">
				<!--===============================================================================================-->
			</head>
			<body>

				<div class="limiter">
					<div class="container-login100">
						<div class="wrap-login100">

							<form class="login100-form validate-form" action="" method="post">
								<span class="login100-form-title">
								<img src="images/logo.png" alt="smk_nu_kesesi" style="max-width:180px; height:auto;"><br>
								<upper style="text-transform: uppercase;">
								    <?php echo $gusmint['voting']; ?> <br> <?php echo $title; ?> <br> <?php echo $gusmint['tambahan']; ?>
								</upper>
								</span>
								<div class="wrap-input100 validate-input">
									<input class="input100" type="text" name="nim" id="nim" placeholder="NISN..." autocomplete="off" required="required">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fa fa-user" aria-hidden="true"></i>
									</span>
								</div>
								<div class="wrap-input100 validate-input">
									<input class="input100" type="password" name="kode_akses" id="kode_akses" placeholder="Password..." autocomplete="off" required="required">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fa fa-lock" aria-hidden="true"></i>
									</span>
								</div>

								<div class="container-login100-form-btn">
									<button class="login100-form-btn" name="login" id="login" type="submit">
										LOGIN
									</button>
								</div>
							    <div class="container-login100-form-btn">
									<a href="bantuan.php" class="login100-form-btn">Bantuan</a>
								</div>
								<br><br>
								<div class="text-center p-t-12">
									<span class="txt1">
									</span>
									<a class="txt2" href="https://www.youtube.com/@SMKNUKesesiOfficial/featured">
										<p><?php echo $title ?></p>
									</a>
								</div>


							</form>
						</div>
					</div>
				</div>

				<script src="js/sweetalert.min.js"></script>
				<!--===============================================================================================-->	
				<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
				<!--===============================================================================================-->
				<script src="vendor/bootstrap/js/popper.js"></script>
				<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
				<!--===============================================================================================-->
				<script src="vendor/select2/select2.min.js"></script>
				<!--===============================================================================================-->
				<script src="vendor/tilt/tilt.jquery.min.js"></script>
				<script >
					$('.js-tilt').tilt({
						scale: 1.1
					})
				</script>
				<!--===============================================================================================-->
				<script src="js/main.js"></script>

	</body>

</html>