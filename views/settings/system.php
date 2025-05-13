
<?php
/**
 * Vista delle impostazioni di sistema
 */
require_once 'views/layout/header.php';
?>

<div class="container-fluid p-4">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= url('settings') ?>" class="btn btn-outline-secondary me-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="mb-0">Impostazioni Sistema</h1>
            <p class="text-muted">Configura le impostazioni globali dell'applicazione</p>
        </div>
    </div>
    
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
                        <i class="fas fa-sliders-h me-2"></i>Generale
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab">
                        <i class="fas fa-truck me-2"></i>Consegne
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab">
                        <i class="fas fa-credit-card me-2"></i>Pagamenti
                    </button>
                </li>
            </ul>
            
            <div class="tab-content p-4" id="settingsTabsContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    <form>
                        <div class="mb-4">
                            <h5>Informazioni Azienda</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nome Azienda</label>
                                    <input type="text" class="form-control" value="Lenny Food Delivery">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="info@lenny.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Telefono</label>
                                    <input type="tel" class="form-control" value="+39 02 1234567">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Sito Web</label>
                                    <input type="url" class="form-control" value="https://lenny.com">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Impostazioni Regionali</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Lingua</label>
                                    <select class="form-select">
                                        <option value="it" selected>Italiano</option>
                                        <option value="en">English</option>
                                        <option value="fr">Français</option>
                                        <option value="de">Deutsch</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Fuso Orario</label>
                                    <select class="form-select">
                                        <option value="Europe/Rome" selected>Europe/Rome (GMT+1)</option>
                                        <option value="Europe/London">Europe/London (GMT+0)</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Formato Data</label>
                                    <select class="form-select">
                                        <option value="d/m/Y" selected>DD/MM/YYYY</option>
                                        <option value="m/d/Y">MM/DD/YYYY</option>
                                        <option value="Y-m-d">YYYY-MM-DD</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                        </div>
                    </form>
                </div>
                
                <div class="tab-pane fade" id="delivery" role="tabpanel">
                    <form>
                        <div class="mb-4">
                            <h5>Configurazione Consegne</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Raggio massimo consegna (km)</label>
                                    <input type="number" class="form-control" value="10">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tempo stimato preparazione (min)</label>
                                    <input type="number" class="form-control" value="15">
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="deliveryTracking" checked>
                                        <label class="form-check-label" for="deliveryTracking">Attiva tracciamento in tempo reale</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Costi di Consegna</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Costo base consegna (€)</label>
                                    <input type="number" step="0.01" class="form-control" value="2.50">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Costo al km extra (€)</label>
                                    <input type="number" step="0.01" class="form-control" value="0.50">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Soglia ordine gratuito (€)</label>
                                    <input type="number" step="0.01" class="form-control" value="25.00">
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                        </div>
                    </form>
                </div>
                
                <div class="tab-pane fade" id="payment" role="tabpanel">
                    <form>
                        <div class="mb-4">
                            <h5>Metodi di Pagamento</h5>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="paymentCash" checked>
                                    <label class="form-check-label" for="paymentCash">Contanti alla consegna</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="paymentCard" checked>
                                    <label class="form-check-label" for="paymentCard">Carta di credito/debito</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="paymentPaypal" checked>
                                    <label class="form-check-label" for="paymentPaypal">PayPal</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="paymentBancomat">
                                    <label class="form-check-label" for="paymentBancomat">Bancomat alla consegna</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="paymentTransfer">
                                    <label class="form-check-label" for="paymentTransfer">Bonifico bancario</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Impostazioni Fiscali</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">IVA (%)</label>
                                    <input type="number" step="0.01" class="form-control" value="22.00">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Modalità di arrotondamento</label>
                                    <select class="form-select">
                                        <option value="up">Per eccesso</option>
                                        <option value="down">Per difetto</option>
                                        <option value="nearest" selected>Al più vicino</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
