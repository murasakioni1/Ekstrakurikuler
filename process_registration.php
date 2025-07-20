<?php 
include 'includes/config.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$student_name = $_POST['student_name'];
$student_nis = $_POST['student_nis'];
$student_class = $_POST['student_class'];
$extracurricular_id = $_POST['extracurricular_id'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'] ?? '';

// Validasi data
if (empty($student_name) || empty($student_nis) || empty($student_class) || empty($phone_number)) {
    $_SESSION['error'] = "Semua field wajib diisi!";
    header("Location: register.php?extracurricular_id=" . $extracurricular_id);
    exit();
}

// Simpan ke database
$sql = "INSERT INTO registrations (student_name, student_nis, student_class, extracurricular_id, phone_number, email) 
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssiss", $student_name, $student_nis, $student_class, $extracurricular_id, $phone_number, $email);

if ($stmt->execute()) {
    $registration_id = $stmt->insert_id;
    header("Location: success.php?id=" . $registration_id);
    exit();
} else {
    $_SESSION['error'] = "Terjadi kesalahan saat menyimpan data: " . $conn->error;
    header("Location: register.php?extracurricular_id=" . $extracurricular_id);
    exit();
}
?>