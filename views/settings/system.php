
<?php
/**
 * Vista per le impostazioni di sistema
 */
require_once 'views/layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Impostazioni di Sistema</h4>
                </div>
                <div class="card-body">
                    <form id="systemSettingsForm">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-4">Impostazioni Generali</h5>
                                
                                <div class="mb-3">
                                    <label for="siteName" class="form-label">Nome Sito</label>
                                    <input type="text" class="form-control" id="siteName" value="Lenny Food Delivery">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="siteUrl" class="form-label">URL Sito</label>
                                    <input type="url" class="form-control" id="siteUrl" value="https://lenny.it">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="timezone" class="form-label">Fuso Orario</label>
                                    <select class="form-select" id="timezone">
                                        <option value="Europe/Rome" selected>Europe/Rome</option>
                                        <option value="Europe/London">Europe/London</option>
                                        <option value="America/New_York">America/New_York</option>
                                        <option value="Asia/Tokyo">Asia/Tokyo</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="currency" class="form-label">Valuta</label>
                                    <select class="form-select" id="currency">
                                        <option value="EUR" selected>Euro (€)</option>
                                        <option value="USD">Dollaro USA ($)</option>
                                        <option value="GBP">Sterlina (£)</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="debugMode" checked>
                                    <label class="form-check-label" for="debugMode">Modalità Debug</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="mb-4">Impostazioni Email</h5>
                                
                                <div class="mb-3">
                                    <label for="smtpServer" class="form-label">Server SMTP</label>
                                    <input type="text" class="form-control" id="smtpServer" value="smtp.example.com">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="smtpPort" class="form-label">Porta SMTP</label>
                                    <input type="number" class="form-control" id="smtpPort" value="587">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="smtpUsername" class="form-label">Username SMTP</label>
                                    <input type="text" class="form-control" id="smtpUsername" value="user@example.com">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="smtpPassword" class="form-label">Password SMTP</label>
                                    <input type="password" class="form-control" id="smtpPassword" value="password">
                                </div>
                                
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="enableEmails" checked>
                                    <label class="form-check-label" for="enableEmails">Abilita Invio Email</label>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-3">Salva Impostazioni</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
