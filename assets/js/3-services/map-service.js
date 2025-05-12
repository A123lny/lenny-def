/**
 * Map Service
 * Gestore per le mappe di OpenStreetMap con funzionalità avanzate di routing e geocoding
 * @module MapService
 */

const MapService = (function() {
    // Variabili private
    const mapInstances = {};
    
    /**
     * Carica le dipendenze CSS e JS di Leaflet
     * @private
     * @returns {Promise} Promise che si risolve quando le dipendenze sono caricate
     */
    function loadDependencies() {
        // Aggiungi il CSS di Leaflet se non esiste già
        if (!document.querySelector('link[href*="leaflet.css"]')) {
            const leafletCss = document.createElement('link');
            leafletCss.rel = 'stylesheet';
            leafletCss.href = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css';
            leafletCss.integrity = 'sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==';
            leafletCss.crossOrigin = '';
            document.head.appendChild(leafletCss);
        }
        
        // Aggiungi lo script di Leaflet se non esiste già
        if (!document.querySelector('script[src*="leaflet.js"]')) {
            return new Promise((resolve) => {
                const leafletScript = document.createElement('script');
                leafletScript.src = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js';
                leafletScript.integrity = 'sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==';
                leafletScript.crossOrigin = '';
                leafletScript.onload = resolve;
                document.head.appendChild(leafletScript);
            });
        }
        
        return Promise.resolve();
    }
    
    /**
     * Aspetta che Leaflet sia caricato
     * @private
     * @returns {Promise} Promise che si risolve quando Leaflet è disponibile
     */
    function waitForLeaflet() {
        return new Promise((resolve) => {
            const checkLeaflet = () => {
                if (typeof L !== 'undefined') {
                    resolve();
                } else {
                    setTimeout(checkLeaflet, 100);
                }
            };
            checkLeaflet();
        });
    }
    
    /**
     * Inizializza una mappa in un determinato contenitore
     * @public
     * @param {string} containerId - ID del contenitore della mappa
     * @param {Object} options - Opzioni di configurazione
     * @returns {Promise<Object>} Promise che si risolve con l'oggetto mappa
     */
    async function initMap(containerId, options = {}) {
        // Assicurati che Leaflet sia caricato
        await loadDependencies();
        if (typeof L === 'undefined') {
            await waitForLeaflet();
        }
        
        const defaults = {
            center: [45.4642, 9.1900], // Milano di default
            zoom: 13,
            route: null
        };
        
        const settings = { ...defaults, ...options };
        
        // Crea la mappa
        const map = L.map(containerId).setView(settings.center, settings.zoom);
        
        // Aggiungi il layer di OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Salva l'istanza della mappa
        mapInstances[containerId] = map;
        
        // Se sono state fornite informazioni sul percorso, mostralo
        if (settings.route) {
            showRoute(containerId, settings.route);
        }
        
        return map;
    }
    
    /**
     * Mostra un percorso sulla mappa
     * @public
     * @param {string} mapId - ID della mappa
     * @param {Object} route - Informazioni sul percorso
     * @returns {Object|null} Oggetti creati sulla mappa (marker, linea)
     */
    function showRoute(mapId, route) {
        const map = mapInstances[mapId];
        if (!map) return null;
        
        const { start, end } = route;
        
        // Aggiungi marker per il punto di partenza
        const startMarker = L.marker(start.coords).addTo(map);
        startMarker.bindPopup(`<b>${start.name}</b><br>${start.address}`);
        
        // Aggiungi marker per il punto di arrivo
        const endMarker = L.marker(end.coords).addTo(map);
        endMarker.bindPopup(`<b>${end.name}</b><br>${end.address}`);
        
        // Crea una linea che unisce i due punti (in un sistema reale utilizzeresti un API di routing)
        const routeLine = L.polyline([start.coords, end.coords], {
            color: '#FF5A5F',
            weight: 5,
            opacity: 0.7,
            dashArray: '10, 10',
            lineJoin: 'round'
        }).addTo(map);
        
        // Aggiungi un marker per la posizione attuale del driver (se disponibile)
        let driverMarker = null;
        if (route.currentPosition) {
            driverMarker = L.marker(route.currentPosition, {
                icon: L.divIcon({
                    className: 'driver-marker',
                    html: '<i class="fas fa-motorcycle"></i>',
                    iconSize: [30, 30],
                    iconAnchor: [15, 15]
                })
            }).addTo(map);
            
            driverMarker.bindPopup(`<b>Driver</b><br>In movimento`);
        }
        
        // Adatta la vista per includere tutto il percorso
        const bounds = routeLine.getBounds();
        map.fitBounds(bounds, { padding: [30, 30] });
        
        return { startMarker, endMarker, routeLine, driverMarker };
    }
    
    /**
     * Aggiorna la posizione del driver sulla mappa
     * @public
     * @param {string} mapId - ID della mappa
     * @param {Array} position - Coordinate [lat, lng]
     * @returns {Object|null} Marker del driver aggiornato o creato
     */
    function updateDriverPosition(mapId, position) {
        const map = mapInstances[mapId];
        if (!map) return null;
        
        // Trova il marker del driver esistente o creane uno nuovo
        let driverMarker = map._driverMarker;
        
        if (!driverMarker) {
            driverMarker = L.marker(position, {
                icon: L.divIcon({
                    className: 'driver-marker',
                    html: '<i class="fas fa-motorcycle"></i>',
                    iconSize: [30, 30],
                    iconAnchor: [15, 15]
                })
            }).addTo(map);
            
            map._driverMarker = driverMarker;
        } else {
            driverMarker.setLatLng(position);
        }
        
        return driverMarker;
    }
    
    /**
     * Aggiunge un marker del driver sulla mappa
     * @public
     * @param {string} mapId - ID della mappa
     * @param {string} address - Indirizzo del driver
     * @param {string} name - Nome del driver
     * @returns {Promise<Object|null>} Promise che si risolve con il marker del driver
     */
    async function addDriverMarker(mapId, address, name) {
        try {
            const position = await geocodeAddress(address);
            const map = mapInstances[mapId];
            
            if (!map || !position) return null;
            
            const driverMarker = L.marker(position, {
                icon: L.divIcon({
                    className: 'driver-marker',
                    html: '<i class="fas fa-motorcycle"></i>',
                    iconSize: [30, 30],
                    iconAnchor: [15, 15]
                })
            }).addTo(map);
            
            driverMarker.bindPopup(`<b>${name || 'Driver'}</b><br>${address}`);
            
            return driverMarker;
        } catch (error) {
            console.error('Errore nell\'aggiunta del marker del driver:', error);
            return null;
        }
    }
    
    /**
     * Geocodifica un indirizzo in coordinate
     * @public
     * @param {string} address - Indirizzo da geocodificare
     * @returns {Promise<Array|null>} Promise con le coordinate [lat, lng]
     */
    function geocodeAddress(address) {
        return fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    return [parseFloat(data[0].lat), parseFloat(data[0].lon)];
                }
                throw new Error('Indirizzo non trovato');
            });
    }
    
    /**
     * Calcola e visualizza un percorso tra due indirizzi
     * @public
     * @param {string} mapId - ID della mappa
     * @param {string} startAddress - Indirizzo di partenza
     * @param {string} endAddress - Indirizzo di arrivo
     * @param {string} startName - Nome del punto di partenza
     * @param {string} endName - Nome del punto di arrivo
     * @returns {Promise<Object|null>} Promise che si risolve con gli oggetti creati sulla mappa
     */
    async function showRouteByAddresses(mapId, startAddress, endAddress, startName = 'Partenza', endName = 'Arrivo') {
        try {
            const startCoords = await geocodeAddress(startAddress);
            const endCoords = await geocodeAddress(endAddress);
            
            if (!startCoords || !endCoords) return null;
            
            return showRoute(mapId, {
                start: {
                    name: startName,
                    address: startAddress,
                    coords: startCoords
                },
                end: {
                    name: endName,
                    address: endAddress,
                    coords: endCoords
                }
            });
        } catch (error) {
            console.error('Errore nel visualizzare il percorso:', error);
            return null;
        }
    }
    
    /**
     * Distrugge l'istanza di una mappa
     * @public
     * @param {string} mapId - ID della mappa da distruggere
     * @returns {boolean} True se la mappa è stata distrutta, false altrimenti
     */
    function destroyMap(mapId) {
        if (mapInstances[mapId]) {
            mapInstances[mapId].remove();
            delete mapInstances[mapId];
            return true;
        }
        return false;
    }
    
    /**
     * Ottiene un'istanza di mappa esistente
     * @public
     * @param {string} mapId - ID della mappa
     * @returns {Object|null} L'istanza della mappa o null se non esiste
     */
    function getMap(mapId) {
        return mapInstances[mapId] || null;
    }
    
    /**
     * Verifica se una mappa esiste
     * @public
     * @param {string} mapId - ID della mappa
     * @returns {boolean} True se la mappa esiste, false altrimenti
     */
    function hasMap(mapId) {
        return mapId in mapInstances;
    }
    
    // API pubblica
    return {
        initMap,
        showRoute,
        updateDriverPosition,
        addDriverMarker,
        geocodeAddress,
        showRouteByAddresses,
        destroyMap,
        getMap,
        hasMap
    };
})();

// Esposizione globale per mantenere la compatibilità con il codice esistente
window.mapHandler = {
    initMap: MapService.initMap,
    showRoute: MapService.showRoute,
    updateDriverPosition: MapService.updateDriverPosition,
    addDriverMarker: MapService.addDriverMarker,
    geocodeAddress: MapService.geocodeAddress,
    showRouteByAddresses: MapService.showRouteByAddresses,
    destroyMap: MapService.destroyMap
};