/**
 * Restaurant Management Module
 * Modulo per la gestione delle funzionalità del modal di gestione ristorante
 */

const RestaurantManagement = (function() {
    // Variabili private
    let restaurantMap;
    let restaurantMarker;
    let isMapInitialized = false;
    
    // Coordinate di default (Milano)
    const defaultPosition = {
        lat: 45.464664,
        lng: 9.188540
    };
    
    /**
     * Inizializza il modulo
     * @public
     */
    function init() {
        console.log('Restaurant Management Module initialized');
        setupTabNavigation();
        setupEventListeners();
    }
    
    /**
     * Configura la navigazione tra i tab
     * @private
     */
    function setupTabNavigation() {
        const menuItems = document.querySelectorAll('.restaurant-management-menu-item');
        
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                // Rimuovi classe active da tutti gli elementi
                menuItems.forEach(i => i.classList.remove('active'));
                
                // Aggiungi classe active all'elemento cliccato
                this.classList.add('active');
                
                // Ottieni l'ID del tab da mostrare
                const tabId = this.getAttribute('data-tab');
                
                // Nascondi tutti i tab e mostra quello selezionato
                const tabs = document.querySelectorAll('.restaurant-management-tab');
                tabs.forEach(tab => tab.classList.remove('active'));
                
                const selectedTab = document.getElementById(`${tabId}-tab`);
                if (selectedTab) {
                    selectedTab.classList.add('active');
                    
                    // Se il tab selezionato è quello dell'indirizzo, inizializza la mappa se non è già stato fatto
                    if (tabId === 'address' && !isMapInitialized) {
                        setTimeout(initializeRestaurantMap, 100);
                    }
                }
            });
        });
    }
    
    /**
     * Configura tutti gli event listeners necessari
     * @private
     */
    function setupEventListeners() {
        // Inizializza la mappa quando il modal viene mostrato se siamo già nel tab dell'indirizzo
        const manageRestaurantModal = document.getElementById('manageRestaurantModal');
        if (manageRestaurantModal) {
            manageRestaurantModal.addEventListener('shown.bs.modal', function() {
                const addressTabActive = document.querySelector('#address-tab.active');
                if (addressTabActive && !isMapInitialized) {
                    setTimeout(initializeRestaurantMap, 100);
                }
            });
        }
        
        // Configurazione delle interazioni per la mappa
        setupMapInteractions();
        
        // Gestione dei form
        setupFormListeners();
        
        // Pulsante salva modifiche
        const saveButton = document.getElementById('saveRestaurantChanges');
        if (saveButton) {
            saveButton.addEventListener('click', saveRestaurantData);
        }
    }
    
    /**
     * Configura le interazioni per la gestione della mappa
     * @private
     */
    function setupMapInteractions() {
        const restaurantLatInput = document.getElementById('restaurantLat');
        const restaurantLngInput = document.getElementById('restaurantLng');
        const restaurantAddressInput = document.getElementById('restaurantAddress');
        const restaurantCityInput = document.getElementById('restaurantCity');
        const updateMapFromAddressBtn = document.getElementById('updateMapFromAddress');
        const updateCoordinatesFromMapBtn = document.getElementById('updateCoordinatesFromMap');
        
        // Evento click per cercare un indirizzo e aggiornare la mappa
        if (updateMapFromAddressBtn) {
            updateMapFromAddressBtn.addEventListener('click', async function() {
                const address = restaurantAddressInput.value.trim();
                const city = restaurantCityInput.value.trim();
                
                if (address && city) {
                    const location = await geocodeAddress(address, city);
                    if (location) {
                        moveMarkerTo(location.lat, location.lng);
                        updateCoordinateInputs(location.lat, location.lng);
                        restaurantMap.setView([location.lat, location.lng], 15);
                    } else {
                        // Feedback all'utente che l'indirizzo non è stato trovato
                        alert('Indirizzo non trovato. Prova a inserire un indirizzo più specifico.');
                    }
                } else {
                    // Feedback all'utente che è necessario inserire indirizzo e città
                    alert('Inserisci sia l\'indirizzo che la città per utilizzare la ricerca.');
                }
            });
        }
        
        // Evento click per aggiornare le coordinate dai campi di input
        if (updateCoordinatesFromMapBtn) {
            updateCoordinatesFromMapBtn.addEventListener('click', function() {
                const lat = parseFloat(restaurantLatInput.value);
                const lng = parseFloat(restaurantLngInput.value);
                
                if (!isNaN(lat) && !isNaN(lng)) {
                    moveMarkerTo(lat, lng);
                    restaurantMap.setView([lat, lng], 15);
                } else {
                    // Feedback all'utente che le coordinate non sono valide
                    alert('Inserisci coordinate valide nei campi Latitudine e Longitudine.');
                }
            });
        }
        
        // Aggiornamento della mappa quando vengono modificate manualmente le coordinate
        if (restaurantLatInput) {
            restaurantLatInput.addEventListener('change', function() {
                if (isMapInitialized && restaurantLngInput.value) {
                    const lat = parseFloat(this.value);
                    const lng = parseFloat(restaurantLngInput.value);
                    if (!isNaN(lat) && !isNaN(lng)) {
                        moveMarkerTo(lat, lng);
                    }
                }
            });
        }
        
        if (restaurantLngInput) {
            restaurantLngInput.addEventListener('change', function() {
                if (isMapInitialized && restaurantLatInput.value) {
                    const lat = parseFloat(restaurantLatInput.value);
                    const lng = parseFloat(this.value);
                    if (!isNaN(lat) && !isNaN(lng)) {
                        moveMarkerTo(lat, lng);
                    }
                }
            });
        }
        
        // Invalidazione della mappa se viene ridimensionata la finestra
        window.addEventListener('resize', function() {
            if (isMapInitialized && restaurantMap) {
                restaurantMap.invalidateSize();
            }
        });
    }
    
    /**
     * Configura i listener per i form
     * @private
     */
    function setupFormListeners() {
        // Qui puoi aggiungere ulteriori gestori di eventi per i vari form
        // Ad esempio, switch per attivare/disattivare gli orari, ecc.
    }
    
    /**
     * Inizializza la mappa Leaflet
     * @private
     */
    function initializeRestaurantMap() {
        if (isMapInitialized) return;
        
        // Riferimenti agli elementi DOM necessari per la gestione della mappa
        const restaurantLocationMap = document.getElementById('restaurantLocationMap');
        const restaurantLatInput = document.getElementById('restaurantLat');
        const restaurantLngInput = document.getElementById('restaurantLng');
        
        if (!restaurantLocationMap) return;
        
        // Inizializzazione mappa
        restaurantMap = L.map('restaurantLocationMap').setView([defaultPosition.lat, defaultPosition.lng], 13);
        
        // Aggiungiamo il layer di base OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(restaurantMap);
        
        // Aggiungiamo il marker iniziale
        restaurantMarker = L.marker([defaultPosition.lat, defaultPosition.lng], {
            draggable: true,
            autoPan: true
        }).addTo(restaurantMap);
        
        // Aggiungiamo un popup al marker
        restaurantMarker.bindPopup('Posizione del ristorante').openPopup();
        
        // Evento al termine del drag del marker per aggiornare i campi delle coordinate
        restaurantMarker.on('dragend', function(event) {
            const position = restaurantMarker.getLatLng();
            updateCoordinateInputs(position.lat, position.lng);
        });
        
        // Click sulla mappa per spostare il marker
        restaurantMap.on('click', function(event) {
            const position = event.latlng;
            moveMarkerTo(position.lat, position.lng);
            updateCoordinateInputs(position.lat, position.lng);
        });
        
        isMapInitialized = true;
        
        // Aggiorniamo la mappa con le coordinate esistenti se disponibili
        if (restaurantLatInput && restaurantLngInput && 
            restaurantLatInput.value && restaurantLngInput.value) {
            const lat = parseFloat(restaurantLatInput.value);
            const lng = parseFloat(restaurantLngInput.value);
            if (!isNaN(lat) && !isNaN(lng)) {
                moveMarkerTo(lat, lng);
            }
        }
    }
    
    /**
     * Sposta il marker ad una nuova posizione
     * @param {number} lat - Latitudine
     * @param {number} lng - Longitudine
     * @private
     */
    function moveMarkerTo(lat, lng) {
        if (!restaurantMarker) return;
        
        const newPosition = new L.LatLng(lat, lng);
        restaurantMarker.setLatLng(newPosition);
        
        if (restaurantMap) {
            restaurantMap.setView(newPosition, restaurantMap.getZoom());
        }
    }
    
    /**
     * Aggiorna i campi di input delle coordinate
     * @param {number} lat - Latitudine
     * @param {number} lng - Longitudine
     * @private
     */
    function updateCoordinateInputs(lat, lng) {
        const restaurantLatInput = document.getElementById('restaurantLat');
        const restaurantLngInput = document.getElementById('restaurantLng');
        
        if (restaurantLatInput) restaurantLatInput.value = lat.toFixed(6);
        if (restaurantLngInput) restaurantLngInput.value = lng.toFixed(6);
    }
    
    /**
     * Geocodifica un indirizzo usando OpenStreetMap Nominatim
     * @param {string} address - Indirizzo
     * @param {string} city - Città
     * @returns {Promise<Object|null>} - Coordinate dell'indirizzo o null se non trovato
     * @private
     */
    async function geocodeAddress(address, city) {
        const fullAddress = `${address}, ${city}`;
        const encodedAddress = encodeURIComponent(fullAddress);
        
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodedAddress}&limit=1`);
            const data = await response.json();
            
            if (data.length > 0) {
                const location = data[0];
                return {
                    lat: parseFloat(location.lat),
                    lng: parseFloat(location.lon)
                };
            } else {
                throw new Error('Indirizzo non trovato');
            }
        } catch (error) {
            console.error('Errore durante la geocodifica:', error);
            return null;
        }
    }
    
    /**
     * Salva i dati del ristorante
     * @private
     */
    function saveRestaurantData() {
        // Implementazione del salvataggio dei dati
        console.log('Salvataggio dati ristorante...');
        
        // Qui puoi implementare la logica per raccogliere tutti i dati dai form
        // e inviarli al server tramite una chiamata AJAX
        
        // Esempio di raccolta dati base
        const restaurantData = {
            name: document.getElementById('restaurantName')?.value,
            shortDescription: document.getElementById('restaurantShortDescription')?.value,
            phone: document.getElementById('restaurantPhone')?.value,
            email: document.getElementById('restaurantEmail')?.value,
            manager: document.getElementById('restaurantManager')?.value,
            cuisineType: document.getElementById('restaurantCuisineType')?.value,
            isActive: document.getElementById('restaurantActiveStatus')?.checked,
            address: document.getElementById('restaurantAddress')?.value,
            city: document.getElementById('restaurantCity')?.value,
            zip: document.getElementById('restaurantZip')?.value,
            province: document.getElementById('restaurantProvince')?.value,
            lat: document.getElementById('restaurantLat')?.value,
            lng: document.getElementById('restaurantLng')?.value,
            deliveryNotes: document.getElementById('restaurantDeliveryNotes')?.value,
            description: document.getElementById('restaurantDescription')?.value
        };
        
        console.log('Dati ristorante raccolti:', restaurantData);
        
        // TODO: Implementare chiamata AJAX per il salvataggio
        
        // Simulazione salvataggio con successo
        alert('Modifiche salvate con successo!');
    }
    
    // API pubblica
    return {
        init: init,
        initializeMap: initializeRestaurantMap
    };
})();

// Esponi il modulo come globale per il caricamento dinamico
window.RestaurantManagement = RestaurantManagement;