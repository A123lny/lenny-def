
<?php
/**
 * Vista per la gestione delle integrazioni
 */
require_once 'views/layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Integrazioni</h4>
                    <a href="<?php echo url('settings'); ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Torna alle Impostazioni
                    </a>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs custom-tabs mb-4" id="integrationsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" type="button" role="tab" aria-controls="payments" aria-selected="true">
                                <i class="fas fa-credit-card me-2"></i> Pagamenti
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab" aria-controls="notifications" aria-selected="false">
                                <i class="fas fa-bell me-2"></i> Notifiche
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="maps-tab" data-bs-toggle="tab" data-bs-target="#maps" type="button" role="tab" aria-controls="maps" aria-selected="false">
                                <i class="fas fa-map-marker-alt me-2"></i> Mappe
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="analytics-tab" data-bs-toggle="tab" data-bs-target="#analytics" type="button" role="tab" aria-controls="analytics" aria-selected="false">
                                <i class="fas fa-chart-pie me-2"></i> Analytics
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="other-tab" data-bs-toggle="tab" data-bs-target="#other" type="button" role="tab" aria-controls="other" aria-selected="false">
                                <i class="fas fa-ellipsis-h me-2"></i> Altro
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="integrationsTabContent">
                        <!-- Tab Pagamenti -->
                        <div class="tab-pane fade show active" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="https://www.stripe.com/img/navbar-logo.svg" alt="Stripe" style="height: 40px;" class="me-3">
                                                <div>
                                                    <h5 class="mb-0">Stripe</h5>
                                                    <span class="badge bg-success">Attivo</span>
                                                </div>
                                                <div class="form-check form-switch ms-auto">
                                                    <input class="form-check-input" type="checkbox" id="stripeToggle" checked>
                                                </div>
                                            </div>
                                            <p class="text-muted">Elabora pagamenti con carte di credito, addebiti diretti e metodi di pagamento locali.</p>
                                            
                                            <div class="mb-3">
                                                <label for="stripePublicKey" class="form-label">Chiave Pubblica</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="stripePublicKey" value="pk_test_************FGHI" readonly>
                                                    <button class="btn btn-outline-secondary" type="button">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="stripeSecretKey" class="form-label">Chiave Segreta</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="stripeSecretKey" value="••••••••••••••••" readonly>
                                                    <button class="btn btn-outline-secondary" type="button">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <div class="text-end">
                                                <button class="btn btn-outline-primary btn-sm">Verifica Connessione</button>
                                                <button class="btn btn-primary btn-sm">Modifica</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 mb-4">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="https://www.paypal.com/favicon.ico" alt="PayPal" style="height: 40px;" class="me-3">
                                                <div>
                                                    <h5 class="mb-0">PayPal</h5>
                                                    <span class="badge bg-secondary">Non attivo</span>
                                                </div>
                                                <div class="form-check form-switch ms-auto">
                                                    <input class="form-check-input" type="checkbox" id="paypalToggle">
                                                </div>
                                            </div>
                                            <p class="text-muted">Integra PayPal per consentire ai clienti di pagare con il loro conto PayPal o carte di credito.</p>
                                            
                                            <div class="mb-3">
                                                <label for="paypalClientId" class="form-label">Client ID</label>
                                                <input type="text" class="form-control" id="paypalClientId" placeholder="Inserisci il Client ID">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="paypalClientSecret" class="form-label">Client Secret</label>
                                                <input type="password" class="form-control" id="paypalClientSecret" placeholder="Inserisci il Client Secret">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <select class="form-select" id="paypalEnvironment">
                                                    <option value="sandbox">Sandbox (Test)</option>
                                                    <option value="production">Produzione (Live)</option>
                                                </select>
                                            </div>
                                            
                                            <div class="text-end">
                                                <button class="btn btn-primary btn-sm">Attiva</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tab Notifiche -->
                        <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fas fa-sms fa-2x text-primary me-3"></i>
                                                <div>
                                                    <h5 class="mb-0">SMS</h5>
                                                    <span class="badge bg-success">Attivo</span>
                                                </div>
                                                <div class="form-check form-switch ms-auto">
                                                    <input class="form-check-input" type="checkbox" id="smsToggle" checked>
                                                </div>
                                            </div>
                                            <p class="text-muted">Invia SMS di notifica per aggiornamenti sugli ordini, conferme e promozioni.</p>
                                            
                                            <div class="mb-3">
                                                <label for="smsProvider" class="form-label">Provider</label>
                                                <select class="form-select" id="smsProvider">
                                                    <option value="twilio" selected>Twilio</option>
                                                    <option value="messagebird">MessageBird</option>
                                                    <option value="vonage">Vonage (Nexmo)</option>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="smsApiKey" class="form-label">API Key</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="smsApiKey" value="••••••••••••••••" readonly>
                                                    <button class="btn btn-outline-secondary" type="button">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="smsSenderID" class="form-label">ID Mittente</label>
                                                <input type="text" class="form-control" id="smsSenderID" value="LennyFood">
                                            </div>
                                            
                                            <div class="text-end">
                                                <button class="btn btn-outline-primary btn-sm">Invia Test</button>
                                                <button class="btn btn-primary btn-sm">Modifica</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 mb-4">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fas fa-envelope fa-2x text-warning me-3"></i>
                                                <div>
                                                    <h5 class="mb-0">Email</h5>
                                                    <span class="badge bg-success">Attivo</span>
                                                </div>
                                                <div class="form-check form-switch ms-auto">
                                                    <input class="form-check-input" type="checkbox" id="emailToggle" checked>
                                                </div>
                                            </div>
                                            <p class="text-muted">Gestisci l'invio di email transazionali, ricevute e newsletter.</p>
                                            
                                            <div class="mb-3">
                                                <label for="emailProvider" class="form-label">Provider</label>
                                                <select class="form-select" id="emailProvider">
                                                    <option value="smtp" selected>SMTP Personalizzato</option>
                                                    <option value="sendgrid">SendGrid</option>
                                                    <option value="mailchimp">Mailchimp</option>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="emailFrom" class="form-label">Email Mittente</label>
                                                <input type="email" class="form-control" id="emailFrom" value="noreply@lenny.it">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="emailReplyTo" class="form-label">Rispondi a</label>
                                                <input type="email" class="form-control" id="emailReplyTo" value="supporto@lenny.it">
                                            </div>
                                            
                                            <div class="text-end">
                                                <button class="btn btn-outline-primary btn-sm">Invia Test</button>
                                                <button class="btn btn-primary btn-sm">Modifica</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tab Mappe -->
                        <div class="tab-pane fade" id="maps" role="tabpanel" aria-labelledby="maps-tab">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i> Le integrazioni di mappe sono utilizzate per il tracking degli ordini, la geocodifica degli indirizzi e il calcolo delle rotte di consegna.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="https://developers.google.com/maps/images/maps-icon.svg" alt="Google Maps" style="height: 40px;" class="me-3">
                                                <div>
                                                    <h5 class="mb-0">Google Maps</h5>
                                                    <span class="badge bg-success">Attivo</span>
                                                </div>
                                                <div class="form-check form-switch ms-auto">
                                                    <input class="form-check-input" type="checkbox" id="googleMapsToggle" checked>
                                                </div>
                                            </div>
                                            <p class="text-muted">Integrazione con Google Maps per geocodifica, mappe e calcolo percorsi.</p>
                                            
                                            <div class="mb-3">
                                                <label for="googleMapsKey" class="form-label">API Key</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="googleMapsKey" value="••••••••••••••••" readonly>
                                                    <button class="btn btn-outline-secondary" type="button">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">API abilitate</label>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <span class="badge bg-light text-dark">Maps JavaScript API</span>
                                                    <span class="badge bg-light text-dark">Geocoding API</span>
                                                    <span class="badge bg-light text-dark">Directions API</span>
                                                    <span class="badge bg-light text-dark">Distance Matrix API</span>
                                                    <span class="badge bg-light text-dark">Places API</span>
                                                </div>
                                            </div>
                                            
                                            <div class="text-end">
                                                <button class="btn btn-outline-primary btn-sm">Verifica API</button>
                                                <button class="btn btn-primary btn-sm">Modifica</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 mb-4">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fab fa-map fa-2x text-info me-3"></i>
                                                <div>
                                                    <h5 class="mb-0">Mapbox</h5>
                                                    <span class="badge bg-secondary">Non attivo</span>
                                                </div>
                                                <div class="form-check form-switch ms-auto">
                                                    <input class="form-check-input" type="checkbox" id="mapboxToggle">
                                                </div>
                                            </div>
                                            <p class="text-muted">Alternativa a Google Maps per mappe personalizzabili, geocodifica e calcolo percorsi.</p>
                                            
                                            <div class="mb-3">
                                                <label for="mapboxToken" class="form-label">Access Token</label>
                                                <input type="text" class="form-control" id="mapboxToken" placeholder="Inserisci Mapbox Access Token">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="mapboxStyle" class="form-label">Stile Mappa</label>
                                                <select class="form-select" id="mapboxStyle">
                                                    <option value="mapbox/streets-v11">Streets</option>
                                                    <option value="mapbox/light-v10">Light</option>
                                                    <option value="mapbox/dark-v10">Dark</option>
                                                    <option value="mapbox/satellite-v9">Satellite</option>
                                                </select>
                                            </div>
                                            
                                            <div class="text-end">
                                                <button class="btn btn-primary btn-sm">Attiva</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tab Analytics -->
                        <div class="tab-pane fade" id="analytics" role="tabpanel" aria-labelledby="analytics-tab">
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fab fa-google fa-2x text-danger me-3"></i>
                                                <div>
                                                    <h5 class="mb-0">Google Analytics</h5>
                                                    <span class="badge bg-success">Attivo</span>
                                                </div>
                                                <div class="form-check form-switch ms-auto">
                                                    <input class="form-check-input" type="checkbox" id="gaToggle" checked>
                                                </div>
                                            </div>
                                            <p class="text-muted">Monitora il comportamento degli utenti e le conversioni sul sito e app mobile.</p>
                                            
                                            <div class="mb-3">
                                                <label for="gaTrackingId" class="form-label">Tracking ID</label>
                                                <input type="text" class="form-control" id="gaTrackingId" value="G-ABCDEF1234">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gaEnhancedEcommerce" checked>
                                                    <label class="form-check-label" for="gaEnhancedEcommerce">
                                                        Abilita Enhanced Ecommerce
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gaIpAnonymization" checked>
                                                    <label class="form-check-label" for="gaIpAnonymization">
                                                        Anonimizzazione IP
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <div class="text-end">
                                                <button class="btn btn-outline-primary btn-sm">Verifica Connessione</button>
                                                <button class="btn btn-primary btn-sm">Modifica</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 mb-4">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fab fa-facebook fa-2x text-primary me-3"></i>
                                                <div>
                                                    <h5 class="mb-0">Facebook Pixel</h5>
                                                    <span class="badge bg-secondary">Non attivo</span>
                                                </div>
                                                <div class="form-check form-switch ms-auto">
                                                    <input class="form-check-input" type="checkbox" id="fbPixelToggle">
                                                </div>
                                            </div>
                                            <p class="text-muted">Monitora conversioni dal marketing su Facebook e migliora gli annunci.</p>
                                            
                                            <div class="mb-3">
                                                <label for="fbPixelId" class="form-label">Pixel ID</label>
                                                <input type="text" class="form-control" id="fbPixelId" placeholder="Inserisci Facebook Pixel ID">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Eventi da tracciare</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="fbEventPageView">
                                                    <label class="form-check-label" for="fbEventPageView">
                                                        PageView
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="fbEventAddToCart">
                                                    <label class="form-check-label" for="fbEventAddToCart">
                                                        AddToCart
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="fbEventPurchase">
                                                    <label class="form-check-label" for="fbEventPurchase">
                                                        Purchase
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <div class="text-end">
                                                <button class="btn btn-primary btn-sm">Attiva</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tab Altro -->
                        <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                            <div class="d-flex justify-content-end mb-4">
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i> Aggiungi Nuova Integrazione
                                </button>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fas fa-headset fa-2x text-purple me-3"></i>
                                                <div>
                                                    <h5 class="mb-0">Zendesk</h5>
                                                    <span class="badge bg-secondary">Non attivo</span>
                                                </div>
                                                <div class="form-check form-switch ms-auto">
                                                    <input class="form-check-input" type="checkbox" id="zendeskToggle">
                                                </div>
                                            </div>
                                            <p class="text-muted">Integrazione con Zendesk per gestione ticket e supporto clienti.</p>
                                            
                                            <div class="mb-3">
                                                <label for="zendeskDomain" class="form-label">Dominio Zendesk</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="zendeskDomain" placeholder="tuo-dominio">
                                                    <span class="input-group-text">.zendesk.com</span>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="zendeskApiToken" class="form-label">API Token</label>
                                                <input type="password" class="form-control" id="zendeskApiToken" placeholder="Inserisci API token">
                                            </div>
                                            
                                            <div class="text-end">
                                                <button class="btn btn-primary btn-sm">Attiva</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 mb-4">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fas fa-cloud fa-2x text-info me-3"></i>
                                                <div>
                                                    <h5 class="mb-0">Webhook Personalizzati</h5>
                                                    <span class="badge bg-success">Attivo</span>
                                                </div>
                                                <div class="form-check form-switch ms-auto">
                                                    <input class="form-check-input" type="checkbox" id="webhookToggle" checked>
                                                </div>
                                            </div>
                                            <p class="text-muted">Configura webhook per inviare notifiche a sistemi esterni quando si verificano eventi specifici.</p>
                                            
                                            <div class="table-responsive mb-3">
                                                <table class="table table-sm">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Evento</th>
                                                            <th>URL</th>
                                                            <th>Stato</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Nuovo ordine</td>
                                                            <td>https://api.esempio.it/webhooks/orders</td>
                                                            <td><span class="badge bg-success">Attivo</span></td>
                                                            <td class="text-end">
                                                                <button class="btn btn-sm btn-outline-secondary">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Stato ordine cambiato</td>
                                                            <td>https://api.esempio.it/webhooks/status</td>
                                                            <td><span class="badge bg-success">Attivo</span></td>
                                                            <td class="text-end">
                                                                <button class="btn btn-sm btn-outline-secondary">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                            <div class="text-end">
                                                <button class="btn btn-outline-primary btn-sm">Aggiungi Webhook</button>
                                                <button class="btn btn-primary btn-sm">Gestisci</button>
                                            </div>
                                        </div>
                                    </div>
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
