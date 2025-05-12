<?php
/**
 * Modal per visualizzazione dettagli ristorante
 * Questo file contiene il modale per visualizzare i dettagli e le statistiche di un ristorante
 */
?>
<!-- Modal per visualizzare i dettagli e le statistiche del ristorante -->
<div class="modal fade" id="restaurantDetailsModal" tabindex="-1" aria-labelledby="restaurantDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header position-relative p-0">
                <div class="modal-header-bg w-100"></div>
                <div class="modal-title-container p-3 position-relative w-100 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title d-flex align-items-center" id="restaurantDetailsModalLabel">
                        <span class="modal-icon-wrapper me-2">
                            <i class="fas fa-store"></i>
                        </span>
                        Dettagli Ristorante: <span id="modalRestaurantName" class="ms-2 fw-bold"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0">
                <!-- Tabs di navigazione -->
                <ul class="nav nav-tabs custom-tabs" id="restaurantDetailTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">
                            <i class="fas fa-info-circle me-2"></i>Panoramica
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="stats-tab" data-bs-toggle="tab" data-bs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="false">
                            <i class="fas fa-chart-line me-2"></i>Statistiche
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">
                            <i class="fas fa-star me-2"></i>Recensioni
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab" aria-controls="delivery" aria-selected="false">
                            <i class="fas fa-truck me-2"></i>Consegne
                        </button>
                    </li>
                </ul>

                <!-- Contenuto dei tab -->
                <div class="tab-content p-4" id="restaurantDetailTabsContent">
                    <?php
                    // Includi il contenuto delle tab
                    require_once 'views/restaurants/tabs/overview_tab.php';
                    require_once 'views/restaurants/tabs/stats_tab.php';
                    require_once 'views/restaurants/tabs/reviews_tab.php';
                    require_once 'views/restaurants/tabs/delivery_tab.php';
                    ?>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-light driver-modal-button" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Chiudi
                </button>
                <div>
                    <button type="button" class="btn btn-success me-2 driver-modal-button" id="exportRestaurantReport">
                        <i class="fas fa-file-export me-1"></i> Esporta Report
                    </button>
                    <button type="button" class="btn btn-primary driver-modal-button" id="editRestaurantBtn">
                        <i class="fas fa-edit me-1"></i> Modifica Ristorante
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>