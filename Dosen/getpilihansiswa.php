<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$q = intval($_GET['q']);

include "../include/koneksi.php";

$sql="SELECT mahasiswa.nim, mahasiswa.nama FROM mahasiswa join kelas on mahasiswa.id_kelas = kelas.id_kelas WHERE kelas.id_kelas = '".$q."'";
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
echo "<div class='form-grup'>
  <select id='matkul' class='form-control' name='matkul'  style='width: 250px' >
  <option id='mahasiswa' value=''>Pilih Mahasiswa:</option>;";

  if ($num>0) {
    while($row = mysqli_fetch_array($result)){
      echo "
        <option value=". $row['nim'] .">". $row['nama'] ."</option>
      ";
    }
  }else{
  }
echo "</select>
</div>";
mysqli_close($conn);
?>

</body>
</html>
