<?php require_once 'views/layout/header.php'; ?>

<div class="section-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="section-title">Panoramica</h2>
        <p class="section-subtitle">Statistiche aggiornate in tempo reale</p>
    </div>
    <div class="period-filter">
        <button class="period-btn active" data-period="today">Oggi</button>
        <button class="period-btn" data-period="week">Settimana</button>
        <button class="period-btn" data-period="month">Mese</button>
    </div>
</div>

<!-- Statistiche principali -->
<div class="stats-grid">
    <div class="stat-card stat-card-primary animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-shopping-bag"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Ordini Totali</div>
            <div class="stat-value"><?= $totalOrders ?></div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 8.3% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-secondary animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-euro-sign"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Ricavi Totali</div>
            <div class="stat-value"><?= number_format($totalRevenue, 0, ',', '.') ?>€</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 12.7% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-1 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Ordini Attivi</div>
            <?php
            $activeOrdersCount = 0;
            foreach ($ordersByStatus as $status) {
                if (in_array($status['status'], ['nuovo', 'in preparazione', 'in consegna'])) {
                    $activeOrdersCount += $status['count'];
                }
            }
            ?>
            <div class="stat-value"><?= $activeOrdersCount ?></div>
            <div class="stat-change negative">
                <i class="fas fa-arrow-down"></i> 3.5% rispetto a ieri
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-2 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Clienti Totali</div>
            <div class="stat-value"><?= $totalCustomers ?></div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 5.2% rispetto alla settimana scorsa
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Grafico andamento ordini -->
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-header">
                <h5>Andamento Ordini</h5>
                <div class="period-filter">
                    <button class="period-btn active" data-period="7days">Ultimi 7 giorni</button>
                    <button class="period-btn" data-period="30days">Ultimi 30 giorni</button>
                    <button class="period-btn" data-period="quarter">Trimestre</button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="ordersChart" height="300"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Grafico categorie -->
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header">
                <h5>Vendite per Categoria</h5>
            </div>
            <div class="card-body">
                <canvas id="categoriesChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Ordini recenti -->
    <div class="col-md-7">
        <div class="card h-100">
            <div class="card-header">
                <h5>Ordini Recenti</h5>
                <a href="index.php?controller=orders&action=index" class="btn btn-sm btn-primary">
                    <i class="fas fa-external-link-alt me-1"></i> Vedi tutti
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Stato</th>
                                <th>Importo</th>
                                <th>Data</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Il contenuto verrà popolato dinamicamente con JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Prodotti più venduti -->
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-header">
                <h5>Prodotti Più Venduti</h5>
            </div>
            <div class="card-body">
                <div class="top-products">
                    <!-- Il contenuto verrà popolato dinamicamente con JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Carica Chart.js prima di dashboard.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php require_once 'views/layout/footer.php'; ?>
