/**
 * Lenny Food Delivery - Utility di Stampa
 * Questo file fornisce funzioni per la stampa di documenti in vari formati
 */

// Verifica se PrintUtils esiste già prima di definirlo
if (typeof PrintUtils === 'undefined') {
    
    const PrintUtils = (function() {
        
        /**
         * Crea un documento di stampa per i dettagli di un rimborso
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
                            margin-bottom: 20px;
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
            if (!printWindow) {
                if (typeof window.showToast === 'function') {
                    window.showToast('Errore', 'Impossibile aprire la finestra di stampa. Controlla che i popup non siano bloccati.', 'danger');
                } else {
                    alert('Impossibile aprire la finestra di stampa. Controlla che i popup non siano bloccati.');
                }
                return;
            }
            
            printWindow.document.write(printContent);
            printWindow.document.close();

            // Attendi il caricamento della pagina prima di stampare
            printWindow.onload = function() {
                printWindow.print();
            };
        }
        
        /**
         * Crea un documento di stampa per i dettagli di un ordine
         * @param {Object} order - Dati dell'ordine da stampare
         */
        function printOrderDetail(order) {
            if (!order) {
                console.error('Nessun dettaglio ordine da stampare');
                if (typeof window.showToast === 'function') {
                    window.showToast('Errore', 'Nessun dettaglio ordine da stampare', 'danger');
                }
                return;
            }
            
            // Calcola i totali
            const subtotal = order.items.reduce((sum, item) => sum + item.price * item.quantity, 0);
            const total = subtotal + order.deliveryFee;
            
            let itemsHTML = '';
            order.items.forEach(item => {
                const itemTotal = item.price * item.quantity;
                itemsHTML += `
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd;">${item.name}</td>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd; text-align: center;">${item.quantity}</td>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd; text-align: right;">${item.price.toFixed(2)}€</td>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd; text-align: right;">${itemTotal.toFixed(2)}€</td>
                    </tr>
                `;
            });
            
            // Ottieni il testo dello stato in italiano
            function getStatusText(status) {
                switch(status) {
                    case 'nuovo': return 'Nuovo';
                    case 'preparazione': return 'In preparazione';
                    case 'pronto': return 'Pronto';
                    case 'consegna': return 'In consegna';
                    case 'consegnato': return 'Consegnato';
                    case 'annullato': return 'Annullato';
                    case 'ritardo': return 'In ritardo';
                    default: return status;
                }
            }
            
            // Crea il contenuto HTML da stampare
            const printContent = `
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Ordine #${order.id} - Stampa</title>
                    <meta charset="UTF-8">
                    <style>
                        body { font-family: Arial, sans-serif; color: #333; line-height: 1.4; }
                        .container { max-width: 800px; margin: 0 auto; padding: 20px; }
                        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #ff5a5f; padding-bottom: 10px; }
                        .company-name { font-weight: bold; font-size: 24px; color: #ff5a5f; margin-bottom: 5px; }
                        .section { margin-bottom: 20px; }
                        h1 { font-size: 24px; margin-bottom: 5px; }
                        h2 { font-size: 18px; border-bottom: 1px solid #eee; padding-bottom: 5px; margin-top: 20px; }
                        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px; }
                        .info-item { margin-bottom: 10px; }
                        .info-label { font-weight: bold; margin-bottom: 2px; display: block; font-size: 14px; }
                        .info-value { display: block; }
                        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                        th { text-align: left; padding: 10px 8px; background: #f5f5f5; border-bottom: 2px solid #ddd; }
                        td { padding: 8px; border-bottom: 1px solid #ddd; }
                        .text-center { text-align: center; }
                        .text-right { text-align: right; }
                        .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #666; border-top: 1px solid #ddd; padding-top: 10px; }
                        .status-badge { 
                            display: inline-block; 
                            padding: 5px 10px; 
                            border-radius: 4px; 
                            background: #e8f5e9; 
                            color: #2e7d32; 
                            font-weight: bold;
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
                    <div class="container">
                        <div class="header">
                            <div class="company-name">Lenny's Food Delivery</div>
                            <p>Via Example, 123 - Milano</p>
                            <p>Tel: +39 02 1234567</p>
                        </div>
                        
                        <div class="section">
                            <h1>Dettaglio Ordine #${order.id}</h1>
                            <p>Stato: <span class="status-badge">${getStatusText(order.status)}</span></p>
                        </div>
                        
                        <div class="section">
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Data ordine:</span>
                                    <span class="info-value">${order.orderDate}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Data consegna:</span>
                                    <span class="info-value">${order.deliveryDate}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section">
                            <h2>Cliente</h2>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Nome:</span>
                                    <span class="info-value">${order.customerName}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Telefono:</span>
                                    <span class="info-value">${order.customerPhone}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Email:</span>
                                    <span class="info-value">${order.customerEmail}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Indirizzo:</span>
                                    <span class="info-value">${order.customerAddress}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section">
                            <h2>Dettagli Ordine</h2>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Ristorante:</span>
                                    <span class="info-value">${order.restaurantName}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Pagamento:</span>
                                    <span class="info-value">${order.paymentMethod}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section">
                            <h2>Prodotti</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Prodotto</th>
                                        <th class="text-center">Qtà</th>
                                        <th class="text-right">Prezzo</th>
                                        <th class="text-right">Totale</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${itemsHTML}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" style="text-align: right; padding: 8px;"><strong>Subtotale:</strong></td>
                                        <td style="text-align: right; padding: 8px;">${subtotal.toFixed(2)}€</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align: right; padding: 8px;"><strong>Spese di consegna:</strong></td>
                                        <td style="text-align: right; padding: 8px;">${order.deliveryFee.toFixed(2)}€</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align: right; padding: 8px;"><strong>Totale:</strong></td>
                                        <td style="text-align: right; padding: 8px; font-weight: bold;">${total.toFixed(2)}€</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        ${order.notes ? `
                        <div class="section">
                            <h2>Note</h2>
                            <p>${order.notes}</p>
                        </div>
                        ` : ''}
                        
                        <div class="footer">
                            <p>Documento generato il ${new Date().toLocaleDateString('it-IT')} alle ${new Date().toLocaleTimeString('it-IT')}</p>
                        </div>
                    </div>
                </body>
                </html>
            `;
            
            // Crea una nuova finestra per la stampa
            const printWindow = window.open('', '_blank', 'width=800,height=600');
            if (!printWindow) {
                if (typeof window.showToast === 'function') {
                    window.showToast('Errore', 'Impossibile aprire la finestra di stampa. Controlla che i popup non siano bloccati.', 'danger');
                } else {
                    alert('Impossibile aprire la finestra di stampa. Controlla che i popup non siano bloccati.');
                }
                return;
            }
            
            printWindow.document.open();
            printWindow.document.write(printContent);
            printWindow.document.close();
            
            // Attendi il caricamento della pagina prima di stampare
            setTimeout(() => {
                printWindow.print();
            }, 250);
        }
        
        /**
         * Crea un documento di stampa generico
         * @param {string} title - Titolo del documento
         * @param {string} content - Contenuto HTML da stampare
         * @param {Object} styles - Stili CSS personalizzati (opzionale)
         */
        function printGenericDocument(title, content, styles) {
            if (!content) {
                console.error('Nessun contenuto da stampare');
                if (typeof window.showToast === 'function') {
                    window.showToast('Errore', 'Nessun contenuto da stampare', 'danger');
                }
                return;
            }

            // Stili CSS di base
            const defaultStyles = `
                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                    color: #333;
                }
                .header {
                    margin-bottom: 20px;
                    border-bottom: 2px solid #ff5a5f;
                    padding-bottom: 10px;
                }
                .logo {
                    font-weight: bold;
                    font-size: 24px;
                    color: #ff5a5f;
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
            `;

            // Combina gli stili predefiniti con quelli personalizzati
            const combinedStyles = styles ? defaultStyles + styles : defaultStyles;

            // Crea il contenuto HTML da stampare
            const printContent = `
            <html>
                <head>
                    <title>${title}</title>
                    <style>
                        ${combinedStyles}
                    </style>
                </head>
                <body>
                    <div class="header">
                        <div class="logo">Lenny's Food Delivery</div>
                    </div>
                    
                    ${content}
                    
                    <div class="footer">
                        Documento generato il ${new Date().toLocaleString('it-IT')} - Lenny's Food Delivery
                    </div>
                </body>
            </html>
            `;

            // Crea una nuova finestra per la stampa
            const printWindow = window.open('', '_blank', 'width=800,height=600');
            if (!printWindow) {
                if (typeof window.showToast === 'function') {
                    window.showToast('Errore', 'Impossibile aprire la finestra di stampa. Controlla che i popup non siano bloccati.', 'danger');
                } else {
                    alert('Impossibile aprire la finestra di stampa. Controlla che i popup non siano bloccati.');
                }
                return;
            }
            
            printWindow.document.write(printContent);
            printWindow.document.close();

            // Attendi il caricamento della pagina prima di stampare
            printWindow.onload = function() {
                printWindow.print();
            };
        }

        // API pubblica
        return {
            printRefundDetail: printRefundDetail,
            printOrderDetail: printOrderDetail,
            printGenericDocument: printGenericDocument
        };
    })();

    // Esporta le funzioni nel contesto globale
    window.PrintUtils = PrintUtils;
}