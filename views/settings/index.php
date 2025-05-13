<?php
/**
 * Vista principale delle impostazioni
 */
require_once 'views/layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Impostazioni</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-circle fa-3x mb-3 text-primary"></i>
                                    <h5 class="card-title">Profilo Utente</h5>
                                    <p class="card-text">Gestisci le informazioni del tuo profilo</p>
                                    <a href="<?php echo url('settings', 'profile'); ?>" class="btn btn-primary">Vai al Profilo</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-cogs fa-3x mb-3 text-warning"></i>
                                    <h5 class="card-title">Impostazioni Sistema</h5>
                                    <p class="card-text">Configura le impostazioni di sistema</p>
                                    <a href="<?php echo url('settings', 'system'); ?>" class="btn btn-warning">Impostazioni Sistema</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-shield-alt fa-3x mb-3 text-danger"></i>
                                    <h5 class="card-title">Sicurezza</h5>
                                    <p class="card-text">Gestisci le impostazioni di sicurezza e accesso</p>
                                    <a href="<?php echo url('settings', 'security'); ?>" class="btn btn-danger">Impostazioni Sicurezza</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-users-cog fa-3x mb-3 text-info"></i>
                                    <h5 class="card-title">Ruoli e Permessi</h5>
                                    <p class="card-text">Configura ruoli utente e livelli di accesso</p>
                                    <a href="<?php echo url('settings', 'roles'); ?>" class="btn btn-info">Gestione Ruoli</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>