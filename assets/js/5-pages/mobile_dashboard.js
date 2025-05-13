
/**
 * Mobile Dashboard Page Module
 * Gestisce tutte le funzionalità specifiche della dashboard mobile
 * @module MobileDashboardPage
 */

document.addEventListener('DOMContentLoaded', function() {
    initMobileSidebar();
    loadMobileOrders();
    loadTopProducts();
    setupNotifications();
});

/**
 * Inizializza il menu laterale mobile
 */
function initMobileSidebar() {
    const menuTrigger = document.querySelector('.mobile-menu-trigger');
    const sidebar = document.querySelector('.mobile-sidebar');
    const closeBtn = document.querySelector('.mobile-sidebar-close');
    const overlay = document.querySelector('.mobile-overlay');
    const submenuToggles = document.querySelectorAll('.mobile-submenu-toggle');
    
    // Apertura menu
    if (menuTrigger) {
        menuTrigger.addEventListener('click', function() {
            sidebar.classList.add('open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }
    
    // Chiusura menu
    if (closeBtn) {
        closeBtn.addEventListener('click', closeMenu);
    }
    
    if (overlay) {
        overlay.addEventListener('click', closeMenu);
    }
    
    // Toggle sottomenu
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const menuItem = this.closest('.mobile-menu-item');
            
            // Chiudi tutti gli altri sottomenu
            document.querySelectorAll('.mobile-menu-item.open').forEach(item => {
                if (item !== menuItem) {
                    item.classList.remove('open');
                }
            });
            
            // Toggle il sottomenu corrente
            menuItem.classList.toggle('open');
        });
    });
    
    function closeMenu() {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }
}

/**
 * Carica gli ordini recenti nella dashboard mobile
 */
function loadMobileOrders() {
    const ordersList = document.querySelector('.mobile-orders-list');
    
    if (!ordersList) return;
    
    // Simula il caricamento degli ordini (in produzione, sostituire con una chiamata API)
    setTimeout(() => {
        const recentOrders = [
            {
                id: 'ORD-1587',
                restaurant: 'Pizzeria Napoletana',
                customer: 'Mario Rossi',
                total: 28.50,
                status: 'in-consegna',
                time: '15 minuti fa'
            },
            {
                id: 'ORD-1586',
                restaurant: 'Sushi Bar',
                customer: 'Giulia Bianchi',
                total: 45.00,
                status: 'in-preparazione',
                time: '28 minuti fa'
            },
            {
                id: 'ORD-1585',
                restaurant: 'Burger King',
                customer: 'Luca Verdi',
                total: 18.75,
                status: 'consegnato',
                time: '45 minuti fa'
            }
        ];
        
        // Rimuovi il loader
        ordersList.innerHTML = '';
        
        // Aggiungi gli ordini
        recentOrders.forEach(order => {
            const orderItem = document.createElement('div');
            orderItem.className = 'mobile-order-item';
            orderItem.innerHTML = `
                <div class="mobile-order-header">
                    <div class="mobile-order-id">${order.id}</div>
                    <div class="mobile-order-time">${order.time}</div>
                </div>
                <div class="mobile-order-restaurant">${order.restaurant}</div>
                <div class="mobile-order-details">
                    <div class="mobile-order-customer">
                        <i class="fas fa-user"></i> ${order.customer}
                    </div>
                    <div class="mobile-order-total">€${order.total.toFixed(2)}</div>
                </div>
                <div class="mobile-order-status">
                    <span class="status-badge status-${order.status}">${order.status.replace('-', ' ')}</span>
                </div>
            `;
            ordersList.appendChild(orderItem);
        });
        
        // Aggiungi stili CSS inline per gli ordini
        const style = document.createElement('style');
        style.textContent = `
            .mobile-order-item {
                padding: 1rem;
                background-color: var(--color-grey-100);
                border-radius: 8px;
                margin-bottom: 0.75rem;
            }
            
            .mobile-order-header {
                display: flex;
                justify-content: space-between;
                margin-bottom: 0.25rem;
            }
            
            .mobile-order-id {
                font-weight: 600;
                color: var(--color-primary);
            }
            
            .mobile-order-time {
                font-size: 0.8rem;
                color: var(--color-grey-500);
            }
            
            .mobile-order-restaurant {
                font-weight: 600;
                margin-bottom: 0.5rem;
            }
            
            .mobile-order-details {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 0.5rem;
            }
            
            .mobile-order-customer {
                font-size: 0.9rem;
                color: var(--color-grey-700);
            }
            
            .mobile-order-total {
                font-weight: 600;
            }
            
            .mobile-order-status {
                text-align: right;
            }
        `;
        document.head.appendChild(style);
    }, 1000);
}

/**
 * Carica i prodotti più venduti nella dashboard mobile
 */
function loadTopProducts() {
    const productsList = document.querySelector('.mobile-top-products');
    
    if (!productsList) return;
    
    // Simula il caricamento dei prodotti (in produzione, sostituire con una chiamata API)
    setTimeout(() => {
        const topProducts = [
            {
                name: 'Pizza Margherita',
                category: 'Pizza',
                sold: 124,
                percentage: 85,
                rank: 1
            },
            {
                name: 'Sushi Mix',
                category: 'Sushi',
                sold: 98,
                percentage: 70,
                rank: 2
            },
            {
                name: 'Hamburger Classic',
                category: 'Burger',
                sold: 87,
                percentage: 65,
                rank: 3
            },
            {
                name: 'Insalata Caesar',
                category: 'Insalate',
                sold: 65,
                percentage: 45,
                rank: 4
            }
        ];
        
        // Rimuovi il loader
        productsList.innerHTML = '';
        
        // Aggiungi i prodotti
        topProducts.forEach(product => {
            const rankClass = getRankClass(product.rank);
            const productItem = document.createElement('div');
            productItem.className = 'top-product-item';
            productItem.innerHTML = `
                <div class="top-product-rank ${rankClass}">${product.rank}</div>
                <div class="top-product-info">
                    <div class="top-product-header">
                        <div class="top-product-name">${product.name}</div>
                        <div class="top-product-badge" style="background-color: rgba(var(--primary-color-rgb), 0.1); color: var(--color-primary);">${product.category}</div>
                    </div>
                    <div class="top-product-progress">
                        <div class="progress">
                            <div class="progress-bar ${rankClass}" role="progressbar" style="width: ${product.percentage}%"></div>
                        </div>
                    </div>
                    <div class="top-product-sold mt-1">
                        <small>${product.sold} venduti questo mese</small>
                    </div>
                </div>
            `;
            productsList.appendChild(productItem);
        });
    }, 1200);
}

/**
 * Determina la classe CSS per il ranking
 * @param {number} rank - Posizione nella classifica
 * @returns {string} - Classe CSS
 */
function getRankClass(rank) {
    if (rank === 1) return 'rank-1';
    if (rank === 2) return 'rank-2';
    if (rank === 3) return 'rank-3';
    return '';
}

/**
 * Configura le notifiche nella dashboard mobile
 */
function setupNotifications() {
    // Simula l'arrivo di notifiche
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
                    { status: 'delivered', time: '15:05', title: 'Consegnato', completed: false }
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
    
    // Aggiorna il numero di notifiche
    const notificationBadge = document.querySelector('.notification-badge');
    if (notificationBadge) {
        notificationBadge.textContent = notifications.length;
    }
    
    // Registra le notifiche nella console per debug
    notifications.forEach((notification, index) => {
        console.log(`Aggiunta notifica #${index + 1}:`, notification);
    });
}
