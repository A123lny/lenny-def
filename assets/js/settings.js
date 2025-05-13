
/**
 * settings.js - Gestione delle funzionalità delle pagine di impostazioni
 */
document.addEventListener('DOMContentLoaded', function() {
    // Gestione form profilo
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validazione password
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (newPassword && newPassword !== confirmPassword) {
                showToast('Le password non corrispondono', 'error');
                return;
            }
            
            // Simulazione salvataggio
            showToast('Profilo aggiornato con successo', 'success');
            
            // In un'applicazione reale, qui si invierebbe una richiesta AJAX al server
            console.log('Profilo aggiornato');
        });
    }
    
    // Gestione form impostazioni sistema
    const systemSettingsForm = document.getElementById('systemSettingsForm');
    if (systemSettingsForm) {
        systemSettingsForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validazione URL
            const siteUrl = document.getElementById('siteUrl').value;
            if (siteUrl && !isValidUrl(siteUrl)) {
                showToast('URL del sito non valido', 'error');
                return;
            }
            
            // Simulazione salvataggio
            showToast('Impostazioni di sistema aggiornate con successo', 'success');
            
            // In un'applicazione reale, qui si invierebbe una richiesta AJAX al server
            console.log('Impostazioni sistema aggiornate');
        });
    }
    
    // Funzione per validare URL
    function isValidUrl(url) {
        try {
            new URL(url);
            return true;
        } catch (e) {
            return false;
        }
    }
    }
    
    // Funzione per mostrare toast di notifica
    function showToast(message, type = 'info') {
        // Verifica se esiste già una funzione globale per le notifiche
        if (typeof window.showToast === 'function') {
            window.showToast(message, type);
            return;
        }
        
        // Implementazione base di un toast se non esiste già
        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type}`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        // Animazione
        setTimeout(() => {
            toast.classList.add('show');
        }, 10);
        
        // Rimuovi dopo 3 secondi
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }
});
