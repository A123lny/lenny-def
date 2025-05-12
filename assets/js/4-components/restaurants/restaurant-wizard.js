/**
 * Restaurant Wizard Component
 * Gestisce la funzionalità wizard per la creazione di un nuovo ristorante
 * @module RestaurantWizard
 */

const RestaurantWizard = (function() {
    // Variabili private
    let restaurantMap = null;
    let restaurantMarker = null;
    const sanMarinoCoords = [43.9424, 12.4578]; // Coordinate di default
    
    /**
     * Inizializza il wizard
     * @public
     */
    function init() {
        // Riferimento al pulsante di verifica indirizzo
        const verifyAddressBtn = document.getElementById('verifyAddressBtn');
        
        // Inizializza la mappa quando viene mostrato il modal
        $('#newRestaurantWizardModal').on('shown.bs.modal', initMapIfNeeded);
        
        // Event listener per inizializzare la mappa quando si cambia step
        document.querySelectorAll('.next-step, .prev-step').forEach(button => {
            button.addEventListener('click', function() {
                // Se si sta navigando allo step 2 (indirizzo)
                if(this.dataset.step === '2' || 
                  (this.classList.contains('prev-step') && this.dataset.step === '1')) {
                    // Timeout breve per lasciare che lo step diventi visibile
                    setTimeout(initMapIfNeeded, 300);
                }
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
        
        // Gestione pulsante verifica indirizzo
        if (verifyAddressBtn) {
            verifyAddressBtn.addEventListener('click', handleVerifyAddress);
        }
        
        // Aggiorna il marker quando cambia il nome del ristorante
        const restaurantNameField = document.getElementById('newRestaurantName');
        if (restaurantNameField) {
            restaurantNameField.addEventListener('change', function() {
                updateMarkerName(this.value);
            });
        }
        
        // Aggiungere nuova zona di consegna
        const addDeliveryZoneBtn = document.getElementById('addDeliveryZone');
        if (addDeliveryZoneBtn) {
            addDeliveryZoneBtn.addEventListener('click', addNewDeliveryZone);
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
                
                // Qui andrebbe il codice per inviare i dati al server
                // Per ora simuliamo un invio con successo
                setTimeout(() => {
                    window.ToastManager.showToast('Ristorante creato con successo!', 'success');
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
     * Gestisce la verifica dell'indirizzo sulla mappa
     * @private
     */
    function handleVerifyAddress() {
        // Recupera i dati dell'indirizzo dal form
        const street = document.getElementById('newRestaurantStreetAddress').value;
        const city = document.getElementById('newRestaurantCity').value;
        const zip = document.getElementById('newRestaurantZipCode').value;
        const province = document.getElementById('newRestaurantProvince').value;
        
        // Assicurati che ci sia almeno via e città
        if (!street || !city) {
            window.ToastManager.showToast('Inserisci almeno via e città per verificare l\'indirizzo sulla mappa.', 'error');
            return;
        }
        
        // Costruisci l'indirizzo completo
        const fullAddress = `${street}, ${city}, ${zip} ${province}, San Marino`;
        
        // Mostra l'overlay di caricamento
        showLoadingOverlay();
        
        // Geocodifica l'indirizzo
        try {
            // Verifica se window.mapHandler è disponibile
            if (typeof window.mapHandler === 'undefined') {
                throw new Error('MapHandlerService non disponibile. Assicurati che map-service.js sia caricato.');
            }
            
            window.mapHandler.geocodeAddress(fullAddress)
                .then(coords => {
                    // Se la mappa è già inizializzata, aggiorna la vista
                    if (restaurantMap) {
                        restaurantMap.setView(coords, 16);
                        
                        // Aggiorna o crea il marker
                        updateRestaurantMarker(coords, fullAddress);
                        
                        // Rimuovi l'overlay di caricamento
                        removeLoadingOverlay();
                        
                        // Modifica il testo del pulsante per indicare che la verifica è stata completata
                        updateVerifyButtonSuccess();
                        
                        // Mostra un toast di successo
                        window.ToastManager.showToast('Indirizzo verificato con successo!', 'success');
                    } else {
                        // Inizializza la mappa con le coordinate trovate
                        window.mapHandler.initMap('restaurantAddressMap', {
                            center: coords,
                            zoom: 16
                        }).then(map => {
                            restaurantMap = map;
                            updateRestaurantMarker(coords, fullAddress);
                            removeLoadingOverlay();
                            
                            // Modifica il testo del pulsante
                            updateVerifyButtonSuccess();
                            
                            window.ToastManager.showToast('Indirizzo verificato con successo!', 'success');
                            
                            // Aggiungi il controllo di ricerca
                            addSearchControl(restaurantMap);
                            
                            // Aggiungi la funzionalità di selezione per click
                            setupClickToSelectLocation(restaurantMap);
                        });
                    }
                })
                .catch(error => {
                    console.error('Errore durante la geocodifica:', error);
                    removeLoadingOverlay();
                    
                    // Prova con termini di ricerca più permissivi
                    const simplifiedAddress = `${city}, San Marino`;
                    window.ToastManager.showToast('Indirizzo specifico non trovato, provo a cercare solo la città...', 'info');
                    
                    window.mapHandler.geocodeAddress(simplifiedAddress)
                        .then(coords => {
                            if (restaurantMap) {
                                restaurantMap.setView(coords, 14);
                                
                                // Non creare un marker specifico, ma mostra un popup suggerendo di cliccare
                                L.popup()
                                    .setLatLng(coords)
                                    .setContent(`
                                        <div class="alert alert-info m-0 p-2">
                                            <i class="fas fa-info-circle me-1"></i> Indirizzo specifico non trovato. 
                                            <br>Clicca sulla mappa per selezionare manualmente la posizione esatta.
                                        </div>
                                    `)
                                    .openOn(restaurantMap);
                                
                                window.ToastManager.showToast('Clicca sulla mappa per selezionare manualmente la posizione del ristorante', 'info');
                            }
                        })
                        .catch(finalError => {
                            // Se fallisce anche questa, mostra il messaggio di errore
                            showMapError('Impossibile trovare l\'indirizzo. Verifica i dati inseriti o seleziona manualmente la posizione sulla mappa.');
                            window.ToastManager.showToast('Impossibile trovare l\'indirizzo. Prova con un altro indirizzo o seleziona manualmente la posizione.', 'error');
                        });
                });
                
        } catch (error) {
            console.error('Errore durante l\'inizializzazione della mappa:', error);
            removeLoadingOverlay();
            showMapError(`Errore durante l'inizializzazione della mappa: ${error.message}`);
        }
    }
    
    /**
     * Aggiorna il pulsante di verifica per mostrare successo
     * @private
     */
    function updateVerifyButtonSuccess() {
        const verifyAddressBtn = document.getElementById('verifyAddressBtn');
        if (!verifyAddressBtn) return;
        
        verifyAddressBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i> Indirizzo verificato';
        verifyAddressBtn.classList.remove('btn-outline-primary');
        verifyAddressBtn.classList.add('btn-success');
        
        // Dopo 3 secondi, ripristina il pulsante
        setTimeout(() => {
            verifyAddressBtn.innerHTML = '<i class="fas fa-map-marker-alt me-2"></i> Verifica indirizzo';
            verifyAddressBtn.classList.remove('btn-success');
            verifyAddressBtn.classList.add('btn-outline-primary');
        }, 3000);
    }
    
    /**
     * Aggiunge una nuova riga alla tabella delle zone di consegna
     * @private
     */
    function addNewDeliveryZone() {
        const table = document.querySelector('#deliveryZonesTable tbody');
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
    }
    
    /**
     * Funzione per inizializzare la mappa se necessario
     * @private
     */
    function initMapIfNeeded() {
        const addressStep = document.getElementById('step2');
        const mapContainer = document.getElementById('restaurantAddressMap');
        
        // Verifica se lo step è visibile e la mappa non è già inizializzata
        if (addressStep && addressStep.classList.contains('active') && 
            mapContainer && !restaurantMap && typeof window.mapHandler !== 'undefined') {
            
            // Inizializza la mappa centrata su San Marino
            window.mapHandler.initMap('restaurantAddressMap', {
                center: sanMarinoCoords,
                zoom: 14
            }).then(map => {
                restaurantMap = map;
                
                // Aggiungi un marker per San Marino inizialmente
                const defaultIcon = L.divIcon({
                    className: 'city-marker',
                    html: '<i class="fas fa-map-marker-alt" style="color: #ff5a5f; font-size: 20px;"></i>',
                    iconSize: [30, 30],
                    iconAnchor: [15, 30]
                });
                
                L.marker(sanMarinoCoords, {
                    icon: defaultIcon
                }).addTo(restaurantMap)
                 .bindPopup('<b>San Marino</b><br>Repubblica di San Marino').openPopup();
                 
                // Aggiungi un controllo di ricerca personalizzato
                addSearchControl(restaurantMap);
                
                // Aggiungi la funzionalità di selezione per click sulla mappa
                setupClickToSelectLocation(restaurantMap);
                 
            }).catch(error => {
                console.error("Errore nell'inizializzazione della mappa:", error);
                mapContainer.innerHTML = `<div class="alert alert-warning m-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Impossibile caricare la mappa. Clicca "Verifica indirizzo" per riprovare.
                </div>`;
            });
        }
    }
    
    /**
     * Aggiunge un controllo di ricerca personalizzato alla mappa
     * @private
     * @param {Object} map - L'istanza della mappa Leaflet
     */
    function addSearchControl(map) {
        // Crea un controllo personalizzato per la ricerca
        const searchControl = L.control({position: 'topleft'});
        
        searchControl.onAdd = function(map) {
            const container = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');
            container.innerHTML = `
                <button type="button" class="btn btn-sm btn-light" id="mapSearchBtn" title="Cerca sulla mappa">
                    <i class="fas fa-search"></i>
                </button>
            `;
            
            L.DomEvent.on(container, 'click', function(e) {
                L.DomEvent.stopPropagation(e);
                
                // Mostra un modal o tooltip con un campo di ricerca
                const searchBox = L.DomUtil.create('div', 'map-search-box');
                searchBox.style.position = 'absolute';
                searchBox.style.top = '60px';
                searchBox.style.left = '10px';
                searchBox.style.zIndex = '1000';
                searchBox.style.backgroundColor = 'white';
                searchBox.style.padding = '10px';
                searchBox.style.borderRadius = '4px';
                searchBox.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';
                searchBox.innerHTML = `
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="mapSearchInput" placeholder="Cerca indirizzo...">
                        <button class="btn btn-primary" type="button" id="mapSearchSubmit">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-light" type="button" id="mapSearchClose">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                
                document.getElementById('restaurantAddressMap').appendChild(searchBox);
                
                document.getElementById('mapSearchInput').focus();
                
                document.getElementById('mapSearchSubmit').addEventListener('click', function() {
                    const searchTerm = document.getElementById('mapSearchInput').value;
                    if (searchTerm) {
                        searchAddress(searchTerm);
                    }
                });
                
                document.getElementById('mapSearchInput').addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        const searchTerm = document.getElementById('mapSearchInput').value;
                        if (searchTerm) {
                            searchAddress(searchTerm);
                        }
                    }
                });
                
                document.getElementById('mapSearchClose').addEventListener('click', function() {
                    document.querySelector('.map-search-box').remove();
                });
            });
            
            return container;
        };
        
        searchControl.addTo(map);
    }
    
    /**
     * Funzione per cercare un indirizzo dalla search box
     * @private
     * @param {string} searchTerm - Il termine di ricerca
     */
    function searchAddress(searchTerm) {
        // Aggiungere "San Marino" alla ricerca per migliorare la precisione
        const searchWithContext = searchTerm + ' San Marino';
        
        // Mostra l'overlay di caricamento
        showLoadingOverlay();
        
        // Geocodifica l'indirizzo
        window.mapHandler.geocodeAddress(searchWithContext)
            .then(coords => {
                // Aggiorna la vista della mappa
                restaurantMap.setView(coords, 16);
                
                // Crea o aggiorna il marker del ristorante
                updateRestaurantMarker(coords, searchTerm);
                
                // Esegui il geocoding inverso per ottenere i dettagli dell'indirizzo
                return window.geocodingService.reverseGeocode(coords);
            })
            .then(addressDetails => {
                // Se ci sono dettagli dell'indirizzo, aggiorna i campi del form
                if (addressDetails) {
                    updateAddressFieldsFromDetails(addressDetails);
                }
                
                // Rimuovi l'overlay di caricamento
                removeLoadingOverlay();
                
                // Chiudi la search box
                const searchBox = document.querySelector('.map-search-box');
                if (searchBox) searchBox.remove();
            })
            .catch(error => {
                console.error('Errore durante la geocodifica:', error);
                removeLoadingOverlay();
                
                // Mostra un messaggio di errore
                showMapError('Impossibile trovare l\'indirizzo. Prova con termini diversi o più specifici.');
            });
    }
    
    /**
     * Setup per selezionare una posizione cliccando sulla mappa
     * @private
     * @param {Object} map - L'istanza della mappa Leaflet
     */
    function setupClickToSelectLocation(map) {
        map.on('click', function(e) {
            const clickedLatLng = e.latlng;
            
            // Aggiorna il marker con la posizione cliccata
            updateRestaurantMarker([clickedLatLng.lat, clickedLatLng.lng]);
            
            // Esegui il geocoding inverso per ottenere i dettagli dell'indirizzo
            window.geocodingService.reverseGeocode([clickedLatLng.lat, clickedLatLng.lng])
                .then(addressDetails => {
                    if (addressDetails) {
                        updateAddressFieldsFromDetails(addressDetails);
                        
                        // Mostra un toast o notifica di conferma
                        window.ToastManager.showToast('Indirizzo aggiornato con successo!', 'success');
                    }
                })
                .catch(error => {
                    console.error('Errore durante il geocoding inverso:', error);
                    window.ToastManager.showToast('Impossibile determinare l\'indirizzo per questa posizione', 'error');
                });
        });
    }
    
    /**
     * Aggiorna i campi del form con i dettagli dell'indirizzo
     * @private
     * @param {Object} addressDetails - I dettagli dell'indirizzo
     */
    function updateAddressFieldsFromDetails(addressDetails) {
        const streetField = document.getElementById('newRestaurantStreetAddress');
        const cityField = document.getElementById('newRestaurantCity');
        const zipField = document.getElementById('newRestaurantZipCode');
        const provinceField = document.getElementById('newRestaurantProvince');
        
        if (streetField && addressDetails.street) {
            streetField.value = addressDetails.street;
            streetField.classList.add('is-valid');
        }
        
        if (cityField && addressDetails.city) {
            cityField.value = addressDetails.city;
            cityField.classList.add('is-valid');
        }
        
        if (zipField && addressDetails.postalcode) {
            zipField.value = addressDetails.postalcode;
            zipField.classList.add('is-valid');
        }
        
        if (provinceField && addressDetails.state) {
            provinceField.value = addressDetails.state;
            provinceField.classList.add('is-valid');
        }
    }
    
    /**
     * Aggiorna o crea il marker del ristorante
     * @private
     * @param {Array} coords - Coordinate [lat, lng]
     * @param {string} placeName - Nome del luogo (opzionale)
     */
    function updateRestaurantMarker(coords, placeName = 'Posizione selezionata') {
        // Definisci l'icona del marker del ristorante
        const restaurantIcon = L.divIcon({
            className: 'restaurant-marker',
            html: '<div class="store-marker-icon"><i class="fas fa-store"></i></div>',
            iconSize: [40, 40],
            iconAnchor: [20, 40]
        });
        
        // Se il marker esiste già, aggiorna solo la posizione
        if (restaurantMarker) {
            restaurantMarker.setLatLng(coords);
        } else {
            // Crea un nuovo marker
            restaurantMarker = L.marker(coords, {
                icon: restaurantIcon,
                draggable: true, // Permette di trascinare il marker
            }).addTo(restaurantMap);
            
            // Aggiorna l'indirizzo quando il marker viene trascinato
            restaurantMarker.on('dragend', handleMarkerDragEnd);
        }
        
        // Aggiorna il popup del marker
        updateMarkerPopup(placeName);
        
        return restaurantMarker;
    }
    
    /**
     * Gestisce l'evento di trascinamento del marker
     * @private
     */
    function handleMarkerDragEnd() {
        const newPos = restaurantMarker.getLatLng();
        
        // Mostra un loading temporaneo
        restaurantMarker.bindPopup('<div class="text-center"><div class="spinner-border spinner-border-sm text-primary" role="status"></div> Aggiornamento indirizzo...</div>').openPopup();
        
        // Esegui il geocoding inverso per ottenere i dettagli dell'indirizzo
        window.geocodingService.reverseGeocode([newPos.lat, newPos.lng])
            .then(addressDetails => {
                if (addressDetails) {
                    updateAddressFieldsFromDetails(addressDetails);
                    
                    // Aggiorna il popup del marker
                    updateMarkerPopup(addressDetails.display_name);
                    
                    window.ToastManager.showToast('Indirizzo aggiornato con successo!', 'success');
                }
            })
            .catch(error => {
                console.error('Errore durante il geocoding inverso:', error);
                
                // Aggiorna il popup con l'errore
                restaurantMarker.setPopupContent(`
                    <div class="alert alert-warning m-0 p-2">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Impossibile determinare l'indirizzo
                    </div>
                `);
            });
    }
    
    /**
     * Aggiorna il popup del marker con il nome del ristorante
     * @private
     * @param {string} placeName - Nome del luogo
     */
    function updateMarkerPopup(placeName) {
        if (!restaurantMarker) return;
        
        const restaurantName = document.getElementById('newRestaurantName').value || 'Nuovo Ristorante';
        restaurantMarker.bindPopup(`<b>${restaurantName}</b><br>${placeName}`).openPopup();
    }
    
    /**
     * Aggiorna solo il nome del ristorante nel popup del marker
     * @private
     * @param {string} name - Nome del ristorante
     */
    function updateMarkerName(name) {
        if (!restaurantMarker) return;
        
        const currentPopupContent = restaurantMarker.getPopup().getContent();
        const newName = name || 'Nuovo Ristorante';
        
        // Sostituisci solo la parte del nome mantenendo l'indirizzo
        const updatedContent = currentPopupContent.replace(/<b>.*?<\/b>/, `<b>${newName}</b>`);
        restaurantMarker.setPopupContent(updatedContent);
    }
    
    /**
     * Mostra overlay di caricamento sulla mappa
     * @private
     */
    function showLoadingOverlay() {
        // Rimuovi prima eventuali overlay esistenti
        removeLoadingOverlay();
        
        const mapContainer = document.getElementById('restaurantAddressMap');
        if (!mapContainer) return;
        
        const loadingOverlay = L.DomUtil.create('div', 'map-loading-overlay');
        loadingOverlay.innerHTML = `
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-center bg-white p-3 rounded shadow">
                    <div class="spinner-border text-primary" role="status"></div>
                    <div class="mt-2">Ricerca indirizzo...</div>
                </div>
            </div>
        `;
        loadingOverlay.style.position = 'absolute';
        loadingOverlay.style.top = '0';
        loadingOverlay.style.left = '0';
        loadingOverlay.style.width = '100%';
        loadingOverlay.style.height = '100%';
        loadingOverlay.style.backgroundColor = 'rgba(255,255,255,0.7)';
        loadingOverlay.style.zIndex = '1000';
        mapContainer.appendChild(loadingOverlay);
    }
    
    /**
     * Rimuove l'overlay di caricamento
     * @private
     */
    function removeLoadingOverlay() {
        const overlay = document.querySelector('.map-loading-overlay');
        if (overlay) overlay.remove();
    }
    
    /**
     * Mostra un errore sulla mappa
     * @private
     * @param {string} message - Messaggio di errore
     */
    function showMapError(message) {
        if (restaurantMap) {
            L.popup()
                .setLatLng(restaurantMap.getCenter())
                .setContent(`
                    <div class="alert alert-danger m-0 p-2">
                        <i class="fas fa-exclamation-triangle me-1"></i> ${message}
                    </div>
                `)
                .openOn(restaurantMap);
        } else {
            const mapContainer = document.getElementById('restaurantAddressMap');
            if (mapContainer) {
                mapContainer.innerHTML = `
                    <div class="alert alert-danger m-3">
                        <i class="fas fa-exclamation-triangle me-2"></i> ${message}
                    </div>
                `;
            }
        }
    }
    
    // API pubblica
    return {
        init
    };
})();

// Inizializza il componente quando il DOM è caricato
document.addEventListener('DOMContentLoaded', function() {
    RestaurantWizard.init();
});