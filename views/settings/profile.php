
<?php
/**
 * Vista per il profilo utente
 */
require_once 'views/layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profilo Utente</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <img src="<?php echo asset('images/profilo.jpg'); ?>" alt="Immagine Profilo" class="img-fluid rounded-circle mb-3" style="max-width: 200px;">
                            <h5><?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Utente'; ?></h5>
                            <p class="text-muted"><?php echo isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'Ruolo non definito'; ?></p>
                        </div>
                        <div class="col-md-8">
                            <form id="profileForm">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nome Utente</label>
                                    <input type="text" class="form-control" id="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" id="fullname" value="<?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="currentPassword" class="form-label">Password Attuale</label>
                                    <input type="password" class="form-control" id="currentPassword">
                                </div>
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">Nuova Password</label>
                                    <input type="password" class="form-control" id="newPassword">
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Conferma Password</label>
                                    <input type="password" class="form-control" id="confirmPassword">
                                </div>
                                <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
