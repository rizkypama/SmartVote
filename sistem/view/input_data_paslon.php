<?php
$pengaturan = mysqli_query($koneksi,"SELECT * FROM pengaturan");
while ($gusmint = mysqli_fetch_array($pengaturan)){
	$title = $gusmint['lembaga'];
}
if(isset($_POST['simpan'])) {
	$jenis= mysqli_real_escape_string($koneksi, $_POST['jenis']);
	$no_urut= mysqli_real_escape_string($koneksi, $_POST['no_urut']);
	$nm_paslon= mysqli_real_escape_string($koneksi, $_POST['nm_paslon']);

    $ekstensi_diperbolehkan = array('png','jpg','JPG','PNG','jpeg','JPEG');
    $gambar1 = $_FILES['gambar1']['name'];
    $x = explode('.', $gambar1);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['gambar1']['size'];
    $file_tmp = $_FILES['gambar1']['tmp_name'];     
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
      if($ukuran <= 2000000){          
        move_uploaded_file($file_tmp, 'foto/'.$gambar1);
        $query = mysqli_query($koneksi, "INSERT INTO data_paslon VALUES(NULL, '$gambar1')");
        $gambar2 = $_FILES['gambar2']['name'];
        $x = explode('.', $gambar2);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['gambar2']['size'];
        $file_tmp = $_FILES['gambar2']['tmp_name'];     
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
          if($ukuran <= 2000000){          
            move_uploaded_file($file_tmp, 'foto/'.$gambar2);
            $query = mysqli_query($koneksi, "INSERT INTO data_paslon VALUES(NULL, '$gambar2')");
          }
        }
      }
    }
 // }
  
  mysqli_query($koneksi,"INSERT INTO data_paslon(jenis, no_urut, nm_paslon, gambar1, gambar2)
    VALUES ('$jenis','$no_urut','$nm_paslon','$gambar1','$gambar2')");
  
  echo "<script>window.alert('Berhasil')
  window.location='index.php?page=data-paslon'</script>";
  
}
?>

<div id="page-inner">
      <div class="row">
        <div class="col-lg-12">
          <h2><i class="fa fa-user"> Input Paslon <?php echo $title; ?></i></h2>   
        </div>
      </div>              
      <!-- /. ROW  -->

      <div class="row">
        <div class="col-lg-6">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <!--<label>Pemilihan</label>
                <select name="jenis" required="required" class="form-control">
				    <option value="1">Ketua BPP</option>
				    <option value="2">Senator</option>
			    </select>-->
			  <input type="hidden" name="jenis" value="1" class="form-control">
            </div>
			<div class="form-group">
			  <label>Nomor Urut</label>
              <input type="text" name="no_urut" required="required" class="form-control">
			</div>
			<div class="form-group">
              <label>Nama Paslon</label>
              <input type="text" name="nm_paslon" required="required" autocomplete="off" class="form-control">
            </div>
            <div class="form-group">
              <label>Foto Paslon</label>
              <input type="file" name="gambar1" required="required" class="form-control-file">
            </div>
            <div class="form-group">
              <label>Visi Misi</label>
              <input type="file" name="gambar2" required="required" class="form-control-file">
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-success" name="simpan" value="Kirim" class="form-control">
            </div>
          </form>
        </div>

          <div class="row">
            <div class="col-lg-12">
              <h2> Data Paslon</h2>  
              <div class="table-responsiv">
                <table class="table table-striped table-bordered table-hover">
                  <tr>
					<!--<th style="text-align:center;">Pemilihan</th>-->
					<th style="text-align:center;">No Urut</th>
                    <th style="text-align:center;">Nama Paslon</th>
					<th style="text-align:center;">Foto Paslon</th>
					<th style="text-align:center;">Visi-Misi</th>
                    <th style="text-align:center;">Opsi</th>
                  </tr>
                  <?php
                  $data_paslon = mysqli_query($koneksi,"SELECT * FROM data_paslon order by no_urut ASC");
                  while($d = mysqli_fetch_array($data_paslon)){
                    ?>
                  <tr>
					<!--<td style="text-align:center;"><?php if($d['jenis']=='1'){ echo "Ketua BPP"; } elseif($d['jenis']=='2'){ echo "Senator"; } else { echo "Lainnya"; } ?></td>-->
					<td style="text-align:center;"><?php echo $d['no_urut']; ?></td>
					<td><?php echo $d['nm_paslon']; ?></td>
					<td style="text-align:center;"><img style="max-height: 50px; width:auto;" src="<?php echo "foto/".$d['gambar1']; ?>"></td>
					<td style="text-align:center;"><img style="max-height: 50px; width:auto;" src="<?php echo "foto/".$d['gambar2']; ?>"></td>
					<td style="text-align:center;"><a class="btn btn-danger btn-circle" onclick="return confirm('Yakin hapus data ini !!!')" href="hapus.php?id=<?php echo $d['id']; ?>">Hapus</a>
					</td>
                  </tr>
                  <?php } ?>
                </table>
              </div> 
            </div>
 
        </div>
      </div>
      <!-- /. ROW  --> 
</div>
    <!-- /. PAGE INNER  -->

<!-- /. WRAPPER  -->
<script src="../js/sweetalert.min.js"></script>
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
