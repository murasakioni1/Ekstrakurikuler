<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pendaftaran Ekstrakurikuler</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Ekstrakurikuler/assets/css/style.css?v=2">
</head>
<body>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message" style="background: #ffebee; color: #c62828; padding: 15px; text-align: center;">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="success-message" style="background: #e8f5e9; color: #2e7d32; padding: 15px; text-align: center;">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    