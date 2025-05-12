/**
 * Gestione della sidebar
 * Script per gestire il toggle della sidebar e la navigazione
 */

document.addEventListener('DOMContentLoaded', function() {
    initSidebar();
    setActiveMenuItem();
});

/**
 * Inizializza la sidebar
 */
function initSidebar() {
    // Toggle per mostrare/nascondere la sidebar
    const toggleSidebarBtn = document.getElementById('toggleSidebar');
    const sidebarElement = document.getElementById('sidebar');
    
    if (toggleSidebarBtn&&sidebarElement) {
        toggleSidebarBtn.addEventListener('click', function() {
            sidebarElement.classList.toggle('sidebar-collapsed');
            
            // Salva la preferenza dell'utente nel localStorage
            const isCollapsed = sidebarElement.classList.contains('sidebar-collapsed');
            localStorage.setItem('sidebar-collapsed', isCollapsed);
            
            // Aggiorna l'icona del pulsante
            const icon = toggleSidebarBtn.querySelector('i');
            if (icon) {
                if (isCollapsed) {
                    icon.classList.remove('fa-chevron-left');
                    icon.classList.add('fa-chevron-right');
                } else {
                    icon.classList.remove('fa-chevron-right');
                    icon.classList.add('fa-chevron-left');
                }
            }
        });
    }
    
    // Ripristina lo stato della sidebar dalla preferenza salvata
    if (sidebarElement) {
        const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
        if (isCollapsed) {
            sidebarElement.classList.add('sidebar-collapsed');
            
            // Aggiorna l'icona del pulsante
            if (toggleSidebarBtn) {
                const icon = toggleSidebarBtn.querySelector('i');
                if (icon) {
                    icon.classList.remove('fa-chevron-left');
                    icon.classList.add('fa-chevron-right');
                }
            }
        }
    }
    
    // Toggle per i sottomenu
    const submenuToggles = document.querySelectorAll('.submenu-toggle');
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const menuItem = this.closest('.menu-item');
            if (menuItem) {
                menuItem.classList.toggle('open');
                
                // Chiudi gli altri sottomenu se non sono attivi
                submenuToggles.forEach(otherToggle => {
                    const otherMenuItem = otherToggle.closest('.menu-item');
                    if (otherToggle !== toggle&&otherMenuItem) {
                        // Non chiudere gli altri menu se non hanno una voce attiva
                        if (!otherMenuItem.querySelector('.submenu-link.active')) {
                            otherMenuItem.classList.remove('open');
                        }
                    }
                });
            }
        });
    });
}

/**
 * Imposta la voce di menu attiva in base all'URL corrente
 */
function setActiveMenuItem() {
    // Ottieni l'URL corrente e rimuovi eventuali parametri di query o frammenti
    const currentURL = window.location.pathname;
    console.log("URL corrente:", currentURL);
    
    // Resetta tutti gli stati attivi precedenti
    document.querySelectorAll('.menu-link.active, .submenu-link.active').forEach(el => {
        el.classList.remove('active');
    });
    
    document.querySelectorAll('.menu-item.open').forEach(el => {
        if (!el.querySelector('.submenu-link.active')) {
            el.classList.remove('open');
        }
    });
    
    // Determina il controller e l'action dall'URL
    let controller = '', action = '';
    
    // Analizza l'URL per ottenere controller e action
    // Forma 1: /lenny1/controller/action
    // Forma 2: /index.php?controller=xyz&action=abc
    
    if (currentURL.includes('index.php')) {
        // Forma 2: Vecchio stile con parametri GET
        const urlParams = new URLSearchParams(window.location.search);
        controller = urlParams.get('controller') || 'dashboard';
        action = urlParams.get('action') || 'index';
    } else {
        // Forma 1: URL pretty
        const segments = currentURL.split('/').filter(Boolean);
        // Trova l'indice di 'lenny1' o l'ultimo elemento potrebbe essere il controller
        const baseIndex = segments.indexOf('lenny1');
        
        if (baseIndex !== -1&&segments.length > baseIndex + 1) {
            controller = segments[baseIndex + 1];
            action = segments.length > baseIndex + 2 ? segments[baseIndex + 2] : 'index';
        } else if (segments.length > 0) {
            controller = segments[segments.length - 1];
            action = 'index';
        } else {
            controller = 'dashboard';
            action = 'index';
        }
    }
    
    console.log("Controller:", controller, "Action:", action);
    
    // Modalità di ricerca 1: Cercare URL esatti
    let found = false;
    
    // Prima cerca nelle voci di sottomenu (più specifiche)
    const allLinks = document.querySelectorAll('.submenu-link, .menu-link:not(.submenu-toggle)');
    allLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (!href) return;
        
        // Prepara l'URL dell'href per il confronto rimuovendo dominio e parametri di query
        let hrefPath = href;
        if (href.includes('://')) {
            const url = new URL(href);
            hrefPath = url.pathname;
        }
        
        // Controlla se questo link corrisponde all'URL corrente
        if (hrefPath === currentURL || 
            (href.includes(`/${controller}/`)&&href.includes(`/${controller}/${action}`)) ||
            (href.includes(`controller=${controller}`)&&href.includes(`action=${action}`))) {
            
            // Link trovato!
            link.classList.add('active');
            
            // Se è in un sottomenu, apri il menu padre
            const parentMenuItem = link.closest('.menu-item.has-submenu');
            if (parentMenuItem) {
                parentMenuItem.classList.add('open');
                
                // Se il link è in un sottomenu, evidenzia anche il titolo del menu
                const parentToggle = parentMenuItem.querySelector('.submenu-toggle');
                if (parentToggle) {
                    parentToggle.classList.add('active');
                }
            }
            
            found = true;
        }
    });
    
    // Se non è stato trovato un link esatto, prova con il solo controller
    if (!found) {
        // Cerca collegamenti che potrebbero corrispondere solo al controller
        allLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (!href) return;
            
            if (href.includes(`/${controller}`) || href.includes(`controller=${controller}`)) {
                link.classList.add('active');
                
                // Se è in un sottomenu, apri il menu padre
                const parentMenuItem = link.closest('.menu-item.has-submenu');
                if (parentMenuItem) {
                    parentMenuItem.classList.add('open');
                    
                    // Se il link è in un sottomenu, evidenzia anche il titolo del menu
                    const parentToggle = parentMenuItem.querySelector('.submenu-toggle');
                    if (parentToggle) {
                        parentToggle.classList.add('active');
                    }
                }
                
                found = true;
                return; // Usa return per uscire dal forEach
            }
        });
        
        // Prova con il data-controller per i submenu-toggle
        if (!found) {
            const menuToggle = document.querySelector(`.submenu-toggle[data-controller="${controller}"]`);
            if (menuToggle) {
                menuToggle.classList.add('active');
                
                // Apri il menu
                const parentMenuItem = menuToggle.closest('.menu-item');
                if (parentMenuItem) {
                    parentMenuItem.classList.add('open');
                }
                
                found = true;
            }
        }
    }
    
    // Fallback alla dashboard se nulla è stato trovato
    if (!found&&controller !== 'dashboard') {
        const dashboardLink = document.querySelector('a[href*="dashboard"]');
        if (dashboardLink) {
            dashboardLink.classList.add('active');
        }
    }
}