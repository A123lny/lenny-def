/**
 * Lenny Food Delivery - Gestione Rimborsi
 * Questo file gestisce tutte le funzionalità della pagina rimborsi
 */

// Verifica se RefundsManager esiste già prima di definirlo
if (typeof RefundsManager === 'undefined') {
    
    const RefundsManager = (function() {
        // Cache degli elementi DOM
        let elements = {
            searchInput: null,
            statusFilter: null,
            reasonFilter: null,
            periodButtons: null,
            exportDropdownBtn: null,
            exportCSVBtn: null,
            exportPDFBtn: null,
            exportExcelBtn: null,
            analysisLink: null,
            tooltips: null,
            viewButtons: null,
            printButtons: null,
            saveRefundBtn: null
        };

        // Variabili di stato
        let state = {
            referenceDate: new Date(2025, 3, 14), // 14/04/2025 come data di riferimento
            exportInProgress: false // Flag per prevenire esportazioni multiple
        };

        /**
         * Inizializza il gestore rimborsi
         */
        function init() {
            // Carica i riferimenti agli elementi DOM
            cacheDOMElements();
            
            // Inizializza i tooltip di Bootstrap
            initTooltips();
            
            // Configura i gestori eventi
            setupEventListeners();
            
            // Inizializza effetti di animazione
            initAnimations();
            
            // Rimuovi eventuali SVG orfani
            cleanupOrphanedElements();
        }

        /**
         * Memorizza i riferimenti agli elementi DOM per prestazioni migliori
         */
        function cacheDOMElements() {
            elements.searchInput = document.getElementById('searchQuery');
            elements.statusFilter = document.getElementById('statusFilter');
            elements.reasonFilter = document.getElementById('reasonFilter');
            elements.periodButtons = document.querySelectorAll('.period-btn');
            elements.exportDropdownBtn = document.getElementById('exportDropdown');
            elements.exportCSVBtn = document.getElementById('exportCSV');
            elements.exportPDFBtn = document.getElementById('exportPDF');
            elements.exportExcelBtn = document.getElementById('exportExcel');
            elements.analysisLink = document.querySelector('a[href*="refunds_analysis"]');
            elements.tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            elements.viewButtons = document.querySelectorAll('.view-refund-btn');
            elements.printButtons = document.querySelectorAll('.print-btn');
            elements.saveRefundBtn = document.getElementById('saveRefundBtn');
        }

        /**
         * Inizializza i tooltip di Bootstrap
         */
        function initTooltips() {
            if (elements.tooltips) {
                elements.tooltips.forEach(tooltip => {
                    new bootstrap.Tooltip(tooltip);
                });
            }
        }

        /**
         * Configura tutti i listener per gli eventi
         */
        function setupEventListeners() {
            // Setup filtri
            setupFilters();
            
            // Setup pulsanti azione
            setupActionButtons();
            
            // Setup pulsanti esportazione (ora usa Bootstrap per gestire il dropdown)
            setupExportButtons();
            
            // Setup salvataggio nuovo rimborso
            setupNewRefundForm();
            
            // Funzione per gestire il click sul pulsante "Analisi Rimborsi"
            document.getElementById('btnAnalisiRimborsi').addEventListener('click', function(e) {
                // Preveniamo il comportamento di default per evitare conflitti
                e.preventDefault();
                
                // Aggiungi animazione al click
                this.classList.add('btn-click');
                setTimeout(() => {
                    this.classList.remove('btn-click');
                }, 200);
                
                // Ottieni l'URL dall'href del link stesso invece di usare un URL hardcoded
                const url = this.getAttribute('href');
                
                // Reindirizza alla pagina usando l'URL corretto dal link
                window.location.href = url;
            });
        }

        /**
         * Configura i filtri della tabella rimborsi
         */
        function setupFilters() {
            // Filtro di ricerca
            if (elements.searchInput) {
                elements.searchInput.addEventListener('input', applyAllFilters);
            }
            
            // Filtro per stato
            if (elements.statusFilter) {
                elements.statusFilter.addEventListener('change', applyAllFilters);
            }
            
            // Filtro per motivazione
            if (elements.reasonFilter) {
                elements.reasonFilter.addEventListener('change', applyAllFilters);
            }
            
            // Filtro per periodo
            if (elements.periodButtons.length) {
                elements.periodButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Rimuovi classe attiva da tutti i pulsanti
                        elements.periodButtons.forEach(btn => btn.classList.remove('active'));
                        
                        // Aggiungi classe attiva a questo pulsante
                        this.classList.add('active');
                        
                        // Applica tutti i filtri
                        applyAllFilters();
                    });
                });
            }
        }

        /**
         * Configura i pulsanti di azione (visualizza, stampa, ecc.)
         */
        function setupActionButtons() {
            // Gestione click sui pulsanti di visualizzazione rimborso
            if (elements.viewButtons) {
                elements.viewButtons.forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const refundId = this.dataset.refundId;
                        
                        // Mostra dettagli rimborso in un modal
                        showRefundDetail(refundId);
                    });
                });
            }
            
            // Gestione click sui pulsanti di stampa
            if (elements.printButtons) {
                elements.printButtons.forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const refundId = this.dataset.refundId;
                        handlePrintButton(refundId);
                    });
                });
            }
        }

        /**
         * Gestisce il click sul pulsante di stampa
         * @param {string} refundId - ID del rimborso da stampare
         */
        function handlePrintButton(refundId) {
            try {
                // Verifica se sono disponibili le funzioni di utilità di stampa e dei dettagli del rimborso
                if (typeof window.PrintUtils === 'object' && typeof getRefundDetails === 'function') {
                    const refundData = getRefundDetails(refundId);
                    window.PrintUtils.printRefundDetail(refundData);
                } else {
                    console.error('Le funzioni di stampa non sono disponibili');
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
        }

        /**
         * Configura i pulsanti di esportazione
         */
        function setupExportButtons() {
            // Esportazione CSV
            if (elements.exportCSVBtn) {
                elements.exportCSVBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    if (state.exportInProgress) return;
                    state.exportInProgress = true;
                    
                    // Esporta la tabella dei rimborsi in CSV
                    ExportUtils.exportTable('.orders-table table', 'csv', 'rimborsi_' + getCurrentDateString());
                    
                    // Previene chiamate multiple
                    setTimeout(() => {
                        state.exportInProgress = false;
                    }, 1000);
                });
            }
            
            // Esportazione PDF
            if (elements.exportPDFBtn) {
                elements.exportPDFBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    if (state.exportInProgress) return;
                    state.exportInProgress = true;
                    
                    // Esporta la tabella dei rimborsi in PDF
                    ExportUtils.exportTable('.orders-table table', 'pdf', 'rimborsi_' + getCurrentDateString());
                    
                    // Previene chiamate multiple
                    setTimeout(() => {
                        state.exportInProgress = false;
                    }, 1000);
                });
            }
            
            // Esportazione Excel
            if (elements.exportExcelBtn) {
                elements.exportExcelBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    if (state.exportInProgress) return;
                    state.exportInProgress = true;
                    
                    // Esporta la tabella dei rimborsi in Excel
                    ExportUtils.exportTable('.orders-table table', 'excel', 'rimborsi_' + getCurrentDateString());
                    
                    // Previene chiamate multiple
                    setTimeout(() => {
                        state.exportInProgress = false;
                    }, 1000);
                });
            }
            
            // Link analisi rimborsi
            if (elements.analysisLink) {
                elements.analysisLink.addEventListener('click', function(e) {
                    checkAnalysisPage(e);
                });
            }
        }

        /**
         * Configura la gestione del form per nuovi rimborsi
         */
        function setupNewRefundForm() {
            if (elements.saveRefundBtn) {
                elements.saveRefundBtn.addEventListener('click', function() {
                    const form = document.getElementById('newRefundForm');
                    
                    if (!form.checkValidity()) {
                        form.classList.add('was-validated');
                        return;
                    }
                    
                    // Simulazione salvataggio
                    if (typeof window.showToast === 'function') {
                        window.showToast('Successo', 'Il rimborso è stato creato correttamente', 'success');
                    } else {
                        alert('Rimborso creato correttamente!');
                    }
                    
                    // Chiudi il modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('newRefundModal'));
                    modal.hide();
                    
                    // Reset form
                    form.reset();
                    form.classList.remove('was-validated');
                });
            }
        }

        /**
         * Verifica se la pagina di analisi dei rimborsi esiste
         * @param {Event} event - L'evento click
         */
        function checkAnalysisPage(event) {
            // Preveniamo il comportamento di default per controllare prima la disponibilità della pagina
            event.preventDefault();
            
            // Versione semplificata senza check del content type
            try {
                // Reindirizzamento diretto alla pagina di analisi rimborsi
                window.location.href = '/lenny1/orders/refunds_analysis';
            } catch (error) {
                console.error('Errore durante il reindirizzamento:', error);
                // Mostra messaggio nel caso di errore
                if (typeof window.showToast === 'function') {
                    window.showToast('Informazione', 'La pagina di analisi dei rimborsi è in fase di sviluppo. Sarà disponibile a breve.', 'info');
                } else {
                    alert('La pagina di analisi dei rimborsi è in fase di sviluppo. Sarà disponibile a breve.');
                }
            }
        }

        /**
         * Inizializza le animazioni per gli elementi della pagina
         */
        function initAnimations() {
            // Effetto di caricamento iniziale per le card statistiche
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('animate__animated', 'animate__fadeInUp');
            });
        }

        /**
         * Rimuovi elementi SVG orfani che potrebbero causare problemi di rendering
         */
        function cleanupOrphanedElements() {
            // Controlla se ci sono elementi SVG orfani e rimuovili
            const orphanedSVGs = document.querySelectorAll('svg:not([width])');
            orphanedSVGs.forEach(svg => {
                if (!svg.innerHTML.trim()) {
                    svg.remove();
                }
            });
        }

        /**
         * Applica tutti i filtri alla tabella rimborsi
         */
        function applyAllFilters() {
            const searchQuery = elements.searchInput ? elements.searchInput.value.toLowerCase() : '';
            const selectedStatus = elements.statusFilter ? elements.statusFilter.value.toLowerCase() : 'all';
            const selectedReason = elements.reasonFilter ? elements.reasonFilter.value.toLowerCase() : 'all';
            const selectedPeriod = document.querySelector('.period-btn.active') ? 
                                document.querySelector('.period-btn.active').dataset.period : 'all';
            
            const rows = document.querySelectorAll('.orders-table tbody tr');
            
            rows.forEach(row => {
                let showRow = true;
                
                // Applica filtro di ricerca
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
                
                // Applica filtro motivazione
                if (showRow && selectedReason !== 'all') {
                    const reason = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                    if (!reason.includes(selectedReason)) {
                        showRow = false;
                    }
                }
                
                // Applica filtro periodo
                if (showRow && selectedPeriod !== 'all') {
                    const dateCell = row.querySelector('td:nth-child(3)').textContent;
                    const dateParts = dateCell.split('/');
                    const orderDate = new Date(parseInt(dateParts[2]), parseInt(dateParts[1]) - 1, parseInt(dateParts[0]));
                    
                    showRow = isDateInPeriod(orderDate, selectedPeriod);
                }
                
                // Applica visibilità
                row.style.display = showRow ? '' : 'none';
            });
            
            // Aggiorna conteggio
            updateRefundsCount();
        }

        /**
         * Controlla se una data rientra nel periodo specificato
         * @param {Date} date - La data da controllare
         * @param {string} period - Il periodo (oggi, settimana, mese)
         * @returns {boolean} True se la data è nel periodo
         */
        function isDateInPeriod(date, period) {
            switch(period) {
                case 'oggi':
                    // Mostra solo ordini di oggi
                    return date.getDate() === state.referenceDate.getDate() &&
                        date.getMonth() === state.referenceDate.getMonth() &&
                        date.getFullYear() === state.referenceDate.getFullYear();
                    
                case 'settimana':
                    // Calcola la data di 7 giorni fa rispetto alla data di riferimento
                    const weekAgo = new Date(state.referenceDate);
                    weekAgo.setDate(state.referenceDate.getDate() - 7);
                    
                    // Mostra ordini degli ultimi 7 giorni
                    return date >= weekAgo && date <= state.referenceDate;
                    
                case 'mese':
                    // Mostra ordini del mese corrente
                    return date.getMonth() === state.referenceDate.getMonth() &&
                        date.getFullYear() === state.referenceDate.getFullYear();
                    
                default:
                    return true;
            }
        }

        /**
         * Aggiorna il conteggio dei rimborsi visualizzati
         */
        function updateRefundsCount() {
            const visibleRefunds = document.querySelectorAll('.orders-table tbody tr:not([style*="display: none"])');
            const countElement = document.querySelector('.orders-footer .text-muted strong:first-child');
            
            if (countElement) {
                countElement.textContent = visibleRefunds.length;
            }
        }

        /**
         * Ottiene la data corrente in formato stringa (YYYYMMDD)
         * @returns {string} Data in formato YYYYMMDD
         */
        function getCurrentDateString() {
            const now = new Date();
            return now.getFullYear() + 
                ('0' + (now.getMonth() + 1)).slice(-2) + 
                ('0' + now.getDate()).slice(-2);
        }

        /**
         * Ottiene i dettagli di un rimborso per ID
         * @param {string} refundId - ID del rimborso
         * @returns {Object|null} Oggetto rimborso o null se non trovato
         */
        function getRefundDetails(refundId) {
            // Mapping per i dati di esempio (in produzione questi verrebbero dal server)
            const refundsMap = {
                'RFD-1001': {
                    id: 'RFD-1001',
                    date: '14/04/2025',
                    amount: 28.50,
                    reason: 'Consegna in ritardo',
                    status: 'Approvato',
                    orderId: 'ORD-1587',
                    customerName: 'Mario Rossi',
                    customerEmail: 'mario.rossi@email.com',
                    customerPhone: '+39 345 123 4567',
                    notes: 'Rimborso completo per consegna effettuata con oltre 40 minuti di ritardo.'
                },
                'RFD-1002': {
                    id: 'RFD-1002',
                    date: '10/04/2025',
                    amount: 12.90,
                    reason: 'Prodotto danneggiato',
                    status: 'In attesa',
                    orderId: 'ORD-1583',
                    customerName: 'Luca Russo',
                    customerEmail: 'luca.russo@email.com',
                    customerPhone: '+39 351 234 5678',
                    notes: 'Pizza arrivata fredda e schiacciata. Il cliente ha richiesto rimborso parziale.'
                },
                'RFD-1003': {
                    id: 'RFD-1003',
                    date: '09/04/2025',
                    amount: 32.50,
                    reason: 'Ordine errato',
                    status: 'In attesa',
                    orderId: 'ORD-1581',
                    customerName: 'Giulia Martini',
                    customerEmail: 'giulia.martini@email.com',
                    customerPhone: '+39 345 678 9012',
                    notes: 'Consegnati prodotti diversi da quelli ordinati. Cliente chiede rimborso totale.'
                },
                // Altri rimborsi...
            };
            
            return refundsMap[refundId] || null;
        }

        /**
         * Mostra i dettagli del rimborso in un modal
         * @param {string} refundId - ID del rimborso da visualizzare
         */
        function showRefundDetail(refundId) {
            const modalContainer = document.getElementById('refundDetailModal');
            if (!modalContainer) return;
            
            // Ottieni i dati del rimborso
            const refund = getRefundDetails(refundId);
            
            if (!refund) {
                if (typeof window.showToast === 'function') {
                    window.showToast('Errore', 'Dettagli rimborso non trovati', 'danger');
                } else {
                    alert('Dettagli rimborso non trovati');
                }
                return;
            }
            
            // Imposta il colore dello stato
            let statusColor = 'secondary';
            switch (refund.status) {
                case 'In attesa':
                    statusColor = 'warning';
                    break;
                case 'Approvato':
                    statusColor = 'success';
                    break;
                case 'Rifiutato':
                    statusColor = 'danger';
                    break;
            }
            
            // Crea il contenuto del modal con styling coerente con gli altri modali del sito
            const modalHTML = createRefundDetailModalHTML(refund, statusColor);
            
            modalContainer.innerHTML = modalHTML;
            modalContainer.classList.add('show');
            
            // Event listeners per i pulsanti nel modal
            setupModalEventListeners(refund);
        }

        /**
         * Crea l'HTML per il modal di dettaglio rimborso
         * @param {Object} refund - Dati del rimborso
         * @param {string} statusColor - Colore per lo stato del rimborso
         * @returns {string} HTML del modal
         */
        function createRefundDetailModalHTML(refund, statusColor) {
            return `
                <div class="notification-modal-content">
                    <div class="modal-header position-relative p-0 border-0">
                        <div class="modal-header-bg w-100"></div>
                        <div class="modal-title-container p-3 position-relative w-100 d-flex justify-content-between align-items-center">
                            <h5 class="modal-title d-flex align-items-center">
                                <span class="modal-icon-wrapper me-2">
                                    <i class="fas fa-exchange-alt"></i>
                                </span>
                                Dettaglio Rimborso: <span class="ms-2 fw-bold">${refund.id}</span>
                            </h5>
                            <button type="button" class="btn-close btn-close-white" aria-label="Close"></button>
                        </div>
                    </div>
                    
                    <div class="notification-modal-body p-4">
                        <div class="row mb-4">
                            <div class="col-12 mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="order-status-badge status-${statusColor}">${refund.status}</span>
                                    </div>
                                    <div>
                                        <span class="text-muted"><i class="fas fa-calendar me-2"></i>${refund.date}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 mb-4">
                                <div class="card border-0 shadow-hover">
                                    <div class="card-body">
                                        <h5 class="card-title d-flex align-items-center">
                                            <span class="icon-circle bg-primary-light driver-text-primary me-2">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                            Informazioni generali
                                        </h5>
                                        
                                        <div class="info-grid">
                                            <div class="info-item">
                                                <div class="detail-label">ID Rimborso</div>
                                                <div class="detail-value">${refund.id}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="detail-label">Ordine collegato</div>
                                                <div class="detail-value">
                                                    <a href="#" class="text-primary">${refund.orderId}</a>
                                                </div>
                                            </div>
                                            <div class="info-item">
                                                <div class="detail-label">Importo</div>
                                                <div class="detail-value fw-bold">${refund.amount.toFixed(2)}€</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="detail-label">Motivazione</div>
                                                <div class="detail-value">${refund.reason}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 mb-4">
                                <div class="card border-0 shadow-hover">
                                    <div class="card-body">
                                        <h5 class="card-title d-flex align-items-center">
                                            <span class="icon-circle bg-info-light driver-text-info me-2">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            Cliente
                                        </h5>
                                        
                                        <div class="info-grid">
                                            <div class="info-item">
                                                <div class="detail-label">Nome</div>
                                                <div class="detail-value">${refund.customerName}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="detail-label">Email</div>
                                                <div class="detail-value">${refund.customerEmail}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="detail-label">Telefono</div>
                                                <div class="detail-value">${refund.customerPhone}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="card border-0 shadow-hover">
                                    <div class="card-body">
                                        <h5 class="card-title d-flex align-items-center">
                                            <span class="icon-circle bg-warning-light driver-text-warning me-2">
                                                <i class="fas fa-sticky-note"></i>
                                            </span>
                                            Note
                                        </h5>
                                        <div class="notes-container p-3 bg-light rounded">
                                            <p class="mb-0">${refund.notes || "Nessuna nota presente"}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer d-flex justify-content-between">
                        <button class="btn btn-light driver-modal-button" id="closeRefundBtn">
                            <i class="fas fa-times me-1"></i> Chiudi
                        </button>
                        <div>
                            <button class="btn btn-primary driver-modal-button" id="printRefundBtn">
                                <i class="fas fa-print me-1"></i> Stampa
                            </button>
                            ${refund.status === 'In attesa' ? `
                                <button class="btn btn-success ms-2 driver-modal-button" id="approveRefundBtn">
                                    <i class="fas fa-check me-1"></i> Approva
                                </button>
                                <button class="btn btn-danger ms-2 driver-modal-button" id="rejectRefundBtn">
                                    <i class="fas fa-times me-1"></i> Rifiuta
                                </button>
                            ` : ''}
                        </div>
                    </div>
                </div>
            `;
        }

        /**
         * Configura gli event listener per i pulsanti nel modal
         * @param {Object} refund - Dati del rimborso
         */
        function setupModalEventListeners(refund) {
            const modalContainer = document.getElementById('refundDetailModal');
            if (!modalContainer) return;
            
            document.querySelector('#closeRefundBtn').addEventListener('click', () => {
                modalContainer.classList.remove('show');
            });
            
            document.querySelector('.btn-close').addEventListener('click', () => {
                modalContainer.classList.remove('show');
            });
            
            const printRefundBtn = document.querySelector('#printRefundBtn');
            if (printRefundBtn) {
                printRefundBtn.addEventListener('click', () => {
                    // Utilizza la funzione di stampa dalla nuova utility
                    if (window.PrintUtils && typeof window.PrintUtils.printRefundDetail === 'function') {
                        window.PrintUtils.printRefundDetail(refund);
                    } else {
                        console.error('PrintUtils non disponibile');
                        if (typeof window.showToast === 'function') {
                            window.showToast('Errore', 'Funzione di stampa non disponibile', 'danger');
                        } else {
                            alert('Funzione di stampa non disponibile');
                        }
                    }
                });
            }
            
            const approveRefundBtn = document.querySelector('#approveRefundBtn');
            if (approveRefundBtn) {
                approveRefundBtn.addEventListener('click', () => {
                    // Simulazione approvazione
                    if (typeof window.showToast === 'function') {
                        window.showToast('Successo', 'Rimborso approvato con successo', 'success');
                    } else {
                        alert('Rimborso approvato con successo');
                    }
                    modalContainer.classList.remove('show');
                });
            }
            
            const rejectRefundBtn = document.querySelector('#rejectRefundBtn');
            if (rejectRefundBtn) {
                rejectRefundBtn.addEventListener('click', () => {
                    // Simulazione rifiuto
                    if (typeof window.showToast === 'function') {
                        window.showToast('Attenzione', 'Rimborso rifiutato', 'warning');
                    } else {
                        alert('Rimborso rifiutato');
                    }
                    modalContainer.classList.remove('show');
                });
            }
            
            // Chiusura al click fuori dal contenuto
            modalContainer.addEventListener('click', (e) => {
                if (e.target === modalContainer) {
                    modalContainer.classList.remove('show');
                }
            });
        }

        // API pubblica
        return {
            init: init,
            getRefundDetails: getRefundDetails
        };
    })();

    // Inizializzazione quando il DOM è pronto
    document.addEventListener('DOMContentLoaded', function() {
        RefundsManager.init();
        
        // Esporta le funzioni necessarie nel contesto globale
        window.getRefundData = RefundsManager.getRefundDetails;
    });
}