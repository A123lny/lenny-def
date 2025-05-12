/**
 * Restaurant Report Generator
 * Questo script gestisce la generazione di report PDF per i ristoranti
 */

// Controlliamo se jsPDF è già disponibile, altrimenti lo carichiamo dinamicamente
function loadRequiredLibraries(callback) {
    // Array delle librerie necessarie
    const libraries = [
        {
            name: 'jspdf',
            url: 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js',
            check: () => typeof window.jspdf !== 'undefined'
        },
        {
            name: 'html2canvas',
            url: 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js',
            check: () => typeof html2canvas !== 'undefined'
        }
    ];

    let loadedCount = 0;
    const totalToLoad = libraries.length;

    // Funzione per caricare una singola libreria
    function loadScript(library) {
        if (library.check()) {
            console.log(`${library.name} è già caricato`);
            loadedCount++;
            if (loadedCount === totalToLoad) {
                callback();
            }
            return;
        }

        const script = document.createElement('script');
        script.src = library.url;
        script.async = true;
        script.onload = function() {
            console.log(`${library.name} caricato con successo`);
            loadedCount++;
            if (loadedCount === totalToLoad) {
                callback();
            }
        };
        script.onerror = function() {
            console.error(`Errore nel caricamento di ${library.name}`);
        };
        document.head.appendChild(script);
    }

    // Carichiamo tutte le librerie necessarie
    libraries.forEach(library => loadScript(library));
}

// Classe per gestire la generazione dei report
class RestaurantReportGenerator {
    constructor() {
        this.pdf = null;
        this.restaurantData = null;
        this.pageWidth = 210;  // A4 width in mm
        this.margin = 15;      // margin in mm
        this.contentWidth = this.pageWidth - (this.margin * 2);
        this.currentY = this.margin;
    }

    // Inizializza il PDF
    initPdf() {
        this.pdf = new jspdf.jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: 'a4'
        });
        this.currentY = this.margin;
        this.pdf.setFont('helvetica');
    }

    // Raccoglie i dati del ristorante dal modal
    collectRestaurantData() {
        const data = {
            name: document.querySelector('.restaurant-name').textContent || 'Nome Ristorante',
            id: document.querySelector('.restaurant-id').textContent || 'ID-0000',
            rating: document.querySelector('.restaurant-rating').textContent || '0.0',
            status: document.querySelector('.restaurant-status').textContent || 'Stato Sconosciuto',
            address: document.querySelector('.restaurant-address').textContent || 'Indirizzo non disponibile',
            phone: document.querySelector('.restaurant-phone').textContent || 'Telefono non disponibile',
            email: document.querySelector('.restaurant-email').textContent || 'Email non disponibile',
            cuisine: document.querySelector('.restaurant-cuisine').textContent || 'Tipo di cucina non specificato',
            hours: document.querySelector('.restaurant-hours').textContent || 'Orari non disponibili',
            stats: {
                orders: document.querySelector('.restaurant-orders').textContent || '0',
                reviewCount: document.querySelector('.restaurant-reviews-count').textContent || '0',
                complaints: document.querySelector('.restaurant-complaints').textContent || '0'
            },
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
        
        // Raccogliamo i top prodotti
        const topProducts = [];
        document.querySelectorAll('.top-product-item').forEach((item, index) => {
            if (index < 5) {  // Prendiamo solo i primi 5
                const name = item.querySelector('h6')?.textContent || `Prodotto ${index + 1}`;
                const category = item.querySelector('p')?.textContent || 'Categoria non specificata';
                const orders = item.querySelector('.badge-pill')?.textContent || '0 ordini';
                topProducts.push({ name, category, orders });
            }
        });
        data.topProducts = topProducts;
        
        // Raccogliamo le zone di consegna
        const deliveryZones = [];
        const zoneRows = document.querySelectorAll('#delivery .custom-table tbody tr');
        zoneRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length >= 4) {
                const zoneName = cells[0].textContent.replace(/\s+/g, ' ').trim();
                const cost = cells[1].textContent.replace(/\s+/g, ' ').trim();
                const time = cells[2].textContent.replace(/\s+/g, ' ').trim();
                const minOrder = cells[3].textContent.replace(/\s+/g, ' ').trim();
                deliveryZones.push({ zoneName, cost, time, minOrder });
            }
        });
        data.deliveryZones = deliveryZones;

        this.restaurantData = data;
    }

    // Aggiunge l'intestazione al report
    addHeader() {
        // Aggiungiamo lo sfondo dell'header
        this.pdf.setFillColor(255, 90, 95);
        this.pdf.rect(0, 0, this.pageWidth, 40, 'F');
        
        // Titolo del report
        this.pdf.setTextColor(255, 255, 255);
        this.pdf.setFontSize(22);
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('REPORT RISTORANTE', this.margin, 15);
        
        // Sottotitolo con nome ristorante
        this.pdf.setFontSize(16);
        this.pdf.setFont('helvetica', 'normal');
        this.pdf.text(this.restaurantData.name, this.margin, 25);
        
        // Data generazione report
        this.pdf.setFontSize(10);
        this.pdf.setTextColor(240, 240, 240);
        const reportDate = `Generato il: ${this.restaurantData.date} alle ${this.restaurantData.time}`;
        const dateWidth = this.pdf.getStringUnitWidth(reportDate) * 10 / this.pdf.internal.scaleFactor;
        this.pdf.text(reportDate, this.pageWidth - this.margin - dateWidth, 25);
        
        // Reset per il contenuto
        this.pdf.setTextColor(0, 0, 0);
        this.currentY = 50;
    }

    // Aggiunge informazioni di base del ristorante
    addBasicInfo() {
        this.pdf.setFontSize(16);
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('Informazioni Generali', this.margin, this.currentY);
        this.currentY += 8;
        
        // Creiamo un riquadro con informazioni base
        this.pdf.setDrawColor(230, 230, 230);
        this.pdf.setFillColor(250, 250, 250);
        this.pdf.roundedRect(this.margin, this.currentY, this.contentWidth, 40, 3, 3, 'FD');
        
        this.pdf.setFontSize(11);
        this.pdf.setFont('helvetica', 'bold');
        
        // Prima riga di info
        let y = this.currentY + 8;
        this.pdf.text('ID:', this.margin + 5, y);
        this.pdf.setFont('helvetica', 'normal');
        this.pdf.text(this.restaurantData.id, this.margin + 25, y);
        
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('Stato:', this.margin + 80, y);
        this.pdf.setFont('helvetica', 'normal');
        this.pdf.text(this.restaurantData.status, this.margin + 100, y);
        
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('Valutazione:', this.margin + 140, y);
        this.pdf.setFont('helvetica', 'normal');
        this.pdf.text(this.restaurantData.rating + '/5', this.margin + 170, y);
        
        // Seconda riga di info
        y += 10;
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('Indirizzo:', this.margin + 5, y);
        this.pdf.setFont('helvetica', 'normal');
        this.pdf.text(this.restaurantData.address, this.margin + 25, y);
        
        // Terza riga di info
        y += 10;
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('Telefono:', this.margin + 5, y);
        this.pdf.setFont('helvetica', 'normal');
        this.pdf.text(this.restaurantData.phone, this.margin + 25, y);
        
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('Email:', this.margin + 80, y);
        this.pdf.setFont('helvetica', 'normal');
        this.pdf.text(this.restaurantData.email, this.margin + 100, y);
        
        // Quarta riga di info
        y += 10;
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('Cucina:', this.margin + 5, y);
        this.pdf.setFont('helvetica', 'normal');
        this.pdf.text(this.restaurantData.cuisine, this.margin + 25, y);
        
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('Orari:', this.margin + 80, y);
        this.pdf.setFont('helvetica', 'normal');
        this.pdf.text(this.restaurantData.hours, this.margin + 100, y);
        
        this.currentY += 50;
    }

    // Aggiunge metriche chiave
    addKeyMetrics() {
        this.pdf.setFontSize(16);
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('Metriche Chiave', this.margin, this.currentY);
        this.currentY += 8;
        
        // Box per metriche
        const metricWidth = this.contentWidth / 3 - 4;
        
        // Ordini
        this.pdf.setDrawColor(255, 90, 95);
        this.pdf.setFillColor(255, 240, 240);
        this.pdf.roundedRect(this.margin, this.currentY, metricWidth, 30, 3, 3, 'FD');
        
        this.pdf.setFontSize(18);
        this.pdf.setTextColor(255, 90, 95);
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text(this.restaurantData.stats.orders, this.margin + metricWidth/2, this.currentY + 12, { align: 'center' });
        
        this.pdf.setFontSize(10);
        this.pdf.text('ORDINI TOTALI', this.margin + metricWidth/2, this.currentY + 20, { align: 'center' });
        
        // Recensioni
        this.pdf.setDrawColor(0, 150, 220);
        this.pdf.setFillColor(240, 248, 255);
        this.pdf.roundedRect(this.margin + metricWidth + 4, this.currentY, metricWidth, 30, 3, 3, 'FD');
        
        this.pdf.setFontSize(18);
        this.pdf.setTextColor(0, 150, 220);
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text(this.restaurantData.stats.reviewCount, this.margin + metricWidth + 4 + metricWidth/2, this.currentY + 12, { align: 'center' });
        
        this.pdf.setFontSize(10);
        this.pdf.text('RECENSIONI', this.margin + metricWidth + 4 + metricWidth/2, this.currentY + 20, { align: 'center' });
        
        // Reclami
        this.pdf.setDrawColor(255, 150, 0);
        this.pdf.setFillColor(255, 245, 230);
        this.pdf.roundedRect(this.margin + (metricWidth + 4) * 2, this.currentY, metricWidth, 30, 3, 3, 'FD');
        
        this.pdf.setFontSize(18);
        this.pdf.setTextColor(255, 150, 0);
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text(this.restaurantData.stats.complaints, this.margin + (metricWidth + 4) * 2 + metricWidth/2, this.currentY + 12, { align: 'center' });
        
        this.pdf.setFontSize(10);
        this.pdf.text('RECLAMI', this.margin + (metricWidth + 4) * 2 + metricWidth/2, this.currentY + 20, { align: 'center' });
        
        // Reset colori
        this.pdf.setTextColor(0, 0, 0);
        this.currentY += 40;
    }

    // Aggiunge i prodotti più venduti
    addTopProducts() {
        this.pdf.setFontSize(16);
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('Prodotti Più Venduti', this.margin, this.currentY);
        this.currentY += 8;
        
        // Tabella prodotti
        this.pdf.setDrawColor(230, 230, 230);
        this.pdf.setFillColor(250, 250, 250);
        
        const productHeight = 8;
        this.pdf.roundedRect(this.margin, this.currentY, this.contentWidth, 
                            this.restaurantData.topProducts.length * productHeight + 10, 3, 3, 'FD');
        
        this.pdf.setFontSize(10);
        let y = this.currentY + 8;
        
        // Intestazioni tabella
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('Posizione', this.margin + 5, y);
        this.pdf.text('Nome', this.margin + 25, y);
        this.pdf.text('Categoria', this.margin + 100, y);
        this.pdf.text('Ordini', this.margin + 140, y);
        
        y += 2;
        this.pdf.setDrawColor(200, 200, 200);
        this.pdf.line(this.margin + 5, y, this.margin + this.contentWidth - 5, y);
        y += 4;
        
        // Dati prodotti
        this.pdf.setFont('helvetica', 'normal');
        this.restaurantData.topProducts.forEach((product, index) => {
            this.pdf.text((index + 1).toString(), this.margin + 8, y);
            this.pdf.text(product.name, this.margin + 25, y);
            this.pdf.text(product.category, this.margin + 100, y);
            this.pdf.text(product.orders, this.margin + 140, y);
            y += productHeight;
        });
        
        this.currentY += this.restaurantData.topProducts.length * productHeight + 20;
    }

    // Aggiunge le zone di consegna
    addDeliveryZones() {
        if (this.currentY + 60 > 270) { // Verifichiamo se abbiamo abbastanza spazio, altrimenti nuova pagina
            this.pdf.addPage();
            this.currentY = this.margin;
        }
        
        this.pdf.setFontSize(16);
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('Zone di Consegna', this.margin, this.currentY);
        this.currentY += 8;
        
        // Tabella zone
        this.pdf.setDrawColor(230, 230, 230);
        this.pdf.setFillColor(250, 250, 250);
        
        const zoneHeight = 8;
        this.pdf.roundedRect(this.margin, this.currentY, this.contentWidth, 
                            this.restaurantData.deliveryZones.length * zoneHeight + 10, 3, 3, 'FD');
        
        this.pdf.setFontSize(10);
        let y = this.currentY + 8;
        
        // Intestazioni tabella
        this.pdf.setFont('helvetica', 'bold');
        this.pdf.text('Zona', this.margin + 5, y);
        this.pdf.text('Costo', this.margin + 60, y);
        this.pdf.text('Tempo', this.margin + 100, y);
        this.pdf.text('Ordine Minimo', this.margin + 140, y);
        
        y += 2;
        this.pdf.setDrawColor(200, 200, 200);
        this.pdf.line(this.margin + 5, y, this.margin + this.contentWidth - 5, y);
        y += 4;
        
        // Dati zone
        this.pdf.setFont('helvetica', 'normal');
        this.restaurantData.deliveryZones.forEach(zone => {
            this.pdf.text(zone.zoneName, this.margin + 5, y);
            this.pdf.text(zone.cost, this.margin + 60, y);
            this.pdf.text(zone.time, this.margin + 100, y);
            this.pdf.text(zone.minOrder, this.margin + 140, y);
            y += zoneHeight;
        });
        
        this.currentY += this.restaurantData.deliveryZones.length * zoneHeight + 20;
    }

    // Aggiunge il footer al report
    addFooter() {
        const pageCount = this.pdf.internal.getNumberOfPages();
        for (let i = 1; i <= pageCount; i++) {
            this.pdf.setPage(i);
            
            // Linea separatrice
            this.pdf.setDrawColor(230, 230, 230);
            this.pdf.line(this.margin, 280, this.pageWidth - this.margin, 280);
            
            // Info piè di pagina
            this.pdf.setFontSize(8);
            this.pdf.setTextColor(150, 150, 150);
            this.pdf.text('Report generato da Lenny Food Delivery - Sistema di Gestione Ristoranti', this.margin, 285);
            
            // Numerazione pagine
            this.pdf.text(`Pagina ${i} di ${pageCount}`, this.pageWidth - this.margin - 25, 285);
        }
    }

    // Genera il report completo
    generateReport() {
        try {
            // Raccogliamo i dati
            this.collectRestaurantData();
            
            // Inizializziamo il PDF
            this.initPdf();
            
            // Creiamo il report
            this.addHeader();
            this.addBasicInfo();
            this.addKeyMetrics();
            this.addTopProducts();
            this.addDeliveryZones();
            this.addFooter();
            
            // Nome del file
            const fileName = `Report_${this.restaurantData.name.replace(/\s+/g, '_')}_${new Date().toISOString().slice(0, 10)}.pdf`;
            
            // Salviamo il PDF
            this.pdf.save(fileName);
            
            return true;
        } catch (error) {
            console.error('Errore nella generazione del report:', error);
            return false;
        }
    }
}

// Inizializzazione
document.addEventListener('DOMContentLoaded', function() {
    const exportButton = document.getElementById('exportRestaurantReport');
    
    if (exportButton) {
        exportButton.addEventListener('click', function() {
            // Mostriamo un loader o un messaggio di caricamento
            const originalContent = exportButton.innerHTML;
            exportButton.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Generazione...';
            exportButton.disabled = true;
            
            // Carico le librerie necessarie
            loadRequiredLibraries(function() {
                // Creo il generatore di report e genero il report
                const reportGenerator = new RestaurantReportGenerator();
                const success = reportGenerator.generateReport();
                
                // Ripristino il bottone
                setTimeout(() => {
                    exportButton.innerHTML = originalContent;
                    exportButton.disabled = false;
                    
                    if (success) {
                        // Feedback positivo
                        alert('Il report è stato generato con successo!');
                    } else {
                        // Feedback negativo
                        alert('Si è verificato un errore durante la generazione del report.');
                    }
                }, 1000);
            });
        });
    }
});