<?php
include "../include/koneksi.php";

$nama_kelas = $_POST["nama_kelas"];

if(empty($_POST["nama_kelas"]) ){
	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=tambah_data_kelas.php">';
}else{
	$sql = "INSERT INTO `kelas` (`id_kelas`, `nama_kelas`)
			VALUES (NULL, '$nama_kelas')";
			$kueri = mysqli_query($conn, $sql);
			echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=data_kelas.php">';
}
?>
