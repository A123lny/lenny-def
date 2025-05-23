
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
    
    // Gestione avatar del profilo
    const changeAvatarBtn = document.getElementById('changeAvatarBtn');
    const avatarUpload = document.getElementById('avatarUpload');
    const resetAvatarBtn = document.getElementById('resetAvatarBtn');
    const profileAvatar = document.getElementById('profileAvatar');
    
    if (changeAvatarBtn && avatarUpload && resetAvatarBtn && profileAvatar) {
        // Trigger del caricamento file quando si clicca sul pulsante della fotocamera
        changeAvatarBtn.addEventListener('click', function() {
            avatarUpload.click();
        });
        
        // Gestione del caricamento file
        avatarUpload.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                
                // Verifica dimensione file (massimo 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    showToast('L\'immagine è troppo grande. Dimensione massima: 5MB', 'error');
                    return;
                }
                
                // Verifica tipo file
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    showToast('Formato non supportato. Usa JPG, PNG o GIF', 'error');
                    return;
                }
                
                // Anteprima immagine
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileAvatar.src = e.target.result;
                    showToast('Avatar aggiornato con successo', 'success');
                    
                    // In un'applicazione reale, qui si invierebbe il file al server
                    // tramite una chiamata AJAX (FormData)
                    console.log('Avatar aggiornato, file:', file.name);
                };
                reader.readAsDataURL(file);
            }
        });
        
        // Gestione reset avatar
        resetAvatarBtn.addEventListener('click', function() {
            // Reimpostazione dell'avatar predefinito
            const defaultAvatarPath = asset('images/profilo.jpg');
            profileAvatar.src = defaultAvatarPath;
            avatarUpload.value = ''; // Reset input file
            
            showToast('Avatar ripristinato', 'success');
            
            // In un'applicazione reale, qui si invierebbe una richiesta al server
            console.log('Avatar ripristinato al default');
        });
    }
    
    // Funzione helper per ottenere il percorso degli asset (simile alla funzione PHP asset())
    function asset(path) {
        // Rimuovi 'assets/' all'inizio se presente
        path = path.replace(/^assets\//, '');
        return '/assets/' + path;
    }
    
    // Gestione eliminazione profilo
    const confirmDeleteProfileBtn = document.getElementById('confirmDeleteProfile');
    if (confirmDeleteProfileBtn) {
        confirmDeleteProfileBtn.addEventListener('click', function() {
            const deleteConfirmPassword = document.getElementById('deleteConfirmPassword').value;
            
            if (!deleteConfirmPassword) {
                showToast('Inserisci la password per confermare', 'error');
                return;
            }
            
            // Simulazione processo di eliminazione
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteProfileModal'));
            modal.hide();
            
            // Mostra indicatore di caricamento
            showToast('Eliminazione profilo in corso...', 'info');
            
            // Simulazione richiesta al server (in un'app reale sarebbe una chiamata AJAX)
            setTimeout(function() {
                // Mostra messaggio di conferma
                showToast('Profilo eliminato con successo', 'success');
                
                // Redirect alla pagina di login dopo un breve ritardo
                setTimeout(function() {
                    window.location.href = '/auth/login';
                }, 2000);
            }, 1500);
            
            console.log('Richiesta eliminazione profilo inviata');
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
