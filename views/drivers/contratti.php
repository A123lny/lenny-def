<?php 
$pageTitle = 'Contratti Driver';
require_once 'views/layout/header.php';
?>

<div class="section-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="section-title">Gestione Contratti</h2>
        <p class="section-subtitle">Gestisci i contratti e le tariffe dei driver</p>
    </div>
    <div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contractModal">
            <i class="fas fa-plus me-2"></i>Nuovo Contratto
        </button>
    </div>
</div>

<!-- Card Riepilogo -->
<div class="stats-grid mb-4">
    <div class="stat-card stat-card-primary animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-file-contract"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Contratti Attivi</div>
            <div class="stat-value" id="activeContracts">15</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 8.3% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-secondary animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Forfait</div>
            <div class="stat-value" id="forfaitContracts">8</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 12.7% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-1 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-user-clock"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Assunti ad Ore</div>
            <div class="stat-value" id="hourlyContracts">5</div>
            <div class="stat-change negative">
                <i class="fas fa-arrow-down"></i> 3.5% rispetto al mese scorso
            </div>
        </div>
    </div>

    <div class="stat-card stat-card-accent-3 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-user-edit"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Occasionale Ore</div>
            <div class="stat-value" id="occasionalHourlyContracts">3</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 15.2% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-2 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-box"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">A Consegna</div>
            <div class="stat-value" id="deliveryContracts">2</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 5.2% rispetto al mese scorso
            </div>
        </div>
    </div>

    <!-- Nuova card per contratti in scadenza imminente -->
    <div class="stat-card stat-card-danger animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Scadenze Imminenti</div>
            <div class="stat-value" id="imminentExpirations">0</div>
            <div class="stat-change">
                <i class="fas fa-clock"></i> Entro 7 giorni
            </div>
        </div>
    </div>
</div>

<!-- Card Lista Contratti -->
<div class="card border-0 shadow-hover">
    <div class="card-body">
        <!-- Tab navigation -->
        <ul class="nav nav-tabs mb-4" id="contractTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="forfait-list-tab" data-bs-toggle="tab" data-bs-target="#forfait-list" type="button" role="tab">
                    <i class="fas fa-calendar-check me-2"></i>FORFAIT
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="driver-list-tab" data-bs-toggle="tab" data-bs-target="#driver-list" type="button" role="tab">
                    <i class="fas fa-user-clock me-2"></i>DRIVER ASSUNTI
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="delivery-list-tab" data-bs-toggle="tab" data-bs-target="#delivery-list" type="button" role="tab">
                    <i class="fas fa-box me-2"></i>A CONSEGNA
                </button>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content" id="contractTabContent">
            <!-- FORFAIT Table -->
            <div class="tab-pane fade show active" id="forfait-list" role="tabpanel">
                <div class="table-responsive">
                    <table class="table" id="forfaitTable">
                        <thead>
                            <tr>
                                <th>Driver</th>
                                <th>Tipo</th>
                                <th>Giorni/sett</th>
                                <th>Ore/giorno</th>
                                <th>Tariffa aziendale</th>
                                <th>Tariffa mezzo proprio</th>
                                <th>Data inizio</th>
                                <th>Data fine</th>
                                <th>Stato</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-primary text-white">MB</div>
                                        <div>Marco Bianchi</div>
                                    </div>
                                </td>
                                <td><span class="badge bg-success">Fisso</span></td>
                                <td>5</td>
                                <td>8</td>
                                <td>€12/h</td>
                                <td>€14/h</td>
                                <td>01/03/2024</td>
                                <td>31/12/2024</td>
                                <td><span class="badge bg-success">Attivo</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-link text-primary" onclick="viewContract(1)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" onclick="editContract(1)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-danger" onclick="deleteContract(1)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- DRIVER ASSUNTI Table -->
            <div class="tab-pane fade" id="driver-list" role="tabpanel">
                <div class="table-responsive">
                    <table class="table" id="driverTable">
                        <thead>
                            <tr>
                                <th>Driver</th>
                                <th>Tipo</th>
                                <th>Tariffa L-V proprio</th>
                                <th>Tariffa L-V aziendale</th>
                                <th>Tariffa S-D proprio</th>
                                <th>Tariffa S-D aziendale</th>
                                <th>Magg. festivi</th>
                                <th>Data inizio</th>
                                <th>Data fine</th>
                                <th>Stato</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-info text-white">LV</div>
                                        <div>Laura Verdi</div>
                                    </div>
                                </td>
                                <td><span class="badge bg-info">Ad Ore</span></td>
                                <td>€10/h</td>
                                <td>€9/h</td>
                                <td>€12/h</td>
                                <td>€11/h</td>
                                <td>+€2/h</td>
                                <td>15/02/2024</td>
                                <td>-</td>
                                <td><span class="badge bg-success">Attivo</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-link text-primary" onclick="viewContract(2)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" onclick="editContract(2)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-danger" onclick="deleteContract(2)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- A CONSEGNA Table -->
            <div class="tab-pane fade" id="delivery-list" role="tabpanel">
                <div class="table-responsive">
                    <table class="table" id="deliveryTable">
                        <thead>
                            <tr>
                                <th>Driver</th>
                                <th>Tariffa proprio</th>
                                <th>Tariffa aziendale</th>
                                <th>Data inizio</th>
                                <th>Data fine</th>
                                <th>Stato</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-warning text-white">GR</div>
                                        <div>Giuseppe Rossi</div>
                                    </div>
                                </td>
                                <td>€5/consegna</td>
                                <td>€4/consegna</td>
                                <td>10/03/2024</td>
                                <td>10/09/2024</td>
                                <td><span class="badge bg-success">Attivo</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-link text-primary" onclick="viewContract(3)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" onclick="editContract(3)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-danger" onclick="deleteContract(3)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuovo/Modifica Contratto -->
<div class="modal fade" id="contractModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contractModalTitle">Nuovo Contratto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="contractForm">
                    <input type="hidden" id="contractId">
                    
                    <!-- Step 1: Informazioni Base -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Driver</label>
                            <select class="form-select" id="driverSelect" required>
                                <option value="">Seleziona driver...</option>
                                <option value="1">Marco Bianchi</option>
                                <option value="2">Laura Verdi</option>
                                <option value="3">Giuseppe Rossi</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Data Inizio</label>
                            <input type="date" class="form-control" id="startDate" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Data Fine</label>
                            <input type="date" class="form-control" id="endDate">
                        </div>
                    </div>

                    <!-- Tabs per tipo contratto -->
                    <ul class="nav nav-tabs mb-3" id="contractTypeTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="forfait-tab" data-bs-toggle="tab" data-bs-target="#forfaitDetails" type="button" role="tab">
                                <i class="fas fa-calendar-check me-2"></i>FORFAIT
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="driver-tab" data-bs-toggle="tab" data-bs-target="#driverDetails" type="button" role="tab">
                                <i class="fas fa-user-clock me-2"></i>DRIVER ASSUNTI
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#deliveryDetails" type="button" role="tab">
                                <i class="fas fa-box me-2"></i>A CONSEGNA
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="contractTypeContent">
                        <!-- FORFAIT -->
                        <div class="tab-pane fade show active" id="forfaitDetails" role="tabpanel">
                            <h6 class="mb-3">Dettagli Contratto Forfait</h6>
                            
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Numero giorni settimanali lavorativi</label>
                                    <input type="number" class="form-control" id="workingDays" min="1" max="7" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Numero ore giornaliere lavorative</label>
                                    <input type="number" class="form-control" id="workingHours" min="1" max="24" required>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Compenso orario forfait auto aziendale</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="forfaitCompanyRate" step="0.01" required>
                                        <span class="input-group-text">€/h</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Compenso orario forfait mezzo proprio</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="forfaitOwnRate" step="0.01" required>
                                        <span class="input-group-text">€/h</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Maggiorazioni lavorazione festivi</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="forfaitHolidayBonus" step="0.01" required>
                                    <span class="input-group-text">€/h</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipo Forfait</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="forfaitType" id="forfaitOccasionale" value="occasionale" required>
                                    <label class="form-check-label" for="forfaitOccasionale">FORFAIT OCCASIONALE</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="forfaitType" id="forfaitFisso" value="fisso" required>
                                    <label class="form-check-label" for="forfaitFisso">FORFAIT FISSO</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">ALIAS</label>
                                <input type="text" class="form-control" id="forfaitAlias" placeholder="Inserisci un alias per il contratto">
                            </div>
                        </div>

                        <!-- DRIVER ASSUNTI -->
                        <div class="tab-pane fade" id="driverDetails" role="tabpanel">
                            <h6 class="mb-3">Dettagli Contratto Driver Assunti</h6>
                            
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Tariffa auto propria lunedì-venerdì</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="driverOwnCarWeekday" step="0.01" required>
                                        <span class="input-group-text">€/h</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tariffa mezzo aziendale lunedì-venerdì</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="driverCompanyCarWeekday" step="0.01" required>
                                        <span class="input-group-text">€/h</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Tariffa auto propria sabato-domenica</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="driverOwnCarWeekend" step="0.01" required>
                                        <span class="input-group-text">€/h</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tariffa mezzo aziendale sabato-domenica</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="driverCompanyCarWeekend" step="0.01" required>
                                        <span class="input-group-text">€/h</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Maggiorazioni lavorazione festivi</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="driverHolidayBonus" step="0.01" required>
                                    <span class="input-group-text">€/h</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipo Contratto</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="driverType" id="driverOccasionale" value="occasionale" required>
                                    <label class="form-check-label" for="driverOccasionale">ASSUNTO OCCASIONALE</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="driverType" id="driverOre" value="ore" required>
                                    <label class="form-check-label" for="driverOre">ASSUNTO AD ORE</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="driverType" id="driverRimborso" value="rimborso" required>
                                    <label class="form-check-label" for="driverRimborso">DRIVER A RIMBORSO</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">ALIAS</label>
                                <input type="text" class="form-control" id="driverAlias" placeholder="Inserisci un alias per il contratto">
                            </div>
                        </div>

                        <!-- A CONSEGNA -->
                        <div class="tab-pane fade" id="deliveryDetails" role="tabpanel">
                            <h6 class="mb-3">Dettagli Contratto a Consegna</h6>
                            
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Tariffa auto propria</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="deliveryOwnCar" step="0.01" required>
                                        <span class="input-group-text">€/consegna</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tariffa mezzo aziendale</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="deliveryCompanyCar" step="0.01" required>
                                        <span class="input-group-text">€/consegna</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">ALIAS</label>
                                <input type="text" class="form-control" id="deliveryAlias" placeholder="Inserisci un alias per il contratto">
                            </div>
                        </div>
                    </div>

                    <!-- Nel modal, prima della chiusura del form -->
                    <div class="mb-4 border-top pt-3">
                        <h6 class="mb-3">Impostazioni Notifiche</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="enableNotification" checked>
                                    <label class="form-check-label" for="enableNotification">
                                        Abilita notifiche di scadenza
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="notificationDays" min="1" max="90" value="30">
                                    <span class="input-group-text">giorni prima</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-text text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Riceverai una notifica push quando il contratto sarà prossimo alla scadenza.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="saveContract">Salva</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Visualizza Contratto -->
<div class="modal fade" id="viewContractModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dettagli Contratto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="contract-details">
                    <!-- Contenuto dinamico -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Conferma Eliminazione -->
<div class="modal fade" id="deleteContractModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Conferma Eliminazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Sei sicuro di voler eliminare questo contratto?</p>
                <p class="text-danger"><small>Questa azione non può essere annullata.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Elimina</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Stili per la pagina contratti */
.icon-circle {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.bg-primary-light {
    background-color: rgba(13, 110, 253, 0.1);
}

.bg-success-light {
    background-color: rgba(25, 135, 84, 0.1);
}

.bg-info-light {
    background-color: rgba(13, 202, 240, 0.1);
}

.bg-warning-light {
    background-color: rgba(255, 193, 7, 0.1);
}

.avatar-sm {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
}

.table th {
    font-weight: 600;
    background-color: #f8f9fa;
}

.badge {
    padding: 0.5em 0.8em;
    font-weight: 500;
}

/* Stili per i tab */
.nav-tabs .nav-link {
    color: var(--bs-gray-700);
    border: 1px solid transparent;
    margin-bottom: -1px;
    padding: 0.75rem 1.25rem;
    transition: all 0.2s ease;
}

.nav-tabs .nav-link:hover {
    border-color: #e9ecef #e9ecef #dee2e6;
    isolation: isolate;
}

.nav-tabs .nav-link.active {
    color: var(--bs-primary);
    background-color: #fff;
    border-color: #dee2e6 #dee2e6 #fff;
    font-weight: 600;
}

.nav-tabs .nav-link i {
    font-size: 1.1rem;
}

/* Stili per i form inputs */
.input-group-text {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

.form-control:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
}

.form-check-input:checked {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
}

.tab-content {
    padding: 1.5rem;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-top: 0;
    border-radius: 0 0 0.375rem 0.375rem;
}

/* Animazioni */
.modal.fade .modal-dialog {
    transform: scale(0.95);
    transition: transform 0.2s ease-out;
}

.modal.show .modal-dialog {
    transform: scale(1);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.stat-card {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    color: white;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.stat-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.1;
    background-image: url('data:image/svg+xml;utf8,<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"><g fill="white"><circle cx="3" cy="3" r="1"/><circle cx="13" cy="13" r="1"/></g></svg>');
    z-index: 0;
}

.stat-card-primary {
    background: linear-gradient(135deg, #ff5a5f 0%, #ff8f6b 100%);
}

.stat-card-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
}

.stat-card-accent-1 {
    background: linear-gradient(135deg, #36D1DC 0%, #5B86E5 100%);
}

.stat-card-accent-2 {
    background: linear-gradient(135deg, #ffaa00 0%, #ff6a00 100%);
}

.stat-card-accent-3 {
    background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%);
}

.stat-card-danger {
    background: linear-gradient(45deg, #dc3545, #c82333);
}

.pulse-animation {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

.stat-icon {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    width: 48px;
    height: 48px;
    border-radius: var(--border-radius);
    background-color: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stat-content {
    position: relative;
    z-index: 1;
}

.stat-title {
    font-size: var(--font-size-md);
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: rgba(255, 255, 255, 0.8);
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    line-height: 1;
}

.stat-change {
    display: flex;
    align-items: center;
    font-size: var(--font-size-sm);
    color: rgba(255, 255, 255, 0.8);
}

.stat-change i {
    margin-right: 0.25rem;
}

.stat-change.positive {
    color: rgba(255, 255, 255, 0.9);
}

.stat-change.negative {
    color: rgba(255, 255, 255, 0.7);
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-5px);
    }
    100% {
        transform: translateY(0px);
    }
}

/* Stili per il form switch delle notifiche */
.form-switch .form-check-input:checked {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
}
</style>

<script>
$(document).ready(function() {
    // Inizializzazione delle tre DataTable
    const forfaitTable = $('#forfaitTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/it-IT.json'
        },
        pageLength: 10,
        order: [[6, 'desc']], // Ordina per data inizio
        responsive: true
    });

    const driverTable = $('#driverTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/it-IT.json'
        },
        pageLength: 10,
        order: [[7, 'desc']], // Ordina per data inizio
        responsive: true
    });

    const deliveryTable = $('#deliveryTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/it-IT.json'
        },
        pageLength: 10,
        order: [[3, 'desc']], // Ordina per data inizio
        responsive: true
    });

    // Gestione del cambio tab per ricalcolare il layout delle DataTable
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    });

    // Gestione pulsante nuovo contratto
    $('[data-bs-target="#contractModal"]').on('click', function() {
        // Reset form
        $('#contractForm')[0].reset();
        // Reset contract ID
        $('#contractId').val('');
        // Reset titolo modal
        $('#contractModalTitle').text('Nuovo Contratto');
        // Attiva il primo tab
        $('#contractTypeTabs button:first').tab('show');
    });

    // Gestione salvataggio
    $('#saveContract').on('click', function() {
        if (!$('#contractForm')[0].checkValidity()) {
            $('#contractForm')[0].reportValidity();
            return;
        }
        
        // Raccogli i dati del form in base al tipo di contratto selezionato
        const activeTab = $('.tab-pane.active').attr('id');
        let contractType;
        switch(activeTab) {
            case 'forfaitDetails':
                contractType = 'forfait';
                break;
            case 'driverDetails':
                contractType = 'driver';
                break;
            case 'deliveryDetails':
                contractType = 'delivery';
                break;
        }

        let contractData = {
            driver: $('#driverSelect').val(),
            startDate: $('#startDate').val(),
            endDate: $('#endDate').val(),
            type: contractType
        };

        if (!contractData.driver || !contractData.startDate) {
            alert('Compila tutti i campi obbligatori');
            return;
        }
        
        // Aggiungi i dati specifici in base al tipo
        switch(contractType) {
            case 'forfait':
                const forfaitType = $('input[name="forfaitType"]:checked').val();
                if (!forfaitType) {
                    alert('Seleziona il tipo di forfait');
                    return;
                }
                contractData = {
                    ...contractData,
                    workingDays: $('#workingDays').val(),
                    workingHours: $('#workingHours').val(),
                    forfaitCompanyRate: $('#forfaitCompanyRate').val(),
                    forfaitOwnRate: $('#forfaitOwnRate').val(),
                    holidayBonus: $('#forfaitHolidayBonus').val(),
                    forfaitType: forfaitType,
                    alias: $('#forfaitAlias').val()
                };
                break;
                
            case 'driver':
                const driverType = $('input[name="driverType"]:checked').val();
                if (!driverType) {
                    alert('Seleziona il tipo di contratto driver');
                    return;
                }
                contractData = {
                    ...contractData,
                    ownCarWeekday: $('#driverOwnCarWeekday').val(),
                    companyCarWeekday: $('#driverCompanyCarWeekday').val(),
                    ownCarWeekend: $('#driverOwnCarWeekend').val(),
                    companyCarWeekend: $('#driverCompanyCarWeekend').val(),
                    holidayBonus: $('#driverHolidayBonus').val(),
                    driverType: driverType,
                    alias: $('#driverAlias').val()
                };
                break;
                
            case 'delivery':
                contractData = {
                    ...contractData,
                    deliveryRate: $('#deliveryRate').val(),
                    ownCar: $('#deliveryOwnCar').val(),
                    companyCar: $('#deliveryCompanyCar').val(),
                    alias: $('#deliveryAlias').val()
                };
                break;
        }
        
        // Qui andrà la logica per salvare i dati nel database
        console.log('Dati del contratto da salvare:', contractData);
        
        // Aggiungi una nuova riga alla tabella
        const newRow = createTableRow(contractData);
        contractsTable.row.add(newRow).draw();
        
        // Chiudi il modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('contractModal'));
        modal.hide();
        
        // Mostra un messaggio di successo
        showNotification('success', 'Contratto salvato con successo!');
    });

    // Gestione filtri
    $('#searchContract').on('keyup', function() {
        contractsTable.search(this.value).draw();
    });

    $('#contractTypeFilter, #vehicleTypeFilter').on('change', function() {
        contractsTable.draw();
    });

    // Controlla le scadenze imminenti
    checkImminentExpirations();
    setInterval(checkImminentExpirations, 3600000); // Controlla ogni ora
    
    // Richiedi il permesso per le notifiche push
    requestNotificationPermission();
});

// Funzione per aggiornare il form delle tariffe in base al tipo di contratto
function updateTariffeForm(contractType) {
    const container = $('#tariffeContainer');
    container.empty();

    switch(contractType) {
        case 'ore_assunto':
        case 'ore_occasionale':
            container.html(`
                <div class="tariffe-grid ore">
                    <div class="tariffa-card">
                        <h6>Lunedì - Venerdì</h6>
                        <div class="mb-3">
                            <label class="form-label">Mezzo Proprio</label>
                            <div class="input-group">
                                <input type="number" class="form-control" value="12" min="0" step="0.5" required>
                                <span class="input-group-text">€/h</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mezzo Aziendale</label>
                            <div class="input-group">
                                <input type="number" class="form-control" value="10" min="0" step="0.5" required>
                                <span class="input-group-text">€/h</span>
                            </div>
                        </div>
                    </div>
                    <div class="tariffa-card">
                        <h6>Sabato - Domenica</h6>
                        <div class="mb-3">
                            <label class="form-label">Mezzo Proprio</label>
                            <div class="input-group">
                                <input type="number" class="form-control" value="16" min="0" step="0.5" required>
                                <span class="input-group-text">€/h</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mezzo Aziendale</label>
                            <div class="input-group">
                                <input type="number" class="form-control" value="12" min="0" step="0.5" required>
                                <span class="input-group-text">€/h</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tariffa-card mt-3">
                    <h6>Festivi</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mezzo Proprio</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" value="16" min="0" step="0.5" required>
                                    <span class="input-group-text">€/h</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mezzo Aziendale</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" value="12" min="0" step="0.5" required>
                                    <span class="input-group-text">€/h</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
            break;

        case 'forfait_assunto':
        case 'forfait_occasionale':
            container.html(`
                <div class="tariffa-card">
                    <h6>Tariffa Base</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tariffa Oraria Base</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" value="12" min="0" step="0.5" required>
                                    <span class="input-group-text">€/h</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tariffa-card mt-3">
                    <h6>Maggiorazione Festivi</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mezzo Proprio</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" value="2" min="0" step="0.5" required>
                                    <span class="input-group-text">€/h</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mezzo Aziendale</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" value="2" min="0" step="0.5" required>
                                    <span class="input-group-text">€/h</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
            break;

        case 'consegna':
            container.html(`
                <div class="tariffa-card">
                    <h6>Tariffa per Consegna</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tariffa Base per Consegna</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" value="5" min="0" step="0.5" required>
                                    <span class="input-group-text">€/consegna</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
            break;
    }
}

// Funzione per visualizzare i dettagli del contratto
function viewContract(contractId) {
    // Simulazione caricamento dati
    const contractData = {
        1: {
            driver: 'Marco Bianchi',
            type: 'Forfait Assunto',
            vehicle: 'Proprio',
            baseRate: '12€/h',
            startDate: '01/03/2024',
            status: 'Attivo',
            details: {
                weekdayRate: '12€/h',
                weekendRate: '16€/h',
                holidayBonus: '+2€/h'
            }
        },
        // ... altri contratti
    };

    const data = contractData[contractId];
    const modal = new bootstrap.Modal(document.getElementById('viewContractModal'));
    
    $('.contract-details').html(`
        <div class="row">
            <div class="col-md-6">
                <h6 class="mb-3">Informazioni Base</h6>
                <table class="table table-sm">
                    <tr>
                        <td><strong>Driver</strong></td>
                        <td>${data.driver}</td>
                    </tr>
                    <tr>
                        <td><strong>Tipo Contratto</strong></td>
                        <td>${data.type}</td>
                    </tr>
                    <tr>
                        <td><strong>Mezzo</strong></td>
                        <td>${data.vehicle}</td>
                    </tr>
                    <tr>
                        <td><strong>Data Inizio</strong></td>
                        <td>${data.startDate}</td>
                    </tr>
                    <tr>
                        <td><strong>Stato</strong></td>
                        <td><span class="badge bg-success">${data.status}</span></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="mb-3">Tariffe</h6>
                <table class="table table-sm">
                    <tr>
                        <td><strong>Tariffa Base</strong></td>
                        <td>${data.baseRate}</td>
                    </tr>
                    <tr>
                        <td><strong>Lun-Ven</strong></td>
                        <td>${data.details.weekdayRate}</td>
                    </tr>
                    <tr>
                        <td><strong>Sab-Dom</strong></td>
                        <td>${data.details.weekendRate}</td>
                    </tr>
                    <tr>
                        <td><strong>Maggiorazione Festivi</strong></td>
                        <td>${data.details.holidayBonus}</td>
                    </tr>
                </table>
            </div>
        </div>
    `);
    
    modal.show();
}

// Funzione per modificare un contratto
function editContract(contractId) {
    const modal = new bootstrap.Modal(document.getElementById('contractModal'));
    $('#contractModalTitle').text('Modifica Contratto');
    $('#contractId').val(contractId);
    
    // Simulazione caricamento dati
    $('#driverSelect').val(1);
    $('#contractType').val('forfait_assunto').trigger('change');
    $('#vehicleType').val('proprio');
    $('#startDate').val('2024-03-01');
    
    modal.show();
}

// Funzione per eliminare un contratto
function deleteContract(contractId) {
    const modal = new bootstrap.Modal(document.getElementById('deleteContractModal'));
    
    $('#confirmDelete').off('click').on('click', function() {
        // Simulazione eliminazione
        $(`button[onclick="deleteContract(${contractId})"]`).closest('tr').fadeOut(300, function() {
            $(this).remove();
            modal.hide();
            // Aggiorna la DataTable
            $('#contractsTable').DataTable().draw();
        });
    });
    
    modal.show();
}

// Funzione per creare una nuova riga nella tabella
function createTableRow(contractData) {
    const driverInitials = contractData.driver === '1' ? 'MB' : 
                          contractData.driver === '2' ? 'LV' : 'GR';
    const driverName = contractData.driver === '1' ? 'Marco Bianchi' : 
                      contractData.driver === '2' ? 'Laura Verdi' : 'Giuseppe Rossi';
    
    let badgeClass, contractTypeText;
    switch(contractData.type) {
        case 'forfait':
            badgeClass = 'bg-success';
            contractTypeText = contractData.forfaitType === 'occasionale' ? 'Forfait Occasionale' : 'Forfait Fisso';
            break;
        case 'driver':
            badgeClass = 'bg-info';
            contractTypeText = contractData.driverType === 'occasionale' ? 'Driver Occasionale' : 
                             contractData.driverType === 'ore' ? 'Driver ad Ore' : 'Driver a Rimborso';
            break;
        case 'delivery':
            badgeClass = 'bg-warning';
            contractTypeText = 'A Consegna';
            break;
    }

    const baseRate = contractData.type === 'delivery' ? 
        `€${contractData.deliveryRate}/consegna` : 
        `€${contractData.type === 'forfait' ? contractData.hourlyRate : contractData.hourlyRate}/h`;

    return [
        `<div class="d-flex align-items-center">
            <div class="avatar-sm me-2 bg-primary text-white">${driverInitials}</div>
            <div>${driverName}</div>
        </div>`,
        `<span class="badge ${badgeClass}">${contractTypeText}</span>`,
        contractData.type === 'delivery' ? '-' : 'Proprio/Aziendale',
        baseRate,
        formatDate(contractData.startDate),
        '<span class="badge bg-success">Attivo</span>',
        `<button class="btn btn-sm btn-link text-primary" onclick="viewContract(1)">
            <i class="fas fa-eye"></i>
        </button>
        <button class="btn btn-sm btn-link text-secondary" onclick="editContract(1)">
            <i class="fas fa-edit"></i>
        </button>
        <button class="btn btn-sm btn-link text-danger" onclick="deleteContract(1)">
            <i class="fas fa-trash"></i>
        </button>`
    ];
}

// Funzione per formattare la data
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('it-IT', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}

// Funzione per mostrare le notifiche
function showNotification(type, message) {
    // Implementa qui il tuo sistema di notifiche
    // Per ora usiamo un semplice alert
    alert(message);
}

// Funzione per controllare le scadenze imminenti
function checkImminentExpirations() {
    const today = new Date();
    let imminentCount = 0;
    const IMMINENT_DAYS = 7;
    
    function checkTableForImminent(tableId) {
        const table = $(`#${tableId}`).DataTable();
        const data = table.rows().data();
        
        data.each(function(row) {
            const endDateIndex = tableId === 'forfaitTable' ? 7 : 
                               tableId === 'driverTable' ? 8 : 4;
            
            const endDateStr = row[endDateIndex];
            if (endDateStr && endDateStr !== '-') {
                const endDate = parseDate(endDateStr);
                const daysUntilExpiry = Math.ceil((endDate - today) / (1000 * 60 * 60 * 24));
                
                if (daysUntilExpiry <= IMMINENT_DAYS && daysUntilExpiry > 0) {
                    imminentCount++;
                }
            }
        });
    }
    
    // Controlla tutte le tabelle
    checkTableForImminent('forfaitTable');
    checkTableForImminent('driverTable');
    checkTableForImminent('deliveryTable');
    
    // Aggiorna il contatore nella card
    $('#imminentExpirations').text(imminentCount);
    
    // Aggiungi classe di evidenziazione se ci sono scadenze imminenti
    const cardElement = $('#imminentExpirations').closest('.stat-card');
    if (imminentCount > 0) {
        cardElement.addClass('pulse-animation');
    } else {
        cardElement.removeClass('pulse-animation');
    }
}

// Funzione per gestire le notifiche push
function requestNotificationPermission() {
    if ('Notification' in window) {
        Notification.requestPermission().then(function(permission) {
            if (permission === 'granted') {
                console.log('Notifiche push abilitate');
            }
        });
    }
}

// Funzione per inviare una notifica push
function sendContractNotification(driverName, daysLeft, contractType) {
    if ('Notification' in window && Notification.permission === 'granted') {
        new Notification('Contratto in Scadenza', {
            body: `Il contratto ${contractType} di ${driverName} scadrà tra ${daysLeft} giorni`,
            icon: '/path/to/your/icon.png',
            tag: 'contract-expiration'
        });
    }
}

// Funzione helper per parsare le date nel formato italiano
function parseDate(dateStr) {
    const [day, month, year] = dateStr.split('/');
    return new Date(year, month - 1, day);
}
</script>

<?php require_once 'views/layout/footer.php'; ?>