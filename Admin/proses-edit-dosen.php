<?php
include "../include/koneksi.php";

$nidn = $_POST["nidn"];
$nama_dosen = $_POST["nama_dosen"];
$no_hp = $_POST["no_hp"];
$alamat = $_POST["alamat"];
$username = $_POST["username"];
$password = $_POST["password"];
$matkul = $_POST["matkul"];


if(empty($_POST["nidn"]) || empty($_POST["nama_dosen"]) || empty($_POST["no_hp"]) || empty($_POST["alamat"]) || empty
	($_POST["username"]) || empty($_POST["password"])){
	echo "<script language='javascript'>alert('Gagal di Edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=edit_data_dosen.php">';
}else{
	$sql = "UPDATE `dosen` SET `nama_dosen`='$nama_dosen', `alamat`='$alamat', `no_hp`='$no_hp', `username`='$username', `password`='$password' WHERE `nidn` = '$nidn'";
				$kueri = mysqli_query($conn, $sql);
				$sql2 = "UPDATE `detail_matkul_dosen` SET `id_matkul`='$matkul' WHERE `nidn` = '$nidn'";
//							$kueri2 = mysqli_quSery($conn, $sql2);
				echo "<script language='javascript'>alert('Berhasil di Edit');</script>";
				echo '<meta http-equiv="refresh" content="0; url=data_dosen.php">';
	}
?>
