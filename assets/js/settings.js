
/**
 * JavaScript per la gestione delle impostazioni
 */
document.addEventListener('DOMContentLoaded', function() {
    // Gestione form profilo
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Simulazione salvataggio
            showToast('Modifiche salvate con successo!', 'success');
        });
    }
    
    // Gestione form impostazioni sistema
    const systemSettingsForm = document.getElementById('systemSettingsForm');
    if (systemSettingsForm) {
        systemSettingsForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Simulazione salvataggio
            showToast('Impostazioni di sistema aggiornate!', 'success');
        });
    }
    
    // Funzione per mostrare i toast
    function showToast(message, type = 'info') {
        // Cerca una funzione di toast esistente o crea un alert semplice
        if (typeof window.showToast === 'function') {
            window.showToast(message, type);
        } else {
            alert(message);
        }
    }
});
