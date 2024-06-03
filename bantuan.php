<?php
include'koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$gusmint = date('Y-m-d H:i:s');
$hasil = mysqli_query($koneksi,"SELECT * FROM pengaturan");
$tgl = mysqli_fetch_array($hasil);
$cendekia = $tgl['mulai'];
$pengaturan = mysqli_query($koneksi,"SELECT * FROM pengaturan");
$judul = mysqli_fetch_array($pengaturan);
$title = $judul['lembaga'];
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
							
								<span class="login100-form-title">
								<img src="images/logo.png" alt="smk_nu_kesesi" style="max-width:180px; height:auto;"><br>
								<upper style="text-transform: uppercase;">sukseskan smartvote osis<br>smk nu kesesi<br>2023</upper>
								</span>
								<p>Fitur Bantuan dibuka mulai tanggal <?php echo $cendekia;?>.</p>
							<?php
    if ($gusmint >= $cendekia){
	    echo"<form method='post' class='login100-form validate-form'>
            <div class='wrap-input100 validate-input'>
                <input type='text' name='nomor' id='teks' class='input100' placeholder='Masukkan NISN' required >
                <span class='focus-input100'></span>
				    <span class='symbol-input100'>
					    <i class='fa fa-user' aria-hidden='true'></i>
			    </span>
			</div>
            <div class='container-login100-form-btn'>
				<button class='login100-form-btn' type='submit' name='submit' id='tombol' >Cari</button>
			</div>
        <br>
        </form>";
    }else {
	echo"
	        <div class='login100-form validate-form'>
	        <div class='container-login100-form-btn'>
				<h3 class='btn btn-warning' >Fitur Bantuan Belum dibuka</h3>
			</div>
			<div class='container-login100-form-btn'>
			    <a href='index.php' class='login100-form-btn'>LOGIN</a>
			</div>
			</div>
        <br>
	";
	}

?>
				
		<?php
		if(isset($_REQUEST['submit'])){
			//tampilkan hasil queri jika ada
			$nim = $_REQUEST[addslashes('nomor')];
			
			$hasil = mysqli_query($koneksi,"SELECT * FROM registrasi WHERE nim='$nim'");
			if(mysqli_num_rows($hasil) > 0){
				$data = mysqli_fetch_array($hasil);
				
		?>
			
			<table class="table table-bordered">
				<tr><td>NISN</td><td><?php echo $data['nim']; ?></td></tr>
				<tr><td>Password</td><td><strong><?php echo $data['kode_akses']; ?></strong></td></tr>
				<tr><td>Nama</td><td><?php echo $data['nama_mhs']; ?></td></tr>
			</table>
			<div class="alert alert-danger" role="alert" style="text-align:justify;"><strong><center>
			<?php echo "GUNAKAN HAK PILIH ANDA MASING-MASING<br>";	?>
			</center></strong></div><br>
		    <div class='login100-form validate-form'>
		    <div class='container-login100-form-btn'>
			    <a href='index.php' class='login100-form-btn'>LOGIN</a>
			</div>
			</div>
		<?php
			} else {
				echo 'Data yang anda inputkan tidak ditemukan! </br>Silahkan hubungi admin atau petugas administrasi!<br>';
				//tampilkan pop-up dan kembali tampilkan form
			}
		} 
		?>				
								
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