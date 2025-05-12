/**
 * Dashboard Page Module
 * Gestisce tutte le funzionalità specifiche della dashboard
 * @module DashboardPage
 */

const DashboardPage = (function() {
    // Elementi DOM specifici della dashboard
    let ordersChart;
    let categoriesChart;
    
    // Dati statici per i diversi periodi
    const statisticsData = {
        today: {
            orders: 28,
            revenue: 750,
            activeOrders: 12,
            customers: 358,
            change: {
                orders: 8.3,
                revenue: 12.7,
                activeOrders: -3.5,
                customers: 5.2
            }
        },
        week: {
            orders: 187,
            revenue: 4850,
            activeOrders: 15,
            customers: 392,
            change: {
                orders: 12.5,
                revenue: 9.8,
                activeOrders: 2.7,
                customers: 7.4
            }
        },
        month: {
            orders: 684,
            revenue: 18750,
            activeOrders: 22,
            customers: 425,
            change: {
                orders: 15.2,
                revenue: 18.5,
                activeOrders: 5.0,
                customers: 9.3
            }
        }
    };
    
    // Dati statici per il grafico
    const chartData = {
        '7days': {
            labels: ['10/07', '11/07', '12/07', '13/07', '14/07', '15/07', '16/07'],
            data: [12, 19, 15, 17, 14, 22, 18]
        },
        '30days': {
            labels: [
                '17/06', '18/06', '19/06', '20/06', '21/06', '22/06', '23/06',
                '24/06', '25/06', '26/06', '27/06', '28/06', '29/06', '30/06',
                '01/07', '02/07', '03/07', '04/07', '05/07', '06/07', '07/07',
                '08/07', '09/07', '10/07', '11/07', '12/07', '13/07', '14/07',
                '15/07', '16/07'
            ],
            data: [
                14, 16, 15, 18, 20, 22, 19,
                17, 18, 20, 21, 19, 23, 24,
                18, 16, 17, 20, 22, 24, 25,
                21, 18, 20, 19, 22, 25, 28,
                24, 22
            ]
        },
        'quarter': {
            labels: [
                'Apr', 'Mag', 'Giu', 'Lug'
            ],
            data: [
                485, 520, 610, 684
            ]
        }
    };
    
    // Dati statici per gli ordini recenti
    const recentOrdersData = {
        today: [
            { id: 'ORD-1587', number: 'ORD-1587', customer: 'Mario Rossi', status: 'nuovo', amount: 28.50, date: '16/07/2023 14:32' },
            { id: 'ORD-1586', number: 'ORD-1586', customer: 'Laura Bianchi', status: 'in preparazione', amount: 42.75, date: '16/07/2023 13:15' },
            { id: 'ORD-1585', number: 'ORD-1585', customer: 'Andrea Verdi', status: 'in consegna', amount: 19.90, date: '16/07/2023 12:50' },
            { id: 'ORD-1584', number: 'ORD-1584', customer: 'Sofia Esposito', status: 'consegnato', amount: 33.20, date: '16/07/2023 11:45' },
            { id: 'ORD-1583', number: 'ORD-1583', customer: 'Luca Russo', status: 'consegnato', amount: 25.80, date: '16/07/2023 10:30' }
        ],
        week: [
            { id: 'ORD-1587', number: 'ORD-1587', customer: 'Mario Rossi', status: 'nuovo', amount: 28.50, date: '16/07/2023 14:32' },
            { id: 'ORD-1580', number: 'ORD-1580', customer: 'Francesca Romano', status: 'in preparazione', amount: 37.90, date: '15/07/2023 19:22' },
            { id: 'ORD-1575', number: 'ORD-1575', customer: 'Giuseppe Marino', status: 'consegnato', amount: 45.30, date: '14/07/2023 20:15' },
            { id: 'ORD-1568', number: 'ORD-1568', customer: 'Anna Ricci', status: 'consegnato', amount: 22.50, date: '13/07/2023 13:40' },
            { id: 'ORD-1559', number: 'ORD-1559', customer: 'Marco Ferrari', status: 'consegnato', amount: 31.75, date: '12/07/2023 21:05' }
        ],
        month: [
            { id: 'ORD-1587', number: 'ORD-1587', customer: 'Mario Rossi', status: 'nuovo', amount: 28.50, date: '16/07/2023 14:32' },
            { id: 'ORD-1550', number: 'ORD-1550', customer: 'Elena Costa', status: 'in preparazione', amount: 39.90, date: '10/07/2023 18:45' },
            { id: 'ORD-1510', number: 'ORD-1510', customer: 'Paolo Colombo', status: 'consegnato', amount: 55.25, date: '05/07/2023 19:20' },
            { id: 'ORD-1475', number: 'ORD-1475', customer: 'Roberta Gallo', status: 'consegnato', amount: 29.90, date: '28/06/2023 12:50' },
            { id: 'ORD-1430', number: 'ORD-1430', customer: 'Davide Fontana', status: 'consegnato', amount: 43.60, date: '20/06/2023 20:30' }
        ]
    };
    
    // Dati statici per i prodotti più venduti
    const topProductsData = {
        today: [
            { name: 'Pizza Margherita', sold: 24 },
            { name: 'Hamburger Classico', sold: 18 },
            { name: 'Sushi Mix (12pz)', sold: 12 },
            { name: 'Patatine Fritte', sold: 35 },
            { name: 'Coca Cola 33cl', sold: 42 }
        ],
        week: [
            { name: 'Pizza Margherita', sold: 145 },
            { name: 'Coca Cola 33cl', sold: 187 },
            { name: 'Hamburger Classico', sold: 122 },
            { name: 'Patatine Fritte', sold: 163 },
            { name: 'Insalata Caesar', sold: 98 }
        ],
        month: [
            { name: 'Coca Cola 33cl', sold: 756 },
            { name: 'Pizza Margherita', sold: 685 },
            { name: 'Patatine Fritte', sold: 524 },
            { name: 'Hamburger Classico', sold: 498 },
            { name: 'Pasta Carbonara', sold: 387 }
        ]
    };
    
    // Colori personalizzati per i grafici
    const chartColors = {
        primary: '#ff5a5f',
        secondary: '#00d1b2',
        accent1: '#ffbc1f',
        accent2: '#8a4fff',
        accent3: '#00c4b4',
        accent4: '#fd7e14',
        accent5: '#20c997',
        grey100: '#f7f9fc',
        grey500: '#8f9bb3',
        white: '#ffffff',
        transparent: 'rgba(255, 255, 255, 0.2)'
    };
    
    /**
     * Inizializza il modulo
     */
    function init() {
        console.log('Inizializzazione dashboard...');
        
        if (document.querySelector('.stats-grid')) {
            // Configura il tema chart.js se disponibile
            setupChartjsDefaults();
            
            // Inizializza tutti i componenti
            initCharts();
            setupEventListeners();
            
            // Carica i dati iniziali
            updateRecentOrders('today');
            updateTopProducts('today');
            
            // Animazione iniziale
            initDashboardAnimations();
        }
    }
    
    /**
     * Configura le impostazioni predefinite di Chart.js
     */
    function setupChartjsDefaults() {
        if (typeof Chart !== 'undefined') {
            Chart.defaults.font.family = "'Nunito', sans-serif";
            Chart.defaults.font.size = 12;
            Chart.defaults.color = chartColors.grey500;
            Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(0, 0, 0, 0.7)';
            Chart.defaults.plugins.tooltip.padding = 10;
            Chart.defaults.plugins.tooltip.cornerRadius = 8;
            Chart.defaults.plugins.tooltip.titleFont.weight = 'bold';
        }
    }
    
    /**
     * Inizializza le animazioni specifiche della dashboard
     */
    function initDashboardAnimations() {
        // Animazioni per le card statistiche
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('animate__animated', 'animate__fadeInUp');
        });
    }
    
    /**
     * Inizializza i grafici della dashboard
     */
    function initCharts() {
        // Inizializza il grafico andamento ordini
        initOrdersChart('7days');
        
        // Inizializza il grafico categorie
        initCategoriesChart();
    }
    
    /**
     * Inizializza il grafico degli ordini
     */
    function initOrdersChart(period = '7days') {
        const ordersCtx = document.getElementById('ordersChart');
        if (!ordersCtx) return;
        
        const ctx = ordersCtx.getContext('2d');
        
        // Distruggi il grafico esistente se presente
        if (ordersChart) {
            ordersChart.destroy();
        }
        
        ordersChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData[period].labels,
                datasets: [{
                    label: 'Numero ordini',
                    data: chartData[period].data,
                    borderColor: chartColors.primary,
                    backgroundColor: 'rgba(255, 90, 95, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: chartColors.white,
                    pointBorderColor: chartColors.primary,
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                }
            }
        });
    }
    
    /**
     * Inizializza il grafico delle categorie
     */
    function initCategoriesChart() {
        const categoriesCtx = document.getElementById('categoriesChart');
        if (!categoriesCtx) return;
        
        const ctx = categoriesCtx.getContext('2d');
        
        const categoryNames = ['Pizza', 'Hamburger', 'Sushi', 'Pasta', 'Bevande', 'Dessert'];
        const categorySales = [4250, 3180, 2940, 2130, 1650, 980];
        
        if (categoriesChart) {
            categoriesChart.destroy();
        }
        
        categoriesChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: categoryNames,
                datasets: [{
                    data: categorySales,
                    backgroundColor: [
                        chartColors.primary,
                        chartColors.secondary,
                        chartColors.accent1,
                        chartColors.accent2,
                        chartColors.accent3,
                        chartColors.accent4
                    ],
                    borderWidth: 0,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.raw;
                                return context.label + ': ' + value.toFixed(2) + '€';
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    }
    
    /**
     * Configura i listener degli eventi
     */
    function setupEventListeners() {
        // Gestione click sui pulsanti periodo principale
        const periodButtons = document.querySelectorAll('.period-btn');
        periodButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Determina se questo è un pulsante principale o del grafico
                const isChartButton = this.closest('.card-header') !== null;
                
                // Se è un pulsante principale di periodo (in alto nella dashboard)
                if (!isChartButton) {
                    // Rimuovi classe attiva solo dai pulsanti principali
                    document.querySelectorAll('.period-filter > .period-btn').forEach(btn => 
                        btn.classList.remove('active')
                    );
                    
                    // Aggiungi classe attiva a questo pulsante
                    this.classList.add('active');
                    
                    // Aggiorna le statistiche in base al periodo
                    const period = this.dataset.period;
                    updateDashboardStats(period);
                    updateRecentOrders(period);
                    updateTopProducts(period);
                    
                    // Effetto di animazione per mostrare il cambiamento
                    const statCards = document.querySelectorAll('.stat-card');
                    statCards.forEach(card => {
                        card.classList.add('animate__animated', 'animate__pulse');
                        setTimeout(() => {
                            card.classList.remove('animate__animated', 'animate__pulse');
                        }, 1000);
                    });
                }
                // Se è un pulsante del grafico (Ultimi 7 giorni, Ultimi 30 giorni, Trimestre)
                else {
                    // Rimuovi classe attiva solo dai pulsanti del grafico
                    document.querySelectorAll('.card-header .period-btn').forEach(btn => 
                        btn.classList.remove('active')
                    );
                    
                    // Aggiungi classe attiva a questo pulsante
                    this.classList.add('active');
                    
                    // Aggiorna il grafico
                    const period = this.dataset.period;
                    initOrdersChart(period);
                }
            });
        });
    }
    
    /**
     * Aggiorna le statistiche della dashboard
     */
    function updateDashboardStats(period) {
        const data = statisticsData[period];
        
        // Aggiornamento valori
        document.querySelector('.stat-card:nth-child(1) .stat-value').textContent = data.orders;
        document.querySelector('.stat-card:nth-child(2) .stat-value').textContent = data.revenue.toLocaleString('it-IT') + '€';
        document.querySelector('.stat-card:nth-child(3) .stat-value').textContent = data.activeOrders;
        document.querySelector('.stat-card:nth-child(4) .stat-value').textContent = data.customers;
        
        // Aggiornamento percentuali di cambiamento
        const changeElements = document.querySelectorAll('.stat-change');
        
        // Ordini totali
        updateChangeElement(changeElements[0], data.change.orders);
        
        // Ricavi totali
        updateChangeElement(changeElements[1], data.change.revenue);
        
        // Ordini attivi
        updateChangeElement(changeElements[2], data.change.activeOrders);
        
        // Clienti totali
        updateChangeElement(changeElements[3], data.change.customers);
    }
    
    /**
     * Funzione di supporto per aggiornare gli elementi con le percentuali di cambiamento
     */
    function updateChangeElement(element, value) {
        const isPositive = value >= 0;
        
        element.innerHTML = isPositive ? 
            `<i class="fas fa-arrow-up"></i> ${value}% rispetto al periodo precedente` : 
            `<i class="fas fa-arrow-down"></i> ${Math.abs(value)}% rispetto al periodo precedente`;
        
        element.classList.remove('positive', 'negative');
        element.classList.add(isPositive ? 'positive' : 'negative');
    }
    
    /**
     * Aggiorna gli ordini recenti nella tabella
     */
    function updateRecentOrders(period) {
        const orders = recentOrdersData[period];
        const tableBody = document.querySelector('.table-hover tbody');
        if (!tableBody) return;
        
        // Svuota la tabella
        tableBody.innerHTML = '';
        
        // Popola la tabella con i nuovi dati
        orders.forEach(order => {
            let statusClass;
            
            switch (order.status) {
                case 'nuovo':
                    statusClass = 'primary';
                    break;
                case 'in preparazione':
                    statusClass = 'info';
                    break;
                case 'in consegna':
                    statusClass = 'warning';
                    break;
                case 'consegnato':
                    statusClass = 'success';
                    break;
                case 'annullato':
                    statusClass = 'danger';
                    break;
                default:
                    statusClass = 'secondary';
            }
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><strong>#${order.number}</strong></td>
                <td>${order.customer}</td>
                <td><span class="status-badge badge-${statusClass}">${order.status.charAt(0).toUpperCase() + order.status.slice(1)}</span></td>
                <td><strong>${order.amount.toLocaleString('it-IT', {minimumFractionDigits: 2, maximumFractionDigits: 2})}€</strong></td>
                <td>${order.date}</td>
                <td>
                    <a href="/lenny1/orders/view/${order.id}" class="action-btn view-btn" data-bs-toggle="tooltip" title="Visualizza">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            `;
            tableBody.appendChild(row);
            
            // Aggiungiamo l'animazione di ingresso
            row.classList.add('animate__animated', 'animate__fadeIn');
            row.style.animationDelay = `${orders.indexOf(order) * 0.1}s`;
        });
    }
    
    /**
     * Aggiorna i prodotti più venduti
     */
    function updateTopProducts(period) {
        const products = topProductsData[period];
        const productsContainer = document.querySelector('.top-products');
        if (!productsContainer) return;
        
        // Svuota il container
        productsContainer.innerHTML = '';
        
        // Popola il container con i nuovi dati
        products.forEach((product, index) => {
            const productItem = document.createElement('div');
            productItem.className = 'top-product-item animate__animated animate__fadeIn';
            productItem.style.animationDelay = `${index * 0.1}s`;
            
            // Calcoliamo il colore in base all'indice
            const colors = ['primary', 'secondary', 'accent1', 'accent2', 'accent3'];
            const colorClass = colors[index % colors.length];
            
            productItem.innerHTML = `
                <div class="top-product-rank rank-${colorClass}">
                    <span>${index + 1}</span>
                </div>
                <div class="top-product-info">
                    <div class="top-product-header">
                        <div class="top-product-name">${product.name}</div>
                        <div class="top-product-badge badge-${colorClass}">${product.sold} venduti</div>
                    </div>
                    <div class="top-product-progress">
                        <div class="progress">
                            <div class="progress-bar progress-${colorClass}" style="width: ${Math.min(100, product.sold / 2)}%"></div>
                        </div>
                    </div>
                </div>
            `;
            
            productsContainer.appendChild(productItem);
        });
    }
    
    // API pubblica
    return {
        init
    };
})();

// Auto-inizializzazione quando viene caricato
document.addEventListener('DOMContentLoaded', function() {
    DashboardPage.init();
});

// Risponde anche all'evento personalizzato di caricamento della pagina
document.addEventListener('pageContentLoaded', function(e) {
    if (e.detail.controller === 'dashboard') {
        DashboardPage.init();
    }
});