
<?php
/**
 * Vista principale delle impostazioni
 */
require_once 'views/layout/header.php';
?>

<div class="container-fluid p-4">
    <div class="d-flex align-items-center mb-4">
        <div class="me-3">
            <div class="bg-primary bg-opacity-10 p-3 rounded">
                <i class="fas fa-cog fa-2x text-primary"></i>
            </div>
        </div>
        <div>
            <h1 class="mb-0">Impostazioni</h1>
            <p class="text-muted">Gestisci le impostazioni dell'applicazione</p>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                            <i class="fas fa-user fa-lg text-info"></i>
                        </div>
                        <h5 class="card-title mb-0">Profilo Utente</h5>
                    </div>
                    <p class="card-text text-muted mb-4">Gestisci le informazioni del tuo profilo, impostazioni di sicurezza e preferenze personali.</p>
                    <a href="<?= url('settings', 'profile') ?>" class="btn btn-outline-primary mt-auto">Modifica Profilo</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                            <i class="fas fa-server fa-lg text-success"></i>
                        </div>
                        <h5 class="card-title mb-0">Impostazioni Sistema</h5>
                    </div>
                    <p class="card-text text-muted mb-4">Configura le impostazioni globali del sistema, opzioni di consegna e preferenze di notifica.</p>
                    <a href="<?= url('settings', 'system') ?>" class="btn btn-outline-success mt-auto">Configura Sistema</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                            <i class="fas fa-bell fa-lg text-warning"></i>
                        </div>
                        <h5 class="card-title mb-0">Notifiche</h5>
                    </div>
                    <p class="card-text text-muted mb-4">Gestisci le impostazioni di notifica, allarmi e avvisi per vari eventi del sistema.</p>
                    <button class="btn btn-outline-warning mt-auto" disabled>Prossimamente</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
