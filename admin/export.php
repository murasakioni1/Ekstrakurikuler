<?php
include '../includes/config.php';
include '../includes/functions.php';

redirectIfNotAdmin();

// Ambil data pendaftaran
$registrations = getAllRegistrations();

// Nama file Excel
$filename = "data_pendaftaran_ekstrakurikuler_" . date('Ymd') . ".xls";

// Header untuk download file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");

// Mulai output
echo "Data Pendaftaran Ekstrakurikuler\n\n";
echo "Tanggal Export: " . date('d/m/Y H:i') . "\n\n";

// Header tabel
echo "No\t";
echo "Nama Siswa\t";
echo "NIS\t";
echo "Kelas\t";
echo "Ekstrakurikuler\t";
echo "Telepon\t";
echo "Email\t";
echo "Tanggal Daftar\t";
echo "Status\n";

// Data tabel
if ($registrations->num_rows > 0) {
    $no = 1;
    while($row = $registrations->fetch_assoc()) {
        echo $no++ . "\t";
        echo $row['student_name'] . "\t";
        echo $row['student_nis'] . "\t";
        echo $row['student_class'] . "\t";
        echo $row['extracurricular_name'] . "\t";
        echo $row['phone_number'] . "\t";
        echo $row['email'] . "\t";
        echo date('d/m/Y H:i', strtotime($row['registration_date'])) . "\t";
        echo ucfirst($row['status']) . "\n";
    }
}

exit();
?>