<?php
$pengaturan = mysqli_query($koneksi,"SELECT * FROM pengaturan");
$gusmint = mysqli_fetch_array($pengaturan);

?>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="adjust-nav">	
      <div class="navbar-header">        
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button> 
        <a class="navbar-brand" href="#">
        <img src="../images/logo.png" alt="smk_nu_kesesi" style="max-width:70px; height:auto;"> <?php echo $gusmint['lembaga']; ?> </a>
      </div>

		
      <span class="logout-spn" >
	<!--
		<a class="navbar-brand" href="#"><h4 style="color: white;"><?php echo $_SESSION['kampus']; ?></h4></a>
        <a href="../logout.php" style="color:#fff;"><i class="fa fa-circle-o-notch"> Logout</i></a> 
	-->
      </span>

    </div>
  </div>
  <!-- /. NAV TOP  -->
  <nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
      <div class="menu">
        <ul class="nav" id="main-menu">
         
          <li><a href="index.php?page=home"><i class="fa fa-desktop"></i>Beranda</a></li>
          <?php
          if($_SESSION['level'] == 'admin'){
            ?>
            <li><a href="index.php?page=data-paslon"><i class="fa fa-user "></i>Input Data Paslon</a></li>
		    <li><a href="upload_dpt.php"><i class="fa fa-file"></i>Data Pemilih</a></li>
			<li><a href="dpt.php"><i class="fa fa-th"></i>Data Suara</a></li>
<!--		
            <li><a href="data-registrasi.php"><i class="fa fa-file"></i>Data Registrasi</a></li>
            <li><a href="dpm.php"><i class="fa fa-file"></i>Data DPM</a></li>
			<li><a href="hima1.php"><i class="fa fa-file"></i>Data HIMA Manajemen</a></li>
			<li><a href="hima2.php"><i class="fa fa-file"></i>Data HIMA Eko. Pemb.</a></li>
			<li><a href="hasil_senator.php"><i class="fa fa-chart-bar"></i>Hasil Suara Senator</a></li>
-->
            <li><a href="hasil_suara.php"><i class="fa fa-chart-bar"></i>Hasil Suara</a></li>
			<li><a href="index.php?page=pengaturan"><i class="fa fa-calendar text-dark"></i>Pengaturan</a></li>
          <?php } ?>
			<li><a href="../logout.php"><i class="fa fa-circle-o-notch "></i>Logout</a></li>
          
        </ul>
      </div>
    </div>

  </nav>