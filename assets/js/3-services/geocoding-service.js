/**
 * Geocoding Service
 * Servizio per la geocodifica e la geocodifica inversa degli indirizzi
 * Utilizza il map-service.js esistente e lo estende con funzionalità aggiuntive
 * @module GeocodingService
 */

const GeocodingService = (function() {
    // Verifica se window.mapHandler è disponibile (assicura che map-service.js sia caricato)
    function checkMapService() {
        if (typeof window.mapHandler === 'undefined') {
            throw new Error('MapHandlerService non disponibile. Assicurati che map-service.js sia caricato.');
        }
    }
    
    /**
     * Geocodifica un indirizzo in coordinate
     * @public
     * @param {string} address - Indirizzo da geocodificare
     * @returns {Promise<Array>} Promise che si risolve con le coordinate [lat, lng]
     */
    function geocodeAddress(address) {
        checkMapService();
        return window.mapHandler.geocodeAddress(address);
    }
    
    /**
     * Geocodifica inversa - converte coordinate in indirizzo
     * @public
     * @param {Array} coords - Coordinate [lat, lng]
     * @returns {Promise<Object>} Promise con i dettagli dell'indirizzo
     */
    function reverseGeocode(coords) {
        return fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${coords[0]}&lon=${coords[1]}&addressdetails=1`)
            .then(response => response.json())
            .then(data => {
                if (!data || !data.address) {
                    throw new Error('Nessun risultato trovato');
                }
                
                // Estrai i dettagli dell'indirizzo
                const address = data.address;
                
                // Componi il nome della strada
                let street = address.road || '';
                if (address.house_number) {
                    street += ' ' + address.house_number;
                }
                
                return {
                    street: street,
                    city: address.city || address.town || address.village || address.hamlet || '',
                    state: address.state || address.county || '',
                    postalcode: address.postcode || '',
                    country: address.country || 'San Marino',
                    display_name: data.display_name
                };
            });
    }
    
    /**
     * Aggiorna i campi di un form con i dati di un indirizzo
     * @public
     * @param {Object} addressDetails - Dettagli dell'indirizzo
     * @param {Object} formFields - Riferimenti ai campi del form
     */
    function updateAddressFields(addressDetails, formFields) {
        if (formFields.street && addressDetails.street) {
            formFields.street.value = addressDetails.street;
            formFields.street.classList.add('is-valid');
        }
        
        if (formFields.city && addressDetails.city) {
            formFields.city.value = addressDetails.city;
            formFields.city.classList.add('is-valid');
        }
        
        if (formFields.zipCode && addressDetails.postalcode) {
            formFields.zipCode.value = addressDetails.postalcode;
            formFields.zipCode.classList.add('is-valid');
        }
        
        if (formFields.province && addressDetails.state) {
            formFields.province.value = addressDetails.state;
            formFields.province.classList.add('is-valid');
        }
    }
    
    /**
     * Cerca una posizione con un termine di ricerca e un contesto geografico
     * @public
     * @param {string} searchTerm - Termine di ricerca
     * @param {string} context - Contesto geografico per migliorare la precisione (es. "Italia")
     * @returns {Promise<Object>} Promise con risultati della ricerca
     */
    function searchLocation(searchTerm, context = '') {
        const query = context ? `${searchTerm}, ${context}` : searchTerm;
        return geocodeAddress(query)
            .then(coords => {
                return reverseGeocode(coords)
                    .then(addressDetails => {
                        return {
                            coords: coords,
                            details: addressDetails
                        };
                    });
            });
    }
    
    // API pubblica
    return {
        geocodeAddress,
        reverseGeocode,
        updateAddressFields,
        searchLocation
    };
})();

// Esposizione globale
window.geocodingService = GeocodingService;