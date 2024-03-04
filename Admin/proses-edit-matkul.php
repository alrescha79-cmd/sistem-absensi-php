<?php
include "../include/koneksi.php";

$id_matkul = $_POST["id_matkul"];
$nama = $_POST["nama"];

if(empty($_POST["id_matkul"]) || empty($_POST["nama"])){
	echo "<script language='javascript'>alert('Gagal di Edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=edit_data_matkul.php">';
}else{
	$sql = "UPDATE `matkul` SET `nama`='$nama' WHERE `id_matkul` = '$id_matkul'";
				$kueri = mysqli_query($conn, $sql);
				echo "<script language='javascript'>alert('Berhasil di Edit');</script>";
				echo '<meta http-equiv="refresh" content="0; url=data_mata_kuliah.php">';
	}
?>
