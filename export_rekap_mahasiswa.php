<?php
session_start();
require('fpdf186/fpdf.php');

include "include/koneksi.php";

// Mengambil data mahasiswa dari database berdasarkan NIM
$nim = $_SESSION['nim'];
$query = "SELECT nama, nim FROM mahasiswa WHERE nim = '$nim'";
$result = mysqli_query($conn, $query);
$mahasiswa = mysqli_fetch_assoc($result);

// Membuat class PDF dengan turunan FPDF
class PDF extends FPDF
{
    // Setter untuk data mahasiswa
    function setMahasiswa($mahasiswa)
    {
        $this->mahasiswa = $mahasiswa;
    }

    // Override metode Header untuk mengatur header halaman PDF
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Presentase Kehadiran', 0, 1, 'C');
        $this->Cell(0, 10, 'Universitas Nganu', 0, 1, 'C');
        $this->Cell(0, 10, 'Program Studi Teknik Informatika', 0, 1, 'C');
        $this->Cell(0, 10, 'Semester Genap 2022/2023', 0, 1, 'C');
        $this->Ln(10);
    }

    // Override metode Footer untuk mengatur footer halaman PDF
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' / {nb}', 0, 0, 'C');
    }
}

// Membuat objek PDF
$pdf = new PDF();

// Menyiapkan data tabel presentase absensi dari database
$i = 1;
$sql = "SELECT matkul.nama, dosen.nama_dosen, SUM(absensi.hadir) AS total_hadir, SUM(absensi.sakit) AS total_sakit, SUM(absensi.izin) AS total_izin, SUM(absensi.alfa) AS total_alfa, 
        (SUM(absensi.hadir) + SUM(absensi.sakit) + SUM(absensi.izin) + SUM(absensi.alfa)) AS total_kehadiran 
        FROM (((mahasiswa JOIN absensi ON mahasiswa.nim = absensi.nim) 
        JOIN matkul ON absensi.id_matkul = matkul.id_matkul) 
        JOIN detail_matkul_dosen ON matkul.id_matkul = detail_matkul_dosen.id_matkul) 
        JOIN dosen ON detail_matkul_dosen.nidn = dosen.nidn 
        WHERE absensi.nim = '$nim' 
        GROUP BY matkul.id_matkul";
$result = mysqli_query($conn, $sql);

// Menambahkan halaman baru ke PDF
$pdf->AddPage();

// Mengatur margin
$pdf->SetLeftMargin(25);
$pdf->SetRightMargin(25);
$pdf->SetTopMargin(25);
$pdf->SetAutoPageBreak(true, 25);

// Mengatur font dan ukuran tabel
$pdf->SetFont('Arial', 'B', 12);

// Menampilkan nama mahasiswa di sebelah kiri atas tabel
$pdf->Cell(0, 10, 'Nama: ' . $mahasiswa['nama'], 0, 1, 'L');
$pdf->Cell(0, 10, 'NIM: ' . $mahasiswa['nim'], 0, 1, 'L');
$pdf->Ln(10);

// Header tabel
$pdf->Cell(10, 20, 'No', 1, 0, 'C');
$pdf->Cell(40, 20, 'Mata Kuliah', 1, 0, 'C');
$pdf->Cell(40, 20, 'Nama Dosen', 1, 0, 'C');
$pdf->Cell(30, 20, 'Kehadiran Dosen', 1, 0, 'C');
$pdf->Cell(20, 20, 'Hadir', 1, 0, 'C');
$pdf->Cell(30, 20, 'Presentase Kehadiran', 1, 1, 'C');

// Menampilkan data presentase absensi ke dalam tabel
while ($hasil = mysqli_fetch_array($result)) {
    $pdf->SetFont('Arial', '', 12);
    $total_hadir = $hasil['total_hadir'];
    $total_kehadiran = $hasil['total_kehadiran'];

    // Cek apakah total kehadiran bukan nol sebelum melakukan perhitungan
    if ($total_kehadiran != 0) {
        $presentase_kehadiran = ($total_hadir / $total_kehadiran) * 100;
    } else {
        $presentase_kehadiran = 0; // Atur presentase kehadiran menjadi 0 jika total_kehadiran adalah nol
    }

    // Format presentase kehadiran menjadi tiga digit angka
    $formatted_presentase = number_format($presentase_kehadiran, 2);

    $pdf->Cell(10, 10, $i, 1, 0, 'C');
    $pdf->Cell(40, 10, $hasil['nama'], 1, 0, 'C');
    $pdf->Cell(40, 10, $hasil['nama_dosen'], 1, 0, 'C');
    $pdf->Cell(30, 10, $hasil['total_kehadiran'], 1, 0, 'C');
    $pdf->Cell(20, 10, $hasil['total_hadir'], 1, 0, 'C');
    $pdf->Cell(30, 10, $formatted_presentase . '%', 1, 1, 'C');
    $i++;
}

// Set data mahasiswa pada objek PDF
$pdf->setMahasiswa($mahasiswa);

// Output PDF
$pdf->Output('I', 'Presentase_Kehadiran.pdf');
