<?php
include '../includes/config.php';
include '../includes/functions.php';

redirectIfNotAdmin();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id']) || !isset($_POST['status'])) {
    echo json_encode(['success' => false, 'message' => 'Permintaan tidak valid']);
    exit();
}

$id = $_POST['id'];
$status = $_POST['status'];

if (updateRegistrationStatus($id, $status)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal mengupdate status']);
}
?>