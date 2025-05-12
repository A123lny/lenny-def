<?php
/**
 * Modal per gestione ristorante
 * Questo file contiene il modal per la gestione dettagliata di un ristorante selezionato
 */
?>
<!-- Modal per la gestione del ristorante -->
<div class="modal fade fullscreen-modal" id="manageRestaurantModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content border-0">
            <div class="modal-header position-relative p-0 border-0">
                <div class="modal-header-bg w-100"></div>
                <div class="modal-title-container p-3 position-relative w-100 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title d-flex align-items-center">
                        <span class="modal-icon-wrapper me-2">
                            <i class="fas fa-edit"></i>
                        </span>
                        Gestione Ristorante: <span class="manage-restaurant-name ms-2"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0 border-0">
                <div class="restaurant-management-container">
                    <!-- Menu laterale -->
                    <div class="restaurant-management-sidebar">
                        <div class="restaurant-management-sidebar-header">
                            <div class="restaurant-avatar-lg mb-3">
                                <i class="fas fa-store"></i>
                            </div>
                            <h5 class="manage-restaurant-name mb-2"></h5>
                            <div class="restaurant-badge mb-3">
                                <span class="manage-restaurant-status badge-pill status-badge"></span>
                            </div>
                        </div>
                        <ul class="restaurant-management-menu">
                            <li class="restaurant-management-menu-item active" data-tab="info">
                                <i class="fas fa-info-circle"></i> Informazioni di base
                            </li>
                            <li class="restaurant-management-menu-item" data-tab="address">
                                <i class="fas fa-map-marker-alt"></i> Indirizzo e consegna
                            </li>
                            <li class="restaurant-management-menu-item" data-tab="hours">
                                <i class="fas fa-clock"></i> Orari di apertura
                            </li>
                            <li class="restaurant-management-menu-item" data-tab="menu">
                                <i class="fas fa-utensils"></i> Menù
                            </li>
                            <li class="restaurant-management-menu-item" data-tab="operations">
                                <i class="fas fa-cogs"></i> Dati operativi
                            </li>
                            <li class="restaurant-management-menu-item" data-tab="payments">
                                <i class="fas fa-credit-card"></i> Pagamenti
                            </li>
                            <li class="restaurant-management-menu-item" data-tab="commissions">
                                <i class="fas fa-percentage"></i> Commissioni
                            </li>
                            <li class="restaurant-management-menu-item" data-tab="documents">
                                <i class="fas fa-file-alt"></i> Documenti
                            </li>
                            <li class="restaurant-management-menu-item" data-tab="promotions">
                                <i class="fas fa-bullhorn"></i> Promozioni
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Area contenuto gestione -->
                    <div class="restaurant-management-content">
                        <!-- Tab Informazioni di base -->
                        <div class="restaurant-management-tab active" id="info-tab">
                            <h4 class="mb-4">
                                <span class="icon-circle bg-primary-light text-primary me-2">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                Informazioni di base
                            </h4>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-semibold">Nome Ristorante</label>
                                        <input type="text" class="form-control" id="restaurantName" placeholder="Nome del ristorante">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-semibold">Descrizione breve</label>
                                        <input type="text" class="form-control" id="restaurantShortDescription" placeholder="Descrizione breve">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-semibold">Contatto telefonico</label>
                                        <input type="text" class="form-control" id="restaurantPhone" placeholder="Telefono">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-semibold">Email</label>
                                        <input type="email" class="form-control" id="restaurantEmail" placeholder="Email">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-semibold">Contatto responsabile</label>
                                        <input type="text" class="form-control" id="restaurantManager" placeholder="Nome e cognome del responsabile">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-semibold">Tipologia cucina</label>
                                        <select class="form-select" id="restaurantCuisineType">
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
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-semibold">Stato</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="restaurantActiveStatus" checked>
                                            <label class="form-check-label" for="restaurantActiveStatus">Attivo</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-semibold">Logo ristorante</label>
                                        <div class="input-group mb-2">
                                            <input type="file" class="form-control" id="restaurantLogo">
                                            <button class="btn btn-outline-primary driver-modal-button" type="button">Carica</button>
                                        </div>
                                        <div class="form-text">Formato consigliato: JPG/PNG, dimensione massima 2MB</div>
                                        <div class="restaurant-logo-preview mt-2">
                                            <img src="assets/images/restaurant-logo.png" alt="Logo ristorante" class="img-thumbnail" style="max-height: 100px">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-semibold">Immagine di copertina</label>
                                        <div class="input-group mb-2">
                                            <input type="file" class="form-control" id="restaurantCoverImage">
                                            <button class="btn btn-outline-primary driver-modal-button" type="button">Carica</button>
                                        </div>
                                        <div class="form-text">Formato consigliato: JPG/PNG, dimensione massima 5MB</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Descrizione completa</label>
                                        <textarea class="form-control" id="restaurantDescription" rows="4" placeholder="Descrizione dettagliata del ristorante..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tab Indirizzo e consegna -->
                        <div class="restaurant-management-tab" id="address-tab">
                            <h4 class="mb-4">
                                <span class="icon-circle bg-primary-light text-primary me-2">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                Indirizzo e consegna
                            </h4>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="mb-3">Dati indirizzo</h5>
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-semibold">Indirizzo</label>
                                        <input type="text" class="form-control" id="restaurantAddress" placeholder="Via e numero civico">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-semibold">Città</label>
                                        <input type="text" class="form-control" id="restaurantCity" placeholder="Città">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-semibold">CAP</label>
                                                <input type="text" class="form-control" id="restaurantZip" placeholder="CAP">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-semibold">Provincia</label>
                                                <input type="text" class="form-control" id="restaurantProvince" placeholder="Provincia">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-semibold">Note per la consegna</label>
                                        <textarea class="form-control" id="restaurantDeliveryNotes" rows="3" placeholder="Eventuali note per la consegna..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-3">Mappa e coordinate</h5>
                                    <div class="form-group mb-3">
                                        <div class="restaurant-map-container rounded shadow-sm overflow-hidden">
                                            <div id="restaurantLocationMap" class="restaurant-map"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-semibold">Latitudine</label>
                                                <input type="text" class="form-control" id="restaurantLat" placeholder="Latitudine">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-semibold">Longitudine</label>
                                                <input type="text" class="form-control" id="restaurantLng" placeholder="Longitudine">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <button class="btn btn-outline-primary w-100" id="updateMapFromAddress">
                                                <i class="fas fa-search-location me-2"></i> Cerca indirizzo
                                            </button>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-outline-primary w-100" id="updateCoordinatesFromMap">
                                                <i class="fas fa-map-marker-alt me-2"></i> Usa posizione mappa
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <h5 class="mb-3">
                                <span class="icon-circle bg-primary-light driver-text-primary me-2" style="width: 28px; height: 28px;">
                                    <i class="fas fa-shipping-fast"></i>
                                </span>
                                Zone di consegna
                            </h5>
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered table-hover align-middle custom-table">
                                    <thead>
                                        <tr>
                                            <th>Nome zona</th>
                                            <th>Costo consegna</th>
                                            <th>Tempo min (min)</th>
                                            <th>Tempo max (min)</th>
                                            <th>Ordine minimo</th>
                                            <th>Azioni</th>
                                        </tr>
                                    </thead>
                                    <tbody id="deliveryZonesTable">
                                        <tr>
                                            <td>Centro Milano</td>
                                            <td>€0.00</td>
                                            <td>15</td>
                                            <td>25</td>
                                            <td>€10.00</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Milano Nord</td>
                                            <td>€1.50</td>
                                            <td>25</td>
                                            <td>40</td>
                                            <td>€15.00</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-success driver-modal-button">
                                <i class="fas fa-plus-circle me-2"></i> Aggiungi zona di consegna
                            </button>
                        </div>
                        
                        <!-- Tab Orari di apertura -->
                        <div class="restaurant-management-tab" id="hours-tab">
                            <h4 class="mb-4">
                                <span class="icon-circle bg-primary-light text-primary me-2">
                                    <i class="fas fa-clock"></i>
                                </span>
                                Orari di apertura
                            </h4>
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered align-middle custom-table">
                                    <thead>
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
                                                    <input class="form-check-input" type="checkbox" id="mondayStatus" checked>
                                                    <label class="form-check-label" for="mondayStatus">Aperto</label>
                                                </div>
                                            </td>
                                            <td><input type="time" class="form-control" value="11:30"></td>
                                            <td><input type="time" class="form-control" value="15:00"></td>
                                            <td><input type="time" class="form-control" value="19:00"></td>
                                            <td><input type="time" class="form-control" value="23:00"></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Martedì</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="tuesdayStatus" checked>
                                                    <label class="form-check-label" for="tuesdayStatus">Aperto</label>
                                                </div>
                                            </td>
                                            <td><input type="time" class="form-control" value="11:30"></td>
                                            <td><input type="time" class="form-control" value="15:00"></td>
                                            <td><input type="time" class="form-control" value="19:00"></td>
                                            <td><input type="time" class="form-control" value="23:00"></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Mercoledì</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="wednesdayStatus" checked>
                                                    <label class="form-check-label" for="wednesdayStatus">Aperto</label>
                                                </div>
                                            </td>
                                            <td><input type="time" class="form-control" value="11:30"></td>
                                            <td><input type="time" class="form-control" value="15:00"></td>
                                            <td><input type="time" class="form-control" value="19:00"></td>
                                            <td><input type="time" class="form-control" value="23:00"></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Giovedì</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="thursdayStatus" checked>
                                                    <label class="form-check-label" for="thursdayStatus">Aperto</label>
                                                </div>
                                            </td>
                                            <td><input type="time" class="form-control" value="11:30"></td>
                                            <td><input type="time" class="form-control" value="15:00"></td>
                                            <td><input type="time" class="form-control" value="19:00"></td>
                                            <td><input type="time" class="form-control" value="23:00"></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Venerdì</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="fridayStatus" checked>
                                                    <label class="form-check-label" for="fridayStatus">Aperto</label>
                                                </div>
                                            </td>
                                            <td><input type="time" class="form-control" value="11:30"></td>
                                            <td><input type="time" class="form-control" value="15:00"></td>
                                            <td><input type="time" class="form-control" value="19:00"></td>
                                            <td><input type="time" class="form-control" value="23:30"></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Sabato</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="saturdayStatus" checked>
                                                    <label class="form-check-label" for="saturdayStatus">Aperto</label>
                                                </div>
                                            </td>
                                            <td><input type="time" class="form-control" value="11:30"></td>
                                            <td><input type="time" class="form-control" value="15:00"></td>
                                            <td><input type="time" class="form-control" value="19:00"></td>
                                            <td><input type="time" class="form-control" value="23:30"></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Domenica</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="sundayStatus">
                                                    <label class="form-check-label" for="sundayStatus">Chiuso</label>
                                                </div>
                                            </td>
                                            <td><input type="time" class="form-control" disabled></td>
                                            <td><input type="time" class="form-control" disabled></td>
                                            <td><input type="time" class="form-control" disabled></td>
                                            <td><input type="time" class="form-control" disabled></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Note sugli orari</label>
                                        <textarea class="form-control" id="hoursNotes" rows="3" placeholder="Eventuali note specifiche su orari speciali..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contenuto per altre tab -->
                        <div class="restaurant-management-tab" id="menu-tab">
                            <h4 class="mb-4">
                                <span class="icon-circle bg-primary-light text-primary me-2">
                                    <i class="fas fa-utensils"></i>
                                </span>
                                Menù
                            </h4>
                            <p class="text-muted">Questa sezione permetterà di gestire le categorie e i prodotti del menu del ristorante.</p>
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>La sezione per la gestione completa del menu è in fase di sviluppo.</div>
                            </div>
                        </div>
                        
                        <div class="restaurant-management-tab" id="operations-tab">
                            <h4 class="mb-4">
                                <span class="icon-circle bg-primary-light text-primary me-2">
                                    <i class="fas fa-cogs"></i>
                                </span>
                                Dati operativi
                            </h4>
                            <p class="text-muted">Questa sezione includerà impostazioni operative come tempo di preparazione, priorità di servizio, etc.</p>
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>La sezione dei dati operativi è in fase di sviluppo.</div>
                            </div>
                        </div>
                        
                        <div class="restaurant-management-tab" id="payments-tab">
                            <h4 class="mb-4">
                                <span class="icon-circle bg-primary-light text-primary me-2">
                                    <i class="fas fa-credit-card"></i>
                                </span>
                                Pagamenti
                            </h4>
                            <p class="text-muted">Qui potrai configurare i metodi di pagamento accettati dal ristorante.</p>
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>La sezione dei pagamenti è in fase di sviluppo.</div>
                            </div>
                        </div>
                        
                        <div class="restaurant-management-tab" id="commissions-tab">
                            <h4 class="mb-4">
                                <span class="icon-circle bg-primary-light text-primary me-2">
                                    <i class="fas fa-percentage"></i>
                                </span>
                                Commissioni
                            </h4>
                            <p class="text-muted">Qui potrai gestire le commissioni applicate agli ordini di questo ristorante.</p>
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>La sezione delle commissioni è in fase di sviluppo.</div>
                            </div>
                        </div>
                        
                        <div class="restaurant-management-tab" id="documents-tab">
                            <h4 class="mb-4">
                                <span class="icon-circle bg-primary-light text-primary me-2">
                                    <i class="fas fa-file-alt"></i>
                                </span>
                                Documenti
                            </h4>
                            <p class="text-muted">Qui potrai caricare e gestire documenti come licenze e certificazioni.</p>
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>La sezione dei documenti è in fase di sviluppo.</div>
                            </div>
                        </div>
                        
                        <div class="restaurant-management-tab" id="promotions-tab">
                            <h4 class="mb-4">
                                <span class="icon-circle bg-primary-light text-primary me-2">
                                    <i class="fas fa-bullhorn"></i>
                                </span>
                                Promozioni
                            </h4>
                            <p class="text-muted">Qui potrai creare e gestire le promozioni per questo ristorante.</p>
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>La sezione delle promozioni è in fase di sviluppo.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light driver-modal-button" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary driver-modal-button" id="saveRestaurantChanges">
                    <i class="fas fa-save me-2"></i> Salva modifiche
                </button>
            </div>
        </div>
    </div>
</div>