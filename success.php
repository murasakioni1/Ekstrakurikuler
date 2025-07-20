<?php include 'includes/header.php'; ?>
<?php include 'includes/config.php'; ?>
<?php include 'includes/functions.php'; ?>

<?php
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$registration = getRegistrationById($_GET['id']);
if (!$registration) {
    header("Location: index.php");
    exit();
}
?>

<div class="container success-container">
    <div class="success-card">
        <h1>Pendaftaran Berhasil!</h1>
        <i class="fas fa-check-circle"></i>
        
        <div class="registration-details">
            <h2>Detail Pendaftaran</h2>
            <p><strong>Nama:</strong> <?php echo htmlspecialchars($registration['student_name']); ?></p>
            <p><strong>NIS:</strong> <?php echo htmlspecialchars($registration['student_nis']); ?></p>
            <p><strong>Kelas:</strong> <?php echo htmlspecialchars($registration['student_class']); ?></p>
            <p><strong>Ekstrakurikuler:</strong> <?php echo htmlspecialchars($registration['extracurricular_name']); ?></p>
            <p><strong>Tanggal Pendaftaran:</strong> <?php echo date('d/m/Y H:i', strtotime($registration['registration_date'])); ?></p>
            <p><strong>Status:</strong> <span class="status-pending"><?php echo htmlspecialchars($registration['status']); ?></span></p>
        </div>
        
        <p>Kami akan menghubungi Anda melalui nomor telepon/WA yang telah didaftarkan untuk informasi lebih lanjut.</p>
        
        <div class="actions">
            <a href="index.php" class="btn">Kembali ke Beranda</a>
            <button onclick="window.print()" class="btn print-btn">Cetak Bukti</button>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>