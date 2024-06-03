<div id="page-inner">
	<div class="row">
		<div class="col-lg-12">
			<h2><i class="fa fa-desktop">Beranda</i></h2>   
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 ">
			<div class="alert alert-info">
                <strong><h2><b>Selamat Datang<?php echo $_SESSION['nama_mhs']; ?></b></h2></strong>
				<p>di TPS Online - <?php echo $title; ?></p>
		<!--		<p>
				Silahkan upload foto kartu tanda mahasiswa sebagai syarat untuk dapat memilih. <br>
				Format Foto harus JPG/PNG dengan ukuran file maksimal 1 Mb</p> 
				<p><i style="color: black;">"Menyongsong muda mudi milenial menjadi pemimpin cemerlang"</i></p> -->
			</div>   
		</div>
	</div>
<!--
	<div class="row">
        <div class="col-lg-6">
          <form action="" method="post" enctype="multipart/form-data">

			<div class="form-group">
              <label>Upload Foto KTM</label>
              <input type="file" name="foto" required="required" class="form-control-file">
            </div>
            
            <div class="form-group">
              <input type="submit" class="btn btn-success" name="simpan" value="KIRIM" class="form-control">
            </div>
          </form>
		</div>
	</div>
-->	
	<div class="row">
		<div class="col-lg-12">
			
	<?php
		$username = $_SESSION['nim'];

		$bem = mysqli_query($koneksi,"SELECT * FROM tbl_paslon where nim = '$username' AND jenis ='1' ");
        $pilih1 = mysqli_fetch_array($bem);
        $dpm = mysqli_query($koneksi,"SELECT * FROM tbl_paslon where nim = '$username' AND jenis ='2' ");
        $pilih2 = mysqli_fetch_array($dpm);
        $vote3 = mysqli_query($koneksi,"SELECT * FROM tbl_paslon where nim = '$username' AND jenis ='3' ");
        $pilih3 = mysqli_fetch_array($vote3);
        $vote4 = mysqli_query($koneksi,"SELECT * FROM tbl_paslon where nim = '$username' AND jenis ='4' ");
        $pilih4 = mysqli_fetch_array($vote4);
        $vote5 = mysqli_query($koneksi,"SELECT * FROM tbl_paslon where nim = '$username' AND jenis ='5' ");
        $pilih5 = mysqli_fetch_array($vote5);

	    $dpt = mysqli_query($koneksi,"SELECT * FROM registrasi where nim = '$username' ");
	    $d = mysqli_fetch_array($dpt);
		if (isset($d['status'])) {
			$status = $d['status'];
			if($status == "baru" || $status == NULL ){ echo "Akun Anda belum di-VERIFIKASI Oleh Panitia";}
			else {
	
		?>
	
	
				<div class='table-responsiv'>
					<table class='table table-striped table-bordered table-hover'>
					<tr>
						<th class="text-center">Pemilihan Ketua OSIS</th>
						<!--<th class="text-center" width="50%">Pemilihan Senator </th>-->
					</tr>
					<tr>
						<td class="text-center"><?php if ($pilih1['vote'] == ""){ echo "Belum memilih"; }
												else { 
													$fotopaslon1 = mysqli_query($koneksi,"SELECT * FROM data_paslon WHERE no_urut='".$pilih1['vote']."' AND jenis ='1' ");
													$foto1 = mysqli_fetch_array($fotopaslon1);
													echo "<center><p>(Sudah Memilih)</p><img src='foto/".$foto1["gambar1"]."' style='max-width: 100px; height: auto; align: center;' class='img-responsive'></center>";
												}
												?>
						</td>
						<!--
						<td class="text-center"><?php if ($pilih2['vote'] == ""){ echo "Belum memilih"; }
												else { 
													$fotopaslon2 = mysqli_query($koneksi,"SELECT * FROM data_paslon WHERE no_urut='".$pilih2['vote']."' AND jenis ='2' ");
													$foto2 = mysqli_fetch_array($fotopaslon2);
													echo "<center><p>(Sudah Memilih)</p><img src='foto/".$foto2["gambar1"]."' style='max-width: 100px; height: auto; align: center;' class='img-responsive'></center>";
												}
												?>
						</td>
						-->
					</tr>
					<tr class="success">
						<th class="text-center"><a class='btn btn-warning btn-circle' href='vote.php'>Pilih</a></th>
						<!--<th class="text-center"><a class='btn btn-warning btn-circle' href='vote2.php'>Pilih</a></th>-->
					</tr>					
					</table>
				  </div>
				
			<?php  
				}
			}
			?>   
	    
        
            </div>
	</div>  

</div>