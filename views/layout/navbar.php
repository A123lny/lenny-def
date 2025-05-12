<?php
/**
 * Navbar superiore del layout principale
 * File separato per una migliore organizzazione del codice
 */
?>
<!-- Navbar superiore -->
<header class="header">
    <div class="header-left">
        <button class="btn-mobile-menu d-lg-none" id="toggle-mobile-menu">
            <div class="navbar-icon-container">
                <i class="fas fa-bars navbar-icon"></i>
            </div>
        </button>
        
        <div class="greeting-container user-dropdown-container">
            <div class="user-greeting" id="userGreetingDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Ciao, <span class="user-greeting-name"><?= isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Utente' ?></span>!
            </div>
            <ul class="dropdown-menu user-dropdown-menu" aria-labelledby="userGreetingDropdown">
                <li class="dropdown-header">
                    <div class="user-info">
                        <div class="user-avatar-lg">
                            <?php 
                            if (isset($_SESSION['fullname'])&&!empty($_SESSION['fullname'])) {
                                echo strtoupper(substr($_SESSION['fullname'], 0, 1));
                            } else {
                                echo 'U'; // Default fallback
                            }
                            ?>
                        </div>
                        <div class="user-details">
                            <h6 class="user-name"><?= isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Utente' ?></h6>
                            <p class="user-email">admin@example.com</p>
                        </div>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user-circle me-2"></i> Il mio profilo
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-cog me-2"></i> Impostazioni
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a href="/lenny1/auth/logout" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="page-title d-none d-md-flex align-items-center">
            <span class="page-icon-wrapper">
                <i class="page-icon fas fa-chart-pie"></i>
            </span>
            <h1 id="currentPageTitle">Dashboard</h1>
        </div>
    </div>
    
    <div class="header-right">
        <div class="header-search">
            <div class="search-wrapper">
                <input type="text" class="search-input" placeholder="Cerca...">
                <i class="search-icon fas fa-search"></i>
            </div>
        </div>
        
        <div class="header-actions">
            <div class="action-item notification-dropdown-container">
                <button class="action-btn notification-btn" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="notification-icon-wrapper">
                        <div class="navbar-icon-container">
                            <i class="fas fa-bell navbar-icon"></i>
                        </div>
                        <span class="notification-badge">3</span>
                    </div>
                </button>
                <div class="dropdown-menu notification-dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                    <div class="dropdown-header">
                        <h6 class="dropdown-title">Notifiche</h6>
                        <a href="#" class="dropdown-link">Segna tutte come lette</a>
                    </div>
                    <div class="dropdown-body">
                        <!-- Le notifiche verranno aggiunte dinamicamente da JavaScript -->
                    </div>
                    <div class="dropdown-footer">
                        <a href="#" class="dropdown-item-link">Vedi tutte le notifiche</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>