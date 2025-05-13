<?php
/**
 * Controller per la gestione delle impostazioni
 */
class SettingsController {

    /**
     * Mostra la pagina principale delle impostazioni
     */
    public function index() {
        require_once 'views/settings/index.php';
    }

    /**
     * Mostra la pagina del profilo utente
     */
    public function profile() {
        require_once 'views/settings/profile.php';
    }
    
    /**
     * Gestisce la richiesta di eliminazione del profilo
     * Questo metodo verrebbe chiamato via AJAX nella versione completa
     */
    public function deleteProfile() {
        // In un'applicazione reale:
        // 1. Verificare la password dell'utente
        // 2. Rimuovere i dati dal database
        // 3. Terminare la sessione
        // 4. Reindirizzare alla pagina di login
        
        session_destroy();
        redirect('auth', 'login');
    }
    
    /**
     * Gestisce l'upload dell'avatar del profilo
     * Questo metodo verrebbe chiamato via AJAX nella versione completa
     */
    public function uploadAvatar() {
        // In un'applicazione reale:
        // 1. Verificare che il file sia stato caricato correttamente
        // 2. Validare il tipo di file (solo immagini)
        // 3. Ridimensionare l'immagine se necessario
        // 4. Salvare l'immagine nella cartella uploads/avatars
        // 5. Aggiornare il percorso dell'avatar nel database
        // 6. Restituire una risposta JSON con l'esito dell'operazione
        
        // Esempio di risposta JSON (simulato)
        $response = [
            'success' => true,
            'message' => 'Avatar aggiornato con successo',
            'avatar_path' => '/assets/images/uploads/avatar_123.jpg'
        ];
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    /**
     * Resetta l'avatar al valore predefinito
     * Questo metodo verrebbe chiamato via AJAX nella versione completa
     */
    public function resetAvatar() {
        // In un'applicazione reale:
        // 1. Reimpostare l'avatar predefinito nel database
        // 2. Eliminare l'avatar personalizzato se esiste
        // 3. Restituire una risposta JSON con l'esito dell'operazione
        
        // Esempio di risposta JSON (simulato)
        $response = [
            'success' => true,
            'message' => 'Avatar ripristinato al valore predefinito',
            'avatar_path' => '/assets/images/profilo.jpg'
        ];
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    /**
     * Mostra la pagina delle impostazioni di sistema
     */
    public function system() {
        require_once 'views/settings/system.php';
    }
    
    /**
     * Mostra la pagina delle impostazioni di sicurezza
     */
    public function security() {
        require_once 'views/settings/security.php';
    }
    
    /**
     * Mostra la pagina di gestione ruoli e permessi
     */
    public function roles() {
        require_once 'views/settings/roles.php';
    }
    
    /**
     * Mostra la pagina di gestione utenti
     */
    public function users() {
        require_once 'views/settings/users.php';
    }
    
    /**
     * Mostra la pagina delle integrazioni
     */
    public function integrations() {
        require_once 'views/settings/integrations.php';
    }
}