<?php
/**
 * Sidebar del layout principale
 * File separato per una migliore organizzazione del codice
 */
?>
<!-- Sidebar -->
<aside id="sidebar" class="sidebar">
    <div class="sidebar-logo">
        <a href="<?= url('dashboard') ?>" class="d-flex align-items-center justify-content-center w-100" style="padding: 10px 0;">
            <img src="<?= asset('images/lennypng.png') ?>" alt="Lenny" class="img-fluid" style="max-height: 90px;">
        </a>
    </div>
    
    <div class="sidebar-menu">
        <ul class="menu-items">
            <li class="menu-item">
                <a href="<?= url('dashboard') ?>" class="menu-link">
                    <i class="menu-icon fas fa-chart-pie"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="<?= url('restaurants') ?>" class="menu-link">
                    <i class="menu-icon fas fa-store"></i>
                    <span class="menu-text">Ristoranti</span>
                </a>
            </li>
            
            <li class="menu-item has-submenu">
                <a href="#" class="menu-link submenu-toggle" data-controller="orders">
                    <i class="menu-icon fas fa-shopping-bag"></i>
                    <span class="menu-text">Ordini</span>
                    <i class="submenu-arrow fas fa-chevron-right"></i>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="<?= url('orders', 'active') ?>" class="submenu-link" target="_blank">
                            <span class="flashing-fire">Ordini in corso</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('orders') ?>" class="submenu-link">
                            <i class="fas fa-list"></i>
                            <span>Tutti gli ordini</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('orders', 'refunds') ?>" class="submenu-link">
                            <i class="fas fa-exchange-alt"></i>
                            <span>Rimborsi</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="menu-item has-submenu">
                <a href="#" class="menu-link submenu-toggle" data-controller="drivers">
                    <i class="menu-icon fas fa-motorcycle"></i>
                    <span class="menu-text">Driver</span>
                    <i class="submenu-arrow fas fa-chevron-right"></i>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="<?= url('drivers', 'panoramica') ?>" class="submenu-link">
                            <i class="fas fa-eye"></i>
                            <span>Panoramica</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('drivers', 'turni') ?>" class="submenu-link">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Turni</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('drivers', 'contratti') ?>" class="submenu-link">
                            <i class="fas fa-file-signature"></i>
                            <span>Contratti</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('drivers', 'mezzi') ?>" class="submenu-link">
                            <i class="fas fa-truck"></i>
                            <span>Mezzi</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('drivers', 'pagamenti') ?>" class="submenu-link">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Pagamenti</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('drivers', 'performance') ?>" class="submenu-link">
                            <i class="fas fa-chart-line"></i>
                            <span>Performance</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="menu-item has-submenu">
                <a href="#" class="menu-link submenu-toggle" data-controller="crm">
                    <i class="menu-icon fas fa-user-tie"></i>
                    <span class="menu-text">CRM</span>
                    <i class="submenu-arrow fas fa-chevron-right"></i>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="<?= url('crm', 'clients') ?>" class="submenu-link">
                            <i class="fas fa-users"></i>
                            <span>Clienti</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('crm', 'restaurants') ?>" class="submenu-link">
                            <i class="fas fa-store"></i>
                            <span>Ristoranti</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('crm', 'orders') ?>" class="submenu-link">
                            <i class="fas fa-shopping-bag"></i>
                            <span>Ordini</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('crm', 'reviews') ?>" class="submenu-link">
                            <i class="fas fa-star"></i>
                            <span>Recensioni</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('crm', 'complaints') ?>" class="submenu-link">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>Reclami</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('crm', 'suggestions') ?>" class="submenu-link">
                            <i class="fas fa-lightbulb"></i>
                            <span>Suggerimenti</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="menu-item has-submenu">
                <a href="#" class="menu-link submenu-toggle" data-controller="games">
                    <i class="menu-icon fas fa-gamepad"></i>
                    <span class="menu-text">Games</span>
                    <i class="submenu-arrow fas fa-chevron-right"></i>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="<?= url('games', 'overview') ?>" class="submenu-link">
                            <i class="fas fa-th-large"></i>
                            <span>Panoramica</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('games', 'statistics') ?>" class="submenu-link">
                            <i class="fas fa-chart-bar"></i>
                            <span>Statistiche</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="menu-item has-submenu">
                <a href="#" class="menu-link submenu-toggle" data-controller="menu">
                    <i class="menu-icon fas fa-utensils"></i>
                    <span class="menu-text">Menu</span>
                    <i class="submenu-arrow fas fa-chevron-right"></i>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="<?= url('menu') ?>" class="submenu-link">
                            <i class="fas fa-th-large"></i>
                            <span>Panoramica</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('menu', 'categories') ?>" class="submenu-link">
                            <i class="fas fa-tags"></i>
                            <span>Categorie</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="<?= url('menu', 'items') ?>" class="submenu-link">
                            <i class="fas fa-hamburger"></i>
                            <span>Prodotti</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="menu-item">
                <a href="<?= url('customers') ?>" class="menu-link">
                    <i class="menu-icon fas fa-users"></i>
                    <span class="menu-text">Clienti</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="<?= url('settings') ?>" class="menu-link">
                    <i class="menu-icon fas fa-cog"></i>
                    <span class="menu-text">Impostazioni</span>
                </a>
            </li>            
        </ul>
    </div>
    
    <div class="sidebar-footer">
        <div class="sidebar-footer-content">
            <span class="text-muted small">Lenny Food Delivery v1.2</span>
        </div>
        <button id="toggleSidebar" class="btn-toggle-sidebar">
            <i class="fas fa-chevron-left"></i>
        </button>
    </div>
</aside>