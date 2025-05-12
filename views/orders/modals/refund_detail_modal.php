<?php
/**
 * Modal per la visualizzazione dei dettagli di un rimborso
 * Questo file contiene il codice HTML per il modal di dettaglio rimborso e la funzione JavaScript associata
 */
?>
<!-- Modal per Dettaglio Rimborso -->
<div id="refundDetailModal" class="notification-detail-modal">
    <!-- Il contenuto del modal viene generato dinamicamente tramite JavaScript -->
</div>

<script>
    /**
     * Mostra i dettagli del rimborso in un modal
     * @param {string} refundId - ID del rimborso da visualizzare
     */
    function showRefundDetail(refundId) {
        const modalContainer = document.getElementById('refundDetailModal');
        
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
        const modalHTML = `
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
        
        modalContainer.innerHTML = modalHTML;
        modalContainer.classList.add('show');
        
        // Event listeners per i pulsanti nel modal
        document.querySelector('#closeRefundBtn').addEventListener('click', () => {
            modalContainer.classList.remove('show');
        });
        
        document.querySelector('.btn-close').addEventListener('click', () => {
            modalContainer.classList.remove('show');
        });
        
        const printRefundBtn = document.querySelector('#printRefundBtn');
        if (printRefundBtn) {
            printRefundBtn.addEventListener('click', () => {
                printRefundDetail(refund);
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
    
    /**
     * Ottiene i dettagli di un rimborso
     * @param {string} refundId - ID del rimborso
     * @returns {Object|null} Dati del rimborso o null se non trovato
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
            'RFD-1004': {
                id: 'RFD-1004',
                date: '08/04/2025',
                amount: 19.90,
                reason: 'Qualità del cibo',
                status: 'Rifiutato',
                orderId: 'ORD-1579',
                customerName: 'Andrea Verdi',
                customerEmail: 'andrea.verdi@email.com',
                customerPhone: '+39 324 765 0987',
                notes: 'Reclamo per qualità del cibo non sufficiente a giustificare rimborso secondo foto inviate.'
            },
            'RFD-1005': {
                id: 'RFD-1005',
                date: '06/04/2025',
                amount: 33.20,
                reason: 'Ordine incompleto',
                status: 'Approvato',
                orderId: 'ORD-1576',
                customerName: 'Sofia Esposito',
                customerEmail: 'sofia.esposito@email.com',
                customerPhone: '+39 324 765 0987',
                notes: 'Mancavano due prodotti dall\'ordine. Rimborso approvato per il valore dei prodotti mancanti.'
            },
            'RFD-1006': {
                id: 'RFD-1006',
                date: '03/04/2025',
                amount: 22.75,
                reason: 'Consegna in ritardo',
                status: 'In attesa',
                orderId: 'ORD-1573',
                customerName: 'Paolo Bianchi',
                customerEmail: 'paolo.bianchi@email.com',
                customerPhone: '+39 333 987 6543',
                notes: 'Consegna effettuata dopo oltre un\'ora dall\'orario stimato.'
            },
            'RFD-1007': {
                id: 'RFD-1007',
                date: '28/03/2025',
                amount: 42.75,
                reason: 'Ordine errato',
                status: 'Approvato',
                orderId: 'ORD-1568',
                customerName: 'Laura Bianchi',
                customerEmail: 'laura.bianchi@email.com',
                customerPhone: '+39 333 987 6543',
                notes: 'Rimborso parziale per alcuni prodotti diversi da quelli ordinati.'
            }
        };
        
        return refundsMap[refundId] || null;
    }
    
    /**
     * Stampa i dettagli del rimborso 
     * @param {Object} refund - Dati del rimborso da stampare
     */
    function printRefundDetail(refund) {
        if (!refund) {
            console.error('Nessun dettaglio rimborso da stampare');
            if (typeof window.showToast === 'function') {
                window.showToast('Errore', 'Nessun dettaglio rimborso da stampare', 'danger');
            }
            return;
        }

        // Imposta il colore dello stato
        let statusClass;
        switch (refund.status) {
            case 'In attesa':
                statusClass = 'warning';
                break;
            case 'Approvato':
                statusClass = 'success';
                break;
            case 'Rifiutato':
                statusClass = 'danger';
                break;
            default:
                statusClass = 'secondary';
        }

        // Crea il contenuto HTML da stampare
        const printContent = `
        <html>
            <head>
                <title>Dettaglio Rimborso ${refund.id}</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 20px;
                        color: #333;
                    }
                    .header {
                        border-bottom: 2px solid #ff5a5f;
                        padding-bottom: 10px;
                        margin-bottom: 20px;
                    }
                    .logo {
                        font-weight: bold;
                        font-size: 24px;
                        color: #ff5a5f;
                    }
                    .refund-id {
                        font-size: 18px;
                        margin-bottom: 5px;
                    }
                    .date {
                        color: #666;
                        margin-bottom: 20px;
                    }
                    .status {
                        display: inline-block;
                        padding: 5px 10px;
                        border-radius: 15px;
                        font-weight: bold;
                        font-size: 14px;
                        text-transform: uppercase;
                    }
                    .status-success {
                        background-color: rgba(0, 214, 143, 0.1);
                        color: #00d68f;
                    }
                    .status-warning {
                        background-color: rgba(255, 170, 0, 0.1);
                        color: #FFA500;
                    }
                    .status-danger {
                        background-color: rgba(244, 67, 54, 0.1);
                        color: #f44336;
                    }
                    .status-secondary {
                        background-color: rgba(108, 117, 125, 0.1);
                        color: #6c757d;
                    }
                    .section {
                        margin-bottom: 20px;
                        padding: 15px;
                        border: 1px solid #ddd;
                        border-radius: 5px;
                    }
                    .section-title {
                        font-weight: bold;
                        font-size: 16px;
                        margin-bottom: 10px;
                        padding-bottom: 5px;
                        border-bottom: 1px solid #eee;
                    }
                    .info-grid {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 15px;
                    }
                    .info-item {
                        margin-bottom: 5px;
                    }
                    .label {
                        font-size: 12px;
                        color: #666;
                    }
                    .value {
                        font-weight: 500;
                    }
                    .notes {
                        font-style: italic;
                        padding: 10px;
                        background-color: #f9f9f9;
                        border-left: 3px solid #ff5a5f;
                    }
                    .footer {
                        margin-top: 30px;
                        font-size: 12px;
                        text-align: center;
                        color: #666;
                        border-top: 1px solid #ddd;
                        padding-top: 10px;
                    }
                    @media print {
                        body {
                            margin: 0;
                            padding: 15px;
                        }
                        .no-print {
                            display: none;
                        }
                    }
                </style>
            </head>
            <body>
                <div class="header">
                    <div class="logo">Lenny's Food Delivery</div>
                    <div class="refund-id">Rimborso #${refund.id}</div>
                    <div class="date">Data: ${refund.date}</div>
                    <div class="status status-${statusClass}">${refund.status}</div>
                </div>
                
                <div class="section">
                    <div class="section-title">Informazioni Generali</div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="label">Ordine collegato:</div>
                            <div class="value">${refund.orderId}</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Importo:</div>
                            <div class="value">${refund.amount.toFixed(2)}€</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Motivazione:</div>
                            <div class="value">${refund.reason}</div>
                        </div>
                    </div>
                </div>
                
                <div class="section">
                    <div class="section-title">Cliente</div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="label">Nome:</div>
                            <div class="value">${refund.customerName}</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Email:</div>
                            <div class="value">${refund.customerEmail}</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Telefono:</div>
                            <div class="value">${refund.customerPhone}</div>
                        </div>
                    </div>
                </div>
                
                <div class="section">
                    <div class="section-title">Note</div>
                    <div class="notes">
                        ${refund.notes || "Nessuna nota presente"}
                    </div>
                </div>
                
                <div class="footer">
                    Documento generato il ${new Date().toLocaleString('it-IT')} - Lenny's Food Delivery
                </div>
            </body>
        </html>
        `;

        // Crea una nuova finestra per la stampa
        const printWindow = window.open('', '_blank', 'width=800,height=600');
        printWindow.document.write(printContent);
        printWindow.document.close();

        // Attendi il caricamento della pagina prima di stampare
        printWindow.onload = function() {
            printWindow.print();
        };
    }
</script>

<style>
    /* Stili personalizzati per il modal di dettaglio rimborsi */
    #refundDetailModal .modal-header-bg {
        height: 60px;
        background: linear-gradient(135deg, #ff5a5f 0%, #ff8f6b 100%);
        position: absolute;
        top: 0;
        left: 0;
    }
    
    #refundDetailModal .modal-title-container {
        z-index: 1;
        color: #fff;
    }
    
    #refundDetailModal .modal-icon-wrapper {
        width: 32px;
        height: 32px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
    }
    
    #refundDetailModal .notification-modal-close {
        background: transparent;
        border: none;
        font-size: 1.5rem;
        color: white;
        padding: 0;
        line-height: 1;
        opacity: 0.8;
        transition: opacity 0.2s ease;
    }
    
    #refundDetailModal .notification-modal-close:hover {
        opacity: 1;
    }
    
    /* Stile per i cards e grid */
    #refundDetailModal .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    #refundDetailModal .shadow-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    #refundDetailModal .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 1.25rem;
    }
    
    #refundDetailModal .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 1rem;
    }
    
    #refundDetailModal .info-item {
        padding-bottom: 0.75rem;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    #refundDetailModal .detail-label {
        font-size: 0.75rem;
        color: #64748b;
        margin-bottom: 0.25rem;
    }
    
    #refundDetailModal .detail-value {
        font-weight: 500;
        color: #1e293b;
    }
    
    /* Icone nei titoli */
    #refundDetailModal .icon-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
    }
    
    #refundDetailModal .bg-primary-light {
        background-color: rgba(255, 90, 95, 0.1);
    }
    
    #refundDetailModal .bg-info-light {
        background-color: rgba(54, 209, 220, 0.1);
    }
    
    #refundDetailModal .bg-warning-light {
        background-color: rgba(255, 170, 0, 0.1);
    }
    
    #refundDetailModal .driver-text-primary {
        color: #ff5a5f !important;
    }
    
    #refundDetailModal .driver-text-info {
        color: #36D1DC !important;
    }
    
    #refundDetailModal .driver-text-warning {
        color: #FFA500 !important;
    }
    
    /* Stile badge per status */
    #refundDetailModal .order-status-badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 600;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 50rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    #refundDetailModal .status-success {
        background-color: rgba(0, 214, 143, 0.1);
        color: #00d68f;
    }
    
    #refundDetailModal .status-warning {
        background-color: rgba(255, 170, 0, 0.1);
        color: #FFA500;
    }
    
    #refundDetailModal .status-danger {
        background-color: rgba(244, 67, 54, 0.1);
        color: #f44336;
    }
    
    #refundDetailModal .status-secondary {
        background-color: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }
    
    /* Note container */
    #refundDetailModal .notes-container {
        border-left: 3px solid #FFA500;
    }
    
    /* Stile pulsanti */
    #refundDetailModal .driver-modal-button {
        transition: all 0.3s ease;
    }
    
    #refundDetailModal .btn-primary {
        background: linear-gradient(135deg, #ff5a5f 0%, #ff8f6b 100%);
        border: none;
    }
    
    #refundDetailModal .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 90, 95, 0.3);
    }
    
    #refundDetailModal .btn-success {
        background: linear-gradient(135deg, #00d68f 0%, #00a2c0 100%);
        border: none;
    }
    
    #refundDetailModal .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 214, 143, 0.3);
    }
    
    #refundDetailModal .btn-danger {
        background: linear-gradient(135deg, #f44336 0%, #e57373 100%);
        border: none;
    }
    
    #refundDetailModal .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(244, 67, 54, 0.3);
    }
    
    #refundDetailModal .btn-light {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        color: #64748b;
    }
    
    #refundDetailModal .btn-light:hover {
        background: #e9ecef;
        color: #495057;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        #refundDetailModal .info-grid {
            grid-template-columns: 1fr;
        }
        
        #refundDetailModal .modal-footer {
            flex-direction: column-reverse;
            gap: 1rem;
        }
        
        #refundDetailModal .modal-footer button,
        #refundDetailModal .modal-footer > div {
            width: 100%;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
        
        #refundDetailModal .modal-footer > div {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
    }
</style>