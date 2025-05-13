
/**
 * Mobile Dashboard Page Module
 * Gestisce tutte le funzionalità specifiche della dashboard mobile
 * @module MobileDashboardPage
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('Inizializzazione dashboard mobile...');
    
    // Ottiene gli elementi del DOM
    const mobileOrdersList = document.querySelector('.mobile-orders-list');
    const mobileTopProducts = document.querySelector('.mobile-top-products');
    
    // Dati statici per gli ordini recenti
    const recentOrders = [
        { id: 'ORD-1586', customer: 'Marco Rossi', status: 'nuovo', amount: 42.50, date: '13 mag, 14:30' },
        { id: 'ORD-1585', customer: 'Giulia Bianchi', status: 'in preparazione', amount: 28.75, date: '13 mag, 14:15' },
        { id: 'ORD-1584', customer: 'Anna Verdi', status: 'in consegna', amount: 35.90, date: '13 mag, 14:00' },
        { id: 'ORD-1583', customer: 'Paolo Neri', status: 'consegnato', amount: 51.20, date: '13 mag, 13:30' }
    ];
    
    // Dati statici per i prodotti più venduti
    const topProducts = [
        { rank: 1, name: 'Pizza Margherita', category: 'Pizze', sold: 158, percentage: 90 },
        { rank: 2, name: 'Cotoletta alla Milanese', category: 'Secondi', sold: 89, percentage: 75 },
        { rank: 3, name: 'Tiramisù', category: 'Dessert', sold: 67, percentage: 60 },
        { rank: 4, name: 'Pasta alla Carbonara', category: 'Primi', sold: 54, percentage: 45 }
    ];
    
    // Renderizza gli ordini recenti
    renderMobileOrders(recentOrders);
    
    // Renderizza i prodotti più venduti
    renderMobileTopProducts(topProducts);
    
    // Simulazione di notifiche push per mobile
    setTimeout(() => {
        showMobileNotification({
            title: 'Nuovo ordine!',
            content: 'Il driver Paolo è in ritardo',
            action: 'Clicca per visualizzare i dettagli'
        });
    }, 3000);
});

/**
 * Renderizza gli ordini recenti nella vista mobile
 * @param {Array} orders - Lista di ordini da visualizzare
 */
function renderMobileOrders(orders) {
    const ordersList = document.querySelector('.mobile-orders-list');
    
    if (!ordersList) return;
    
    ordersList.innerHTML = '';
    
    orders.forEach(order => {
        const statusClass = getStatusClass(order.status);
        const orderItem = document.createElement('div');
        orderItem.className = 'mobile-order-item';
        orderItem.innerHTML = `
            <div class="mobile-order-header">
                <div class="mobile-order-id">${order.id}</div>
                <div class="mobile-order-amount">${order.amount.toFixed(2)}€</div>
            </div>
            <div class="mobile-order-details">
                <div>${order.customer}</div>
                <div class="status-badge ${statusClass}">${order.status}</div>
            </div>
            <div class="mobile-order-details">
                <div>${order.date}</div>
                <a href="#" class="view-details">Dettagli <i class="fas fa-chevron-right"></i></a>
            </div>
        `;
        ordersList.appendChild(orderItem);
    });
}

/**
 * Renderizza i prodotti più venduti nella vista mobile
 * @param {Array} products - Lista di prodotti da visualizzare
 */
function renderMobileTopProducts(products) {
    const productsList = document.querySelector('.mobile-top-products');
    
    if (!productsList) return;
    
    productsList.innerHTML = '';
    
    products.forEach(product => {
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
}

/**
 * Mostra una notifica push nella vista mobile
 * @param {Object} notification - Dati della notifica
 */
function showMobileNotification(notification) {
    // Rimuovi eventuali notifiche precedenti
    const existingNotifications = document.querySelectorAll('.mobile-notification');
    existingNotifications.forEach(el => el.remove());
    
    // Crea l'elemento notifica
    const notificationEl = document.createElement('div');
    notificationEl.className = 'mobile-notification';
    notificationEl.innerHTML = `
        <div class="mobile-notification-header">
            <strong>${notification.title}</strong>
            <button type="button" class="close-notification" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mobile-notification-content">${notification.content}</div>
        <div class="mobile-notification-action">${notification.action}</div>
    `;
    
    document.body.appendChild(notificationEl);
    
    // Aggiungi la gestione del click per chiudere
    notificationEl.querySelector('.close-notification').addEventListener('click', () => {
        notificationEl.remove();
    });
    
    // Rimuovi automaticamente dopo 5 secondi
    setTimeout(() => {
        if (notificationEl.parentNode) {
            notificationEl.remove();
        }
    }, 5000);
}

/**
 * Ottiene la classe per lo stato dell'ordine
 * @param {string} status - Stato dell'ordine
 * @return {string} Classe CSS corrispondente
 */
function getStatusClass(status) {
    switch (status) {
        case 'nuovo': return 'badge-primary';
        case 'in preparazione': return 'badge-warning';
        case 'in consegna': return 'badge-info';
        case 'consegnato': return 'badge-success';
        case 'annullato': return 'badge-danger';
        default: return 'badge-primary';
    }
}

/**
 * Ottiene la classe per il ranking del prodotto
 * @param {number} rank - Posizione in classifica
 * @return {string} Classe CSS corrispondente
 */
function getRankClass(rank) {
    switch (rank) {
        case 1: return 'rank-primary progress-primary';
        case 2: return 'rank-secondary progress-secondary';
        case 3: return 'rank-accent1 progress-accent1';
        case 4: return 'rank-accent2 progress-accent2';
        default: return 'rank-accent3 progress-accent3';
    }
}
