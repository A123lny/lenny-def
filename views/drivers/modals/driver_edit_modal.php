<?php
// Modal per la modifica dei dati del driver
?>
<!-- Modal Modifica Driver -->
<div class="modal fade" id="editDriverModal" tabindex="-1" aria-labelledby="editDriverModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header position-relative p-0">
                <div class="modal-header-bg w-100"></div>
                <div class="modal-title-container p-3 position-relative w-100 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title d-flex align-items-center" id="editDriverModalLabel">
                        <span class="modal-icon-wrapper me-2">
                            <i class="fas fa-user-edit"></i>
                        </span>
                        Modifica Driver: <span id="editModalDriverName" class="ms-2 fw-bold">Nome Driver</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0">
                <!-- Tabs di navigazione -->
                <ul class="nav nav-tabs custom-tabs" id="driverEditTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
                            <i class="fas fa-user me-2"></i>Informazioni
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rates-tab" data-bs-toggle="tab" data-bs-target="#rates" type="button" role="tab" aria-controls="rates" aria-selected="false">
                            <i class="fas fa-money-bill me-2"></i>Tariffe
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="bonus-tab" data-bs-toggle="tab" data-bs-target="#bonus" type="button" role="tab" aria-controls="bonus" aria-selected="false">
                            <i class="fas fa-award me-2"></i>Bonus e Incentivi
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="payment-settings-tab" data-bs-toggle="tab" data-bs-target="#payment-settings" type="button" role="tab" aria-controls="payment-settings" aria-selected="false">
                            <i class="fas fa-cog me-2"></i>Impostazioni Pagamenti
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="refunds-tab" data-bs-toggle="tab" data-bs-target="#refunds" type="button" role="tab" aria-controls="refunds" aria-selected="false">
                            <i class="fas fa-hand-holding-usd me-2"></i>Rimborsi
                        </button>
                    </li>
                </ul>

                <!-- Contenuto dei tab -->
                <div class="tab-content p-4" id="driverEditTabsContent">
                    <!-- Tab Informazioni -->
                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                        <?php require_once 'views/drivers/tabs/info_tab.php'; ?>
                    </div>

                    <!-- Tab Tariffe -->
                    <div class="tab-pane fade" id="rates" role="tabpanel" aria-labelledby="rates-tab">
                        <?php require_once 'views/drivers/tabs/rates_tab.php'; ?>
                    </div>

                    <!-- Tab Bonus e Incentivi -->
                    <div class="tab-pane fade" id="bonus" role="tabpanel" aria-labelledby="bonus-tab">
                        <?php require_once 'views/drivers/tabs/bonus_tab.php'; ?>
                    </div>

                    <!-- Tab Impostazioni Pagamenti -->
                    <div class="tab-pane fade" id="payment-settings" role="tabpanel" aria-labelledby="payment-settings-tab">
                        <?php require_once 'views/drivers/tabs/payment_settings_tab.php'; ?>
                    </div>

                    <!-- Tab Rimborsi -->
                    <div class="tab-pane fade" id="refunds" role="tabpanel" aria-labelledby="refunds-tab">
                        <?php require_once 'views/drivers/tabs/refunds_tab.php'; ?>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-light driver-modal-button" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Chiudi
                </button>
            </div>
        </div>
    </div>
</div>