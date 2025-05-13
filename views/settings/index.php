
<?php
/**
 * Vista principale delle impostazioni
 */
$pageTitle = "Impostazioni";
require_once 'views/layout/header.php';
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cog text-primary me-2"></i>
                        Impostazioni sistema
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Sezione impostazioni profilo -->
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-box bg-primary bg-opacity-10 rounded p-3 me-3">
                                            <i class="fas fa-user-circle fa-2x text-primary"></i>
                                        </div>
                                        <h5 class="card-title mb-0">Profilo utente</h5>
                                    </div>
                                    <p class="card-text text-muted">
                                        Gestisci le informazioni del tuo profilo, preferenze e credenziali di accesso.
                                    </p>
                                    <a href="<?= url('settings', 'profile') ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit me-1"></i> Modifica profilo
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sezione impostazioni app -->
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-box bg-success bg-opacity-10 rounded p-3 me-3">
                                            <i class="fas fa-sliders-h fa-2x text-success"></i>
                                        </div>
                                        <h5 class="card-title mb-0">Impostazioni applicazione</h5>
                                    </div>
                                    <p class="card-text text-muted">
                                        Configura le impostazioni generali del sistema, notifiche e preferenze.
                                    </p>
                                    <a href="<?= url('settings', 'system') ?>" class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-cogs me-1"></i> Configura sistema
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sezione apparenza -->
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-box bg-info bg-opacity-10 rounded p-3 me-3">
                                            <i class="fas fa-palette fa-2x text-info"></i>
                                        </div>
                                        <h5 class="card-title mb-0">Apparenza</h5>
                                    </div>
                                    <p class="card-text text-muted">
                                        Personalizza l'interfaccia utente, incluso tema, colori e layout.
                                    </p>
                                    <button type="button" class="btn btn-sm btn-outline-info" disabled>
                                        <i class="fas fa-brush me-1"></i> Personalizza (prossimamente)
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sezione backup -->
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-box bg-warning bg-opacity-10 rounded p-3 me-3">
                                            <i class="fas fa-database fa-2x text-warning"></i>
                                        </div>
                                        <h5 class="card-title mb-0">Backup e ripristino</h5>
                                    </div>
                                    <p class="card-text text-muted">
                                        Gestisci backup dei dati, esportazioni e funzioni di ripristino.
                                    </p>
                                    <button type="button" class="btn btn-sm btn-outline-warning" disabled>
                                        <i class="fas fa-download me-1"></i> Gestisci backup (prossimamente)
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Informazioni sistema
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row" width="40%">Versione applicazione</th>
                                        <td><?= APP_VERSION ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Versione PHP</th>
                                        <td><?= phpversion() ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Server</th>
                                        <td><?= $_SERVER['SERVER_SOFTWARE'] ?? 'Non disponibile' ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Database</th>
                                        <td>MySQL</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <h6><i class="fas fa-lightbulb me-2"></i>Suggerimento</h6>
                                <p class="mb-0 small">
                                    Controlla regolarmente gli aggiornamenti del sistema per accedere alle nuove funzionalità
                                    e miglioramenti di sicurezza.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
