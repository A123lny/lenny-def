<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center mb-4">
                    <span class="icon-circle bg-primary-light driver-text-primary me-2">
                        <i class="fas fa-info-circle"></i>
                    </span>
                    Informazioni Personali
                </h5>
                
                <div class="row">
                    <div class="col-md-3 text-center mb-4 mb-md-0">
                        <div class="profile-image-container mx-auto">
                            <div class="profile-image-wrapper">
                                <img id="editDriverPhoto" src="<?= asset('images/profilo.jpg') ?>" alt="Foto profilo" class="rounded-circle profile-image">
                            </div>
                            <div class="upload-overlay">
                                <label for="editPhotoUpload" class="upload-button">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <input type="file" id="editPhotoUpload" accept="image/*" style="display: none;">
                            </div>
                        </div>
                        
                        <div class="mt-3 mb-3">
                            <div class="form-check form-switch d-flex justify-content-center align-items-center">
                                <input class="form-check-input me-2" type="checkbox" id="editDriverActiveStatus" checked>
                                <label class="form-check-label" for="editDriverActiveStatus">
                                    <span class="status-badge status-active">Driver attivo</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editDriverName" class="detail-label">Nome</label>
                                    <input type="text" class="form-control" id="editDriverName" placeholder="Nome">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editDriverSurname" class="detail-label">Cognome</label>
                                    <input type="text" class="form-control" id="editDriverSurname" placeholder="Cognome">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editContractType" class="detail-label">Tipo Contratto</label>
                                    <select class="form-select" id="editContractType">
                                        <option value="indeterminato">Indeterminato</option>
                                        <option value="determinato">Determinato</option>
                                        <option value="occasionale">Occasionale</option>
                                        <option value="part-time">Part-Time</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editDriverEmail" class="detail-label">Email</label>
                                    <input type="email" class="form-control" id="editDriverEmail" placeholder="email@esempio.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editDriverPhone" class="detail-label">Telefono</label>
                                    <input type="tel" class="form-control" id="editDriverPhone" placeholder="Numero di telefono">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editDriverBirthdate" class="detail-label">Data di Nascita</label>
                                    <input type="date" class="form-control" id="editDriverBirthdate">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editDriverTaxCode" class="detail-label">Codice Fiscale</label>
                                    <input type="text" class="form-control" id="editDriverTaxCode" placeholder="Codice Fiscale">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editDriverAddress" class="detail-label">Indirizzo</label>
                                    <input type="text" class="form-control" id="editDriverAddress" placeholder="Indirizzo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editContractStart" class="detail-label">Data Assunzione</label>
                                    <input type="date" class="form-control" id="editContractStart">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button id="saveDriverInfo" class="btn btn-primary btn-sm driver-modal-button">
                                <i class="fas fa-save me-2"></i>Salva Modifiche
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center">
                    <span class="icon-circle bg-info-light driver-text-info me-2">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    Documenti
                </h5>
                <div class="table-responsive custom-table-container mt-3">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Numero</th>
                                <th>Scadenza</th>
                                <th>Stato</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="icon-circle bg-primary-soft driver-text-primary me-2" style="width: 24px; height: 24px;">
                                            <i class="fas fa-id-card fa-sm"></i>
                                        </span>
                                        <span>Patente</span>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" value="AB1234567">
                                </td>
                                <td>
                                    <input type="date" class="form-control form-control-sm" value="2028-05-15">
                                </td>
                                <td>
                                    <select class="form-select form-select-sm">
                                        <option value="valid" selected>Valido</option>
                                        <option value="expiring">In Scadenza</option>
                                        <option value="expired">Scaduto</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Visualizza">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="action-btn edit-btn" data-bs-toggle="tooltip" title="Modifica">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Scarica">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="icon-circle bg-info-soft driver-text-info me-2" style="width: 24px; height: 24px;">
                                            <i class="fas fa-passport fa-sm"></i>
                                        </span>
                                        <span>Carta d'Identità</span>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" value="CA12345BB">
                                </td>
                                <td>
                                    <input type="date" class="form-control form-control-sm" value="2030-10-10">
                                </td>
                                <td>
                                    <select class="form-select form-select-sm">
                                        <option value="valid" selected>Valido</option>
                                        <option value="expiring">In Scadenza</option>
                                        <option value="expired">Scaduto</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Visualizza">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="action-btn edit-btn" data-bs-toggle="tooltip" title="Modifica">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Scarica">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button id="saveDocuments" class="btn btn-primary btn-sm driver-modal-button me-2">
                        <i class="fas fa-save me-2"></i>Salva Modifiche
                    </button>
                    <button id="addDocument" class="btn btn-primary btn-sm driver-modal-button">
                        <i class="fas fa-plus me-2"></i>Aggiungi Documento
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center">
                    <span class="icon-circle bg-warning-light driver-text-warning me-2">
                        <i class="fas fa-comment-alt"></i>
                    </span>
                    Note
                </h5>
                <div class="mt-3">
                    <textarea id="editDriverNotes" class="form-control" rows="4" placeholder="Inserisci note sul driver..."></textarea>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">Ultima modifica: <span id="lastNoteUpdate">08/05/2025, 10:30</span></small>
                        <button id="saveDriverNotes" class="btn btn-primary btn-sm driver-modal-button">
                            <i class="fas fa-check me-2"></i>Conferma Nota
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Profile styles */
    .profile-card {
        overflow: hidden;
    }
    
    .profile-banner {
        height: 80px;
        background: linear-gradient(90deg, rgba(91,134,229,0.8) 0%, rgba(54,209,220,0.8) 100%);
        background-size: cover;
    }
    
    .profile-image-container {
        position: relative;
        width: 120px;
        height: 120px;
        margin-top: -60px;
    }
    
    .profile-image-wrapper {
        width: 100%;
        height: 100%;
        border: 5px solid #fff;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .upload-overlay {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: #36D1DC;
        color: white;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    
    .upload-overlay:hover {
        background-color: #5B86E5;
        transform: scale(1.1);
    }
    
    /* Editable field styles */
    .editable-field {
        position: relative;
    }
    
    .editable-field .edit-indicator {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        color: #64748b;
        font-size: 0.9rem;
        cursor: pointer;
    }
    
    .editable-field .edit-indicator:hover {
        color: #5B86E5;
    }
    
    /* Status badge */
    .status-badge {
        display: inline-block;
        padding: 0.35em 0.8em;
        font-size: 0.75em;
        font-weight: 600;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 50rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-active {
        background-color: rgba(0, 214, 143, 0.1);
        color: #00d68f;
    }
    
    /* Form styles */
    .detail-label {
        font-size: 0.75rem;
        color: #64748b;
        margin-bottom: 0.25rem;
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
        background-color: #f9fafb;
        color: #64748b;
        font-weight: 600;
        border: none;
        padding: 12px 15px;
    }
    
    .custom-table tbody td {
        border-color: #f0f0f0;
        padding: 12px 15px;
        vertical-align: middle;
    }
    
    /* Action buttons */
    .driver-action-buttons {
        display: flex;
        gap: 5px;
    }
    
    .driver-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 6px;
        color: #64748b;
        transition: all 0.2s ease;
    }
    
    .driver-upload-btn:hover {
        background-color: rgba(54, 209, 220, 0.1);
        color: #36D1DC;
    }
    
    .driver-delete-btn:hover {
        background-color: rgba(244, 67, 54, 0.1);
        color: #f44336;
    }
    
    /* Modal action buttons */
    #editDriverModal .action-btn {
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
    
    #editDriverModal .action-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 3px 6px rgba(0,0,0,0.15);
        color: white;
    }
    
    /* Pulsante visualizza */
    #editDriverModal .view-btn {
        background: linear-gradient(135deg, #ff5a5f 0%, #ff8f6b 100%);
    }
    
    #editDriverModal .view-btn:hover {
        background: linear-gradient(135deg, #ff5a5f 0%, #ff8f6b 100%);
    }
    
    /* Pulsante scarica */
    #editDriverModal .download-btn {
        background: linear-gradient(135deg, #36D1DC 0%, #5B86E5 100%);
    }
    
    #editDriverModal .download-btn:hover {
        background: linear-gradient(135deg, #36D1DC 0%, #5B86E5 100%);
    }
    
    /* Pulsante modifica */
    #editDriverModal .edit-btn {
        background: linear-gradient(135deg, #FFA500 0%, #FFD700 100%);
    }
    
    #editDriverModal .edit-btn:hover {
        background: linear-gradient(135deg, #FFA500 0%, #FFD700 100%);
    }
    
    /* Notes section */
    .input-group {
        display: flex;
        align-items: stretch;
    }
    
    .notes-actions {
        margin-left: 10px;
    }
    
    .save-note-btn {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: linear-gradient(135deg, #00d68f 0%, #00a2c0 100%);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }
    
    .save-note-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 3px 6px rgba(0, 214, 143, 0.2);
    }
    
    /* Color variations */
    .bg-primary-soft {
        background-color: rgba(91, 134, 229, 0.1);
    }
    
    .bg-info-soft {
        background-color: rgba(54, 209, 220, 0.1);
    }
    
    .driver-text-primary {
        color: #5B86E5;
    }
    
    .driver-text-info {
        color: #36D1DC;
    }
    
    .bg-warning-light {
        background-color: rgba(255, 170, 0, 0.1);
    }
    
    .driver-text-warning {
        color: #FFA500;
    }
</style>