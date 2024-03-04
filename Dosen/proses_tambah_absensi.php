<?php
include "../include/koneksi.php";

$tanggal = $_POST["tanggal"];

if(empty($_POST["hadir"])){
    $hadir = 0;
}else{
    $hadir = 1;
}

if(empty($_POST["sakit"])){
    $sakit = 0;
}else{
    $sakit = 1;
}

if(empty($_POST["izin"])){
    $izin = 0;
}else{
    $izin = 1;
}

if(empty($_POST["alfa"])){
    $alfa = 0;
}else{
    $alfa = 1;
}

$nim = $_POST["nim"];
$id_matkul = $_POST["id_matkul"];
$jumlah_dipilih = count($nim);

if(empty($_POST["tanggal"]) || empty($_POST["kehadiran"]) || empty($_POST["nim"]) || empty($_POST["id_matkul"])){
//    echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
    echo '<meta http-equiv="refresh" content="0; url=data_absensi.php">';
}

for($x=0; $x<$jumlah_dipilih; $x++){
    $query = "INSERT INTO `absensi`(`id_absensi`, `tanggal`, `hadir`, `alfa`, `izin`, `sakit`, `nim`, `id_matkul`)
        VALUES (NULL, '".$tanggal[$x]."', '".$hadir."', '".$alfa."', '".$izin."', '".$sakit."', '".$nim[$x]."', '".$id_matkul[$x]."')";

    mysqli_query($conn, $query);
}

echo "<script language='javascript'>alert('Berhasil Absen');</script>";
echo '<meta http-equiv="refresh" content="0; url=data_absensi.php">';
?>
