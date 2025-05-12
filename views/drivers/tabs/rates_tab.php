<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center mb-4">
                    <span class="icon-circle bg-success-light driver-text-success me-2">
                        <i class="fas fa-money-bill-wave"></i>
                    </span>
                    Tariffe per tipo veicolo
                </h5>
                
                <ul class="nav nav-tabs custom-tabs mb-4" id="ratesTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="own-vehicle-tab" data-bs-toggle="pill" 
                                data-bs-target="#own-vehicle" type="button" role="tab" 
                                aria-controls="own-vehicle" aria-selected="true">
                            <i class="fas fa-user me-2"></i>Veicolo Proprio
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="company-vehicle-tab" data-bs-toggle="pill" 
                                data-bs-target="#company-vehicle" type="button" role="tab" 
                                aria-controls="company-vehicle" aria-selected="false">
                            <i class="fas fa-building me-2"></i>Veicolo Aziendale
                        </button>
                    </li>
                </ul>
                
                <div class="tab-content" id="ratesTabContent">
                    <!-- Veicolo Proprio -->
                    <div class="tab-pane fade show active" id="own-vehicle" role="tabpanel" aria-labelledby="own-vehicle-tab">
                        <div class="table-responsive custom-table-container">
                            <table class="table custom-table">
                                <thead>
                                    <tr>
                                        <th>Tipo Veicolo</th>
                                        <th>Tariffa Lun-Ven (€/ora)</th>
                                        <th>Tariffa Sab-Dom (€/ora)</th>
                                        <th>Tariffa Straordinari (€/ora)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="icon-circle bg-primary-soft driver-text-primary me-2" style="width: 28px; height: 28px;">
                                                    <i class="fas fa-motorcycle fa-sm"></i>
                                                </span>
                                                <span>Scooter</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="own-scooter-weekday" value="9.50" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="own-scooter-weekend" value="11.50" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="own-scooter-extra" value="12.50" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="icon-circle bg-info-soft driver-text-info me-2" style="width: 28px; height: 28px;">
                                                    <i class="fas fa-bicycle fa-sm"></i>
                                                </span>
                                                <span>Bicicletta</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="own-bike-weekday" value="8.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="own-bike-weekend" value="9.50" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="own-bike-extra" value="10.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="icon-circle bg-warning-soft driver-text-warning me-2" style="width: 28px; height: 28px;">
                                                    <i class="fas fa-car fa-sm"></i>
                                                </span>
                                                <span>Auto</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="own-car-weekday" value="10.50" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="own-car-weekend" value="12.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="own-car-extra" value="13.50" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="icon-circle bg-danger-soft driver-text-danger me-2" style="width: 28px; height: 28px;">
                                                    <i class="fas fa-motorcycle fa-sm"></i>
                                                </span>
                                                <span>Moto</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="own-motorbike-weekday" value="10.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="own-motorbike-weekend" value="12.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="own-motorbike-extra" value="13.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Veicolo Aziendale -->
                    <div class="tab-pane fade" id="company-vehicle" role="tabpanel" aria-labelledby="company-vehicle-tab">
                        <div class="table-responsive custom-table-container">
                            <table class="table custom-table">
                                <thead>
                                    <tr>
                                        <th>Tipo Veicolo</th>
                                        <th>Tariffa Lun-Ven (€/ora)</th>
                                        <th>Tariffa Sab-Dom (€/ora)</th>
                                        <th>Tariffa Straordinari (€/ora)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="icon-circle bg-primary-soft driver-text-primary me-2" style="width: 28px; height: 28px;">
                                                    <i class="fas fa-motorcycle fa-sm"></i>
                                                </span>
                                                <span>Scooter</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="company-scooter-weekday" value="8.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="company-scooter-weekend" value="10.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="company-scooter-extra" value="11.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="icon-circle bg-info-soft driver-text-info me-2" style="width: 28px; height: 28px;">
                                                    <i class="fas fa-bicycle fa-sm"></i>
                                                </span>
                                                <span>Bicicletta</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="company-bike-weekday" value="7.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="company-bike-weekend" value="8.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="company-bike-extra" value="9.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="icon-circle bg-warning-soft driver-text-warning me-2" style="width: 28px; height: 28px;">
                                                    <i class="fas fa-car fa-sm"></i>
                                                </span>
                                                <span>Auto</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="company-car-weekday" value="9.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="company-car-weekend" value="10.50" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="company-car-extra" value="12.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="icon-circle bg-danger-soft driver-text-danger me-2" style="width: 28px; height: 28px;">
                                                    <i class="fas fa-motorcycle fa-sm"></i>
                                                </span>
                                                <span>Moto</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="company-motorbike-weekday" value="8.50" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="company-motorbike-weekend" value="10.00" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="company-motorbike-extra" value="11.50" step="0.10">
                                                <span class="input-group-text">€/h</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                                <h6 class="mb-1 fw-medium">Informazioni sulle tariffe</h6>
                                <p class="small mb-0">Le tariffe sono espresse in € all'ora. Gli straordinari vengono considerati per turni oltre le 8 ore giornaliere o richiesti con meno di 24 ore di preavviso.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Tabs */
.custom-tabs {
    border-bottom: 1px solid #dee2e6;
    margin-bottom: 1.5rem;
    gap: 0.5rem;
}

.custom-tabs .nav-link {
    margin-right: 0.5rem;
    color: #64748b;
    border: none;
    border-radius: 6px 6px 0 0;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
    background-color: #f8f9fa;
    position: relative;
}

.custom-tabs .nav-link:hover:not(.active) {
    background-color: #e9ecef;
    color: #ff5a5f;
}

.custom-tabs .nav-link.active {
    color: #ff5a5f;
    background-color: #ffffff;
    font-weight: 600;
    border-top: 2px solid #ff5a5f;
    border-left: 1px solid #dee2e6;
    border-right: 1px solid #dee2e6;
    border-bottom: 1px solid #ffffff;
    margin-bottom: -1px;
}

.custom-tabs .nav-link.active:after {
    display: none;
}

/* Table styles */
.custom-table-container {
    border-radius: 8px;
    overflow: hidden;
}

.custom-table {
    margin-bottom: 0;
}

.custom-table thead th {
    background-color: #f8f9fa;
    color: #64748b;
    font-weight: 600;
    border: none;
    padding: 12px 15px;
    font-size: 0.875rem;
}

.custom-table tbody td {
    border-color: #f0f0f0;
    padding: 12px 15px;
    vertical-align: middle;
}

.custom-table tbody tr:hover {
    background-color: #f8fafd;
}

/* Color variations */
.bg-primary-soft {
    background-color: rgba(91,134,229,0.1);
}

.bg-info-soft {
    background-color: rgba(54,209,220,0.1);
}

.bg-warning-soft {
    background-color: rgba(255,170,0,0.1);
}

.bg-danger-soft {
    background-color: rgba(244,67,54,0.1);
}

.driver-text-primary {
    color: #5B86E5;
}

.driver-text-info {
    color: #36D1DC;
}

.driver-text-warning {
    color: #FFA500;
}

.driver-text-danger {
    color: #f44336;
}

.driver-text-success {
    color: #00d68f;
}

.bg-success-light {
    background-color: rgba(0,214,143,0.1);
}

.alert-icon .icon-circle {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.alert-info {
    background-color: rgba(54,209,220,0.05);
    color: #1e293b;
}
</style>