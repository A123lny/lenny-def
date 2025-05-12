/**
 * Gestione Ristoranti
 * Script per la gestione delle funzionalità della sezione ristoranti
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded - Initializing restaurant management');
    
    // INIZIALIZZAZIONE MODAL
    initializeModals();
    
    // GESTIONE RICERCA E FILTRI
    setupSearchAndFilters();
    
    // GESTIONE INTERAZIONE RISTORANTI
    setupRestaurantInteractions();
    
    // GESTIONE ESPORTAZIONE
    setupExportFunctionality();
});

/**
 * Inizializza i modal necessari nella pagina
 */
function initializeModals() {
    // Modal dettagli ristorante
    let restaurantDetailsModal;
    const restaurantDetailsModalEl = document.getElementById('restaurantDetailsModal');
    if (restaurantDetailsModalEl) {
        console.log('Restaurant details modal found, initializing...');
        restaurantDetailsModal = new bootstrap.Modal(restaurantDetailsModalEl);
    } else {
        console.error('Restaurant details modal element not found!');
    }
    
    // Modal di gestione ristorante
    const manageRestaurantModal = document.getElementById('manageRestaurantModal');
    let manageRestaurantModalBS = null;
    if (manageRestaurantModal) {
        manageRestaurantModalBS = new bootstrap.Modal(manageRestaurantModal);
    }
}

/**
 * Configura ricerca e filtri per i ristoranti
 */
function setupSearchAndFilters() {
    // Ricerca ristoranti nella tabella principale
    const searchInput = document.getElementById('searchRestaurant');
    const restaurantRows = document.querySelectorAll('.restaurant-item');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            restaurantRows.forEach(row => {
                const restaurantName = row.getAttribute('data-name');
                
                if (restaurantName && restaurantName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    // Gestione del modal di selezione ristorante e filtri
    const modalSearchInput = document.getElementById('modalSearchRestaurant');
    const restaurantCards = document.querySelectorAll('.restaurant-card');
    const alphaItems = document.querySelectorAll('.alpha-item');
    const noResultsMessage = document.getElementById('noResultsMessage');
    
    // Variabile globale per tenere traccia della lettera attualmente selezionata
    window.currentLetter = 'all';
    
    // Event listener per la ricerca nel modal
    if (modalSearchInput) {
        modalSearchInput.addEventListener('input', filterRestaurants);
    }
    
    // Event listener per il filtro alfabetico
    alphaItems.forEach(item => {
        item.addEventListener('click', function() {
            // Rimuovi la classe active da tutti gli elementi
            alphaItems.forEach(i => i.classList.remove('active'));
            
            // Aggiungi la classe active a questo elemento
            this.classList.add('active');
            
            // Aggiorna la lettera corrente
            window.currentLetter = this.getAttribute('data-letter');
            
            // Filtra i ristoranti
            filterRestaurants();
        });
    });
}

/**
 * Filtra i ristoranti nel modal di selezione
 */
function filterRestaurants() {
    const modalSearchInput = document.getElementById('modalSearchRestaurant');
    const restaurantCards = document.querySelectorAll('.restaurant-card');
    const noResultsMessage = document.getElementById('noResultsMessage');
    
    if (!modalSearchInput || !restaurantCards.length) return;
    
    const searchTerm = modalSearchInput.value.toLowerCase().trim();
    let visibleCount = 0;
    
    restaurantCards.forEach(card => {
        const restaurantName = card.getAttribute('data-name');
        const letterFilter = card.getAttribute('data-letter');
        
        let isVisible = restaurantName.includes(searchTerm);
        
        // Applica filtro alfabetico se non è "all"
        if (isVisible && window.currentLetter !== 'all') {
            isVisible = letterFilter === window.currentLetter;
        }
        
        if (isVisible) {
            card.style.display = '';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    // Mostra o nascondi il messaggio "nessun risultato"
    if (noResultsMessage) {
        noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
    }
}

/**
 * Configura le interazioni con gli elementi ristorante
 */
function setupRestaurantInteractions() {
    const restaurantRows = document.querySelectorAll('.restaurant-item');
    
    // Gestione click su riga ristorante nella tabella principale
    restaurantRows.forEach(row => {
        row.addEventListener('click', function() {
            console.log('Restaurant row clicked');
            const restaurantId = this.getAttribute('data-id');
            
            // Recupera i dati del ristorante dal dataset PHP
            const restaurantData = window.restaurantData || []; 
            const selectedRestaurant = restaurantData.find(r => r.id == restaurantId);
            
            if (selectedRestaurant) {
                // Usa il nuovo componente per mostrare i dettagli
                if (window.RestaurantDetailsComponent) {
                    RestaurantDetailsComponent.showRestaurantDetails(selectedRestaurant);
                } else {
                    console.error('RestaurantDetailsComponent not found');
                    showRestaurantDetails(selectedRestaurant); // Fallback alla funzione legacy
                }
            }
        });
        
        // Aggiungi effetto hover migliorato
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'rgba(0, 0, 0, 0.2)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
    
    // Gestione del click sulle card dei ristoranti nel modal di selezione
    setupRestaurantCardInteractions();
    
    // Gestione delle tab nel modal di gestione ristorante
    document.querySelectorAll('.restaurant-management-menu-item').forEach(item => {
        item.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            
            // Nascondi tutte le tab e rimuovi la classe active
            document.querySelectorAll('.restaurant-management-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.restaurant-management-menu-item').forEach(menuItem => {
                menuItem.classList.remove('active');
            });
            
            // Mostra la tab selezionata e attiva il menu item
            const tabElement = document.getElementById(`${tabId}-tab`);
            if (tabElement) {
                tabElement.classList.add('active');
            }
            this.classList.add('active');
        });
    });
    
    // Gestione salvataggio modifiche ristorante
    const saveRestaurantChanges = document.getElementById('saveRestaurantChanges');
    if (saveRestaurantChanges) {
        saveRestaurantChanges.addEventListener('click', function() {
            // Simuliamo un salvataggio con successo
            alert('Le modifiche sono state salvate con successo!');
            
            const manageRestaurantModal = document.getElementById('manageRestaurantModal');
            if (manageRestaurantModal) {
                const modalInstance = bootstrap.Modal.getInstance(manageRestaurantModal);
                if (modalInstance) modalInstance.hide();
            }
        });
    }
    
    // Gestione switch orari apertura nei form
    document.querySelectorAll('.form-check-input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const row = this.closest('tr');
            if (row) {
                const timeInputs = row.querySelectorAll('input[type="time"]');
                const label = this.nextElementSibling;
                
                if (this.checked) {
                    timeInputs.forEach(input => input.disabled = false);
                    if (label) label.textContent = 'Aperto';
                } else {
                    timeInputs.forEach(input => input.disabled = true);
                    if (label) label.textContent = 'Chiuso';
                }
            }
        });
    });
}

/**
 * Configura le interazioni con le card dei ristoranti nel modal di selezione
 */
function setupRestaurantCardInteractions() {
    const restaurantCards = document.querySelectorAll('.restaurant-card');
    
    restaurantCards.forEach(card => {
        // Rimuovo completamente il comportamento di click sulla card
        card.style.cursor = "default";
        
        // Gestisco solo il click sui pulsanti "Gestisci"
        const manageBtn = card.querySelector(".manage-restaurant-btn");
        if (manageBtn) {
            manageBtn.addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const restaurantId = this.getAttribute("data-id");
                
                // Recupera i dati del ristorante dal dataset PHP
                const restaurantData = window.restaurantData || [];
                const selectedRestaurant = restaurantData.find(r => r.id == restaurantId);
                
                if (selectedRestaurant) {
                    showRestaurantManagement(selectedRestaurant);
                }
            });
        }
    });
}

/**
 * Mostra i dettagli del ristorante nel modal (legacy, mantenuta per compatibilità)
 * Usare preferibilmente RestaurantDetailsComponent.showRestaurantDetails()
 * @param {Object} restaurant - I dati del ristorante da visualizzare
 * @deprecated
 */
function showRestaurantDetails(restaurant) {
    // Utilizza il nuovo componente se disponibile, altrimenti fallback all'implementazione legacy
    if (window.RestaurantDetailsComponent) {
        RestaurantDetailsComponent.showRestaurantDetails(restaurant);
        return;
    }
    
    console.log('Restaurant data found:', restaurant.name);
    
    // Aggiornamento del modal con i dati del ristorante
    // Titolo del modal
    const modalTitle = document.querySelector('#modalRestaurantName');
    if (modalTitle) modalTitle.textContent = restaurant.name;
    
    // Sezione panoramica
    const restaurantName = document.querySelector('.restaurant-name');
    if (restaurantName) restaurantName.textContent = restaurant.name;
    
    const restaurantAddress = document.querySelector('.restaurant-address');
    if (restaurantAddress) {
        const addressSpan = restaurantAddress.querySelector('span');
        if (addressSpan) addressSpan.textContent = restaurant.address;
    }
    
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
    const restaurantDetailsModalEl = document.getElementById('restaurantDetailsModal');
    if (restaurantDetailsModalEl) {
        const modalInstance = bootstrap.Modal.getInstance(restaurantDetailsModalEl) 
                            || new bootstrap.Modal(restaurantDetailsModalEl);
        modalInstance.show();
    } else {
        console.error('Modal instance not available');
    }
}

/**
 * Mostra il modal di gestione del ristorante
 * @param {Object} restaurant - I dati del ristorante da gestire
 */
function showRestaurantManagement(restaurant) {
    // Popola il modal con i dati del ristorante
    document.querySelectorAll('.manage-restaurant-name').forEach(el => {
        el.textContent = restaurant.name;
    });
     
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
            badge.className = 'manage-restaurant-status badge badge-success badge-rounded';
            badge.textContent = 'Attivo';
        } else {
            badge.className = 'manage-restaurant-status badge badge-danger badge-rounded';
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
    
    // Mostra il modal
    const manageRestaurantModal = document.getElementById('manageRestaurantModal');
    if (manageRestaurantModal) {
        const modalInstance = bootstrap.Modal.getInstance(manageRestaurantModal) || new bootstrap.Modal(manageRestaurantModal);
        modalInstance.show();
    }
}

/**
 * Aggiorna le stelle di valutazione visivamente (legacy, mantenuta per compatibilità)
 * @param {number} rating - Il rating del ristorante (da 0 a 5)
 * @deprecated
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
 * Crea o aggiorna il grafico degli ordini (legacy, mantenuta per compatibilità)
 * @param {number} restaurantId - L'ID del ristorante
 * @param {string} period - Il periodo di tempo ('week', 'month', 'year')
 * @deprecated
 */
// Verifica se la variabile esiste già prima di dichiararla
// Questo previene la ridichiarazione che causa l'errore in console
if (typeof window.restaurantsOrdersChart === 'undefined') {
    window.restaurantsOrdersChart = null;
}

function createOrUpdateOrdersChart(restaurantId, period = 'week') {
    // Utilizza il componente se disponibile
    if (window.RestaurantDetailsComponent && typeof RestaurantDetailsComponent.createOrUpdateOrdersChart === 'function') {
        RestaurantDetailsComponent.createOrUpdateOrdersChart(restaurantId, period);
        return;
    }
    
    // Se esiste già un grafico, distruggilo per crearne uno nuovo
    if (window.restaurantsOrdersChart) {
        window.restaurantsOrdersChart.destroy();
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
        window.restaurantsOrdersChart = new Chart(ctx, {
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

/**
 * Gestione del wizard per la creazione di un nuovo ristorante
 */
function setupWizard() {
    const newRestaurantBtn = document.querySelector('.btn-action[data-bs-target="#newRestaurantWizardModal"]');
    if (newRestaurantBtn) {
        newRestaurantBtn.addEventListener('click', function() {
            // Resettare il form quando viene aperto il modal
            const newRestaurantForm = document.getElementById('newRestaurantForm');
            if (newRestaurantForm) {
                newRestaurantForm.reset();
            }
            
            // Attivare il primo passo
            goToStep(1);
        });
    }
    
    // Gestione dei pulsanti "Avanti" e "Indietro"
    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', function() {
            const nextStep = parseInt(this.getAttribute('data-step'));
            const currentStep = nextStep - 1;
            const currentStepElement = document.getElementById(`step${currentStep}`);
            
            // Controlla validità del form se siamo al primo passaggio
            if (currentStep === 1 && currentStepElement) {
                // Verifica che i campi obbligatori siano compilati
                const requiredFields = currentStepElement.querySelectorAll('input[required], select[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });
                
                if (!isValid) {
                    // Mostra un messaggio di errore
                    showToast('Compila tutti i campi obbligatori', 'error');
                    return;
                }
            }
            
            goToStep(nextStep);
        });
    });
    
    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', function() {
            const prevStep = parseInt(this.getAttribute('data-step'));
            goToStep(prevStep);
        });
    });
    
    // Gestione switch orari apertura/chiusura giorni
    document.querySelectorAll('.day-status').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const day = this.getAttribute('data-day');
            const timeInputs = document.querySelectorAll(`.${day}-times`);
            const label = this.nextElementSibling;
            
            if (this.checked) {
                timeInputs.forEach(input => input.disabled = false);
                if (label) label.textContent = 'Aperto';
            } else {
                timeInputs.forEach(input => input.disabled = true);
                if (label) label.textContent = 'Chiuso';
            }
        });
    });
    
    // Aggiungere nuova zona di consegna
    const addDeliveryZoneBtn = document.getElementById('addDeliveryZone');
    if (addDeliveryZoneBtn) {
        addDeliveryZoneBtn.addEventListener('click', function() {
            const table = document.querySelector('#step4 .table tbody');
            if (table) {
                const newRow = document.createElement('tr');
                
                newRow.innerHTML = `
                    <td>
                        <input type="text" class="form-control form-control-sm" value="Nuova zona">
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">€</span>
                            <input type="number" class="form-control" value="0.00" min="0" step="0.50">
                        </div>
                    </td>
                    <td>
                        <input type="number" class="form-control form-control-sm" value="15" min="5">
                    </td>
                    <td>
                        <input type="number" class="form-control form-control-sm" value="25" min="10">
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">€</span>
                            <input type="number" class="form-control" value="10.00" min="0" step="0.50">
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-zone">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                
                table.appendChild(newRow);
                
                // Aggiungere event listener per il pulsante di rimozione
                const removeBtn = newRow.querySelector('.remove-zone');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function() {
                        newRow.remove();
                    });
                }
            }
        });
    }
    
    // Event listener iniziale per i pulsanti di rimozione zona
    document.querySelectorAll('.remove-zone').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            if (row) {
                row.remove();
            }
        });
    });
    
    // Gestione submit del form
    const newRestaurantForm = document.getElementById('newRestaurantForm');
    if (newRestaurantForm) {
        newRestaurantForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Qui andrà il codice per inviare i dati al server
            // Per ora simuliamo un invio con successo
            setTimeout(() => {
                showToast('Ristorante creato con successo!', 'success');
                const wizardModal = document.getElementById('newRestaurantWizardModal');
                if (wizardModal) {
                    const modalInstance = bootstrap.Modal.getInstance(wizardModal);
                    if (modalInstance) modalInstance.hide();
                }
                
                // In un'applicazione reale, qui si aggiornerebbe la tabella dei ristoranti
                // o si reindirizzerebbe l'utente alla pagina del ristorante appena creato
            }, 1000);
        });
    }
}

/**
 * Naviga tra i passi del wizard
 * @param {number} stepNumber - Il numero del passo da mostrare
 */
function goToStep(stepNumber) {
    // Nascondi tutti i passi
    const steps = document.querySelectorAll('.wizard-step');
    steps.forEach(step => step.classList.remove('active'));
    
    // Mostra il passo corrente
    const currentStep = document.getElementById(`step${stepNumber}`);
    if (currentStep) {
        currentStep.classList.add('active');
    }
    
    // Aggiorna la progress bar
    const progressSteps = document.querySelectorAll('.progress-step');
    progressSteps.forEach(step => {
        step.classList.remove('active', 'completed');
        
        const stepNum = parseInt(step.getAttribute('data-step'));
        if (stepNum < stepNumber) {
            step.classList.add('completed');
        } else if (stepNum === stepNumber) {
            step.classList.add('active');
        }
    });
    
    // Se siamo all'ultimo passo, aggiorna il riepilogo
    if (stepNumber === 5) {
        updateSummary();
    }
}

/**
 * Aggiorna il riepilogo nell'ultimo passo del wizard
 */
function updateSummary() {
    // Recupera i valori dai campi del form
    const nameEl = document.getElementById('newRestaurantName');
    const name = nameEl ? nameEl.value || '-' : '-';
    
    const cuisineEl = document.getElementById('newRestaurantCuisineType');
    const cuisineText = cuisineEl && cuisineEl.options[cuisineEl.selectedIndex] ? cuisineEl.options[cuisineEl.selectedIndex].text || '-' : '-';
    
    const emailEl = document.getElementById('newRestaurantEmail');
    const email = emailEl ? emailEl.value || '-' : '-';
    
    const phoneEl = document.getElementById('newRestaurantPhone');
    const phone = phoneEl ? phoneEl.value || '-' : '-';
    
    const statusEl = document.getElementById('newRestaurantActiveStatus');
    const status = statusEl && statusEl.checked ? 'Attivo' : 'Inattivo';
    
    // Indirizzo completo
    const streetEl = document.getElementById('newRestaurantStreetAddress');
    const street = streetEl ? streetEl.value || '' : '';
    
    const cityEl = document.getElementById('newRestaurantCity');
    const city = cityEl ? cityEl.value || '' : '';
    
    const zipEl = document.getElementById('newRestaurantZipCode');
    const zip = zipEl ? zipEl.value || '' : '';
    
    const provinceEl = document.getElementById('newRestaurantProvince');
    const province = provinceEl ? provinceEl.value || '' : '';
    
    const address = street + (street && city ? ', ' : '') + city + (zip ? ' ' + zip : '') + (province ? ' (' + province + ')' : '') || '-';
    
    // Aggiorna i campi di riepilogo con i valori
    updateSummaryField('summary-name', name);
    updateSummaryField('summary-cuisine', cuisineText);
    updateSummaryField('summary-email', email);
    updateSummaryField('summary-phone', phone);
    updateSummaryField('summary-status', status);
    updateSummaryField('summary-address', address);
    
    // Aggiorna gli orari di apertura
    const days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    
    days.forEach((day) => {
        const statusEl = document.getElementById(`new${day.charAt(0).toUpperCase() + day.slice(1)}Status`);
        const isOpen = statusEl ? statusEl.checked : false;
        let timeInfo = isOpen ? 'Aperto' : 'Chiuso';
        
        if (isOpen) {
            const timeInputs = document.querySelectorAll(`.${day}-times`);
            if (timeInputs.length >= 4) {
                timeInfo = `${timeInputs[0].value}-${timeInputs[1].value}, ${timeInputs[2].value}-${timeInputs[3].value}`;
            }
        }
        
        updateSummaryField(`summary-${day}`, timeInfo);
    });
    
    // Aggiorna le zone di consegna
    const zoneRows = document.querySelectorAll('#step4 .table tbody tr');
    const zonesContainer = document.getElementById('summary-zones');
    
    if (zonesContainer) {
        if (zoneRows.length > 0) {
            let zonesHtml = '<ul class="mb-0">';
            zoneRows.forEach(row => {
                const zoneName = row.querySelector('td:first-child input') ? row.querySelector('td:first-child input').value : '';
                const zonePrice = row.querySelector('td:nth-child(2) input') ? row.querySelector('td:nth-child(2) input').value : '';
                const zoneTimeMin = row.querySelector('td:nth-child(3) input') ? row.querySelector('td:nth-child(3) input').value : '';
                const zoneTimeMax = row.querySelector('td:nth-child(4) input') ? row.querySelector('td:nth-child(4) input').value : '';
                
                zonesHtml += `<li><strong>${zoneName}:</strong> €${zonePrice} (${zoneTimeMin}-${zoneTimeMax} min)</li>`;
            });
            zonesHtml += '</ul>';
            zonesContainer.innerHTML = zonesHtml;
        } else {
            zonesContainer.textContent = 'Nessuna zona definita';
        }
    }
}

/**
 * Aggiorna un campo nel riepilogo
 * @param {string} id - L'ID dell'elemento da aggiornare
 * @param {string} value - Il valore da impostare
 */
function updateSummaryField(id, value) {
    const element = document.getElementById(id);
    if (element) {
        element.textContent = value;
    }
}

/**
 * Mostra un toast di notifica
 * @param {string} message - Il messaggio da mostrare
 * @param {string} type - Il tipo di toast ('success', 'error', 'warning', 'info')
 */
function showToast(message, type = 'success') {
    // Utilizzo del componente ToastComponent
    if (typeof window.ToastComponent !== 'undefined' && 
        typeof window.ToastComponent.show === 'function') {
        window.ToastComponent.show(message, type);
    } else {
        // Fallback a un semplice alert
        alert(message);
    }
}

/**
 * Configura la funzionalità di esportazione
 */
function setupExportFunctionality() {
    // Gestione delle opzioni di esportazione - utilizzo selettori compatibili con Bootstrap
    const exportCSV = document.getElementById('exportCSV');
    if (exportCSV) {
        exportCSV.addEventListener('click', function(e) {
            e.preventDefault();
            // Utilizza ExportUtils per esportare la tabella in CSV
            ExportUtils.exportTable('.drivers-table table', 'csv', 'ristoranti_' + getCurrentDateString());
        });
    }
    
    const exportPDF = document.getElementById('exportPDF');
    if (exportPDF) {
        exportPDF.addEventListener('click', function(e) {
            e.preventDefault();
            // Utilizza ExportUtils per esportare la tabella in PDF
            ExportUtils.exportTable('.drivers-table table', 'pdf', 'ristoranti_' + getCurrentDateString());
        });
    }
    
    const exportExcel = document.getElementById('exportExcel');
    if (exportExcel) {
        exportExcel.addEventListener('click', function(e) {
            e.preventDefault();
            // Utilizza ExportUtils per esportare la tabella in Excel
            ExportUtils.exportTable('.drivers-table table', 'excel', 'ristoranti_' + getCurrentDateString());
        });
    }
}

/**
 * Ottiene la data corrente in formato stringa
 * @returns {string} Data in formato YYYYMMDD
 */
function getCurrentDateString() {
    const now = new Date();
    return now.getFullYear() + 
           ('0' + (now.getMonth() + 1)).slice(-2) + 
           ('0' + now.getDate()).slice(-2);
}

/**
 * Inizializza il wizard quando viene caricata la pagina
 */
document.addEventListener('DOMContentLoaded', function() {
    setupWizard();
    
    // Rendi disponibile globalmente la funzione di gestione ristorante
    window.showRestaurantManagement = showRestaurantManagement;
});