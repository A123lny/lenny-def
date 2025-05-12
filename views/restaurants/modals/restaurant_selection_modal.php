<?php
/**
 * Modal per selezione ristorante
 * Questo file contiene il modal per la selezione dei ristoranti
 */
?>
<!-- Modal per la selezione del ristorante -->
<div class="modal fade" id="selectRestaurantModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" style="max-width: 1280px;"><!-- Dimensione personalizzata -->
        <div class="modal-content border-0">
            <div class="modal-header position-relative p-0 border-0">
                <div class="modal-header-bg w-100"></div>
                <div class="modal-title-container p-3 position-relative w-100 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title d-flex align-items-center">
                        <span class="modal-icon-wrapper me-2">
                            <i class="fas fa-store"></i>
                        </span>
                        Seleziona Ristorante
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0 border-0">
                <!-- Contenitore principale con padding interno -->
                <div class="p-3">
                    <!-- Barra di ricerca -->
                    <div class="restaurant-search mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" id="modalSearchRestaurant" placeholder="Cerca ristorante per nome..." autocomplete="off">
                        </div>
                    </div>
                    
                    <!-- Filtro alfabetico -->
                    <div class="alphabetical-filter mb-4">
                        <div class="alpha-filter-container">
                            <span class="alpha-item active" data-letter="all">Tutti</span>
                            <?php 
                            // Aggiungi tutte le lettere dell'alfabeto
                            foreach (range('A', 'Z') as $letter): 
                            ?>
                                <span class="alpha-item" data-letter="<?= $letter ?>"><?= $letter ?></span>
                            <?php endforeach; ?>
                            <span class="alpha-item" data-letter="0-9">0-9</span>
                        </div>
                    </div>
                    
                    <!-- Elenco ristoranti in griglia -->
                    <div class="restaurant-grid" id="restaurantGridContainer">
                        <?php 
                        // Utilizziamo gli stessi dati già definiti sopra
                        foreach ($restaurantData as $restaurant): 
                        $firstLetter = strtoupper(substr($restaurant['name'], 0, 1));
                        $letterClass = ctype_alpha($firstLetter) ? $firstLetter : '0-9';
                        ?>
                        <div class="restaurant-card shadow-hover" data-id="<?= $restaurant['id'] ?>" data-name="<?= strtolower($restaurant['name']) ?>" data-letter="<?= $letterClass ?>">
                            <div class="restaurant-card-content">
                                <div class="restaurant-card-compact">
                                    <div class="restaurant-card-info">
                                        <div>
                                            <h5 class="restaurant-card-title"><?= $restaurant['name'] ?></h5>
                                            <p class="restaurant-card-address">
                                                <i class="fas fa-map-marker-alt me-1"></i> <?= $restaurant['address'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        <?php if ($restaurant['active']): ?>
                                            <span class="status-badge status-active">Attivo</span>
                                        <?php else: ?>
                                            <span class="status-badge status-inactive">Inattivo</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="restaurant-card-action">
                                <button type="button" class="btn btn-primary btn-sm manage-restaurant-btn" data-id="<?= $restaurant['id'] ?>">
                                    <i class="fas fa-cog me-1"></i> Gestisci
                                </button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Messaggio per nessun risultato -->
                    <div id="noResultsMessage" class="text-center py-5" style="display: none;">
                        <div class="empty-state">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h5>Nessun risultato trovato</h5>
                            <p class="text-muted">Prova a modificare la tua ricerca o a selezionare un'altra lettera.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light driver-modal-button" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>