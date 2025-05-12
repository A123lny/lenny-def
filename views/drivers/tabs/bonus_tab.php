<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center mb-4">
                    <span class="icon-circle bg-primary-light driver-text-primary me-2">
                        <i class="fas fa-gift"></i>
                    </span>
                    Bonus e Incentivi
                </h5>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border bg-light-blue-soft mb-3">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-3 d-flex align-items-center">
                                    <span class="icon-circle bg-primary-soft driver-text-primary me-2" style="width: 28px; height: 28px;">
                                        <i class="fas fa-star fa-sm"></i>
                                    </span>
                                    Bonus Presenza
                                </h6>
                                <div class="form-group mb-3">
                                    <label for="presenza_bonus" class="form-label small text-muted">Bonus mensile per presenza (€)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="presenza_bonus" value="100.00" step="10">
                                        <span class="input-group-text">€</span>
                                    </div>
                                    <div class="form-text small mt-1">Bonus erogato al completamento di tutti i turni mensili programmati.</div>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" id="presenza_bonus_active" checked>
                                    <label class="form-check-label" for="presenza_bonus_active">Attivo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card border bg-light-green-soft mb-3">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-3 d-flex align-items-center">
                                    <span class="icon-circle bg-success-light driver-text-success me-2" style="width: 28px; height: 28px;">
                                        <i class="fas fa-clock fa-sm"></i>
                                    </span>
                                    Bonus Puntualità
                                </h6>
                                <div class="form-group mb-3">
                                    <label for="puntualita_bonus" class="form-label small text-muted">Bonus mensile per puntualità (€)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="puntualita_bonus" value="50.00" step="10">
                                        <span class="input-group-text">€</span>
                                    </div>
                                    <div class="form-text small mt-1">Bonus erogato con ritardo massimo di 5 minuti sul 90% delle consegne.</div>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" id="puntualita_bonus_active" checked>
                                    <label class="form-check-label" for="puntualita_bonus_active">Attivo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card border bg-light-orange-soft mb-3">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-3 d-flex align-items-center">
                                    <span class="icon-circle bg-warning-soft driver-text-warning me-2" style="width: 28px; height: 28px;">
                                        <i class="fas fa-coins fa-sm"></i>
                                    </span>
                                    Bonus Ordini
                                </h6>
                                <div class="form-group mb-3">
                                    <label for="ordini_bonus_threshold" class="form-label small text-muted">Soglia mensile ordini</label>
                                    <input type="number" class="form-control" id="ordini_bonus_threshold" value="150" min="1" step="5">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="ordini_bonus_amount" class="form-label small text-muted">Importo bonus (€)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="ordini_bonus_amount" value="75.00" step="5">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" id="ordini_bonus_active" checked>
                                    <label class="form-check-label" for="ordini_bonus_active">Attivo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card border bg-light-red-soft mb-3">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-3 d-flex align-items-center">
                                    <span class="icon-circle bg-danger-soft driver-text-danger me-2" style="width: 28px; height: 28px;">
                                        <i class="fas fa-thumbs-up fa-sm"></i>
                                    </span>
                                    Bonus Feedback Cliente
                                </h6>
                                <div class="form-group mb-3">
                                    <label for="feedback_bonus_threshold" class="form-label small text-muted">Soglia rating mensile</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="feedback_bonus_threshold" value="4.8" min="1" max="5" step="0.1">
                                        <span class="input-group-text"><i class="fas fa-star fa-sm"></i></span>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="feedback_bonus_amount" class="form-label small text-muted">Importo bonus (€)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="feedback_bonus_amount" value="60.00" step="5">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" id="feedback_bonus_active" checked>
                                    <label class="form-check-label" for="feedback_bonus_active">Attivo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alert alert-info border-0 d-flex align-items-center p-3">
                            <div class="alert-icon me-3">
                                <span class="icon-circle bg-info-soft driver-text-info">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-medium">Informazioni sui bonus</h6>
                                <p class="small mb-0">I bonus vengono calcolati mensilmente e aggiunti alla paga del mese successivo. I bonus inattivi non verranno considerati nel calcolo.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm driver-btn-outline" id="resetBonusDefaults">
                                <i class="fas fa-redo me-2"></i>Ripristina valori predefiniti
                            </button>
                            <button type="button" class="btn btn-sm btn-primary ms-2" id="saveBonusChanges">
                                <i class="fas fa-save me-2"></i>Salva modifiche
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Color variations for bonus cards */
.bg-light-blue-soft {
    background-color: rgba(255, 90, 95, 0.05);
    border-color: rgba(255, 90, 95, 0.2) !important;
}

.bg-light-green-soft {
    background-color: rgba(0, 214, 143, 0.05);
    border-color: rgba(0, 214, 143, 0.2) !important;
}

.bg-light-orange-soft {
    background-color: rgba(255, 170, 0, 0.05);
    border-color: rgba(255, 170, 0, 0.2) !important;
}

.bg-light-red-soft {
    background-color: rgba(244, 67, 54, 0.05);
    border-color: rgba(244, 67, 54, 0.2) !important;
}

/* Icon styles */
.icon-circle {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.bg-primary-light {
    background-color: rgba(255, 90, 95, 0.1);
}

.bg-primary-soft {
    background-color: rgba(255, 90, 95, 0.1);
}

.bg-info-soft {
    background-color: rgba(54, 209, 220, 0.1);
}

.bg-warning-soft {
    background-color: rgba(255, 170, 0, 0.1);
}

.bg-danger-soft {
    background-color: rgba(244, 67, 54, 0.1);
}

.bg-success-light {
    background-color: rgba(0, 214, 143, 0.1);
}

.driver-text-primary {
    color: #ff5a5f !important;
}

.driver-text-info {
    color: #36D1DC !important;
}

.driver-text-warning {
    color: #FFA500 !important;
}

.driver-text-danger {
    color: #f44336 !important;
}

.driver-text-success {
    color: #00d68f !important;
}

/* Switch customization */
.form-check-input:checked {
    background-color: #ff5a5f;
    border-color: #ff5a5f;
}

/* Input customization */
.form-control:focus,
.form-select:focus {
    border-color: #ff5a5f;
    box-shadow: 0 0 0 3px rgba(255, 90, 95, 0.15);
}

/* Button styles */
.driver-btn-outline {
    border: 1px solid #e9ecef;
    background-color: transparent;
    color: #64748b;
    transition: all 0.3s ease;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
}

.driver-btn-outline:hover {
    background-color: #f8f9fa;
    color: #ff5a5f;
    border-color: #ff5a5f;
}

/* Card hover effect */
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #ff5a5f 0%, #ff8f6b 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 90, 95, 0.3);
}

.alert-info {
    background-color: rgba(54, 209, 220, 0.1);
    border-left: 3px solid #36D1DC !important;
}
</style>