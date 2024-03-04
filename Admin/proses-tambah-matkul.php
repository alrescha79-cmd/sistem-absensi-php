<?php
include "../include/koneksi.php";

$matkul = $_POST["matkul"];

if(empty($_POST["matkul"])){
	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=tambah_data_matkul.php">';
}else{
	$sql = "INSERT INTO `matkul` (`id_matkul`,`nama`)
			VALUES (NULL, '$matkul')";
			$kueri = mysqli_query($conn, $sql);
			echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=data_mata_kuliah.php">';
}
?>
