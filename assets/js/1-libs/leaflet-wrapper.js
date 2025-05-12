/**
 * Leaflet Wrapper
 * Gestisce il caricamento e l'inizializzazione della libreria Leaflet
 * @module LeafletWrapper
 */

const LeafletWrapper = (function() {
    // Flag per verificare se Leaflet è stato caricato
    let isLoaded = false;
    let isLoading = false;
    let loadPromise = null;
    
    /**
     * Carica le dipendenze di Leaflet
     * @returns {Promise} - Si risolve quando Leaflet è caricato
     */
    function loadLeaflet() {
        if (isLoaded) {
            return Promise.resolve();
        }
        
        if (isLoading) {
            return loadPromise;
        }
        
        isLoading = true;
        loadPromise = new Promise((resolve, reject) => {
            try {
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
                if (!window.L && !document.querySelector('script[src*="leaflet.js"]')) {
                    const leafletScript = document.createElement('script');
                    leafletScript.src = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js';
                    leafletScript.integrity = 'sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==';
                    leafletScript.crossOrigin = '';
                    
                    leafletScript.onload = () => {
                        isLoaded = true;
                        isLoading = false;
                        console.log('Leaflet caricato con successo');
                        resolve();
                    };
                    
                    leafletScript.onerror = (err) => {
                        isLoading = false;
                        console.error('Errore nel caricamento di Leaflet:', err);
                        reject(new Error('Impossibile caricare Leaflet'));
                    };
                    
                    document.head.appendChild(leafletScript);
                } else if (window.L) {
                    // Leaflet è già disponibile globalmente
                    isLoaded = true;
                    isLoading = false;
                    resolve();
                } else {
                    // Leaflet è in caricamento ma non ancora pronto
                    const checkLeaflet = setInterval(() => {
                        if (window.L) {
                            clearInterval(checkLeaflet);
                            isLoaded = true;
                            isLoading = false;
                            resolve();
                        }
                    }, 100);
                    
                    // Timeout dopo 10 secondi
                    setTimeout(() => {
                        if (!isLoaded) {
                            clearInterval(checkLeaflet);
                            isLoading = false;
                            reject(new Error('Timeout durante il caricamento di Leaflet'));
                        }
                    }, 10000);
                }
            } catch (error) {
                isLoading = false;
                console.error('Errore durante il caricamento di Leaflet:', error);
                reject(error);
            }
        });
        
        return loadPromise;
    }
    
    /**
     * Verifica se Leaflet è stato caricato
     * @returns {boolean} - True se Leaflet è caricato
     */
    function isLeafletLoaded() {
        return isLoaded;
    }
    
    /**
     * Ottieni l'istanza globale di Leaflet
     * @returns {Object|null} - L'oggetto globale L di Leaflet o null
     */
    function getLeaflet() {
        return window.L || null;
    }
    
    // API pubblica
    return {
        load: loadLeaflet,
        isLoaded: isLeafletLoaded,
        getLeaflet: getLeaflet
    };
})();

// Esposizione globale per la compatibilità
window.LeafletWrapper = LeafletWrapper;