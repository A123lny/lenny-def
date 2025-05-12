<?php
/**
 * Modal per la creazione di un nuovo ordine (wizard)
 * Questo file contiene il codice HTML per il modal wizard di creazione ordine
 * Il CSS e JavaScript sono stati spostati in file esterni:
 * - assets/css/4-components/_new-order.css
 * - assets/js/4-components/new-order.js
 */
?>
<!-- Modal Nuovo Ordine -->
<div class="modal fade" id="newOrderModal" tabindex="-1" aria-labelledby="newOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="newOrderModalLabel"><i class="fas fa-shopping-bag me-2"></i>Nuovo Ordine</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Progress Tracker -->
                <div class="wizard-progress mb-4">
                    <div class="progress-step active" data-step="1">
                        <div class="step-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="step-label">Cliente</div>
                    </div>
                    <div class="progress-step" data-step="2">
                        <div class="step-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="step-label">Ristorante</div>
                    </div>
                    <div class="progress-step" data-step="3">
                        <div class="step-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="step-label">Prodotti</div>
                    </div>
                    <div class="progress-step" data-step="4">
                        <div class="step-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="step-label">Consegna</div>
                    </div>
                </div>

                <form id="newOrderForm" class="needs-validation" novalidate>
                    <!-- Step 1: Cliente -->
                    <div class="order-step" id="step1">
                        <h6 class="step-title"><i class="fas fa-user me-2"></i>Informazioni Cliente</h6>
                        <div class="mb-3">
                            <label for="customerSearch" class="form-label">Cliente</label>
                            <div class="search-container">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" id="customerSearch" placeholder="Cerca cliente..." autocomplete="off" required>
                                    <input type="hidden" id="customerId" name="customerId">
                                </div>
                                <div class="autocomplete-results" id="customerResults"></div>
                                <div class="invalid-feedback">Seleziona un cliente</div>
                            </div>
                        </div>
                        <div id="customerDetails" class="customer-card" style="display:none;">
                            <div class="d-flex align-items-center">
                                <div class="customer-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="customer-info">
                                    <h6 class="mb-0 customer-name"></h6>
                                    <div class="small text-muted customer-info-text"></div>
                                </div>
                                <button type="button" class="btn btn-icon" id="changeCustomer">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Ristorante -->
                    <div class="order-step" id="step2" style="display:none;">
                        <h6 class="step-title"><i class="fas fa-store me-2"></i>Seleziona Ristorante</h6>
                        <div class="mb-3">
                            <label for="restaurantSearch" class="form-label">Ristorante</label>
                            <div class="search-container">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" id="restaurantSearch" placeholder="Cerca ristorante..." autocomplete="off" required>
                                    <input type="hidden" id="restaurantId" name="restaurantId">
                                </div>
                                <div class="autocomplete-results" id="restaurantResults"></div>
                                <div class="invalid-feedback">Seleziona un ristorante</div>
                            </div>
                        </div>
                        <div id="restaurantDetails" class="restaurant-card" style="display:none;">
                            <div class="d-flex align-items-center">
                                <div class="restaurant-avatar">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div class="restaurant-info">
                                    <h6 class="mb-0 restaurant-name"></h6>
                                    <div class="small text-muted restaurant-info-text"></div>
                                </div>
                                <button type="button" class="btn btn-icon" id="changeRestaurant">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Prodotti -->
                    <div class="order-step" id="step3" style="display:none;">
                        <h6 class="step-title"><i class="fas fa-utensils me-2"></i>Aggiungi Prodotti</h6>
                        <div class="mb-3">
                            <label for="productSearch" class="form-label">Prodotto</label>
                            <div class="search-container">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" id="productSearch" placeholder="Cerca prodotto..." autocomplete="off">
                                </div>
                                <div class="autocomplete-results" id="productResults"></div>
                            </div>
                        </div>
                        
                        <div class="products-container">
                            <div class="table-responsive mb-3">
                                <table class="table" id="orderItemsTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Prodotto</th>
                                            <th class="text-center" style="width: 120px">Qtà</th>
                                            <th class="text-end" style="width: 100px">Prezzo</th>
                                            <th class="text-end" style="width: 100px">Totale</th>
                                            <th style="width: 40px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="noProductsRow">
                                            <td colspan="5" class="text-center py-4">
                                                <div class="empty-cart">
                                                    <i class="fas fa-shopping-basket"></i>
                                                    <p>Nessun prodotto aggiunto</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="order-summary">
                                <div class="summary-row">
                                    <div class="summary-label">Subtotale:</div>
                                    <div class="summary-value" id="subtotalAmount">0,00€</div>
                                </div>
                                <div class="summary-row">
                                    <div class="summary-label">Consegna:</div>
                                    <div class="summary-value" id="deliveryFee">2,50€</div>
                                </div>
                                <div class="summary-row total">
                                    <div class="summary-label">Totale:</div>
                                    <div class="summary-value" id="totalAmount">2,50€</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Dettagli Consegna -->
                    <div class="order-step" id="step4" style="display:none;">
                        <h6 class="step-title"><i class="fas fa-truck me-2"></i>Dettagli Consegna</h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="deliveryDate" class="form-label">Data di consegna</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    <input type="text" class="form-control" id="deliveryDate" name="deliveryDate" placeholder="Seleziona data..." readonly required>
                                </div>
                                <div class="invalid-feedback">Seleziona una data di consegna</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="deliveryTime" class="form-label">Fascia oraria</label>
                                <select class="form-select" id="deliveryTime" name="deliveryTime" required>
                                    <option value="">Seleziona orario...</option>
                                    <!-- Gli orari verranno generati dinamicamente via JavaScript -->
                                </select>
                                <div class="invalid-feedback">Seleziona una fascia oraria</div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="deliveryAddress" class="form-label">Indirizzo di consegna</label>
                                <input type="text" class="form-control" id="deliveryAddress" name="deliveryAddress" required>
                                <div class="invalid-feedback">Inserisci l'indirizzo di consegna</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="paymentMethod" class="form-label">Metodo di pagamento</label>
                                <select class="form-select" id="paymentMethod" name="paymentMethod" required>
                                    <option value="">Seleziona...</option>
                                    <option value="Carta di credito">Carta di credito</option>
                                    <option value="PayPal">PayPal</option>
                                    <option value="Contanti">Contanti</option>
                                </select>
                                <div class="invalid-feedback">Seleziona un metodo di pagamento</div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="orderNotes" class="form-label">Note per la consegna (opzionale)</label>
                            <textarea class="form-control" id="orderNotes" name="orderNotes" rows="2"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="wizard-buttons">
                    <button type="button" class="btn btn-outline-secondary" id="prevStepBtn" style="display:none;">
                        <i class="fas fa-arrow-left me-1"></i> Indietro
                    </button>
                    <button type="button" class="btn btn-primary" id="nextStepBtn">
                        Avanti <i class="fas fa-arrow-right ms-1"></i>
                    </button>
                    <button type="button" class="btn btn-success" id="saveOrderBtn" style="display:none;">
                        <i class="fas fa-check me-1"></i> Crea Ordine
                    </button>
                </div>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annulla</button>
            </div>
        </div>
    </div>
</div>