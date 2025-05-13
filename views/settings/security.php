
<?php
/**
 * Vista per le impostazioni di sicurezza
 */
require_once 'views/layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Impostazioni di Sicurezza</h4>
                    <a href="<?php echo url('settings'); ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Torna alle Impostazioni
                    </a>
                </div>
                <div class="card-body">
                    <form id="securitySettingsForm">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-4">Autenticazione</h5>
                                
                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="two_factor_auth" checked>
                                        <label class="form-check-label" for="two_factor_auth">Autenticazione a due fattori</label>
                                    </div>
                                    <small class="text-muted">Richiedi un codice aggiuntivo quando gli utenti effettuano l'accesso</small>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="password_policy" class="form-label">Policy Password</label>
                                    <select class="form-select" id="password_policy">
                                        <option value="basic">Base (minimo 8 caratteri)</option>
                                        <option value="medium" selected>Media (lettere, numeri, minimo 8 caratteri)</option>
                                        <option value="strong">Forte (lettere, numeri, simboli, minimo 10 caratteri)</option>
                                        <option value="custom">Personalizzata</option>
                                    </select>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="session_timeout" class="form-label">Timeout Sessione (minuti)</label>
                                    <input type="number" class="form-control" id="session_timeout" value="30">
                                    <small class="text-muted">Dopo quanto tempo di inattività l'utente viene disconnesso</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="mb-4">Accessi e Log</h5>
                                
                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="log_access_attempts" checked>
                                        <label class="form-check-label" for="log_access_attempts">Registra tentativi di accesso</label>
                                    </div>
                                    <small class="text-muted">Tieni traccia di tutti i tentativi di accesso riusciti e falliti</small>
                                </div>
                                
                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="lockout_enabled" checked>
                                        <label class="form-check-label" for="lockout_enabled">Blocco account</label>
                                    </div>
                                    <small class="text-muted">Blocca gli account dopo troppi tentativi falliti</small>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="lockout_attempts" class="form-label">Tentativi prima del blocco</label>
                                    <input type="number" class="form-control" id="lockout_attempts" value="5">
                                </div>
                                
                                <div class="mb-4">
                                    <label for="log_retention" class="form-label">Conservazione log (giorni)</label>
                                    <input type="number" class="form-control" id="log_retention" value="90">
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <h5 class="mb-4">IP consentiti</h5>
                                <p class="text-muted">Configura gli indirizzi IP da cui è consentito l'accesso al pannello di amministrazione</p>
                                
                                <div class="mb-3">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="ip_restrictions">
                                        <label class="form-check-label" for="ip_restrictions">Abilita restrizioni IP</label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="allowed_ips" class="form-label">IP consentiti (uno per riga)</label>
                                    <textarea class="form-control" id="allowed_ips" rows="4" placeholder="192.168.1.1
10.0.0.5
172.16.254.1"></textarea>
                                    <small class="text-muted">Lascia vuoto per consentire l'accesso da qualsiasi IP</small>
                                </div>
                            </div>
                            
                            <div class="col-12 text-end mt-4">
                                <button type="reset" class="btn btn-outline-secondary me-2">Annulla Modifiche</button>
                                <button type="submit" class="btn btn-primary">Salva Impostazioni</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
