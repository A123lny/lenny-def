
<?php
/**
 * Vista per la gestione delle impostazioni di sistema
 */
$pageTitle = "Impostazioni sistema";
require_once 'views/layout/header.php';
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= url('settings') ?>">Impostazioni</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Impostazioni sistema</li>
                </ol>
            </nav>
            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cogs text-primary me-2"></i>
                        Configurazione generale
                    </h5>
                </div>
                <div class="card-body">
                    <form>
                        <!-- Sezione impostazioni generali -->
                        <div class="mb-4">
                            <h6 class="border-bottom pb-2 mb-3">Impostazioni generali</h6>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="appName" class="form-label">Nome applicazione</label>
                                    <input type="text" class="form-control" id="appName" value="<?= APP_NAME ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="appUrl" class="form-label">URL base</label>
                                    <input type="text" class="form-control" id="appUrl" value="<?= APP_URL ?>">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="timezone" class="form-label">Fuso orario</label>
                                    <select class="form-select" id="timezone">
                                        <option value="Europe/Rome" selected>Europe/Rome (GMT+1)</option>
                                        <option value="Europe/London">Europe/London (GMT+0)</option>
                                        <option value="Europe/Paris">Europe/Paris (GMT+1)</option>
                                        <option value="America/New_York">America/New_York (GMT-5)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="dateFormat" class="form-label">Formato data</label>
                                    <select class="form-select" id="dateFormat">
                                        <option value="d/m/Y" selected>DD/MM/YYYY (31/12/2023)</option>
                                        <option value="m/d/Y">MM/DD/YYYY (12/31/2023)</option>
                                        <option value="Y-m-d">YYYY-MM-DD (2023-12-31)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sezione notifiche -->
                        <div class="mb-4">
                            <h6 class="border-bottom pb-2 mb-3">Notifiche</h6>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="enableNotifications" checked>
                                <label class="form-check-label" for="enableNotifications">Abilita notifiche</label>
                            </div>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="enableEmailNotifications" checked>
                                <label class="form-check-label" for="enableEmailNotifications">Invia notifiche via email</label>
                            </div>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="enableSoundNotifications" checked>
                                <label class="form-check-label" for="enableSoundNotifications">Abilita suoni per le notifiche</label>
                            </div>
                        </div>
                        
                        <!-- Sezione email -->
                        <div class="mb-4">
                            <h6 class="border-bottom pb-2 mb-3">Configurazione email</h6>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="smtpHost" class="form-label">SMTP Host</label>
                                    <input type="text" class="form-control" id="smtpHost" value="smtp.example.com">
                                </div>
                                <div class="col-md-6">
                                    <label for="smtpPort" class="form-label">SMTP Porta</label>
                                    <input type="text" class="form-control" id="smtpPort" value="587">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="smtpUser" class="form-label">SMTP Username</label>
                                    <input type="text" class="form-control" id="smtpUser" value="user@example.com">
                                </div>
                                <div class="col-md-6">
                                    <label for="smtpPassword" class="form-label">SMTP Password</label>
                                    <input type="password" class="form-control" id="smtpPassword" value="password">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="emailSender" class="form-label">Email mittente</label>
                                <input type="email" class="form-control" id="emailSender" value="no-reply@lenny.com">
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-outline-primary">Test connessione</button>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-outline-secondary me-md-2">Ripristina predefiniti</button>
                            <button type="button" class="btn btn-primary">Salva impostazioni</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
