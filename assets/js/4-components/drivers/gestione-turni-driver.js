/**
 * Gestione Turni Driver - Component
 * Script per la gestione delle funzionalità del componente turni driver
 */

const GestioneTurniDriver = (function() {
    // Flag per controllare se lo script è già stato inizializzato
    let initialized = false;

    // Variabili modulo
    let turniModificati = false; // Flag per tenere traccia delle modifiche non salvate
    let regoleSovraccarico = {
        mattina: 2,   // Sovraccarico se più di 2 driver per turno mattina
        pranzo: 2,    // Sovraccarico se più di 2 driver per turno pranzo
        pomeriggio: 1, // Sovraccarico se più di 1 driver per turno pomeriggio
        cena: 2       // Sovraccarico se più di 2 driver per turno cena
    };    let regoleCarenza = {
        mattina: 1,   // Carenza se meno di 1 driver per turno mattina
        pranzo: 1,    // Carenza se meno di 1 driver per turno pranzo
        pomeriggio: 1, // Carenza se meno di 1 driver per turno pomeriggio
        cena: 1       // Carenza se meno di 1 driver per turno cena
    };

    /**
     * Funzione per aggiungere un elemento vacancy a una cella
     * @param {HTMLElement} cell - La cella a cui aggiungere l'elemento vacancy
     */
    function addVacancyToCell(cell) {
        // Verifica se la cella già contiene un elemento vacancy
        const existingVacancy = cell.querySelector('.shift-vacancy');
        if (existingVacancy) return;
        
        // Crea l'elemento vacancy
        const vacancy = document.createElement('div');
        vacancy.className = 'shift-vacancy';
        vacancy.innerHTML = '<span class="shift-vacancy-icon"><i class="fas fa-user-plus"></i></span>';
        
        // Aggiungi l'evento click all'elemento vacancy
        vacancy.addEventListener('click', function() {
            // Ottieni informazioni sulla cella
            const cellElement = this.closest('.shift-cell');
            const day = cellElement.getAttribute('data-day');
            const shift = cellElement.getAttribute('data-shift');
            
            // Apri il modal per creare un nuovo turno
            const modal = document.getElementById('creaTurnoModal');
            if (modal) {
                // Pre-compila i campi
                const turnoGiorno = document.getElementById('turnoGiorno');
                const turnoFascia = document.getElementById('turnoFascia');
                
                if (turnoGiorno) turnoGiorno.value = day;
                if (turnoFascia) turnoFascia.value = shift;
                
                // Mostra il modal
                const modalInstance = new bootstrap.Modal(modal);
                modalInstance.show();
            }
        });
        
        // Aggiungi l'elemento vacancy alla cella
        cell.appendChild(vacancy);
    }

    /**
     * Inizializza i componenti necessari
     */
    function initializeComponents() {
        console.log('Inizializzazione componenti turni');
        
        // Inizializziamo i tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Inizializziamo i popover
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    }    /**
     * Configura la selezione della vista settimanale/giornaliera
     */
    function setupViewToggle() {
        // Rimozione degli event listener precedenti
        document.querySelectorAll('[data-view]').forEach(btn => {
            const newBtn = btn.cloneNode(true);
            btn.parentNode.replaceChild(newBtn, btn);
        });
        
        // Aggiunta dei nuovi listener
        const viewButtons = document.querySelectorAll('.period-btn[data-view]');
        const views = document.querySelectorAll('.shift-view');
        
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Rimuovi active da tutti i pulsanti
                viewButtons.forEach(btn => btn.classList.remove('active'));
                
                // Aggiungi active al pulsante cliccato
                this.classList.add('active');
                
                // Ottieni la vista da mostrare
                const viewType = this.getAttribute('data-view');
                
                // Nascondi tutte le viste e mostra quella selezionata
                setTimeout(() => {
                    views.forEach(view => {
                        // Nascondiamo tutte le viste
                        view.classList.remove('active');
                        
                        // Disabilitiamo le animazioni durante il cambio di vista
                        view.style.animation = 'none';
                    });
                    
                    // Mostriamo la vista selezionata
                    if (viewType === 'week') {
                        document.getElementById('weeklyView').classList.add('active');
                    } else if (viewType === 'day') {
                        document.getElementById('dailyView').classList.add('active');
                        // Inizializza i pulsanti di azione per la vista giornaliera
                        initDailyViewButtons();
                    }
                    
                    // Ripristiniamo le animazioni dopo un breve delay
                    setTimeout(() => {
                        views.forEach(view => {
                            view.style.animation = '';
                        });
                    }, 50);
                }, 0);
            });
        });
    }    /**
     * Configura la navigazione tra periodi (settimane o giorni)
     */
    function setupPeriodNavigation() {
        // Helper per rimuovere e riconfigurare event listener
        function replaceElement(selector) {
            const element = document.querySelector(selector);
            if (!element) return null;
            
            const newElement = element.cloneNode(true);
            if (element.parentNode) {
                element.parentNode.replaceChild(newElement, element);
            }
            return newElement;
        }
          
        // Navigazione periodi (settimanali o giornalieri)
        const prevPeriod = replaceElement('.prev-period');
        const nextPeriod = replaceElement('.next-period');
        const weekTitle = document.querySelector('.week-title');
        
        if (prevPeriod && nextPeriod) {
            // Imposta la data iniziale alla data corrente
            let currentDate = new Date();
            
            // Inizialmente aggiorna il testo del periodo in base alla vista attiva
            if (document.getElementById('weeklyView').classList.contains('active')) {
                updateWeeklyPeriodText(currentDate, weekTitle);
            } else {
                updateDailyPeriodText(currentDate, weekTitle);
            }
            
            // Aggiungi listener per i pulsanti di navigazione
            prevPeriod.addEventListener('click', function() {
                if (document.getElementById('weeklyView').classList.contains('active')) {
                    // In vista settimanale, naviga di 7 giorni
                    currentDate.setDate(currentDate.getDate() - 7);
                    updateWeeklyPeriodText(currentDate, weekTitle);
                } else {
                    // In vista giornaliera, naviga di 1 giorno
                    currentDate.setDate(currentDate.getDate() - 1);
                    updateDailyPeriodText(currentDate, weekTitle);
                }
            });
            
            nextPeriod.addEventListener('click', function() {
                if (document.getElementById('weeklyView').classList.contains('active')) {
                    // In vista settimanale, naviga di 7 giorni
                    currentDate.setDate(currentDate.getDate() + 7);
                    updateWeeklyPeriodText(currentDate, weekTitle);
                } else {
                    // In vista giornaliera, naviga di 1 giorno
                    currentDate.setDate(currentDate.getDate() + 1);
                    updateDailyPeriodText(currentDate, weekTitle);
                }
            });
            
            // Aggiungi listener per il cambio di vista
            document.querySelectorAll('.period-btn[data-view]').forEach(button => {
                button.addEventListener('click', function() {
                    const viewType = this.getAttribute('data-view');
                    if (viewType === 'week') {
                        updateWeeklyPeriodText(currentDate, weekTitle);
                    } else if (viewType === 'day') {
                        updateDailyPeriodText(currentDate, weekTitle);
                    }
                });
            });
        }
    }
      /**
     * Aggiorna il testo del periodo settimanale
     * @param {Date} date - La data di riferimento
     * @param {HTMLElement} element - L'elemento da aggiornare (opzionale)
     */
    function updateWeeklyPeriodText(date, element) {
        // Calcoliamo la data di inizio settimana (Lunedì)
        const currentDate = new Date(date);
        
        // Ottieni l'inizio della settimana (Lunedì): in Europa la settimana inizia di lunedì (1) e finisce di domenica (0)
        let dayOfWeek = currentDate.getDay(); // 0 è domenica, 1 è lunedì, ...
        if (dayOfWeek === 0) dayOfWeek = 7; // Convertiamo la domenica da 0 a 7 per facilitare il calcolo
        
        // Calcola la data del lunedì (inizio settimana)
        const startOfWeek = new Date(currentDate);
        startOfWeek.setDate(currentDate.getDate() - dayOfWeek + 1);
        
        // Calcola la data della domenica (fine settimana)
        const endOfWeek = new Date(startOfWeek);
        endOfWeek.setDate(startOfWeek.getDate() + 6); // +6 giorni dal lunedì = domenica
        
        // Formatta le date
        const startDay = startOfWeek.getDate();
        const endDay = endOfWeek.getDate();
        const monthStart = startOfWeek.toLocaleString('it-IT', { month: 'long' });
        const monthEnd = endOfWeek.toLocaleString('it-IT', { month: 'long' });
        const yearStart = startOfWeek.getFullYear();
        const yearEnd = endOfWeek.getFullYear();
        
        // Formato del testo per la visualizzazione
        let periodText;
        if (monthStart === monthEnd && yearStart === yearEnd) {
            periodText = `${startDay} - ${endDay} ${monthStart} ${yearStart}`;
        } else if (yearStart === yearEnd) {
            periodText = `${startDay} ${monthStart} - ${endDay} ${monthEnd} ${yearStart}`;
        } else {
            periodText = `${startDay} ${monthStart} ${yearStart} - ${endDay} ${monthEnd} ${yearEnd}`;
        }
        
        // Aggiorna il testo dell'elemento originale (se fornito)
        if (element) {
            element.textContent = periodText;
        }
        
        // Aggiorna anche la nuova intestazione settimanale
        const weekTitle = document.querySelector('.week-title');
        if (weekTitle) {
            weekTitle.textContent = `Settimana ${startDay} - ${endDay} ${monthStart} ${yearStart}`;
        }
        
        // Aggiorna anche le intestazioni della tabella
        updateTableHeaders(startOfWeek);
        
        // Verifica se è la settimana corrente e gestisci i dati dei turni
        handleShiftDataBasedOnWeek(startOfWeek);
    }
    
    /**
     * Calcola il numero della settimana dell'anno
     * @param {Date} date - La data da cui calcolare la settimana
     * @returns {number} - Numero della settimana dell'anno
     */
    function getWeekNumber(date) {
        // Crea una copia della data
        const d = new Date(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()));
        
        // Imposta al giovedì della settimana corrente
        d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay() || 7));
        
        // Inizio dell'anno
        const yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
        
        // Calcola il numero di settimane
        const weekNumber = Math.ceil(((d - yearStart) / 86400000 + 1) / 7);
        
        return weekNumber;
    }    /**
     * Aggiorna il testo del periodo giornaliero
     * @param {Date} date - La data da visualizzare
     * @param {HTMLElement} element - L'elemento da aggiornare
     */
    function updateDailyPeriodText(date, element) {
        // Formatta la data in italiano
        const dayName = date.toLocaleString('it-IT', { weekday: 'long' });
        const dayCapitalized = dayName.charAt(0).toUpperCase() + dayName.slice(1);
        const day = date.getDate();
        const month = date.toLocaleString('it-IT', { month: 'long' });
        const year = date.getFullYear();
        
        const formattedDate = `${dayCapitalized} ${day} ${month} ${year}`;
        
        // Aggiorna il titolo nella card in alto
        if (element) {
            element.textContent = formattedDate;
        }
        
        // Gestisci la visualizzazione dei dati in base alla data
        handleDailyShiftData(date);
    }
      /**
     * Gestisce la visualizzazione dei dati dei turni nella vista giornaliera
     * @param {Date} selectedDate - La data selezionata
     */
    function handleDailyShiftData(selectedDate) {
        // Ottieni la data corrente per confronto
        const today = new Date();
        
        // Verifica se la data selezionata è quella di oggi
        const isToday = (
            selectedDate.getDate() === today.getDate() && 
            selectedDate.getMonth() === today.getMonth() && 
            selectedDate.getFullYear() === today.getFullYear()
        );
        
        // Aggiorna lo stile della data corrente nel titolo
        const weekTitle = document.querySelector('.week-title');
        if (weekTitle && document.getElementById('dailyView').classList.contains('active')) {
            if (isToday) {
                weekTitle.classList.add('text-primary');
            } else {
                weekTitle.classList.remove('text-primary');
            }
        }
        
        // Gestisci la visualizzazione dei dati nella vista giornaliera
        const allShiftCards = document.querySelectorAll('.daily-shift-card');
        allShiftCards.forEach(card => {
            // Ottieni tutti i driver in questa card
            const driverElements = card.querySelectorAll('.driver-shift-detail');
            
            if (isToday) {
                // Se è il giorno corrente, mostra i dati statici dei driver
                driverElements.forEach(driver => {
                    driver.style.display = '';
                });
                
                // Gestisci il conteggio dei driver
                const badgeElement = card.querySelector('.badge-pill');
                if (badgeElement) {
                    if (driverElements.length > 0) {
                        badgeElement.textContent = `${driverElements.length} driver`;
                        badgeElement.className = 'badge-pill bg-primary-light text-primary';
                    } else {
                        badgeElement.textContent = 'Nessun driver';
                        badgeElement.className = 'badge-pill bg-secondary-light text-secondary';
                    }
                }
                
                // Se non ci sono driver, mostra il messaggio di turno vuoto
                const emptyShiftMessage = card.querySelector('.empty-shift-message');
                if (emptyShiftMessage) {
                    emptyShiftMessage.style.display = driverElements.length === 0 ? '' : 'none';
                }
                
                // Rimuove la classe empty se ci sono driver
                if (driverElements.length > 0) {
                    card.classList.remove('empty');
                } else {
                    card.classList.add('empty');
                }
            } else {
                // Se non è il giorno corrente, nascondi tutti i driver
                driverElements.forEach(driver => {
                    driver.style.display = 'none';
                });
                
                // Aggiorna il badge per mostrare che non ci sono driver
                const badgeElement = card.querySelector('.badge-pill');
                if (badgeElement) {
                    badgeElement.textContent = 'Nessun driver';
                    badgeElement.className = 'badge-pill bg-secondary-light text-secondary';
                }
                
                // Mostra il messaggio di turno vuoto
                const emptyShiftMessage = card.querySelector('.empty-shift-message');
                if (emptyShiftMessage) {
                    emptyShiftMessage.style.display = '';
                }
                
                // Aggiungi la classe empty
                card.classList.add('empty');
            }
        });
    }/**
     * Aggiorna le intestazioni della tabella settimanale
     * @param {Date} startOfWeek - La data di inizio settimana
     */
    function updateTableHeaders(startOfWeek) {
        const days = ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato', 'Domenica'];
        const headers = document.querySelectorAll('.table-turni th:not(:first-child)');
        const today = new Date();
        
        // Reset delle classi precedentemente aggiunte
        document.querySelectorAll('.table-turni th.current-day-column').forEach(th => {
            th.classList.remove('current-day-column');
        });
        
        if (headers.length === 7) {
            for (let i = 0; i < 7; i++) {
                const date = new Date(startOfWeek);
                date.setDate(startOfWeek.getDate() + i);
                const day = date.getDate();
                const month = date.getMonth() + 1; // getMonth() restituisce 0-11
                
                // Formatta l'intestazione
                headers[i].innerHTML = `${days[i]}<br><small>${day.toString().padStart(2, '0')}/${month.toString().padStart(2, '0')}</small>`;
                
                // Verifica se questa è la data corrente e la evidenzia
                if (date.getDate() === today.getDate() && 
                    date.getMonth() === today.getMonth() && 
                    date.getFullYear() === today.getFullYear()) {
                    headers[i].classList.add('current-day-column');
                }
            }
        }
    }    /**
     * Gestisce la visibilità dei dati dei turni in base alla settimana visualizzata
     * @param {Date} startOfWeek - La data di inizio settimana
     */
    function handleShiftDataBasedOnWeek(startOfWeek) {
        // Ottieni la data di inizio della settimana corrente per confronto
        const today = new Date();
        let currentDayOfWeek = today.getDay();
        if (currentDayOfWeek === 0) currentDayOfWeek = 7;
        
        const currentWeekStart = new Date(today);
        currentWeekStart.setDate(today.getDate() - currentDayOfWeek + 1);
        
        // Verifica se la settimana visualizzata è quella corrente
        const isCurrentWeek = isSameWeek(startOfWeek, currentWeekStart);
        
        // Verifica se la settimana visualizzata è passata, corrente o futura
        const isPastWeek = startOfWeek < currentWeekStart;
        
        // Gestisci i turni in base alla settimana
        const allShiftCells = document.querySelectorAll('.shift-cell');
        allShiftCells.forEach(cell => {
            // Ottieni tutti i driver in questa cella
            const driverElements = cell.querySelectorAll('.driver-shift');
            
            if (isCurrentWeek) {
                // Se è la settimana corrente, mostra i dati statici
                driverElements.forEach(driver => {
                    driver.style.display = '';
                });
                
                // Assicurati che anche gli elementi vacancy siano visibili
                const vacancyElements = cell.querySelectorAll('.shift-vacancy');
                vacancyElements.forEach(vacancy => {
                    vacancy.style.display = '';
                });
                
                // Assicurati che ogni cella abbia un elemento shift-vacancy
                if (vacancyElements.length === 0) {
                    addVacancyToCell(cell);
                }
            } else if (isPastWeek) {
                // Se è una settimana passata, nascondi i dati statici
                driverElements.forEach(driver => {
                    driver.style.display = 'none';
                });
                
                // Nascondi anche gli elementi vacancy nelle settimane passate
                const vacancyElements = cell.querySelectorAll('.shift-vacancy');
                vacancyElements.forEach(vacancy => {
                    vacancy.style.display = 'none';
                });
            } else {
                // Se è una settimana futura, nascondi i dati statici
                driverElements.forEach(driver => {
                    driver.style.display = 'none';
                });
                
                // Mostra gli elementi vacancy nelle settimane future
                const vacancyElements = cell.querySelectorAll('.shift-vacancy');
                vacancyElements.forEach(vacancy => {
                    vacancy.style.display = '';
                });
                
                // Assicurati che ogni cella abbia un elemento shift-vacancy
                if (vacancyElements.length === 0) {
                    addVacancyToCell(cell);
                }
            }              // Aggiorna lo stato della cella
            const shift = cell.getAttribute('data-shift');
            updateCellStatus(cell, shift);
        });
        
        // Emetti un evento per informare la pagina principale del cambio di settimana
        // Questo permette alla pagina principale di reagire al cambiamento
        const weekInfo = {
            startDate: startOfWeek,
            isCurrentWeek: isCurrentWeek,
            formattedDate: startOfWeek.toLocaleDateString('it-IT')
        };
        
        // Creiamo e dispachiamo l'evento
        const weekChangeEvent = new CustomEvent('turniWeekChanged', { 
            detail: weekInfo,
            bubbles: true,
            cancelable: true
        });
        document.dispatchEvent(weekChangeEvent);
    }
    
    /**
     * Verifica se due date appartengono alla stessa settimana
     * @param {Date} date1 - Prima data
     * @param {Date} date2 - Seconda data
     * @returns {boolean} - True se le date sono nella stessa settimana
     */
    function isSameWeek(date1, date2) {
        // Ripulisci le date mantenendo solo anno, mese e giorno
        const d1 = new Date(date1.getFullYear(), date1.getMonth(), date1.getDate());
        const d2 = new Date(date2.getFullYear(), date2.getMonth(), date2.getDate());
        
        // Confronta solo l'inizio della settimana
        return (
            d1.getFullYear() === d2.getFullYear() && 
            d1.getMonth() === d2.getMonth() && 
            d1.getDate() === d2.getDate()
        );
    }    /**
     * Configura il drag & drop dei driver
     */
    function setupDragDrop() {
        // Rimozione degli event listener precedenti reclonando gli elementi
        function replaceElements(selector) {
            document.querySelectorAll(selector).forEach(el => {
                if (el && el.parentNode) {
                    const clone = el.cloneNode(true);
                    el.parentNode.replaceChild(clone, el);
                }
            });
        }
        
        // Rimuovi i listener esistenti
        replaceElements('.driver-shift[draggable="true"]');
        replaceElements('.driver-shift-detail[draggable="true"]');
        replaceElements('.shift-vacancy');
        replaceElements('.remove-driver');
        
        // Assicurati che ogni cella della griglia settimanale abbia un elemento shift-vacancy
        document.querySelectorAll('.shift-cell').forEach(cell => {
            if (!cell.querySelector('.shift-vacancy')) {
                addVacancyToCell(cell);
            }
        });
        
        const draggableElements = document.querySelectorAll('.driver-shift[draggable="true"], .driver-shift-detail[draggable="true"]');
        const dropTargets = document.querySelectorAll('.shift-cell');
        
        let draggedElement = null;
        
        // Configurazione degli elementi draggabili
        draggableElements.forEach(element => {
            element.addEventListener('dragstart', function(event) {
                draggedElement = this;
                this.classList.add('dragging');
                
                // Aggiungiamo dati all'evento di drag
                event.dataTransfer.setData('text/plain', this.getAttribute('data-driver-id'));
                
                // Salva anche l'informazione se è un orario personalizzato
                if (this.classList.contains('custom-time')) {
                    event.dataTransfer.setData('is-custom-time', 'true');
                    
                    // Salva gli orari personalizzati
                    const customTimeElement = this.querySelector('.driver-custom-time');
                    if (customTimeElement) {
                        event.dataTransfer.setData('custom-time', customTimeElement.textContent);
                    }
                }
                
                event.dataTransfer.effectAllowed = 'move';
            });
            
            element.addEventListener('dragend', function() {
                this.classList.remove('dragging');
                draggedElement = null;
                
                // Rimuovi le classi drop-target da tutte le celle
                dropTargets.forEach(target => target.classList.remove('drop-target'));
            });
        });
        
        // Configurazione delle aree di drop
        dropTargets.forEach(target => {
            // Quando un elemento draggabile entra nell'area
            target.addEventListener('dragenter', function(event) {
                event.preventDefault();
                this.classList.add('drop-target');
            });
            
            // Quando un elemento draggabile è sopra l'area
            target.addEventListener('dragover', function(event) {
                event.preventDefault();
                event.dataTransfer.dropEffect = 'move';
            });
            
            // Quando un elemento draggabile esce dall'area
            target.addEventListener('dragleave', function() {
                this.classList.remove('drop-target');
            });
            
            // Quando un elemento draggabile viene rilasciato nell'area
            target.addEventListener('drop', function(event) {
                event.preventDefault();
                this.classList.remove('drop-target');
                
                if (draggedElement) {
                    // Ottieni informazioni sul driver e la cella di destinazione
                    const driverId = event.dataTransfer.getData('text/plain');
                    const day = this.getAttribute('data-day');
                    const shift = this.getAttribute('data-shift');
                    
                    // Verifica se è un orario personalizzato
                    const isCustomTime = event.dataTransfer.getData('is-custom-time') === 'true';
                    let customTime = event.dataTransfer.getData('custom-time');
                    let startTime = null;
                    let endTime = null;
                    
                    // Se è un orario personalizzato, estrai gli orari
                    if (isCustomTime && customTime) {
                        const timeParts = customTime.split('-');
                        if (timeParts.length === 2) {
                            startTime = timeParts[0].trim();
                            endTime = timeParts[1].trim();
                        }
                    }
                    
                    // Indica che ci sono modifiche non salvate
                    turniModificati = true;
                    showUnsavedChangesButton();
                    
                    // Gestione UI per vista settimanale
                    if (draggedElement.classList.contains('driver-shift')) {
                        // Rimuovi l'elemento originale dalla sua posizione
                        const parentElement = draggedElement.parentElement;
                        parentElement.removeChild(draggedElement);
                        
                        // Ricalcola stato nella cella di origine
                        updateCellStatus(parentElement, parentElement.getAttribute('data-shift'));
                          // Crea un nuovo elemento driver-shift nella cella di destinazione
                        createDriverShift(this, driverId, isCustomTime, startTime, endTime);
                        
                        // Reinizializza drag & drop e i pulsanti di azione per il nuovo elemento
                        setupDragDrop();
                        initEditButtons(); // Aggiunge i pulsanti di modifica ed eliminazione anche ai nuovi elementi
                    }
                    
                    // Toast di conferma
                    showToast(`Driver assegnato con successo a ${getShiftName(shift)} di ${getDayName(day)}`, 'success');
                }
            });
        });        // Configurazione degli elementi di vacancy
        document.querySelectorAll('.shift-vacancy').forEach(vacancy => {
            vacancy.addEventListener('click', function() {
                // Ottieni informazioni sulla cella
                const cell = this.closest('.shift-cell');
                const day = cell.getAttribute('data-day');
                const shift = cell.getAttribute('data-shift');
                
                // Apri il modal per creare un nuovo turno
                const modal = document.getElementById('creaTurnoModal');
                if (modal) {
                    // Pre-compila i campi
                    const turnoGiorno = document.getElementById('turnoGiorno');
                    const turnoFascia = document.getElementById('turnoFascia');
                    
                    if (turnoGiorno) turnoGiorno.value = day;
                    if (turnoFascia) turnoFascia.value = shift;
                    
                    // Mostra il modal
                    const modalInstance = new bootstrap.Modal(modal);
                    modalInstance.show();
                }
            });
        });
        
        // Aggiungi gestione rimozione driver dai turni
        document.querySelectorAll('.remove-driver').forEach(button => {
            button.addEventListener('click', function() {
                const driverElement = this.closest('.driver-shift-detail');
                const cell = driverElement.closest('.shift-drivers-list');
                const shiftType = cell.closest('.daily-shift-card').querySelector('.shift-header h5').textContent.toLowerCase();
                
                if (driverElement) {
                    // Rimuovi l'elemento dal DOM
                    driverElement.remove();
                    
                    // Aggiorna conteggi e stato
                    updateShiftCount(cell.closest('.daily-shift-card'));
                    
                    // Indica modifiche non salvate
                    turniModificati = true;
                    showUnsavedChangesButton();
                    
                    showToast('Driver rimosso dal turno', 'success');
                }
            });
        });
        
        // Controlla tutte le celle per aggiornare gli stati
        document.querySelectorAll('.shift-cell').forEach(cell => {
            const shift = cell.getAttribute('data-shift');
            updateCellStatus(cell, shift);
        });
    }

    /**
     * Aggiorna lo stato di una cella in base al numero di driver assegnati
     */
    function updateCellStatus(cell, shiftType) {
        // Conta i driver nella cella
        const drivers = cell.querySelectorAll('.driver-shift');
        const driverCount = drivers.length;
        
        // Ottieni le soglie dalle regole
        const sovraccarico = regoleSovraccarico[shiftType] || 2; // Default: sovraccarico se più di 2 driver
        const carenza = regoleCarenza[shiftType] || 1; // Default: carenza se meno di 1 driver
        
        // Per ciascun driver, aggiorna lo stato
        drivers.forEach(driver => {
            // Se è un turno con orario personalizzato, non cambiare il suo stato
            if (driver.classList.contains('custom-time')) {
                // Mantieni la classe custom-time e non modificare lo stato
                return;
            }
            
            // Rimuovi tutte le classi di stato esistenti
            driver.classList.remove('available', 'warning', 'danger');
            
            // Assegna la classe appropriata
            if (driverCount > sovraccarico) {
                driver.classList.add('warning'); // Sovraccarico
                driver.querySelector('.driver-status').textContent = 'Sovraccarico';
            } else if (driverCount < carenza) {
                driver.classList.add('danger'); // Carenza
                driver.querySelector('.driver-status').textContent = 'Carenza';
            } else {
                driver.classList.add('available'); // Disponibile
                driver.querySelector('.driver-status').textContent = 'Disponibile';
            }
        });
    }

    /**
     * Aggiorna il conteggio dei driver in una scheda turno
     */
    function updateShiftCount(card) {
        if (!card) return;
        
        const drivers = card.querySelectorAll('.driver-shift-detail');
        const badge = card.querySelector('.badge-pill');
        
        if (badge) {
            if (drivers.length === 0) {
                badge.textContent = 'Nessun driver';
                badge.className = 'badge-pill bg-secondary-light text-secondary';
                
                // Aggiungi messaggio vuoto se non esiste
                if (!card.querySelector('.empty-shift-message')) {
                    const emptyMessage = document.createElement('div');
                    emptyMessage.className = 'empty-shift-message';
                    emptyMessage.textContent = 'Nessun driver assegnato a questo turno';
                    card.querySelector('.shift-drivers-list').prepend(emptyMessage);
                }
            } else {
                badge.textContent = drivers.length + (drivers.length === 1 ? ' driver' : ' driver');
                badge.className = 'badge-pill bg-primary-light text-primary';
                
                // Rimuovi messaggio vuoto se esiste
                const emptyMessage = card.querySelector('.empty-shift-message');
                if (emptyMessage) {
                    emptyMessage.remove();
                }
            }
        }
    }

    /**
     * Converte il codice del giorno nel nome completo in italiano
     */
    /**
     * Crea un nuovo elemento driver-shift e lo aggiunge alla cella
     * @param {HTMLElement} cell - La cella a cui aggiungere l'elemento
     * @param {string} driverId - L'ID del driver
     * @param {boolean} isCustomTime - Se è un orario personalizzato
     * @param {string} startTime - Orario di inizio (opzionale)
     * @param {string} endTime - Orario di fine (opzionale)
     */
    function createDriverShift(cell, driverId, isCustomTime, startTime, endTime) {
        // Ottieni il nome del driver in base all'ID
        let driverName = '';
        switch (driverId) {
            case '1': driverName = 'Mario Rossi'; break;
            case '2': driverName = 'Luca Bianchi'; break;
            case '3': driverName = 'Paolo Verdi'; break;
            case '4': driverName = 'Andrea Neri'; break;
            case '5': driverName = 'Anna Gialli'; break;
            default: driverName = `Driver #${driverId}`;
        }
        
        // Crea l'elemento driver-shift
        const driverShift = document.createElement('div');
        driverShift.className = 'driver-shift';
        driverShift.setAttribute('draggable', 'true');
        driverShift.setAttribute('data-driver-id', driverId);
        
        // Contenuto interno dell'elemento
        const driverNameElement = document.createElement('div');
        driverNameElement.className = 'driver-name';
        driverNameElement.textContent = driverName;
        
        // Aggiungi l'elemento nome al driver-shift
        driverShift.appendChild(driverNameElement);        // Creiamo un contenitore per i pulsanti di azione
        const actionButtonsContainer = document.createElement('div');
        actionButtonsContainer.className = 'action-buttons weekly-action-buttons'; // Vista settimanale
        
        // Aggiungi pulsante modifica
        const editButton = document.createElement('button');
        editButton.className = 'edit-shift-btn';
        editButton.innerHTML = '<i class="fas fa-pencil-alt"></i>';
        editButton.setAttribute('type', 'button');
        editButton.title = 'Modifica turno';
        
        // Evento per il pulsante di modifica
        editButton.addEventListener('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            
            // Ottieni dati dal turno
            const shiftCell = this.closest('.shift-cell');
            const day = shiftCell.getAttribute('data-day');
            const shift = shiftCell.getAttribute('data-shift');
            
            // Prepara i dati da passare al modal
            const isCustomTime = this.closest('.driver-shift').classList.contains('custom-time');
            let customStart = null;
            let customEnd = null;
            
            if (isCustomTime) {
                const customTimeText = this.closest('.driver-shift').querySelector('.driver-custom-time').textContent;
                const timeParts = customTimeText.split('-');
                if (timeParts.length === 2) {
                    customStart = timeParts[0].trim();
                    customEnd = timeParts[1].trim();
                }
            }
            
            // Apri il modal di modifica
            openEditModal(driverId, driverName, day, shift, isCustomTime, customStart, customEnd);
        });
        
        // Aggiungi pulsante eliminazione
        const deleteButton = document.createElement('button');
        deleteButton.className = 'delete-shift-btn';
        deleteButton.innerHTML = '<i class="fas fa-times"></i>';
        deleteButton.setAttribute('type', 'button');
        deleteButton.title = 'Elimina turno';
        
        // Evento per il pulsante di eliminazione
        deleteButton.addEventListener('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            
            // Conferma l'eliminazione con un toast con azione
            confirmDeleteShift(this.closest('.driver-shift'));
        });        // Aggiungi i pulsanti al contenitore (verticalmente uno sotto l'altro nella vista settimanale)
        actionButtonsContainer.appendChild(editButton);
        actionButtonsContainer.appendChild(deleteButton);
        
        // Aggiungi il contenitore al driver-shift
        driverShift.appendChild(actionButtonsContainer);
        
        // Se è un orario personalizzato, mostra gli orari invece dello stato
        if (isCustomTime && startTime && endTime) {
            // Aggiungi classe speciale per orari personalizzati
            driverShift.classList.add('custom-time');
            
            // Crea elemento per l'orario personalizzato
            const customTimeElement = document.createElement('div');
            customTimeElement.className = 'driver-custom-time';
            customTimeElement.textContent = `${startTime} - ${endTime}`;
            
            // Sostituisci lo stato con l'orario personalizzato
            driverShift.appendChild(customTimeElement);
        } else {
            // Per orari standard, mostra lo stato (disponibile, sovraccarico, ecc.)
            const driverStatus = document.createElement('div');
            driverStatus.className = 'driver-status';
            driverStatus.textContent = 'Disponibile'; // Stato predefinito
            
            // Aggiungi l'elemento stato al driver-shift
            driverShift.appendChild(driverStatus);
            
            // Aggiungi la classe available
            driverShift.classList.add('available');
        }
        
        // Aggiungi l'elemento alla cella
        // Se c'è già un elemento vacancy, inserisci prima di esso
        const vacancy = cell.querySelector('.shift-vacancy');
        if (vacancy) {
            cell.insertBefore(driverShift, vacancy);
        } else {
            cell.appendChild(driverShift);
        }
        
        // Indica che ci sono modifiche non salvate
        turniModificati = true;
        showUnsavedChangesButton();
        
        // Aggiorna lo stato della cella
        const shift = cell.getAttribute('data-shift');
        updateCellStatus(cell, shift);
        
        // Reinizializza il drag & drop
        setupDragDrop();
        
        return driverShift;
    }

function getDayName(dayCode) {
        const days = {
            'mon': 'Lunedì',
            'tue': 'Martedì',
            'wed': 'Mercoledì',
            'thu': 'Giovedì',
            'fri': 'Venerdì',
            'sat': 'Sabato',
            'sun': 'Domenica'
        };
        
        return days[dayCode] || dayCode;
    }

    /**
     * Converte il codice della fascia oraria nel nome completo
     */
    function getShiftName(shiftCode) {
        const shifts = {
            'mattina': 'Mattina',
            'pranzo': 'Pranzo',
            'pomeriggio': 'Pomeriggio',
            'cena': 'Cena'
        };
        
        return shifts[shiftCode] || shiftCode;
    }    /**
     * Configura i modali
     */
    function setupModals() {
        // Setup per i checkbox dell'orario personalizzato (sia nuovo che modifica)
        setupOrarioPersonalizzatoCheckbox('orarioPersonalizzato', 'orariPersonalizzatiContainer');
        setupOrarioPersonalizzatoCheckbox('editOrarioPersonalizzato', 'editOrariPersonalizzatiContainer');
        
        // Modal per creare un nuovo turno
        setupModalButton('salvaTurno', function() {
            // Ottieni i dati del form
            const driver = document.getElementById('turnoDriver').value;
            const giorno = document.getElementById('turnoGiorno').value;
            const fascia = document.getElementById('turnoFascia').value;
            const notifica = document.getElementById('notificaDriver')?.checked || false;
            
            // Gestisci orario personalizzato
            const isOrarioPersonalizzato = document.getElementById('orarioPersonalizzato')?.checked || false;
            let orarioInizio = null;
            let orarioFine = null;
            
            if (isOrarioPersonalizzato) {
                orarioInizio = document.getElementById('orarioInizio').value;
                orarioFine = document.getElementById('orarioFine').value;
                
                // Validazione orari personalizzati
                if (!orarioInizio || !orarioFine) {
                    showToast('Devi inserire entrambi gli orari di inizio e fine', 'error');
                    return;
                }
            }
            
            // Validazione
            if (!driver) {
                showToast('Devi selezionare un driver', 'error');
                return;
            }
            
            // Simula il salvataggio
            console.log('Salvataggio turno:', { 
                driver, 
                giorno, 
                fascia, 
                notifica, 
                isOrarioPersonalizzato, 
                orarioInizio, 
                orarioFine 
            });
            
            // Recupera la cella corrispondente
            const cell = document.querySelector(`.shift-cell[data-day="${giorno}"][data-shift="${fascia}"]`);
            if (cell) {
                // Crea il nuovo elemento driver-shift
                createDriverShift(cell, driver, isOrarioPersonalizzato, orarioInizio, orarioFine);
            }
            
            // Chiudi il modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('creaTurnoModal'));
            modal.hide();
            
            // Toast di conferma
            showToast(`Turno creato con successo per ${getDayName(giorno)}, fascia ${getShiftName(fascia)}`, 'success');
        });
        
        // Modal per aggiornare un turno esistente
        setupModalButton('aggiornaTurno', function() {
            // Ottieni i dati del form di modifica
            const driverId = document.getElementById('editDriverId').value;
            const driverName = document.getElementById('editDriverName').value;
            const newGiorno = document.getElementById('editTurnoGiorno').value;
            const newFascia = document.getElementById('editTurnoFascia').value;
            const notifica = document.getElementById('editNotificaDriver')?.checked || false;
            
            // Gestisci orario personalizzato
            const isOrarioPersonalizzato = document.getElementById('editOrarioPersonalizzato')?.checked || false;
            let orarioInizio = null;
            let orarioFine = null;
            
            if (isOrarioPersonalizzato) {
                orarioInizio = document.getElementById('editOrarioInizio').value;
                orarioFine = document.getElementById('editOrarioFine').value;
                
                // Validazione orari personalizzati
                if (!orarioInizio || !orarioFine) {
                    showToast('Devi inserire entrambi gli orari di inizio e fine', 'error');
                    return;
                }
            }
            
            // Trova l'elemento originale per ottenere giorno e fascia originali
            let originalShift = null;
            document.querySelectorAll(`.driver-shift[data-driver-id="${driverId}"]`).forEach(shift => {
                // Verifica se questo è l'elemento che stiamo modificando
                if (shift.querySelector('.driver-name').textContent === driverName) {
                    originalShift = shift;
                }
            });
            
            if (!originalShift) {
                showToast('Impossibile trovare il turno da modificare', 'error');
                return;
            }
            
            // Ottieni la cella originale
            const originalCell = originalShift.closest('.shift-cell');
            const oldGiorno = originalCell.getAttribute('data-day');
            const oldFascia = originalCell.getAttribute('data-shift');
            
            // Aggiorna il turno
            const success = updateDriverShift(
                driverId,
                oldGiorno,
                oldFascia,
                newGiorno,
                newFascia,
                isOrarioPersonalizzato,
                orarioInizio,
                orarioFine
            );
            
            if (success) {
                // Chiudi il modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('modificaTurnoModal'));
                modal.hide();
                
                // Toast di conferma
                showToast(`Turno aggiornato con successo per ${getDayName(newGiorno)}, fascia ${getShiftName(newFascia)}`, 'success');
            } else {
                showToast('Si è verificato un errore durante l\'aggiornamento del turno', 'error');
            }
        });
        
        // Link disponibilità
        setupModalButton('generaLinkDisponibilita', function() {
            const modal = document.getElementById('linkDisponibilitaModal');
            if (modal) {
                const modalInstance = new bootstrap.Modal(modal);
                modalInstance.show();
            }
        });
        
        setupModalButton('copyLink', function() {
            const linkInput = document.getElementById('disponibilitaLink');
            if (linkInput) {
                linkInput.select();
                document.execCommand('copy');
                showToast('Link copiato negli appunti', 'success');
            }
        });
        
        setupModalButton('regenerateLink', function() {
            const linkInput = document.getElementById('disponibilitaLink');
            if (linkInput) {
                // Simula generazione di un nuovo token
                const newToken = 'TOKEN' + Math.floor(Math.random() * 1000000).toString().padStart(6, '0');
                linkInput.value = `https://lenny.it/disponibilita?token=${newToken}`;
                showToast('Nuovo link generato con successo', 'success');
            }
        });
        
        setupModalButton('sendWhatsapp', function() {
            const target = document.getElementById('whatsappTarget').value;
            showToast(`Link inviato via WhatsApp ${target === 'all' ? 'a tutti i driver' : 'al driver selezionato'}`, 'success');
        });
    }
    
    /**
     * Configura il comportamento del checkbox per orari personalizzati
     */
    function setupOrarioPersonalizzatoCheckbox(checkboxId, containerId) {
        const checkbox = document.getElementById(checkboxId);
        if (checkbox) {
            checkbox.addEventListener('change', function() {
                const container = document.getElementById(containerId);
                if (container) {
                    if (this.checked) {
                        container.classList.remove('d-none');
                    } else {
                        container.classList.add('d-none');
                    }
                }
            });
        }
    }
    
    /**
     * Helper per configurare i pulsanti modali
     */
    function setupModalButton(id, clickHandler) {
        const button = document.getElementById(id);
        if (button) {
            const clone = button.cloneNode(true);
            button.parentNode.replaceChild(clone, button);
            
            if (typeof clickHandler === 'function') {
                document.getElementById(id).addEventListener('click', clickHandler);
            }
        }
    }

    /**
     * Mostra il modal per configurare le regole di sovraccarico/carenza
     */
    function showRulesModal() {
        // Verifica se esiste già un modale precedente e rimuovilo
        const existingModal = document.getElementById('regoleTurniModal');
        if (existingModal) {
            existingModal.remove();
        }
        
        // Crea l'elemento del modale
        const modalElement = document.createElement('div');
        modalElement.className = 'modal fade';
        modalElement.id = 'regoleTurniModal';
        modalElement.setAttribute('tabindex', '-1');
        modalElement.setAttribute('aria-labelledby', 'regoleTurniModalLabel');
        modalElement.setAttribute('aria-hidden', 'true');
        
        // Imposta il contenuto del modale
        modalElement.innerHTML = `
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header position-relative p-0 border-0">
                        <div class="modal-header-bg w-100"></div>
                        <div class="modal-title-container p-3 position-relative w-100">
                            <h5 class="modal-title d-flex align-items-center" id="regoleTurniModalLabel">
                                <span class="modal-icon-wrapper me-2">
                                    <i class="fas fa-cog"></i>
                                </span>
                                Configurazione Regole Turni
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body p-4">
                        <p class="mb-4">Definisci il numero massimo di driver per ciascun turno (sovraccarico) e il numero minimo richiesto (carenza).</p>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3">Soglia Sovraccarico</h6>
                                <div class="mb-3">
                                    <label class="form-label">Mattina (9:00-11:00)</label>
                                    <input type="number" class="form-control" id="sovraccarico_mattina" value="${regoleSovraccarico.mattina}" min="1">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pranzo (11:00-15:00)</label>
                                    <input type="number" class="form-control" id="sovraccarico_pranzo" value="${regoleSovraccarico.pranzo}" min="1">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pomeriggio (15:00-18:00)</label>
                                    <input type="number" class="form-control" id="sovraccarico_pomeriggio" value="${regoleSovraccarico.pomeriggio}" min="1">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Cena (18:00-22:00)</label>
                                    <input type="number" class="form-control" id="sovraccarico_cena" value="${regoleSovraccarico.cena}" min="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3">Soglia Carenza</h6>
                                <div class="mb-3">
                                    <label class="form-label">Mattina (9:00-11:00)</label>
                                    <input type="number" class="form-control" id="carenza_mattina" value="${regoleCarenza.mattina}" min="0">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pranzo (11:00-15:00)</label>
                                    <input type="number" class="form-control" id="carenza_pranzo" value="${regoleCarenza.pranzo}" min="0">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pomeriggio (15:00-18:00)</label>
                                    <input type="number" class="form-control" id="carenza_pomeriggio" value="${regoleCarenza.pomeriggio}" min="0">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Cena (18:00-22:00)</label>
                                    <input type="number" class="form-control" id="carenza_cena" value="${regoleCarenza.cena}" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annulla</button>
                        <button type="button" class="btn btn-primary" id="saveRules">
                            <i class="fas fa-save me-2"></i> Salva Regole
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        // Aggiungi il modal al DOM
        document.body.appendChild(modalElement);
        
        // Inizializza il modale con Bootstrap
        const rulesModal = new bootstrap.Modal(modalElement);
        
        // Mostra il modale
        rulesModal.show();
        
        // Gestione pulsante salvataggio
        document.getElementById('saveRules').addEventListener('click', function() {
            // Salva le regole
            regoleSovraccarico = {
                mattina: parseInt(document.getElementById('sovraccarico_mattina').value) || 2,
                pranzo: parseInt(document.getElementById('sovraccarico_pranzo').value) || 2,
                pomeriggio: parseInt(document.getElementById('sovraccarico_pomeriggio').value) || 1,
                cena: parseInt(document.getElementById('sovraccarico_cena').value) || 2
            };
            
            regoleCarenza = {
                mattina: parseInt(document.getElementById('carenza_mattina').value) || 1,
                pranzo: parseInt(document.getElementById('carenza_pranzo').value) || 1,
                pomeriggio: parseInt(document.getElementById('carenza_pomeriggio').value) || 1,
                cena: parseInt(document.getElementById('carenza_cena').value) || 1
            };
            
            // Aggiorna lo stato di tutte le celle
            document.querySelectorAll('.shift-cell').forEach(cell => {
                const shift = cell.getAttribute('data-shift');
                updateCellStatus(cell, shift);
            });
            
            // Chiudi il modale
            rulesModal.hide();
            
            showToast('Regole turni aggiornate con successo', 'success');
        });
    }

    /**
     * Mostra un toast di notifica
     */
    function showToast(message, type = 'info') {
        // Verifica se esiste già il container dei toast
        let toastContainer = document.querySelector('.toast-container');
        
        // Se non esiste, crealo
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            document.body.appendChild(toastContainer);
        }
        
        // Crea il toast
        const toastId = 'toast-' + Date.now();
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white bg-${type} border-0`;
        toast.id = toastId;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        // Contenuto del toast
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
        
        // Aggiungi il toast al container
        toastContainer.appendChild(toast);
        
        // Inizializza e mostra il toast
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
        
        // Rimuovi il toast dopo che è stato nascosto
        toast.addEventListener('hidden.bs.toast', function() {
            this.remove();
        });
    }

    /**
     * Mostra un toast di conferma per l'eliminazione di un turno
     * @param {HTMLElement} shiftElement - L'elemento del turno da eliminare
     */
    function confirmDeleteShift(shiftElement) {
        if (!shiftElement) return;
        
        // Ottieni le informazioni sul driver
        const driverId = shiftElement.getAttribute('data-driver-id');
        const driverName = shiftElement.querySelector('.driver-name').textContent;
        
        // Ottieni le informazioni sulla cella e sul turno
        const shiftCell = shiftElement.closest('.shift-cell');
        const day = shiftCell.getAttribute('data-day');
        const shift = shiftCell.getAttribute('data-shift');
        
        // Crea un ID unico per il toast
        const toastId = `delete-toast-${Date.now()}`;
        
        // Crea un elemento toast personalizzato con pulsanti di conferma e annulla
        const toastContainer = document.querySelector('.toast-container') || createToastContainer();
        
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-white bg-danger border-0';
        toast.id = toastId;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <div class="mb-2">Rimuovere <strong>${driverName}</strong> dal turno di <strong>${getShiftName(shift)}</strong> di <strong>${getDayName(day)}</strong>?</div>
                    <div class="mt-2 pt-2 border-top d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-light" id="cancel-${toastId}">Annulla</button>
                        <button type="button" class="btn btn-sm btn-danger" id="confirm-${toastId}">Conferma</button>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Chiudi"></button>
            </div>
        `;
        
        // Aggiungi il toast al container
        toastContainer.appendChild(toast);
        
        // Inizializza e mostra il toast
        const bsToast = new bootstrap.Toast(toast, { autohide: false });
        bsToast.show();
        
        // Gestisci il pulsante di annullamento
        document.getElementById(`cancel-${toastId}`).addEventListener('click', function() {
            bsToast.hide();
        });
        
        // Gestisci il pulsante di conferma
        document.getElementById(`confirm-${toastId}`).addEventListener('click', function() {
            // Rimuovi l'elemento dal DOM
            shiftCell.removeChild(shiftElement);
            
            // Ricalcola stato nella cella
            updateCellStatus(shiftCell, shift);
            
            // Indica modifiche non salvate
            turniModificati = true;
            showUnsavedChangesButton();
            
            // Chiudi il toast
            bsToast.hide();
            
            // Mostra un toast di conferma
            showToast(`${driverName} rimosso dal turno con successo`, 'success');
        });
        
        // Rimuovi il toast dopo che è stato nascosto
        toast.addEventListener('hidden.bs.toast', function() {
            this.remove();
        });
    }
    
    /**
     * Crea il container per i toast se non esiste
     */
    function createToastContainer() {
        const container = document.createElement('div');
        container.className = 'toast-container position-fixed top-0 end-0 p-3';
        document.body.appendChild(container);
        return container;
    }

    /**
     * Configura la gestione della conferma dei turni
     */
    function setupTurniConfirmation() {
        // Aggiungiamo un pulsante di conferma alla pagina dei turni
        addConfigButton();
        
        // Rimuoviamo eventuali listener precedenti di beforeunload
        window.removeEventListener('beforeunload', beforeUnloadHandler);
        
        // Aggiungiamo un evento per intercettare l'uscita dalla pagina con modifiche non salvate
        window.addEventListener('beforeunload', beforeUnloadHandler);
    }
    
    /**
     * Handler per l'evento beforeunload
     */
    function beforeUnloadHandler(e) {
        if (turniModificati) {
            // Messaggio standard per richiedere conferma
            const message = 'Hai modifiche non salvate. Sei sicuro di voler uscire?';
            e.returnValue = message;
            return message;
        }
    }

    /**
     * Mostra il pulsante per salvare le modifiche ai turni
     */
    function showUnsavedChangesButton() {
        if (!document.getElementById('confirmTurniBtn') && turniModificati) {
            const actionsDiv = document.querySelector('#turni .d-flex.justify-content-between > div:last-child');
            
            if (actionsDiv) {
                const confirmButton = document.createElement('button');
                confirmButton.id = 'confirmTurniBtn';
                confirmButton.className = 'btn btn-success btn-action ms-2';
                confirmButton.innerHTML = '<i class="fas fa-check me-2"></i> Conferma Turni';
                confirmButton.addEventListener('click', confirmTurni);
                
                actionsDiv.appendChild(confirmButton);
                
                // Animazione di evidenziazione
                confirmButton.classList.add('pulse-animation');
            }
        }
    }

    /**
     * Conferma e salva le modifiche ai turni
     */
    function confirmTurni() {
        // Verifica se esiste già un modale precedente e rimuovilo
        const existingModal = document.getElementById('confirmTurniModal');
        if (existingModal) {
            existingModal.remove();
        }
        
        // Crea l'elemento del modale
        const modalElement = document.createElement('div');
        modalElement.className = 'modal fade';
        modalElement.id = 'confirmTurniModal';
        modalElement.setAttribute('tabindex', '-1');
        modalElement.setAttribute('aria-labelledby', 'confirmTurniModalLabel');
        modalElement.setAttribute('aria-hidden', 'true');
        
        // Imposta il contenuto del modale
        modalElement.innerHTML = `
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header position-relative p-0 border-0">
                        <div class="modal-header-bg w-100"></div>
                        <div class="modal-title-container p-3 position-relative w-100">
                            <h5 class="modal-title d-flex align-items-center" id="confirmTurniModalLabel">
                                <span class="modal-icon-wrapper me-2">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                Conferma Turni
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body p-4">
                        <p>I turni sono stati confermati con successo!</p>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="notifyDrivers" checked>
                            <label class="form-check-label" for="notifyDrivers">
                                Invia notifica ai driver coinvolti
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Chiudi</button>
                        <button type="button" class="btn btn-primary" id="sendTurniNotifications">
                            <i class="fas fa-paper-plane me-2"></i> Invia Notifiche
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        // Aggiungi il modal al DOM
        document.body.appendChild(modalElement);
        
        // Inizializza il modale con Bootstrap
        const confirmModal = new bootstrap.Modal(modalElement);
        
        // Mostra il modale
        confirmModal.show();
        
        // Gestione pulsante invio notifiche
        document.getElementById('sendTurniNotifications').addEventListener('click', function() {
            const notifyDrivers = document.getElementById('notifyDrivers').checked;
            
            if (notifyDrivers) {
                // Qui inviamo le notifiche ai driver
                const driverElements = document.querySelectorAll('.driver-shift');
                const driverCount = new Set(Array.from(driverElements).map(d => d.getAttribute('data-driver-id'))).size;
                showToast(`Notifiche inviate con successo a ${driverCount} driver`, 'success');
            }
            
            // Chiudi il modale
            confirmModal.hide();
        });
        
        // Gestisci la pulizia del modal quando viene chiuso
        modalElement.addEventListener('hidden.bs.modal', function() {
            // Rimuovi il modale dal DOM dopo la chiusura
            modalElement.remove();
            
            // Rimuovi il pulsante di conferma
            const confirmButton = document.getElementById('confirmTurniBtn');
            if (confirmButton) {
                confirmButton.remove();
            }
            
            // Reset flag modifiche
            turniModificati = false;
            
            // Aggiorna gli stati di tutti i turni
            document.querySelectorAll('.shift-cell').forEach(cell => {
                const shift = cell.getAttribute('data-shift');
                updateCellStatus(cell, shift);
            });
            
            // Aggiorna i conteggi nelle card della vista giornaliera
            document.querySelectorAll('.daily-shift-card').forEach(card => {
                updateShiftCount(card);
            });
            
            showToast('Turni confermati con successo', 'success');
        });
    }

    /**
     * Apre il modal di modifica del turno
     * @param {string} driverId - ID del driver
     * @param {string} driverName - Nome del driver
     * @param {string} day - Giorno del turno
     * @param {string} shift - Fascia oraria
     * @param {boolean} isCustomTime - Se ha orario personalizzato
     * @param {string} customStart - Orario di inizio personalizzato
     * @param {string} customEnd - Orario di fine personalizzato
     */
    function openEditModal(driverId, driverName, day, shift, isCustomTime, customStart, customEnd) {
        // Ottieni il riferimento al modal
        const modal = document.getElementById('modificaTurnoModal');
        if (!modal) return;
        
        // Imposta i dati nel form
        document.getElementById('editDriverId').value = driverId;
        document.getElementById('editDriverName').value = driverName;
        document.getElementById('editTurnoGiorno').value = day;
        document.getElementById('editTurnoFascia').value = shift;
        
        // Gestisci orario personalizzato
        const checkboxOrarioPersonalizzato = document.getElementById('editOrarioPersonalizzato');
        const orariContainer = document.getElementById('editOrariPersonalizzatiContainer');
        
        // Imposta lo stato del checkbox
        checkboxOrarioPersonalizzato.checked = isCustomTime;
        
        // Mostra/nascondi container orari personalizzati
        if (isCustomTime) {
            orariContainer.classList.remove('d-none');
            
            // Imposta gli orari se disponibili
            if (customStart) document.getElementById('editOrarioInizio').value = customStart;
            if (customEnd) document.getElementById('editOrarioFine').value = customEnd;
        } else {
            orariContainer.classList.add('d-none');
        }
        
        // Inizializza il comportamento del checkbox
        checkboxOrarioPersonalizzato.addEventListener('change', function() {
            if (this.checked) {
                orariContainer.classList.remove('d-none');
            } else {
                orariContainer.classList.add('d-none');
            }
        });
        
        // Mostra il modal
        const modalInstance = new bootstrap.Modal(modal);
        modalInstance.show();
    }

    /**
     * Aggiungi un pulsante per configurare le regole di sovraccarico e carenza
     */
    function addConfigButton() {
        // Rimuovi il pulsante esistente, se c'è
        const existingBtn = document.getElementById('configRulesBtn');
        if (existingBtn) existingBtn.remove();
        
        const actionsDiv = document.querySelector('#turni .d-flex.justify-content-between > div:last-child');
        
        if (actionsDiv) {
            // Aggiungi pulsante per le regole
            const rulesButton = document.createElement('button');
            rulesButton.id = 'configRulesBtn';
            rulesButton.className = 'btn btn-outline-secondary ms-2';
            rulesButton.innerHTML = '<i class="fas fa-cog me-2"></i> Regole Turni';
            rulesButton.addEventListener('click', showRulesModal);
            
            actionsDiv.appendChild(rulesButton);
        }
    }

    /**
     * Mostra il contenuto della pagina dopo l'inizializzazione completa
     */
    function showContent() {
        const contentElements = document.querySelectorAll('.js-content-ready');
        
        // Attendiamo un breve momento per assicurarci che tutte le operazioni DOM siano completate
        setTimeout(() => {
            contentElements.forEach(element => {
                element.style.opacity = '1';  // Mostra il contenuto con una transizione
            });
        }, 10);
    }    /**
     * Metodo di inizializzazione pubblico
     */
    function init() {
        console.log('GestioneTurniDriver: Inizializzazione...');
        
        if (initialized) {
            console.log('GestioneTurniDriver: Già inizializzato, rimuovo event listener precedenti...');
            // Se vogliamo ri-inizializzare, rimuoviamo prima gli event listener precedenti
            // La rimozione viene gestita nelle singole funzioni di setup
        }
        
        // INIZIALIZZAZIONE COMPONENTI
        initializeComponents();
            
        // GESTIONE VISTE TURNI
        setupViewToggle();
        
        // GESTIONE PERIODO E NAVIGAZIONE
        setupPeriodNavigation();
        
        // GESTIONE DRAG & DROP
        setupDragDrop();
        
        // GESTIONE MODALI
        setupModals();
        
        // GESTIONE CONFERMA TURNI
        setupTurniConfirmation();
        
        // INIZIALIZZA PULSANTI DI MODIFICA
        initEditButtons();
        
        // Inizializza i pulsanti di azione (modifica e elimina) per la vista giornaliera
        initDailyViewButtons();
        
        // Forza l'aggiornamento dell'interfaccia con la data corrente
        const today = new Date();
        updateWeeklyPeriodText(today);
        
        // Imposta il giorno corrente anche nella vista giornaliera
        const currentDayElement = document.querySelector('.current-day');
        if (currentDayElement) {
            updateDailyPeriodText(today, currentDayElement);
        }
        
        // Mostra il contenuto solo quando tutto è stato inizializzato
        showContent();
        
        // Imposta il flag per prevenire la doppia inizializzazione
        initialized = true;
        
        console.log('GestioneTurniDriver: Inizializzazione completata');
    }

    /**
     * Funzione per aggiornare un turno esistente
     * @param {string} driverId - ID del driver
     * @param {string} oldDay - Giorno precedente
     * @param {string} oldShift - Fascia oraria precedente
     * @param {string} newDay - Nuovo giorno
     * @param {string} newShift - Nuova fascia oraria
     * @param {boolean} isCustomTime - Se ha orario personalizzato
     * @param {string} startTime - Orario di inizio personalizzato
     * @param {string} endTime - Orario di fine personalizzato
     * @returns {boolean} - True se l'aggiornamento è riuscito
     */
    function updateDriverShift(driverId, oldDay, oldShift, newDay, newShift, isCustomTime, startTime, endTime) {
        // 1. Trova e rimuovi l'elemento esistente
        const oldCell = document.querySelector(`.shift-cell[data-day="${oldDay}"][data-shift="${oldShift}"]`);
        if (!oldCell) return false;
        
        const driverElement = oldCell.querySelector(`.driver-shift[data-driver-id="${driverId}"]`);
        if (!driverElement) return false;
        
        // Rimuovi l'elemento dalla vecchia cella
        oldCell.removeChild(driverElement);
        
        // Aggiorna lo stato della vecchia cella
        updateCellStatus(oldCell, oldShift);
        
        // 2. Trova la nuova cella e aggiungi il nuovo elemento
        const newCell = document.querySelector(`.shift-cell[data-day="${newDay}"][data-shift="${newShift}"]`);
        if (!newCell) return false;
          // Crea il nuovo elemento nella nuova cella
        createDriverShift(newCell, driverId, isCustomTime, startTime, endTime);
        
        // Reinizializza i pulsanti di modifica ed eliminazione
        initEditButtons();
        
        // 3. Aggiorna stato
        turniModificati = true;
        showUnsavedChangesButton();
        
        return true;
    }    /**
     * Inizializza i pulsanti di azione (modifica e elimina) per i turni esistenti
     */
    function initEditButtons() {
        // Trova tutti i turni esistenti
        const existingShifts = document.querySelectorAll('.driver-shift');
        
        existingShifts.forEach(shift => {
            // Verifica se i pulsanti sono già presenti
            const existingButtons = shift.querySelector('.action-buttons');
            if (existingButtons) {
                // Rimuovi i vecchi pulsanti per evitare duplicati e assicurarti che i nuovi listener siano attivi
                existingButtons.remove();
            }
            
            // Ottieni informazioni sul driver
            const driverId = shift.getAttribute('data-driver-id');
            const driverName = shift.querySelector('.driver-name').textContent;            // Crea il contenitore per i pulsanti di azione
            const actionButtonsContainer = document.createElement('div');
            actionButtonsContainer.className = 'action-buttons weekly-action-buttons'; // Vista settimanale
            
            // Crea il pulsante modifica
            const editButton = document.createElement('button');
            editButton.className = 'edit-shift-btn';
            editButton.innerHTML = '<i class="fas fa-pencil-alt"></i>';
            editButton.setAttribute('type', 'button');
            editButton.title = 'Modifica turno';
            
            // Evento per il pulsante di modifica
            editButton.addEventListener('click', function(e) {
                e.stopPropagation();
                e.preventDefault();
                
                // Ottieni dati dal turno
                const shiftCell = this.closest('.shift-cell');
                const day = shiftCell.getAttribute('data-day');
                const shift = shiftCell.getAttribute('data-shift');
                
                // Prepara i dati da passare al modal
                const isCustomTime = this.closest('.driver-shift').classList.contains('custom-time');
                let customStart = null;
                let customEnd = null;
                
                if (isCustomTime) {
                    const customTimeText = this.closest('.driver-shift').querySelector('.driver-custom-time').textContent;
                    const timeParts = customTimeText.split('-');
                    if (timeParts.length === 2) {
                        customStart = timeParts[0].trim();
                        customEnd = timeParts[1].trim();
                    }
                }
                
                // Apri il modal di modifica
                openEditModal(driverId, driverName, day, shift, isCustomTime, customStart, customEnd);
            });
            
            // Crea il pulsante eliminazione
            const deleteButton = document.createElement('button');
            deleteButton.className = 'delete-shift-btn';
            deleteButton.innerHTML = '<i class="fas fa-times"></i>';
            deleteButton.setAttribute('type', 'button');
            deleteButton.title = 'Elimina turno';
              // Evento per il pulsante di eliminazione
            deleteButton.addEventListener('click', function(e) {
                e.stopPropagation();
                e.preventDefault();
                
                // Conferma l'eliminazione
                confirmDeleteShift(this.closest('.driver-shift'));
            });
            
            // Aggiungi i pulsanti direttamente al contenitore (nella vista settimanale sono uno sotto l'altro)
            actionButtonsContainer.appendChild(editButton);
            actionButtonsContainer.appendChild(deleteButton);
            
            // Aggiungi il contenitore al driver-shift
            shift.appendChild(actionButtonsContainer);
        });
    }

    /**
     * Inizializza i pulsanti di azione (modifica e elimina) per la vista giornaliera
     */
    function initDailyViewButtons() {
        // Trova tutti i driver della vista giornaliera
        const dailyDrivers = document.querySelectorAll('.driver-shift-detail');
        
        dailyDrivers.forEach(driver => {
            // Ottieni i pulsanti esistenti
            const oldButtons = driver.querySelectorAll('.edit-shift-btn, .delete-shift-btn');
            
            // Rimuovi i vecchi listener per evitare duplicazioni
            oldButtons.forEach(btn => {
                const newBtn = btn.cloneNode(true);
                btn.parentNode.replaceChild(newBtn, btn);
            });
            
            // Inizializza i pulsanti WhatsApp
            const whatsappButton = driver.querySelector('.whatsapp-btn');
            if (whatsappButton) {
                whatsappButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Ottieni il numero di telefono
                    const phoneNumber = this.getAttribute('data-number');
                    if (phoneNumber) {
                        // Crea URL per WhatsApp
                        const whatsappUrl = `https://wa.me/${phoneNumber.replace(/[^0-9]/g, '')}`;
                        // Apri WhatsApp in una nuova finestra
                        window.open(whatsappUrl, '_blank');
                    }
                });
            }
            
            // Ottieni informazioni sul driver
            const driverId = driver.getAttribute('data-driver-id');
            const driverName = driver.querySelector('.driver-name').textContent;
            
            // Aggiungi listener al pulsante di modifica
            const editButton = driver.querySelector('.edit-shift-btn');
            if (editButton) {
                editButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    
                    // Ottieni informazioni sul turno dalla card del turno
                    const shiftCard = driver.closest('.daily-shift-card');
                    const shiftHeader = shiftCard.querySelector('.shift-header h5').textContent;
                    
                    // Estrai il nome del turno dal testo dell'header (es. "Mattina - 9:00 - 11:00")
                    let shiftName = '';
                    if (shiftHeader.includes('Mattina')) {
                        shiftName = 'mattina';
                    } else if (shiftHeader.includes('Pranzo')) {
                        shiftName = 'pranzo';
                    } else if (shiftHeader.includes('Pomeriggio')) {
                        shiftName = 'pomeriggio';
                    } else if (shiftHeader.includes('Cena')) {
                        shiftName = 'cena';
                    }
                    
                    // Usa la data corrente per il giorno
                    const currentDate = new Date();
                    const dayNames = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
                    const dayCode = dayNames[currentDate.getDay()];
                    
                    // Apri il modal di modifica con i dati del turno
                    openEditModal(driverId, driverName, dayCode, shiftName, false, null, null);
                });
            }
            
            // Aggiungi listener al pulsante di eliminazione
            const deleteButton = driver.querySelector('.delete-shift-btn');
            if (deleteButton) {
                deleteButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    
                    // Conferma l'eliminazione
                    confirmDeleteShiftDaily(driver);
                });
            }
        });
    }
      /**
     * Conferma eliminazione turno per la vista giornaliera
     */
    function confirmDeleteShiftDaily(driverElement) {
        if (!driverElement) return;
        
        // Ottieni le informazioni sul driver
        const driverId = driverElement.getAttribute('data-driver-id');
        const driverName = driverElement.querySelector('.driver-name').textContent;
        
        // Ottieni le informazioni sul turno dalla card
        const shiftCard = driverElement.closest('.daily-shift-card');
        const shiftHeader = shiftCard.querySelector('.shift-header h5').textContent;
        
        // Estrai il nome del turno dall'header (es. "Mattina - 9:00 - 11:00")
        let shiftName = '';
        if (shiftHeader.includes('Mattina')) {
            shiftName = 'mattina';
        } else if (shiftHeader.includes('Pranzo')) {
            shiftName = 'pranzo';
        } else if (shiftHeader.includes('Pomeriggio')) {
            shiftName = 'pomeriggio';
        } else if (shiftHeader.includes('Cena')) {
            shiftName = 'cena';
        }
        
        // Usa la data corrente per il giorno
        const currentDate = new Date();
        const dayNames = ['Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'];
        const dayName = dayNames[currentDate.getDay()];
        
        // Crea un ID unico per il toast
        const toastId = `delete-toast-${Date.now()}`;
        
        // Crea un elemento toast personalizzato con pulsanti di conferma e annulla
        const toastContainer = document.querySelector('.toast-container') || createToastContainer();
        
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-white bg-danger border-0';
        toast.id = toastId;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <div class="mb-2">Rimuovere <strong>${driverName}</strong> dal turno di <strong>${getShiftName(shiftName)}</strong> di <strong>${dayName}</strong>?</div>
                    <div class="mt-2 pt-2 border-top d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-light" id="cancel-${toastId}">Annulla</button>
                        <button type="button" class="btn btn-sm btn-danger" id="confirm-${toastId}">Conferma</button>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Chiudi"></button>
            </div>
        `;
        
        // Aggiungi il toast al container
        toastContainer.appendChild(toast);
        
        // Inizializza e mostra il toast
        const bsToast = new bootstrap.Toast(toast, { autohide: false });
        bsToast.show();
        
        // Gestisci il pulsante di annullamento
        document.getElementById(`cancel-${toastId}`).addEventListener('click', function() {
            bsToast.hide();
            
            // Rimuovi il toast dopo la chiusura
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 500);
        });
        
        // Gestisci il pulsante di conferma
        document.getElementById(`confirm-${toastId}`).addEventListener('click', function() {
            bsToast.hide();
            
            // Rimuovi l'elemento dalla DOM
            driverElement.parentNode.removeChild(driverElement);
            
            // Aggiorna il conteggio dei driver nella card
            updateShiftCount(shiftCard);
            
            // Se non ci sono più driver, aggiungi la classe empty e mostra il messaggio
            const remainingDrivers = shiftCard.querySelectorAll('.driver-shift-detail');
            if (remainingDrivers.length === 0) {
                shiftCard.classList.add('empty');
                
                // Crea e aggiungi il messaggio di turno vuoto se non esiste
                if (!shiftCard.querySelector('.empty-shift-message')) {
                    const emptyMsg = document.createElement('div');
                    emptyMsg.className = 'empty-shift-message';
                    emptyMsg.textContent = 'Nessun driver assegnato a questo turno';
                    
                    // Inserisci il messaggio prima del placeholder per aggiungere driver
                    const addPlaceholder = shiftCard.querySelector('.add-driver-placeholder');
                    if (addPlaceholder) {
                        addPlaceholder.parentNode.insertBefore(emptyMsg, addPlaceholder);
                    }
                }
            }
            
            // Segnala che ci sono modifiche non salvate
            turniModificati = true;
            showUnsavedChangesButton();
            
            // Mostra notifica di successo
            showToast(`Driver <strong>${driverName}</strong> rimosso dal turno`, 'success');
            
            // Rimuovi il toast dopo la chiusura
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 500);
        });
    }
    
    /**
     * Aggiorna il conteggio dei driver in una card della vista giornaliera
     */
    function updateShiftCount(shiftCard) {
        const badgeElement = shiftCard.querySelector('.badge-pill');
        if (!badgeElement) return;
        
        const drivers = shiftCard.querySelectorAll('.driver-shift-detail');
        const count = drivers.length;
        
        if (count > 0) {
            badgeElement.textContent = `${count} driver`;
            badgeElement.className = 'badge-pill bg-primary-light text-primary';
        } else {
            badgeElement.textContent = 'Nessun driver';
            badgeElement.className = 'badge-pill bg-secondary-light text-secondary';
        }
    }

    // API pubblica del modulo
    return {
        init,
        // Esponiamo alcune funzioni se necessario, ma manteniamo private quelle interne
        refresh: function() {
            // Reinizializza tutto
            initialized = false;
            init();
        }
    };
})();

// Avvia l'inizializzazione solo quando il DOM è completamente caricato
document.addEventListener('DOMContentLoaded', function() {
    // Verifichiamo che siamo nella pagina giusta
    if (document.querySelector('#turni')) {
        GestioneTurniDriver.init();
        console.log('Componente GestioneTurniDriver caricato');
    }
});