<?php require_once 'views/layout/header.php'; ?>

<div class="section-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="section-title">Gestione Turni</h2>
        <p class="section-subtitle">Da qui potrai gestire facilmente i turni dei driver, visualizzare le disponibilità e inviare notifiche in tempo reale.</p>
    </div>
    <div>
        <a href="<?php echo url('drivers', 'gestione_turni_driver'); ?>" class="btn btn-primary btn-action pulse-animation">
            <i class="fas fa-calendar-alt me-2"></i> Gestione Avanzata Turni
        </a>
    </div>
</div>

<!-- Contenitore principale con classe js-content-ready che sarà nascosto inizialmente -->
<div class="row g-4 mb-4 js-content-ready" style="opacity: 0; transition: opacity 0.3s ease;">
    <!-- Vista settimanale -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <!-- Tabs di navigazione -->
                <ul class="nav nav-tabs custom-tabs" id="turniTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="disponibilita-tab" data-bs-toggle="tab" data-bs-target="#disponibilita" type="button" role="tab" aria-controls="disponibilita" aria-selected="true">
                            <i class="fas fa-user-clock me-2"></i> Disponibilità
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="notifiche-tab" data-bs-toggle="tab" data-bs-target="#notifiche" type="button" role="tab" aria-controls="notifiche" aria-selected="false">
                            <i class="fas fa-bell me-2"></i> Notifiche
                        </button>
                    </li>
                </ul>

                <!-- Contenuto dei tab -->
                <div class="tab-content" id="turniTabsContent">
                    
                    <!-- Tab Disponibilità -->
                    <div class="tab-pane fade show active p-4" id="disponibilita" role="tabpanel" aria-labelledby="disponibilita-tab">
                        <!-- Solo filtri essenziali -->
                        <div class="filter-bar card mb-4 shadow-sm">
                            <div class="card-body p-3">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="compact-search me-3">
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-search"></i>
                                            </span>
                                            <input type="text" class="form-control form-control-sm" id="searchDriver" placeholder="Cerca driver...">
                                        </div>
                                    </div>
                                    
                                    <select class="form-select form-select-sm me-3" id="filterDisponibilitaGiorno" style="max-width: 150px;">
                                        <option value="all">Tutti i giorni</option>
                                        <option value="mon">Lunedì</option>
                                        <option value="tue">Martedì</option>
                                        <option value="wed">Mercoledì</option>
                                        <option value="thu">Giovedì</option>
                                        <option value="fri">Venerdì</option>
                                        <option value="sat">Sabato</option>
                                        <option value="sun">Domenica</option>
                                    </select>
                                    
                                    <select class="form-select form-select-sm me-3" id="filterDisponibilitaFascia" style="max-width: 150px;">
                                        <option value="all">Tutte le fasce</option>
                                        <option value="mattina">Mattina</option>
                                        <option value="pranzo">Pranzo</option>
                                        <option value="pomeriggio">Pomeriggio</option>
                                        <option value="cena">Cena</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Griglia disponibilità ridisegnata con lo stile del sito -->
                        <div class="disponibilita-container">
                            <div class="card border-0 shadow-sm disponibilita-card">
                                <div class="table-responsive">
                                    <table class="table table-disponibilita mb-0">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="border-end bg-light" style="min-width: 200px; max-width: 200px; width: 200px;">Driver</th>
                                                <th class="text-gradient-light border-end">Lun <small>10/05</small></th>
                                                <th class="text-gradient-light border-end">Mar <small>11/05</small></th>
                                                <th class="text-gradient-light border-end">Mer <small>12/05</small></th>
                                                <th class="text-gradient-light border-end">Gio <small>13/05</small></th>
                                                <th class="text-gradient-light border-end">Ven <small>14/05</small></th>
                                                <th class="text-gradient-light border-end">Sab <small>15/05</small></th>
                                                <th class="text-gradient-light">Dom <small>16/05</small></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Mario Rossi -->
                                            <tr class="driver-row">
                                                <td class="border-end bg-light">
                                                    <div class="d-flex align-items-center">
                                                        <div class="driver-avatar">MR</div>
                                                        <div class="ms-2 driver-details">
                                                            <h6 class="mb-0 d-flex align-items-center">
                                                                <span class="driver-name">Mario Rossi</span>
                                                                <a href="tel:+393331234567" class="action-link ms-2" title="Chiama driver">
                                                                    <i class="fas fa-phone-alt"></i>
                                                                </a>
                                                                <a href="#" class="action-link ms-1" title="Invia WhatsApp" data-number="+393331234567">
                                                                    <i class="fab fa-whatsapp"></i>
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge available" data-bs-toggle="tooltip" title="Disponibile: Mattina">
                                                            M
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="border-end"></td>
                                                <td class="border-end"></td>
                                                <td class="border-end"></td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge available" data-bs-toggle="tooltip" title="Disponibile: Pranzo">
                                                            P
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="border-end"></td>
                                                <td>
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge assigned" data-bs-toggle="tooltip" title="Assegnato: Cena">
                                                            C
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <!-- Luca Bianchi -->
                                            <tr class="driver-row">
                                                <td class="border-end bg-light">
                                                    <div class="d-flex align-items-center">
                                                        <div class="driver-avatar">LB</div>
                                                        <div class="ms-2 driver-details">
                                                            <h6 class="mb-0 d-flex align-items-center">
                                                                <span class="driver-name">Luca Bianchi</span>
                                                                <a href="tel:+393337654321" class="action-link ms-2" title="Chiama driver">
                                                                    <i class="fas fa-phone-alt"></i>
                                                                </a>
                                                                <a href="#" class="action-link ms-1" title="Invia WhatsApp" data-number="+393337654321">
                                                                    <i class="fab fa-whatsapp"></i>
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge available" data-bs-toggle="tooltip" title="Disponibile: Mattina">
                                                            M
                                                        </span>
                                                        <span class="turno-badge assigned" data-bs-toggle="tooltip" title="Assegnato: Cena">
                                                            C
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="border-end"></td>
                                                <td class="border-end"></td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge assigned" data-bs-toggle="tooltip" title="Assegnato: Mattina">
                                                            M
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge available" data-bs-toggle="tooltip" title="Disponibile: Cena">
                                                            C
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="border-end"></td>
                                                <td></td>
                                            </tr>
                                            
                                            <!-- Paolo Verdi -->
                                            <tr class="driver-row">
                                                <td class="border-end bg-light">
                                                    <div class="d-flex align-items-center">
                                                        <div class="driver-avatar">PV</div>
                                                        <div class="ms-2 driver-details">
                                                            <h6 class="mb-0 d-flex align-items-center">
                                                                <span class="driver-name">Paolo Verdi</span>
                                                                <a href="tel:+393338765432" class="action-link ms-2" title="Chiama driver">
                                                                    <i class="fas fa-phone-alt"></i>
                                                                </a>
                                                                <a href="#" class="action-link ms-1" title="Invia WhatsApp" data-number="+393338765432">
                                                                    <i class="fab fa-whatsapp"></i>
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-end"></td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge assigned" data-bs-toggle="tooltip" title="Assegnato: Mattina">
                                                            M
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge available" data-bs-toggle="tooltip" title="Disponibile: Cena">
                                                            C
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="border-end"></td>
                                                <td class="border-end"></td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge assigned" data-bs-toggle="tooltip" title="Assegnato: Pranzo">
                                                            P
                                                        </span>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            
                                            <!-- Andrea Neri -->
                                            <tr class="driver-row">
                                                <td class="border-end bg-light">
                                                    <div class="d-flex align-items-center">
                                                        <div class="driver-avatar">AN</div>
                                                        <div class="ms-2 driver-details">
                                                            <h6 class="mb-0 d-flex align-items-center">
                                                                <span class="driver-name">Andrea Neri</span>
                                                                <a href="tel:+393339876543" class="action-link ms-2" title="Chiama driver">
                                                                    <i class="fas fa-phone-alt"></i>
                                                                </a>
                                                                <a href="#" class="action-link ms-1" title="Invia WhatsApp" data-number="+393339876543">
                                                                    <i class="fab fa-whatsapp"></i>
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge assigned" data-bs-toggle="tooltip" title="Assegnato: Pranzo">
                                                            P
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="border-end"></td>
                                                <td class="border-end"></td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge available" data-bs-toggle="tooltip" title="Disponibile: Pomeriggio">
                                                            PM
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="border-end"></td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge assigned" data-bs-toggle="tooltip" title="Assegnato: Pranzo">
                                                            P
                                                        </span>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            
                                            <!-- Anna Gialli -->
                                            <tr class="driver-row">
                                                <td class="border-end bg-light">
                                                    <div class="d-flex align-items-center">
                                                        <div class="driver-avatar">AG</div>
                                                        <div class="ms-2 driver-details">
                                                            <h6 class="mb-0 d-flex align-items-center">
                                                                <span class="driver-name">Anna Gialli</span>
                                                                <a href="tel:+393335467890" class="action-link ms-2" title="Chiama driver">
                                                                    <i class="fas fa-phone-alt"></i>
                                                                </a>
                                                                <a href="#" class="action-link ms-1" title="Invia WhatsApp" data-number="+393335467890">
                                                                    <i class="fab fa-whatsapp"></i>
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-end"></td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge available" data-bs-toggle="tooltip" title="Disponibile: Pomeriggio">
                                                            PM
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge assigned" data-bs-toggle="tooltip" title="Assegnato: Pranzo">
                                                            P
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="border-end"></td>
                                                <td class="border-end">
                                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                                        <span class="turno-badge available" data-bs-toggle="tooltip" title="Disponibile: Cena">
                                                            C
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="border-end"></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- Legenda semplificata -->
                            <div class="legenda-container mt-3">
                                <div class="card border-0 shadow-sm p-3">
                                    <div class="d-flex align-items-center flex-wrap">
                                        <span class="fw-semibold me-3">Legenda:</span>
                                        <div class="d-flex align-items-center me-3">
                                            <span class="turno-badge available me-1">M</span>
                                            <small>Mattina (9-11)</small>
                                        </div>
                                        <div class="d-flex align-items-center me-3">
                                            <span class="turno-badge available me-1">P</span>
                                            <small>Pranzo (11-15)</small>
                                        </div>
                                        <div class="d-flex align-items-center me-3">
                                            <span class="turno-badge available me-1">PM</span>
                                            <small>Pomeriggio (15-18)</small>
                                        </div>
                                        <div class="d-flex align-items-center me-3">
                                            <span class="turno-badge available me-1">C</span>
                                            <small>Cena (18-22)</small>
                                        </div>
                                        <div class="ms-auto"></div>
                                        <div class="d-flex align-items-center me-3 ms-3">
                                            <span class="turno-badge available me-1">M</span>
                                            <small class="text-success">Disponibile</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="turno-badge assigned me-1">M</span>
                                            <small class="text-primary">Assegnato</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .text-gradient-light {
                                background: -webkit-linear-gradient(135deg, rgba(255, 90, 95, 0.8) 0%, rgba(255, 143, 107, 0.8) 100%);
                                -webkit-background-clip: text;
                                -webkit-text-fill-color: transparent;
                                font-weight: 600;
                            }

                            .table-disponibilita {
                                border-collapse: separate;
                                border-spacing: 0;
                            }
                            
                            .table-disponibilita thead th {
                                font-weight: 600;
                                text-align: center;
                                padding: 12px 8px;
                                border-bottom: 2px solid #f1f5f9;
                                vertical-align: middle;
                            }
                            
                            .table-disponibilita tbody td {
                                padding: 12px 8px;
                                text-align: center;
                                vertical-align: middle;
                                border-bottom: 1px solid #f1f5f9;
                                transition: all 0.2s;
                            }
                            
                            .disponibilita-card {
                                border-radius: 10px;
                                overflow: hidden;
                            }
                            
                            .table-disponibilita .driver-row:hover td {
                                background-color: rgba(255, 90, 95, 0.04);
                            }
                            
                            .table-disponibilita .driver-avatar {
                                width: 32px;
                                height: 32px;
                                border-radius: 50%;
                                background: linear-gradient(135deg, #ff5a5f 0%, #ff8f6b 100%);
                                color: white;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-weight: 600;
                                box-shadow: 0 2px 5px rgba(255, 90, 95, 0.3);
                                font-size: 0.85rem;
                                flex-shrink: 0;
                            }
                            
                            .table-disponibilita .driver-details h6 {
                                font-weight: 600;
                                color: #334155;
                            }
                            
                            .table-disponibilita .driver-name {
                                display: inline-block;
                                max-width: 100px;
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;
                            }
                            
                            .table-disponibilita .action-link {
                                color: #64748b;
                                transition: all 0.2s;
                                font-size: 0.85rem;
                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                            }
                            
                            .table-disponibilita .action-link:hover {
                                color: #ff5a5f;
                                transform: translateY(-1px);
                            }
                            
                            .turno-badge {
                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                                width: 28px;
                                height: 28px;
                                border-radius: 50%;
                                font-weight: 600;
                                font-size: 0.75rem;
                                cursor: default;
                                transition: transform 0.2s;
                                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                            }
                            
                            .turno-badge:hover {
                                transform: scale(1.15);
                                z-index: 5;
                            }
                            
                            .turno-badge.available {
                                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                                color: white;
                            }
                            
                            .turno-badge.assigned {
                                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                                color: white;
                            }
                            
                            .legenda-container .card {
                                border-radius: 10px;
                            }
                        </style>
                    </div>

                    <!-- Tab Notifiche -->
                    <div class="tab-pane fade p-4" id="notifiche" role="tabpanel" aria-labelledby="notifiche-tab">
                        <!-- Intestazione Tab -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">Gestione Notifiche</h4>
                            <div class="notifiche-actions">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#creaNotificaModal">
                                    <i class="fas fa-plus me-2"></i> Nuova Notifica
                                </button>
                            </div>
                        </div>

                        <!-- Tipo notifiche -->
                        <ul class="nav nav-pills mb-4">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" data-notifica-tipo="tutti">Tutti</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-notifica-tipo="urgenti">Urgenti</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-notifica-tipo="sondaggi">Sondaggi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-notifica-tipo="informative">Informative</a>
                            </li>
                        </ul>

                        <!-- Elenco notifiche -->
                        <div class="notifiche-list">
                            <div class="notifica-item notifica-urgente">
                                <div class="notifica-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="notifica-content">
                                    <div class="notifica-header">
                                        <h5 class="notifica-title">Cambio turno urgente</h5>
                                        <span class="notifica-badge urgente">Urgente</span>
                                    </div>
                                    <div class="notifica-body">
                                        <p>Serve un driver sostitutivo per il turno di Paolo Verdi (Martedì, Mattina) per malattia improvvisa.</p>
                                    </div>
                                    <div class="notifica-footer">
                                        <div class="notifica-data">Inviata: 03/05/2025 08:15</div>
                                        <div class="notifica-destinatari">
                                            <span class="notifica-recipient">Mario Rossi</span>
                                            <span class="notifica-recipient">Luca Bianchi</span>
                                            <span class="notifica-recipient">Andrea Neri</span>
                                            <span class="notifica-recipient more">+1</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="notifica-actions">
                                    <div class="notifica-stato success">
                                        <i class="fas fa-check me-1"></i> Completata
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary notifica-dettagli">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info notifica-resend">
                                            <i class="fas fa-redo-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="notifica-item notifica-sondaggio">
                                <div class="notifica-icon">
                                    <i class="fas fa-poll"></i>
                                </div>
                                <div class="notifica-content">
                                    <div class="notifica-header">
                                        <h5 class="notifica-title">Sondaggio disponibilità weekend</h5>
                                        <span class="notifica-badge sondaggio">Sondaggio</span>
                                    </div>
                                    <div class="notifica-body">
                                        <p>Sondaggio per raccogliere disponibilità per turni extra nel weekend 17-18 Maggio per evento speciale.</p>
                                    </div>
                                    <div class="notifica-footer">
                                        <div class="notifica-data">Inviata: 01/05/2025 14:30</div>
                                        <div class="notifica-destinatari">
                                            <span class="notifica-recipient">Tutti i driver</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="notifica-actions">
                                    <div class="notifica-stato warning">
                                        <i class="fas fa-clock me-1"></i> In attesa
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary notifica-dettagli">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info notifica-resend">
                                            <i class="fas fa-redo-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="notifica-item notifica-informativa">
                                <div class="notifica-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="notifica-content">
                                    <div class="notifica-header">
                                        <h5 class="notifica-title">Nuove regole per le consegne</h5>
                                        <span class="notifica-badge informativa">Informativa</span>
                                    </div>
                                    <div class="notifica-body">
                                        <p>A partire dal 15 Maggio entreranno in vigore nuove regole per le procedure di consegna. Consulta il manuale allegato.</p>
                                    </div>
                                    <div class="notifica-footer">
                                        <div class="notifica-data">Inviata: 29/04/2025 10:00</div>
                                        <div class="notifica-destinatari">
                                            <span class="notifica-recipient">Tutti i driver</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="notifica-actions">
                                    <div class="notifica-stato success">
                                        <i class="fas fa-check me-1"></i> Completata
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary notifica-dettagli">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info notifica-resend">
                                            <i class="fas fa-redo-alt"></i>
                                        </button>
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

<!-- Modal per creare un nuovo turno -->
<div class="modal fade" id="creaTurnoModal" tabindex="-1" aria-labelledby="creaTurnoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header position-relative p-0 border-0">
                <div class="modal-header-bg w-100"></div>
                <div class="modal-title-container p-3 position-relative w-100 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title d-flex align-items-center" id="creaTurnoModalLabel">
                        <span class="modal-icon-wrapper me-2">
                            <i class="fas fa-plus"></i>
                        </span>
                        Crea Nuovo Turno
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <form id="newTurnoForm">
                    <div class="mb-3">
                        <label for="turnoDriver" class="form-label fw-semibold">Driver</label>
                        <select id="turnoDriver" class="form-select">
                            <option value="">Seleziona un driver</option>
                            <option value="1">Mario Rossi</option>
                            <option value="2">Luca Bianchi</option>
                            <option value="3">Paolo Verdi</option>
                            <option value="4">Andrea Neri</option>
                            <option value="5">Anna Gialli</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="turnoGiorno" class="form-label fw-semibold">Giorno</label>
                        <select id="turnoGiorno" class="form-select">
                            <option value="mon">Lunedì</option>
                            <option value="tue">Martedì</option>
                            <option value="wed">Mercoledì</option>
                            <option value="thu">Giovedì</option>
                            <option value="fri">Venerdì</option>
                            <option value="sat">Sabato</option>
                            <option value="sun">Domenica</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="turnoFascia" class="form-label fw-semibold">Fascia Oraria</label>
                        <select id="turnoFascia" class="form-select">
                            <option value="mattina">Mattina (9:00 - 11:00)</option>
                            <option value="pranzo">Pranzo (11:00 - 15:00)</option>
                            <option value="pomeriggio">Pomeriggio (15:00 - 18:00)</option>
                            <option value="cena">Cena (18:00 - 22:00)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="turnoNote" class="form-label fw-semibold">Note (opzionale)</label>
                        <textarea id="turnoNote" class="form-control" rows="3" placeholder="Inserisci eventuali note..."></textarea>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="notificaDriver">
                        <label class="form-check-label" for="notificaDriver">
                            Notifica il driver via WhatsApp
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light driver-modal-button" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary driver-modal-button" id="salvaTurno">
                    <i class="fas fa-save me-2"></i> Salva Turno
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal per creare una nuova notifica -->
<div class="modal fade" id="creaNotificaModal" tabindex="-1" aria-labelledby="creaNotificaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header position-relative p-0 border-0">
                <div class="modal-header-bg w-100"></div>
                <div class="modal-title-container p-3 position-relative w-100 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title d-flex align-items-center" id="creaNotificaModalLabel">
                        <span class="modal-icon-wrapper me-2">
                            <i class="fas fa-bell"></i>
                        </span>
                        Crea Nuova Notifica
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <form id="newNotificaForm">
                    <div class="mb-3">
                        <label for="notificaTitolo" class="form-label fw-semibold">Titolo</label>
                        <input type="text" class="form-control" id="notificaTitolo" placeholder="Inserisci un titolo...">
                    </div>
                    <div class="mb-3">
                        <label for="notificaTipo" class="form-label fw-semibold">Tipo di notifica</label>
                        <select id="notificaTipo" class="form-select">
                            <option value="urgente">Urgente</option>
                            <option value="sondaggio">Sondaggio</option>
                            <option value="informativa">Informativa</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="notificaMessaggio" class="form-label fw-semibold">Messaggio</label>
                        <textarea id="notificaMessaggio" class="form-control" rows="4" placeholder="Inserisci il testo della notifica..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Destinatari</label>
                        <div class="destinatari-container p-3 border rounded mb-2">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="tuttiDrivers">
                                <label class="form-check-label" for="tuttiDrivers">
                                    Tutti i driver
                                </label>
                            </div>
                            <div class="driver-list" id="driverList">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="driver[]" id="driver1" value="1">
                                    <label class="form-check-label" for="driver1">
                                        Mario Rossi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="driver[]" id="driver2" value="2">
                                    <label class="form-check-label" for="driver2">
                                        Luca Bianchi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="driver[]" id="driver3" value="3">
                                    <label class="form-check-label" for="driver3">
                                        Paolo Verdi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="driver[]" id="driver4" value="4">
                                    <label class="form-check-label" for="driver4">
                                        Andrea Neri
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="driver[]" id="driver5" value="5">
                                    <label class="form-check-label" for="driver5">
                                        Anna Gialli
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="richiestaRisposta">
                            <label class="form-check-label" for="richiestaRisposta">
                                Richiedi conferma di lettura
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light driver-modal-button" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary driver-modal-button" id="salvaNotifica">
                    <i class="fas fa-paper-plane me-2"></i> Invia Notifica
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal per il link di disponibilità -->
<div class="modal fade" id="linkDisponibilitaModal" tabindex="-1" aria-labelledby="linkDisponibilitaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header position-relative p-0 border-0">
                <div class="modal-header-bg w-100"></div>
                <div class="modal-title-container p-3 position-relative w-100 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title d-flex align-items-center" id="linkDisponibilitaModalLabel">
                        <span class="modal-icon-wrapper me-2">
                            <i class="fas fa-link"></i>
                        </span>
                        Link Disponibilità
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-info d-flex">
                    <i class="fas fa-info-circle me-2 mt-1"></i>
                    <div>
                        Questo link può essere condiviso con i driver per far inserire le loro disponibilità settimanali.
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="disponibilitaLink" value="https://lenny.it/disponibilita?token=AB12CD34" readonly>
                    <button class="btn btn-outline-primary" type="button" id="copyLink">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="form-group">
                        <label class="form-label fw-semibold">Scadenza link</label>
                        <div class="d-flex align-items-center">
                            <select class="form-select me-2" id="expirationType">
                                <option value="7">7 giorni</option>
                                <option value="14">14 giorni</option>
                                <option value="30">30 giorni</option>
                                <option value="0">Nessuna scadenza</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-outline-primary" id="regenerateLink">
                            <i class="fas fa-sync-alt me-2"></i> Rigenera
                        </button>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="form-label fw-semibold">Condividi via WhatsApp</label>
                    <div class="d-flex align-items-center">
                        <select class="form-select flex-grow-1 me-2" id="whatsappTarget">
                            <option value="all">Tutti i driver</option>
                            <option value="1">Mario Rossi</option>
                            <option value="2">Luca Bianchi</option>
                            <option value="3">Paolo Verdi</option>
                            <option value="4">Andrea Neri</option>
                            <option value="5">Anna Gialli</option>
                        </select>
                        <button class="btn btn-success" id="sendWhatsapp">
                            <i class="fab fa-whatsapp me-2"></i> Invia
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light driver-modal-button" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<!-- Caricamento script -->
<script src="<?= asset('js/4-components/drivers/gestione-turni-driver.js') ?>"></script>

<?php require_once 'views/layout/footer.php'; ?>