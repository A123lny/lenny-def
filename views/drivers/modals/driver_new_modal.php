<?php
/**
 * Modal wizard per la creazione di un nuovo driver
 * Questo file contiene il codice HTML per il modale che permette di inserire un nuovo driver
 */
?>
<!-- Modal Nuovo Driver Wizard -->
<div class="modal fade" id="newDriverModal" tabindex="-1" aria-labelledby="newDriverModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header position-relative p-0">
                <div class="modal-header-bg w-100"></div>
                <div class="modal-title-container p-3 position-relative w-100 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title d-flex align-items-center" id="newDriverModalLabel">
                        <span class="wizard-icon-wrapper me-2">
                            <i class="fas fa-user-plus"></i>
                        </span>
                        Nuovo Driver
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0">
                <!-- Progress Wizard -->
                <div class="wizard-progress-container py-2 px-3 mb-4 bg-light rounded">
                    <div class="wizard-progress">
                        <div class="progress-step active" data-step="1">
                            <div class="step-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="step-label">Anagrafica</div>
                        </div>
                        <div class="progress-step" data-step="2">
                            <div class="step-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <div class="step-label">Documenti</div>
                        </div>
                        <div class="progress-step" data-step="3">
                            <div class="step-icon">
                                <i class="fas fa-money-bill"></i>
                            </div>
                            <div class="step-label">Pagamenti</div>
                        </div>
                        <div class="progress-step" data-step="4">
                            <div class="step-icon">
                                <i class="fas fa-motorcycle"></i>
                            </div>
                            <div class="step-label">Mezzi</div>
                        </div>
                        <div class="progress-step" data-step="5">
                            <div class="step-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="step-label">Riepilogo</div>
                        </div>
                    </div>
                </div>
                
                <form id="newDriverForm" class="needs-validation" novalidate>
                    <!-- Step 1: Anagrafica -->
                    <div class="wizard-step active" id="step1">
                        <div class="p-4">
                            <h5 class="mb-4">
                                <span class="wizard-circle-icon me-2">
                                    <i class="fas fa-user"></i>
                                </span>
                                Dati Anagrafici
                            </h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="driverName" class="form-label fw-semibold">Nome e Cognome *</label>
                                        <input type="text" class="form-control" id="driverName" name="driverName" placeholder="Inserisci nome e cognome" required>
                                        <div class="invalid-feedback">Campo obbligatorio</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="driverEmail" class="form-label fw-semibold">Email *</label>
                                        <input type="email" class="form-control" id="driverEmail" name="driverEmail" placeholder="Inserisci email" required>
                                        <div class="invalid-feedback">Email non valida</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="driverPhone" class="form-label fw-semibold">Telefono *</label>
                                        <input type="text" class="form-control" id="driverPhone" name="driverPhone" placeholder="Inserisci numero di telefono" required>
                                        <div class="invalid-feedback">Campo obbligatorio</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="driverBirthdate" class="form-label fw-semibold">Data di Nascita</label>
                                        <input type="date" class="form-control" id="driverBirthdate" name="driverBirthdate">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="driverAddress" class="form-label fw-semibold">Indirizzo</label>
                                        <input type="text" class="form-control" id="driverAddress" name="driverAddress" placeholder="Inserisci indirizzo">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="driverCity" class="form-label fw-semibold">Città</label>
                                        <input type="text" class="form-control" id="driverCity" name="driverCity" placeholder="Città">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="driverProvince" class="form-label fw-semibold">Provincia</label>
                                        <input type="text" class="form-control" id="driverProvince" name="driverProvince" placeholder="Provincia">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="driverZip" class="form-label fw-semibold">CAP</label>
                                        <input type="text" class="form-control" id="driverZip" name="driverZip" placeholder="CAP">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="driverFiscalCode" class="form-label fw-semibold">Codice Fiscale *</label>
                                        <input type="text" class="form-control" id="driverFiscalCode" name="driverFiscalCode" placeholder="Inserisci codice fiscale" required>
                                        <div class="invalid-feedback">Campo obbligatorio</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="driverStatus" class="form-label fw-semibold">Stato *</label>
                                        <select class="form-select" id="driverStatus" name="driverStatus" required>
                                            <option value="">Seleziona stato...</option>
                                            <option value="Attivo" selected>Attivo</option>
                                            <option value="Inattivo">Inattivo</option>
                                            <option value="Sospeso">Sospeso</option>
                                        </select>
                                        <div class="invalid-feedback">Campo obbligatorio</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 border-top d-flex justify-content-between">
                            <button type="button" class="btn btn-light wizard-btn" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Annulla
                            </button>
                            <button type="button" class="btn btn-primary wizard-next-btn" data-next-step="2">
                                Continua <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Documenti -->
                    <div class="wizard-step" id="step2" style="display: none;">
                        <div class="p-4">
                            <h5 class="mb-4">
                                <span class="wizard-circle-icon me-2">
                                    <i class="fas fa-id-card"></i>
                                </span>
                                Documenti
                            </h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="driverLicense" class="form-label fw-semibold">Patente di Guida *</label>
                                        <input type="text" class="form-control" id="driverLicense" name="driverLicense" placeholder="Numero patente" required>
                                        <div class="invalid-feedback">Campo obbligatorio</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="driverLicenseExpiry" class="form-label fw-semibold">Scadenza Patente *</label>
                                        <input type="date" class="form-control" id="driverLicenseExpiry" name="driverLicenseExpiry" required>
                                        <div class="invalid-feedback">Campo obbligatorio</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="driverLicenseFile" class="form-label fw-semibold">Carica Patente</label>
                                        <input type="file" class="form-control" id="driverLicenseFile" name="driverLicenseFile">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="driverIdCard" class="form-label fw-semibold">Documento d'Identità</label>
                                        <input type="text" class="form-control" id="driverIdCard" name="driverIdCard" placeholder="Numero documento">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="driverIdCardExpiry" class="form-label fw-semibold">Scadenza Documento</label>
                                        <input type="date" class="form-control" id="driverIdCardExpiry" name="driverIdCardExpiry">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="driverIdCardFile" class="form-label fw-semibold">Carica Documento</label>
                                        <input type="file" class="form-control" id="driverIdCardFile" name="driverIdCardFile">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 border-top d-flex justify-content-between">
                            <button type="button" class="btn btn-light wizard-prev-btn" data-prev-step="1">
                                <i class="fas fa-arrow-left me-2"></i>Indietro
                            </button>
                            <button type="button" class="btn btn-primary wizard-next-btn" data-next-step="3">
                                Continua <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Pagamenti -->
                    <div class="wizard-step" id="step3" style="display: none;">
                        <div class="p-4">
                            <h5 class="mb-4">
                                <span class="wizard-circle-icon me-2">
                                    <i class="fas fa-money-bill"></i>
                                </span>
                                Dati Pagamento
                            </h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="contractType" class="form-label fw-semibold">Tipo di Contratto *</label>
                                        <select class="form-select" id="contractType" name="contractType" required>
                                            <option value="">Seleziona tipo contratto...</option>
                                            <option value="Partita IVA">Partita IVA</option>
                                            <option value="Occasionale">Occasionale</option>
                                            <option value="Dipendente">Dipendente</option>
                                            <option value="Altro">Altro</option>
                                        </select>
                                        <div class="invalid-feedback">Campo obbligatorio</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="paymentMethod" class="form-label fw-semibold">Metodo di Pagamento *</label>
                                        <select class="form-select" id="paymentMethod" name="paymentMethod" required>
                                            <option value="">Seleziona metodo pagamento...</option>
                                            <option value="Bonifico">Bonifico</option>
                                            <option value="Contanti">Contanti</option>
                                        </select>
                                        <div class="invalid-feedback">Campo obbligatorio</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group mb-3 payment-details" id="bankDetails" style="display: none;">
                                        <label for="iban" class="form-label fw-semibold">IBAN</label>
                                        <input type="text" class="form-control" id="iban" name="iban" placeholder="Inserisci IBAN">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="baseRate" class="form-label fw-semibold">Tariffa Base (€/ora) *</label>
                                        <input type="number" step="0.01" class="form-control" id="baseRate" name="baseRate" placeholder="0.00" required>
                                        <div class="invalid-feedback">Campo obbligatorio</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="deliveryRate" class="form-label fw-semibold">Tariffa Consegna (€/consegna)</label>
                                        <input type="number" step="0.01" class="form-control" id="deliveryRate" name="deliveryRate" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="paymentNotes" class="form-label fw-semibold">Note Pagamento</label>
                                        <textarea class="form-control" id="paymentNotes" name="paymentNotes" rows="3" placeholder="Inserisci eventuali note per il pagamento..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 border-top d-flex justify-content-between">
                            <button type="button" class="btn btn-light wizard-prev-btn" data-prev-step="2">
                                <i class="fas fa-arrow-left me-2"></i>Indietro
                            </button>
                            <button type="button" class="btn btn-primary wizard-next-btn" data-next-step="4">
                                Continua <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 4: Mezzi -->
                    <div class="wizard-step" id="step4" style="display: none;">
                        <div class="p-4">
                            <h5 class="mb-4">
                                <span class="wizard-circle-icon me-2">
                                    <i class="fas fa-motorcycle"></i>
                                </span>
                                Mezzi di Trasporto
                            </h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="vehicleType" class="form-label fw-semibold">Tipo di Veicolo</label>
                                        <select class="form-select" id="vehicleType" name="vehicleType">
                                            <option value="">Seleziona tipo...</option>
                                            <option value="Scooter">Scooter</option>
                                            <option value="Moto">Moto</option>
                                            <option value="Auto">Auto</option>
                                            <option value="Bici">Bici</option>
                                            <option value="Altro">Altro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="vehicleOwnership" class="form-label fw-semibold">Proprietà</label>
                                        <select class="form-select" id="vehicleOwnership" name="vehicleOwnership">
                                            <option value="Proprio" selected>Proprio</option>
                                            <option value="Aziendale">Aziendale</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="vehicleDetailsSection">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="vehicleBrand" class="form-label fw-semibold">Marca</label>
                                            <input type="text" class="form-control" id="vehicleBrand" name="vehicleBrand" placeholder="Marca">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="vehicleModel" class="form-label fw-semibold">Modello</label>
                                            <input type="text" class="form-control" id="vehicleModel" name="vehicleModel" placeholder="Modello">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="vehiclePlate" class="form-label fw-semibold">Targa</label>
                                            <input type="text" class="form-control" id="vehiclePlate" name="vehiclePlate" placeholder="Targa">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="insuranceNumber" class="form-label fw-semibold">Numero Assicurazione</label>
                                            <input type="text" class="form-control" id="insuranceNumber" name="insuranceNumber" placeholder="Numero polizza">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="insuranceExpiry" class="form-label fw-semibold">Scadenza Assicurazione</label>
                                            <input type="date" class="form-control" id="insuranceExpiry" name="insuranceExpiry">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 border-top d-flex justify-content-between">
                            <button type="button" class="btn btn-light wizard-prev-btn" data-prev-step="3">
                                <i class="fas fa-arrow-left me-2"></i>Indietro
                            </button>
                            <button type="button" class="btn btn-primary wizard-next-btn" data-next-step="5">
                                Continua <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 5: Riepilogo -->
                    <div class="wizard-step" id="step5" style="display: none;">
                        <div class="p-4">
                            <h5 class="mb-4">
                                <span class="wizard-circle-icon me-2">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                Riepilogo Informazioni
                            </h5>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="alert alert-info d-flex align-items-center">
                                        <i class="fas fa-info-circle me-3 h5 mb-0"></i>
                                        <div>Verifica i dati inseriti prima di procedere con la creazione del nuovo driver.</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Dati Anagrafici</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Nome e Cognome:</strong> <span id="summaryName"></span></p>
                                            <p><strong>Email:</strong> <span id="summaryEmail"></span></p>
                                            <p><strong>Telefono:</strong> <span id="summaryPhone"></span></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Codice Fiscale:</strong> <span id="summaryFiscalCode"></span></p>
                                            <p><strong>Indirizzo:</strong> <span id="summaryAddress"></span></p>
                                            <p><strong>Stato:</strong> <span id="summaryStatus"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-id-card me-2"></i>Documenti</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Numero Patente:</strong> <span id="summaryLicense"></span></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Scadenza Patente:</strong> <span id="summaryLicenseExpiry"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-money-bill me-2"></i>Dati Pagamento</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Tipo di Contratto:</strong> <span id="summaryContractType"></span></p>
                                            <p><strong>Metodo di Pagamento:</strong> <span id="summaryPaymentMethod"></span></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Tariffa Base:</strong> <span id="summaryBaseRate"></span> €/ora</p>
                                            <p><strong>Tariffa Consegna:</strong> <span id="summaryDeliveryRate"></span> €/consegna</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-motorcycle me-2"></i>Mezzi</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Tipo di Veicolo:</strong> <span id="summaryVehicleType"></span></p>
                                            <p><strong>Marca/Modello:</strong> <span id="summaryVehicleModel"></span></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Targa:</strong> <span id="summaryVehiclePlate"></span></p>
                                            <p><strong>Proprietà:</strong> <span id="summaryVehicleOwnership"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 border-top d-flex justify-content-between">
                            <button type="button" class="btn btn-light wizard-prev-btn" data-prev-step="4">
                                <i class="fas fa-arrow-left me-2"></i>Indietro
                            </button>
                            <button type="submit" class="btn btn-success wizard-submit-btn">
                                <i class="fas fa-check me-2"></i>Crea Driver
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Il CSS del modale è stato spostato in assets/css/4-components/drivers/_driver_new.css -->
<!-- JavaScript per gestire il modale è in assets/js/4-components/drivers/driver_new.js -->