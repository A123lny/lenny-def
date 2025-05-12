<?php
/**
 * Modal per visualizzazione dettagli driver
 * Questo file contiene il codice HTML per il modale che mostra i dettagli di un driver
 */
?>
<!-- Modal Visualizza Driver -->
<div class="modal fade" id="viewDriverModal" tabindex="-1" aria-labelledby="viewDriverModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header position-relative p-0">
                <div class="modal-header-bg w-100"></div>
                <div class="modal-title-container p-3 position-relative w-100 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title d-flex align-items-center" id="viewDriverModalLabel">
                        <span class="modal-icon-wrapper me-2">
                            <i class="fas fa-id-badge"></i>
                        </span>
                        Dettagli Driver: <span id="modalDriverName" class="ms-2 fw-bold"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0">
                <!-- Tabs di navigazione -->
                <ul class="nav nav-tabs custom-tabs" id="driverDetailTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                            <i class="fas fa-user me-2"></i>Profilo
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab" aria-controls="activity" aria-selected="false">
                            <i class="fas fa-chart-line me-2"></i>Attività
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" type="button" role="tab" aria-controls="payments" aria-selected="false">
                            <i class="fas fa-money-bill-wave me-2"></i>Pagamenti
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="vehicles-tab" data-bs-toggle="tab" data-bs-target="#vehicles" type="button" role="tab" aria-controls="vehicles" aria-selected="false">
                            <i class="fas fa-motorcycle me-2"></i>Mezzi
                        </button>
                    </li>
                </ul>

                <!-- Contenuto dei tab -->
                <div class="tab-content p-4" id="driverDetailTabsContent">
                    <!-- Tab Profilo -->
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <?php include 'views/drivers/tabs/profile_tab.php'; ?>
                    </div>

                    <!-- Tab Attività -->
                    <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                        <?php include 'views/drivers/tabs/activity_tab.php'; ?>
                    </div>

                    <!-- Tab Pagamenti -->
                    <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                        <?php include 'views/drivers/tabs/payments_tab.php'; ?>
                    </div>

                    <!-- Tab Mezzi -->
                    <div class="tab-pane fade" id="vehicles" role="tabpanel" aria-labelledby="vehicles-tab">
                        <?php include 'views/drivers/tabs/vehicles_tab.php'; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-light driver-modal-button" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Chiudi
                </button>
                <div>
                    <button type="button" class="btn btn-success me-2 driver-modal-button" id="exportDriverReport">
                        <i class="fas fa-file-export me-1"></i> Esporta Report
                    </button>
                    <button type="button" class="btn btn-primary driver-modal-button" id="editDriverBtn">
                        <i class="fas fa-edit me-1"></i> Modifica Driver
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Il CSS del modale è stato spostato in assets/css/4-components/drivers/_driver_view.css -->
<!-- JavaScript per gestire il modale è in assets/js/5-pages/drivers/panoramica.js -->