<?php
include 'includes/header.php';
include 'includes/config.php';
include 'includes/functions.php';

if (!isset($_GET['id'])) {
    echo "<p>Ekstrakurikuler tidak ditemukan.</p>";
    include 'includes/footer.php';
    exit;
}

$id = intval($_GET['id']);
$data = getExtracurricularById($id);

if (!$data) {
    echo "<p>Ekstrakurikuler tidak ditemukan.</p>";
    include 'includes/footer.php';
    exit;
}

$photos = getExtracurricularPhotos($id);
?>

<div class="container" style="display: flex; gap: 40px; align-items: flex-start; flex-wrap: wrap;">
    <!-- Card Registrasi Kecil di Kiri -->
    <div class="card" style="max-width:260px; min-width:220px; margin:0;">
        <img src="/ekstrakurikuler/assets/images/<?php echo htmlspecialchars($data['image'] ?: 'default.jpg'); ?>" 
             alt="<?php echo htmlspecialchars($data['name']); ?>_logo" class="card-logo">
        <h2 style="font-size:1.2em;"><?php echo htmlspecialchars($data['name']); ?></h2>
        <p style="font-size:0.95em;"><?php echo htmlspecialchars($data['description']); ?></p>
        <p style="font-size:0.95em;"><strong>Jadwal:</strong> <?php echo htmlspecialchars($data['schedule']); ?></p>
        <p style="font-size:0.95em;"><strong>Kuota:</strong> <?php echo htmlspecialchars($data['quota']); ?> siswa</p>
        <a href="register.php?extracurricular_id=<?php echo $data['id']; ?>" class="btn" style="width:100%;text-align:center;">Daftar Sekarang</a>
    </div>

    <!-- Galeri Foto Kegiatan -->
    <div style="flex:1;">
        <h3>Galeri Demo Ekstrakurikuler</h3>
        <?php if ($photos): ?>
            <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                <?php foreach ($photos as $photo): ?>
                    <img src="/ekstrakurikuler/assets/images/kegiatan/<?php echo htmlspecialchars($photo); ?>"
                         alt="Kegiatan <?php echo htmlspecialchars($data['name']); ?>"
                         style="width:auto; height: 150px; object-fit:cover; border-radius:8px; cursor:pointer;" 
                         onclick="openModal(this.src)">
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Belum ada foto kegiatan.</p>
        <?php endif; ?>
    </div>
</div>

<div style="margin: 30px 0 0 0; text-align: center;">
    <a href="index.php" class="btn" style="background:#3498db;">&larr; Kembali ke Daftar Ekstrakurikuler</a>
</div>

<!-- Modal untuk zoom foto -->
<div id="photoModal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.7); align-items:center; justify-content:center;">
    <span id="closeModal" style="position:absolute;top:30px;right:40px;font-size:40px;color:white;cursor:pointer;">&times;</span>
    <img id="modalImg" src="" alt="Zoom Foto" style="max-width:90vw; max-height:80vh; border-radius:10px; box-shadow:0 4px 32px #000;">
</div>

<script>
    function openModal(src) {
        document.getElementById('modalImg').src = src;
        document.getElementById('photoModal').style.display = 'flex';
    }

    document.getElementById('closeModal').onclick = function() {
        document.getElementById('photoModal').style.display = 'none';
    }

    window.onclick = function(event) {
        var modal = document.getElementById('photoModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<?php include 'includes/footer.php'; ?>

