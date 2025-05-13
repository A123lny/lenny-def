
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
    
    // Gestione form impostazioni sicurezza
    const securitySettingsForm = document.getElementById('securitySettingsForm');
    if (securitySettingsForm) {
        securitySettingsForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulazione salvataggio
            showToast('Impostazioni di sicurezza aggiornate con successo', 'success');
            
            // In un'applicazione reale, qui si invierebbe una richiesta AJAX al server
            console.log('Impostazioni sicurezza aggiornate');
        });
        
        // Gestione toggle restrizioni IP
        const ipRestrictionsToggle = document.getElementById('ip_restrictions');
        const allowedIpsTextarea = document.getElementById('allowed_ips');
        
        if (ipRestrictionsToggle && allowedIpsTextarea) {
            ipRestrictionsToggle.addEventListener('change', function() {
                allowedIpsTextarea.disabled = !this.checked;
                if (!this.checked) {
                    allowedIpsTextarea.value = '';
                }
            });
            
            // Inizializzazione stato
            allowedIpsTextarea.disabled = !ipRestrictionsToggle.checked;
        }
    }
    
    // Gestione tabs ruoli e permessi
    const rolesTab = document.getElementById('rolesTab');
    if (rolesTab) {
        // Gestione filtro ruoli nella tab permessi
        const roleFilter = document.getElementById('roleFilter');
        if (roleFilter) {
            roleFilter.addEventListener('change', function() {
                const selectedRole = this.value;
                console.log('Filtro ruoli cambiato:', selectedRole);
                // Implementare la logica di filtro
            });
        }
        
        // Gestione ricerca utenti nella tab assegnazioni
        const userSearch = document.getElementById('userSearch');
        if (userSearch) {
            userSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                console.log('Ricerca utenti:', searchTerm);
                // Implementare la logica di ricerca
            });
        }
        
        // Gestione pulsante aggiungi ruolo
        const addRoleBtn = document.getElementById('addRoleBtn');
        if (addRoleBtn) {
            addRoleBtn.addEventListener('click', function() {
                // Mostra modale o form per aggiungere un nuovo ruolo
                alert('Funzionalità "Aggiungi Ruolo" in fase di sviluppo');
            });
        }
    }
    
    // Gestione pagina utenti
    const searchUsersInput = document.getElementById('searchUsers');
    if (searchUsersInput) {
        searchUsersInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            console.log('Ricerca utenti:', searchTerm);
            // Implementare la logica di ricerca utenti
        });
        
        const filterRoleSelect = document.getElementById('filterRole');
        if (filterRoleSelect) {
            filterRoleSelect.addEventListener('change', function() {
                const selectedRole = this.value;
                console.log('Filtro per ruolo:', selectedRole);
                // Implementare la logica di filtro per ruolo
            });
        }
        
        const addUserBtn = document.getElementById('addUserBtn');
        if (addUserBtn) {
            addUserBtn.addEventListener('click', function() {
                // Mostra modale o form per aggiungere un nuovo utente
                alert('Funzionalità "Aggiungi Utente" in fase di sviluppo');
            });
        }
    }
    
    // Gestione pagina integrazioni
    const integrationsTab = document.getElementById('integrationsTab');
    if (integrationsTab) {
        // Gestione toggle switches
        const toggleSwitches = document.querySelectorAll('.form-check-input[type="checkbox"]');
        toggleSwitches.forEach(function(toggle) {
            toggle.addEventListener('change', function() {
                const serviceName = this.id.replace('Toggle', '');
                if (this.checked) {
                    console.log(`Servizio ${serviceName} attivato`);
                    showToast(`Servizio ${serviceName} attivato`, 'success');
                } else {
                    console.log(`Servizio ${serviceName} disattivato`);
                    showToast(`Servizio ${serviceName} disattivato`, 'warning');
                }
                // In un'applicazione reale, qui si invierebbe una richiesta AJAX al server
            });
        });
        
        // Gestione pulsanti "mostra password"
        const eyeButtons = document.querySelectorAll('.input-group .btn-outline-secondary');
        eyeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const inputField = this.closest('.input-group').querySelector('input');
                const icon = this.querySelector('i');
                
                if (inputField.type === 'password') {
                    inputField.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    inputField.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
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
