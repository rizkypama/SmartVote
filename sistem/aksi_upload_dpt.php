<!-- import excel ke mysql -->
<!-- www.malasngoding.com -->
 
<?php 
// menghubungkan dengan koneksi
include '../koneksi.php';
// menghubungkan dengan library excel reader
include "excel_reader2.php";
?>
 
<?php
// upload file xls
$target = basename($_FILES['file_dpt']['name']) ;
move_uploaded_file($_FILES['file_dpt']['tmp_name'], $target);
 
// beri permisi agar file xls dapat di baca
chmod($_FILES['file_dpt']['name'],0777);
 
// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['file_dpt']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);
 
// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){
 
	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$id     = $data->val($i, 1);
	$nim     = $data->val($i, 2);
	$kode_akses    = $data->val($i, 3);
	$nama_mhs   = $data->val($i, 4);
	$jurusan   = $data->val($i, 5);
	$no_hp  = $data->val($i, 6);
	$status   = $data->val($i, 7);
 
	if($nim != "" && $kode_akses != "" && $nama_mhs != "" ){
		// input data ke database (table data_pegawai)
		mysqli_query($koneksi,"INSERT INTO registrasi values('$id','$nim','$kode_akses','$nama_mhs','$jurusan','$no_hp','$status')");
		$berhasil++;
	}
}
 
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['file_dpt']['name']);
 
// alihkan halaman ke index.php
echo "<script>window.alert('Berhasil')
  window.location='upload_dpt.php'</script>";
//header("location:upload_dpt.php?berhasil=$berhasil");
?>