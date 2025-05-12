/**
 * Notification Service
 * Gestisce le notifiche dinamiche nell'interfaccia utente
 * @module NotificationService
 */

const NotificationService = (function() {
    // Variabili private
    let notificationCount = 0;
    let notificationIndex = 0;
    let notificationActive = false;
    
    // Elementi DOM
    let notificationButton;
    let notificationBadge;
    let notificationsDropdown;
    let notificationIconWrapper;
    let viewAllNotificationsBtn;
    let notificationPopupContainer;
    let notificationDetailModal;
    let allNotificationsModal;
    
    // Dati delle notifiche (in un'applicazione reale sarebbero caricati da API)
    const notifications = [
        {
            id: 'n1',
            icon: 'shopping-bag',
            bgClass: 'bg-primary',
            text: 'Nuovo ordine ricevuto: Pizza Margherita',
            time: 'Adesso',
            type: 'order',
            data: {
                orderId: 'ORD-1587',
                customerName: 'Mario Rossi',
                customerPhone: '+39 345 123 4567',
                totalAmount: 28.50,
                items: [
                    { name: 'Pizza Margherita', quantity: 2, price: 8.50, image: 'pizza-margherita.jpg' },
                    { name: 'Coca Cola 33cl', quantity: 2, price: 2.50, image: 'coca-cola.jpg' },
                    { name: 'Patatine Fritte', quantity: 1, price: 3.50, image: 'fries.jpg' }
                ],
                deliveryAddress: 'Via Roma 123, Milano',
                paymentMethod: 'Carta di credito',
                restaurantAddress: 'Via Verdi 28, Milano',
                estimatedDeliveryTime: 35,
                deliverySteps: [
                    { status: 'ordered', time: '14:30', title: 'Ordine ricevuto', completed: true },
                    { status: 'preparing', time: '14:35', title: 'In preparazione', completed: true },
                    { status: 'ready', time: '14:50', title: 'Pronto per la consegna', completed: false },
                    { status: 'delivering', time: '15:00', title: 'In consegna', completed: false },
                    { status: 'delivered', time: '15:15', title: 'Consegnato', completed: false }
                ]
            }
        },
        {
            id: 'n2',
            icon: 'motorcycle',
            bgClass: 'bg-warning',
            text: 'Il driver Paolo è in ritardo',
            time: '5 minuti fa',
            type: 'driver',
            data: {
                driverId: 'D-005',
                driverName: 'Paolo Bianchi',
                driverPhone: '+39 333 987 6543',
                orderId: 'ORD-1582',
                customerName: 'Giulia Verdi',
                delayMinutes: 15,
                currentLocation: 'Via Garibaldi 45',
                estimatedArrival: '15:45',
                deliveryAddress: 'Corso Italia 67'
            }
        },
        {
            id: 'n3',
            icon: 'user-plus',
            bgClass: 'bg-success',
            text: 'Nuovo cliente registrato: Marco Rossi',
            time: '10 minuti fa',
            type: 'customer',
            data: {
                customerId: 'C-123',
                customerName: 'Marco Rossi',
                customerEmail: 'marco.rossi@example.com',
                customerPhone: '+39 347 555 8899',
                customerAddress: 'Piazza Duomo 1, Milano',
                registrationDate: '16/07/2023 14:30'
            }
        }
    ];
    
    /**
     * Inizializza il servizio di notifiche
     * @public
     */
    function init() {
        // Verifica se siamo nella dashboard o in una pagina che utilizza notifiche
        if (!document.querySelector('.notification-btn')) {
            console.warn('Elementi di notifica non trovati nella pagina');
            return;
        }
        
        // Inizializza elementi DOM
        if (!initDOMElements()) {
            console.error('Impossibile inizializzare gli elementi DOM per le notifiche');
            return;
        }
        
        console.log('Elementi DOM per notifiche inizializzati con successo');
        
        // Configura gestori eventi e container
        setupEventHandlers();
        setupContainers();
        
        // Nascondi il badge all'inizio quando non ci sono notifiche
        notificationBadge.style.display = 'none';
        
        // Configura simulazione di notifiche
        setupDashboardNotifications();

        console.log('NotificationService inizializzato con successo');
    }
    
    /**
     * Inizializza elementi DOM
     * @private
     */
    function initDOMElements() {
        // Aggiornato per adattarsi alla nuova struttura della navbar
        notificationButton = document.querySelector('.notification-btn');
        notificationBadge = document.querySelector('.notification-badge');
        notificationsDropdown = document.querySelector('.notification-dropdown-menu .dropdown-body');
        notificationIconWrapper = document.querySelector('.notification-icon-wrapper');
        viewAllNotificationsBtn = document.querySelector('.notification-dropdown-menu .dropdown-item-link');
        
        if (!notificationButton || !notificationBadge || !notificationsDropdown || !notificationIconWrapper) {
            console.warn('Elementi DOM per le notifiche non trovati');
            return false;
        }
        
        return true;
    }
    
    /**
     * Configura i gestori eventi
     * @private
     */
    function setupEventHandlers() {
        // Aggiungi un gestore di eventi per il clic sulla notifica
        notificationButton.addEventListener('click', function() {
            // Rimuovi la classe di animazione quando l'utente clicca
            notificationIconWrapper.classList.remove('shake-animation');
            notificationActive = false;
            
            // Mantieni il badge visibile se ci sono notifiche, ma rimuovi la classe di animazione
            if (notificationCount > 0) {
                notificationBadge.style.display = 'flex';
                notificationBadge.textContent = notificationCount;
                notificationBadge.classList.remove('new-notification');
            }
        });
        
        // Gestire il clic sul pulsante "Vedi tutte le notifiche"
        if (viewAllNotificationsBtn) {
            viewAllNotificationsBtn.addEventListener('click', function(e) {
                e.preventDefault();
                showAllNotifications();
            });
        }
    }
    
    /**
     * Configura i container per le notifiche
     * @private
     */
    function setupContainers() {
        // Crea contenitore per il popup di notifica
        notificationPopupContainer = document.createElement('div');
        notificationPopupContainer.id = 'notificationPopup';
        notificationPopupContainer.className = 'notification-popup';
        document.body.appendChild(notificationPopupContainer);
        
        // Crea contenitore per il modal di dettaglio
        notificationDetailModal = document.createElement('div');
        notificationDetailModal.id = 'notificationDetailModal';
        notificationDetailModal.className = 'notification-detail-modal';
        document.body.appendChild(notificationDetailModal);
        
        // Crea il modal per "Vedi tutte le notifiche"
        allNotificationsModal = document.createElement('div');
        allNotificationsModal.id = 'allNotificationsModal';
        allNotificationsModal.className = 'notification-detail-modal';
        document.body.appendChild(allNotificationsModal);
    }
    
    /**
     * Configura notifiche simulate per la dashboard
     * @private
     */
    function setupDashboardNotifications() {
        // Rimuoviamo questa condizione restrittiva per garantire che le notifiche funzionino ovunque
        // const isDashboard = document.querySelector('.section-header') !== null;
        
        // if (isDashboard) {
        console.log('Configurazione delle notifiche simulate per la dashboard');
        
        // Aggiungi una notifica ogni 20 secondi (continuamente)
        const interval = setInterval(() => {
            // Resetta l'indice per ciclare attraverso le notifiche
            if (notificationIndex >= notifications.length) {
                notificationIndex = 0;
            }
            
            addNewNotification();
        }, 20000);
        
        // Aggiungi la prima notifica dopo 5 secondi
        setTimeout(() => {
            addNewNotification();
        }, 5000);
        // }
    }
    
    /**
     * Aggiunge una nuova notifica
     * @public
     */
    function addNewNotification() {
        if (notificationIndex >= notifications.length) return;
        
        console.log(`Aggiunta notifica #${notificationIndex + 1}:`, notifications[notificationIndex]);
        
        // Incrementa il contatore
        notificationCount++;
        
        // Mostra e aggiorna il badge solo se ci sono notifiche
        if (notificationCount > 0) {
            notificationBadge.style.display = 'flex';
            notificationBadge.textContent = notificationCount;
            
            // Assicurati che il badge sia visibile anche se l'utente ha chiuso il dropdown
            notificationBadge.classList.add('new-notification');
        } else {
            notificationBadge.style.display = 'none';
        }
        
        // Attiva l'animazione continua
        notificationIconWrapper.classList.add('shake-animation');
        notificationActive = true;
        
        // Aggiunge nuova notifica al dropdown
        const notification = notifications[notificationIndex];
        
        const notificationElement = document.createElement('a');
        notificationElement.href = '#';
        notificationElement.className = 'dropdown-item animate__animated animate__fadeInDown';
        notificationElement.dataset.notificationId = notification.id;
        
        // Personalizza il testo della notifica in base al tipo
        let notificationText = notification.text;
        if (notification.type === 'order') {
            notificationText = `Nuovo ordine #${notification.data.orderId}`;
        }
        
        // Nuova struttura HTML con layout single-line
        notificationElement.innerHTML = `
            <div class="notification-icon-container ${notification.bgClass}">
                <i class="notification-icon-item fas fa-${notification.icon}" style="color: white !important;"></i>
            </div>
            <div class="notification-content">
                <div class="notification-left">
                    <p class="notification-text">${notificationText}</p>
                </div>
                <div class="notification-right">
                    <span class="notification-time">${notification.time}</span>
                    <span class="notification-type-badge ${notification.bgClass}">${getNotificationBadgeText(notification.type)}</span>
                </div>
            </div>
        `;
        
        // Aggiungi sempre all'inizio del contenitore
        notificationsDropdown.insertBefore(notificationElement, notificationsDropdown.firstChild);
        
        // Mostra il popup laterale
        showNotificationPopup(notification);
        
        // Aggiungi evento al clic sulla notifica nel dropdown
        notificationElement.addEventListener('click', function(e) {
            e.preventDefault();
            const notificationId = this.dataset.notificationId;
            
            // Trova la notifica corrispondente
            const notificationData = notifications.find(n => n.id === notificationId);
            
            if (notificationData) {
                showNotificationDetail(notificationData);
            }
        });
        
        // Incrementa l'indice per la prossima notifica
        notificationIndex++;
    }
    
    /**
     * Mostra il popup laterale di notifica
     * @private
     * @param {Object} notification - Oggetto notifica
     */
    function showNotificationPopup(notification) {
        // Ignora i popup di pagamento
        if (notification.type === 'payment') {
            return;
        }
        
        const popupHTML = `
            <div class="notification-popup-header">
                <div class="notification-popup-title">
                    <i class="fas fa-${notification.icon}"></i>
                    <span>Nuova notifica</span>
                </div>
                <button class="notification-popup-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="notification-popup-body">
                <div class="fw-bold mb-1">${notification.text}</div>
                <div class="text-muted small">Clicca per visualizzare i dettagli</div>
            </div>
        `;
        
        notificationPopupContainer.innerHTML = popupHTML;
        notificationPopupContainer.classList.add('show');
        
        // Aggiungi evento clic sul popup
        notificationPopupContainer.addEventListener('click', function(e) {
            // Non chiudere se si clicca sul pulsante di chiusura
            const closeBtn = notificationPopupContainer.querySelector('.notification-popup-close');
            if (e.target === closeBtn || closeBtn.contains(e.target)) {
                e.stopPropagation();
                notificationPopupContainer.classList.remove('show');
                return;
            }
            
            // Altrimenti mostra i dettagli
            showNotificationDetail(notification);
            notificationPopupContainer.classList.remove('show');
        });
        
        // Aggiungi evento clic sul pulsante di chiusura
        const closeBtn = notificationPopupContainer.querySelector('.notification-popup-close');
        closeBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            notificationPopupContainer.classList.remove('show');
        });
        
        // Nascondi il popup dopo 8 secondi
        setTimeout(() => {
            notificationPopupContainer.classList.remove('show');
        }, 8000);
    }
    
    /**
     * Mostra i dettagli della notifica
     * @private
     * @param {Object} notification - Oggetto notifica
     */
    function showNotificationDetail(notification) {
        // Ignora i dettagli di pagamento
        if (notification.type === 'payment') {
            return;
        }
        
        let contentHTML = '';
        
        // Contenuto specifico per il tipo di notifica
        switch(notification.type) {
            case 'order':
                contentHTML = createOrderNotificationDetail(notification);
                break;
            case 'driver':
                contentHTML = createDriverNotificationDetail(notification);
                break;
            case 'customer':
                contentHTML = createCustomerNotificationDetail(notification);
                break;
            case 'order_cancel':
                contentHTML = createOrderCancelNotificationDetail(notification);
                break;
            case 'review':
                contentHTML = createReviewNotificationDetail(notification);
                break;
        }
        
        const modalHTML = `
            <div class="notification-modal-content">
                <div class="notification-modal-header sticky-top">
                    <h5><i class="fas fa-${notification.icon}"></i> ${getNotificationTitle(notification.type)}</h5>
                    <button class="notification-modal-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="notification-modal-body">
                    ${contentHTML}
                </div>
                <div class="notification-modal-footer">
                    <button class="btn btn-secondary" id="closeNotificationDetail">Chiudi</button>
                </div>
            </div>
        `;
        
        notificationDetailModal.innerHTML = modalHTML;
        notificationDetailModal.classList.add('show');
        
        // Evento clic per chiudere il modal
        const closeBtn = notificationDetailModal.querySelector('.notification-modal-close');
        closeBtn.addEventListener('click', closeNotificationDetail);
        
        // Evento clic per il pulsante di chiusura
        const closeDetailBtn = document.getElementById('closeNotificationDetail');
        closeDetailBtn.addEventListener('click', closeNotificationDetail);
        
        // Chiudi cliccando all'esterno del contenuto del modal
        notificationDetailModal.addEventListener('click', function(e) {
            if (e.target === notificationDetailModal) {
                closeNotificationDetail();
            }
        });
        
        // Inizializza la mappa per gli ordini e driver se necessario
        initializeMapForNotification(notification);
    }
    
    /**
     * Inizializza la mappa per la notifica se necessario
     * @private
     * @param {Object} notification - Oggetto notifica
     */
    function initializeMapForNotification(notification) {
        if (notification.type === 'order' && typeof window.mapHandler !== 'undefined') {
            const { data } = notification;
            const mapId = `delivery-map-${data.orderId}`;
            
            // Usiamo setTimeout per assicurarci che il DOM sia stato aggiornato
            setTimeout(() => {
                const mapElement = document.getElementById(mapId);
                if (mapElement) {
                    // Inizializza la mappa con OpenStreetMap
                    window.mapHandler.initMap(mapId).then(map => {
                        // Mostra il percorso tra il ristorante e l'indirizzo di consegna
                        window.mapHandler.showRouteByAddresses(
                            mapId, 
                            data.restaurantAddress, 
                            data.deliveryAddress,
                            'Pizzeria Napoli',
                            data.customerName
                        );
                        
                        // Disabilita lo scroll zoom per evitare problemi
                        map.scrollWheelZoom.disable();
                        
                        // Aggiungi un controllo dello zoom discreto
                        L.control.zoom({
                            position: 'bottomright'
                        }).addTo(map);
                    }).catch(error => {
                        console.error('Errore nell\'inizializzazione della mappa:', error);
                    });
                }
            }, 200);
            
            // Aggiungi eventi ai pulsanti di azione
            setTimeout(() => {
                const acceptBtn = document.getElementById(`accept-order-${data.orderId}`);
                if (acceptBtn) {
                    acceptBtn.addEventListener('click', function() {
                        // Mostra un toast di conferma
                        window.showToast('Ordine accettato', 'L\'ordine è stato accettato e messo in preparazione', 'success');
                        
                        // Chiudi il modal
                        closeNotificationDetail();
                    });
                }
                
                const printBtn = document.getElementById(`print-order-${data.orderId}`);
                if (printBtn) {
                    printBtn.addEventListener('click', function() {
                        // Simula la stampa
                        window.showToast('Stampa in corso', 'L\'ordine è stato inviato alla stampante', 'info');
                    });
                }
            }, 200);
        }
        
        // Inizializza la mappa per il driver
        if (notification.type === 'driver' && typeof window.mapHandler !== 'undefined') {
            const { data } = notification;
            const mapId = `driver-map-${data.driverId}`;
            
            // Usiamo setTimeout per assicurarci che il DOM sia stato aggiornato
            setTimeout(() => {
                const mapElement = document.getElementById(mapId);
                if (mapElement) {
                    // Inizializza la mappa con OpenStreetMap
                    window.mapHandler.initMap(mapId).then(map => {
                        // Mostra il percorso tra il ristorante e l'indirizzo di consegna
                        window.mapHandler.showRouteByAddresses(
                            mapId, 
                            'Via Verdi 28, Milano', // Indirizzo ristorante fittizio
                            data.deliveryAddress,
                            'Pizzeria Napoli',
                            data.customerName
                        );
                        
                        // Aggiungi un marker per il driver
                        window.mapHandler.addDriverMarker(
                            mapId,
                            data.currentLocation,
                            data.driverName
                        );
                    }).catch(error => {
                        console.error('Errore nell\'inizializzazione della mappa:', error);
                    });
                }
            }, 200);
            
            // Aggiungi eventi ai pulsanti di azione
            setTimeout(() => {
                const callDriverBtn = document.getElementById(`call-driver-${data.driverId}`);
                if (callDriverBtn) {
                    callDriverBtn.addEventListener('click', function() {
                        // Simula chiamata al driver
                        window.location.href = `tel:${data.driverPhone}`;
                    });
                }
            }, 200);
        }
    }
    
    /**
     * Chiude il modal dei dettagli della notifica
     * @private
     */
    function closeNotificationDetail() {
        notificationDetailModal.classList.remove('show');
        
        // Pulisci eventuali mappe quando chiudi il modal
        if (window.mapHandler) {
            const mapElements = notificationDetailModal.querySelectorAll('[id^="delivery-map-"], [id^="driver-map-"]');
            mapElements.forEach(mapElement => {
                window.mapHandler.destroyMap(mapElement.id);
            });
        }
    }
    
    /**
     * Mostra tutte le notifiche
     * @private
     */
    function showAllNotifications() {
        let notificationsHTML = '';
        
        // Filtra le notifiche per escludere i pagamenti
        const filteredNotifications = notifications.filter(n => n.type !== 'payment');
        
        filteredNotifications.forEach(notification => {
            // Determina il colore del badge in base al tipo di notifica
            let badgeClass = '';
            let badgeText = '';
            
            switch(notification.type) {
                case 'order':
                    badgeClass = 'bg-primary';
                    badgeText = 'Ordine';
                    break;
                case 'driver':
                    badgeClass = 'bg-warning';
                    badgeText = 'Driver';
                    break;
                case 'customer':
                    badgeClass = 'bg-success';
                    badgeText = 'Cliente';
                    break;
                case 'order_cancel':
                    badgeClass = 'bg-danger';
                    badgeText = 'Cancellato';
                    break;
                case 'review':
                    badgeClass = 'bg-info';
                    badgeText = 'Recensione';
                    break;
            }
            
            notificationsHTML += `
                <div class="all-notification-item" data-notification-id="${notification.id}">
                    <div class="notification-icon-container ${notification.bgClass} me-3">
                        <i class="notification-icon-item fas fa-${notification.icon}"></i>
                    </div>
                    <div class="all-notification-content">
                        <div class="all-notification-title">${notification.text}</div>
                        <div class="all-notification-subtitle">
                            <i class="fas fa-clock"></i> ${notification.time}
                            <span class="notification-type-badge ${badgeClass} text-white">${badgeText}</span>
                            ${notification.id === 'n1' ? '<span class="notification-unread-indicator"></span>' : ''}
                        </div>
                    </div>
                </div>
            `;
        });
        
        const modalHTML = `
            <div class="notification-modal-content">
                <div class="notification-modal-header sticky-top">
                    <h5><i class="fas fa-bell"></i> Tutte le notifiche</h5>
                    <button class="notification-modal-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="notification-modal-body p-0">
                    <div class="all-notifications-container">
                        ${notificationsHTML}
                    </div>
                    ${filteredNotifications.length === 0 ? '<div class="text-center py-4 text-muted">Nessuna notifica disponibile</div>' : ''}
                </div>
                <div class="notification-modal-footer">
                    <button class="btn btn-secondary" id="closeAllNotificationsModal">Chiudi</button>
                </div>
            </div>
        `;
        
        allNotificationsModal.innerHTML = modalHTML;
        allNotificationsModal.classList.add('show');
        
        // Evento clic per chiudere il modal
        const closeBtn = allNotificationsModal.querySelector('.notification-modal-close');
        closeBtn.addEventListener('click', closeAllNotificationsModal);
        
        // Evento clic per il pulsante di chiusura
        const closeModalBtn = document.getElementById('closeAllNotificationsModal');
        closeModalBtn.addEventListener('click', closeAllNotificationsModal);
        
        // Chiudi cliccando all'esterno del contenuto del modal
        allNotificationsModal.addEventListener('click', function(e) {
            if (e.target === allNotificationsModal) {
                closeAllNotificationsModal();
            }
        });
        
        // Aggiungere eventi clic per ogni notifica nella lista
        const notificationItems = allNotificationsModal.querySelectorAll('.all-notification-item');
        notificationItems.forEach(item => {
            item.addEventListener('click', function() {
                const notificationId = this.dataset.notificationId;
                const notificationData = notifications.find(n => n.id === notificationId);
                
                if (notificationData) {
                    closeAllNotificationsModal();
                    showNotificationDetail(notificationData);
                }
            });
        });
    }
    
    /**
     * Chiude il modal di tutte le notifiche
     * @private
     */
    function closeAllNotificationsModal() {
        allNotificationsModal.classList.remove('show');
    }
    
    /**
     * Ottiene il testo del badge per tipo di notifica
     * @private
     * @param {string} type - Tipo di notifica
     * @returns {string} - Testo del badge
     */
    function getNotificationBadgeText(type) {
        switch(type) {
            case 'order': return 'Ordine';
            case 'driver': return 'Driver';
            case 'customer': return 'Cliente';
            case 'order_cancel': return 'Cancellato';
            case 'review': return 'Recensione';
            case 'payment': return 'Pagamento';
            default: return 'Notifica';
        }
    }
    
    /**
     * Ottiene il titolo della notifica
     * @private
     * @param {string} type - Tipo di notifica
     * @returns {string} - Titolo della notifica
     */
    function getNotificationTitle(type) {
        switch(type) {
            case 'order': return 'Nuovo ordine ricevuto';
            case 'driver': return 'Ritardo consegna';
            case 'customer': return 'Nuovo cliente';
            case 'order_cancel': return 'Ordine cancellato';
            case 'review': return 'Nuova recensione';
            default: return 'Notifica';
        }
    }
    
    /**
     * Crea dettagli per una notifica di ordine
     * @private
     * @param {Object} notification - Oggetto notifica
     * @returns {string} - HTML con i dettagli
     */
    function createOrderNotificationDetail(notification) {
        const { data } = notification;
        
        // Genera la tabella dei prodotti in formato compatto
        let itemsHTML = `
            <div class="notification-items-compact">
                <table>
                    <thead>
                        <tr>
                            <th>Prodotto</th>
                            <th class="item-qty">Qtà</th>
                            <th class="item-price">Prezzo</th>
                            <th class="item-total">Totale</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        let subtotal = 0;
        
        data.items.forEach(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            
            itemsHTML += `
                <tr>
                    <td class="item-name">${item.name}</td>
                    <td class="item-qty">${item.quantity}</td>
                    <td class="item-price">${item.price.toFixed(2)}€</td>
                    <td class="item-total"><strong>${itemTotal.toFixed(2)}€</strong></td>
                </tr>
            `;
        });
        
        itemsHTML += `
                    </tbody>
                </table>
            </div>
        `;
        
        return `
            <div class="notification-container">
                <div class="notification-compact-header">
                    <h5><i class="fas fa-shopping-bag"></i> Nuovo ordine #${data.orderId}</h5>
                    <div class="notification-time-badge">
                        <span class="notification-time-highlight">${notification.time}</span>
                    </div>
                </div>
                
                <div class="p-3">
                    <!-- Dettagli Cliente -->
                    <div class="notification-section mb-3">
                        <h6 class="notification-section-title">Dettagli cliente</h6>
                        <div class="notification-details-grid">
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Cliente</p>
                                    <p class="notification-detail-value">${data.customerName}</p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Telefono</p>
                                    <p class="notification-detail-value">
                                        <a href="tel:${data.customerPhone}" class="notification-interactive-link">
                                            ${data.customerPhone}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Indirizzo consegna</p>
                                    <p class="notification-detail-value">${data.deliveryAddress}</p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Pagamento</p>
                                    <p class="notification-detail-value">${data.paymentMethod}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dettagli Ordine: Ristorante, Prodotti e Importo -->
                    <div class="notification-section mb-3">
                        <h6 class="notification-section-title">Dettagli ordine</h6>
                        <div class="notification-details-grid mb-2">
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Ristorante</p>
                                    <p class="notification-detail-value">Pizzeria Napoli</p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-map-pin"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Indirizzo</p>
                                    <p class="notification-detail-value">${data.restaurantAddress}</p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Tempo stimato</p>
                                    <p class="notification-detail-value">${data.estimatedDeliveryTime} min</p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Totale</p>
                                    <p class="notification-detail-value">${data.totalAmount.toFixed(2)}€</p>
                                </div>
                            </div>
                        </div>
                        
                        ${itemsHTML}
                        
                        <div class="notification-order-total">
                            <div class="notification-summary-row">
                                <div>Subtotale</div>
                                <div>${subtotal.toFixed(2)}€</div>
                            </div>
                            <div class="notification-summary-row">
                                <div>Consegna</div>
                                <div>2.50€</div>
                            </div>
                            <div class="notification-summary-row total">
                                <div>Totale</div>
                                <div>${data.totalAmount.toFixed(2)}€</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mappa del percorso di consegna -->
                    <div class="notification-map-container mb-3" id="delivery-map-${data.orderId}"></div>
                    
                    <!-- Azioni -->
                    <div class="notification-action-buttons">
                        <button class="notification-action-btn flex-grow-1" id="accept-order-${data.orderId}">
                            <i class="fas fa-check me-2"></i> Accetta ordine
                        </button>
                        <button class="notification-action-btn notification-action-btn-outline flex-grow-1" id="print-order-${data.orderId}">
                            <i class="fas fa-print me-2"></i> Stampa
                        </button>
                    </div>
                </div>
            </div>
        `;
    }
    
    /**
     * Crea dettagli per una notifica di driver
     * @private
     * @param {Object} notification - Oggetto notifica
     * @returns {string} - HTML con i dettagli
     */
    function createDriverNotificationDetail(notification) {
        const { data } = notification;
        
        // Questa è la posizione corrente del driver (inventata ma pertinente)
        const currentLocation = {
            address: data.currentLocation,
            description: 'Il driver è attualmente fermo all\'incrocio tra Via Garibaldi e Via Mazzini. Stima 10 minuti per arrivare a destinazione.',
            coordinates: { lat: 45.4642, lng: 9.1900 } // Coordinate pertinenti per Milano
        };
        
        return `
            <div class="notification-container">
                <div class="notification-compact-header">
                    <h5><i class="fas fa-motorcycle"></i> Ritardo driver</h5>
                    <div class="notification-time-badge">
                        <span class="notification-time-highlight">${notification.time}</span>
                    </div>
                </div>
                
                <div class="p-3">
                    <!-- Sezione Driver -->
                    <div class="notification-section mb-3">
                        <h6 class="notification-section-title">Informazioni driver</h6>
                        <div class="notification-details-grid">
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-id-badge"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Nome</p>
                                    <p class="notification-detail-value">${data.driverName}</p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">ID Driver</p>
                                    <p class="notification-detail-value">${data.driverId}</p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Telefono</p>
                                    <p class="notification-detail-value">
                                        <a href="tel:${data.driverPhone}" class="notification-interactive-link">
                                            ${data.driverPhone}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Ritardo</p>
                                    <p class="notification-detail-value">
                                        <span class="status-delayed">${data.delayMinutes} min</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Posizione attuale del driver -->
                    <div class="notification-section mb-3">
                        <h6 class="notification-section-title">Posizione attuale del driver</h6>
                        <div class="driver-current-location mb-2">
                            <i class="fas fa-map-pin"></i> ${currentLocation.address}
                        </div>
                        <div class="driver-location-details mb-2">
                            ${currentLocation.description}
                        </div>
                    </div>
                    
                    <!-- Sezione Ordine -->
                    <div class="notification-section mb-3">
                        <h6 class="notification-section-title">Dettagli consegna</h6>
                        <div class="notification-details-grid mb-2">
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Ordine #</p>
                                    <p class="notification-detail-value">${data.orderId}</p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Cliente</p>
                                    <p class="notification-detail-value">${data.customerName}</p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Arrivo stimato</p>
                                    <p class="notification-detail-value">${data.estimatedArrival}</p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Destinazione</p>
                                    <p class="notification-detail-value">${data.deliveryAddress}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mappa del percorso di consegna con posizione driver -->
                    <div class="notification-map-container mb-3" id="driver-map-${data.driverId}"></div>
                    
                    <!-- Azioni -->
                    <div class="notification-action-buttons">
                        <button class="notification-action-btn flex-grow-1" id="call-driver-${data.driverId}">
                            <i class="fas fa-phone me-2"></i> Chiama il driver
                        </button>
                        <button class="notification-action-btn notification-action-btn-outline flex-grow-1" id="call-restaurant-${data.orderId}">
                            <i class="fas fa-store me-2"></i> Chiama ristorante
                        </button>
                    </div>
                </div>
            </div>
        `;
    }
    
    /**
     * Crea dettagli per una notifica di nuovo cliente
     * @private
     * @param {Object} notification - Oggetto notifica
     * @returns {string} - HTML con i dettagli
     */
    function createCustomerNotificationDetail(notification) {
        const { data } = notification;
        
        return `
            <div class="notification-container">
                <div class="notification-compact-header">
                    <h5><i class="fas fa-user-plus"></i> Nuovo cliente</h5>
                    <div class="notification-time-badge">
                        <span class="notification-time-highlight">${notification.time}</span>
                    </div>
                </div>
                
                <div class="p-3">
                    <!-- Informazioni cliente -->
                    <div class="notification-section mb-3">
                        <h6 class="notification-section-title">Dettagli cliente</h6>
                        <div class="notification-details-grid">
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Nome</p>
                                    <p class="notification-detail-value">${data.customerName}</p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">ID Cliente</p>
                                    <p class="notification-detail-value">${data.customerId}</p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Email</p>
                                    <p class="notification-detail-value">
                                        <a href="mailto:${data.customerEmail}" class="notification-interactive-link">
                                            ${data.customerEmail}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Telefono</p>
                                    <p class="notification-detail-value">
                                        <a href="tel:${data.customerPhone}" class="notification-interactive-link">
                                            ${data.customerPhone}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informazioni aggiuntive -->
                    <div class="notification-section mb-3">
                        <h6 class="notification-section-title">Informazioni aggiuntive</h6>
                        <div class="notification-details-grid mb-2">
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Indirizzo</p>
                                    <p class="notification-detail-value">${data.customerAddress}</p>
                                </div>
                            </div>
                            
                            <div class="notification-detail-item">
                                <div class="notification-detail-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="notification-detail-content">
                                    <p class="notification-detail-label">Registrato il</p>
                                    <p class="notification-detail-value">${data.registrationDate}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Azioni -->
                    <div class="notification-action-buttons">
                        <button class="notification-action-btn flex-grow-1" id="profile-customer-${data.customerId}">
                            <i class="fas fa-user-edit me-2"></i> Profilo cliente
                        </button>
                        <button class="notification-action-btn notification-action-btn-outline flex-grow-1" id="promotion-customer-${data.customerId}">
                            <i class="fas fa-gift me-2"></i> Promozione
                        </button>
                    </div>
                </div>
            </div>
        `;
    }
    
    // API pubblica
    return {
        init,
        addNewNotification
    };
})();

// Inizializza il servizio quando il DOM è caricato
document.addEventListener('DOMContentLoaded', function() {
    NotificationService.init();
});