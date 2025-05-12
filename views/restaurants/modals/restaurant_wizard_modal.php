<?php
/**
 * Modal per creazione nuovo ristorante (wizard)
 * Questo file contiene il codice HTML per il modale wizard che consente di creare un nuovo ristorante
 */
?>
<!-- Modal per la creazione di un nuovo ristorante con wizard -->
<div class="modal fade" id="newRestaurantWizardModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0 shadow">
            <div class="modal-header position-relative p-0">
                <div class="modal-header-bg w-100"></div>
                <div class="modal-title-container p-3 position-relative w-100 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title d-flex align-items-center">
                        <span class="modal-icon-wrapper me-2">
                            <i class="fas fa-store-alt"></i>
                        </span>
                        Creazione Nuovo Ristorante
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <!-- Progress Wizard -->
                <div class="wizard-progress-container py-2 px-3 mb-4 bg-light rounded">
                    <div class="wizard-progress">
                        <div class="progress-step active" data-step="1">
                            <div class="step-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="step-label">Informazioni</div>
                        </div>
                        <div class="progress-step" data-step="2">
                            <div class="step-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="step-label">Indirizzo</div>
                        </div>
                        <div class="progress-step" data-step="3">
                            <div class="step-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="step-label">Orari</div>
                        </div>
                        <div class="progress-step" data-step="4">
                            <div class="step-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="step-label">Consegna</div>
                        </div>
                        <div class="progress-step" data-step="5">
                            <div class="step-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="step-label">Riepilogo</div>
                        </div>
                    </div>
                </div>
                
                <form id="newRestaurantForm" class="needs-validation" novalidate>
                    <!-- Step 1: Informazioni di base -->
                    <div class="wizard-step active" id="step1">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">
                                    <span class="icon-circle bg-primary-light driver-text-primary me-2">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                    Informazioni di base
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-7">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Nome del ristorante*</label>
                                            <input type="text" class="form-control" id="newRestaurantName" required placeholder="Es. Pizzeria Napoli">
                                            <div class="invalid-feedback">
                                                Inserisci il nome del ristorante
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Tipologia cucina*</label>
                                            <select class="form-select" id="newRestaurantCuisineType" required>
                                                <option value="">Seleziona tipologia</option>
                                                <option value="italiana">Italiana</option>
                                                <option value="pizza">Pizzeria</option>
                                                <option value="sushi">Sushi / Giapponese</option>
                                                <option value="fast-food">Fast Food</option>
                                                <option value="cinese">Cinese</option>
                                                <option value="messicana">Messicana</option>
                                                <option value="indiana">Indiana</option>
                                                <option value="vegetariana">Vegetariana / Vegana</option>
                                                <option value="mediterranea">Mediterranea</option>
                                                <option value="pesce">Pesce</option>
                                                <option value="altro">Altro</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Seleziona la tipologia di cucina
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Descrizione breve*</label>
                                            <input type="text" class="form-control" id="newRestaurantShortDesc" required placeholder="Es. Il miglior ristorante italiano di Milano">
                                            <div class="invalid-feedback">
                                                Inserisci una breve descrizione
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Logo ristorante</label>
                                            <div class="text-center p-3 bg-light rounded mb-3">
                                                <div class="restaurant-avatar-lg mx-auto mb-3">
                                                    <i class="fas fa-store"></i>
                                                </div>
                                                <div class="d-grid">
                                                    <button type="button" class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-upload me-2"></i> Carica logo
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-text text-center">
                                                Formato: JPG/PNG, max 2MB
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label fw-semibold">Stato</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="newRestaurantActiveStatus" checked>
                                                <label class="form-check-label" for="newRestaurantActiveStatus">Attivo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Email*</label>
                                            <input type="email" class="form-control" id="newRestaurantEmail" required placeholder="Es. info@ristorantexyz.it">
                                            <div class="invalid-feedback">
                                                Inserisci un indirizzo email valido
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Telefono*</label>
                                            <input type="tel" class="form-control" id="newRestaurantPhone" required placeholder="Es. +39 02 1234567">
                                            <div class="invalid-feedback">
                                                Inserisci un numero di telefono
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light driver-modal-button" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i> Annulla
                            </button>
                            <button type="button" class="btn btn-primary driver-modal-button next-step" data-step="2">
                                Continua <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Indirizzo -->
                    <div class="wizard-step" id="step2">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">
                                    <span class="icon-circle bg-primary-light driver-text-primary me-2">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    Indirizzo del ristorante
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Via e numero civico*</label>
                                            <input type="text" class="form-control" id="newRestaurantStreetAddress" required placeholder="Es. Via Roma 123">
                                            <div class="invalid-feedback">
                                                Inserisci l'indirizzo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Città*</label>
                                            <input type="text" class="form-control" id="newRestaurantCity" required placeholder="Es. Milano">
                                            <div class="invalid-feedback">
                                                Inserisci la città
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">CAP*</label>
                                            <input type="text" class="form-control" id="newRestaurantZipCode" required placeholder="Es. 20100">
                                            <div class="invalid-feedback">
                                                Inserisci il CAP
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Provincia*</label>
                                            <input type="text" class="form-control" id="newRestaurantProvince" required placeholder="Es. MI">
                                            <div class="invalid-feedback">
                                                Inserisci la provincia
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="bg-light rounded p-3">
                                            <div id="restaurantAddressMap" style="height: 300px; width: 100%;" class="rounded"></div>
                                        </div>
                                        <div class="d-grid mt-3">
                                            <button type="button" class="btn btn-outline-primary btn-sm" id="verifyAddressBtn">
                                                <i class="fas fa-map-marker-alt me-2"></i> Verifica indirizzo sulla mappa
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light driver-modal-button prev-step" data-step="1">
                                <i class="fas fa-arrow-left me-2"></i> Indietro
                            </button>
                            <button type="button" class="btn btn-primary driver-modal-button next-step" data-step="3">
                                Continua <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Orari -->
                    <div class="wizard-step" id="step3">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">
                                    <span class="icon-circle bg-primary-light driver-text-primary me-2">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                    Orari di apertura
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="alert alert-info d-flex align-items-center mb-4 py-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <div>
                                        Imposta gli orari di apertura per pranzo e cena.
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle table-sm">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Giorno</th>
                                                <th>Stato</th>
                                                <th>Mattina - Apertura</th>
                                                <th>Mattina - Chiusura</th>
                                                <th>Sera - Apertura</th>
                                                <th>Sera - Chiusura</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="fw-semibold">Lunedì</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input day-status" type="checkbox" id="newMondayStatus" data-day="monday" checked>
                                                        <label class="form-check-label" for="newMondayStatus">Aperto</label>
                                                    </div>
                                                </td>
                                                <td><input type="time" class="form-control monday-times" value="11:30"></td>
                                                <td><input type="time" class="form-control monday-times" value="15:00"></td>
                                                <td><input type="time" class="form-control monday-times" value="19:00"></td>
                                                <td><input type="time" class="form-control monday-times" value="23:00"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Martedì</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input day-status" type="checkbox" id="newTuesdayStatus" data-day="tuesday" checked>
                                                        <label class="form-check-label" for="newTuesdayStatus">Aperto</label>
                                                    </div>
                                                </td>
                                                <td><input type="time" class="form-control tuesday-times" value="11:30"></td>
                                                <td><input type="time" class="form-control tuesday-times" value="15:00"></td>
                                                <td><input type="time" class="form-control tuesday-times" value="19:00"></td>
                                                <td><input type="time" class="form-control tuesday-times" value="23:00"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Mercoledì</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input day-status" type="checkbox" id="newWednesdayStatus" data-day="wednesday" checked>
                                                        <label class="form-check-label" for="newWednesdayStatus">Aperto</label>
                                                    </div>
                                                </td>
                                                <td><input type="time" class="form-control wednesday-times" value="11:30"></td>
                                                <td><input type="time" class="form-control wednesday-times" value="15:00"></td>
                                                <td><input type="time" class="form-control wednesday-times" value="19:00"></td>
                                                <td><input type="time" class="form-control wednesday-times" value="23:00"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Giovedì</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input day-status" type="checkbox" id="newThursdayStatus" data-day="thursday" checked>
                                                        <label class="form-check-label" for="newThursdayStatus">Aperto</label>
                                                    </div>
                                                </td>
                                                <td><input type="time" class="form-control thursday-times" value="11:30"></td>
                                                <td><input type="time" class="form-control thursday-times" value="15:00"></td>
                                                <td><input type="time" class="form-control thursday-times" value="19:00"></td>
                                                <td><input type="time" class="form-control thursday-times" value="23:00"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Venerdì</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input day-status" type="checkbox" id="newFridayStatus" data-day="friday" checked>
                                                        <label class="form-check-label" for="newFridayStatus">Aperto</label>
                                                    </div>
                                                </td>
                                                <td><input type="time" class="form-control friday-times" value="11:30"></td>
                                                <td><input type="time" class="form-control friday-times" value="15:00"></td>
                                                <td><input type="time" class="form-control friday-times" value="19:00"></td>
                                                <td><input type="time" class="form-control friday-times" value="23:00"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Sabato</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input day-status" type="checkbox" id="newSaturdayStatus" data-day="saturday" checked>
                                                        <label class="form-check-label" for="newSaturdayStatus">Aperto</label>
                                                    </div>
                                                </td>
                                                <td><input type="time" class="form-control saturday-times" value="11:30"></td>
                                                <td><input type="time" class="form-control saturday-times" value="15:00"></td>
                                                <td><input type="time" class="form-control saturday-times" value="19:00"></td>
                                                <td><input type="time" class="form-control saturday-times" value="23:30"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Domenica</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input day-status" type="checkbox" id="newSundayStatus" data-day="sunday">
                                                        <label class="form-check-label" for="newSundayStatus">Chiuso</label>
                                                    </div>
                                                </td>
                                                <td><input type="time" class="form-control sunday-times" disabled></td>
                                                <td><input type="time" class="form-control sunday-times" disabled></td>
                                                <td><input type="time" class="form-control sunday-times" disabled></td>
                                                <td><input type="time" class="form-control sunday-times" disabled></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light driver-modal-button prev-step" data-step="2">
                                <i class="fas fa-arrow-left me-2"></i> Indietro
                            </button>
                            <button type="button" class="btn btn-primary driver-modal-button next-step" data-step="4">
                                Continua <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 4: Consegna -->
                    <div class="wizard-step" id="step4">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">
                                    <span class="icon-circle bg-primary-light driver-text-primary me-2">
                                        <i class="fas fa-truck"></i>
                                    </span>
                                    Zone di consegna
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="alert alert-info d-flex align-items-center mb-4 py-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <div>
                                        Definisci le zone di consegna con relativi costi e tempi.
                                    </div>
                                </div>
                                
                                <div class="table-responsive mb-3">
                                    <table class="table table-bordered align-middle table-sm" id="deliveryZonesTable">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Nome zona</th>
                                                <th>Costo</th>
                                                <th>Min (min)</th>
                                                <th>Max (min)</th>
                                                <th>Ordine min.</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" value="Centro Milano">
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text">€</span>
                                                        <input type="number" class="form-control" value="0.00" min="0" step="0.50">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm" value="15" min="5">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm" value="25" min="10">
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text">€</span>
                                                        <input type="number" class="form-control" value="10.00" min="0" step="0.50">
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm remove-zone">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <button type="button" class="btn btn-success btn-sm" id="addDeliveryZone">
                                    <i class="fas fa-plus-circle me-2"></i> Aggiungi zona di consegna
                                </button>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light driver-modal-button prev-step" data-step="3">
                                <i class="fas fa-arrow-left me-2"></i> Indietro
                            </button>
                            <button type="button" class="btn btn-primary driver-modal-button next-step" data-step="5">
                                Continua <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 5: Riepilogo -->
                    <div class="wizard-step" id="step5">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">
                                    <span class="icon-circle bg-primary-light driver-text-primary me-2">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                    Riepilogo informazioni
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="alert alert-success d-flex align-items-center mb-4 py-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <div>
                                        Controlla le informazioni prima di creare il ristorante.
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="summary-section mb-3">
                                            <h6 class="fw-bold text-primary mb-2">
                                                <i class="fas fa-info-circle me-2"></i> Informazioni di base
                                            </h6>
                                            <div class="summary-item d-flex">
                                                <span class="fw-semibold me-2 summary-label">Nome:</span>
                                                <span id="summary-name">-</span>
                                            </div>
                                            <div class="summary-item d-flex">
                                                <span class="fw-semibold me-2 summary-label">Tipologia:</span>
                                                <span id="summary-cuisine">-</span>
                                            </div>
                                            <div class="summary-item d-flex">
                                                <span class="fw-semibold me-2 summary-label">Email:</span>
                                                <span id="summary-email">-</span>
                                            </div>
                                            <div class="summary-item d-flex">
                                                <span class="fw-semibold me-2 summary-label">Telefono:</span>
                                                <span id="summary-phone">-</span>
                                            </div>
                                            <div class="summary-item d-flex">
                                                <span class="fw-semibold me-2 summary-label">Stato:</span>
                                                <span id="summary-status">-</span>
                                            </div>
                                        </div>
                                        
                                        <div class="summary-section mb-3">
                                            <h6 class="fw-bold text-primary mb-2">
                                                <i class="fas fa-map-marker-alt me-2"></i> Indirizzo
                                            </h6>
                                            <div class="summary-item d-flex">
                                                <span class="fw-semibold me-2 summary-label">Indirizzo:</span>
                                                <span id="summary-address">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="summary-section mb-3">
                                            <h6 class="fw-bold text-primary mb-2">
                                                <i class="fas fa-truck me-2"></i> Zone di consegna
                                            </h6>
                                            <div id="summary-zones">Nessuna zona definita</div>
                                        </div>
                                        
                                        <div class="summary-section mb-3">
                                            <h6 class="fw-bold text-primary mb-2">
                                                <i class="fas fa-clock me-2"></i> Orari di apertura
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="summary-item d-flex">
                                                        <span class="fw-semibold me-2 summary-label">Lunedì:</span>
                                                        <span id="summary-monday">-</span>
                                                    </div>
                                                    <div class="summary-item d-flex">
                                                        <span class="fw-semibold me-2 summary-label">Martedì:</span>
                                                        <span id="summary-tuesday">-</span>
                                                    </div>
                                                    <div class="summary-item d-flex">
                                                        <span class="fw-semibold me-2 summary-label">Mercoledì:</span>
                                                        <span id="summary-wednesday">-</span>
                                                    </div>
                                                    <div class="summary-item d-flex">
                                                        <span class="fw-semibold me-2 summary-label">Giovedì:</span>
                                                        <span id="summary-thursday">-</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="summary-item d-flex">
                                                        <span class="fw-semibold me-2 summary-label">Venerdì:</span>
                                                        <span id="summary-friday">-</span>
                                                    </div>
                                                    <div class="summary-item d-flex">
                                                        <span class="fw-semibold me-2 summary-label">Sabato:</span>
                                                        <span id="summary-saturday">-</span>
                                                    </div>
                                                    <div class="summary-item d-flex">
                                                        <span class="fw-semibold me-2 summary-label">Domenica:</span>
                                                        <span id="summary-sunday">-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light driver-modal-button prev-step" data-step="4">
                                <i class="fas fa-arrow-left me-2"></i> Indietro
                            </button>
                            <button type="submit" class="btn btn-success driver-modal-button">
                                <i class="fas fa-check me-2"></i> Crea ristorante
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>