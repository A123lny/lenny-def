/**
 * Gestione Turni - Pagina
 * Script per la gestione delle funzionalità specifiche della pagina turni
 */

// Utilizzo di un pattern che verifica se il modulo esiste già prima di crearlo
window.TurniManager = window.TurniManager || (function() {
    // Flag per controllare se lo script è già stato inizializzato
    let initialized = false;

    /**
     * Inizializza i componenti necessari
     */
    function initializeComponents() {
        console.log('Inizializzazione componenti pagina turni');
        
        // Verifica se il componente GestioneTurniDriver è disponibile e lo inizializza
        if (window.GestioneTurniDriver && typeof window.GestioneTurniDriver.init === 'function') {
            window.GestioneTurniDriver.init();
        } else {
            console.error('Componente GestioneTurniDriver non disponibile');
        }
        
        // Inizializza i componenti specifici di questa pagina
        // Ad esempio, potremmo avere funzionalità aggiuntive specifiche della pagina qui
    }    /**
     * Gestisce le interazioni specifiche della pagina con il componente di gestione turni
     */
    function setupPageSpecificHandlers() {
        // Aggiungiamo handlers specifici per la pagina, se necessario
        console.log('Configurazione handlers specifici della pagina turni');
        
        // Gestione dell'evento di aggiornamento turni
        document.addEventListener('turniUpdated', function(event) {
            console.log('Evento turniUpdated ricevuto dalla pagina:', event.detail);
            // Qui possiamo aggiungere logica specifica della pagina in risposta all'aggiornamento dei turni
        });
        
        // Gestione dell'evento di cambio settimana
        document.addEventListener('turniWeekChanged', function(event) {
            console.log('Cambio settimana rilevato:', event.detail);
            
            // Possiamo aggiungere funzionalità specifiche quando cambia la settimana
            const weekInfo = event.detail;
            
            // Esempio: mostra un messaggio quando si visualizza una settimana futura
            const today = new Date();
            if (weekInfo.startDate > today && !document.querySelector('.future-week-notice')) {
                showFutureWeekNotice(weekInfo.startDate);
            } else if (weekInfo.isCurrentWeek) {
                // Rimuovi eventuali notifiche per settimane future quando torniamo alla settimana corrente
                removeFutureWeekNotice();
            }
        });
    }
    
    /**
     * Mostra una notifica quando si visualizza una settimana futura
     * @param {Date} weekStartDate - La data di inizio della settimana visualizzata
     */
    function showFutureWeekNotice(weekStartDate) {
        // Rimuovi eventuali notifiche esistenti
        removeFutureWeekNotice();
        
        // Crea la notifica
        const notice = document.createElement('div');
        notice.className = 'alert alert-info future-week-notice mt-3 mb-0';
        notice.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-info-circle me-2"></i>
                <div>
                    <strong>Settimana futura</strong> - Stai visualizzando una programmazione futura.
                    <div class="small text-muted">In questa vista programmata non ci sono ancora dati disponibili.</div>
                </div>
            </div>
        `;
        
        // Inserisci la notifica dopo l'intestazione settimanale
        const weekHeaderContainer = document.querySelector('.week-header-container');
        if (weekHeaderContainer) {
            weekHeaderContainer.insertAdjacentElement('afterend', notice);
        }
    }
    
    /**
     * Rimuove la notifica per la settimana futura
     */
    function removeFutureWeekNotice() {
        const existingNotice = document.querySelector('.future-week-notice');
        if (existingNotice) {
            existingNotice.remove();
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
    }

    /**
     * Metodo di inizializzazione pubblico
     */
    function init() {
        console.log('TurniManager Pagina: Inizializzazione...');
        
        if (initialized) {
            console.log('TurniManager Pagina: Già inizializzato, reinizializzazione...');
        }
        
        // INIZIALIZZAZIONE COMPONENTI
        initializeComponents();
            
        // GESTIONE EVENTI SPECIFICI DELLA PAGINA
        setupPageSpecificHandlers();

        // Mostra il contenuto
        showContent();
        
        // Imposta il flag per prevenire la doppia inizializzazione
        initialized = true;
        
        console.log('TurniManager Pagina: Inizializzazione completata');
    }

    // API pubblica del modulo
    return {
        init,
        // Esponiamo alcune funzioni se necessario
        refresh: function() {
            // Reinizializza tutto
            initialized = false;
            init();
        }
    };
})();

// Avvia l'inizializzazione solo quando il DOM è completamente caricato
document.addEventListener('DOMContentLoaded', function() {
    // Inizializza il manager della pagina turni
    if (window.TurniManager && typeof window.TurniManager.init === 'function') {
        window.TurniManager.init();
        console.log('Pagina caricata: drivers/turni');
    } else {
        console.error('TurniManager non disponibile o non inizializzato correttamente');
    }
});