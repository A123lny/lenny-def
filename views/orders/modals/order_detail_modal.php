<?php
/**
 * Modal per visualizzare i dettagli di un ordine
 * Include informazioni sul cliente, dettagli dell'ordine, prodotti ordinati e timeline stato
 * Il CSS e JavaScript sono stati spostati in file esterni:
 * - assets/css/4-components/_order_details.css
 * - assets/js/4-components/order-detail.js
 */
?>
<!-- Modal Dettaglio Ordine -->
<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <!-- Header con sfondo sfumato -->
            <div class="modal-header position-relative p-0 border-0">
                <div class="modal-header-bg w-100"></div>
                <div class="modal-title-container p-3 d-flex w-100 align-items-center">
                    <div class="modal-icon-wrapper me-3">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h5 class="modal-title" id="orderDetailModalLabel">
                        Dettaglio Ordine <span id="orderDetailNumber"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <!-- Timeline stato ordine - spostata in alto -->
                <div class="detail-section mb-4">
                    <h6 class="detail-section-title">
                        <div class="icon-circle bg-success-soft me-2">
                            <i class="fas fa-chart-line driver-text-success"></i>
                        </div>
                        Stato dell'ordine
                    </h6>
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="order-timeline">
                                <div class="timeline-step" id="timelineOrdered">
                                    <div class="timeline-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                        <div class="pulse-ring"></div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-title">Ordinato</div>
                                        <div class="timeline-date" id="orderedTime">-</div>
                                    </div>
                                    <div class="timeline-progress-bar"></div>
                                </div>
                                <div class="timeline-step" id="timelinePreparing">
                                    <div class="timeline-icon">
                                        <i class="fas fa-utensils"></i>
                                        <div class="pulse-ring"></div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-title">In preparazione</div>
                                        <div class="timeline-date" id="preparingTime">-</div>
                                    </div>
                                    <div class="timeline-progress-bar"></div>
                                </div>
                                <div class="timeline-step" id="timelineDelivering">
                                    <div class="timeline-icon">
                                        <i class="fas fa-motorcycle"></i>
                                        <div class="pulse-ring"></div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-title">In consegna</div>
                                        <div class="timeline-date" id="deliveringTime">-</div>
                                    </div>
                                    <div class="timeline-progress-bar"></div>
                                </div>
                                <div class="timeline-step" id="timelineDelivered">
                                    <div class="timeline-icon">
                                        <i class="fas fa-check"></i>
                                        <div class="pulse-ring"></div>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-title">Consegnato</div>
                                        <div class="timeline-date" id="deliveredTime">-</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Colonna sinistra - Info Cliente e Ordine -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <!-- Sezione Cliente -->
                        <div class="detail-section">
                            <h6 class="detail-section-title">
                                <div class="icon-circle bg-primary-light me-2">
                                    <i class="fas fa-user driver-text-primary"></i>
                                </div>
                                Informazioni Cliente
                            </h6>
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="customer-info-grid">
                                        <div class="info-item">
                                            <div class="info-label"><i class="fas fa-user me-2"></i>Nome</div>
                                            <div class="info-value" id="customerName">-</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label"><i class="fas fa-phone me-2"></i>Telefono</div>
                                            <div class="info-value" id="customerPhone">-</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label"><i class="fas fa-envelope me-2"></i>Email</div>
                                            <div class="info-value" id="customerEmail">-</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label"><i class="fas fa-map-marker-alt me-2"></i>Indirizzo</div>
                                            <div class="info-value" id="customerAddress">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sezione Informazioni Ordine (risoluzione problema) -->
                        <div class="detail-section mt-4">
                            <h6 class="detail-section-title">
                                <div class="icon-circle bg-info-light me-2">
                                    <i class="fas fa-shopping-bag driver-text-info"></i>
                                </div>
                                Informazioni Ordine
                            </h6>
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="info-table">
                                        <!-- Data ordine -->
                                        <div class="info-row d-flex justify-content-between align-items-center mb-2">
                                            <div class="info-label"><i class="fas fa-calendar me-2"></i>Data Ordine:</div>
                                            <div class="info-value fw-bold" id="orderDate">-</div>
                                        </div>
                                        
                                        <!-- Data consegna (soluzione fissa) -->
                                        <div class="info-row d-flex justify-content-between align-items-center mb-2">
                                            <div class="info-label"><i class="fas fa-clock me-2"></i>Data e Ora Consegna:</div>
                                            <div class="info-value fw-bold" id="deliveryDateFixed">-</div>
                                        </div>
                                        
                                        <!-- Ristorante -->
                                        <div class="info-row d-flex justify-content-between align-items-center mb-2">
                                            <div class="info-label"><i class="fas fa-store me-2"></i>Ristorante:</div>
                                            <div class="info-value fw-bold" id="restaurantName">-</div>
                                        </div>
                                        
                                        <!-- Pagamento (soluzione fissa) -->
                                        <div class="info-row d-flex justify-content-between align-items-center mb-2">
                                            <div class="info-label"><i class="fas fa-credit-card me-2"></i>Pagamento:</div>
                                            <div class="info-value fw-bold" id="paymentMethodFixed">-</div>
                                        </div>
                                        
                                        <!-- Stato -->
                                        <div class="info-row d-flex justify-content-between align-items-center mb-2">
                                            <div class="info-label"><i class="fas fa-tag me-2"></i>Stato:</div>
                                            <div class="info-value">
                                                <span class="order-status-badge" id="orderStatus">-</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Note ordine -->
                                        <div class="info-row d-flex flex-column mb-0">
                                            <div class="info-label mb-1"><i class="fas fa-sticky-note me-2"></i>Note:</div>
                                            <div class="info-value" id="orderNotesDetail">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Colonna destra - Prodotti e Driver -->
                    <div class="col-lg-8">
                        <!-- Prodotti ordinati -->
                        <div class="detail-section">
                            <h6 class="detail-section-title">
                                <div class="icon-circle bg-primary-light me-2">
                                    <i class="fas fa-list driver-text-primary"></i>
                                </div>
                                Prodotti ordinati
                            </h6>
                            <div class="custom-table-container">
                                <table class="table custom-table" id="orderItemsDetailTable">
                                    <thead>
                                        <tr>
                                            <th>Prodotto</th>
                                            <th class="text-center">Qtà</th>
                                            <th class="text-end">Prezzo</th>
                                            <th class="text-end">Totale</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="noProductsDetailRow">
                                            <td colspan="4" class="text-center py-3">Nessun prodotto disponibile</td>
                                        </tr>
                                        <!-- Gli elementi verranno generati dinamicamente -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Subtotale:</strong></td>
                                            <td class="text-end" id="subtotalAmount">0,00€</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Spese di consegna:</strong></td>
                                            <td class="text-end" id="deliveryFeeAmount">0,00€</td>
                                        </tr>
                                        <tr class="table-active">
                                            <td colspan="3" class="text-end"><strong>Totale:</strong></td>
                                            <td class="text-end"><strong id="totalDetailAmount">0,00€</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- Informazioni Driver (se in consegna o consegnato) -->
                        <div class="detail-section mt-4" id="driverInfoSection" style="display:none;">
                            <h6 class="detail-section-title">
                                <div class="icon-circle bg-success-soft me-2">
                                    <i class="fas fa-motorcycle driver-text-success"></i>
                                </div>
                                Informazioni Consegna
                            </h6>
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-gradient-primary me-3" id="driverInitials">-</div>
                                        <div>
                                            <h6 class="mb-1" id="driverName">-</h6>
                                            <span class="text-muted small" id="driverPhone">-</span>
                                        </div>
                                        <div class="ms-auto contact-buttons">
                                            <button class="btn driver-btn-action driver-btn-primary-soft me-2" id="callDriverBtn">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn driver-btn-action driver-btn-info-soft" id="trackDeliveryBtn">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light driver-modal-button" data-bs-dismiss="modal">Chiudi</button>
                <button type="button" class="btn btn-primary driver-modal-button" id="printOrderDetailBtn">
                    <i class="fas fa-print me-1"></i> Stampa
                </button>
            </div>
        </div>
    </div>
</div>