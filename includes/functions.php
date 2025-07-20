<?php
function getExtracurriculars() {
    global $conn;
    $sql = "SELECT * FROM extracurricular";
    $result = $conn->query($sql);
    return $result;
}

function getRegistrationById($id) {
    global $conn;
    $sql = "SELECT r.*, e.name as extracurricular_name 
            FROM registrations r 
            JOIN extracurricular e ON r.extracurricular_id = e.id 
            WHERE r.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getAllRegistrations() {
    global $conn;
    $sql = "SELECT r.*, e.name as extracurricular_name 
            FROM registrations r 
            JOIN extracurricular e ON r.extracurricular_id = e.id 
            ORDER BY r.registration_date DESC";
    $result = $conn->query($sql);
    return $result;
}

function updateRegistrationStatus($id, $status) {
    global $conn;
    $sql = "UPDATE registrations SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    return $stmt->execute();
}

function login($username, $password) {
    global $conn;
    
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
    }
    return false;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['role'] == 'admin';
}

function redirectIfNotAdmin() {
    if (!isAdmin()) {
        header("Location:/ekstrakurikuler/admin/login.php");
        exit();
    }
}
function getRegistrationsJSON() {
    global $conn;
    $sql = "SELECT r.*, e.name as extracurricular_name 
            FROM registrations r 
            JOIN extracurricular e ON r.extracurricular_id = e.id 
            ORDER BY r.registration_date DESC";
    $result = $conn->query($sql);
    
    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return json_encode($data);
}

function getStatsJSON() {
    global $conn;
    $stats = array();
    
    // Total registrations
    $result = $conn->query("SELECT COUNT(*) as total FROM registrations");
    $stats['total'] = $result->fetch_assoc()['total'];
    
    // Pending
    $result = $conn->query("SELECT COUNT(*) as pending FROM registrations WHERE status = 'pending'");
    $stats['pending'] = $result->fetch_assoc()['pending'];
    
    // Approved
    $result = $conn->query("SELECT COUNT(*) as approved FROM registrations WHERE status = 'approved'");
    $stats['approved'] = $result->fetch_assoc()['approved'];
    
    return json_encode($stats);
}

function getExtracurricularById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM extracurricular WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getExtracurricularPhotos($extracurricular_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT filename FROM extracurricular_photos WHERE extracurricular_id = ?");
    $stmt->bind_param("i", $extracurricular_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $photos = [];
    while ($row = $result->fetch_assoc()) {
        $photos[] = $row['filename'];
    }
    return $photos;
}
?>
