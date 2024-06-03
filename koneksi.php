<?php 

$koneksi = mysqli_connect("localhost","smknuke1_admin","nukesesi123?","smknuke1_db_evoting");

if (mysqli_connect_error()){
	echo "koneksi database gagal" .mysqli_connect_error();
}

?>