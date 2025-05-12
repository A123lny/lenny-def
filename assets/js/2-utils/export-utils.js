/**
 * Utility per esportazione dati in vari formati
 * Autore: Lenny1
 */
 
// Namespace per le funzioni di esportazione
const ExportUtils = {
    
    // Flag per prevenire download multipli
    _downloadInProgress: false,
    
    /**
     * Esporta i dati in formato CSV
     * @param {Array} data - Array di oggetti da esportare
     * @param {string} filename - Nome del file da scaricare
     * @param {Array} headers - Intestazioni delle colonne [opzionale]
     */
    toCSV: function(data, filename = 'export.csv', headers = null) {
        if (!data || !data.length) {
            this.showError('Nessun dato da esportare');
            return;
        }
        
        try {
            // Se non sono state fornite le intestazioni, usa le chiavi del primo oggetto
            if (!headers) {
                headers = Object.keys(data[0]);
            }
            
            // Crea la riga di intestazione
            let csvContent = headers.join(',') + '\n';
            
            // Aggiungi le righe di dati
            data.forEach(item => {
                const row = headers.map(header => {
                    // Gestisci campi vuoti, null o undefined
                    let cell = item[header] === null || item[header] === undefined ? '' : item[header];
                    // Gestisci valori con virgole, apici e nuove righe
                    cell = ('' + cell).replace(/"/g, '""');
                    if (cell.search(/("|,|\n)/g) >= 0) {
                        cell = `"${cell}"`;
                    }
                    return cell;
                }).join(',');
                csvContent += row + '\n';
            });
            
            // Crea il blob e scarica il file
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            this.downloadBlob(blob, filename);
            
            this.showSuccess('Esportazione CSV completata');
        } catch (error) {
            console.error('Errore durante l\'esportazione CSV:', error);
            this.showError('Si è verificato un errore durante l\'esportazione CSV');
        }
    },
    
    /**
     * Esporta i dati in formato Excel (XLSX)
     * @param {Array} data - Array di oggetti da esportare
     * @param {string} filename - Nome del file da scaricare
     * @param {string} sheetName - Nome del foglio Excel [opzionale]
     */
    toExcel: function(data, filename = 'export.xlsx', sheetName = 'Dati') {
        if (!data || !data.length) {
            this.showError('Nessun dato da esportare');
            return;
        }
        
        // Carica dinamicamente la libreria SheetJS (XLSX)
        this.loadScript('https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js')
            .then(() => {
                try {
                    // Crea un nuovo workbook
                    const wb = XLSX.utils.book_new();
                    
                    // Converti i dati in un worksheet
                    const ws = XLSX.utils.json_to_sheet(data);
                    
                    // Aggiungi il worksheet al workbook
                    XLSX.utils.book_append_sheet(wb, ws, sheetName);
                    
                    // Scarica il file XLSX
                    XLSX.writeFile(wb, filename);
                    
                    this.showSuccess('Esportazione Excel completata');
                } catch (error) {
                    console.error('Errore durante l\'esportazione Excel:', error);
                    this.showError('Si è verificato un errore durante l\'esportazione Excel');
                }
            })
            .catch(error => {
                console.error('Errore nel caricamento della libreria XLSX:', error);
                this.showError('Impossibile caricare la libreria per l\'esportazione Excel');
            });
    },
    
    /**
     * Esporta i dati in formato PDF
     * @param {Array} data - Array di oggetti da esportare
     * @param {string} filename - Nome del file da scaricare
     * @param {Object} options - Opzioni aggiuntive per il PDF [opzionale]
     */
    toPDF: function(data, filename = 'export.pdf', options = {}) {
        // Prima controlla se ci sono dati da esportare
        if (!data || !data.length) {
            this.showError('Nessun dato da esportare');
            return;
        }

        // Mostriamo un messaggio di caricamento
        this.showInfo('Generazione PDF in corso...');
        
        try {
            // Verifica che la libreria jspdf sia disponibile come modulo UMD
            if (typeof window.jspdf === 'undefined' && typeof window.jsPDF === 'undefined') {
                throw new Error('La libreria jsPDF non è stata caricata. Ricarica la pagina e riprova.');
            }
            
            // Creazione del documento PDF
            const jsPDFClass = window.jspdf?.jsPDF || window.jsPDF;
            const doc = new jsPDFClass({
                orientation: 'landscape',
                unit: 'mm',
                format: 'a4'
            });
            
            // Determina il titolo in base al nome del file
            let title = 'Esportazione Dati';
            if (filename.includes('rimborsi')) {
                title = 'Elenco Rimborsi';
            } else if (filename.includes('ordini')) {
                title = 'Elenco Ordini';
            } else if (filename.includes('ristoranti')) {
                title = 'Elenco Ristoranti';
            } else if (filename.includes('clienti')) {
                title = 'Elenco Clienti';
            } else if (filename.includes('driver')) {
                title = 'Elenco Driver';
            }
            
            // Aggiungiamo un titolo
            doc.setFontSize(18);
            doc.text(title, doc.internal.pageSize.getWidth() / 2, 15, { align: 'center' });
            
            // Data di esportazione
            const currentDate = new Date().toLocaleDateString('it-IT', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            doc.setFontSize(10);
            doc.text(`Esportato il: ${currentDate}`, doc.internal.pageSize.getWidth() - 15, 10, { align: 'right' });
            
            // Estraiamo i dati dalla tabella
            if (Array.isArray(data)) {
                // Se abbiamo dati in formato array, li usiamo direttamente
                const headers = Object.keys(data[0]);
                const tableData = data.map(item => headers.map(header => item[header]));
                
                // Verifica che autoTable sia disponibile
                if (typeof doc.autoTable !== 'function') {
                    throw new Error('Il plugin autoTable non è disponibile. Ricarica la pagina e riprova.');
                }
                
                // Crea la tabella con autoTable
                doc.autoTable({
                    head: [headers],
                    body: tableData,
                    startY: 25,
                    theme: 'striped',
                    headStyles: {
                        fillColor: [41, 128, 185],
                        textColor: 255,
                        fontStyle: 'bold'
                    },
                    styles: {
                        fontSize: 9,
                        cellPadding: 3
                    }
                });
            }
            
            // Aggiungiamo un footer
            const pageCount = doc.internal.getNumberOfPages();
            for (let i = 1; i <= pageCount; i++) {
                doc.setPage(i);
                const pageSize = doc.internal.pageSize;
                const pageWidth = pageSize.getWidth();
                const pageHeight = pageSize.getHeight();
                
                doc.setFontSize(8);
                doc.setTextColor(150);
                doc.text(
                    `Pagina ${i} di ${pageCount} - © ${new Date().getFullYear()} Lenny1`, 
                    pageWidth / 2, 
                    pageHeight - 10, 
                    { align: 'center' }
                );
            }
            
            // Salva il PDF
            doc.save(filename);
            
            this.showSuccess('Esportazione PDF completata');
            
        } catch (error) {
            console.error('Errore durante la generazione del PDF:', error);
            this.showError('Si è verificato un errore durante la generazione del PDF: ' + error.message);
        }
    },
    
    /**
     * Esporta la tabella corrente visualizzata nella pagina
     * @param {string} tableSelector - Selettore CSS della tabella
     * @param {string} format - Formato dell'esportazione ('csv', 'excel', 'pdf')
     * @param {string} filename - Nome del file [opzionale]
     */
    exportTable: function(tableSelector, format, filename) {
        // Se c'è già un'esportazione in corso, blocca l'azione
        if (this._downloadInProgress) {
            console.log('Esportazione già in corso, operazione bloccata');
            return;
        }
        
        this._downloadInProgress = true;
        
        // Trova la tabella e ottieni i dati
        const table = document.querySelector(tableSelector);
        
        if (!table) {
            this.showError('Tabella non trovata');
            this._downloadInProgress = false;
            return;
        }
        
        try {
            // Ottieni le intestazioni
            const headers = [];
            table.querySelectorAll('thead th').forEach((th, index, allThs) => {
                // Ignora l'ultima colonna (azioni)
                if (index < allThs.length - 1) {
                    headers.push(th.textContent.trim());
                }
            });
            
            // Ottieni i dati dalle righe
            const data = [];
            const rows = table.querySelectorAll('tbody tr:not([style*="display: none"])'); // solo righe visibili
            
            rows.forEach(row => {
                const rowData = {};
                const cells = row.querySelectorAll('td');
                
                headers.forEach((header, index) => {
                    // Ignora l'ultima colonna (azioni)
                    if (index < cells.length - 1) {
                        rowData[header] = cells[index].textContent.trim();
                    }
                });
                
                data.push(rowData);
            });
            
            // Se non ci sono dati, mostra un errore
            if (data.length === 0) {
                this.showError('Nessun dato disponibile per l\'esportazione');
                this._downloadInProgress = false;
                return;
            }
            
            // Determina il nome file se non specificato
            if (!filename) {
                const now = new Date();
                const dateStr = now.toISOString().slice(0, 10);
                filename = `export_${dateStr}`;
            }
            
            // Aggiungi estensione al filename se non presente
            if (!filename.includes('.')) {
                switch (format.toLowerCase()) {
                    case 'csv': filename += '.csv'; break;
                    case 'excel': filename += '.xlsx'; break;
                    case 'pdf': filename += '.pdf'; break;
                }
            }
            
            // Esporta nel formato specificato
            switch (format.toLowerCase()) {
                case 'csv':
                    this.toCSV(data, filename, headers);
                    break;
                    
                case 'excel':
                    this.toExcel(data, filename);
                    break;
                    
                case 'pdf':
                    this.toPDF(data, filename);
                    break;
                    
                default:
                    this.showError('Formato di esportazione non supportato');
            }
            
            // Reimposta il flag dopo un ritardo
            setTimeout(() => {
                this._downloadInProgress = false;
            }, 2000); // Blocca per 2 secondi per evitare clic multipli
            
        } catch (error) {
            console.error('Errore durante l\'esportazione della tabella:', error);
            this.showError('Si è verificato un errore durante l\'esportazione');
            this._downloadInProgress = false;
        }
    },
    
    /**
     * Carica dinamicamente uno script esterno
     * @param {string} src - URL dello script da caricare
     * @returns {Promise} - Promise che si risolve quando lo script è caricato
     */
    loadScript: function(src) {
        return new Promise((resolve, reject) => {
            // Controlla se lo script è già caricato
            if (document.querySelector(`script[src="${src}"]`)) {
                resolve();
                return;
            }
            
            const script = document.createElement('script');
            script.src = src;
            script.onload = resolve;
            script.onerror = () => reject(new Error(`Impossibile caricare lo script: ${src}`));
            document.head.appendChild(script);
        });
    },
    
    /**
     * Crea e scarica un blob
     * @param {Blob} blob - Blob da scaricare
     * @param {string} filename - Nome del file
     */
    downloadBlob: function(blob, filename) {
        // Usa un ID univoco per assicurarsi che il link sia sempre nuovo
        const linkId = 'download-link-' + new Date().getTime();
        const url = window.URL.createObjectURL(blob);
        
        // Rimuovi eventuali link precedenti
        const oldLinks = document.querySelectorAll('a[data-download-link]');
        oldLinks.forEach(link => link.remove());
        
        // Crea un nuovo link con ID univoco
        const link = document.createElement('a');
        link.id = linkId;
        link.href = url;
        link.setAttribute('download', filename);
        link.setAttribute('data-download-link', 'true');
        link.style.display = 'none';
        document.body.appendChild(link);
        
        // Aggiungi un piccolo ritardo per assicurarti che il DOM sia aggiornato
        setTimeout(() => {
            link.click();
            // Rimuovi il link dopo un po' di tempo
            setTimeout(() => {
                document.body.removeChild(link);
                window.URL.revokeObjectURL(url);
            }, 100);
        }, 100);
    },
    
    /**
     * Mostra un messaggio di successo
     * @param {string} message - Messaggio da mostrare
     */
    showSuccess: function(message) {
        // Accediamo direttamente al ToastComponent se esiste
        if (typeof ToastComponent !== 'undefined' && typeof ToastComponent.show === 'function') {
            ToastComponent.show('Completato', message, 'success');
        } else if (typeof window.showToast === 'function') {
            window.showToast('Completato', message, 'success');
        } else {
            console.log('Success: ' + message); // Evita gli alert fastidiosi
        }
    },
    
    /**
     * Mostra un messaggio informativo
     * @param {string} message - Messaggio da mostrare
     */
    showInfo: function(message) {
        // Accediamo direttamente al ToastComponent se esiste
        if (typeof ToastComponent !== 'undefined' && typeof ToastComponent.show === 'function') {
            ToastComponent.show('Info', message, 'info');
        } else if (typeof window.showToast === 'function') {
            window.showToast('Info', message, 'info');
        } else {
            console.log('Info: ' + message); // Evita gli alert fastidiosi
        }
    },
    
    /**
     * Mostra un messaggio di errore
     * @param {string} message - Messaggio di errore da mostrare
     */
    showError: function(message) {
        // Accediamo direttamente al ToastComponent se esiste
        if (typeof ToastComponent !== 'undefined' && typeof ToastComponent.show === 'function') {
            ToastComponent.show('Errore', message, 'danger');
        } else if (typeof window.showToast === 'function') {
            window.showToast('Errore', message, 'danger');
        } else {
            console.error('Errore: ' + message); // Evita gli alert fastidiosi
        }
    }
};

// Esponi l'oggetto globalmente
window.ExportUtils = ExportUtils;
