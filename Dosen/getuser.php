<!DOCTYPE html>
<html>
<head>
<style>
table {
   width: 100%;
   border-collapse: collapse;
}

table, td, th {
   border: 1px solid black;
   padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

  <?php
  $kelas = intval($_GET['kelas']);
  $matkul = intval($_GET['matkul']);

  include "../include/koneksi.php";
  $i = 1;
  $sql="SELECT mahasiswa.nim, mahasiswa.nama FROM mahasiswa join kelas on mahasiswa.id_kelas = kelas.id_kelas WHERE kelas.id_kelas = '".$kelas."'";
  $result = mysqli_query($conn,$sql);
  $num = mysqli_num_rows($result);
  echo "<table id='example' class='table table-striped table-bordered' cellspacing='0' width='100%''>
          <thead>
              <tr>
  								<th>NO</th>
                  <th>NAMA</th>
                  <th>WAKTU SEKARANG</th>
                  <th>ABSENSI</th>
              </tr>
          </thead>
      ";

    if ($num>0) {
      $tgl = date('Y-m-d');
      while($row = mysqli_fetch_array($result)){
      echo "<tbody><tr>";
      echo "<td>" . $i . "</td>";
      echo "<td>" . $row['nama'] . "</td>";
      echo "<td>" . $tgl . "</td>";
      echo "<td>
      <input type='checkbox' name='hadir[]' id='kehadiran' value='1' checked>
  					<span class='checkmark'>Hadir</span>
            <input type='checkbox' name='sakit[]' id='kehadiran' value='1' >
        		<span class='checkmark'>Sakit</span>
            <input type='checkbox' name='izin[]' id='kehadiran' value='1' >
  					<span class='checkmark'>Izin</span>
            <input type='checkbox' name='alfa[]' id='kehadiran' value='1' >
  					<span class='checkmark'>Alfa</span>
            <input type='hidden' name='tanggal[]' value='". $tgl ."' >
          	<input type='hidden' name='nim[]' value='". $row['nim'] ."' >
          	<input type='hidden' name='id_matkul[]' value='". $matkul ."' ></td>";
      echo "</tr></tbody>";
      $i++;
      }
    }else{
      echo "<tbody></tbody>";
    }



echo "</table>";
  mysqli_close($conn);
  ?>
</body>
</html>
