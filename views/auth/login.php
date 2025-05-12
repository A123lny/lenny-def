<?php require_once 'views/layout/header.php'; ?>

<style>
    .login-page {
        min-height: 100vh;
        background: url('<?= asset('images/sfondologin.jpg') ?>') no-repeat center center;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    .login-card {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 10px;
    }
    
    .credentials-box {
        background-color: rgba(255, 90, 95, 0.1);
        border-left: 4px solid #ff5a5f;
        padding: 15px;
        border-radius: 5px;
        margin-top: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .credentials-box p {
        margin: 0;
        color: #333;
        font-weight: 500;
    }
    
    .credentials-box strong {
        color: #ff5a5f;
    }
    
    .custom-input-group-text {
        background: linear-gradient(135deg, #ff5a5f 0%, #ff8f6b 100%);
        color: white;
        border: none;
    }
    
    .btn-custom-primary {
        background: linear-gradient(135deg, #ff5a5f 0%, #ff8f6b 100%);
        border: none;
        box-shadow: 0 4px 6px rgba(255, 90, 95, 0.25);
        transition: all 0.3s ease;
        color: white; /* Testo bianco per il pulsante */
    }
    
    .btn-custom-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(255, 90, 95, 0.35);
        color: white; /* Mantiene il testo bianco anche in hover */
    }
</style>

<div class="login-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow border-0 animate__animated animate__fadeInDown login-card">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <img src="<?= asset('images/lennyquadro.jpg') ?>" alt="Lenny" class="img-fluid mb-3 animate__animated animate__bounce" style="max-height: 100px; border-radius: 5px;">
                            <h2 class="fw-bold"><?= APP_NAME ?></h2>
                            <p class="text-muted">Accedi al gestionale</p>
                        </div>
                        
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= url('auth', 'authenticate') ?>" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text custom-input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Inserisci il tuo username" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text custom-input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Inserisci la tua password" required>
                                </div>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-custom-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i> Accedi
                                </button>
                            </div>
                        </form>
                        
                        <div class="credentials-box text-center mt-4">
                            <p>
                                <strong>Username:</strong> luca<br>
                                <strong>Password:</strong> lenny
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
