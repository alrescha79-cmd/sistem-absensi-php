<?php
include "../include/koneksi.php";

$id_kelas = $_POST["id_kelas"];
$nama_kelas = $_POST["nama_kelas"];

if(empty($_POST["id_kelas"]) || empty($_POST["nama_kelas"])){
	echo "<script language='javascript'>alert('Gagal di Edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=edit_data_kelas.php">';
}else{
	$sql = "UPDATE `kelas` SET `nama_kelas`='$nama_kelas' WHERE `id_kelas` = '$id_kelas'";
				$kueri = mysqli_query($conn, $sql);
				echo "<script language='javascript'>alert('Berhasil di Edit');</script>";
				echo '<meta http-equiv="refresh" content="0; url=data_kelas.php">';
	}
?>
