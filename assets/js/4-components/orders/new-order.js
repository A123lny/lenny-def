/**
 * new-order.js - Funzionalità per il modal di nuovo ordine
 */
document.addEventListener('DOMContentLoaded', function() {
    // Inizializzazione del datepicker per la data di consegna
    if (typeof flatpickr !== 'undefined') {
        flatpickr("#deliveryDate", {
            locale: "it",
            dateFormat: "d/m/Y",
            minDate: "today",
            disableMobile: true
        });
    }

    // Gestione del wizard per il nuovo ordine
    const prevStepBtn = document.getElementById('prevStepBtn');
    const nextStepBtn = document.getElementById('nextStepBtn');
    const saveOrderBtn = document.getElementById('saveOrderBtn');
    const progressSteps = document.querySelectorAll('.progress-step');
    const orderSteps = document.querySelectorAll('.order-step');
    let currentStep = 1;
    
    // Funzione per aggiornare i passi del wizard
    function updateWizardSteps() {
        progressSteps.forEach((step, index) => {
            const stepNum = index + 1;
            if (stepNum < currentStep) {
                step.classList.add('completed');
                step.classList.add('active');
            } else if (stepNum === currentStep) {
                step.classList.add('active');
                step.classList.remove('completed');
            } else {
                step.classList.remove('active');
                step.classList.remove('completed');
            }
        });
        
        orderSteps.forEach((step, index) => {
            const stepNum = index + 1;
            if (stepNum === currentStep) {
                step.style.display = '';
            } else {
                step.style.display = 'none';
            }
        });
        
        // Gestione dei pulsanti di navigazione
        if (currentStep === 1) {
            prevStepBtn.style.display = 'none';
        } else {
            prevStepBtn.style.display = '';
        }
        
        if (currentStep === orderSteps.length) {
            nextStepBtn.style.display = 'none';
            saveOrderBtn.style.display = '';
        } else {
            nextStepBtn.style.display = '';
            saveOrderBtn.style.display = 'none';
        }
    }
    
    // Evento per il pulsante "Avanti"
    if (nextStepBtn) {
        nextStepBtn.addEventListener('click', () => {
            // Validazione del passo corrente
            const currentStepEl = document.getElementById(`step${currentStep}`);
            const inputs = currentStepEl.querySelectorAll('input[required], select[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) return;
            
            // Avanza al passo successivo
            if (currentStep < orderSteps.length) {
                currentStep++;
                updateWizardSteps();
            }
        });
    }
    
    // Evento per il pulsante "Indietro"
    if (prevStepBtn) {
        prevStepBtn.addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                updateWizardSteps();
            }
        });
    }
    
    // Evento per il pulsante "Crea Ordine"
    if (saveOrderBtn) {
        saveOrderBtn.addEventListener('click', () => {
            // Validazione finale
            const form = document.getElementById('newOrderForm');
            
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }
            
            // Simulazione di salvataggio
            if (typeof window.showToast === 'function') {
                window.showToast('Successo', 'L\'ordine è stato creato correttamente', 'success');
            } else {
                alert('Ordine creato correttamente!');
            }
            
            // Chiudi il modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('newOrderModal'));
            modal.hide();
            
            // Reset form
            form.reset();
            form.classList.remove('was-validated');
            currentStep = 1;
            updateWizardSteps();
        });
    }
    
    // Simulazione di autocompletamento per i clienti
    initCustomerAutocomplete();
    
    // Simulazione di autocompletamento per i ristoranti
    initRestaurantAutocomplete();
    
    // Simulazione di autocompletamento per i prodotti
    initProductAutocomplete();
    
    // Genera fasce orarie di consegna
    generateDeliveryTimeSlots();
});

/**
 * Gestione dell'autocompletamento per i clienti
 */
function initCustomerAutocomplete() {
    const customerSearch = document.getElementById('customerSearch');
    const customerResults = document.getElementById('customerResults');
    const customerDetails = document.getElementById('customerDetails');
    const customerName = document.querySelector('.customer-name');
    const customerInfoText = document.querySelector('.customer-info-text');
    const changeCustomer = document.getElementById('changeCustomer');
    
    if (!customerSearch) return;
    
    customerSearch.addEventListener('input', () => {
        const query = customerSearch.value.toLowerCase();
        
        // Mostra risultati solo se la query ha almeno 2 caratteri
        if (query.length >= 2) {
            customerResults.style.display = 'block';
            customerResults.innerHTML = '';
            
            // Dati di esempio
            const customers = [
                { id: 1, name: 'Mario Rossi', info: '+39 345 123 4567' },
                { id: 2, name: 'Laura Bianchi', info: '+39 333 765 4321' },
                { id: 3, name: 'Giovanni Verdi', info: '+39 328 567 8901' },
                { id: 4, name: 'Francesca Neri', info: '+39 339 890 1234' }
            ];
            
            // Filtra i risultati
            const filtered = customers.filter(customer => 
                customer.name.toLowerCase().includes(query)
            );
            
            // Mostra i risultati
            filtered.forEach(customer => {
                const item = document.createElement('div');
                item.className = 'autocomplete-item';
                item.innerHTML = `
                    <div class="d-flex align-items-center justify-content-between">
                        <span>${customer.name}</span>
                        <span class="ms-auto text-muted">${customer.info}</span>
                    </div>
                `;
                
                item.addEventListener('click', () => {
                    // Seleziona questo cliente
                    document.getElementById('customerId').value = customer.id;
                    customerSearch.value = customer.name;
                    customerResults.style.display = 'none';
                    
                    // Mostra i dettagli del cliente selezionato
                    customerName.textContent = customer.name;
                    customerInfoText.textContent = customer.info;
                    customerDetails.style.display = 'block';
                    
                    // Nascondi il campo di ricerca
                    customerSearch.parentNode.style.display = 'none';
                });
                
                customerResults.appendChild(item);
            });
            
            // Messaggio se non ci sono risultati
            if (filtered.length === 0) {
                customerResults.innerHTML = '<div class="p-3 text-center text-muted">Nessun cliente trovato</div>';
            }
        } else {
            customerResults.style.display = 'none';
        }
    });
    
    // Chiudi i risultati quando si clicca fuori
    document.addEventListener('click', function(e) {
        if (!customerSearch.contains(e.target) && !customerResults.contains(e.target)) {
            customerResults.style.display = 'none';
        }
    });
    
    // Gestione del pulsante per cambiare cliente
    if (changeCustomer) {
        changeCustomer.addEventListener('click', function() {
            customerDetails.style.display = 'none';
            customerSearch.parentNode.style.display = '';
            customerSearch.value = '';
            document.getElementById('customerId').value = '';
        });
    }
}

/**
 * Gestione dell'autocompletamento per i ristoranti
 */
function initRestaurantAutocomplete() {
    const restaurantSearch = document.getElementById('restaurantSearch');
    const restaurantResults = document.getElementById('restaurantResults');
    const restaurantDetails = document.getElementById('restaurantDetails');
    const restaurantName = document.querySelector('.restaurant-name');
    const restaurantInfoText = document.querySelector('.restaurant-info-text');
    const changeRestaurant = document.getElementById('changeRestaurant');
    
    if (!restaurantSearch) return;
    
    restaurantSearch.addEventListener('input', () => {
        const query = restaurantSearch.value.toLowerCase();
        
        if (query.length >= 2) {
            restaurantResults.style.display = 'block';
            restaurantResults.innerHTML = '';
            
            // Dati di esempio
            const restaurants = [
                { id: 1, name: 'Pizzeria Napoli', info: 'Via Roma 123, Milano' },
                { id: 2, name: 'Burger King', info: 'Corso Vittorio Emanuele 25, Milano' },
                { id: 3, name: 'Pizzeria Da Mario', info: 'Via Dante 45, Milano' },
                { id: 4, name: 'Sushi Fusion', info: 'Via Torino 78, Milano' }
            ];
            
            // Filtra i risultati
            const filtered = restaurants.filter(restaurant => 
                restaurant.name.toLowerCase().includes(query)
            );
            
            // Mostra i risultati
            filtered.forEach(restaurant => {
                const item = document.createElement('div');
                item.className = 'autocomplete-item';
                item.innerHTML = `
                    <div class="d-flex align-items-center justify-content-between">
                        <span>${restaurant.name}</span>
                        <span class="ms-auto text-muted small">${restaurant.info}</span>
                    </div>
                `;
                
                item.addEventListener('click', () => {
                    document.getElementById('restaurantId').value = restaurant.id;
                    restaurantSearch.value = restaurant.name;
                    restaurantResults.style.display = 'none';
                    
                    restaurantName.textContent = restaurant.name;
                    restaurantInfoText.textContent = restaurant.info;
                    restaurantDetails.style.display = 'block';
                    
                    restaurantSearch.parentNode.style.display = 'none';
                });
                
                restaurantResults.appendChild(item);
            });
            
            if (filtered.length === 0) {
                restaurantResults.innerHTML = '<div class="p-3 text-center text-muted">Nessun ristorante trovato</div>';
            }
        } else {
            restaurantResults.style.display = 'none';
        }
    });
    
    document.addEventListener('click', function(e) {
        if (!restaurantSearch.contains(e.target) && !restaurantResults.contains(e.target)) {
            restaurantResults.style.display = 'none';
        }
    });
    
    if (changeRestaurant) {
        changeRestaurant.addEventListener('click', function() {
            restaurantDetails.style.display = 'none';
            restaurantSearch.parentNode.style.display = '';
            restaurantSearch.value = '';
            document.getElementById('restaurantId').value = '';
        });
    }
}

/**
 * Gestione dell'autocompletamento per i prodotti
 */
function initProductAutocomplete() {
    const productSearch = document.getElementById('productSearch');
    const productResults = document.getElementById('productResults');
    const orderItemsTable = document.getElementById('orderItemsTable');
    const noProductsRow = document.getElementById('noProductsRow');
    
    if (!productSearch || !orderItemsTable) return;
    
    productSearch.addEventListener('input', () => {
        const query = productSearch.value.toLowerCase();
        
        if (query.length >= 2) {
            productResults.style.display = 'block';
            productResults.innerHTML = '';
            
            // Dati di esempio
            const products = [
                { id: 1, name: 'Pizza Margherita', price: 8.50, category: 'Pizza' },
                { id: 2, name: 'Pizza Diavola', price: 10.00, category: 'Pizza' },
                { id: 3, name: 'Hamburger Classico', price: 9.50, category: 'Hamburger' },
                { id: 4, name: 'Patatine Fritte', price: 3.50, category: 'Contorni' },
                { id: 5, name: 'Insalata mista', price: 5.00, category: 'Insalate' },
                { id: 6, name: 'Coca Cola', price: 2.50, category: 'Bevande' }
            ];
            
            // Filtra i risultati
            const filtered = products.filter(product => 
                product.name.toLowerCase().includes(query) || 
                product.category.toLowerCase().includes(query)
            );
            
            // Mostra i risultati
            filtered.forEach(product => {
                const item = document.createElement('div');
                item.className = 'autocomplete-item';
                item.innerHTML = `
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div>${product.name}</div>
                            <div class="small text-muted">${product.category}</div>
                        </div>
                        <span class="badge bg-light text-dark">${product.price.toFixed(2)}€</span>
                    </div>
                `;
                
                item.addEventListener('click', () => {
                    productSearch.value = '';
                    productResults.style.display = 'none';
                    
                    // Verifica se il prodotto è già stato aggiunto
                    const existingRow = document.querySelector(`tr[data-product-id="${product.id}"]`);
                    
                    if (existingRow) {
                        // Incrementa la quantità se il prodotto esiste già
                        const quantityInput = existingRow.querySelector('.quantity-input');
                        const currentQty = parseInt(quantityInput.value);
                        quantityInput.value = currentQty + 1;
                        
                        // Aggiorna il totale della riga
                        const totalCell = existingRow.querySelector('.item-total');
                        totalCell.textContent = ((currentQty + 1) * product.price).toFixed(2) + '€';
                    } else {
                        // Aggiungi una nuova riga per il prodotto
                        const newRow = document.createElement('tr');
                        newRow.setAttribute('data-product-id', product.id);
                        newRow.setAttribute('data-price', product.price.toFixed(2));
                        newRow.innerHTML = `
                            <td class="item-name">${product.name}</td>
                            <td class="text-center">
                                <div class="quantity-group">
                                    <button type="button" class="quantity-btn minus">-</button>
                                    <input type="text" class="quantity-input" value="1" readonly>
                                    <button type="button" class="quantity-btn plus">+</button>
                                </div>
                            </td>
                            <td class="text-end">${product.price.toFixed(2)}€</td>
                            <td class="text-end item-total">${product.price.toFixed(2)}€</td>
                            <td>
                                <button type="button" class="remove-item">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        `;
                        
                        // Nascondi la riga "nessun prodotto"
                        if (noProductsRow) {
                            noProductsRow.style.display = 'none';
                        }
                        
                        // Aggiungi la nuova riga alla tabella
                        orderItemsTable.querySelector('tbody').appendChild(newRow);
                        
                        // Aggiungi event listener per i pulsanti quantità e rimozione
                        const minusBtn = newRow.querySelector('.minus');
                        const plusBtn = newRow.querySelector('.plus');
                        const removeBtn = newRow.querySelector('.remove-item');
                        const qtyInput = newRow.querySelector('.quantity-input');
                        
                        minusBtn.addEventListener('click', () => {
                            let qty = parseInt(qtyInput.value);
                            if (qty > 1) {
                                qtyInput.value = --qty;
                                newRow.querySelector('.item-total').textContent = (qty * product.price).toFixed(2) + '€';
                                updateOrderTotal();
                            }
                        });
                        
                        plusBtn.addEventListener('click', () => {
                            let qty = parseInt(qtyInput.value);
                            qtyInput.value = ++qty;
                            newRow.querySelector('.item-total').textContent = (qty * product.price).toFixed(2) + '€';
                            updateOrderTotal();
                        });
                        
                        removeBtn.addEventListener('click', () => {
                            newRow.remove();
                            
                            // Mostra la riga "nessun prodotto" se non ci sono più prodotti
                            const rows = orderItemsTable.querySelectorAll('tbody tr:not(#noProductsRow)');
                            if (rows.length === 0 && noProductsRow) {
                                noProductsRow.style.display = '';
                            }
                            
                            updateOrderTotal();
                        });
                    }
                    
                    // Aggiorna il totale dell'ordine
                    updateOrderTotal();
                });
                
                productResults.appendChild(item);
            });
            
            if (filtered.length === 0) {
                productResults.innerHTML = '<div class="p-3 text-center text-muted">Nessun prodotto trovato</div>';
            }
        } else {
            productResults.style.display = 'none';
        }
    });
    
    document.addEventListener('click', function(e) {
        if (!productSearch.contains(e.target) && !productResults.contains(e.target)) {
            productResults.style.display = 'none';
        }
    });
}

/**
 * Funzione per aggiornare il totale dell'ordine
 */
function updateOrderTotal() {
    const rows = document.querySelectorAll('#orderItemsTable tbody tr:not(#noProductsRow)');
    let subtotal = 0;
    
    rows.forEach(row => {
        const totalText = row.querySelector('.item-total').textContent;
        subtotal += parseFloat(totalText.replace('€', ''));
    });
    
    const deliveryFeeElement = document.getElementById('deliveryFee');
    const deliveryFee = deliveryFeeElement ? parseFloat(deliveryFeeElement.textContent.replace('€', '')) : 0;
    const total = subtotal + deliveryFee;
    
    const subtotalElement = document.getElementById('subtotalAmount');
    const totalElement = document.getElementById('totalAmount');
    
    if (subtotalElement) subtotalElement.textContent = subtotal.toFixed(2) + '€';
    if (totalElement) totalElement.textContent = total.toFixed(2) + '€';
}

/**
 * Genera le fasce orarie per la consegna
 */
function generateDeliveryTimeSlots() {
    const deliveryTimeSelect = document.getElementById('deliveryTime');
    
    if (!deliveryTimeSelect) return;
    
    // Genera fasce orarie dalle 10:00 alle 22:00 con intervalli di 30 minuti
    const startHour = 10;
    const endHour = 22;
    
    for (let hour = startHour; hour < endHour; hour++) {
        for (let minute = 0; minute < 60; minute += 30) {
            const startTime = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
            
            // Calcola l'orario di fine (30 minuti dopo)
            let endHour = hour;
            let endMinute = minute + 30;
            
            if (endMinute >= 60) {
                endHour++;
                endMinute -= 60;
            }
            
            // Se siamo arrivati all'ultimo slot, usciamo dal ciclo
            if (endHour >= endHour && endMinute > 0) break;
            
            const endTime = `${endHour.toString().padStart(2, '0')}:${endMinute.toString().padStart(2, '0')}`;
            const timeSlot = `${startTime} - ${endTime}`;
            
            const option = document.createElement('option');
            option.value = timeSlot;
            option.textContent = timeSlot;
            deliveryTimeSelect.appendChild(option);
        }
    }
}