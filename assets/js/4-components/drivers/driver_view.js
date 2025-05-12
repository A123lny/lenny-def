/**
 * File: assets/js/4-components/drivers/driver_view.js
 * Modulo per la gestione del modal di visualizzazione dei dettagli driver
 */

const DriverView = (function() {
    /**
     * Inizializza il modulo
     */
    function init() {
        // Configura i tooltip all'interno del modal
        initTooltips();
        
        // Configura gli event listeners
        setupViewModal();
    }
    
    /**
     * Inizializza i tooltip di Bootstrap all'interno del modal
     */
    function initTooltips() {
        const tooltips = document.querySelectorAll('#viewDriverModal [data-bs-toggle="tooltip"]');
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
     * Configura gli event listener per il modale di visualizzazione
     */
    function setupViewModal() {
        // Gestione dei pulsanti di visualizzazione
        const viewButtons = document.querySelectorAll('.view-driver-btn');
        viewButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const driverId = this.dataset.driverId;
                
                // Otteniamo i dati della riga corrispondente
                const driverRow = btn.closest('tr');
                const driverName = driverRow.querySelector('td:first-child strong').textContent;
                
                try {
                    // Aggiorna i dati nel modale
                    updateViewModalData(driverRow, driverId, driverName);
                    
                    // Mostriamo il modale
                    showModal('viewDriverModal');
                    console.log('Modale aperto per il driver ID:', driverId);
                } catch (error) {
                    console.error('Si è verificato un errore durante l\'apertura del modale:', error);
                    alert('Si è verificato un errore durante l\'apertura del modale. Controlla la console per dettagli.');
                }
            });
        });
        
        // Gestione del pulsante per passare al modale di modifica
        const editDriverBtn = document.getElementById('editDriverBtn');
        if (editDriverBtn) {
            editDriverBtn.addEventListener('click', function() {
                // Chiudi il modale di visualizzazione
                hideModal('viewDriverModal');
                
                // Apri il modale di modifica
                showModal('editDriverModal');
            });
        }
        
        // Gestione del pulsante "Esporta Report"
        const exportReportBtn = document.getElementById('exportDriverReport');
        if (exportReportBtn) {
            exportReportBtn.addEventListener('click', function() {
                // Ottieni i dati del driver dal modal
                const driverId = document.getElementById('driverId').textContent;
                const driverName = document.getElementById('driverFullName').textContent;
                
                // Mostra un loader o un messaggio di caricamento
                const originalContent = exportReportBtn.innerHTML;
                exportReportBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Generazione...';
                exportReportBtn.disabled = true;
                
                // Carica dinamicamente le librerie necessarie
                ExportUtils.loadScript('https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js')
                    .then(() => ExportUtils.loadScript('https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js'))
                    .then(() => {
                        // Genera il report
                        generateDriverReport()
                            .then(success => {
                                // Ripristina il bottone
                                setTimeout(() => {
                                    exportReportBtn.innerHTML = originalContent;
                                    exportReportBtn.disabled = false;
                                    
                                    if (success) {
                                        // Feedback positivo
                                        ExportUtils.showSuccess('Il report è stato generato con successo!');
                                    } else {
                                        // Feedback negativo
                                        ExportUtils.showError('Si è verificato un errore durante la generazione del report.');
                                    }
                                }, 1000);
                            });
                    })
                    .catch(error => {
                        console.error('Errore nel caricamento delle librerie:', error);
                        exportReportBtn.innerHTML = originalContent;
                        exportReportBtn.disabled = false;
                        ExportUtils.showError('Impossibile caricare le librerie per la generazione del report');
                    });
            });
        }
    }
    
    /**
     * Genera un report PDF per il driver
     * @returns {Promise<boolean>} - Promise che si risolve a true se il report è stato generato con successo
     */
    function generateDriverReport() {
        return new Promise((resolve) => {
            try {
                // Ottieni i dati dal modal
                const driverData = {
                    id: document.getElementById('driverId').textContent,
                    name: document.getElementById('driverFullName').textContent,
                    status: document.getElementById('driverStatusBadge').textContent,
                    email: document.getElementById('driverEmail').textContent,
                    phone: document.getElementById('driverPhone').textContent,
                    birthDate: document.getElementById('driverBirthDate').textContent,
                    fiscalCode: document.getElementById('driverFiscalCode')?.textContent || 'N/A',
                    address: document.getElementById('driverAddress')?.textContent || 'N/A',
                    hireDate: document.getElementById('driverHireDate')?.textContent || 'N/A',
                    contractType: document.getElementById('contractType')?.textContent || 'N/A',
                    rating: document.getElementById('driverRating')?.textContent || 'N/A',
                    notes: document.getElementById('driverNotes')?.textContent || 'Nessuna nota disponibile',
                    date: new Date().toLocaleDateString('it-IT', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    }),
                    time: new Date().toLocaleTimeString('it-IT', {
                        hour: '2-digit',
                        minute: '2-digit'
                    })
                };
                
                // Raccogli i documenti
                const documents = [];
                const documentRows = document.querySelectorAll('#viewDriverModal .custom-table tbody tr');
                documentRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    if (cells.length >= 4) {
                        const docType = cells[0].textContent.replace(/\s+/g, ' ').trim();
                        const docNumber = cells[1].textContent.replace(/\s+/g, ' ').trim();
                        const docExpiry = cells[2].textContent.replace(/\s+/g, ' ').trim();
                        const docStatus = cells[3].textContent.replace(/\s+/g, ' ').trim();
                        documents.push({ docType, docNumber, docExpiry, docStatus });
                    }
                });
                driverData.documents = documents;
                
                // Raccogli i mezzi (dalla tab mezzi se possibile)
                const vehicles = [];
                const vehicleRows = document.querySelectorAll('#vehicles .custom-table tbody tr');
                vehicleRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    if (cells.length >= 6) {
                        const vehicle = cells[0].textContent.replace(/\s+/g, ' ').trim();
                        const docType = cells[1].textContent.replace(/\s+/g, ' ').trim();
                        const docNumber = cells[2].textContent.replace(/\s+/g, ' ').trim();
                        const docExpiry = cells[4].textContent.replace(/\s+/g, ' ').trim();
                        const docStatus = cells[5].textContent.replace(/\s+/g, ' ').trim();
                        vehicles.push({ vehicle, docType, docNumber, docExpiry, docStatus });
                    }
                });
                driverData.vehicles = vehicles;
                
                // Inizializza il PDF
                const jsPDFClass = window.jspdf?.jsPDF || window.jsPDF;
                const pdf = new jsPDFClass({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: 'a4'
                });
                
                // Costanti per layout
                const pageWidth = 210; // A4 width in mm
                const margin = 15;
                const contentWidth = pageWidth - (margin * 2);
                let currentY = margin;
                
                // Header
                pdf.setFillColor(255, 90, 95);
                pdf.rect(0, 0, pageWidth, 40, 'F');
                
                // Titolo del report
                pdf.setTextColor(255, 255, 255);
                pdf.setFontSize(22);
                pdf.setFont('helvetica', 'bold');
                pdf.text('REPORT DRIVER', margin, 15);
                
                // Sottotitolo con nome driver
                pdf.setFontSize(16);
                pdf.setFont('helvetica', 'normal');
                pdf.text(driverData.name, margin, 25);
                
                // Data generazione report
                pdf.setFontSize(10);
                pdf.setTextColor(240, 240, 240);
                const reportDate = `Generato il: ${driverData.date} alle ${driverData.time}`;
                const dateWidth = pdf.getStringUnitWidth(reportDate) * 10 / pdf.internal.scaleFactor;
                pdf.text(reportDate, pageWidth - margin - dateWidth, 25);
                
                // Reset per il contenuto
                pdf.setTextColor(0, 0, 0);
                currentY = 50;
                
                // Informazioni generali
                pdf.setFontSize(16);
                pdf.setFont('helvetica', 'bold');
                pdf.text('Informazioni Generali', margin, currentY);
                currentY += 8;
                
                // Box informazioni
                pdf.setDrawColor(230, 230, 230);
                pdf.setFillColor(250, 250, 250);
                pdf.roundedRect(margin, currentY, contentWidth, 70, 3, 3, 'FD');
                
                pdf.setFontSize(11);
                pdf.setFont('helvetica', 'bold');
                
                // Prima riga di info
                let y = currentY + 8;
                pdf.text('ID:', margin + 5, y);
                pdf.setFont('helvetica', 'normal');
                pdf.text(driverData.id, margin + 25, y);
                
                pdf.setFont('helvetica', 'bold');
                pdf.text('Tipo Contratto:', margin + 80, y);
                pdf.setFont('helvetica', 'normal');
                pdf.text(driverData.contractType, margin + 115, y);
                
                pdf.setFont('helvetica', 'bold');
                pdf.text('Stato:', margin + 160, y);
                
                // Stato con colore corrispondente
                let statusColor = [41, 204, 151]; // Verde per default (attivo)
                if (driverData.status.toLowerCase().includes('inattivo')) {
                    statusColor = [220, 53, 69]; // Rosso per inattivo
                } else if (driverData.status.toLowerCase().includes('sospeso')) {
                    statusColor = [255, 170, 0]; // Arancione per sospeso
                }
                pdf.setTextColor(statusColor[0], statusColor[1], statusColor[2]);
                pdf.text(driverData.status, margin + 175, y);
                pdf.setTextColor(0, 0, 0);
                
                // Seconda riga di info
                y += 10;
                pdf.setFont('helvetica', 'bold');
                pdf.text('Email:', margin + 5, y);
                pdf.setFont('helvetica', 'normal');
                pdf.text(driverData.email, margin + 25, y);
                
                // Terza riga di info
                y += 10;
                pdf.setFont('helvetica', 'bold');
                pdf.text('Telefono:', margin + 5, y);
                pdf.setFont('helvetica', 'normal');
                pdf.text(driverData.phone, margin + 35, y);
                
                pdf.setFont('helvetica', 'bold');
                pdf.text('Data di nascita:', margin + 80, y);
                pdf.setFont('helvetica', 'normal');
                pdf.text(driverData.birthDate, margin + 125, y);
                
                // Quarta riga di info
                y += 10;
                pdf.setFont('helvetica', 'bold');
                pdf.text('Codice Fiscale:', margin + 5, y);
                pdf.setFont('helvetica', 'normal');
                pdf.text(driverData.fiscalCode, margin + 45, y);
                
                // Quinta riga di info
                y += 10;
                pdf.setFont('helvetica', 'bold');
                pdf.text('Indirizzo:', margin + 5, y);
                pdf.setFont('helvetica', 'normal');
                pdf.text(driverData.address, margin + 35, y);
                
                // Sesta riga di info
                y += 10;
                pdf.setFont('helvetica', 'bold');
                pdf.text('Data Assunzione:', margin + 5, y);
                pdf.setFont('helvetica', 'normal');
                pdf.text(driverData.hireDate, margin + 45, y);
                
                pdf.setFont('helvetica', 'bold');
                pdf.text('Valutazione:', margin + 80, y);
                pdf.setFont('helvetica', 'normal');
                pdf.text(`${driverData.rating}/5`, margin + 120, y);
                
                currentY += 80;
                
                // Documenti
                if (driverData.documents.length > 0) {
                    pdf.setFontSize(16);
                    pdf.setFont('helvetica', 'bold');
                    pdf.text('Documenti', margin, currentY);
                    currentY += 8;
                    
                    // Controllo se abbiamo abbastanza spazio o serve una nuova pagina
                    if (currentY + 10 + (driverData.documents.length * 8) > 270) {
                        pdf.addPage();
                        currentY = margin;
                        pdf.setFontSize(16);
                        pdf.setFont('helvetica', 'bold');
                        pdf.text('Documenti', margin, currentY);
                        currentY += 8;
                    }
                    
                    // Tabella documenti
                    pdf.autoTable({
                        startY: currentY,
                        head: [['Tipo Documento', 'Numero', 'Scadenza', 'Stato']],
                        body: driverData.documents.map(doc => [
                            doc.docType, doc.docNumber, doc.docExpiry, doc.docStatus
                        ]),
                        theme: 'striped',
                        headStyles: {
                            fillColor: [255, 90, 95],
                            textColor: 255,
                            fontStyle: 'bold'
                        },
                        styles: {
                            fontSize: 9,
                            cellPadding: 3
                        },
                        margin: { left: margin, right: margin }
                    });
                    
                    currentY = pdf.lastAutoTable.finalY + 10;
                }
                
                // Veicoli
                if (driverData.vehicles.length > 0) {
                    // Controllo se abbiamo abbastanza spazio o serve una nuova pagina
                    if (currentY + 50 > 270) {
                        pdf.addPage();
                        currentY = margin;
                    }
                    
                    pdf.setFontSize(16);
                    pdf.setFont('helvetica', 'bold');
                    pdf.text('Veicoli', margin, currentY);
                    currentY += 8;
                    
                    // Tabella veicoli
                    pdf.autoTable({
                        startY: currentY,
                        head: [['Veicolo', 'Tipo Documento', 'Numero', 'Scadenza', 'Stato']],
                        body: driverData.vehicles.map(v => [
                            v.vehicle, v.docType, v.docNumber, v.docExpiry, v.docStatus
                        ]),
                        theme: 'striped',
                        headStyles: {
                            fillColor: [255, 90, 95],
                            textColor: 255,
                            fontStyle: 'bold'
                        },
                        styles: {
                            fontSize: 9,
                            cellPadding: 3
                        },
                        margin: { left: margin, right: margin }
                    });
                    
                    currentY = pdf.lastAutoTable.finalY + 10;
                }
                
                // Note
                if (driverData.notes) {
                    // Controllo se abbiamo abbastanza spazio o serve una nuova pagina
                    if (currentY + 50 > 270) {
                        pdf.addPage();
                        currentY = margin;
                    }
                    
                    pdf.setFontSize(16);
                    pdf.setFont('helvetica', 'bold');
                    pdf.text('Note', margin, currentY);
                    currentY += 8;
                    
                    // Box per le note
                    pdf.setDrawColor(230, 230, 230);
                    pdf.setFillColor(250, 250, 250);
                    
                    const notesBox = {
                        text: driverData.notes,
                        x: margin,
                        y: currentY,
                        width: contentWidth,
                        height: 30,
                        style: {
                            font: 'helvetica',
                            fontSize: 10,
                            valign: 'top'
                        }
                    };
                    
                    pdf.roundedRect(notesBox.x, notesBox.y, notesBox.width, notesBox.height, 3, 3, 'FD');
                    
                    pdf.setFontSize(notesBox.style.fontSize);
                    pdf.setFont(notesBox.style.font, 'normal');
                    pdf.text(notesBox.text, notesBox.x + 5, notesBox.y + 5, {
                        maxWidth: notesBox.width - 10,
                        baseline: notesBox.style.valign
                    });
                    
                    currentY += notesBox.height + 10;
                }
                
                // Footer su tutte le pagine
                const pageCount = pdf.internal.getNumberOfPages();
                for (let i = 1; i <= pageCount; i++) {
                    pdf.setPage(i);
                    
                    // Linea separatrice
                    pdf.setDrawColor(230, 230, 230);
                    pdf.line(margin, 280, pageWidth - margin, 280);
                    
                    // Info piè di pagina
                    pdf.setFontSize(8);
                    pdf.setTextColor(150, 150, 150);
                    pdf.text('Report generato da Lenny Food Delivery - Sistema di Gestione Driver', margin, 285);
                    
                    // Numerazione pagine
                    pdf.text(`Pagina ${i} di ${pageCount}`, pageWidth - margin - 25, 285);
                }
                
                // Nome del file
                const fileName = `Report_Driver_${driverData.name.replace(/\s+/g, '_')}_${new Date().toISOString().slice(0, 10)}.pdf`;
                
                // Salva il PDF
                pdf.save(fileName);
                
                resolve(true);
            } catch (error) {
                console.error('Errore nella generazione del report:', error);
                resolve(false);
            }
        });
    }
    
    /**
     * Aggiorna i dati nel modale di visualizzazione
     */
    function updateViewModalData(driverRow, driverId, driverName) {
        // Modalità sicura: controlliamo l'esistenza di ogni elemento prima di usarlo
        const modalDriverNameElement = document.getElementById('modalDriverName');
        if (modalDriverNameElement) modalDriverNameElement.textContent = driverName;
        
        const driverFullNameElement = document.getElementById('driverFullName');
        if (driverFullNameElement) driverFullNameElement.textContent = driverName;
        
        const driverIdElement = document.getElementById('driverId');
        if (driverIdElement) driverIdElement.textContent = 'DR-' + driverId.padStart(4, '0');
        
        // Rating
        const ratingElement = driverRow.querySelector('.rating-value');
        const driverRatingElement = document.getElementById('driverRating');
        if (ratingElement && driverRatingElement) {
            driverRatingElement.textContent = ratingElement.textContent;
        }
        
        // Stato
        const statusElement = driverRow.querySelector('td:nth-child(6) .status-badge');
        const driverStatusElement = document.getElementById('driverStatusBadge');
        if (statusElement && driverStatusElement) {
            driverStatusElement.textContent = statusElement.textContent;
            
            // Aggiorniamo la classe dello status badge nel modale
            driverStatusElement.className = 'status-badge';
            
            if (statusElement.textContent.toLowerCase().includes('attivo')) {
                driverStatusElement.classList.add('status-active');
            } else if (statusElement.textContent.toLowerCase().includes('inattivo')) {
                driverStatusElement.classList.add('bg-danger-light');
                driverStatusElement.classList.add('text-danger');
            } else if (statusElement.textContent.toLowerCase().includes('consegna')) {
                driverStatusElement.classList.add('bg-warning-light');
                driverStatusElement.classList.add('text-warning');
            }
        }
        
        // Contatti
        const emailElement = driverRow.querySelector('td:nth-child(4) small:nth-child(2)');
        const phoneElement = driverRow.querySelector('td:nth-child(4) small:nth-child(1)');
        
        const driverEmailElement = document.getElementById('driverEmail');
        if (emailElement && driverEmailElement) {
            const emailText = emailElement.textContent;
            driverEmailElement.textContent = emailText.replace('i class="fas fa-envelope me-1"', '').trim();
        }
        
        const driverPhoneElement = document.getElementById('driverPhone');
        if (phoneElement && driverPhoneElement) {
            const phoneText = phoneElement.textContent;
            driverPhoneElement.textContent = phoneText.replace('i class="fas fa-phone me-1"', '').trim();
        }
    }
    
    /**
     * Mostra un modale
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
     * Nasconde un modale
     */
    function hideModal(modalId) {
        const modalElement = document.getElementById(modalId);
        if (modalElement) {
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) modalInstance.hide();
        }
    }
    
    // API pubblica del modulo
    return {
        init,
        showDriverModal: function(driverId, driverRow, driverName) {
            updateViewModalData(driverRow, driverId, driverName);
            showModal('viewDriverModal');
        }
    };
})();

// Inizializza il modulo quando il DOM è completamente caricato
document.addEventListener('DOMContentLoaded', function() {
    DriverView.init();
});