<?php require_once 'views/layout/header.php'; ?>

<div class="section-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="section-title">Gestione Avanzata Turni</h2>
        <p class="section-subtitle">Configura e gestisci i turni dei driver con funzionalità avanzate</p>
    </div>
    <div>
        <a href="<?php echo url('drivers', 'turni'); ?>" class="btn btn-sm btn-primary">
            <i class="fas fa-arrow-left me-1"></i> Torna ai Turni
        </a>
    </div>
</div>

<!-- Tab Gestione Turni -->
<div class="tab-pane fade show active p-4" id="turni" role="tabpanel" aria-labelledby="turni-tab">
    <!-- Intestazione Tab -->    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <!-- Pulsanti per cambio vista in formato pillola come nella dashboard -->
            <div class="period-filter me-3">
                <button class="period-btn active" data-view="week">Settimanale</button>
                <button class="period-btn" data-view="day">Giornaliera</button>
            </div>
        </div>
        <div>
            <button class="btn btn-primary btn-action" data-bs-toggle="modal" data-bs-target="#creaTurnoModal">
                <i class="fas fa-plus me-2"></i> Nuovo Turno
            </button>
            <button class="btn btn-outline-primary ms-2" id="generaLinkDisponibilita">
                <i class="fas fa-link me-2"></i> Link Disponibilità
            </button>
        </div>
    </div>

    <!-- Intestazione settimanale migliorata -->
    <div class="week-header-container mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <button class="btn btn-lg btn-outline-primary border-0 prev-period">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="week-info text-center">
                        <h3 class="mb-1 fw-bold week-title">Settimana 5 - 11 Maggio 2025</h3>
                    </div>
                    <button class="btn btn-lg btn-outline-primary border-0 next-period">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Vista Settimanale -->
    <div id="weeklyView" class="shift-view active">
        <div class="turni-table-container">
            <table class="table table-bordered table-turni">
                <thead>
                    <tr>
                        <th width="12%">Fascia Oraria</th>
                        <th width="12%">Lunedì<br><small>10/05</small></th>
                        <th width="12%">Martedì<br><small>11/05</small></th>
                        <th width="12%">Mercoledì<br><small>12/05</small></th>
                        <th width="12%">Giovedì<br><small>13/05</small></th>
                        <th width="12%">Venerdì<br><small>14/05</small></th>
                        <th width="12%">Sabato<br><small>15/05</small></th>
                        <th width="12%">Domenica<br><small>16/05</small></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <div class="shift-time">
                                <span class="shift-name">Mattina</span>
                                <span class="shift-hours">9:00 - 11:00</span>
                            </div>
                        </th>
                        <td class="shift-cell" data-day="mon" data-shift="mattina">
                            <div class="driver-shift available" draggable="true" data-driver-id="1">
                                <div class="driver-name">Mario Rossi</div>
                                <div class="driver-status">Disponibile</div>
                            </div>
                            <div class="driver-shift available" draggable="true" data-driver-id="2">
                                <div class="driver-name">Luca Bianchi</div>
                                <div class="driver-status">Disponibile</div>
                            </div>
                            <div class="shift-vacancy">
                                <span class="shift-vacancy-icon">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                            </div>
                        </td>
                        <!-- ... altre celle della riga ... -->
                        <td class="shift-cell" data-day="tue" data-shift="mattina">
                            <div class="driver-shift warning" draggable="true" data-driver-id="3">
                                <div class="driver-name">Paolo Verdi</div>
                                <div class="driver-status">Sovraccarico</div>
                            </div>
                            <div class="shift-vacancy">
                                <span class="shift-vacancy-icon">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                            </div>
                        </td>
                        <td class="shift-cell" data-day="wed" data-shift="mattina"></td>
                        <td class="shift-cell" data-day="thu" data-shift="mattina">
                            <div class="driver-shift danger" draggable="true" data-driver-id="2">
                                <div class="driver-name">Luca Bianchi</div>
                                <div class="driver-status">Carenza</div>
                            </div>
                        </td>
                        <td class="shift-cell" data-day="fri" data-shift="mattina">
                            <div class="driver-shift custom-time" draggable="true" data-driver-id="5">
                                <div class="driver-name">Anna Gialli</div>
                                <div class="driver-custom-time">10:30 - 12:30</div>
                            </div>
                        </td>
                        <td class="shift-cell" data-day="sat" data-shift="mattina"></td>
                        <td class="shift-cell" data-day="sun" data-shift="mattina"></td>
                    </tr>
                    <!-- ... altre righe per pranzo, pomeriggio e cena ... -->
                    <tr>
                        <th>
                            <div class="shift-time">
                                <span class="shift-name">Pranzo</span>
                                <span class="shift-hours">11:00 - 15:00</span>
                            </div>
                        </th>
                        <td class="shift-cell" data-day="mon" data-shift="pranzo">
                            <div class="driver-shift available" draggable="true" data-driver-id="4">
                                <div class="driver-name">Andrea Neri</div>
                                <div class="driver-status">Disponibile</div>
                            </div>
                            <div class="shift-vacancy">
                                <span class="shift-vacancy-icon">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                            </div>
                        </td>
                        <td class="shift-cell" data-day="tue" data-shift="pranzo"></td>
                        <td class="shift-cell" data-day="wed" data-shift="pranzo">
                            <div class="driver-shift available" draggable="true" data-driver-id="5">
                                <div class="driver-name">Anna Gialli</div>
                                <div class="driver-status">Disponibile</div>
                            </div>
                        </td>
                        <td class="shift-cell" data-day="thu" data-shift="pranzo"></td>
                        <td class="shift-cell" data-day="fri" data-shift="pranzo">
                            <div class="driver-shift available" draggable="true" data-driver-id="1">
                                <div class="driver-name">Mario Rossi</div>
                                <div class="driver-status">Disponibile</div>
                            </div>
                        </td>
                        <td class="shift-cell" data-day="sat" data-shift="pranzo">
                            <div class="driver-shift warning" draggable="true" data-driver-id="3">
                                <div class="driver-name">Paolo Verdi</div>
                                <div class="driver-status">Sovraccarico</div>
                            </div>
                            <div class="driver-shift warning" draggable="true" data-driver-id="4">
                                <div class="driver-name">Andrea Neri</div>
                                <div class="driver-status">Sovraccarico</div>
                            </div>
                        </td>
                        <td class="shift-cell" data-day="sun" data-shift="pranzo"></td>
                    </tr>
                    <tr>
                        <th>
                            <div class="shift-time">
                                <span class="shift-name">Pomeriggio</span>
                                <span class="shift-hours">15:00 - 18:00</span>
                            </div>
                        </th>
                        <td class="shift-cell" data-day="mon" data-shift="pomeriggio"></td>
                        <td class="shift-cell" data-day="tue" data-shift="pomeriggio">
                            <div class="driver-shift available" draggable="true" data-driver-id="5">
                                <div class="driver-name">Anna Gialli</div>
                                <div class="driver-status">Disponibile</div>
                            </div>
                        </td>
                        <td class="shift-cell" data-day="wed" data-shift="pomeriggio"></td>
                        <td class="shift-cell" data-day="thu" data-shift="pomeriggio">
                            <div class="driver-shift available" draggable="true" data-driver-id="4">
                                <div class="driver-name">Andrea Neri</div>
                                <div class="driver-status">Disponibile</div>
                            </div>
                        </td>
                        <td class="shift-cell" data-day="fri" data-shift="pomeriggio"></td>
                        <td class="shift-cell" data-day="sat" data-shift="pomeriggio"></td>
                        <td class="shift-cell" data-day="sun" data-shift="pomeriggio"></td>
                    </tr>
                    <tr>
                        <th>
                            <div class="shift-time">
                                <span class="shift-name">Cena</span>
                                <span class="shift-hours">18:00 - 22:00</span>
                            </div>
                        </th>
                        <td class="shift-cell" data-day="mon" data-shift="cena">
                            <div class="driver-shift available" draggable="true" data-driver-id="2">
                                <div class="driver-name">Luca Bianchi</div>
                                <div class="driver-status">Disponibile</div>
                            </div>
                        </td>
                        <td class="shift-cell" data-day="tue" data-shift="cena"></td>
                        <td class="shift-cell" data-day="wed" data-shift="cena">
                            <div class="driver-shift available" draggable="true" data-driver-id="3">
                                <div class="driver-name">Paolo Verdi</div>
                                <div class="driver-status">Disponibile</div>
                            </div>
                        </td>
                        <td class="shift-cell" data-day="thu" data-shift="cena"></td>
                        <td class="shift-cell" data-day="fri" data-shift="cena">
                            <div class="driver-shift available" draggable="true" data-driver-id="5">
                                <div class="driver-name">Anna Gialli</div>
                                <div class="driver-status">Disponibile</div>
                            </div>
                            <div class="driver-shift available" draggable="true" data-driver-id="2">
                                <div class="driver-name">Luca Bianchi</div>
                                <div class="driver-status">Disponibile</div>
                            </div>
                        </td>
                        <td class="shift-cell" data-day="sat" data-shift="cena">
                            <div class="driver-shift danger" draggable="true" data-driver-id="1">
                                <div class="driver-name">Mario Rossi</div>
                                <div class="driver-status">Carenza</div>
                            </div>
                        </td>
                        <td class="shift-cell" data-day="sun" data-shift="cena"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>    <!-- Vista Giornaliera -->    <div id="dailyView" class="shift-view">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Filtro delle fasce orarie rimosso come richiesto -->
        </div>

        <div class="daily-shift-container">
            <div class="daily-shift-card shadow-hover">
                <div class="shift-header">
                    <h5 class="d-flex align-items-center">
                        <span class="icon-circle-sm bg-primary-light text-primary me-2">
                            <i class="fas fa-sun"></i>
                        </span>
                        Mattina - 9:00 - 11:00
                    </h5>
                    <span class="badge-pill bg-primary-light text-primary">2 driver</span>
                </div>
                <div class="shift-drivers-list">                    <div class="driver-shift-detail available" draggable="true" data-driver-id="1">
                        <div class="driver-info">
                            <div class="driver-name">Mario Rossi</div>
                        </div>
                        <div class="driver-status">Disponibile</div>                        <div class="action-buttons daily-action-buttons">
                            <div class="action-row">
                                <a href="tel:+393331234567" class="phone-btn" title="Chiama driver">
                                    <i class="fas fa-phone-alt"></i>
                                </a>
                                <a href="#" class="whatsapp-btn" data-number="+393331234567" title="Scrivi su WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                            <div class="action-row">
                                <button class="edit-shift-btn" title="Modifica turno">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="delete-shift-btn" title="Elimina turno">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>                    <div class="driver-shift-detail available" draggable="true" data-driver-id="2">                        <div class="driver-info">
                            <div class="driver-name">Luca Bianchi</div>
                        </div>
                        <div class="driver-status">Disponibile</div>
                        <div class="action-buttons daily-action-buttons">
                            <div class="action-row">
                                <a href="tel:+393337654321" class="phone-btn" title="Chiama driver">
                                    <i class="fas fa-phone-alt"></i>
                                </a>
                                <a href="#" class="whatsapp-btn" data-number="+393337654321" title="Scrivi su WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                            <div class="action-row">
                                <button class="edit-shift-btn" title="Modifica turno">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="delete-shift-btn" title="Elimina turno">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="add-driver-placeholder">
                        <button class="btn btn-sm btn-gradient-primary add-driver">
                            <i class="fas fa-plus me-2"></i> Aggiungi driver
                        </button>
                    </div>
                </div>
            </div>

            <div class="daily-shift-card shadow-hover">
                <div class="shift-header">
                    <h5 class="d-flex align-items-center">
                        <span class="icon-circle-sm bg-warning-light text-warning me-2">
                            <i class="fas fa-utensils"></i>
                        </span>
                        Pranzo - 11:00 - 15:00
                    </h5>
                    <span class="badge-pill bg-primary-light text-primary">1 driver</span>
                </div>
                <div class="shift-drivers-list">                    <div class="driver-shift-detail available" draggable="true" data-driver-id="4">
                        <div class="driver-info">
                            <div class="driver-name">Andrea Neri</div>
                        </div>
                        <div class="driver-status">Disponibile</div>
                        <div class="action-buttons daily-action-buttons">
                            <div class="action-row">
                                <a href="tel:+393339876543" class="phone-btn" title="Chiama driver">
                                    <i class="fas fa-phone-alt"></i>
                                </a>
                                <a href="#" class="whatsapp-btn" data-number="+393339876543" title="Scrivi su WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                            <div class="action-row">
                                <button class="edit-shift-btn" title="Modifica turno">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="delete-shift-btn" title="Elimina turno">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="add-driver-placeholder">
                        <button class="btn btn-sm btn-gradient-primary add-driver">
                            <i class="fas fa-plus me-2"></i> Aggiungi driver
                        </button>
                    </div>
                </div>
            </div>

            <div class="daily-shift-card shadow-hover empty">
                <div class="shift-header">
                    <h5 class="d-flex align-items-center">
                        <span class="icon-circle-sm bg-info-light text-info me-2">
                            <i class="fas fa-cloud-sun"></i>
                        </span>
                        Pomeriggio - 15:00 - 18:00
                    </h5>
                    <span class="badge-pill bg-secondary-light text-secondary">Nessun driver</span>
                </div>
                <div class="shift-drivers-list">
                    <div class="empty-shift-message">
                        Nessun driver assegnato a questo turno
                    </div>
                    <div class="add-driver-placeholder">
                        <button class="btn btn-sm btn-gradient-primary add-driver">
                            <i class="fas fa-plus me-2"></i> Aggiungi driver
                        </button>
                    </div>
                </div>
            </div>

            <div class="daily-shift-card shadow-hover">
                <div class="shift-header">
                    <h5 class="d-flex align-items-center">
                        <span class="icon-circle-sm bg-danger-light text-danger me-2">
                            <i class="fas fa-moon"></i>
                        </span>
                        Cena - 18:00 - 22:00
                    </h5>
                    <span class="badge-pill bg-primary-light text-primary">1 driver</span>
                </div>                <div class="shift-drivers-list">                    <div class="driver-shift-detail available" draggable="true" data-driver-id="2">
                        <div class="driver-info">
                            <div class="driver-name">Luca Bianchi</div>
                        </div>
                        <div class="driver-status">Disponibile</div>
                        <div class="action-buttons daily-action-buttons">
                            <div class="action-row">
                                <a href="tel:+393337654321" class="phone-btn" title="Chiama driver">
                                    <i class="fas fa-phone-alt"></i>
                                </a>
                                <a href="#" class="whatsapp-btn" data-number="+393337654321" title="Scrivi su WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                            <div class="action-row">
                                <button class="edit-shift-btn" title="Modifica turno">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="delete-shift-btn" title="Elimina turno">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="add-driver-placeholder">
                        <button class="btn btn-sm btn-gradient-primary add-driver">
                            <i class="fas fa-plus me-2"></i> Aggiungi driver
                        </button>
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
                    </div>                    <div class="mb-3">
                        <label for="turnoFascia" class="form-label fw-semibold">Fascia Oraria</label>
                        <select id="turnoFascia" class="form-select">
                            <option value="mattina">Mattina (9:00 - 11:00)</option>
                            <option value="pranzo">Pranzo (11:00 - 15:00)</option>
                            <option value="pomeriggio">Pomeriggio (15:00 - 18:00)</option>
                            <option value="cena">Cena (18:00 - 22:00)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="orarioPersonalizzato">
                            <label class="form-check-label fw-semibold" for="orarioPersonalizzato">
                                Orario personalizzato
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 row d-none" id="orariPersonalizzatiContainer">
                        <div class="col-6">
                            <label for="orarioInizio" class="form-label">Orario inizio</label>
                            <input type="time" class="form-control" id="orarioInizio">
                        </div>
                        <div class="col-6">
                            <label for="orarioFine" class="form-label">Orario fine</label>
                            <input type="time" class="form-control" id="orarioFine">
                        </div>
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

<!-- Modal per modificare un turno -->
<div class="modal fade" id="modificaTurnoModal" tabindex="-1" aria-labelledby="modificaTurnoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header position-relative p-0 border-0">
                <div class="modal-header-bg w-100"></div>
                <div class="modal-title-container p-3 position-relative w-100 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title d-flex align-items-center" id="modificaTurnoModalLabel">
                        <span class="modal-icon-wrapper me-2">
                            <i class="fas fa-edit"></i>
                        </span>
                        Modifica Turno
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <form id="editTurnoForm">
                    <input type="hidden" id="editDriverId">
                    <div class="mb-3">
                        <label for="editDriverName" class="form-label fw-semibold">Driver</label>
                        <input type="text" class="form-control bg-light" id="editDriverName" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editTurnoGiorno" class="form-label fw-semibold">Giorno</label>
                        <select id="editTurnoGiorno" class="form-select">
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
                        <label for="editTurnoFascia" class="form-label fw-semibold">Fascia Oraria</label>
                        <select id="editTurnoFascia" class="form-select">
                            <option value="mattina">Mattina (9:00 - 11:00)</option>
                            <option value="pranzo">Pranzo (11:00 - 15:00)</option>
                            <option value="pomeriggio">Pomeriggio (15:00 - 18:00)</option>
                            <option value="cena">Cena (18:00 - 22:00)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="editOrarioPersonalizzato">
                            <label class="form-check-label fw-semibold" for="editOrarioPersonalizzato">
                                Orario personalizzato
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 row d-none" id="editOrariPersonalizzatiContainer">
                        <div class="col-6">
                            <label for="editOrarioInizio" class="form-label">Orario inizio</label>
                            <input type="time" class="form-control" id="editOrarioInizio">
                        </div>
                        <div class="col-6">
                            <label for="editOrarioFine" class="form-label">Orario fine</label>
                            <input type="time" class="form-control" id="editOrarioFine">
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="editNotificaDriver">
                        <label class="form-check-label" for="editNotificaDriver">
                            Notifica il driver via WhatsApp
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light driver-modal-button" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary driver-modal-button" id="aggiornaTurno">
                    <i class="fas fa-save me-2"></i> Aggiorna Turno
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

<?php require_once 'views/layout/footer.php'; ?>