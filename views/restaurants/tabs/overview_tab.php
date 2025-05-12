<?php
/**
 * Tab Panoramica per il modal dei dettagli del ristorante
 */
?>
<!-- Tab Panoramica -->
<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-hover h-100 profile-card" style="max-height: 280px;">
                <div class="profile-banner"></div>
                <div class="card-body text-center position-relative pt-5">
                    <div class="profile-image-container mx-auto">
                        <div class="profile-image-wrapper restaurant-avatar">
                            <i class="fas fa-store fa-2x"></i>
                        </div>
                    </div>
                    <h4 class="mt-3 mb-1 restaurant-name">Nome Ristorante</h4>
                    
                    <div class="driver-rating-large mb-2 d-flex justify-content-center align-items-center">
                        <span class="rating-bubble me-2 restaurant-rating">4.5</span>
                        <div class="rating-stars text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <span class="status-badge status-active restaurant-status">Attivo</span>
                    </div>
                    
                    <div class="contact-buttons">
                        <a href="tel:" class="btn driver-btn-action driver-btn-primary-soft me-2 restaurant-phone-link" data-bs-toggle="tooltip" title="Chiama">
                            <i class="fas fa-phone-alt"></i>
                        </a>
                        <a href="mailto:" class="btn driver-btn-action driver-btn-info-soft me-2 restaurant-email-link" data-bs-toggle="tooltip" title="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                        <a href="#" target="_blank" class="btn driver-btn-action driver-btn-success-soft restaurant-map-link" data-bs-toggle="tooltip" title="Mappa">
                            <i class="fas fa-map-marker-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-3">
            <div class="card border-0 shadow-hover h-100" style="max-height: 280px;">
                <div class="card-body">
                    <h5 class="card-title d-flex align-items-center">
                        <span class="icon-circle bg-primary-light driver-text-primary me-2">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        Informazioni Generali
                    </h5>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="detail-label">ID Ristorante</div>
                            <div class="detail-value restaurant-id">RST-1001</div>
                        </div>
                        <div class="info-item">
                            <div class="detail-label">Tipologia</div>
                            <div class="detail-value restaurant-cuisine">Pizzeria</div>
                        </div>
                        <div class="info-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value restaurant-email">info@ristorante.it</div>
                        </div>
                        <div class="info-item">
                            <div class="detail-label">Telefono</div>
                            <div class="detail-value restaurant-phone">+39 02 1234567</div>
                        </div>
                        <div class="info-item">
                            <div class="detail-label">Indirizzo</div>
                            <div class="detail-value restaurant-address">Via Roma 123, Milano</div>
                        </div>
                        <div class="info-item">
                            <div class="detail-label">Orari</div>
                            <div class="detail-value restaurant-hours">11:00 - 23:00</div>
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
                            <i class="fas fa-chart-pie"></i>
                        </span>
                        Metriche principali
                    </h5>
                    <div class="stats-grid mt-4">
                        <div class="stat-card stat-card-primary animate-float">
                            <div class="stat-pattern"></div>
                            <div class="stat-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-title">Ordini totali</div>
                                <div class="stat-value restaurant-orders">158</div>
                                <div class="stat-change positive">
                                    <i class="fas fa-arrow-up"></i> 12% rispetto al mese scorso
                                </div>
                            </div>
                        </div>
                        
                        <div class="stat-card stat-card-accent-1 animate-float">
                            <div class="stat-pattern"></div>
                            <div class="stat-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-title">Rating medio</div>
                                <div class="stat-value restaurant-rating-count">4.5</div>
                                <div class="stat-change positive">
                                    <i class="fas fa-arrow-up"></i> 0.2 punti rispetto al mese scorso
                                </div>
                            </div>
                        </div>
                        
                        <div class="stat-card stat-card-accent-2 animate-float">
                            <div class="stat-pattern"></div>
                            <div class="stat-icon">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-title">Recensioni</div>
                                <div class="stat-value restaurant-reviews-count">36</div>
                                <div class="stat-change positive">
                                    <i class="fas fa-arrow-up"></i> 8% rispetto al mese scorso
                                </div>
                            </div>
                        </div>
                        
                        <div class="stat-card stat-card-secondary animate-float">
                            <div class="stat-pattern"></div>
                            <div class="stat-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-title">Reclami</div>
                                <div class="stat-value restaurant-complaints">3</div>
                                <div class="stat-change negative">
                                    <i class="fas fa-arrow-up"></i> 1 in più rispetto al mese scorso
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-hover h-100">
                <div class="card-body">
                    <h5 class="card-title d-flex align-items-center">
                        <span class="icon-circle bg-warning-light driver-text-warning me-2">
                            <i class="fas fa-utensils"></i>
                        </span>
                        Prodotti più ordinati
                    </h5>
                    <div class="restaurant-top-products">
                        <div class="top-product-item d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="top-product-rank">1</div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Margherita</h6>
                                <p class="text-muted small mb-0">Pizza</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge-pill bg-primary-light driver-text-primary">142 ordini</span>
                            </div>
                        </div>
                        
                        <div class="top-product-item d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="top-product-rank">2</div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Diavola</h6>
                                <p class="text-muted small mb-0">Pizza</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge-pill bg-primary-light driver-text-primary">98 ordini</span>
                            </div>
                        </div>
                        
                        <div class="top-product-item d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="top-product-rank">3</div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Coca Cola</h6>
                                <p class="text-muted small mb-0">Bevanda</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge-pill bg-primary-light driver-text-primary">76 ordini</span>
                            </div>
                        </div>
                        
                        <div class="top-product-item d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="top-product-rank">4</div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Quattro Stagioni</h6>
                                <p class="text-muted small mb-0">Pizza</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge-pill bg-primary-light driver-text-primary">65 ordini</span>
                            </div>
                        </div>
                        
                        <div class="top-product-item d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="top-product-rank">5</div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Tiramisù</h6>
                                <p class="text-muted small mb-0">Dessert</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge-pill bg-primary-light driver-text-primary">53 ordini</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-hover mb-3" style="max-height: 140px;">
                <div class="card-body p-3">
                    <h5 class="card-title d-flex align-items-center mb-2">
                        <span class="icon-circle bg-success-light driver-text-success me-2">
                            <i class="fas fa-credit-card"></i>
                        </span>
                        Modalità di pagamento accettate
                    </h5>
                    <div class="payment-methods">
                        <div class="d-flex flex-wrap gap-2">
                            <div class="payment-method-item d-flex align-items-center">
                                <span class="icon-circle bg-success-soft driver-text-success me-1" style="width: 22px; height: 22px;">
                                    <i class="fas fa-money-bill-wave fa-sm"></i>
                                </span>
                                <span>Contanti</span>
                            </div>
                            
                            <div class="payment-method-item d-flex align-items-center ms-2">
                                <span class="icon-circle bg-primary-soft driver-text-primary me-1" style="width: 22px; height: 22px;">
                                    <i class="fab fa-cc-visa fa-sm"></i>
                                </span>
                                <span>Carta di credito</span>
                            </div>
                            
                            <div class="payment-method-item d-flex align-items-center ms-2">
                                <span class="icon-circle bg-info-soft driver-text-info me-1" style="width: 22px; height: 22px;">
                                    <i class="fab fa-paypal fa-sm"></i>
                                </span>
                                <span>PayPal</span>
                            </div>
                            
                            <div class="payment-method-item d-flex align-items-center ms-2">
                                <span class="icon-circle bg-warning-soft driver-text-warning me-1" style="width: 22px; height: 22px;">
                                    <i class="fas fa-mobile-alt fa-sm"></i>
                                </span>
                                <span>Google Pay</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card border-0 shadow-hover" style="max-height: 140px;">
                <div class="card-body p-3">
                    <h5 class="card-title d-flex align-items-center mb-2">
                        <span class="icon-circle bg-warning-light driver-text-warning me-2">
                            <i class="fas fa-comment-alt"></i>
                        </span>
                        Note
                    </h5>
                    <div class="notes-container p-2 bg-light rounded">
                        <p class="restaurant-notes mb-0 small">Ristorante con ottima reputazione. Preferisce che i driver arrivino con 5 minuti di anticipo. Il gestore è molto attento alla qualità del servizio di consegna.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>