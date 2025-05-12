/**
 * Menu Page Module
 * Gestisce tutte le funzionalità specifiche della sezione menu
 * @module MenuPage
 */

const MenuPage = (function() {
    // Elementi DOM specifici della pagina menu
    let menuItems;
    let categoryFilters;
    let searchInput;
    let sortOptions;
    let categoryForm;
    let itemForm;
    
    /**
     * Inizializza il modulo
     */
    function init() {
        console.log('Inizializzazione modulo menu...');
        
        // Ottieni gli elementi DOM principali
        menuItems = document.querySelectorAll('.menu-item');
        categoryFilters = document.querySelectorAll('.category-filter');
        searchInput = document.getElementById('menuSearchInput');
        sortOptions = document.getElementById('sortOptions');
        categoryForm = document.getElementById('categoryForm');
        itemForm = document.getElementById('itemForm');
        
        // Inizializza componenti e funzionalità
        setupFilters();
        setupSearch();
        setupSorting();
        setupItemImagePreview();
        setupForms();
        setupDragAndDrop();
    }
    
    /**
     * Configura il sistema di filtri per categorie
     */
    function setupFilters() {
        if (!categoryFilters) return;
        
        categoryFilters.forEach(filter => {
            filter.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Rimuovi la classe attiva da tutti i filtri
                categoryFilters.forEach(f => f.classList.remove('active'));
                
                // Aggiungi la classe attiva al filtro cliccato
                this.classList.add('active');
                
                // Ottieni il valore del filtro
                const category = this.getAttribute('data-category');
                filterMenuItems(category);
            });
        });
    }
    
    /**
     * Filtra gli elementi del menu in base alla categoria
     * @param {string} category - Categoria da filtrare
     */
    function filterMenuItems(category) {
        if (!menuItems) return;
        
        menuItems.forEach(item => {
            if (category === 'all') {
                item.style.display = '';
            } else {
                const itemCategory = item.getAttribute('data-category');
                if (itemCategory === category) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            }
        });
        
        // Aggiorna i contatori di categoria
        updateCategoryCounts();
    }
    
    /**
     * Aggiorna i contatori di elementi visibili per categoria
     */
    function updateCategoryCounts() {
        const categories = {};
        let totalVisible = 0;
        
        // Conta gli elementi visibili per categoria
        menuItems.forEach(item => {
            if (item.style.display !== 'none') {
                const category = item.getAttribute('data-category');
                categories[category] = (categories[category] || 0) + 1;
                totalVisible++;
            }
        });
        
        // Aggiorna i contatori nell'interfaccia
        categoryFilters.forEach(filter => {
            const category = filter.getAttribute('data-category');
            const countElement = filter.querySelector('.count');
            
            if (countElement) {
                if (category === 'all') {
                    countElement.textContent = totalVisible;
                } else {
                    countElement.textContent = categories[category] || 0;
                }
            }
        });
    }
    
    /**
     * Configura la funzione di ricerca
     */
    function setupSearch() {
        if (!searchInput) return;
        
        searchInput.addEventListener('input', function() {
            const searchValue = this.value.trim().toLowerCase();
            
            if (!menuItems) return;
            
            if (searchValue === '') {
                // Ripristina il filtro attivo
                const activeFilter = document.querySelector('.category-filter.active');
                if (activeFilter) {
                    const category = activeFilter.getAttribute('data-category');
                    filterMenuItems(category);
                } else {
                    menuItems.forEach(item => {
                        item.style.display = '';
                    });
                }
                return;
            }
            
            menuItems.forEach(item => {
                const itemName = item.querySelector('.menu-item-name')?.textContent.toLowerCase() || '';
                const itemDescription = item.querySelector('.menu-item-description')?.textContent.toLowerCase() || '';
                
                if (itemName.includes(searchValue) || itemDescription.includes(searchValue)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Aggiorna i contatori
            updateCategoryCounts();
        });
    }
    
    /**
     * Configura l'ordinamento degli elementi del menu
     */
    function setupSorting() {
        if (!sortOptions) return;
        
        sortOptions.addEventListener('change', function() {
            const sortValue = this.value;
            
            if (!menuItems || menuItems.length === 0) return;
            
            // Converti NodeList in array per poterlo ordinare
            const itemsArray = Array.from(menuItems);
            
            switch (sortValue) {
                case 'name-asc':
                    sortMenuItems(itemsArray, (a, b) => {
                        const nameA = a.querySelector('.menu-item-name')?.textContent || '';
                        const nameB = b.querySelector('.menu-item-name')?.textContent || '';
                        return nameA.localeCompare(nameB);
                    });
                    break;
                case 'name-desc':
                    sortMenuItems(itemsArray, (a, b) => {
                        const nameA = a.querySelector('.menu-item-name')?.textContent || '';
                        const nameB = b.querySelector('.menu-item-name')?.textContent || '';
                        return nameB.localeCompare(nameA);
                    });
                    break;
                case 'price-asc':
                    sortMenuItems(itemsArray, (a, b) => {
                        const priceA = parseFloat(a.getAttribute('data-price') || '0');
                        const priceB = parseFloat(b.getAttribute('data-price') || '0');
                        return priceA - priceB;
                    });
                    break;
                case 'price-desc':
                    sortMenuItems(itemsArray, (a, b) => {
                        const priceA = parseFloat(a.getAttribute('data-price') || '0');
                        const priceB = parseFloat(b.getAttribute('data-price') || '0');
                        return priceB - priceA;
                    });
                    break;
                case 'popularity':
                    sortMenuItems(itemsArray, (a, b) => {
                        const popularityA = parseInt(a.getAttribute('data-popularity') || '0');
                        const popularityB = parseInt(b.getAttribute('data-popularity') || '0');
                        return popularityB - popularityA; // Ordine decrescente per popolarità
                    });
                    break;
                default:
                    // Ripristina l'ordine originale
                    const container = menuItems[0].parentNode;
                    const originalItems = container.querySelectorAll('[data-original-index]');
                    
                    sortMenuItems(Array.from(originalItems), (a, b) => {
                        const indexA = parseInt(a.getAttribute('data-original-index') || '0');
                        const indexB = parseInt(b.getAttribute('data-original-index') || '0');
                        return indexA - indexB;
                    });
                    break;
            }
        });
    }
    
    /**
     * Ordina gli elementi del menu in base al criterio specificato
     * @param {Array} items - Array di elementi del menu
     * @param {Function} compareFn - Funzione di confronto per l'ordinamento
     */
    function sortMenuItems(items, compareFn) {
        if (!items || items.length === 0) return;
        
        // Salva l'indice originale se non è già stato fatto
        if (!items[0].hasAttribute('data-original-index')) {
            items.forEach((item, index) => {
                item.setAttribute('data-original-index', index);
            });
        }
        
        // Ordina gli elementi
        items.sort(compareFn);
        
        // Aggiorna il DOM
        const container = items[0].parentNode;
        items.forEach(item => {
            container.appendChild(item);
        });
    }
    
    /**
     * Configura l'anteprima delle immagini per i prodotti del menu
     */
    function setupItemImagePreview() {
        const imageInput = document.getElementById('itemImage');
        const previewContainer = document.getElementById('imagePreview');
        
        if (!imageInput || !previewContainer) return;
        
        imageInput.addEventListener('change', function() {
            // Pulisce l'anteprima precedente
            previewContainer.innerHTML = '';
            
            // Controlla se ci sono file selezionati
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Crea l'elemento di anteprima
                    const imgPreview = document.createElement('div');
                    imgPreview.className = 'image-preview-item';
                    imgPreview.innerHTML = `
                        <img src="${e.target.result}" alt="Anteprima" class="img-fluid rounded">
                        <button type="button" class="btn btn-sm btn-danger remove-image">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    
                    // Aggiunge l'anteprima al container
                    previewContainer.appendChild(imgPreview);
                    
                    // Aggiunge l'evento per rimuovere l'immagine
                    const removeButton = imgPreview.querySelector('.remove-image');
                    removeButton.addEventListener('click', function() {
                        imgPreview.remove();
                        imageInput.value = ''; // Resetta l'input file
                    });
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
    
    /**
     * Configura i form per gestire categorie e prodotti
     */
    function setupForms() {
        // Form categorie
        if (categoryForm) {
            categoryForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const categoryName = document.getElementById('categoryName').value;
                const categoryDescription = document.getElementById('categoryDescription').value;
                
                if (!categoryName) {
                    showFormError(categoryForm, 'Il nome della categoria è obbligatorio');
                    return;
                }
                
                // Qui invieresti i dati al server via AJAX
                console.log('Invio dati categoria:', { categoryName, categoryDescription });
                
                // Simuliamo il successo
                window.showToast('Categoria salvata', 'La categoria è stata salvata con successo', 'success');
                
                // Reset del form
                this.reset();
            });
        }
        
        // Form prodotti
        if (itemForm) {
            itemForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const itemName = document.getElementById('itemName').value;
                const itemPrice = document.getElementById('itemPrice').value;
                const itemCategory = document.getElementById('itemCategory').value;
                const itemDescription = document.getElementById('itemDescription').value;
                
                if (!itemName || !itemPrice || !itemCategory) {
                    showFormError(itemForm, 'Tutti i campi obbligatori devono essere compilati');
                    return;
                }
                
                // Qui invieresti i dati al server via AJAX
                console.log('Invio dati prodotto:', { 
                    itemName, 
                    itemPrice, 
                    itemCategory, 
                    itemDescription 
                });
                
                // Simuliamo il successo
                window.showToast('Prodotto salvato', 'Il prodotto è stato salvato con successo', 'success');
                
                // Reset del form
                this.reset();
                
                // Pulisci l'anteprima dell'immagine
                const previewContainer = document.getElementById('imagePreview');
                if (previewContainer) {
                    previewContainer.innerHTML = '';
                }
            });
        }
    }
    
    /**
     * Mostra un errore nel form
     * @param {HTMLElement} form - Form in cui mostrare l'errore
     * @param {string} message - Messaggio di errore
     */
    function showFormError(form, message) {
        // Cerca un contenitore di errore esistente o ne crea uno nuovo
        let errorContainer = form.querySelector('.form-error');
        
        if (!errorContainer) {
            errorContainer = document.createElement('div');
            errorContainer.className = 'alert alert-danger mt-3 form-error';
            form.appendChild(errorContainer);
        }
        
        errorContainer.textContent = message;
        errorContainer.style.display = 'block';
        
        // Nascondi l'errore dopo 5 secondi
        setTimeout(() => {
            errorContainer.style.display = 'none';
        }, 5000);
    }
    
    /**
     * Configura il drag and drop per riordinare gli elementi del menu
     */
    function setupDragAndDrop() {
        // Verifica se la libreria Sortable è disponibile
        if (typeof Sortable === 'undefined') return;
        
        const menuContainer = document.querySelector('.menu-items-container');
        
        if (!menuContainer) return;
        
        // Inizializza Sortable
        const sortable = Sortable.create(menuContainer, {
            animation: 150,
            ghostClass: 'menu-item-ghost',
            chosenClass: 'menu-item-chosen',
            dragClass: 'menu-item-drag',
            handle: '.menu-item-drag-handle',
            onEnd: function() {
                // Qui potresti salvare il nuovo ordine via AJAX
                console.log('Nuovo ordine salvato');
                
                // Mostra un feedback
                window.showToast('Ordine aggiornato', 'L\'ordine degli elementi è stato aggiornato', 'info');
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
    if (controller === 'menu') {
        MenuPage.init();
    }
});

// Risponde anche all'evento personalizzato di caricamento della pagina
document.addEventListener('pageContentLoaded', function(e) {
    if (e.detail.controller === 'menu') {
        MenuPage.init();
    }
});