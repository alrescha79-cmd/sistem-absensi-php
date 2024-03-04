<?php
session_start();
if (isset($_SESSION['nim'])) {
    require('fpdf186/fpdf.php');

    include "include/koneksi.php";

    // Mengambil data mahasiswa dari database berdasarkan NIM
    $nim = $_SESSION['nim'];
    $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
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
            $this->Cell(0, 10, 'Data Absensi Mahasiswa', 0, 1, 'C');
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

    // Menyiapkan data tabel absensi dari database
    $i = 1;
    $sql = "SELECT matkul.nama, dosen.nama_dosen, sum(absensi.hadir) as hadir, sum(absensi.sakit) as sakit, sum(absensi.izin) as izin, sum(absensi.alfa) as alfa FROM (((mahasiswa join absensi on mahasiswa.nim = absensi.nim) join matkul on absensi.id_matkul = matkul.id_matkul) join detail_matkul_dosen
        on matkul.id_matkul = detail_matkul_dosen.id_matkul) join dosen on detail_matkul_dosen.nidn = dosen.nidn WHERE absensi.nim = '$nim' GROUP BY matkul.id_matkul";
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

    // Menampilkan nama dan NIM di sebelah kiri atas tabel
    $pdf->Cell(0, 10, 'Nama: ' . $mahasiswa['nama'], 0, 1, 'L');
    $pdf->Cell(0, 10, 'NIM: ' . $mahasiswa['nim'], 0, 1, 'L');
    $pdf->Ln(10);

    // Header tabel
    $pdf->Cell(10, 10, 'No', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Mata Kuliah', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Nama Dosen', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Hadir', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Sakit', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Izin', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Alfa', 1, 1, 'C');

    // Menampilkan data absensi ke dalam tabel
    while ($hasil = mysqli_fetch_array($result)) {
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(10, 10, $i, 1, 0, 'C');
        $pdf->Cell(40, 10, $hasil['nama'], 1, 0, 'C');
        $pdf->Cell(40, 10, $hasil['nama_dosen'], 1, 0, 'C');
        $pdf->Cell(20, 10, $hasil['hadir'], 1, 0, 'C');
        $pdf->Cell(20, 10, $hasil['sakit'], 1, 0, 'C');
        $pdf->Cell(20, 10, $hasil['izin'], 1, 0, 'C');
        $pdf->Cell(20, 10, $hasil['alfa'], 1, 1, 'C');
        $i++;
    }

    // Set data mahasiswa pada objek PDF
    $pdf->setMahasiswa($mahasiswa);

    // Output PDF
    $pdf->Output('I', 'Data_Absensi_Mahasiswa.pdf');
}
