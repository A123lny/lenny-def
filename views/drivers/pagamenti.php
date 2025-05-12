<?php 
$pageTitle = 'Pagamenti Driver';
require_once 'views/layout/header.php';
?>

<div class="section-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="section-title">Gestione Pagamenti</h2>
        <p class="section-subtitle">Calcola e gestisci i pagamenti dei driver in base al tipo di contratto</p>
    </div>
    <div>
        <button class="btn btn-primary" id="calculatePaymentsBtn">
            <i class="fas fa-calculator me-2"></i>Calcola Pagamenti
        </button>
        <button class="btn btn-outline-primary ms-2" id="exportPaymentsBtn">
            <i class="fas fa-file-export me-2"></i>Esporta Report
        </button>
    </div>
</div>

<!-- Card Riepilogo -->
<div class="stats-grid mb-4">
    <div class="stat-card stat-card-primary animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Pagamenti Totali</div>
            <div class="stat-value" id="totalPayments">€5,482.50</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 4.3% rispetto al mese scorso
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
            <div class="stat-value" id="forfaitPayments">€2,680.00</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 5.7% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-1 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-user-clock"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Pagamenti Orari</div>
            <div class="stat-value" id="hourlyPayments">€2,142.50</div>
            <div class="stat-change negative">
                <i class="fas fa-arrow-down"></i> 2.1% rispetto al mese scorso
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
            <div class="stat-value" id="deliveryPayments">€660.00</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 8.2% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-3 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Pagamenti Festivi</div>
            <div class="stat-value" id="holidayPayments">€385.00</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 12.5% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-danger animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Pagamenti In Attesa</div>
            <div class="stat-value" id="pendingPayments">3</div>
            <div class="stat-change">
                <i class="fas fa-clock"></i> Scadenza entro 3 giorni
            </div>
        </div>
    </div>
</div>

<!-- Form Filtri e Calcolo -->
<div class="card border-0 shadow-hover mb-4">
    <div class="card-body">
        <h5 class="card-title mb-3">Filtri e Periodo di Calcolo</h5>
        <form id="paymentFilterForm">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Periodo di Calcolo</label>
                    <select class="form-select" id="periodSelect">
                        <option value="current-month">Mese Corrente (Maggio 2025)</option>
                        <option value="previous-month">Mese Precedente (Aprile 2025)</option>
                        <option value="custom">Periodo Personalizzato</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Data Inizio</label>
                    <input type="date" class="form-control" id="startDateFilter" value="2025-05-01">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Data Fine</label>
                    <input type="date" class="form-control" id="endDateFilter" value="2025-05-31">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Filtro Driver</label>
                    <select class="form-select" id="driverFilter">
                        <option value="all">Tutti i Driver</option>
                        <option value="1">Marco Bianchi</option>
                        <option value="2">Laura Verdi</option>
                        <option value="3">Giuseppe Rossi</option>
                    </select>
                </div>
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="includeHolidays" checked>
                        <label class="form-check-label" for="includeHolidays">
                            Applica maggiorazioni per festività
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-2"></i>Applica Filtri
                    </button>
                    <button type="reset" class="btn btn-outline-secondary ms-2">
                        <i class="fas fa-undo me-2"></i>Reimposta
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Card Lista Pagamenti -->
<div class="card border-0 shadow-hover">
    <div class="card-body">
        <!-- Tab navigation -->
        <ul class="nav nav-tabs mb-4" id="paymentTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-payments-tab" data-bs-toggle="tab" data-bs-target="#all-payments" type="button" role="tab">
                    <i class="fas fa-list-ul me-2"></i>TUTTI I PAGAMENTI
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="forfait-payments-tab" data-bs-toggle="tab" data-bs-target="#forfait-payments" type="button" role="tab">
                    <i class="fas fa-calendar-check me-2"></i>FORFAIT
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="hourly-payments-tab" data-bs-toggle="tab" data-bs-target="#hourly-payments" type="button" role="tab">
                    <i class="fas fa-user-clock me-2"></i>PAGAMENTI ORARI
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="delivery-payments-tab" data-bs-toggle="tab" data-bs-target="#delivery-payments" type="button" role="tab">
                    <i class="fas fa-box me-2"></i>A CONSEGNA
                </button>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content" id="paymentTabContent">
            <!-- TUTTI I PAGAMENTI Table -->
            <div class="tab-pane fade show active" id="all-payments" role="tabpanel">
                <div class="table-responsive">
                    <table class="table" id="allPaymentsTable">
                        <thead>
                            <tr>
                                <th>Driver</th>
                                <th>Tipo Contratto</th>
                                <th>Periodo</th>
                                <th>Ore/Consegne</th>
                                <th>Mezzo</th>
                                <th>Base</th>
                                <th>Maggiorazioni</th>
                                <th>Totale</th>
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
                                <td><span class="badge bg-success">Forfait Fisso</span></td>
                                <td>01/05/2025 - 15/05/2025</td>
                                <td>80 ore</td>
                                <td>Proprio</td>
                                <td>€1,120.00</td>
                                <td>€56.00</td>
                                <td>€1,176.00</td>
                                <td><span class="badge bg-warning">In Attesa</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-link text-primary" onclick="viewPayment(1)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-success" onclick="processPayment(1)">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" onclick="editPayment(1)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-info text-white">LV</div>
                                        <div>Laura Verdi</div>
                                    </div>
                                </td>
                                <td><span class="badge bg-info">Ad Ore</span></td>
                                <td>01/05/2025 - 15/05/2025</td>
                                <td>68 ore</td>
                                <td>Aziendale</td>
                                <td>€612.00</td>
                                <td>€96.00</td>
                                <td>€708.00</td>
                                <td><span class="badge bg-warning">In Attesa</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-link text-primary" onclick="viewPayment(2)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-success" onclick="processPayment(2)">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" onclick="editPayment(2)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-warning text-white">GR</div>
                                        <div>Giuseppe Rossi</div>
                                    </div>
                                </td>
                                <td><span class="badge bg-warning">A Consegna</span></td>
                                <td>01/05/2025 - 15/05/2025</td>
                                <td>132 consegne</td>
                                <td>Proprio</td>
                                <td>€660.00</td>
                                <td>€0.00</td>
                                <td>€660.00</td>
                                <td><span class="badge bg-warning">In Attesa</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-link text-primary" onclick="viewPayment(3)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-success" onclick="processPayment(3)">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" onclick="editPayment(3)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-primary text-white">MB</div>
                                        <div>Marco Bianchi</div>
                                    </div>
                                </td>
                                <td><span class="badge bg-success">Forfait Fisso</span></td>
                                <td>15/04/2025 - 30/04/2025</td>
                                <td>96 ore</td>
                                <td>Proprio</td>
                                <td>€1,344.00</td>
                                <td>€160.00</td>
                                <td>€1,504.00</td>
                                <td><span class="badge bg-success">Pagato</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-link text-primary" onclick="viewPayment(4)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" disabled>
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" disabled>
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-info text-white">LV</div>
                                        <div>Laura Verdi</div>
                                    </div>
                                </td>
                                <td><span class="badge bg-info">Ad Ore</span></td>
                                <td>15/04/2025 - 30/04/2025</td>
                                <td>87 ore</td>
                                <td>Aziendale</td>
                                <td>€783.00</td>
                                <td>€66.00</td>
                                <td>€849.00</td>
                                <td><span class="badge bg-success">Pagato</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-link text-primary" onclick="viewPayment(5)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" disabled>
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" disabled>
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- FORFAIT Table -->
            <div class="tab-pane fade" id="forfait-payments" role="tabpanel">
                <div class="table-responsive">
                    <table class="table" id="forfaitPaymentsTable">
                        <thead>
                            <tr>
                                <th>Driver</th>
                                <th>Tipo Forfait</th>
                                <th>Periodo</th>
                                <th>Giorni</th>
                                <th>Ore/Giorno</th>
                                <th>Totale Ore</th>
                                <th>Mezzo</th>
                                <th>Tariffa Base</th>
                                <th>Maggiorazioni Festivi</th>
                                <th>Importo Totale</th>
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
                                <td>01/05/2025 - 15/05/2025</td>
                                <td>10</td>
                                <td>8</td>
                                <td>80</td>
                                <td>Proprio (€14/h)</td>
                                <td>€1,120.00</td>
                                <td>€56.00 (4h × €14/h × +100%)</td>
                                <td>€1,176.00</td>
                                <td><span class="badge bg-warning">In Attesa</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-link text-primary" onclick="viewPayment(1)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-success" onclick="processPayment(1)">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" onclick="editPayment(1)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-primary text-white">MB</div>
                                        <div>Marco Bianchi</div>
                                    </div>
                                </td>
                                <td><span class="badge bg-success">Fisso</span></td>
                                <td>15/04/2025 - 30/04/2025</td>
                                <td>12</td>
                                <td>8</td>
                                <td>96</td>
                                <td>Proprio (€14/h)</td>
                                <td>€1,344.00</td>
                                <td>€160.00 (8h × €20/h)</td>
                                <td>€1,504.00</td>
                                <td><span class="badge bg-success">Pagato</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-link text-primary" onclick="viewPayment(4)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" disabled>
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" disabled>
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PAGAMENTI ORARI Table -->
            <div class="tab-pane fade" id="hourly-payments" role="tabpanel">
                <div class="table-responsive">
                    <table class="table" id="hourlyPaymentsTable">
                        <thead>
                            <tr>
                                <th>Driver</th>
                                <th>Tipo</th>
                                <th>Periodo</th>
                                <th>Ore L-V</th>
                                <th>Tariffa L-V</th>
                                <th>Ore S-D</th>
                                <th>Tariffa S-D</th>
                                <th>Ore Festivi</th>
                                <th>Maggiorazione</th>
                                <th>Mezzo</th>
                                <th>Totale</th>
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
                                <td>01/05/2025 - 15/05/2025</td>
                                <td>52</td>
                                <td>€9/h</td>
                                <td>16</td>
                                <td>€11/h</td>
                                <td>0</td>
                                <td>€0.00</td>
                                <td>Aziendale</td>
                                <td>€708.00</td>
                                <td><span class="badge bg-warning">In Attesa</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-link text-primary" onclick="viewPayment(2)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-success" onclick="processPayment(2)">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" onclick="editPayment(2)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-info text-white">LV</div>
                                        <div>Laura Verdi</div>
                                    </div>
                                </td>
                                <td><span class="badge bg-info">Ad Ore</span></td>
                                <td>15/04/2025 - 30/04/2025</td>
                                <td>63</td>
                                <td>€9/h</td>
                                <td>16</td>
                                <td>€11/h</td>
                                <td>8</td>
                                <td>€66.00</td>
                                <td>Aziendale</td>
                                <td>€849.00</td>
                                <td><span class="badge bg-success">Pagato</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-link text-primary" onclick="viewPayment(5)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" disabled>
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" disabled>
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- A CONSEGNA Table -->
            <div class="tab-pane fade" id="delivery-payments" role="tabpanel">
                <div class="table-responsive">
                    <table class="table" id="deliveryPaymentsTable">
                        <thead>
                            <tr>
                                <th>Driver</th>
                                <th>Periodo</th>
                                <th>Numero Consegne</th>
                                <th>Mezzo</th>
                                <th>Tariffa Consegna</th>
                                <th>Totale</th>
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
                                <td>01/05/2025 - 15/05/2025</td>
                                <td>132</td>
                                <td>Proprio</td>
                                <td>€5.00</td>
                                <td>€660.00</td>
                                <td><span class="badge bg-warning">In Attesa</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-link text-primary" onclick="viewPayment(3)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-success" onclick="processPayment(3)">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-secondary" onclick="editPayment(3)">
                                            <i class="fas fa-edit"></i>
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

<!-- Modal Dettagli Pagamento -->
<div class="modal fade" id="viewPaymentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dettagli Pagamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="payment-details">
                    <!-- Contenuto dinamico -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                <button type="button" class="btn btn-primary" id="printPayment">
                    <i class="fas fa-print me-2"></i>Stampa
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Modifica Pagamento -->
<div class="modal fade" id="editPaymentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica Pagamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editPaymentForm">
                    <div id="editPaymentContent">
                        <!-- Contenuto dinamico in base al tipo di contratto -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="savePaymentChanges">Salva Modifiche</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Calcolo Pagamenti -->
<div class="modal fade" id="calculateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Calcolo Pagamenti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    Seleziona il periodo e i driver per calcolare i pagamenti.
                </div>
                
                <form id="calculatePaymentsForm">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Periodo</label>
                            <select class="form-select" id="calcPeriodSelect">
                                <option value="first-half">Prima Metà del Mese (1-15)</option>
                                <option value="second-half">Seconda Metà del Mese (16-31)</option>
                                <option value="full-month">Mese Intero</option>
                                <option value="custom">Personalizzato</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mese/Anno</label>
                            <input type="month" class="form-control" id="calcMonth" value="2025-05">
                        </div>
                    </div>
                    
                    <div class="row g-3 mb-3" id="customDateRange" style="display: none;">
                        <div class="col-md-6">
                            <label class="form-label">Data Inizio</label>
                            <input type="date" class="form-control" id="calcStartDate">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Data Fine</label>
                            <input type="date" class="form-control" id="calcEndDate">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Driver</label>
                        <div class="driver-select-options">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAllDrivers" checked>
                                <label class="form-check-label fw-bold" for="selectAllDrivers">
                                    Seleziona tutti
                                </label>
                            </div>
                            <hr class="my-2">
                            <div class="form-check">
                                <input class="form-check-input driver-checkbox" type="checkbox" id="driver1" checked>
                                <label class="form-check-label" for="driver1">
                                    Marco Bianchi (Forfait Fisso)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input driver-checkbox" type="checkbox" id="driver2" checked>
                                <label class="form-check-label" for="driver2">
                                    Laura Verdi (Ad Ore)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input driver-checkbox" type="checkbox" id="driver3" checked>
                                <label class="form-check-label" for="driver3">
                                    Giuseppe Rossi (A Consegna)
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="calcIncludeHolidays" checked>
                        <label class="form-check-label" for="calcIncludeHolidays">
                            Applica maggiorazioni per festività
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="startCalculation">
                    <i class="fas fa-calculator me-2"></i>Calcola
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Conferma Pagamento -->
<div class="modal fade" id="confirmPaymentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Conferma Pagamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Sei sicuro di voler processare questo pagamento?</p>
                <p>Importo: <strong id="confirmAmount">€0.00</strong></p>
                <p>Driver: <strong id="confirmDriver">-</strong></p>
                <div class="mb-3">
                    <label class="form-label">Metodo di pagamento</label>
                    <select class="form-select" id="paymentMethod">
                        <option value="bank">Bonifico Bancario</option>
                        <option value="cash">Contanti</option>
                        <option value="check">Assegno</option>
                        <option value="other">Altro</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea class="form-control" id="paymentNote" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-success" id="confirmPayment">Conferma Pagamento</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Stili aggiuntivi per la pagina pagamenti */
.driver-select-options {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    padding: 0.75rem;
    margin-top: 0.5rem;
}

.payment-card {
    border: 1px solid #e9ecef;
    border-radius: 0.5rem;
    padding: 1.25rem;
    margin-bottom: 1.5rem;
    background-color: #f8f9fa;
}

.payment-card h6 {
    margin-bottom: 1rem;
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 0.75rem;
}

.payment-detail-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
}

.payment-detail-row strong {
    color: #495057;
}

.payment-detail-row.total {
    border-top: 1px solid #dee2e6;
    padding-top: 0.75rem;
    margin-top: 0.75rem;
    font-weight: bold;
}

.payment-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.25rem 0.5rem;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 600;
}

.payment-summary {
    background-color: #e9ecef;
    border-radius: 0.5rem;
    padding: 1rem;
    margin-bottom: 1rem;
}

/* Stili per le notifiche toast */
.toast-notification {
    animation: slideIn 0.3s ease-in-out;
    margin-bottom: 10px;
    font-family: inherit;
}

.toast-icon {
    margin-right: 10px;
    font-size: 1.2rem;
}

.toast-content {
    flex: 1;
}

.toast-close {
    background: none;
    border: none;
    color: white;
    font-size: 1.5rem;
    cursor: pointer;
    padding: 0 0 0 10px;
    opacity: 0.7;
}

.toast-close:hover {
    opacity: 1;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
</style>

<script>
// Verifica che jQuery e DataTables siano caricati correttamente
document.addEventListener('DOMContentLoaded', function() {
    // Controlliamo che jQuery sia disponibile
    if (typeof jQuery === 'undefined') {
        console.error('jQuery non è caricato. Caricamento dinamico...');
        // Carica jQuery dinamicamente se non disponibile
        var jqScript = document.createElement('script');
        jqScript.src = 'https://code.jquery.com/jquery-3.7.1.min.js';
        jqScript.onload = initializeDataTables;
        document.head.appendChild(jqScript);
    } else if (typeof $.fn.DataTable === 'undefined') {
        console.error('DataTables non è caricato. Caricamento dinamico...');
        // Carica DataTables dinamicamente se non disponibile
        var dtScript = document.createElement('script');
        dtScript.src = 'https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js';
        dtScript.onload = function() {
            var bsScript = document.createElement('script');
            bsScript.src = 'https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js';
            bsScript.onload = initializeDataTables;
            document.head.appendChild(bsScript);
        };
        document.head.appendChild(dtScript);
    } else {
        // Se entrambi sono disponibili, inizializza subito
        initializeDataTables();
    }

    // Gestione click pulsante con supporto Promise per garantire che il modal sia inizializzato
    $('#calculatePaymentsBtn').on('click', function(e) {
        e.preventDefault();
        openCalculateModal().then(() => {
            console.log('Modal aperto con successo');
        }).catch(err => {
            console.error('Errore nell\'apertura del modal:', err);
            alert('Avvio calcolo pagamenti...');
            window.location.href = window.location.pathname + '?action=calculate';
        });
    });

    // Funzione per aprire il modal usando Promise per migliore gestione degli errori
    function openCalculateModal() {
        return new Promise((resolve, reject) => {
            try {
                // Assicuriamoci che il modal esista nel DOM
                const calculateModalEl = document.getElementById('calculateModal');
                if (!calculateModalEl) {
                    return reject(new Error('Modal non trovato nel DOM'));
                }

                // Sistema di fallback multi-livello per aprire il modal
                if (typeof bootstrap !== 'undefined' && typeof bootstrap.Modal === 'function') {
                    // Bootstrap 5
                    const modal = new bootstrap.Modal(calculateModalEl);
                    modal.show();
                    resolve('bootstrap5');
                } else if (typeof $ !== 'undefined' && typeof $.fn.modal === 'function') {
                    // jQuery modal (Bootstrap 4)
                    $('#calculateModal').modal('show');
                    resolve('jquery');
                } else {
                    // Apertura manuale
                    calculateModalEl.style.display = 'block';
                    calculateModalEl.classList.add('show');
                    document.body.classList.add('modal-open');
                    
                    // Crea backdrop manuale
                    const backdrop = document.createElement('div');
                    backdrop.className = 'modal-backdrop fade show';
                    document.body.appendChild(backdrop);
                    resolve('manual');
                }
                
                // Inizializza comunque i valori predefiniti nel modal
                const currentDate = new Date();
                const currentYear = currentDate.getFullYear();
                const currentMonth = (currentDate.getMonth() + 1).toString().padStart(2, '0');
                
                // Imposta il mese/anno corrente
                $('#calcMonth').val(`${currentYear}-${currentMonth}`);
                
                // Imposta date personalizzate
                const firstDay = `${currentYear}-${currentMonth}-01`;
                const lastDay = new Date(currentYear, currentDate.getMonth() + 1, 0)
                                .toISOString().split('T')[0]; // Ultimo giorno del mese
                
                $('#calcStartDate').val(firstDay);
                $('#calcEndDate').val(lastDay);
                
                // Checkbox
                $('#selectAllDrivers').prop('checked', true);
                $('.driver-checkbox').prop('checked', true);
            } catch (error) {
                reject(error);
            }
        });
    }

    // Funzione principale di inizializzazione di DataTables
    function initializeDataTables() {
        console.log('Inizializzazione DataTables...');
        
        try {
            if ($.fn.DataTable) {
                // Inizializzazione tabelle con gestione degli errori
                try {
                    if ($('#allPaymentsTable').length) {
                        $('#allPaymentsTable').DataTable({
                            language: {
                                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/it-IT.json'
                            },
                            pageLength: 10,
                            order: [[2, 'desc']], // Ordina per periodo (data)
                            responsive: true
                        });
                    }
                    
                    if ($('#forfaitPaymentsTable').length) {
                        $('#forfaitPaymentsTable').DataTable({
                            language: {
                                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/it-IT.json'
                            },
                            pageLength: 10,
                            order: [[2, 'desc']], // Ordina per periodo (data)
                            responsive: true
                        });
                    }
                    
                    if ($('#hourlyPaymentsTable').length) {
                        $('#hourlyPaymentsTable').DataTable({
                            language: {
                                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/it-IT.json'
                            },
                            pageLength: 10,
                            order: [[2, 'desc']], // Ordina per periodo (data)
                            responsive: true
                        });
                    }
                    
                    if ($('#deliveryPaymentsTable').length) {
                        $('#deliveryPaymentsTable').DataTable({
                            language: {
                                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/it-IT.json'
                            },
                            pageLength: 10,
                            order: [[1, 'desc']], // Ordina per periodo (data)
                            responsive: true
                        });
                    }
                    
                    console.log('DataTables inizializzato con successo');
                } catch (dtError) {
                    console.error('Errore nell\'inizializzazione di DataTables:', dtError);
                }
                
                // Gestione cambio tab per ricalcolare il layout delle DataTable
                $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
                });
                
                setupOtherFunctionality();
            } else {
                console.error('DataTable non è una funzione, libreria non caricata correttamente');
            }
        } catch (error) {
            console.error('Errore durante l\'inizializzazione:', error);
        }
    }

    // Altre funzionalità che non dipendono da DataTables
    function setupOtherFunctionality() {
        // Gestione form di filtro
        $('#paymentFilterForm').on('submit', function(e) {
            e.preventDefault();
            
            const startDate = $('#startDateFilter').val();
            const endDate = $('#endDateFilter').val();
            const driver = $('#driverFilter').val();
            const includeHolidays = $('#includeHolidays').is(':checked');
            
            // Qui in una applicazione reale farei una chiamata AJAX per filtrare i dati
            // Per la demo, fingiamo di filtrare i dati
            simulateFilter(startDate, endDate, driver, includeHolidays);
        });

        // Gestione del periodo di filtro
        $('#periodSelect').on('change', function() {
            const period = $(this).val();
            
            if (period === 'current-month') {
                $('#startDateFilter').val('2025-05-01');
                $('#endDateFilter').val('2025-05-31');
            } else if (period === 'previous-month') {
                $('#startDateFilter').val('2025-04-01');
                $('#endDateFilter').val('2025-04-30');
            } else if (period === 'custom') {
                // Lascia i campi data come sono per personalizzazione
            }
        });
        
        // Controllo se dobbiamo aprire automaticamente il modal (da parametro URL)
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('action') === 'calculate') {
            setTimeout(function() {
                $('#calculatePaymentsBtn').trigger('click');
            }, 500);
        }

        // Apertura modal export report
        $('#exportPaymentsBtn').on('click', function() {
            // Qui implementerei la generazione e il download del report
            alert('Report generato ed esportato con successo!');
        });

        // Gestione modale di calcolo pagamenti
        $('#calcPeriodSelect').on('change', function() {
            if ($(this).val() === 'custom') {
                $('#customDateRange').show();
            } else {
                $('#customDateRange').hide();
            }
        });

        // Gestione checkbox "seleziona tutti"
        $('#selectAllDrivers').on('change', function() {
            $('.driver-checkbox').prop('checked', $(this).is(':checked'));
        });

        // Gestione checkbox driver individuali
        $('.driver-checkbox').on('change', function() {
            if (!$(this).is(':checked')) {
                $('#selectAllDrivers').prop('checked', false);
            } else {
                // Se tutti i checkbox sono selezionati, seleziona anche "seleziona tutti"
                const allChecked = $('.driver-checkbox:checked').length === $('.driver-checkbox').length;
                $('#selectAllDrivers').prop('checked', allChecked);
            }
        });

        // Avvio calcolo pagamenti
        $('#startCalculation').off('click').on('click', function() {
            // Prendi i dati dal form
            const period = $('#calcPeriodSelect').val();
            const month = $('#calcMonth').val();
            const includeHolidays = $('#calcIncludeHolidays').is(':checked');
            
            // Raccoglie i driver selezionati
            const selectedDrivers = [];
            $('.driver-checkbox:checked').each(function() {
                selectedDrivers.push($(this).attr('id').replace('driver', ''));
            });
            
            // Controlla che ci siano driver selezionati
            if (selectedDrivers.length === 0) {
                alert('Seleziona almeno un driver per il calcolo');
                return;
            }
            
            // Simulazione calcolo con effetto loading
            $(this).html('<span class="spinner-border spinner-border-sm me-2" role="status"></span>Calcolo in corso...');
            $(this).prop('disabled', true);
            
            // Dati che verranno inviati nel caso di una vera implementazione
            const calculationData = {
                period: period,
                month: month,
                includeHolidays: includeHolidays,
                drivers: selectedDrivers,
                startDate: period === 'custom' ? $('#calcStartDate').val() : null,
                endDate: period === 'custom' ? $('#calcEndDate').val() : null
            };
            
            console.log('Dati per il calcolo:', calculationData);
            
            // Simula l'elaborazione
            setTimeout(() => {
                // Dopo 1.5 secondi, simuliamo la fine del calcolo
                $(this).html('<i class="fas fa-calculator me-2"></i>Calcola');
                $(this).prop('disabled', false);
                
                try {
                    // Chiudi il modal (con gestione errori)
                    if (typeof bootstrap !== 'undefined') {
                        const modalElement = document.getElementById('calculateModal');
                        const modalInstance = bootstrap.Modal.getInstance(modalElement);
                        if (modalInstance) modalInstance.hide();
                    } else {
                        // Fallback jQuery
                        $('#calculateModal').modal('hide');
                    }
                } catch (e) {
                    console.error('Errore nella chiusura del modal:', e);
                    // Se c'è un errore, prova a nascondere il modal in un altro modo
                    $('#calculateModal').removeClass('show').css('display', 'none');
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open').css('padding-right', '');
                }
                
                // Mostra un messaggio di successo
                showNotification('success', 'Pagamenti calcolati con successo! Sono stati elaborati ' + 
                                selectedDrivers.length + ' driver per il periodo ' + 
                                (period === 'first-half' ? 'prima metà del mese' : 
                                 period === 'second-half' ? 'seconda metà del mese' : 
                                 period === 'full-month' ? 'mese intero' : 'personalizzato'));
                
                // Aggiorna la tabella (simulazione)
                // Nella realtà qui farei una chiamata AJAX per ottenere i dati aggiornati
                location.reload();
            }, 1500);
        });
    }
});

// Funzione migliorata per mostrare le notifiche
function showNotification(type, message) {
    const notificationContainer = document.querySelector('.toast-container') || (() => {
        const container = document.createElement('div');
        container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
        document.body.appendChild(container);
        return container;
    })();
    
    const iconMap = {
        success: 'fas fa-check-circle',
        danger: 'fas fa-exclamation-circle',
        warning: 'fas fa-exclamation-triangle',
        info: 'fas fa-info-circle',
        primary: 'fas fa-bell'
    };
    
    const colorMap = {
        success: '#28a745',
        danger: '#dc3545',
        warning: '#ffc107',
        info: '#17a2b8',
        primary: '#007bff'
    };
    
    const toastEl = document.createElement('div');
    toastEl.className = `toast toast-notification bg-${type}`;
    toastEl.style.backgroundColor = colorMap[type];
    toastEl.style.color = 'white';
    
    toastEl.innerHTML = `
        <div class="toast-header" style="background-color: ${colorMap[type]}; color: white;">
            <i class="${iconMap[type] || 'fas fa-bell'} me-2"></i>
            <strong class="me-auto">Notifica</strong>
            <small>Adesso</small>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            ${message}
        </div>
    `;
    
    notificationContainer.appendChild(toastEl);
    
    // Gestisci la chiusura manuale
    const closeBtn = toastEl.querySelector('.btn-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            toastEl.remove();
        });
    }
    
    // Rimuovi automaticamente dopo 5 secondi
    setTimeout(() => {
        toastEl.classList.add('hiding');
        setTimeout(() => {
            toastEl.remove();
        }, 500);
    }, 5000);
}

// Funzione per visualizzare i dettagli del pagamento
function viewPayment(paymentId) {
    // Ottieni informazioni di esempio basate sull'ID pagamento
    const paymentInfo = getPaymentInfo(paymentId);
    
    if (!paymentInfo) {
        showNotification('danger', 'Dettaglio pagamento non trovato');
        return;
    }
    
    // Popola il modal con i dettagli del pagamento
    const modalBody = document.querySelector('#viewPaymentModal .payment-details');
    if (!modalBody) return;
    
    let driverTypeIcon = '';
    let paymentTypeBadge = '';
    
    // Imposta l'icona corretta in base al tipo di driver
    switch (paymentInfo.type) {
        case 'forfait':
            driverTypeIcon = '<span class="avatar-sm me-2 bg-primary text-white">MB</span>';
            paymentTypeBadge = '<span class="badge bg-success">Forfait Fisso</span>';
            break;
        case 'hourly':
            driverTypeIcon = '<span class="avatar-sm me-2 bg-info text-white">LV</span>';
            paymentTypeBadge = '<span class="badge bg-info">Ad Ore</span>';
            break;
        case 'delivery':
            driverTypeIcon = '<span class="avatar-sm me-2 bg-warning text-white">GR</span>';
            paymentTypeBadge = '<span class="badge bg-warning">A Consegna</span>';
            break;
    }
    
    // Genera HTML per lo stato del pagamento
    let statusBadge = '';
    switch (paymentInfo.status) {
        case 'pending':
            statusBadge = '<span class="badge bg-warning">In Attesa</span>';
            break;
        case 'paid':
            statusBadge = '<span class="badge bg-success">Pagato</span>';
            break;
    }
    
    // Contenuto HTML per il modal con i dettagli del pagamento
    modalBody.innerHTML = `
        <div class="payment-card">
            <h6 class="fw-bold d-flex align-items-center">
                <div class="d-flex align-items-center">
                    ${driverTypeIcon}
                    <div>
                        ${paymentInfo.driverName} 
                        <small class="ms-2">${paymentTypeBadge}</small>
                    </div>
                </div>
            </h6>
            
            <div class="payment-detail-row">
                <strong>ID Pagamento:</strong>
                <span>PAY-${paymentId.toString().padStart(4, '0')}</span>
            </div>
            
            <div class="payment-detail-row">
                <strong>Periodo:</strong>
                <span>${paymentInfo.period}</span>
            </div>
            
            <div class="payment-detail-row">
                <strong>Tipo Contratto:</strong>
                <span>${paymentInfo.contractType}</span>
            </div>
            
            <div class="payment-detail-row">
                <strong>Mezzo:</strong>
                <span>${paymentInfo.vehicle}</span>
            </div>
            
            <div class="payment-detail-row">
                <strong>Stato:</strong>
                <span>${statusBadge}</span>
            </div>
        </div>
        
        <div class="payment-card">
            <h6 class="fw-bold">Dettagli Calcolo</h6>
            ${getPaymentCalculationDetails(paymentInfo)}
        </div>
        
        <div class="payment-card">
            <h6 class="fw-bold">Riepilogo Pagamento</h6>
            
            <div class="payment-detail-row">
                <strong>Importo Base:</strong>
                <span>€${paymentInfo.baseAmount.toFixed(2)}</span>
            </div>
            
            <div class="payment-detail-row">
                <strong>Maggiorazioni:</strong>
                <span>€${paymentInfo.bonuses.toFixed(2)}</span>
            </div>
            
            <div class="payment-detail-row">
                <strong>Rimborsi:</strong>
                <span>€${paymentInfo.reimbursements.toFixed(2)}</span>
            </div>
            
            <div class="payment-detail-row total">
                <strong>Totale da Pagare:</strong>
                <span>€${paymentInfo.totalAmount.toFixed(2)}</span>
            </div>
        </div>
    `;
    
    // Mostra il modal
    const viewPaymentModal = new bootstrap.Modal(document.getElementById('viewPaymentModal'));
    viewPaymentModal.show();
    
    // Aggiungi event listener per il pulsante di stampa
    const printBtn = document.getElementById('printPayment');
    if (printBtn) {
        printBtn.onclick = function() {
            printPaymentDetails(paymentId);
        };
    }
}

// Funzione per processare un pagamento
function processPayment(paymentId) {
    // Ottieni informazioni di esempio basate sull'ID pagamento
    const paymentInfo = getPaymentInfo(paymentId);
    
    if (!paymentInfo) {
        showNotification('danger', 'Informazioni sul pagamento non trovate');
        return;
    }
    
    // Popola il modal di conferma pagamento
    document.getElementById('confirmAmount').textContent = `€${paymentInfo.totalAmount.toFixed(2)}`;
    document.getElementById('confirmDriver').textContent = paymentInfo.driverName;
    
    // Mostra il modal
    const confirmPaymentModal = new bootstrap.Modal(document.getElementById('confirmPaymentModal'));
    confirmPaymentModal.show();
    
    // Gestisci il pulsante di conferma
    const confirmBtn = document.getElementById('confirmPayment');
    if (confirmBtn) {
        // Rimuovi event listener esistenti per evitare duplicazioni
        const newConfirmBtn = confirmBtn.cloneNode(true);
        confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
        
        newConfirmBtn.addEventListener('click', function() {
            // Mostra indicatore di caricamento
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Elaborazione...';
            this.disabled = true;
            
            // Simula elaborazione del pagamento
            setTimeout(() => {
                // Nascondi il modal
                confirmPaymentModal.hide();
                
                // Mostra notifica di successo
                showNotification('success', `Pagamento di €${paymentInfo.totalAmount.toFixed(2)} per ${paymentInfo.driverName} elaborato con successo!`);
                
                // Aggiorna lo stato dell'interfaccia - in un'app reale faremmo una chiamata AJAX qui
                // e ricaricheremmo i dati. Per ora aggiorniamo solo lo stato visivo
                const rowsToUpdate = document.querySelectorAll(`.btn-sm[onclick="processPayment(${paymentId})"]`);
                rowsToUpdate.forEach(btn => {
                    // Aggiorna il badge di stato nella riga
                    const tr = btn.closest('tr');
                    if (tr) {
                        const statusBadge = tr.querySelector('.badge');
                        if (statusBadge) {
                            statusBadge.className = 'badge bg-success';
                            statusBadge.textContent = 'Pagato';
                        }
                        
                        // Disabilita i pulsanti di azione
                        const actionButtons = tr.querySelectorAll('.btn-sm');
                        actionButtons.forEach(actionBtn => {
                            if (actionBtn.querySelector('.fa-eye')) return; // Mantieni il pulsante di visualizzazione attivo
                            
                            actionBtn.classList.remove('text-success', 'text-secondary');
                            actionBtn.classList.add('text-secondary');
                            actionBtn.disabled = true;
                        });
                    }
                });
                
                // Reset del pulsante di conferma
                this.innerHTML = 'Conferma Pagamento';
                this.disabled = false;
            }, 1500);
        });
    }
}

// Funzione per modificare un pagamento
function editPayment(paymentId) {
    // Ottieni informazioni di esempio basate sull'ID pagamento
    const paymentInfo = getPaymentInfo(paymentId);
    
    if (!paymentInfo) {
        showNotification('danger', 'Informazioni sul pagamento non trovate');
        return;
    }
    
    // Popola il form di modifica
    const editContent = document.getElementById('editPaymentContent');
    if (!editContent) return;
    
    // Genera form di modifica in base al tipo di pagamento
    let formHTML = '';
    
    switch (paymentInfo.type) {
        case 'forfait':
            formHTML = `
                <input type="hidden" id="editPaymentId" value="${paymentId}">
                <div class="mb-3">
                    <label class="form-label">Driver</label>
                    <input type="text" class="form-control" value="${paymentInfo.driverName}" readonly>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Data Inizio</label>
                        <input type="date" class="form-control" id="editStartDate" value="${paymentInfo.startDate}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Data Fine</label>
                        <input type="date" class="form-control" id="editEndDate" value="${paymentInfo.endDate}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Giorni lavorati</label>
                        <input type="number" class="form-control" id="editDays" value="${paymentInfo.days}" min="0" max="31">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ore per giorno</label>
                        <input type="number" class="form-control" id="editHours" value="${paymentInfo.hoursPerDay}" min="1" max="24">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Maggiorazioni festivi (€)</label>
                    <input type="number" class="form-control" id="editBonus" value="${paymentInfo.bonuses.toFixed(2)}" step="0.01" min="0">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="editApplyHolidays" ${paymentInfo.applyHolidays ? 'checked' : ''}>
                    <label class="form-check-label" for="editApplyHolidays">Calcola maggiorazioni per festività</label>
                </div>
            `;
            break;
            
        case 'hourly':
            formHTML = `
                <input type="hidden" id="editPaymentId" value="${paymentId}">
                <div class="mb-3">
                    <label class="form-label">Driver</label>
                    <input type="text" class="form-control" value="${paymentInfo.driverName}" readonly>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Data Inizio</label>
                        <input type="date" class="form-control" id="editStartDate" value="${paymentInfo.startDate}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Data Fine</label>
                        <input type="date" class="form-control" id="editEndDate" value="${paymentInfo.endDate}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Ore L-V</label>
                        <input type="number" class="form-control" id="editWeekdayHours" value="${paymentInfo.weekdayHours}" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tariffa L-V (€/h)</label>
                        <input type="number" class="form-control" id="editWeekdayRate" value="${paymentInfo.weekdayRate.toFixed(2)}" step="0.01" min="0">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Ore S-D</label>
                        <input type="number" class="form-control" id="editWeekendHours" value="${paymentInfo.weekendHours}" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tariffa S-D (€/h)</label>
                        <input type="number" class="form-control" id="editWeekendRate" value="${paymentInfo.weekendRate.toFixed(2)}" step="0.01" min="0">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Ore Festivi</label>
                        <input type="number" class="form-control" id="editHolidayHours" value="${paymentInfo.holidayHours}" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Maggiorazione festivi (€)</label>
                        <input type="number" class="form-control" id="editHolidayBonus" value="${paymentInfo.bonuses.toFixed(2)}" step="0.01" min="0">
                    </div>
                </div>
            `;
            break;
            
        case 'delivery':
            formHTML = `
                <input type="hidden" id="editPaymentId" value="${paymentId}">
                <div class="mb-3">
                    <label class="form-label">Driver</label>
                    <input type="text" class="form-control" value="${paymentInfo.driverName}" readonly>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Data Inizio</label>
                        <input type="date" class="form-control" id="editStartDate" value="${paymentInfo.startDate}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Data Fine</label>
                        <input type="date" class="form-control" id="editEndDate" value="${paymentInfo.endDate}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Numero Consegne</label>
                        <input type="number" class="form-control" id="editDeliveries" value="${paymentInfo.deliveries}" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tariffa per Consegna (€)</label>
                        <input type="number" class="form-control" id="editDeliveryRate" value="${paymentInfo.deliveryRate.toFixed(2)}" step="0.01" min="0">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo di Mezzo</label>
                    <select class="form-select" id="editVehicleType">
                        <option value="Proprio" ${paymentInfo.vehicle === 'Proprio' ? 'selected' : ''}>Proprio</option>
                        <option value="Aziendale" ${paymentInfo.vehicle === 'Aziendale' ? 'selected' : ''}>Aziendale</option>
                    </select>
                </div>
            `;
            break;
    }
    
    editContent.innerHTML = formHTML;
    
    // Mostra il modal
    const editPaymentModal = new bootstrap.Modal(document.getElementById('editPaymentModal'));
    editPaymentModal.show();
    
    // Gestisci il pulsante di salvataggio
    const saveBtn = document.getElementById('savePaymentChanges');
    if (saveBtn) {
        // Rimuovi event listener esistenti per evitare duplicazioni
        const newSaveBtn = saveBtn.cloneNode(true);
        saveBtn.parentNode.replaceChild(newSaveBtn, saveBtn);
        
        newSaveBtn.addEventListener('click', function() {
            // Mostra indicatore di caricamento
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Salvataggio...';
            this.disabled = true;
            
            // Simula salvataggio
            setTimeout(() => {
                // Nascondi il modal
                editPaymentModal.hide();
                
                // Mostra notifica di successo
                showNotification('success', `Le modifiche al pagamento per ${paymentInfo.driverName} sono state salvate con successo!`);
                
                // In un'app reale, qui faremmo una chiamata AJAX per salvare le modifiche
                
                // Reset del pulsante di salvataggio
                this.innerHTML = 'Salva Modifiche';
                this.disabled = false;
            }, 1500);
        });
    }
}

// Funzione di supporto per ottenere informazioni sui pagamenti
function getPaymentInfo(paymentId) {
    // In un'app reale, queste informazioni verrebbero dal database
    const paymentsData = {
        1: {
            driverName: 'Marco Bianchi',
            type: 'forfait',
            contractType: 'Forfait Fisso',
            period: '01/05/2025 - 15/05/2025',
            startDate: '2025-05-01',
            endDate: '2025-05-15',
            days: 10,
            hoursPerDay: 8,
            totalHours: 80,
            vehicle: 'Proprio',
            hourlyRate: 14,
            baseAmount: 1120.00,
            bonuses: 56.00,
            reimbursements: 0,
            totalAmount: 1176.00,
            status: 'pending',
            applyHolidays: true
        },
        2: {
            driverName: 'Laura Verdi',
            type: 'hourly',
            contractType: 'Ad Ore',
            period: '01/05/2025 - 15/05/2025',
            startDate: '2025-05-01',
            endDate: '2025-05-15',
            weekdayHours: 52,
            weekdayRate: 9,
            weekendHours: 16,
            weekendRate: 11,
            holidayHours: 0,
            vehicle: 'Aziendale',
            baseAmount: 612.00,
            bonuses: 96.00,
            reimbursements: 0,
            totalAmount: 708.00,
            status: 'pending'
        },
        3: {
            driverName: 'Giuseppe Rossi',
            type: 'delivery',
            contractType: 'A Consegna',
            period: '01/05/2025 - 15/05/2025',
            startDate: '2025-05-01',
            endDate: '2025-05-15',
            deliveries: 132,
            deliveryRate: 5,
            vehicle: 'Proprio',
            baseAmount: 660.00,
            bonuses: 0,
            reimbursements: 0,
            totalAmount: 660.00,
            status: 'pending'
        },
        4: {
            driverName: 'Marco Bianchi',
            type: 'forfait',
            contractType: 'Forfait Fisso',
            period: '15/04/2025 - 30/04/2025',
            startDate: '2025-04-15',
            endDate: '2025-04-30',
            days: 12,
            hoursPerDay: 8,
            totalHours: 96,
            vehicle: 'Proprio',
            hourlyRate: 14,
            baseAmount: 1344.00,
            bonuses: 160.00,
            reimbursements: 0,
            totalAmount: 1504.00,
            status: 'paid',
            applyHolidays: true
        },
        5: {
            driverName: 'Laura Verdi',
            type: 'hourly',
            contractType: 'Ad Ore',
            period: '15/04/2025 - 30/04/2025',
            startDate: '2025-04-15',
            endDate: '2025-04-30',
            weekdayHours: 63,
            weekdayRate: 9,
            weekendHours: 16,
            weekendRate: 11,
            holidayHours: 8,
            vehicle: 'Aziendale',
            baseAmount: 783.00,
            bonuses: 66.00,
            reimbursements: 0,
            totalAmount: 849.00,
            status: 'paid'
        }
    };
    
    return paymentsData[paymentId];
}

// Funzione di supporto per generare dettagli di calcolo del pagamento
function getPaymentCalculationDetails(paymentInfo) {
    let detailsHTML = '';
    
    switch (paymentInfo.type) {
        case 'forfait':
            detailsHTML = `
                <div class="payment-detail-row">
                    <strong>Giorni lavorati:</strong>
                    <span>${paymentInfo.days} giorni</span>
                </div>
                <div class="payment-detail-row">
                    <strong>Ore per giorno:</strong>
                    <span>${paymentInfo.hoursPerDay} ore</span>
                </div>
                <div class="payment-detail-row">
                    <strong>Totale ore:</strong>
                    <span>${paymentInfo.totalHours} ore</span>
                </div>
                <div class="payment-detail-row">
                    <strong>Tariffa oraria:</strong>
                    <span>€${paymentInfo.hourlyRate.toFixed(2)}/ora</span>
                </div>
                <div class="payment-detail-row">
                    <strong>Calcolo base:</strong>
                    <span>${paymentInfo.totalHours} ore × €${paymentInfo.hourlyRate.toFixed(2)}/ora = €${paymentInfo.baseAmount.toFixed(2)}</span>
                </div>
                <div class="payment-detail-row">
                    <strong>Calcolo maggiorazioni festivi:</strong>
                    <span>€${paymentInfo.bonuses.toFixed(2)}</span>
                </div>
            `;
            break;
            
        case 'hourly':
            detailsHTML = `
                <div class="payment-detail-row">
                    <strong>Ore L-V:</strong>
                    <span>${paymentInfo.weekdayHours} ore × €${paymentInfo.weekdayRate.toFixed(2)}/ora = €${(paymentInfo.weekdayHours * paymentInfo.weekdayRate).toFixed(2)}</span>
                </div>
                <div class="payment-detail-row">
                    <strong>Ore S-D:</strong>
                    <span>${paymentInfo.weekendHours} ore × €${paymentInfo.weekendRate.toFixed(2)}/ora = €${(paymentInfo.weekendHours * paymentInfo.weekendRate).toFixed(2)}</span>
                </div>
                <div class="payment-detail-row">
                    <strong>Ore festivi:</strong>
                    <span>${paymentInfo.holidayHours} ore</span>
                </div>
                <div class="payment-detail-row">
                    <strong>Maggiorazioni festivi:</strong>
                    <span>€${paymentInfo.bonuses.toFixed(2)}</span>
                </div>
            `;
            break;
            
        case 'delivery':
            detailsHTML = `
                <div class="payment-detail-row">
                    <strong>Numero consegne:</strong>
                    <span>${paymentInfo.deliveries} consegne</span>
                </div>
                <div class="payment-detail-row">
                    <strong>Tariffa per consegna:</strong>
                    <span>€${paymentInfo.deliveryRate.toFixed(2)}/consegna</span>
                </div>
                <div class="payment-detail-row">
                    <strong>Calcolo importo:</strong>
                    <span>${paymentInfo.deliveries} consegne × €${paymentInfo.deliveryRate.toFixed(2)}/consegna = €${paymentInfo.baseAmount.toFixed(2)}</span>
                </div>
            `;
            break;
    }
    
    return detailsHTML;
}

// Funzione per stampare i dettagli del pagamento
function printPaymentDetails(paymentId) {
    // Ottiene informazioni sul pagamento
    const paymentInfo = getPaymentInfo(paymentId);
    
    if (!paymentInfo) {
        showNotification('danger', 'Dettagli pagamento non trovati');
        return;
    }
    
    // In un'app reale, qui genereremmo un PDF o prepareremmo la pagina per la stampa
    // Per ora, mostra solo un messaggio
    showNotification('success', `Preparazione stampa del pagamento per ${paymentInfo.driverName}`);
    
    // Simula l'apertura della finestra di stampa dopo un breve ritardo
    setTimeout(() => {
        // Crea contenuto per la stampa
        const printWindow = window.open('', '_blank');
        
        if (printWindow) {
            printWindow.document.write(`
                <html>
                <head>
                    <title>Dettaglio Pagamento - ${paymentInfo.driverName}</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        .header { text-align: center; margin-bottom: 30px; }
                        .logo { font-size: 24px; font-weight: bold; margin-bottom: 5px; }
                        .title { font-size: 18px; margin-bottom: 20px; }
                        .section { margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 15px; }
                        .row { display: flex; justify-content: space-between; margin-bottom: 8px; }
                        .label { font-weight: bold; }
                        .total { font-weight: bold; margin-top: 10px; font-size: 16px; }
                        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #666; }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <div class="logo">Food Delivery System</div>
                        <div class="title">Dettaglio Pagamento</div>
                    </div>
                    
                    <div class="section">
                        <h3>Informazioni Driver</h3>
                        <div class="row">
                            <span class="label">Nome:</span>
                            <span>${paymentInfo.driverName}</span>
                        </div>
                        <div class="row">
                            <span class="label">Tipo Contratto:</span>
                            <span>${paymentInfo.contractType}</span>
                        </div>
                        <div class="row">
                            <span class="label">Periodo:</span>
                            <span>${paymentInfo.period}</span>
                        </div>
                        <div class="row">
                            <span class="label">Mezzo:</span>
                            <span>${paymentInfo.vehicle}</span>
                        </div>
                    </div>
                    
                    <div class="section">
                        <h3>Dettagli Calcolo</h3>
                        ${printPaymentDetails(paymentInfo)}
                    </div>
                    
                    <div class="section">
                        <h3>Riepilogo</h3>
                        <div class="row">
                            <span class="label">Importo Base:</span>
                            <span>€${paymentInfo.baseAmount.toFixed(2)}</span>
                        </div>
                        <div class="row">
                            <span class="label">Maggiorazioni:</span>
                            <span>€${paymentInfo.bonuses.toFixed(2)}</span>
                        </div>
                        <div class="row">
                            <span class="label">Rimborsi:</span>
                            <span>€${paymentInfo.reimbursements.toFixed(2)}</span>
                        </div>
                        <div class="row total">
                            <span class="label">TOTALE:</span>
                            <span>€${paymentInfo.totalAmount.toFixed(2)}</span>
                        </div>
                    </div>
                    
                    <div class="footer">
                        Documento generato il ${new Date().toLocaleString()} - Pag. 1/1
                    </div>
                </body>
                </html>
            `);
            
            printWindow.document.close();
            
            // Avvia la finestra di stampa
            setTimeout(() => {
                printWindow.print();
            }, 500);
        } else {
            showNotification('warning', 'Impossibile aprire la finestra di stampa. Controlla che i popup non siano bloccati.');
        }
    }, 500);
}

// Funzione per generare i dettagli di pagamento per la stampa
function printPaymentDetails(paymentInfo) {
    let detailsHTML = '';
    
    switch (paymentInfo.type) {
        case 'forfait':
            detailsHTML = `
                <div class="row">
                    <span class="label">Giorni lavorati:</span>
                    <span>${paymentInfo.days}</span>
                </div>
                <div class="row">
                    <span class="label">Ore per giorno:</span>
                    <span>${paymentInfo.hoursPerDay}</span>
                </div>
                <div class="row">
                    <span class="label">Totale ore:</span>
                    <span>${paymentInfo.totalHours}</span>
                </div>
                <div class="row">
                    <span class="label">Tariffa oraria:</span>
                    <span>€${paymentInfo.hourlyRate.toFixed(2)}/ora</span>
                </div>
            `;
            break;
            
        case 'hourly':
            detailsHTML = `
                <div class="row">
                    <span class="label">Ore L-V:</span>
                    <span>${paymentInfo.weekdayHours} ore a €${paymentInfo.weekdayRate.toFixed(2)}/ora</span>
                </div>
                <div class="row">
                    <span class="label">Subtotale L-V:</span>
                    <span>€${(paymentInfo.weekdayHours * paymentInfo.weekdayRate).toFixed(2)}</span>
                </div>
                <div class="row">
                    <span class="label">Ore S-D:</span>
                    <span>${paymentInfo.weekendHours} ore a €${paymentInfo.weekendRate.toFixed(2)}/ora</span>
                </div>
                <div class="row">
                    <span class="label">Subtotale S-D:</span>
                    <span>€${(paymentInfo.weekendHours * paymentInfo.weekendRate).toFixed(2)}</span>
                </div>
                <div class="row">
                    <span class="label">Maggiorazione festivi:</span>
                    <span>€${paymentInfo.bonuses.toFixed(2)}</span>
                </div>
            `;
            break;
            
        case 'delivery':
            detailsHTML = `
                <div class="row">
                    <span class="label">Numero consegne:</span>
                    <span>${paymentInfo.deliveries}</span>
                </div>
                <div class="row">
                    <span class="label">Tariffa per consegna:</span>
                    <span>€${paymentInfo.deliveryRate.toFixed(2)}</span>
                </div>
                <div class="row">
                    <span class="label">Calcolo importo:</span>
                    <span>${paymentInfo.deliveries} × €${paymentInfo.deliveryRate.toFixed(2)} = €${paymentInfo.baseAmount.toFixed(2)}</span>
                </div>
            `;
            break;
    }
    
    return detailsHTML;
}

// Funzione per simulare il filtro dei pagamenti
function simulateFilter(startDate, endDate, driver, includeHolidays) {
    // In un'app reale qui faremmo una chiamata AJAX per filtrare i dati
    // Per ora simuliamo un filtro con un minimo di animazione visiva
    
    // Mostra indicatore di caricamento
    document.querySelector('body').style.cursor = 'wait';
    
    // Aggiungi overlay di caricamento
    const overlay = document.createElement('div');
    overlay.style.position = 'fixed';
    overlay.style.top = '0';
    overlay.style.left = '0';
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(255,255,255,0.7)';
    overlay.style.display = 'flex';
    overlay.style.justifyContent = 'center';
    overlay.style.alignItems = 'center';
    overlay.style.zIndex = '1050';
    overlay.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Caricamento...</span></div>';
    document.body.appendChild(overlay);
    
    // Simula un ritardo di caricamento
    setTimeout(() => {
        // Rimuovi overlay di caricamento
        document.body.removeChild(overlay);
        document.querySelector('body').style.cursor = 'default';
        
        // Mostra notifica
        showNotification('success', 'Filtri applicati con successo!');
    }, 800);
}
</script>

<?php require_once 'views/layout/footer.php'; ?>