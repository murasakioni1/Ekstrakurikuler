<?php
include '../includes/config.php';
include '../includes/functions.php';

redirectIfNotAdmin();

header('Content-Type: application/json');

// Ambil data registrasi dan statistik
$registrations = getAllRegistrations();
$data = [
    'registrations' => [],
    'stats' => [
        'total' => 0,
        'pending' => 0,
        'approved' => 0,
        'rejected' => 0
    ]
];

if ($registrations->num_rows > 0) {
    while($row = $registrations->fetch_assoc()) {
        $data['registrations'][] = $row;
        
        // Hitung statistik
        $data['stats']['total']++;
        switch($row['status']) {
            case 'pending': $data['stats']['pending']++; break;
            case 'approved': $data['stats']['approved']++; break;
            case 'rejected': $data['stats']['rejected']++; break;
        }
    }
}

echo json_encode($data);
?>