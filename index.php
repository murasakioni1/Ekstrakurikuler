<?php include 'includes/header.php'; ?>
<?php include 'includes/config.php'; ?>
<?php include 'includes/functions.php'; ?>

<div class="container">
    <header>
        <h1>Pendaftaran Ekstrakurikuler</h1>
        <p>SMK LPPM RI 1 & 2 Kota Bandung</p>
    </header>

    <section class="extracurricular-list">
        <h2>Daftar Ekstrakurikuler</h2>
        <div class="grid-container">
            <?php 
            $extracurriculars = getExtracurriculars();
            if ($extracurriculars->num_rows > 0): 
                while($row = $extracurriculars->fetch_assoc()): 
            ?>
                <div class="card">
                    <img 
                        src="/ekstrakurikuler/assets/images/<?php echo htmlspecialchars($row['image'] ?: 'default.jpg'); ?>" 
                        alt="<?php echo htmlspecialchars($row['name']); ?>_logo" 
                        class="card-logo">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <p><strong>Jadwal:</strong> <?php echo htmlspecialchars($row['schedule']); ?></p>
                    <p><strong>Kuota:</strong> <?php echo htmlspecialchars($row['quota']); ?> siswa</p>
                    <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn">Lihat Selengkapnya</a>
                </div>
            <?php 
                endwhile;
            else: 
            ?>
                <p>Tidak ada ekstrakurikuler tersedia saat ini.</p>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>


