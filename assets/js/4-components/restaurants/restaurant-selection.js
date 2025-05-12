/**
 * Restaurant Selection Component
 * Gestisce la funzionalità del modal di selezione ristoranti
 * @module RestaurantSelectionComponent
 */

const RestaurantSelectionComponent = (function() {
    // Variabili private del componente
    let modal;
    let searchInput;
    let alphaFilter;
    let restaurantCards;
    let noResultsMessage;
    let currentLetter = 'all';

    /**
     * Inizializza il componente
     * @public
     */
    function init() {
        // Inizializza riferimenti agli elementi DOM
        modal = document.getElementById('selectRestaurantModal');
        searchInput = document.getElementById('modalSearchRestaurant');
        alphaFilter = document.querySelector('.alpha-filter-container');
        restaurantCards = document.querySelectorAll('.restaurant-card');
        noResultsMessage = document.getElementById('noResultsMessage');
        
        if (!modal) {
            console.error('Select restaurant modal not found');
            return;
        }
        
        // Inizializza i listener degli eventi
        initSearchFilter();
        initAlphabeticalFilter();
        initRestaurantCards();
        setupModalEvents();
        
        console.log('Restaurant selection component initialized');
    }
    
    /**
     * Inizializza il filtro di ricerca
     * @private
     */
    function initSearchFilter() {
        if (!searchInput) return;
        
        searchInput.addEventListener('input', function() {
            filterRestaurants();
        });
    }
    
    /**
     * Inizializza il filtro alfabetico
     * @private
     */
    function initAlphabeticalFilter() {
        if (!alphaFilter) return;
        
        const alphaItems = alphaFilter.querySelectorAll('.alpha-item');
        
        alphaItems.forEach(item => {
            item.addEventListener('click', function() {
                // Rimuovi la classe active da tutti gli elementi
                alphaItems.forEach(i => i.classList.remove('active'));
                
                // Aggiungi la classe active a questo elemento
                this.classList.add('active');
                
                // Aggiorna la lettera corrente
                currentLetter = this.getAttribute('data-letter');
                
                // Filtra i ristoranti
                filterRestaurants();
            });
        });
    }
    
    /**
     * Inizializza l'interazione con le card dei ristoranti
     * @private
     */
    function initRestaurantCards() {
        if (!restaurantCards || !restaurantCards.length) return;
        
        restaurantCards.forEach(card => {
            // Imposto il cursore default sulla card (non cliccabile)
            card.style.cursor = "default";
            
            // Gestisco solo il click sui pulsanti "Gestisci"
            const manageBtn = card.querySelector(".manage-restaurant-btn");
            if (manageBtn) {
                manageBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const restaurantId = this.getAttribute("data-id");
                    
                    // Recupera i dati del ristorante dal dataset globale
                    const restaurantData = window.restaurantData || [];
                    const selectedRestaurant = restaurantData.find(r => r.id == restaurantId);
                    
                    if (selectedRestaurant) {
                        // Usa la funzione esistente per gestire il ristorante
                        if (typeof window.showRestaurantManagement === 'function') {
                            window.showRestaurantManagement(selectedRestaurant);
                        } else {
                            console.error('showRestaurantManagement function not found');
                        }
                    }
                });
            }
        });
    }
    
    /**
     * Configura gli eventi del modal
     * @private
     */
    function setupModalEvents() {
        if (!modal) return;
        
        modal.addEventListener('shown.bs.modal', function() {
            // Reset della ricerca e focus sull'input
            if (searchInput) {
                searchInput.value = '';
                searchInput.focus();
            }
            
            // Reset del filtro alfabetico
            const alphaItems = alphaFilter.querySelectorAll('.alpha-item');
            alphaItems.forEach(i => {
                if (i.getAttribute('data-letter') === 'all') {
                    i.classList.add('active');
                } else {
                    i.classList.remove('active');
                }
            });
            
            // Reset alla visualizzazione di tutti i ristoranti
            currentLetter = 'all';
            filterRestaurants();
        });
    }
    
    /**
     * Filtra i ristoranti in base alla ricerca e al filtro alfabetico
     * @private
     */
    function filterRestaurants() {
        if (!searchInput || !restaurantCards.length) return;
        
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;
        
        restaurantCards.forEach(card => {
            const restaurantName = card.getAttribute('data-name');
            const letterFilter = card.getAttribute('data-letter');
            
            let isVisible = restaurantName.includes(searchTerm);
            
            // Applica filtro alfabetico se non è "all"
            if (isVisible && currentLetter !== 'all') {
                isVisible = letterFilter === currentLetter;
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
     * Resetta filtri e visualizza tutti i ristoranti
     * @public
     */
    function resetFilters() {
        if (searchInput) {
            searchInput.value = '';
        }
        
        currentLetter = 'all';
        
        const alphaItems = alphaFilter.querySelectorAll('.alpha-item');
        alphaItems.forEach(i => {
            if (i.getAttribute('data-letter') === 'all') {
                i.classList.add('active');
            } else {
                i.classList.remove('active');
            }
        });
        
        filterRestaurants();
    }
    
    // API pubblica del componente
    return {
        init: init,
        resetFilters: resetFilters
    };
})();

// Inizializzazione del componente quando il DOM è pronto
document.addEventListener('DOMContentLoaded', function() {
    // Inizializza il componente solo se il modal è presente nella pagina
    if (document.getElementById('selectRestaurantModal')) {
        RestaurantSelectionComponent.init();
        
        // Rendi disponibile globalmente per l'integrazione con altri componenti
        window.RestaurantSelectionComponent = RestaurantSelectionComponent;
    }
});