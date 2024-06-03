<?php

include '../koneksi.php';

$no_urut= $_GET['no_urut'];

$pilih = mysqli_query($koneksi,"SELECT * FROM data_paslon2 WHERE no_urut='$no_urut'");
while($data = mysqli_fetch_array($pilih)){
$gambar1 =$data['gambar1'];
$gambar2 =$data['gambar2'];
$gambar3 =$data['gambar3'];

unlink("foto/".$gambar1);
unlink("foto/".$gambar2);
unlink("foto/".$gambar3);

mysqli_query($koneksi,"DELETE FROM data_paslon2 WHERE no_urut='$no_urut'");

header("location:input_data_paslon2.php");

}
?>