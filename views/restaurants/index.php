<?php require_once 'views/layout/header.php'; ?>

<div class="section-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="section-title">Gestione Ristoranti</h2>
        <p class="section-subtitle">Da qui potrai gestire comodamente tutti i ristoranti partner della tua piattaforma di food delivery. Aggiungi nuovi ristoranti, consulta lo storico e visualizza le statistiche di ogni locale partner.</p>
    </div>
    </div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100 gradient-hover restaurant-gradient-card">
            <!-- Cerchi decorativi -->
            <div class="decorative-circle decorative-circle--top-right"></div>
            <div class="decorative-circle decorative-circle--bottom-left"></div>
            
            <div class="card-body d-flex flex-column p-4 position-relative z-index-2">
                <div class="text-center mb-4">
                    <!-- Icona centrata e uniforme -->
                    <div class="mb-3 mx-auto d-flex align-items-center justify-content-center card-icon-wrapper">
                        <i class="fas fa-plus fa-2x text-white"></i>
                    </div>
                    <h5 class="card-title fw-bold">Nuovo Ristorante</h5>
                    <p class="card-text text-muted">Aggiungi un nuovo ristorante partner alla tua piattaforma di food delivery.</p>
                </div>
                <div class="mt-auto text-center">
                    <button type="button" class="btn btn-lg shadow-sm btn-gradient-primary" data-bs-toggle="modal" data-bs-target="#newRestaurantWizardModal">
                        <i class="fas fa-plus me-2"></i> Nuovo Ristorante
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100 gradient-hover restaurant-gradient-card restaurant-gradient-card--green">
            <!-- Cerchi decorativi -->
            <div class="decorative-circle decorative-circle--top-right decorative-circle--green"></div>
            <div class="decorative-circle decorative-circle--bottom-left decorative-circle--green"></div>
            
            <div class="card-body d-flex flex-column p-4 position-relative z-index-2">
                <div class="text-center mb-4">
                    <!-- Icona centrata e uniforme con lo stesso stile -->
                    <div class="mb-3 mx-auto d-flex align-items-center justify-content-center card-icon-wrapper card-icon-wrapper--green">
                        <i class="fas fa-store fa-2x text-white"></i>
                    </div>
                    <h5 class="card-title fw-bold">Seleziona Ristorante</h5>
                    <p class="card-text text-muted">Visualizza e modifica i dettagli di un ristorante esistente.</p>
                </div>
                <div class="mt-auto text-center">
                    <button type="button" class="btn btn-lg shadow-sm btn-gradient-green" data-bs-toggle="modal" data-bs-target="#selectRestaurantModal">
                        <i class="fas fa-edit me-2"></i> Seleziona Ristorante
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <!-- Container principale dei ristoranti con lo stile della panoramica driver -->
        <div class="drivers-container mb-4">
            <!-- Intestazione e filtri -->
            <div class="drivers-header">
                <div class="d-flex align-items-center flex-grow-1 flex-wrap">
                    <div class="input-group search-box me-2">
                        <span class="input-group-text">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control" id="searchRestaurant" placeholder="Cerca ristorante...">
                    </div>
                </div>
                
                <div class="dropdown ms-2">
                    <button type="button" class="btn btn-primary dropdown-toggle" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-download me-1"></i> Esporta
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="exportDropdown">
                        <li><a class="dropdown-item" href="#" id="exportCSV"><i class="fas fa-file-csv me-2"></i> Esporta CSV</a></li>
                        <li><a class="dropdown-item" href="#" id="exportPDF"><i class="fas fa-file-pdf me-2"></i> Esporta PDF</a></li>
                        <li><a class="dropdown-item" href="#" id="exportExcel"><i class="fas fa-file-excel me-2"></i> Esporta Excel</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Tabella ristoranti -->
            <div class="drivers-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Ristorante</th>
                            <th scope="col">Indirizzo</th>
                            <th scope="col">Contatto</th>
                            <th scope="col">Ordini totali</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Stato</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Array di dati di esempio per i ristoranti
                        $restaurantData = [
                            [
                                'id' => 1,
                                'name' => 'Pizzeria Napoli',
                                'address' => 'Via Verdi 28, Milano',
                                'phone' => '+39 02 1234567',
                                'orders' => 387,
                                'rating' => 4.8,
                                'active' => true,
                                'image' => 'restaurant1.jpg'
                            ],
                            [
                                'id' => 2,
                                'name' => 'Sushi Master',
                                'address' => 'Via Milano 42, Milano',
                                'phone' => '+39 02 7654321',
                                'orders' => 264,
                                'rating' => 4.5,
                                'active' => true,
                                'image' => 'restaurant2.jpg'
                            ],
                            [
                                'id' => 3,
                                'name' => 'Burger King',
                                'address' => 'Corso Buenos Aires 12, Milano',
                                'phone' => '+39 02 8901234',
                                'orders' => 512,
                                'rating' => 4.2,
                                'active' => true,
                                'image' => 'restaurant3.jpg'
                            ],
                            [
                                'id' => 4,
                                'name' => 'Ristorante Bella Italia',
                                'address' => 'Via Roma 78, Milano',
                                'phone' => '+39 02 3456789',
                                'orders' => 193,
                                'rating' => 4.7,
                                'active' => true,
                                'image' => 'restaurant4.jpg'
                            ],
                            [
                                'id' => 5,
                                'name' => 'Trattoria Da Giuseppe',
                                'address' => 'Via Dante 15, Milano',
                                'phone' => '+39 02 6789012',
                                'orders' => 146,
                                'rating' => 4.6,
                                'active' => false,
                                'image' => 'restaurant5.jpg'
                            ],
                            [
                                'id' => 6,
                                'name' => 'Sushi Fusion',
                                'address' => 'Viale Monza 25, Milano',
                                'phone' => '+39 02 5432109',
                                'orders' => 208,
                                'rating' => 4.3,
                                'active' => true,
                                'image' => 'restaurant6.jpg'
                            ]
                        ];
                        
                        foreach ($restaurantData as $restaurant): 
                        ?>
                            <tr class="restaurant-item" data-id="<?= $restaurant['id'] ?>" data-name="<?= strtolower($restaurant['name']) ?>">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="restaurant-avatar">
                                                <i class="fas fa-store"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 fw-bold"><?= $restaurant['name'] ?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><i class="fas fa-map-marker-alt me-1 location-marker"></i> <?= $restaurant['address'] ?></small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted"><i class="fas fa-phone me-1"></i> <?= $restaurant['phone'] ?></small>
                                        <small class="text-muted"><i class="fas fa-envelope me-1"></i> info@<?= strtolower(str_replace(' ', '', $restaurant['name'])) ?>.it</small>
                                    </div>
                                </td>
                                <td><span class="fw-bold"><?= $restaurant['orders'] ?></span></td>
                                <td>
                                    <div class="driver-rating">
                                        <span class="rating-value"><?= $restaurant['rating'] ?></span>
                                        <?php 
                                        $fullStars = floor($restaurant['rating']);
                                        $halfStar = round($restaurant['rating'] - $fullStars, 1) >= 0.5;
                                        
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $fullStars) {
                                                echo '<i class="fas fa-star text-warning"></i>';
                                            } elseif ($halfStar && $i == $fullStars + 1) {
                                                echo '<i class="fas fa-star-half-alt text-warning"></i>';
                                                $halfStar = false;
                                            } else {
                                                echo '<i class="far fa-star text-muted"></i>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($restaurant['active']): ?>
                                        <span class="status-badge badge-success">attivo</span>
                                    <?php else: ?>
                                        <span class="status-badge badge-danger">inattivo</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Paginazione e info -->
            <div class="drivers-footer">
                <div class="text-muted small">
                    Mostrando <strong>6</strong> di <strong>6</strong> ristoranti
                </div>
                <nav>
                    <ul class="pagination pagination-sm">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-disabled="true"><i class="fas fa-angle-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item disabled">
                            <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Modal per la creazione del nuovo ristorante -->
<?php
/**
 * Include del modal wizard per la creazione di un nuovo ristorante
 */
require_once 'views/restaurants/modals/restaurant_wizard_modal.php';
?>

<!-- Modal per la selezione e gestione del ristorante -->
<?php
/**
 * Include del modal per la selezione dei ristoranti
 */
require_once 'views/restaurants/modals/restaurant_selection_modal.php';

/**
 * Include del modal per la gestione del ristorante
 */
require_once 'views/restaurants/modals/restaurant_management_modal.php';
?>

<!-- Modal per i dettagli del ristorante -->
<?php
/**
 * Include del modal per visualizzare i dettagli e le statistiche del ristorante
 */
require_once 'views/restaurants/modals/restaurant_details_modal.php';
?>

<!-- Includi le librerie esterne necessarie -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

<!-- Script per trasferire i dati dal PHP al JavaScript -->
<script>
    // Passa i dati dei ristoranti al JavaScript
    window.restaurantData = <?= json_encode($restaurantData) ?>;
</script>

<?php require_once 'views/layout/footer.php'; ?>