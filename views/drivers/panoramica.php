<?php 
$pageTitle = 'Panoramica Driver';
require_once 'views/layout/header.php';
?>

<div class="section-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="section-title">Panoramica Driver</h2>
        <p class="section-subtitle">Gestisci e monitora tutti i driver della piattaforma</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-primary" id="newDriverBtn">
            <i class="fas fa-plus me-1"></i> Nuovo driver
        </button>
    </div>
</div>

<!-- Statistiche principali nello stile della dashboard -->
<div class="stats-grid mb-4">
    <div class="stat-card stat-card-primary animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-motorcycle"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Driver totali</div>
            <div class="stat-value">28</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 12.5% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-secondary animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Driver attivi</div>
            <div class="stat-value">22</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 8.2% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-1 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-truck"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Consegne completate</div>
            <div class="stat-value">1.382</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 15.7% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-2 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-star"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Rating medio</div>
            <div class="stat-value">4.7</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 0.3 punti rispetto al mese scorso
            </div>
        </div>
    </div>
</div>

<!-- Tabella driver con filtri integrati -->
<div class="drivers-container mb-4">
    <!-- Intestazione e filtri -->
    <div class="drivers-header">
        <div class="d-flex align-items-center flex-grow-1 flex-wrap">
            <div class="input-group search-box me-2">
                <span class="input-group-text">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control" id="searchQuery" placeholder="Cerca driver...">
            </div>
            
            <div class="d-flex gap-2">
                <select class="form-select" id="tipoFilter" style="min-width: 200px;">
                    <option value="all" selected>Tutti i tipi</option>
                    <option value="indeterminato">Indeterminato</option>
                    <option value="determinato">Determinato</option>
                    <option value="occasionale">Occasionale</option>
                    <option value="part-time">Part-Time</option>
                </select>
            
                <select class="form-select" id="statoFilter" style="min-width: 200px;">
                    <option value="all" selected>Tutti gli stati</option>
                    <option value="attivo">Attivo</option>
                    <option value="inattivo">Inattivo</option>
                    <option value="consegna">In consegna</option>
                </select>
            </div>
        </div>
        
        <div class="dropdown ms-2">
            <button type="button" class="btn btn-primary dropdown-toggle export-btn" id="exportDropdown">
                <i class="fas fa-download me-1"></i> Esporta
            </button>
            <div class="dropdown-menu dropdown-menu-end export-dropdown">
                <a class="dropdown-item" href="#" id="exportCSV"><i class="fas fa-file-csv me-2"></i> Esporta CSV</a>
                <a class="dropdown-item" href="#" id="exportPDF"><i class="fas fa-file-pdf me-2"></i> Esporta PDF</a>
                <a class="dropdown-item" href="#" id="exportExcel"><i class="fas fa-file-excel me-2"></i> Esporta Excel</a>
            </div>
        </div>
    </div>

    <!-- Tabella driver -->
    <div class="drivers-table">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Veicolo</th>
                    <th scope="col">Contatti</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Stato</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($drivers) && !empty($drivers)): ?>
                    <?php foreach ($drivers as $driver): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($driver['name']) ?></strong></td>
                            <td>
                                <?php
                                    // Tipo di contratto (esempio, in realtà dovresti avere questa informazione nel tuo database)
                                    $tipi = ['Indeterminato', 'Determinato', 'Occasionale', 'Part-Time'];
                                    $tipo = $tipi[array_rand($tipi)];
                                    $badgeClass = '';
                                    switch ($tipo) {
                                        case 'Indeterminato':
                                            $badgeClass = 'badge-primary';
                                            break;
                                        case 'Determinato':
                                            $badgeClass = 'badge-info';
                                            break;
                                        case 'Occasionale':
                                            $badgeClass = 'badge-warning';
                                            break;
                                        case 'Part-Time':
                                            $badgeClass = 'badge-success';
                                            break;
                                    }
                                    // Mostra il testo con la prima lettera maiuscola e il resto minuscolo
                                    $tipoFormattato = ucfirst(strtolower($tipo));
                                    echo '<span class="status-badge ' . $badgeClass . '">' . $tipoFormattato . '</span>';
                                ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($driver['vehicle_type']) ?> 
                                <?php
                                    // Generiamo casualmente se il veicolo è aziendale o proprio
                                    $isAziendale = rand(0, 1) === 1;
                                    if ($isAziendale) {
                                        echo '<span class="status-badge badge-purple">Aziendale</span>';
                                    } else {
                                        echo '<span class="status-badge badge-orange">Proprio</span>';
                                    }
                                ?>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <small class="text-muted"><i class="fas fa-phone me-1"></i> <?= htmlspecialchars($driver['phone']) ?></small>
                                    <small class="text-muted"><i class="fas fa-envelope me-1"></i> <?= htmlspecialchars($driver['email']) ?></small>
                                </div>
                            </td>
                            <td>
                                <?php
                                    // Rating simulato per esempio
                                    $rating = number_format((float)rand(30, 50)/10, 1);
                                    echo '<div class="driver-rating">';
                                    echo '<span class="rating-value">' . $rating . '</span> ';
                                    
                                    // Stelle piene
                                    $fullStars = floor($rating);
                                    for ($i = 0; $i < $fullStars; $i++) {
                                        echo '<i class="fas fa-star text-warning"></i>';
                                    }
                                    
                                    // Mezza stella se necessario
                                    if ($rating - $fullStars >= 0.5) {
                                        echo '<i class="fas fa-star-half-alt text-warning"></i>';
                                        $i++;
                                    }
                                    
                                    // Stelle vuote per arrivare a 5
                                    for (; $i < 5; $i++) {
                                        echo '<i class="far fa-star text-muted"></i>';
                                    }
                                    
                                    echo '</div>';
                                ?>
                            </td>
                            <td>
                                <?php
                                    $statusClasses = [
                                        'attivo' => 'badge-success',
                                        'inattivo' => 'badge-danger',
                                        'consegna' => 'badge-warning'
                                    ];
                                    $statusClass = isset($statusClasses[$driver['status']]) ? $statusClasses[$driver['status']] : 'badge-secondary';
                                ?>
                                <span class="status-badge <?= $statusClass ?>"><?= ucfirst(htmlspecialchars($driver['status'])) ?></span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="action-btn view-btn view-driver-btn" data-driver-id="<?= $driver['id'] ?>" data-bs-toggle="tooltip" title="Visualizza">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="action-btn edit-btn edit-driver-btn" data-driver-id="<?= $driver['id'] ?>" data-bs-toggle="tooltip" title="Modifica">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <p>Sembra che la tabella drivers non esista nel database o ci sia un problema con la struttura. 
                            Prova a utilizzare lo script di inizializzazione per crearla.</p>
                            <hr>
                            <p class="mb-0">Dettaglio errore: ' . $e->getMessage() . '</p>
                            <a href="<?= url('drivers', 'initialize') ?>" class="btn btn-primary mt-3">
                                <i class="fas fa-database me-2"></i> Inizializza tabella drivers
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>

                <!-- Esempi di driver se non ci sono record nel database -->
                <?php if (empty($drivers)): ?>
                    <tr>
                        <td><strong>Marco Bianchi</strong></td>
                        <td><span class="status-badge badge-primary">Indeterminato</span></td>
                        <td>Scooter <span class="status-badge badge-purple">Aziendale</span></td>
                        <td>
                            <div class="d-flex flex-column">
                                <small class="text-muted"><i class="fas fa-phone me-1"></i> 3331122334</small>
                                <small class="text-muted"><i class="fas fa-envelope me-1"></i> marco.bianchi@example.com</small>
                            </div>
                        </td>
                        <td>
                            <div class="driver-rating">
                                <span class="rating-value">4.8</span>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge badge-success">Attivo</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="action-btn view-btn view-driver-btn" data-driver-id="1" data-bs-toggle="tooltip" title="Visualizza">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="action-btn edit-btn edit-driver-btn" data-driver-id="1" data-bs-toggle="tooltip" title="Modifica">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Giulia Rossi</strong></td>
                        <td><span class="status-badge badge-success">Part-Time</span></td>
                        <td>Moto <span class="status-badge badge-orange">Proprio</span></td>
                        <td>
                            <div class="d-flex flex-column">
                                <small class="text-muted"><i class="fas fa-phone me-1"></i> 3334455667</small>
                                <small class="text-muted"><i class="fas fa-envelope me-1"></i> giulia.rossi@example.com</small>
                            </div>
                        </td>
                        <td>
                            <div class="driver-rating">
                                <span class="rating-value">4.5</span>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge badge-success">Attivo</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="action-btn view-btn view-driver-btn" data-driver-id="2" data-bs-toggle="tooltip" title="Visualizza">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="action-btn edit-btn edit-driver-btn" data-driver-id="2" data-bs-toggle="tooltip" title="Modifica">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Alessandro Verdi</strong></td>
                        <td><span class="status-badge badge-info">Determinato</span></td>
                        <td>Auto <span class="status-badge badge-purple">Aziendale</td>
                        <td>
                            <div class="d-flex flex-column">
                                <small class="text-muted"><i class="fas fa-phone me-1"></i> 3337788990</small>
                                <small class="text-muted"><i class="fas fa-envelope me-1"></i> alessandro.verdi@example.com</small>
                            </div>
                        </td>
                        <td>
                            <div class="driver-rating">
                                <span class="rating-value">3.8</span>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                                <i class="far fa-star text-muted"></i>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge badge-danger">Inattivo</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="action-btn view-btn view-driver-btn" data-driver-id="3" data-bs-toggle="tooltip" title="Visualizza">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="action-btn edit-btn edit-driver-btn" data-driver-id="3" data-bs-toggle="tooltip" title="Modifica">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Sara Neri</strong></td>
                        <td><span class="status-badge badge-warning">Occasionale</span></td>
                        <td>Bicicletta <span class="status-badge badge-orange">Proprio</span></td>
                        <td>
                            <div class="d-flex flex-column">
                                <small class="text-muted"><i class="fas fa-phone me-1"></i> 3339900112</small>
                                <small class="text-muted"><i class="fas fa-envelope me-1"></i> sara.neri@example.com</small>
                            </div>
                        </td>
                        <td>
                            <div class="driver-rating">
                                <span class="rating-value">4.9</span>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge badge-warning">Consegna</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="action-btn view-btn view-driver-btn" data-driver-id="4" data-bs-toggle="tooltip" title="Visualizza">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="action-btn edit-btn edit-driver-btn" data-driver-id="4" data-bs-toggle="tooltip" title="Modifica">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Martina Vitali</strong></td>
                        <td><span class="status-badge badge-primary">Indeterminato</span></td>
                        <td>Auto <span class="status-badge badge-orange">Proprio</span></td>
                        <td>
                            <div class="d-flex flex-column">
                                <small class="text-muted"><i class="fas fa-phone me-1"></i> 3336677889</small>
                                <small class="text-muted"><i class="fas fa-envelope me-1"></i> martina.vitali@example.com</small>
                            </div>
                        </td>
                        <td>
                            <div class="driver-rating">
                                <span class="rating-value">4.2</span>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="far fa-star text-muted"></i>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge badge-success">Attivo</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="action-btn view-btn view-driver-btn" data-driver-id="5" data-bs-toggle="tooltip" title="Visualizza">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="action-btn edit-btn edit-driver-btn" data-driver-id="5" data-bs-toggle="tooltip" title="Modifica">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Paginazione e info -->
    <div class="drivers-footer">
        <div class="text-muted small">
            Mostrando <strong>5</strong> di <strong>28</strong> driver
        </div>
        <nav>
            <ul class="pagination pagination-sm">
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-disabled="true"><i class="fas fa-angle-left"></i></a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Includiamo i modali originali dalla cartella modals -->
<?php require_once 'views/drivers/modals/driver_view_modal.php'; ?>
<?php require_once 'views/drivers/modals/driver_edit_modal.php'; ?>
<?php require_once 'views/drivers/modals/driver_new_modal.php'; ?>

<?php require_once 'views/layout/footer.php'; ?>