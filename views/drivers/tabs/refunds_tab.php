<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center mb-4">
                    <span class="icon-circle bg-danger-light text-danger me-2">
                        <i class="fas fa-hand-holding-usd"></i>
                    </span>
                    Gestione Rimborsi
                </h5>
                
                <!-- Rimborsi Carburante -->
                <div class="mb-4">
                    <h6 class="driver-section-title fw-bold mb-3 d-flex align-items-center">
                        <span class="icon-circle-sm bg-danger-soft text-danger me-2">
                            <i class="fas fa-gas-pump"></i>
                        </span>
                        Rimborsi Carburante
                    </h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card border-0 driver-card-soft p-3">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="fuelReimbursementSwitch" checked>
                                    <label class="form-check-label fw-bold" for="fuelReimbursementSwitch">Attiva rimborsi carburante</label>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Tipo di calcolo</label>
                                    <select class="form-select" id="fuelCalculationType">
                                        <option value="km">Per chilometro</option>
                                        <option value="percentage" selected>Percentuale sul totale</option>
                                        <option value="fixed">Importo fisso</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Importo rimborso</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="fuelReimbursementAmount" value="12.5" step="0.1">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <small class="form-text text-muted">Percentuale sul costo del carburante</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card border-0 driver-card-soft p-3">
                                <h6 class="mb-3 small fw-bold">Condizioni di rimborso</h6>
                                
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Soglia minima di km</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="minimumKmThreshold" value="50" min="0">
                                        <span class="input-group-text">km</span>
                                    </div>
                                    <small class="form-text text-muted">Distanza minima per ottenere rimborso</small>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Frequenza rimborso</label>
                                    <select class="form-select" id="fuelReimbursementFrequency">
                                        <option value="weekly">Settimanale</option>
                                        <option value="biweekly">Bisettimanale</option>
                                        <option value="monthly" selected>Mensile</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Rimborsi Manutenzione -->
                <div class="mb-4">
                    <h6 class="driver-section-title fw-bold mb-3 d-flex align-items-center">
                        <span class="icon-circle-sm bg-warning-soft driver-text-warning me-2">
                            <i class="fas fa-tools"></i>
                        </span>
                        Rimborsi Manutenzione
                    </h6>
                    <div class="table-responsive">
                        <table class="table driver-table">
                            <thead>
                                <tr>
                                    <th>Tipo Intervento</th>
                                    <th>Percentuale Rimborso</th>
                                    <th>Massimale</th>
                                    <th>Frequenza</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" value="Cambio olio" id="maintenance-type-1">
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="number" class="form-control" id="maintenance-percentage-1" value="70" min="0" max="100">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="number" class="form-control" id="maintenance-max-1" value="50.00" step="0.50">
                                            <span class="input-group-text">€</span>
                                        </div>
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm" id="maintenance-frequency-1">
                                            <option value="once">Una tantum</option>
                                            <option value="monthly">Mensile</option>
                                            <option value="quarterly" selected>Trimestrale</option>
                                            <option value="semestral">Semestrale</option>
                                            <option value="yearly">Annuale</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="#" class="action-btn delete-btn" data-bs-toggle="tooltip" title="Elimina">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" value="Pneumatici" id="maintenance-type-2">
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="number" class="form-control" id="maintenance-percentage-2" value="50" min="0" max="100">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="number" class="form-control" id="maintenance-max-2" value="120.00" step="0.50">
                                            <span class="input-group-text">€</span>
                                        </div>
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm" id="maintenance-frequency-2">
                                            <option value="once">Una tantum</option>
                                            <option value="monthly">Mensile</option>
                                            <option value="quarterly">Trimestrale</option>
                                            <option value="semestral">Semestrale</option>
                                            <option value="yearly" selected>Annuale</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="#" class="action-btn delete-btn" data-bs-toggle="tooltip" title="Elimina">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" value="Revisione" id="maintenance-type-3">
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="number" class="form-control" id="maintenance-percentage-3" value="100" min="0" max="100">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="number" class="form-control" id="maintenance-max-3" value="80.00" step="0.50">
                                            <span class="input-group-text">€</span>
                                        </div>
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm" id="maintenance-frequency-3">
                                            <option value="once">Una tantum</option>
                                            <option value="monthly">Mensile</option>
                                            <option value="quarterly">Trimestrale</option>
                                            <option value="semestral">Semestrale</option>
                                            <option value="yearly" selected>Annuale</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="#" class="action-btn delete-btn" data-bs-toggle="tooltip" title="Elimina">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-sm btn-primary driver-modal-button">
                                <i class="fas fa-plus me-1"></i> Aggiungi intervento
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Altri Rimborsi -->
                <div>
                    <h6 class="driver-section-title fw-bold mb-3 d-flex align-items-center">
                        <span class="icon-circle-sm bg-success-light driver-text-success me-2">
                            <i class="fas fa-money-bill-wave"></i>
                        </span>
                        Altri Rimborsi
                    </h6>
                    <div class="table-responsive">
                        <table class="table driver-table">
                            <thead>
                                <tr>
                                    <th>Tipo Rimborso</th>
                                    <th>Descrizione</th>
                                    <th>Importo</th>
                                    <th>Periodo</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" id="other-reimbursement-type-1" value="Telefono">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" id="other-reimbursement-desc-1" value="Rimborso spese telefoniche">
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="number" class="form-control" id="other-reimbursement-amount-1" value="20.00" step="0.50">
                                            <span class="input-group-text">€</span>
                                        </div>
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm" id="other-reimbursement-period-1">
                                            <option value="once">Una tantum</option>
                                            <option value="weekly">Settimanale</option>
                                            <option value="monthly" selected>Mensile</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="#" class="action-btn delete-btn" data-bs-toggle="tooltip" title="Elimina">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" id="other-reimbursement-type-2" value="Attrezzatura">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" id="other-reimbursement-desc-2" value="Borse termiche, casco, ecc.">
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="number" class="form-control" id="other-reimbursement-amount-2" value="75.00" step="0.50">
                                            <span class="input-group-text">€</span>
                                        </div>
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm" id="other-reimbursement-period-2">
                                            <option value="once" selected>Una tantum</option>
                                            <option value="weekly">Settimanale</option>
                                            <option value="monthly">Mensile</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="#" class="action-btn delete-btn" data-bs-toggle="tooltip" title="Elimina">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-sm btn-primary driver-modal-button">
                                <i class="fas fa-plus me-1"></i> Aggiungi rimborso
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Informazioni sui rimborsi -->
                <div class="alert alert-info mt-4 p-3 border-0 d-flex align-items-center">
                    <div class="alert-icon me-3">
                        <span class="icon-circle bg-info-soft driver-text-info">
                            <i class="fas fa-info-circle"></i>
                        </span>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-medium">Note sui rimborsi</h6>
                        <p class="small mb-0">I rimborsi verranno elaborati insieme allo stipendio secondo la frequenza specificata. Per richiedere un rimborso, il driver deve fornire le ricevute fiscali corrispondenti tramite l'app o il portale web.</p>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm driver-btn-outline" id="resetRefundsDefaults">
                                <i class="fas fa-redo me-2"></i>Ripristina valori predefiniti
                            </button>
                            <button type="button" class="btn btn-sm btn-primary ms-2" id="saveRefundsChanges">
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
.icon-circle {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.icon-circle-sm {
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 0.8rem;
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

.driver-section-title {
    font-size: 0.95rem;
    color: #495057;
}

.driver-card-soft {
    background-color: #f8f9fa !important;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.driver-card-soft:hover {
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
}

/* Table customization */
.driver-table th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    font-size: 0.85rem;
    border-top: none;
}

.driver-table td {
    vertical-align: middle;
    padding: 0.5rem;
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

/* Action buttons */
.action-btn {
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: white;
    text-decoration: none;
    transition: all 0.2s ease;
    font-size: 0.8rem;
}

.action-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 3px 6px rgba(0,0,0,0.15);
    color: white;
}

/* Pulsante elimina */
.delete-btn {
    background: linear-gradient(135deg, #f44336 0%, #ff7043 100%);
}

.delete-btn:hover {
    background: linear-gradient(135deg, #e53935 0%, #ff5722 100%);
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestione dinamica del tipo di calcolo del rimborso carburante
    const fuelCalculationType = document.getElementById('fuelCalculationType');
    const fuelReimbursementAmount = document.getElementById('fuelReimbursementAmount');
    const fuelReimbursementUnit = fuelReimbursementAmount.nextElementSibling;
    
    fuelCalculationType.addEventListener('change', function() {
        switch(this.value) {
            case 'km':
                fuelReimbursementUnit.textContent = '€/km';
                fuelReimbursementAmount.value = '0.25';
                document.querySelector('small.form-text').textContent = 'Importo rimborsato per chilometro';
                break;
            case 'percentage':
                fuelReimbursementUnit.textContent = '%';
                fuelReimbursementAmount.value = '12.5';
                document.querySelector('small.form-text').textContent = 'Percentuale sul costo del carburante';
                break;
            case 'fixed':
                fuelReimbursementUnit.textContent = '€';
                fuelReimbursementAmount.value = '50.00';
                document.querySelector('small.form-text').textContent = 'Importo fisso per periodo';
                break;
        }
    });
    
    // Animazione hover sulle righe della tabella
    const tableRows = document.querySelectorAll('.driver-table tbody tr');
    tableRows.forEach(row => {
        row.classList.add('transition-all');
        row.style.transition = 'background-color 0.3s ease';
        row.addEventListener('mouseenter', () => row.style.backgroundColor = 'rgba(255, 90, 95, 0.02)');
        row.addEventListener('mouseleave', () => row.style.backgroundColor = '');
    });
    
    // Gestione del pulsante di reset
    document.getElementById('resetRefundsDefaults')?.addEventListener('click', function() {
        if(confirm('Sei sicuro di voler ripristinare tutti i valori predefiniti?')) {
            // Reset logic would go here
            // For demo purposes, we'll just show a notification
            const notification = document.createElement('div');
            notification.className = 'alert alert-success position-fixed top-0 end-0 m-3';
            notification.innerHTML = '<i class="fas fa-check-circle me-2"></i>Valori predefiniti ripristinati';
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }
    });
    
    // Gestione del pulsante di salvataggio
    document.getElementById('saveRefundsChanges')?.addEventListener('click', function() {
        // Save logic would go here
        // For demo purposes, we'll just show a notification
        const notification = document.createElement('div');
        notification.className = 'alert alert-success position-fixed top-0 end-0 m-3';
        notification.innerHTML = '<i class="fas fa-check-circle me-2"></i>Modifiche salvate con successo';
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 3000);
    });
});
</script>