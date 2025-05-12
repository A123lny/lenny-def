/**
 * Customers Page Module
 * Gestisce tutte le funzionalità specifiche della sezione clienti
 * @module CustomersPage
 */

const CustomersPage = (function() {
    // Elementi DOM specifici della pagina clienti
    let customersList;
    let customerSearchInput;
    let customerFilters;
    let customerDetails;
    
    /**
     * Inizializza il modulo
     */
    function init() {
        console.log('Inizializzazione modulo clienti...');
        
        // Ottieni gli elementi DOM principali
        customersList = document.querySelector('.customers-list');
        customerSearchInput = document.getElementById('customerSearchInput');
        customerFilters = document.querySelectorAll('.customer-filter');
        customerDetails = document.getElementById('customerDetails');
        
        // Inizializza componenti e funzionalità
        setupSearch();
        setupFilters();
        setupCustomerDetails();
        setupOrderHistory();
        setupCustomerCharts();
    }
    
    /**
     * Configura la funzione di ricerca clienti
     */
    function setupSearch() {
        if (!customerSearchInput || !customersList) return;
        
        customerSearchInput.addEventListener('input', function() {
            const searchValue = this.value.trim().toLowerCase();
            const customers = customersList.querySelectorAll('.customer-item');
            
            if (searchValue === '') {
                customers.forEach(customer => {
                    customer.style.display = '';
                });
                return;
            }
            
            customers.forEach(customer => {
                const customerName = customer.querySelector('.customer-name')?.textContent.toLowerCase() || '';
                const customerEmail = customer.querySelector('.customer-email')?.textContent.toLowerCase() || '';
                const customerPhone = customer.querySelector('.customer-phone')?.textContent.toLowerCase() || '';
                
                if (customerName.includes(searchValue) || 
                    customerEmail.includes(searchValue) || 
                    customerPhone.includes(searchValue)) {
                    customer.style.display = '';
                } else {
                    customer.style.display = 'none';
                }
            });
        });
    }
    
    /**
     * Configura i filtri per i clienti
     */
    function setupFilters() {
        if (!customerFilters || !customersList) return;
        
        customerFilters.forEach(filter => {
            filter.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Rimuovi la classe attiva da tutti i filtri
                customerFilters.forEach(f => f.classList.remove('active'));
                
                // Aggiungi la classe attiva al filtro cliccato
                this.classList.add('active');
                
                const filterValue = this.getAttribute('data-filter');
                filterCustomers(filterValue);
            });
        });
    }
    
    /**
     * Filtra i clienti in base al criterio specificato
     * @param {string} filterValue - Valore del filtro
     */
    function filterCustomers(filterValue) {
        if (!customersList) return;
        
        const customers = customersList.querySelectorAll('.customer-item');
        
        if (filterValue === 'all') {
            customers.forEach(customer => {
                customer.style.display = '';
            });
            return;
        }
        
        customers.forEach(customer => {
            const status = customer.getAttribute('data-status');
            const orderCount = parseInt(customer.getAttribute('data-orders') || '0');
            
            switch (filterValue) {
                case 'active':
                    customer.style.display = (status === 'active') ? '' : 'none';
                    break;
                case 'inactive':
                    customer.style.display = (status === 'inactive') ? '' : 'none';
                    break;
                case 'vip':
                    customer.style.display = customer.hasAttribute('data-vip') ? '' : 'none';
                    break;
                case 'recent':
                    // Esempio: considera 'recente' se ha effettuato un ordine negli ultimi 30 giorni
                    const lastOrderDate = new Date(customer.getAttribute('data-last-order') || '');
                    const isRecent = isDateWithinLast30Days(lastOrderDate);
                    customer.style.display = isRecent ? '' : 'none';
                    break;
                case 'frequent':
                    // Esempio: considera 'frequente' se ha più di 10 ordini
                    customer.style.display = (orderCount > 10) ? '' : 'none';
                    break;
                case 'new':
                    // Esempio: considera 'nuovo' se registrato negli ultimi 7 giorni
                    const registrationDate = new Date(customer.getAttribute('data-registration') || '');
                    const isNew = isDateWithinLastWeek(registrationDate);
                    customer.style.display = isNew ? '' : 'none';
                    break;
                default:
                    customer.style.display = '';
            }
        });
    }
    
    /**
     * Verifica se una data è entro gli ultimi 30 giorni
     * @param {Date} date - Data da verificare
     * @returns {boolean} - True se la data è entro gli ultimi 30 giorni
     */
    function isDateWithinLast30Days(date) {
        if (!(date instanceof Date) || isNaN(date)) return false;
        
        const thirtyDaysAgo = new Date();
        thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);
        
        return date >= thirtyDaysAgo;
    }
    
    /**
     * Verifica se una data è entro l'ultima settimana
     * @param {Date} date - Data da verificare
     * @returns {boolean} - True se la data è entro l'ultima settimana
     */
    function isDateWithinLastWeek(date) {
        if (!(date instanceof Date) || isNaN(date)) return false;
        
        const sevenDaysAgo = new Date();
        sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);
        
        return date >= sevenDaysAgo;
    }
    
    /**
     * Configura la visualizzazione dei dettagli cliente
     */
    function setupCustomerDetails() {
        // Gestisce i clic sugli elementi cliente per visualizzare i dettagli
        if (!customersList) return;
        
        const customerItems = customersList.querySelectorAll('.customer-item');
        
        customerItems.forEach(item => {
            item.addEventListener('click', function() {
                const customerId = this.getAttribute('data-id');
                
                // Rimuovi la selezione attiva da tutti gli elementi
                customerItems.forEach(customer => {
                    customer.classList.remove('selected');
                });
                
                // Aggiungi la selezione all'elemento corrente
                this.classList.add('selected');
                
                // Carica i dettagli del cliente
                loadCustomerDetails(customerId);
            });
        });
    }
    
    /**
     * Carica i dettagli di un cliente specifico
     * @param {string} customerId - ID del cliente
     */
    function loadCustomerDetails(customerId) {
        if (!customerDetails) return;
        
        console.log(`Caricamento dettagli per il cliente ${customerId}`);
        
        // In un'applicazione reale, qui si caricherebbero i dati dal server
        // Per ora simuliamo un caricamento con un ritardo
        
        // Mostra un indicatore di caricamento
        customerDetails.innerHTML = '<div class="loading-spinner my-5 text-center"><i class="fas fa-spinner fa-spin fa-2x"></i><p class="mt-2">Caricamento dettagli cliente...</p></div>';
        
        setTimeout(() => {
            // Simulazione dei dati del cliente
            const customer = getCustomerData(customerId);
            
            if (!customer) {
                customerDetails.innerHTML = '<div class="alert alert-warning">Cliente non trovato</div>';
                return;
            }
            
            // Aggiorna la UI con i dettagli del cliente
            updateCustomerDetailsUI(customer);
            
            // Inizializza i grafici specifici del cliente
            initCustomerSpecificCharts(customerId);
        }, 500);
    }
    
    /**
     * Ottieni dati simulati di un cliente
     * @param {string} customerId - ID del cliente
     * @returns {Object|null} - Dati del cliente o null se non trovato
     */
    function getCustomerData(customerId) {
        // Dati di esempio - in un'applicazione reale, questi sarebbero caricati da un'API
        const customers = {
            '1': {
                id: '1',
                name: 'Mario Rossi',
                email: 'mario.rossi@example.com',
                phone: '+39 333 1234567',
                address: 'Via Roma 123, Milano',
                registrationDate: '2024-01-15',
                status: 'active',
                isVip: true,
                totalOrders: 42,
                totalSpent: 1250.50,
                averageOrderValue: 29.77,
                lastOrder: {
                    id: 'ORD-2025-0042',
                    date: '2025-04-15',
                    total: 35.90,
                    status: 'delivered'
                },
                preferences: {
                    favoriteItems: ['Pizza Margherita', 'Tiramisu'],
                    allergies: ['Frutti di mare'],
                    dietaryRestrictions: ['Vegetariano']
                }
            },
            '2': {
                id: '2',
                name: 'Giulia Bianchi',
                email: 'giulia.b@example.com',
                phone: '+39 333 7654321',
                address: 'Via Verdi 45, Roma',
                registrationDate: '2024-03-20',
                status: 'active',
                isVip: false,
                totalOrders: 8,
                totalSpent: 187.25,
                averageOrderValue: 23.41,
                lastOrder: {
                    id: 'ORD-2025-0112',
                    date: '2025-04-20',
                    total: 28.50,
                    status: 'delivered'
                },
                preferences: {
                    favoriteItems: ['Insalata Caesar', 'Cheesecake'],
                    allergies: ['Glutine'],
                    dietaryRestrictions: []
                }
            }
        };
        
        return customers[customerId] || null;
    }
    
    /**
     * Aggiorna l'UI con i dettagli del cliente
     * @param {Object} customer - Dati del cliente
     */
    function updateCustomerDetailsUI(customer) {
        if (!customerDetails) return;
        
        // Formatta le date usando il modulo di utilità se disponibile
        const registrationDate = (typeof window.formatDate === 'function') 
            ? window.formatDate(new Date(customer.registrationDate)) 
            : new Date(customer.registrationDate).toLocaleDateString('it-IT');
        
        const lastOrderDate = (typeof window.formatDate === 'function')
            ? window.formatDate(new Date(customer.lastOrder.date))
            : new Date(customer.lastOrder.date).toLocaleDateString('it-IT');
        
        // Formatta l'importo totale speso se disponibile la funzione di utilità
        const totalSpent = (typeof window.formatCurrency === 'function')
            ? window.formatCurrency(customer.totalSpent)
            : `€${customer.totalSpent.toFixed(2)}`;
        
        // Costruisce l'HTML dei dettagli del cliente
        const html = `
            <div class="customer-details-card">
                <div class="customer-header d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h2 class="customer-name">${customer.name}</h2>
                        <div class="customer-badges">
                            ${customer.status === 'active' ? '<span class="badge bg-success">Attivo</span>' : '<span class="badge bg-secondary">Inattivo</span>'}
                            ${customer.isVip ? '<span class="badge bg-warning text-dark">VIP</span>' : ''}
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" id="customerActionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="customerActionsDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i>Invia email</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-pen me-2"></i>Modifica</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash-alt me-2"></i>Elimina</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="info-card">
                            <h6 class="text-muted">Contatti</h6>
                            <div><i class="fas fa-envelope me-2 text-muted"></i>${customer.email}</div>
                            <div><i class="fas fa-phone me-2 text-muted"></i>${customer.phone}</div>
                            <div><i class="fas fa-map-marker-alt me-2 text-muted"></i>${customer.address}</div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="info-card">
                            <h6 class="text-muted">Statistiche</h6>
                            <div><i class="fas fa-shopping-bag me-2 text-muted"></i>Ordini: <strong>${customer.totalOrders}</strong></div>
                            <div><i class="fas fa-euro-sign me-2 text-muted"></i>Spesa totale: <strong>${totalSpent}</strong></div>
                            <div><i class="fas fa-calculator me-2 text-muted"></i>Media ordine: <strong>€${customer.averageOrderValue.toFixed(2)}</strong></div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="info-card">
                            <h6 class="text-muted">Date</h6>
                            <div><i class="fas fa-user-plus me-2 text-muted"></i>Registrazione: ${registrationDate}</div>
                            <div><i class="fas fa-shopping-cart me-2 text-muted"></i>Ultimo ordine: ${lastOrderDate}</div>
                            <div><i class="fas fa-chart-line me-2 text-muted"></i>Stato: <span class="status-${customer.lastOrder.status}">${customer.lastOrder.status}</span></div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Preferenze</h5>
                            </div>
                            <div class="card-body">
                                <h6>Prodotti preferiti</h6>
                                <ul class="list-unstyled">
                                    ${customer.preferences.favoriteItems.map(item => `<li><i class="fas fa-heart text-danger me-2"></i>${item}</li>`).join('')}
                                </ul>
                                
                                <h6 class="mt-3">Allergie</h6>
                                <ul class="list-unstyled">
                                    ${customer.preferences.allergies.length > 0 
                                        ? customer.preferences.allergies.map(item => `<li><i class="fas fa-exclamation-circle text-warning me-2"></i>${item}</li>`).join('') 
                                        : '<li>Nessuna allergia segnalata</li>'}
                                </ul>
                                
                                <h6 class="mt-3">Restrizioni alimentari</h6>
                                <ul class="list-unstyled">
                                    ${customer.preferences.dietaryRestrictions.length > 0 
                                        ? customer.preferences.dietaryRestrictions.map(item => `<li><i class="fas fa-leaf text-success me-2"></i>${item}</li>`).join('') 
                                        : '<li>Nessuna restrizione segnalata</li>'}
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Andamento ordini</h5>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-outline-secondary active period-btn" data-period="month">Mese</button>
                                    <button type="button" class="btn btn-outline-secondary period-btn" data-period="year">Anno</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="customerOrdersChart" width="400" height="220"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h4>Cronologia ordini</h4>
                    <div class="table-responsive">
                        <table class="table table-hover" id="customerOrdersTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Data</th>
                                    <th>Importo</th>
                                    <th>Stato</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>${customer.lastOrder.id}</td>
                                    <td>${lastOrderDate}</td>
                                    <td>€${customer.lastOrder.total.toFixed(2)}</td>
                                    <td><span class="badge bg-success">${customer.lastOrder.status}</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary view-order" data-order-id="${customer.lastOrder.id}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Altri ordini di esempio -->
                                <tr>
                                    <td>ORD-2025-0035</td>
                                    <td>10/04/2025</td>
                                    <td>€29.90</td>
                                    <td><span class="badge bg-success">delivered</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary view-order" data-order-id="ORD-2025-0035">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ORD-2025-0021</td>
                                    <td>28/03/2025</td>
                                    <td>€32.50</td>
                                    <td><span class="badge bg-success">delivered</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary view-order" data-order-id="ORD-2025-0021">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="text-end mt-4">
                    <button class="btn btn-outline-primary me-2">
                        <i class="fas fa-envelope me-1"></i> Contatta
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Nuovo ordine
                    </button>
                </div>
            </div>
        `;
        
        customerDetails.innerHTML = html;
        
        // Configura i pulsanti di periodo per il grafico
        const periodButtons = customerDetails.querySelectorAll('.period-btn');
        periodButtons.forEach(button => {
            button.addEventListener('click', function() {
                periodButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const period = this.getAttribute('data-period');
                updateCustomerOrdersChart(customer.id, period);
            });
        });
        
        // Configura i pulsanti di visualizzazione ordine
        const viewOrderButtons = customerDetails.querySelectorAll('.view-order');
        viewOrderButtons.forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');
                viewOrderDetails(orderId);
            });
        });
    }
    
    /**
     * Visualizza i dettagli di un ordine specifico
     * @param {string} orderId - ID dell'ordine
     */
    function viewOrderDetails(orderId) {
        console.log(`Visualizzazione dettagli per l'ordine ${orderId}`);
        
        // In un'implementazione reale, qui si aprirebbe un modal con i dettagli dell'ordine
        // o si indirizzerebbe l'utente alla pagina dei dettagli dell'ordine
        
        if (typeof window.showToast === 'function') {
            window.showToast(
                'Dettagli ordine', 
                `Visualizzazione dettagli dell'ordine ${orderId}`, 
                'info'
            );
        } else {
            alert(`Visualizzazione dettagli dell'ordine ${orderId}`);
        }
    }
    
    /**
     * Inizializza i grafici specifici per un cliente
     * @param {string} customerId - ID del cliente
     */
    function initCustomerSpecificCharts(customerId) {
        // Verifica se Chart.js è disponibile
        if (typeof Chart === 'undefined') return;
        
        // Inizializza il grafico degli ordini (default: periodo mensile)
        updateCustomerOrdersChart(customerId, 'month');
    }
    
    /**
     * Aggiorna il grafico degli ordini di un cliente
     * @param {string} customerId - ID del cliente
     * @param {string} period - Periodo (month o year)
     */
    function updateCustomerOrdersChart(customerId, period) {
        const chartCanvas = document.getElementById('customerOrdersChart');
        if (!chartCanvas) return;
        
        // Distruggi il grafico esistente se presente
        const existingChart = Chart.getChart(chartCanvas);
        if (existingChart) {
            existingChart.destroy();
        }
        
        // Prepara i dati in base al periodo selezionato
        let labels, data;
        
        if (period === 'month') {
            // Dati per un mese (ultimi 30 giorni)
            labels = ['1 Apr', '5 Apr', '10 Apr', '15 Apr', '20 Apr', '25 Apr', '28 Apr'];
            data = [0, 1, 0, 1, 1, 0, 1]; // Numero di ordini per data
        } else {
            // Dati per un anno
            labels = ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'];
            data = [3, 2, 4, 4, 0, 0, 0, 0, 0, 0, 0, 0]; // L'anno è il 2025, quindi solo i primi mesi hanno dati
        }
        
        // Crea il nuovo grafico
        new Chart(chartCanvas, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Numero di ordini',
                    data: data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.4,
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            title: function(tooltipItems) {
                                return `Data: ${tooltipItems[0].label}`;
                            },
                            label: function(context) {
                                return `Ordini: ${context.raw}`;
                            }
                        }
                    }
                }
            }
        });
    }
    
    /**
     * Configura la visualizzazione della cronologia ordini
     */
    function setupOrderHistory() {
        // Questa funzione sarà chiamata dopo che i dettagli del cliente sono stati caricati
        document.addEventListener('click', function(e) {
            if (!e.target.classList.contains('view-order') && !e.target.closest('.view-order')) return;
            
            const button = e.target.classList.contains('view-order') ? e.target : e.target.closest('.view-order');
            const orderId = button.getAttribute('data-order-id');
            
            viewOrderDetails(orderId);
        });
    }
    
    /**
     * Configura i grafici generali della pagina clienti
     */
    function setupCustomerCharts() {
        // Verifica se la pagina contiene grafici
        const customerCharts = document.querySelectorAll('.customer-chart');
        if (customerCharts.length === 0) return;
        
        // Verifica se Chart.js è disponibile
        if (typeof Chart === 'undefined') {
            console.warn('Chart.js non è disponibile. I grafici non saranno renderizzati.');
            return;
        }
        
        // Inizializza i grafici generali
        customerCharts.forEach(chartCanvas => {
            const chartId = chartCanvas.id;
            const chartType = chartCanvas.getAttribute('data-chart-type');
            
            switch (chartType) {
                case 'acquisition':
                    createCustomerAcquisitionChart(chartId);
                    break;
                case 'retention':
                    createCustomerRetentionChart(chartId);
                    break;
                case 'demographics':
                    createCustomerDemographicsChart(chartId);
                    break;
            }
        });
    }
    
    /**
     * Crea un grafico per l'acquisizione clienti
     * @param {string} chartId - ID dell'elemento canvas
     */
    function createCustomerAcquisitionChart(chartId) {
        const ctx = document.getElementById(chartId)?.getContext('2d');
        if (!ctx) return;
        
        // Dati di esempio
        const data = {
            labels: ['Gen', 'Feb', 'Mar', 'Apr'],
            datasets: [{
                label: 'Nuovi clienti',
                data: [35, 42, 38, 45],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };
        
        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    
    /**
     * Crea un grafico per la retention dei clienti
     * @param {string} chartId - ID dell'elemento canvas
     */
    function createCustomerRetentionChart(chartId) {
        const ctx = document.getElementById(chartId)?.getContext('2d');
        if (!ctx) return;
        
        // Dati di esempio
        const data = {
            labels: ['1 mese', '3 mesi', '6 mesi', '12 mesi'],
            datasets: [{
                label: 'Tasso di retention',
                data: [85, 72, 64, 58],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };
        
        new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    }
    
    /**
     * Crea un grafico per i dati demografici dei clienti
     * @param {string} chartId - ID dell'elemento canvas
     */
    function createCustomerDemographicsChart(chartId) {
        const ctx = document.getElementById(chartId)?.getContext('2d');
        if (!ctx) return;
        
        // Dati di esempio
        const data = {
            labels: [
                '18-24',
                '25-34',
                '35-44',
                '45-54',
                '55+'
            ],
            datasets: [{
                label: 'Distribuzione per età',
                data: [15, 35, 25, 18, 7],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)'
                ]
            }]
        };
        
        new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    }
    
    // API pubblica
    return {
        init
    };
})();

// Auto-inizializzazione quando viene caricato
document.addEventListener('DOMContentLoaded', function() {
    const controller = new URLSearchParams(window.location.search).get('controller');
    if (controller === 'customers') {
        CustomersPage.init();
    }
});

// Risponde anche all'evento personalizzato di caricamento della pagina
document.addEventListener('pageContentLoaded', function(e) {
    if (e.detail.controller === 'customers') {
        CustomersPage.init();
    }
});