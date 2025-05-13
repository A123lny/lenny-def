
<?php
/**
 * Vista per la gestione del profilo utente
 */
$pageTitle = "Profilo utente";
require_once 'views/layout/header.php';
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= url('settings') ?>">Impostazioni</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profilo utente</li>
                </ol>
            </nav>
            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user-circle text-primary me-2"></i>
                        Profilo utente
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center mb-4">
                                <img src="<?= asset('images/profilo.jpg') ?>" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;" alt="Foto profilo">
                                <h5 class="mb-0">Admin</h5>
                                <p class="text-muted small">Amministratore</p>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-camera me-1"></i> Cambia foto
                                </button>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <form>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="firstName" value="Admin">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Cognome</label>
                                        <input type="text" class="form-control" id="lastName" value="Lenny">
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="admin@lenny.com">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telefono</label>
                                    <input type="tel" class="form-control" id="phone" value="+39 123 456 7890">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="role" class="form-label">Ruolo</label>
                                    <input type="text" class="form-control" id="role" value="Amministratore" readonly>
                                </div>
                                
                                <hr>
                                
                                <h6 class="mb-3">Cambia password</h6>
                                
                                <div class="mb-3">
                                    <label for="currentPassword" class="form-label">Password attuale</label>
                                    <input type="password" class="form-control" id="currentPassword">
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="newPassword" class="form-label">Nuova password</label>
                                        <input type="password" class="form-control" id="newPassword">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="confirmPassword" class="form-label">Conferma password</label>
                                        <input type="password" class="form-control" id="confirmPassword">
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="button" class="btn btn-outline-secondary me-md-2">Annulla</button>
                                    <button type="button" class="btn btn-primary">Salva modifiche</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
