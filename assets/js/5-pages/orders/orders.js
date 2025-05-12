/**
 * Script per la gestione della pagina ordini
 */

document.addEventListener('DOMContentLoaded', function() {
    // Inizializzazione dei componenti UI
    initTooltips();
    // Rimuovo initExportDropdown() perché ora uso le funzionalità native di Bootstrap
    initFilterListeners();
    initStatCards();
    initPrintButtons();
    initExportButtons();
    initNewOrderButton();
    initDatepicker();
});

/**
 * Inizializza i tooltip di Bootstrap
 */
function initTooltips() {
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => {
        new bootstrap.Tooltip(tooltip);
    });
}

/**
 * Inizializza i filtri della pagina
 */
function initFilterListeners() {
    // Riferimenti ai filtri
    const searchInput = document.getElementById('searchQuery');
    const statusFilter = document.getElementById('statusFilter');
    const restaurantFilter = document.getElementById('restaurantFilter');
    const periodButtons = document.querySelectorAll('.period-btn');
    
    // Aggiorna gli event listeners per usare la funzione centralizzata
    if (searchInput) {
        searchInput.addEventListener('input', applyAllFilters);
    }
    
    if (statusFilter) {
        statusFilter.addEventListener('change', applyAllFilters);
    }
    
    if (restaurantFilter) {
        restaurantFilter.addEventListener('change', applyAllFilters);
    }
    
    if (periodButtons.length) {
        periodButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Rimuovi classe attiva da tutti i pulsanti
                periodButtons.forEach(btn => btn.classList.remove('active'));
                
                // Aggiungi classe attiva a questo pulsante
                this.classList.add('active');
                
                // Applica tutti i filtri
                applyAllFilters();
            });
        });
    }
}

/**
 * Funzione centralizzata per applicare tutti i filtri
 */
function applyAllFilters() {
    const rows = document.querySelectorAll('.orders-table tbody tr');
    const searchQuery = document.getElementById('searchQuery').value.toLowerCase();
    const selectedStatus = document.getElementById('statusFilter').value.toLowerCase();
    const selectedRestaurant = document.getElementById('restaurantFilter').value.toLowerCase();
    
    // Trova il pulsante periodo attivo
    const activePeriodBtn = document.querySelector('.period-btn.active');
    const selectedPeriod = activePeriodBtn ? activePeriodBtn.dataset.period : 'all';
    
    // Data di riferimento: 14 aprile 2025
    const referenceDate = new Date(2025, 3, 14);
    
    rows.forEach(row => {
        let showRow = true;
        
        // Applica filtro ricerca
        if (searchQuery) {
            const rowText = row.textContent.toLowerCase();
            if (!rowText.includes(searchQuery)) {
                showRow = false;
            }
        }
        
        // Applica filtro stato
        if (showRow && selectedStatus !== 'all') {
            const statusBadge = row.querySelector('.status-badge');
            if (!statusBadge || !statusBadge.textContent.toLowerCase().includes(selectedStatus)) {
                showRow = false;
            }
        }
        
        // Applica filtro ristorante
        if (showRow && selectedRestaurant !== 'all') {
            const restaurant = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
            if (!restaurant.includes(selectedRestaurant)) {
                showRow = false;
            }
        }
        
        // Applica filtro periodo
        if (showRow && selectedPeriod !== 'all') {
            const dateCell = row.querySelector('td:nth-child(2)').textContent;
            const dateParts = dateCell.split(' ')[0].split('/');
            const orderDate = new Date(parseInt(dateParts[2]), parseInt(dateParts[1]) - 1, parseInt(dateParts[0]));
            
            if (selectedPeriod === 'oggi') {
                // Mostra solo ordini di oggi (14/04/2025)
                if (!dateCell.startsWith('14/04/2025')) {
                    showRow = false;
                }
            } else if (selectedPeriod === 'settimana') {
                // Calcola la data di 7 giorni fa rispetto alla data di riferimento
                const weekAgo = new Date(referenceDate);
                weekAgo.setDate(referenceDate.getDate() - 7);
                
                // Mostra ordini degli ultimi 7 giorni
                if (!(orderDate >= weekAgo && orderDate <= referenceDate)) {
                    showRow = false;
                }
            } else if (selectedPeriod === 'mese') {
                // Mostra ordini del mese corrente
                if (!(orderDate.getMonth() === referenceDate.getMonth() && 
                      orderDate.getFullYear() === referenceDate.getFullYear())) {
                    showRow = false;
                }
            }
        }
        
        // Applica visibilità
        row.style.display = showRow ? '' : 'none';
    });
    
    // Aggiorna conteggio
    updateOrdersCount();
}

/**
 * Effetto di caricamento delle card statistiche
 */
function initStatCards() {
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate__animated', 'animate__fadeInUp');
    });
}

/**
 * Gestione dei pulsanti di stampa
 */
function initPrintButtons() {
    const printButtons = document.querySelectorAll('.print-btn');
    printButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const orderId = this.dataset.orderId;
            
            try {
                if (typeof window.getOrderData === 'function' && typeof window.PrintUtils === 'object') {
                    const orderData = window.getOrderData(orderId);
                    window.PrintUtils.printOrderDetail(orderData);
                } else {
                    console.error('Le funzioni di stampa non sono disponibili', typeof window.getOrderData, typeof window.PrintUtils);
                    if (typeof window.showToast === 'function') {
                        window.showToast('Errore', 'Funzione di stampa non disponibile', 'danger');
                    } else {
                        alert('Funzione di stampa non disponibile');
                    }
                }
            } catch (error) {
                console.error('Errore durante la stampa:', error);
                if (typeof window.showToast === 'function') {
                    window.showToast('Errore', 'Si è verificato un errore durante la stampa', 'danger');
                } else {
                    alert('Errore durante la stampa: ' + error.message);
                }
            }
        });
    });
}

/**
 * Gestione dei pulsanti di esportazione
 */
function initExportButtons() {
    document.getElementById('exportCSV')?.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Esporta la tabella degli ordini in CSV
        ExportUtils.exportTable('.orders-table table', 'csv', 'ordini_' + getCurrentDateString());
    });
    
    document.getElementById('exportPDF')?.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Esporta la tabella degli ordini in PDF
        ExportUtils.exportTable('.orders-table table', 'pdf', 'ordini_' + getCurrentDateString());
    });
    
    document.getElementById('exportExcel')?.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Esporta la tabella degli ordini in Excel
        ExportUtils.exportTable('.orders-table table', 'excel', 'ordini_' + getCurrentDateString());
    });
}

/**
 * Funzione per ottenere la data corrente in formato stringa
 * @returns {string} Data nel formato YYYYMMDD
 */
function getCurrentDateString() {
    const now = new Date();
    return now.getFullYear() + 
           ('0' + (now.getMonth() + 1)).slice(-2) + 
           ('0' + now.getDate()).slice(-2);
}

/**
 * Funzione per aggiornare il conteggio degli ordini visualizzati
 */
function updateOrdersCount() {
    const visibleOrders = document.querySelectorAll('.orders-table tbody tr:not([style*="display: none"])');
    const countElement = document.querySelector('.orders-footer .text-muted strong:first-child');
    
    if (countElement) {
        countElement.textContent = visibleOrders.length;
    }
}

/**
 * Gestione click sul pulsante "Nuovo ordine"
 */
function initNewOrderButton() {
    const newOrderBtn = document.querySelector('.section-header .btn-primary');
    if (newOrderBtn) {
        newOrderBtn.addEventListener('click', function() {
            const newOrderModal = new bootstrap.Modal(document.getElementById('newOrderModal'));
            newOrderModal.show();
        });
    }
}

/**
 * Inizializzazione del datepicker per la data di consegna
 */
function initDatepicker() {
    if (typeof flatpickr === 'function' && document.getElementById('deliveryDate')) {
        flatpickr("#deliveryDate", {
            locale: "it",
            dateFormat: "d/m/Y",
            minDate: "today",
            disableMobile: true
        });
    }
}