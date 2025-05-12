/**
 * Contact Handler - Gestione dei contatti nei turni driver
 * Separa la logica di gestione dei contatti dal drag and drop
 */

const DriverContactHandler = (function() {
    
    /**
     * Inizializza i gestori degli eventi per i contatti
     */
    function init() {
        console.log('Inizializzazione handler contatti driver...');
        
        // Gestione click sui contatti telefonici
        document.addEventListener('click', function(event) {
            const phoneLink = event.target.closest('.driver-phone');
            if (phoneLink) {
                event.preventDefault();
                event.stopPropagation();
                const phoneNumber = phoneLink.getAttribute('href').replace('tel:', '');
                console.log('Click su telefono:', phoneNumber);
                // Qui puoi aggiungere funzionalità aggiuntive, come tracking delle chiamate
                window.location.href = phoneLink.getAttribute('href');
            }
        });
        
        // Gestione click sui contatti WhatsApp
        document.addEventListener('click', function(event) {
            const waLink = event.target.closest('.driver-whatsapp');
            if (waLink) {
                event.preventDefault();
                event.stopPropagation();
                const waNumber = waLink.getAttribute('href').replace('https://wa.me/', '');
                console.log('Click su WhatsApp:', waNumber);
                // Apertura in nuova finestra per non interrompere il flusso
                window.open(waLink.getAttribute('href'), '_blank');
            }
        });
    }
    
    // Esponi l'API pubblica
    return {
        init
    };
})();

// Inizializza il modulo quando il DOM è pronto
document.addEventListener('DOMContentLoaded', function() {
    DriverContactHandler.init();
});
