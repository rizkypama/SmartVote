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
	$coblos = $gusmint['jurusan'];
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../images/icons/favicon.ico">
  <title>Hasil Suara</title>
  <link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
  <script type="text/javascript" src="assets/chart/chart.js"></script>
  <!-- BOOTSTRAP STYLES-->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLES-->
  <link href="assets/css/custom.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	<script src="assets/js/jquery-1.10.1.min.js"></script>
	<script src="assets/js/highcharts.js"></script>
</head>
<body>
  <div id="wrapper">
   <?php
	include "view/header.php";
	?>

  <div id="page-wrapper" >
    <div id="page-inner">
		<div id="vote">
    		<div id="mygraph"></div>
			<script>
	            var chart1; // globally available
    	        $(document).ready(function() {
                chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'mygraph',
            type: 'column'
         },   
         title: {
            text: 'Hasil Suara Pemilihan Senator'
         },
         xAxis: {
            categories: ['Nama Paslon']
         },
         yAxis: {
            title: {
               text: 'Jumlah Suara'
            }
         },
              series:             
            [
        <?php
            $kandidat = mysqli_query($koneksi,"SELECT * FROM data_paslon where jenis='2'");
            while ($ambil = mysqli_fetch_array($kandidat)){
                $i = $ambil['no_urut'];
				$hasil = $ambil['nm_paslon'];
				$keterangan = $ambil['gambar2'];
                $paslon = mysqli_query($koneksi,"select * from tbl_paslon where vote='$i' AND jenis='2'");
            //    while ($jumlah = mysqli_num_rows($paslon)){
        ?>
			{
			name: '<?php echo $hasil.$keterangan; ?>',
			data: [<?php echo mysqli_num_rows($paslon); ?>]
			},
        <?php
			}
		?>
]
});
});	
	        </script>

	    <div id="mygraph11"></div>
			<script>
	        var chart1; // globally available
    	    $(document).ready(function() {
            chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'mygraph11',
                type: 'column'
            },   
            title: {
                text: 'Statistik Suara Pemilihan'
            },
            xAxis: {
                categories: ['Statistik']
            },
            yAxis: {
                title: {
                text: 'Jumlah Suara'
                }
            },
            series:             
            [
			{
			name: 'Sudah memilih',
			data: [
				<?php 
                $suara1 = mysqli_query($koneksi,"select * from tbl_paslon where jenis='2'");
                echo mysqli_num_rows($suara1);
                ?>
				]
			},
			{
			name: 'Belum memilih',
			data: [
				<?php 
                $data_dpt = mysqli_query($koneksi,"select * from registrasi where status='verified'");
                $jumlah_dpt = mysqli_num_rows($data_dpt);
				$suara_masuk = mysqli_num_rows($suara1);
				echo "$jumlah_dpt - $suara_masuk";
                ?>
				]	
			},
]
});
});	
	</script>
		</div>

    </div> 

  </div>

<?php
	include "view/footer.php";
?>

<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>

</body>
</html>