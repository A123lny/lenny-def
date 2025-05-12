/**
 * order-detail.js - Funzionalità per il modal di dettaglio ordine
 * Questo file gestisce la visualizzazione e l'interazione degli ordini nel dettaglio
 */

// Definizione della funzione getOrderData a livello globale del file
// per poterla esportare poi nel contesto window
function getOrderData(orderId) {
    // Rimuovi il prefisso "ORD-" se presente nell'ID
    const cleanId = orderId.replace('ORD-', '');
    
    // Mappiamo gli ordini reali presenti nella tabella della vista index.php
    const ordersData = {
        '1587': {
            id: 'ORD-1587',
            orderDate: '14/04/2025 14:32',
            deliveryDate: '14/04/2025 15:30',
            customerName: 'Mario Rossi',
            customerPhone: '+39 338 1234567',
            customerEmail: 'mario.rossi@example.com',
            customerAddress: 'Via Roma 123, Milano',
            restaurantName: 'Pizzeria Napoli',
            paymentMethod: 'Carta di credito',
            status: 'nuovo',
            notes: 'Consegnare al citofono n. 5',
            items: [
                { name: 'Pizza Margherita', quantity: 2, price: 8.50 },
                { name: 'Coca Cola 1L', quantity: 1, price: 3.50 },
                { name: 'Tiramisu', quantity: 1, price: 4.00 }
            ],
            subtotal: 24.50,
            deliveryFee: 4.00,
            timeline: {
                ordered: '14:32',
                preparing: null,
                delivering: null,
                delivered: null
            }
        },
        '1586': {
            id: 'ORD-1586',
            orderDate: '14/04/2025 10:15',
            deliveryDate: '14/04/2025 11:45',
            customerName: 'Laura Bianchi',
            customerPhone: '+39 331 9876543',
            customerEmail: 'laura.bianchi@example.com',
            customerAddress: 'Via Dante 45, Milano',
            restaurantName: 'Burger King',
            paymentMethod: 'PayPal',
            status: 'preparazione',
            notes: 'Chiamare prima di consegnare',
            items: [
                { name: 'Whopper Menu', quantity: 2, price: 12.90 },
                { name: 'King Fusion', quantity: 2, price: 4.50 },
                { name: 'Patatine Extra Large', quantity: 1, price: 3.95 }
            ],
            subtotal: 38.75,
            deliveryFee: 4.00,
            timeline: {
                ordered: '10:15',
                preparing: '10:30',
                delivering: null,
                delivered: null
            }
        },
        '1585': {
            id: 'ORD-1585',
            orderDate: '13/04/2025 12:50',
            deliveryDate: '13/04/2025 13:30',
            customerName: 'Andrea Verdi',
            customerPhone: '+39 347 5551234',
            customerEmail: 'andrea.verdi@example.com',
            customerAddress: 'Corso Italia 78, Roma',
            restaurantName: 'Pizzeria Da Mario',
            paymentMethod: 'Contanti',
            status: 'consegna',
            notes: '',
            items: [
                { name: 'Pizza Diavola', quantity: 1, price: 9.90 },
                { name: 'Calzone', quantity: 1, price: 8.50 },
                { name: 'Acqua 1L', quantity: 1, price: 1.50 }
            ],
            subtotal: 19.90,
            deliveryFee: 0.00, // Consegna gratuita
            timeline: {
                ordered: '12:50',
                preparing: '13:05',
                delivering: '13:20',
                delivered: null
            },
            driver: {
                name: 'Paolo Verdi',
                initials: 'PV',
                phone: '+39 345 6789012'
            }
        },
        '1584': {
            id: 'ORD-1584',
            orderDate: '10/04/2025 11:45',
            deliveryDate: '10/04/2025 13:00',
            customerName: 'Sofia Esposito',
            customerPhone: '+39 333 8765432',
            customerEmail: 'sofia.esposito@example.com',
            customerAddress: 'Via Torino 56, Napoli',
            restaurantName: 'Ristorante Bella Italia',
            paymentMethod: 'Carta di credito',
            status: 'consegnato',
            notes: '',
            items: [
                { name: 'Spaghetti alla carbonara', quantity: 2, price: 10.50 },
                { name: 'Tagliata di manzo', quantity: 1, price: 18.00 },
                { name: 'Tiramisù', quantity: 1, price: 5.00 },
                { name: 'Bottiglia di vino rosso', quantity: 1, price: 15.00 }
            ],
            subtotal: 29.20,
            deliveryFee: 4.00,
            timeline: {
                ordered: '11:45',
                preparing: '12:00',
                delivering: '12:30',
                delivered: '12:55'
            },
            driver: {
                name: 'Giovanni Ferrari',
                initials: 'GF',
                phone: '+39 342 1122334'
            }
        },
        '1583': {
            id: 'ORD-1583',
            orderDate: '02/04/2025 10:30',
            deliveryDate: '02/04/2025 11:45',
            customerName: 'Luca Russo',
            customerPhone: '+39 329 4455667',
            customerEmail: 'luca.russo@example.com',
            customerAddress: 'Corso Buenos Aires 12, Milano',
            restaurantName: 'Sushi Fusion',
            paymentMethod: 'PayPal',
            status: 'consegnato',
            notes: 'Lasciare all\'ingresso principale',
            items: [
                { name: 'Sushi Box Mix 24pz', quantity: 1, price: 18.90 },
                { name: 'Edamame', quantity: 1, price: 3.90 },
                { name: 'Tè verde', quantity: 1, price: 3.00 }
            ],
            subtotal: 25.80,
            deliveryFee: 3.00,
            timeline: {
                ordered: '10:30',
                preparing: '10:45',
                delivering: '11:15',
                delivered: '11:40'
            },
            driver: {
                name: 'Fabio Bruno',
                initials: 'FB',
                phone: '+39 348 9876543'
            }
        },
        '1582': {
            id: 'ORD-1582',
            orderDate: '28/03/2025 16:42',
            deliveryDate: '28/03/2025 17:45',
            customerName: 'Francesco Baldi',
            customerPhone: '+39 335 7788991',
            customerEmail: 'francesco.baldi@example.com',
            customerAddress: 'Via Garibaldi 87, Milano',
            restaurantName: 'Burger King',
            paymentMethod: 'Contanti',
            status: 'consegnato',
            notes: '',
            items: [
                { name: 'Crispy Chicken Menu', quantity: 1, price: 10.90 },
                { name: 'King Jr Menu', quantity: 1, price: 5.90 },
                { name: 'Sundae', quantity: 1, price: 2.10 }
            ],
            subtotal: 18.90,
            deliveryFee: 3.00,
            timeline: {
                ordered: '16:42',
                preparing: '16:55',
                delivering: '17:15',
                delivered: '17:40'
            },
            driver: {
                name: 'Mario Bianchi',
                initials: 'MB',
                phone: '+39 339 1122334'
            }
        },
        '1581': {
            id: 'ORD-1581',
            orderDate: '20/03/2025 09:15',
            deliveryDate: '20/03/2025 10:30',
            customerName: 'Giulia Martini',
            customerPhone: '+39 334 5566778',
            customerEmail: 'giulia.martini@example.com',
            customerAddress: 'Viale Monza 42, Milano',
            restaurantName: 'Pizzeria Napoli',
            paymentMethod: 'Carta di credito',
            status: 'consegnato',
            notes: 'Citofonare interno 7',
            items: [
                { name: 'Pizza Capricciosa', quantity: 2, price: 10.50 },
                { name: 'Pizza Quattro Formaggi', quantity: 1, price: 9.50 },
                { name: 'Bibita in lattina', quantity: 2, price: 1.00 }
            ],
            subtotal: 32.50,
            deliveryFee: 0.00, // Consegna gratuita
            timeline: {
                ordered: '09:15',
                preparing: '09:30',
                delivering: '10:00',
                delivered: '10:25'
            },
            driver: {
                name: 'Paolo Verdi',
                initials: 'PV',
                phone: '+39 345 6789012'
            }
        }
    };
    
    // Ritorna i dati dell'ordine richiesto se esistono, altrimenti null
    if (cleanId in ordersData) {
        return ordersData[cleanId];
    } else {
        console.error('Ordine non trovato:', orderId, 'ID pulito:', cleanId);
        return null;
    }
}

const OrderDetailComponent = (function() {
    // Stato interno del componente
    let orderDetailModal;
    let orderDetailNumber;
    
    /**
     * Inizializza il componente
     * @public
     */
    function init() {
        // Riferimenti agli elementi del modal
        orderDetailModal = document.getElementById('orderDetailModal');
        orderDetailNumber = document.getElementById('orderDetailNumber');
        
        // Se non c'è il modal nella pagina, esci
        if (!orderDetailModal) {
            return;
        }
        
        // Aggiungi event listener ai pulsanti di visualizzazione dettaglio ordine
        setupEventListeners();
    }
    
    /**
     * Configura gli event listener
     * @private
     */
    function setupEventListeners() {
        document.querySelectorAll('.view-order-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const orderId = this.dataset.orderId;
                openOrderDetail(orderId);
            });
        });
        
        // Pulsante stampa
        const printOrderDetailBtn = document.getElementById('printOrderDetailBtn');
        if (printOrderDetailBtn) {
            printOrderDetailBtn.addEventListener('click', function() {
                const orderId = orderDetailNumber.textContent.replace('#', '');
                const orderData = getOrderData(orderId);
                if (orderData && typeof window.PrintUtils === 'object') {
                    window.PrintUtils.printOrderDetail(orderData);
                } else if (orderData) {
                    console.error('PrintUtils non disponibile');
                    if (typeof window.showToast === 'function') {
                        window.showToast('Errore', 'Funzione di stampa non disponibile', 'danger');
                    } else {
                        alert('Funzione di stampa non disponibile');
                    }
                }
            });
        }
    }
    
    /**
     * Apre il modal con i dettagli dell'ordine
     * @param {string} orderId - ID dell'ordine da visualizzare
     * @private
     */
    function openOrderDetail(orderId) {
        // Ottieni i dati dell'ordine 
        const orderData = getOrderData(orderId);
        
        // Popola il modal con i dati dell'ordine
        populateOrderDetail(orderData);
        
        // Mostra il modal
        const modal = new bootstrap.Modal(orderDetailModal);
        modal.show();
    }
    
    /**
     * Popola il modal con i dati dell'ordine
     * @param {Object} order - Dati dell'ordine
     * @private
     */
    function populateOrderDetail(order) {
        if (!order) return;
        
        // Titolo modal
        orderDetailNumber.textContent = `#${order.id}`;
        
        // Dati cliente
        document.getElementById('customerName').textContent = order.customerName || '-';
        document.getElementById('customerPhone').textContent = order.customerPhone || '-';
        document.getElementById('customerEmail').textContent = order.customerEmail || '-';
        document.getElementById('customerAddress').textContent = order.customerAddress || '-';
        
        // Dati ordine
        document.getElementById('orderDate').textContent = order.orderDate || '-';
        
        // Data e ora consegna - formattazione dello slot di 30 minuti
        const deliveryDateText = formatDeliverySlotWithTime(order.deliveryDate || '-');
        document.getElementById('deliveryDateFixed').textContent = deliveryDateText;
        
        // Ristorante
        document.getElementById('restaurantName').textContent = order.restaurantName || '-';
        
        // Metodo di pagamento
        document.getElementById('paymentMethodFixed').textContent = order.paymentMethod || '-';
        
        // Badge stato
        const orderStatusEl = document.getElementById('orderStatus');
        orderStatusEl.className = 'order-status-badge status-' + order.status;
        orderStatusEl.textContent = getStatusText(order.status);
        
        // Note - Utilizzo l'ID corretto orderNotesDetail
        const orderNotesEl = document.getElementById('orderNotesDetail');
        if (orderNotesEl) {
            if (order.notes && order.notes.trim() !== '') {
                orderNotesEl.textContent = order.notes;
            } else {
                orderNotesEl.textContent = 'Nessuna nota disponibile';
            }
        }
        
        // Timeline
        updateTimeline(order.status, order.timeline);
        
        // Prodotti
        populateOrderItems(order.items, order.subtotal, order.deliveryFee);
        
        // Driver (se applicabile)
        if (order.driver) {
            document.getElementById('driverInfoSection').style.display = 'block';
            document.getElementById('driverName').textContent = order.driver.name || '-';
            document.getElementById('driverPhone').textContent = order.driver.phone || '-';
            document.getElementById('driverInitials').textContent = order.driver.initials || '-';
            
            // Event listener per i pulsanti del driver
            document.getElementById('callDriverBtn').onclick = function() {
                alert(`Chiamata a ${order.driver.name}: ${order.driver.phone}`);
            };
            
            document.getElementById('trackDeliveryBtn').onclick = function() {
                alert(`Tracciamento della consegna dell'ordine #${order.id}`);
            };
        } else {
            document.getElementById('driverInfoSection').style.display = 'none';
        }
    }
    
    /**
     * Formatta lo slot di consegna in formato "GG/MM/AAAA 10:00-10:30"
     * @param {string} dateTimeStr - Data e ora in formato "GG/MM/AAAA HH:MM"
     * @returns {string} Data e ora formattata con slot di consegna
     * @private
     */
    function formatDeliverySlotWithTime(dateTimeStr) {
        if (!dateTimeStr || dateTimeStr === '-') return '-';
        
        try {
            // Estrai la data completa e l'orario
            const parts = dateTimeStr.split(' ');
            if (parts.length < 2) return dateTimeStr;
            
            const datePart = parts[0];
            const timePart = parts[1];
            
            // Estrai ora e minuti
            const [hours, minutes] = timePart.split(':');
            const hour = parseInt(hours);
            const minute = parseInt(minutes);
            
            // Calcola l'orario di fine dello slot (30 minuti dopo)
            let endHour = hour;
            let endMinute = minute + 30;
            
            if (endMinute >= 60) {
                endHour += 1;
                endMinute -= 60;
            }
            
            // Formatta l'orario di inizio e fine slot
            const startTime = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
            const endTime = `${endHour.toString().padStart(2, '0')}:${endMinute.toString().padStart(2, '0')}`;
            
            // Ritorna la data con lo slot orario completo
            return `${datePart} ${startTime}-${endTime}`;
            
        } catch(e) {
            console.error("Errore nel formato della data:", e, dateTimeStr);
            return dateTimeStr;
        }
    }
    
    /**
     * Formatta lo slot di consegna in formato "10:00-10:30"
     * @param {string} dateTimeStr - Data e ora in formato "GG/MM/AAAA HH:MM"
     * @returns {string} Slot orario formattato
     * @private
     */
    function formatDeliverySlot(dateTimeStr) {
        if (!dateTimeStr || dateTimeStr === '-') return '-';
        
        try {
            // Estrai la data completa e l'orario
            const parts = dateTimeStr.split(' ');
            if (parts.length < 2) return dateTimeStr;
            
            const datePart = parts[0];
            const timePart = parts[1];
            
            // Estrai ora e minuti
            const [hours, minutes] = timePart.split(':');
            
            // Calcola l'orario di fine dello slot (30 minuti dopo)
            let endHours = parseInt(hours);
            let endMinutes = parseInt(minutes) + 30;
            
            if (endMinutes >= 60) {
                endHours += 1;
                endMinutes -= 60;
            }
            
            // Formatta l'orario di inizio e fine
            const startTime = `${hours}:${minutes}`;
            const endTime = `${endHours.toString().padStart(2, '0')}:${endMinutes.toString().padStart(2, '0')}`;
            
            // Aggiunge la data all'inizio
            return `<span class="delivery-slot">${datePart} ${startTime}-${endTime}</span>`;
        } catch(e) {
            console.error("Errore nel formato della data:", e, dateTimeStr);
            return dateTimeStr;
        }
    }
    
    /**
     * Aggiorna la timeline in base allo stato dell'ordine
     * @param {string} status - Stato dell'ordine
     * @param {Object} timelineData - Dati della timeline
     * @private
     */
    function updateTimeline(status, timelineData) {
        // Reset
        document.querySelectorAll('.timeline-step').forEach(step => {
            step.classList.remove('active', 'completed');
        });
        
        // Aggiorna timestamp
        document.getElementById('orderedTime').textContent = timelineData.ordered;
        document.getElementById('preparingTime').textContent = timelineData.preparing || '-';
        document.getElementById('deliveringTime').textContent = timelineData.delivering || '-';
        document.getElementById('deliveredTime').textContent = timelineData.delivered || '-';
        
        // Aggiorna timeline in base allo stato
        if (status === 'nuovo') {
            document.getElementById('timelineOrdered').classList.add('active');
        } 
        else if (status === 'preparazione') {
            document.getElementById('timelineOrdered').classList.add('completed');
            document.getElementById('timelinePreparing').classList.add('active');
        }
        else if (status === 'consegna') {
            document.getElementById('timelineOrdered').classList.add('completed');
            document.getElementById('timelinePreparing').classList.add('completed');
            document.getElementById('timelineDelivering').classList.add('active');
        }
        else if (status === 'consegnato') {
            document.getElementById('timelineOrdered').classList.add('completed');
            document.getElementById('timelinePreparing').classList.add('completed');
            document.getElementById('timelineDelivering').classList.add('completed');
            document.getElementById('timelineDelivered').classList.add('active');
        }
    }
    
    /**
     * Popola la tabella dei prodotti
     * @param {Array} items - Lista dei prodotti ordinati
     * @param {number} subtotal - Subtotale
     * @param {number} deliveryFee - Spese di consegna
     * @private
     */
    function populateOrderItems(items, subtotal, deliveryFee) {
        const tbody = document.getElementById('orderItemsDetailTable').querySelector('tbody');
        
        // Resetta la tabella
        tbody.innerHTML = '';
        
        // Se non ci sono prodotti
        if (!items || items.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center py-3">Nessun prodotto disponibile</td>
                </tr>
            `;
            return;
        }
        
        // Aggiungi prodotti
        items.forEach(item => {
            const itemTotal = item.price * item.quantity;
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.name}</td>
                <td class="text-center">${item.quantity}</td>
                <td class="text-end">${item.price.toFixed(2)}€</td>
                <td class="text-end">${itemTotal.toFixed(2)}€</td>
            `;
            
            tbody.appendChild(row);
        });
        
        // Aggiorna totali
        document.getElementById('subtotalAmount').textContent = subtotal.toFixed(2) + '€';
        document.getElementById('deliveryFeeAmount').textContent = deliveryFee.toFixed(2) + '€';
        document.getElementById('totalDetailAmount').textContent = (subtotal + deliveryFee).toFixed(2) + '€';
    }
    
    /**
     * Ottiene il testo dello stato in italiano
     * @param {string} status - Stato dell'ordine
     * @returns {string} Testo dello stato in italiano
     * @private
     */
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
    
    // API pubblica del componente
    return {
        init: init,
        openOrderDetail: openOrderDetail
    };
})();

// Inizializzazione del componente quando il DOM è pronto
document.addEventListener('DOMContentLoaded', function() {
    // Inizializza il componente se il modal è presente nella pagina
    OrderDetailComponent.init();
    
    // Rendi disponibile globalmente per l'integrazione con altri componenti
    window.OrderDetailComponent = OrderDetailComponent;
    
    // Esponi la funzione getOrderData nel contesto globale per la funzionalità di stampa
    window.getOrderData = getOrderData;
});