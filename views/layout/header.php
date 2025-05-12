<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- Main CSS - Sistema CSS Modulare con percorso dinamico -->
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">
    
    <!-- Script per la generazione dei report dei ristoranti con percorso dinamico -->
    <script src="<?= asset('js/2-utils/restaurant-report.js') ?>" defer></script>
</head>
<body>

<?php if (isset($_SESSION['user_id'])): ?>
    <!-- Layout principale con sidebar -->
    <div class="layout-wrapper">
        <?php require_once 'views/layout/sidebar.php'; ?>
        
        <!-- Contenuto principale -->
        <main class="main-content">
            <?php require_once 'views/layout/navbar.php'; ?>
            
            <!-- Contenitore principale -->
            <div class="page-container">
<?php else: ?>
    <!-- Full width content for login page -->
    <div class="auth-wrapper">
<?php endif; ?>
