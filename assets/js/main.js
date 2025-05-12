/**
 * Lenny Food Delivery - JavaScript principale
 * Questo file coordina l'inizializzazione di tutti i moduli dell'applicazione
 */

const LennyApp = (function() {
    // Ordine di caricamento dei moduli
    const moduleLoadOrder = [
        // Librerie
        { path: '1-libs/leaflet-wrapper.js', condition: () => document.querySelector('#map-container') !== null },
        
        // Utility
        { path: '2-utils/dom-utils.js', condition: () => true },
        { path: '2-utils/format-utils.js', condition: () => true },
        
        // Servizi
        { path: '3-services/map-service.js', condition: () => document.querySelector('#map-container') !== null },
        { path: '3-services/notification-service.js', condition: () => document.querySelector('.notification-btn') !== null },
        
        // Componenti UI
        { path: '4-components/sidebar.js', condition: () => document.querySelector('#sidebar') !== null },
        { path: '4-components/toast.js', condition: () => true }
    ];
    
    // Moduli caricati
    const loadedModules = {};
    
    /**
     * Inizializza l'applicazione
     */
    function init() {
        document.addEventListener('DOMContentLoaded', function() {
            // Carica i moduli base necessari
            loadCoreModules().then(() => {
                // Inizializza tutti i moduli e componenti
                initComponents();
                
                // Carica e inizializza moduli specifici per la pagina
                initPageSpecificModules();
                
                // Imposta gli ascoltatori di eventi globali
                setupEventListeners();
                
                console.log('Lenny App inizializzata con successo');
            }).catch(error => {
                console.error('Errore durante l\'inizializzazione dell\'applicazione:', error);
            });
        });
    }
    
    /**
     * Carica i moduli principali dell'applicazione
     */
    async function loadCoreModules() {
        try {
            const modulePromises = moduleLoadOrder.map(module => {
                if (module.condition()) {
                    return loadModule(module.path);
                } else {
                    return Promise.resolve();
                }
            });
            
            await Promise.all(modulePromises);
            return true;
        } catch (error) {
            console.error('Errore nel caricamento dei moduli core:', error);
            throw error;
        }
    }
    
    /**
     * Inizializza i componenti UI principali
     */
    function initComponents() {
        // I componenti si auto-inizializzano quando vengono caricati
        
        // Inizializza i tooltip di Bootstrap
        if (typeof DOMUtils !== 'undefined') {
            DOMUtils.initTooltips();
        }
        
        // Inizializza i toast
        initToasts();
        
        // Inizializza le animazioni globali
        initAnimations();
    }
    
    /**
     * Inizializza i toast globali
     */
    function initToasts() {
        // Assicurati che la funzione window.showToast sia disponibile
        if (typeof window.showToast !== 'function' && 
            typeof ToastComponent !== 'undefined' && 
            typeof ToastComponent.show === 'function') {
            window.showToast = ToastComponent.show;
            console.log('Toast component initialized successfully');
        }
    }
    
    /**
     * Inizializza le animazioni UI globali
     */
    function initAnimations() {
        // Gestisci animazioni per le card statistiche
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('animate__animated', 'animate__fadeInUp');
        });
        
        // Aggiungi effetti hover sulle card
        const cards = document.querySelectorAll('.card');
        if (typeof DOMUtils !== 'undefined') {
            cards.forEach(card => {
                DOMUtils.applyHoverEffect(card);
            });
        } else {
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = 'var(--shadow-md)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                    this.style.boxShadow = '';
                });
            });
        }
        
        // Effetto ripple sui pulsanti
        const buttons = document.querySelectorAll('.btn');
        if (typeof DOMUtils !== 'undefined') {
            buttons.forEach(btn => {
                btn.addEventListener('click', DOMUtils.createRippleEffect);
            });
        } else {
            buttons.forEach(btn => {
                btn.addEventListener('click', createRippleEffect);
            });
        }
    }
    
    /**
     * Crea l'effetto ondulazione sui pulsanti (fallback se DOMUtils non è disponibile)
     */
    function createRippleEffect(e) {
        const btn = this;
        
        // Rimuovi eventuali effetti precedenti
        const ripples = btn.querySelectorAll('.ripple');
        ripples.forEach(ripple => ripple.remove());
        
        // Crea nuovo elemento per l'effetto
        const circle = document.createElement('span');
        circle.classList.add('ripple');
        btn.appendChild(circle);
        
        // Posiziona e dimensiona l'effetto
        const d = Math.max(btn.clientWidth, btn.clientHeight);
        circle.style.width = circle.style.height = `${d}px`;
        
        const rect = btn.getBoundingClientRect();
        circle.style.left = `${e.clientX - rect.left - d/2}px`;
        circle.style.top = `${e.clientY - rect.top - d/2}px`;
        
        // Aggiungi classe per l'animazione
        circle.classList.add('animate');
        
        // Rimuovi l'elemento dopo l'animazione
        setTimeout(() => {
            circle.remove();
        }, 600);
    }
    
    /**
     * Carica i moduli specifici per la pagina corrente
     */
    function initPageSpecificModules() {
        // I moduli specifici per pagina vengono ora caricati tramite l'array $page_scripts nei controller PHP
        // Questa funzione rimane solo per retrocompatibilità o per logiche aggiuntive
        // Non carica più moduli specifici in base al controller per evitare duplicazioni
        
        // Emette un evento per notificare che la pagina è stata caricata
        const controller = getUrlParam('controller');
        const action = getUrlParam('action') || 'index';
        
        if (controller) {
            document.dispatchEvent(new CustomEvent('pageContentLoaded', {
                detail: { controller, action }
            }));
        }
    }
    
    /**
     * Ottiene un parametro dalla query string (fallback se DOMUtils non è disponibile)
     */
    function getUrlParam(param) {
        if (typeof DOMUtils !== 'undefined' && DOMUtils.getUrlParam) {
            return DOMUtils.getUrlParam(param);
        }
        
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }
    
    /**
     * Carica dinamicamente un modulo JavaScript
     * @param {string} path - Percorso del file da caricare
     * @returns {Promise} Promise che si risolve quando il modulo è caricato
     */
    function loadModule(path) {
        return new Promise((resolve, reject) => {
            // Verifica se il modulo è già stato caricato
            if (loadedModules[path]) {
                resolve();
                return;
            }
            
            if (document.querySelector(`script[src*="${path}"]`)) {
                loadedModules[path] = true;
                resolve();
                return;
            }
            
            const script = document.createElement('script');
            script.src = `assets/js/${path}`;
            script.async = true;
            
            script.onload = () => {
                loadedModules[path] = true;
                resolve();
            };
            
            script.onerror = () => reject(new Error(`Impossibile caricare il modulo: ${path}`));
            
            document.head.appendChild(script);
        });
    }
    
    /**
     * Configura gli ascoltatori di eventi globali
     */
    function setupEventListeners() {
        // Gestisci eventi di navigazione con pulsanti indietro/avanti
        window.addEventListener('popstate', function() {
            // Ricarica la pagina quando l'utente usa i pulsanti indietro/avanti
            window.location.reload();
        });
        
        // Ascoltatore per eventi personalizzati di caricamento pagina
        document.addEventListener('pageContentLoaded', function(e) {
            const { controller, action } = e.detail;
            console.log(`Pagina caricata: ${controller}/${action}`);
            
            // Reinizializza i componenti sulla nuova pagina
            if (typeof DOMUtils !== 'undefined') {
                DOMUtils.initTooltips();
            }
            
            initAnimations();
        });
        
        // Listener globale per l'apertura del modal di gestione ristorante
        document.addEventListener('click', function(e) {
            // Trova il pulsante che apre il modal di gestione ristorante
            if (e.target.closest('[data-open-restaurant-management]') || 
                e.target.closest('.manage-restaurant-btn')) {
                e.preventDefault();
                loadRestaurantManagementModal();
            }
        });
    }
    
    /**
     * Carica dinamicamente il modal di gestione ristorante
     */
    function loadRestaurantManagementModal() {
        // Carica direttamente il file JS del modal usando loadModule
        loadModule('4-components/restaurants/restaurant-management.js')
            .then(() => {
                console.log('Restaurant Management Modal JS caricato con successo');
                // Inizializza il modal dopo il caricamento
                if (window.RestaurantManagement && typeof window.RestaurantManagement.init === 'function') {
                    window.RestaurantManagement.init();
                }
            })
            .catch(error => {
                console.error('Errore durante il caricamento del modal:', error);
            });
    }
    
    // API pubblica
    return {
        init
    };
})();

// Inizializza l'applicazione
LennyApp.init();