/**
 * Restaurant Details Modal Component
 * Gestisce la visualizzazione e l'interazione con il modal dei dettagli ristorante
 * @module RestaurantDetailsComponent
 */

const RestaurantDetailsComponent = (function() {
    // Riferimenti agli elementi DOM
    let modalElement;
    let ordersChart = null;

    /**
     * Inizializza il componente
     * @public
     */
    function init() {
        // Inizializza riferimenti al DOM
        modalElement = document.getElementById('restaurantDetailsModal');
        
        if (!modalElement) {
            console.error('Restaurant details modal not found in DOM');
            return;
        }
        
        // Inizializza listener eventi
        setupEventListeners();
    }
    
    /**
     * Configura i listener per gli eventi
     * @private
     */
    function setupEventListeners() {
        // Gestisce il click sul pulsante export report
        const exportReportBtn = document.getElementById('exportRestaurantReport');
        if (exportReportBtn) {
            exportReportBtn.addEventListener('click', function() {
                // Questa funzionalità è gestita da restaurant-report.js
                // Non è necessario fare nulla qui
            });
        }
        
        // Gestisce il click sul pulsante modifica ristorante
        const editRestaurantBtn = document.getElementById('editRestaurantBtn');
        if (editRestaurantBtn) {
            editRestaurantBtn.addEventListener('click', function() {
                // Ottiene l'ID del ristorante
                const restaurantIdEl = document.querySelector('.restaurant-id');
                if (restaurantIdEl) {
                    const restaurantId = restaurantIdEl.textContent.replace('RST-', '');
                    
                    // Recupera i dati del ristorante dal dataset PHP
                    const restaurantData = window.restaurantData || [];
                    const selectedRestaurant = restaurantData.find(r => r.id == restaurantId - 1000);
                    
                    if (selectedRestaurant) {
                        // CHIUSURA MODAL CORRENTE
                        $('#restaurantDetailsModal').modal('hide');
                        
                        // Popola il modal di gestione ristorante
                        const nameElements = document.querySelectorAll('.manage-restaurant-name');
                        if (nameElements) {
                            nameElements.forEach(el => el.textContent = selectedRestaurant.name);
                        }
                        
                        const restaurantName = document.getElementById('restaurantName');
                        if (restaurantName) restaurantName.value = selectedRestaurant.name;
                        
                        const restaurantShortDescription = document.getElementById('restaurantShortDescription');
                        if (restaurantShortDescription) {
                            restaurantShortDescription.value = `Il miglior ${selectedRestaurant.name} di Milano`;
                        }
                        
                        const restaurantPhone = document.getElementById('restaurantPhone');
                        if (restaurantPhone) restaurantPhone.value = selectedRestaurant.phone;
                        
                        const restaurantAddress = document.getElementById('restaurantAddress');
                        if (restaurantAddress) restaurantAddress.value = selectedRestaurant.address;
                        
                        const restaurantEmail = document.getElementById('restaurantEmail');
                        if (restaurantEmail) {
                            restaurantEmail.value = `info@${selectedRestaurant.name.toLowerCase().replace(/\s+/g, '')}.it`;
                        }
                        
                        // Imposta lo stato
                        const statusCheckbox = document.getElementById('restaurantActiveStatus');
                        if (statusCheckbox) statusCheckbox.checked = selectedRestaurant.active;
                        
                        // Mostra il modal di gestione ristorante
                        $('#manageRestaurantModal').modal('show');
                    }
                }
            });
        } else {
            console.error('Pulsante modifica ristorante non trovato nel DOM');
        }
        
        // Gestisce i pulsanti di periodo nel tab delle statistiche
        document.querySelectorAll('.period-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Rimuovi classe active da tutti i pulsanti
                document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
                // Aggiungi classe active al pulsante cliccato
                this.classList.add('active');
                
                // Ottieni l'ID del ristorante attualmente visualizzato
                const restaurantIdEl = document.querySelector('.restaurant-id');
                if (restaurantIdEl) {
                    const restaurantId = restaurantIdEl.textContent.replace('RST-', '');
                    // Aggiorna il grafico con il nuovo periodo
                    createOrUpdateOrdersChart(parseInt(restaurantId) - 1000, this.getAttribute('data-period'));
                }
            });
        });
    }
    
    /**
     * Popola il modal di gestione ristorante con i dati del ristorante selezionato
     * @param {Object} restaurant - I dati del ristorante
     * @private
     */
    function populateManageRestaurantModal(restaurant) {
        // Popola i campi del modal di gestione ristorante
        const nameElements = document.querySelectorAll('.manage-restaurant-name');
        if (nameElements) {
            nameElements.forEach(el => el.textContent = restaurant.name);
        }
        
        // Popola i form fields con i dati del ristorante
        const restaurantName = document.getElementById('restaurantName');
        if (restaurantName) {
            restaurantName.value = restaurant.name;
        }
        
        const restaurantShortDescription = document.getElementById('restaurantShortDescription');
        if (restaurantShortDescription) {
            restaurantShortDescription.value = `Il miglior ${restaurant.name} di Milano`;
        }
        
        const restaurantPhone = document.getElementById('restaurantPhone');
        if (restaurantPhone) {
            restaurantPhone.value = restaurant.phone;
        }
        
        const restaurantAddress = document.getElementById('restaurantAddress');
        if (restaurantAddress) {
            restaurantAddress.value = restaurant.address;
        }
        
        const restaurantEmail = document.getElementById('restaurantEmail');
        if (restaurantEmail) {
            restaurantEmail.value = `info@${restaurant.name.toLowerCase().replace(/\s+/g, '')}.it`;
        }
        
        // Imposta lo stato
        const statusCheckbox = document.getElementById('restaurantActiveStatus');
        if (statusCheckbox) {
            statusCheckbox.checked = restaurant.active;
        }
        
        const statusBadges = document.querySelectorAll('.manage-restaurant-status');
        statusBadges.forEach(badge => {
            if (restaurant.active) {
                badge.className = 'manage-restaurant-status badge-pill status-badge status-active';
                badge.textContent = 'Attivo';
            } else {
                badge.className = 'manage-restaurant-status badge-pill status-badge status-inactive';
                badge.textContent = 'Inattivo';
            }
        });
        
        // Imposta il tipo di cucina
        const cuisineSelect = document.getElementById('restaurantCuisineType');
        if (cuisineSelect) {
            if (restaurant.name.toLowerCase().includes("pizzeria") || 
                restaurant.name.toLowerCase().includes("pizza")) {
                cuisineSelect.value = 'pizza';
            } else if (restaurant.name.toLowerCase().includes("sushi")) {
                cuisineSelect.value = 'sushi';
            } else if (restaurant.name.toLowerCase().includes("burger")) {
                cuisineSelect.value = 'fast-food';
            } else {
                cuisineSelect.value = 'italiana';
            }
        }
    }
    
    /**
     * Mostra i dettagli del ristorante nel modal
     * @param {Object} restaurant - I dati del ristorante da visualizzare
     * @public
     */
    function showRestaurantDetails(restaurant) {
        if (!restaurant) {
            console.error('No restaurant data provided');
            return;
        }
        
        // Aggiornamento del modal con i dati del ristorante
        // Titolo del modal
        const modalTitle = document.querySelector('#modalRestaurantName');
        if (modalTitle) modalTitle.textContent = restaurant.name;
        
        // Sezione panoramica
        const restaurantName = document.querySelector('.restaurant-name');
        if (restaurantName) restaurantName.textContent = restaurant.name;
        
        const restaurantAddress = document.querySelector('.restaurant-address');
        if (restaurantAddress) restaurantAddress.textContent = restaurant.address;
        
        const restaurantPhone = document.querySelector('.restaurant-phone');
        if (restaurantPhone) restaurantPhone.textContent = restaurant.phone;
        
        const restaurantEmail = document.querySelector('.restaurant-email');
        const emailText = `info@${restaurant.name.toLowerCase().replace(/\s+/g, '')}.it`;
        if (restaurantEmail) restaurantEmail.textContent = emailText;
        
        // Link di contatto
        const phoneLink = document.querySelector('.restaurant-phone-link');
        if (phoneLink) {
            phoneLink.href = `tel:${restaurant.phone}`;
        }
        
        const emailLink = document.querySelector('.restaurant-email-link');
        if (emailLink) {
            emailLink.href = `mailto:${emailText}`;
        }
        
        const mapLink = document.querySelector('.restaurant-map-link');
        if (mapLink) {
            mapLink.href = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(restaurant.address)}`;
        }
        
        // Informazioni generali
        const restaurantId = document.querySelector('.restaurant-id');
        if (restaurantId) restaurantId.textContent = `RST-${1000 + restaurant.id}`;
        
        // Tipo di cucina basato sul nome
        let cuisineTypes = "Italiana";
        if (restaurant.name.toLowerCase().includes("sushi")) {
            cuisineTypes = "Giapponese, Sushi";
        } else if (restaurant.name.toLowerCase().includes("pizza")) {
            cuisineTypes = "Italiana, Pizza";
        } else if (restaurant.name.toLowerCase().includes("burger")) {
            cuisineTypes = "Fast Food, Hamburger";
        }
        
        const restaurantCuisine = document.querySelector('.restaurant-cuisine');
        if (restaurantCuisine) restaurantCuisine.textContent = cuisineTypes;
        
        const restaurantHours = document.querySelector('.restaurant-hours');
        if (restaurantHours) restaurantHours.textContent = "11:00 - 23:00";
        
        // Dati statistici
        const restaurantOrders = document.querySelector('.restaurant-orders');
        if (restaurantOrders) restaurantOrders.textContent = restaurant.orders;
        
        const restaurantRating = document.querySelector('.restaurant-rating');
        if (restaurantRating) restaurantRating.textContent = restaurant.rating;
        
        const restaurantRatingCount = document.querySelector('.restaurant-rating-count');
        if (restaurantRatingCount) restaurantRatingCount.textContent = restaurant.rating;
        
        const restaurantReviews = document.querySelector('.restaurant-reviews-count');
        if (restaurantReviews) restaurantReviews.textContent = Math.floor(restaurant.orders * 0.32);
        
        const restaurantComplaints = document.querySelector('.restaurant-complaints');
        if (restaurantComplaints) restaurantComplaints.textContent = Math.floor(restaurant.orders * 0.04);
        
        // Aggiorna stelle di valutazione
        updateRatingStars(restaurant.rating);
        
        // Imposta lo stato
        const statusBadge = document.querySelector('.restaurant-status');
        if (statusBadge) {
            if (restaurant.active) {
                statusBadge.className = 'status-badge status-active restaurant-status';
                statusBadge.textContent = 'Attivo';
            } else {
                statusBadge.className = 'status-badge status-inactive restaurant-status';
                statusBadge.textContent = 'Inattivo';
            }
        }
        
        // Crea o aggiorna il grafico
        createOrUpdateOrdersChart(restaurant.id);
        
        // Mostra il modal
        if (modalElement) {
            const modalInstance = bootstrap.Modal.getInstance(modalElement) 
                                || new bootstrap.Modal(modalElement);
            modalInstance.show();
        } else {
            console.error('Modal instance not available');
        }
    }
    
    /**
     * Aggiorna le stelle di valutazione visivamente
     * @param {number} rating - Il rating del ristorante (da 0 a 5)
     * @private
     */
    function updateRatingStars(rating) {
        const fullStars = Math.floor(rating);
        const hasHalfStar = (rating - fullStars) >= 0.5;
        const starsContainer = document.querySelector('.rating-stars');
        
        if (starsContainer) {
            starsContainer.innerHTML = '';
            
            // Aggiungi stelle piene
            for (let i = 0; i < fullStars; i++) {
                const star = document.createElement('i');
                star.className = 'fas fa-star';
                starsContainer.appendChild(star);
            }
            
            // Aggiungi mezza stella se necessario
            if (hasHalfStar) {
                const halfStar = document.createElement('i');
                halfStar.className = 'fas fa-star-half-alt';
                starsContainer.appendChild(halfStar);
            }
            
            // Aggiungi stelle vuote per arrivare a 5
            const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
            for (let i = 0; i < emptyStars; i++) {
                const emptyStar = document.createElement('i');
                emptyStar.className = 'far fa-star';
                starsContainer.appendChild(emptyStar);
            }
        }
    }
    
    /**
     * Crea o aggiorna il grafico degli ordini
     * @param {number} restaurantId - L'ID del ristorante
     * @param {string} period - Il periodo di tempo ('week', 'month', 'year')
     * @private
     */
    function createOrUpdateOrdersChart(restaurantId, period = 'week') {
        // Se esiste già un grafico, distruggilo per crearne uno nuovo
        if (ordersChart) {
            ordersChart.destroy();
        }
        
        // Genera dati casuali ma coerenti in base al ristorante e al periodo
        const labels = [];
        const ordersData = [];
        const revenueData = [];
        
        let days = 7;
        if (period === 'month') days = 30;
        if (period === 'year') days = 12; // per l'anno usiamo i mesi
        
        // Seed basato sull'ID ristorante per coerenza tra refresh
        const seed = restaurantId * 10;
        
        if (period === 'year') {
            // Dati mensili per l'anno
            const monthNames = ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'];
            for (let i = 0; i < days; i++) {
                labels.push(monthNames[i]);
                
                // Generazione dati con pattern stagionale
                let baseOrders = 20 + (seed % 15);
                if (i === 6 || i === 7) baseOrders *= 0.7; // estate più bassa
                if (i === 10 || i === 11 || i === 0) baseOrders *= 1.3; // inverno più alta
                
                const orders = Math.floor(baseOrders + (Math.sin(i) * 8) + (Math.random() * 10));
                ordersData.push(orders);
                revenueData.push(Math.floor(orders * (18 + (Math.random() * 8))));
            }
        } else {
            // Dati giornalieri per settimana o mese
            const today = new Date();
            for (let i = days - 1; i >= 0; i--) {
                const date = new Date();
                date.setDate(today.getDate() - i);
                
                let dateLabel = date.getDate() + '/' + (date.getMonth() + 1);
                labels.push(dateLabel);
                
                // Generazione dati con pattern settimanale
                let baseOrders = 5 + (seed % 10);
                const dayOfWeek = date.getDay();
                if (dayOfWeek === 5 || dayOfWeek === 6) baseOrders *= 1.5; // weekend più alto
                if (dayOfWeek === 1 || dayOfWeek === 2) baseOrders *= 0.7; // lunedì e martedì più bassi
                
                const orders = Math.floor(baseOrders + (Math.sin(i) * 3) + (Math.random() * 5));
                ordersData.push(orders);
                revenueData.push(Math.floor(orders * (18 + (Math.random() * 8))));
            }
        }
        
        // Crea il grafico
        const chartCanvas = document.getElementById('restaurantOrdersChart');
        if (chartCanvas) {
            const ctx = chartCanvas.getContext('2d');
            ordersChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Ordini',
                            data: ordersData,
                            backgroundColor: 'rgba(255, 90, 95, 0.7)',
                            borderColor: 'rgba(255, 90, 95, 1)',
                            borderWidth: 1,
                            borderRadius: 6,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Fatturato (€)',
                            data: revenueData,
                            type: 'line',
                            borderColor: 'rgba(0, 209, 178, 1)',
                            backgroundColor: 'rgba(0, 209, 178, 0.2)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: 'rgba(0, 209, 178, 1)',
                            pointRadius: 4,
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Ordini'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        y1: {
                            beginAtZero: true,
                            type: 'linear',
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Fatturato (€)'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            mode: 'index',
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.datasetIndex === 1) {
                                        label += '€' + context.parsed.y;
                                    } else {
                                        label += context.parsed.y;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }
    }
    
    // API pubblica
    return {
        init,
        showRestaurantDetails
    };
})();

// Esportazione globale per mantenere la compatibilità con il codice esistente
window.RestaurantDetailsComponent = RestaurantDetailsComponent;

// Inizializzazione automatica del componente quando il DOM è pronto
document.addEventListener('DOMContentLoaded', function() {
    RestaurantDetailsComponent.init();
});