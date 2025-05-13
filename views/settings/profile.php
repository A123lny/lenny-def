
<?php
/**
 * Vista delle impostazioni del profilo utente
 */
require_once 'views/layout/header.php';
?>

<div class="container-fluid p-4">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= url('settings') ?>" class="btn btn-outline-secondary me-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="mb-0">Profilo Utente</h1>
            <p class="text-muted">Gestisci le tue informazioni personali</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="position-relative mx-auto mb-4" style="width: 120px; height: 120px;">
                        <img src="<?= asset('images/profilo.jpg') ?>" alt="Foto profilo" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                        <button class="btn btn-sm btn-primary position-absolute bottom-0 end-0">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                    <h5 class="mb-1">Admin Lenny</h5>
                    <p class="text-muted">Amministratore</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-key me-2"></i> Cambia Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <h5 class="mb-0">Informazioni Personali</h5>
                </div>
                <div class="card-body p-4">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" value="Admin">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cognome</label>
                                <input type="text" class="form-control" value="Lenny">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="admin@lenny.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telefono</label>
                                <input type="tel" class="form-control" value="+39 123 456 7890">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Indirizzo</label>
                            <input type="text" class="form-control" value="Via Roma 123, Milano">
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Città</label>
                                <input type="text" class="form-control" value="Milano">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">CAP</label>
                                <input type="text" class="form-control" value="20100">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Paese</label>
                                <input type="text" class="form-control" value="Italia">
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-light me-2">Annulla</button>
                            <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
