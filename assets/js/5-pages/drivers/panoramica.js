/**
 * File: assets/js/5-pages/drivers/panoramica.js
 * Script per la gestione della panoramica dei driver
 */

document.addEventListener('DOMContentLoaded', function() {
    // Inizializzazione dei tooltip di Bootstrap
    initTooltips();
    
    // Gestione dei dropdown
    setupDropdowns();
    
    // Gestione filtri
    setupFilters();
    
    // Effetti di animazione
    setupAnimations();
    
    // Nota: La gestione del modale di visualizzazione è stata spostata in assets/js/4-components/drivers/driver_view.js
    
    // Gestione modale modifica
    setupEditModal();
    
    // Configurazione pulsanti esportazione
    setupExportButtons();
});

/**
 * Inizializza i tooltip di Bootstrap
 */
function initTooltips() {
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => {
        // Rimuovi istanza precedente se esiste
        const instance = bootstrap.Tooltip.getInstance(tooltip);
        if (instance) {
            instance.dispose();
        }
        // Crea nuova istanza con opzioni corrette
        new bootstrap.Tooltip(tooltip, {
            trigger: 'hover',    // Solo su hover, non su focus o click
            container: 'body',   // Appendi al body per evitare problemi di posizionamento
            boundary: 'window'   // Assicura che il tooltip rimanga visibile nella finestra
        });
    });
}

/**
 * Configura i dropdown nell'interfaccia
 */
function setupDropdowns() {
    // Implementazione manuale del dropdown esportazione
    const exportDropdownBtn = document.getElementById('exportDropdown');
    const exportDropdownMenu = document.querySelector('.dropdown-menu');
    
    if (exportDropdownBtn && exportDropdownMenu) {
        // Toggle dropdown al click
        exportDropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = this.parentElement.classList.contains('show');
            
            // Chiudi tutti i dropdown attivi
            document.querySelectorAll('.dropdown.show').forEach(el => {
                el.classList.remove('show');
            });
            
            // Toggle questo dropdown
            if (!isOpen) {
                this.parentElement.classList.add('show');
            }
        });
        
        // Chiudi dropdown al click altrove nel documento
        document.addEventListener('click', function() {
            exportDropdownBtn.parentElement.classList.remove('show');
        });
        
        // Previeni la chiusura quando si clicca dentro il dropdown
        exportDropdownMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
}

/**
 * Configura i filtri della tabella
 */
function setupFilters() {
    // Riferimenti ai filtri
    const searchInput = document.getElementById('searchQuery');
    const tipoFilter = document.getElementById('tipoFilter');
    const statoFilter = document.getElementById('statoFilter');
    
    // Aggiunge event listeners ai filtri
    if (searchInput) {
        searchInput.addEventListener('input', applyAllFilters);
    }
    
    if (tipoFilter) {
        tipoFilter.addEventListener('change', applyAllFilters);
    }
    
    if (statoFilter) {
        statoFilter.addEventListener('change', applyAllFilters);
    }
}

/**
 * Applica tutti i filtri alla tabella
 */
function applyAllFilters() {
    const searchInput = document.getElementById('searchQuery');
    const tipoFilter = document.getElementById('tipoFilter');
    const statoFilter = document.getElementById('statoFilter');
    
    const rows = document.querySelectorAll('.drivers-table tbody tr');
    const searchQuery = searchInput.value.toLowerCase();
    const selectedTipo = tipoFilter.value.toLowerCase();
    const selectedStato = statoFilter.value.toLowerCase();
    
    rows.forEach(row => {
        let showRow = true;
        
        // Applica filtro ricerca
        if (searchQuery) {
            const rowText = row.textContent.toLowerCase();
            if (!rowText.includes(searchQuery)) {
                showRow = false;
            }
        }
        
        // Applica filtro tipo
        if (showRow && selectedTipo !== 'all') {
            const tipo = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            if (!tipo.includes(selectedTipo)) {
                showRow = false;
            }
        }
        
        // Applica filtro stato
        if (showRow && selectedStato !== 'all') {
            const statusBadge = row.querySelector('td:nth-child(6) .status-badge');
            if (!statusBadge || !statusBadge.textContent.toLowerCase().includes(selectedStato)) {
                showRow = false;
            }
        }
        
        // Applica visibilità
        row.style.display = showRow ? '' : 'none';
    });
    
    // Aggiorna conteggio
    updateDriversCount();
}

/**
 * Aggiorna il contatore dei driver visualizzati
 */
function updateDriversCount() {
    const visibleDrivers = document.querySelectorAll('.drivers-table tbody tr:not([style*="display: none"])');
    const countElement = document.querySelector('.drivers-footer .text-muted strong:first-child');
    
    if (countElement) {
        countElement.textContent = visibleDrivers.length;
    }
}

/**
 * Configura le animazioni
 */
function setupAnimations() {
    // Effetto di caricamento iniziale per le card statistiche
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate__animated', 'animate__fadeInUp');
    });
}

/**
 * Configura i pulsanti per l'esportazione dei dati
 */
function setupExportButtons() {
    const exportDropdownBtn = document.getElementById('exportDropdown');
    
    document.getElementById('exportCSV')?.addEventListener('click', function(e) {
        e.preventDefault();
        if (exportDropdownBtn) exportDropdownBtn.parentElement.classList.remove('show');
        // Utilizziamo la funzione exportTable di ExportUtils
        ExportUtils.exportTable('.drivers-table table', 'csv', 'drivers_export_' + new Date().toISOString().slice(0, 10) + '.csv');
    });
    
    document.getElementById('exportPDF')?.addEventListener('click', function(e) {
        e.preventDefault();
        if (exportDropdownBtn) exportDropdownBtn.parentElement.classList.remove('show');
        // Utilizziamo la funzione exportTable di ExportUtils
        
        // Carichiamo la libreria jsPDF e autoTable se non sono già state caricate
        if (typeof window.jspdf === 'undefined' && typeof window.jsPDF === 'undefined') {
            ExportUtils.loadScript('https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js')
                .then(() => {
                    return ExportUtils.loadScript('https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js');
                })
                .then(() => {
                    // Ritentiamo l'esportazione dopo aver caricato le librerie
                    ExportUtils.exportTable('.drivers-table table', 'pdf', 'drivers_export_' + new Date().toISOString().slice(0, 10) + '.pdf');
                })
                .catch(error => {
                    console.error('Errore nel caricamento delle librerie per PDF:', error);
                    ExportUtils.showError('Impossibile caricare le librerie per l\'esportazione in PDF');
                });
        } else {
            ExportUtils.exportTable('.drivers-table table', 'pdf', 'drivers_export_' + new Date().toISOString().slice(0, 10) + '.pdf');
        }
    });
    
    document.getElementById('exportExcel')?.addEventListener('click', function(e) {
        e.preventDefault();
        if (exportDropdownBtn) exportDropdownBtn.parentElement.classList.remove('show');
        // Utilizziamo la funzione exportTable di ExportUtils
        ExportUtils.exportTable('.drivers-table table', 'excel', 'drivers_export_' + new Date().toISOString().slice(0, 10) + '.xlsx');
    });
}

/**
 * Mostra un modale - funzione di utility utilizzata da più parti del codice
 */
function showModal(modalId) {
    const modalElement = document.getElementById(modalId);
    if (modalElement) {
        const modalInstance = new bootstrap.Modal(modalElement);
        modalInstance.show();
    } else {
        console.error(`Elemento modale #${modalId} non trovato nel DOM.`);
    }
}

/**
 * Nasconde un modale - funzione di utility utilizzata da più parti del codice
 */
function hideModal(modalId) {
    const modalElement = document.getElementById(modalId);
    if (modalElement) {
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (modalInstance) modalInstance.hide();
    }
}