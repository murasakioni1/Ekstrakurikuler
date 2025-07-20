<?php include 'includes/header.php'; ?>
<?php include 'includes/config.php'; ?>
<?php include 'includes/functions.php'; ?>

<?php
if (!isset($_GET['extracurricular_id'])) {
    header("Location: index.php");
    exit();
}

$extracurricular_id = $_GET['extracurricular_id'];
$sql = "SELECT * FROM extracurricular WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $extracurricular_id);
$stmt->execute();
$result = $stmt->get_result();
$extracurricular = $result->fetch_assoc();

if (!$extracurricular) {
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <header>
        <h1>Form Pendaftaran Ekstrakurikuler</h1>
        <h2><?php echo htmlspecialchars($extracurricular['name']); ?></h2>
    </header>

    <form action="process_registration.php" method="POST" class="registration-form">
        <input type="hidden" name="extracurricular_id" value="<?php echo $extracurricular['id']; ?>">

        <div class="form-group">
            <label for="student_name">Nama Lengkap:</label>
            <input type="text" id="student_name" name="student_name" required>
        </div>

        <div class="form-group">
            <label for="student_nis">NIS:</label>
            <input type="text" id="student_nis" name="student_nis" required>
        </div>

        <div class="form-group">
            <label for="student_class">Kelas:</label>
            <input type="text" id="student_class" name="student_class" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Nomor Telepon/WA:</label>
            <input type="tel" id="phone_number" name="phone_number" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Daftar</button>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>