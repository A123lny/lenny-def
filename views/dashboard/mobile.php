
<?php require_once 'views/layout/header.php'; ?>

<div class="mobile-dashboard-container">
    <!-- Header mobile con saluto e notifiche -->
    <div class="mobile-header">
        <div class="mobile-menu-trigger">
            <i class="fas fa-bars"></i>
        </div>
        <div class="mobile-greeting">
            <div class="mobile-greeting-icon">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="mobile-greeting-text">
                <h2>Ciao, Luca Admin!</h2>
                <p>Benvenuto nel tuo pannello di controllo</p>
            </div>
        </div>
        <div class="mobile-notifications">
            <a href="#" class="notification-icon">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
            </a>
        </div>
    </div>

    <!-- Menu laterale mobile -->
    <div class="mobile-sidebar">
        <div class="mobile-sidebar-header">
            <img src="<?= asset('images/lennypng.png') ?>" alt="Lenny" class="mobile-logo">
            <div class="mobile-sidebar-close">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="mobile-sidebar-content">
            <ul class="mobile-menu">
                <li class="mobile-menu-item active">
                    <a href="<?= url('dashboard') ?>" class="mobile-menu-link">
                        <i class="fas fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="mobile-menu-item">
                    <a href="<?= url('restaurants') ?>" class="mobile-menu-link">
                        <i class="fas fa-store"></i>
                        <span>Ristoranti</span>
                    </a>
                </li>
                <li class="mobile-menu-item has-submenu">
                    <a href="#" class="mobile-menu-link mobile-submenu-toggle">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Ordini</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="mobile-submenu">
                        <li><a href="<?= url('orders', 'active') ?>" class="mobile-submenu-link hot">Ordini in corso</a></li>
                        <li><a href="<?= url('orders') ?>" class="mobile-submenu-link">Tutti gli ordini</a></li>
                        <li><a href="<?= url('orders', 'refunds') ?>" class="mobile-submenu-link">Rimborsi</a></li>
                    </ul>
                </li>
                <li class="mobile-menu-item has-submenu">
                    <a href="#" class="mobile-menu-link mobile-submenu-toggle">
                        <i class="fas fa-motorcycle"></i>
                        <span>Driver</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="mobile-submenu">
                        <li><a href="<?= url('drivers', 'panoramica') ?>" class="mobile-submenu-link">Panoramica</a></li>
                        <li><a href="<?= url('drivers', 'turni') ?>" class="mobile-submenu-link">Turni</a></li>
                        <li><a href="<?= url('drivers', 'mezzi') ?>" class="mobile-submenu-link">Mezzi</a></li>
                        <li><a href="<?= url('drivers', 'pagamenti') ?>" class="mobile-submenu-link">Pagamenti</a></li>
                    </ul>
                </li>
                <li class="mobile-menu-item">
                    <a href="<?= url('customers') ?>" class="mobile-menu-link">
                        <i class="fas fa-users"></i>
                        <span>Clienti</span>
                    </a>
                </li>
                <li class="mobile-menu-item">
                    <a href="<?= url('menu') ?>" class="mobile-menu-link">
                        <i class="fas fa-utensils"></i>
                        <span>Menu</span>
                    </a>
                </li>
                <li class="mobile-menu-item">
                    <a href="<?= url('settings') ?>" class="mobile-menu-link">
                        <i class="fas fa-cog"></i>
                        <span>Impostazioni</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="mobile-sidebar-footer">
            <span>Lenny Food Delivery v1.2</span>
        </div>
    </div>

    <!-- Overlay quando il menu è aperto -->
    <div class="mobile-overlay"></div>

    <!-- Statistiche principali mobile in layout verticale -->
    <div class="mobile-stats-grid">
        <div class="mobile-stat-card primary">
            <div class="mobile-stat-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="mobile-stat-content">
                <span class="mobile-stat-title">Ordini Totali</span>
                <span class="mobile-stat-value"><?= $totalOrders ?></span>
                <span class="mobile-stat-trend positive">
                    <i class="fas fa-arrow-up"></i> 8.3%
                </span>
            </div>
        </div>

        <div class="mobile-stat-card secondary">
            <div class="mobile-stat-icon">
                <i class="fas fa-euro-sign"></i>
            </div>
            <div class="mobile-stat-content">
                <span class="mobile-stat-title">Ricavi Totali</span>
                <span class="mobile-stat-value"><?= number_format($totalRevenue, 0, ',', '.') ?>€</span>
                <span class="mobile-stat-trend positive">
                    <i class="fas fa-arrow-up"></i> 12.7%
                </span>
            </div>
        </div>

        <div class="mobile-stat-card accent-1">
            <div class="mobile-stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="mobile-stat-content">
                <span class="mobile-stat-title">Ordini Attivi</span>
                <?php
                $activeOrdersCount = 0;
                foreach ($ordersByStatus as $status) {
                    if (in_array($status['status'], ['nuovo', 'in preparazione', 'in consegna'])) {
                        $activeOrdersCount += $status['count'];
                    }
                }
                ?>
                <span class="mobile-stat-value"><?= $activeOrdersCount ?></span>
                <span class="mobile-stat-trend negative">
                    <i class="fas fa-arrow-down"></i> 3.5%
                </span>
            </div>
        </div>

        <div class="mobile-stat-card accent-2">
            <div class="mobile-stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="mobile-stat-content">
                <span class="mobile-stat-title">Clienti Totali</span>
                <span class="mobile-stat-value"><?= $totalCustomers ?></span>
                <span class="mobile-stat-trend positive">
                    <i class="fas fa-arrow-up"></i> 5.2%
                </span>
            </div>
        </div>
    </div>

    <!-- Sezione ordini recenti -->
    <div class="mobile-section">
        <div class="mobile-section-header">
            <h3>Ordini Recenti</h3>
            <a href="<?= url('orders') ?>" class="mobile-view-all">
                Vedi tutti <i class="fas fa-chevron-right"></i>
            </a>
        </div>
        <div class="mobile-orders-list">
            <!-- Il contenuto verrà popolato dinamicamente con JavaScript -->
            <div class="mobile-loading">
                <i class="fas fa-spinner fa-spin"></i> Caricamento ordini...
            </div>
        </div>
    </div>

    <!-- Sezione prodotti più venduti -->
    <div class="mobile-section">
        <div class="mobile-section-header">
            <h3>Prodotti Più Venduti</h3>
        </div>
        <div class="mobile-top-products">
            <!-- Il contenuto verrà popolato dinamicamente con JavaScript -->
            <div class="mobile-loading">
                <i class="fas fa-spinner fa-spin"></i> Caricamento prodotti...
            </div>
        </div>
    </div>

    <!-- Sezione status ordini -->
    <div class="mobile-section">
        <div class="mobile-section-header">
            <h3>Status Ordini</h3>
        </div>
        <div class="mobile-status-chart">
            <div class="mobile-status-items">
                <?php foreach ($ordersByStatus as $status): ?>
                    <div class="mobile-status-item">
                        <span class="status-badge status-<?= $status['status'] ?>">
                            <?= $status['status'] ?>
                        </span>
                        <span class="status-count"><?= $status['count'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
