<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("location:../index.php");
  exit;
}
include'../koneksi.php';
$pengaturan = mysqli_query($koneksi,"SELECT * FROM pengaturan");
while ($gusmint = mysqli_fetch_array($pengaturan)){
	$title = $gusmint['lembaga'];
}
if(isset($_POST['simpan'])) {
  date_default_timezone_set('Asia/jakarta');
  $waktu = date('H:i:sa');
  $nim = $_SESSION['nim'];
  $nama_mhs= $_SESSION['nama_mhs'];
  $jurusan= $_SESSION['jurusan'];
  $jenis = $_POST['jenis'];
  $vote = $_POST['vote'];
  $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tbl_paslon WHERE nim='$nim' AND jenis='$jenis' "));
  if ($cek > ""){
    echo"<script>window.alert('Anda tidak bisa melakukan voting lagi')
          window.location='terimakasih.php'</script>";
        }
	else {
        mysqli_query($koneksi,"INSERT INTO tbl_paslon(nim, nama_mhs, jurusan, jenis, vote, waktu)
            VALUES ('$nim','$nama_mhs','$jurusan','$jenis','$vote','$waktu')");

          echo"<script>window.alert('Voting Berhasil')
          window.location='index.php'</script>";
        }
      }
?>
      <!DOCTYPE html>
      <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta itemprop="description" content="<?php echo $title; ?>" />
		<link rel="shortcut icon" href="../icons/favicon.ico">
        <title><?php echo $title; ?></title>
        <!---------------------------------------------------------------------->
        <link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
        <!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="assets/css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   
    </head>
    <body>

	<div id="wrapper">
    <?php
	include "view/header.php";
	?>
      <div id="page-wrapper" >
        <div id="page-inner">

          <div class="row">
            <div class="col-lg-12 ">
              <div class="alert alert-info">
                <strong><h3><i class="fa fa-desktop"> Kertas Suara Online</i>: <b><?php echo $_SESSION['nama_mhs']; ?></b></h2></strong>
		<!--		<p><i style="color: black;">"Menyongsong muda mudi milenial menjadi pemimpin cemerlang"</i></p> -->
              </div>   
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
             <div class="alert alert-success">
              <div class="row">
                <div class="col-lg-12">
                  <h2 align="center"><b>PEMILIHAN SENATOR</b></h2><br>
                  <form action="" method="post">
                    <?php
                    $jur = $_SESSION['jurusan'];
					$data_paslon = mysqli_query($koneksi,"SELECT * FROM data_paslon WHERE jenis = '5' order by no_urut ASC");
                    while($d = mysqli_fetch_array($data_paslon)){
                      ?>
                      <div class="col-lg-6">
                        <table class="table table-striped table-bordered table-hover">
                          <tr>
                            <input type="hidden" name="jenis" class="form-control" value="5">
							<td style="background-color:#214761; color: white; font-size: 50px; text-align: center;"><b><?php echo $d['no_urut']; ?></b>
                            </td>
                          </tr>
                          <tr>
                            <td><img style="width: 100%;" src="<?php echo "foto/".$d['gambar1']; ?>"></td> 
                          </tr>
                          <tr>
                            <td align="center"><h3><?php echo $d['nm_paslon']; ?></h3></td>
                          </tr>
						  <tr>
                            <td style="background-color:#214761; color: white; font-size: 20px; text-align: center;">Visi Misi</td>
                          </tr>
						  <tr>
                            <td><img style="width: 100%;" src="<?php echo "foto/".$d['gambar2']; ?>"</td>
                          </tr>
                          <tr>
                            <td style="text-align: center; padding:10px; background-color:#214761;"><input type="radio" style="width:25px;height:25px;background:#000961;" required="required" name="vote" value="<?php echo $d['no_urut']; ?>"></td>
                          </tr>
                        </table>
                      </div>
                    <?php } ?>
				
<?php
date_default_timezone_set('Asia/jakarta');
$gusmint = date('Y-m-d H:i:s');
$hasil = mysqli_query($koneksi,"SELECT * FROM pengaturan");
$tgl = mysqli_fetch_array($hasil);
$mulai = $tgl['mulai'];
$selesai = $tgl['selesai'];
if ($gusmint >= $selesai){
	echo"
        <input style='color: white; font-size: 20px; padding: 10px; border-radius: 15px; width: 100%;' type='submit' name='simpan' value='PILIH' class='btn btn-success' onclick='return confirm('YAKIN DENGAN PILIHAN ANDA')' disabled>
        <center><h2 style='color:red;align:center;padding: 10px; border-radius: 15px; width: 100%;'><strong>- waktu pemilihan sudah ditutup -</strong></h2></center>
        ";
}
elseif ($gusmint >= $mulai){
	echo"
        <input style='color: white; font-size: 20px; padding: 10px; border-radius: 15px; width: 100%;' type='submit' name='simpan' value='PILIH' class='btn btn-success' onclick='return confirm('YAKIN DENGAN PILIHAN ANDA')'>
        ";
}
else{
	echo"
        <input style='color: white; font-size: 20px; padding: 10px; border-radius: 15px; width: 100%;' type='submit' name='simpan' value='PILIH' class='btn btn-success' onclick='return confirm('YAKIN DENGAN PILIHAN ANDA')' disabled>
        <center><h2 style='color:red;align:center;padding: 10px; border-radius: 15px; width: 100%;'><strong>- belum saatnya pemilihan -</strong></h2></center>
		";
}
?>
					
        <!--            <input style="color: white; font-size: 20px; padding: 10px; border-radius: 15px; width: 100%;" type="submit" name="simpan" value="Vote" class="btn btn-success" onclick="return confirm('YAKIN DENGAN PILIHAN ANDA')"> -->
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /. ROW  --> 

        <!-- /. ROW  -->   
        <div class="row">
          <div class="col-lg-12 ">
            <div class="alert alert-danger" style="text-align: center;">
              <strong>Voting hanya dapat dilakukan satu kali. </strong> 
            </div>
          </div>
        </div>
        <!-- /. ROW  --> 
      </div>
      <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
  </div>


<?php
	include "view/footer.php";
?>

  <script src="../js/sweetalert.min.js"></script>
  <!--===============================================================================================-->  
  <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
  <!-- JQUERY SCRIPTS -->
  <script src="assets/js/jquery-1.10.2.js"></script>
  <!-- BOOTSTRAP SCRIPTS -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- CUSTOM SCRIPTS -->
  <script src="assets/js/custom.js"></script>

</body>
</html>