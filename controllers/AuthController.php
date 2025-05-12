<?php
class AuthController {
    public function login() {
        // Se l'utente è già loggato, reindirizza alla dashboard
        if (isset($_SESSION['user_id'])) {
            redirect('dashboard');
            exit;
        }
        
        // Definisce gli script JavaScript specifici per questa pagina
        $page_scripts = [
            'assets/js/5-pages/auth/login.js'
        ];
        
        // Altrimenti mostra la pagina di login
        require_once 'views/auth/login.php';
    }
    
    public function authenticate() {
        // Verificare le credenziali
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            // Per questa demo, usiamo credenziali statiche dal file di configurazione
            if ($username === ADMIN_USER && $password === ADMIN_PASS) {
                $_SESSION['user_id'] = 1;
                $_SESSION['username'] = $username;
                $_SESSION['fullname'] = 'Luca Admin';
                $_SESSION['role'] = 'admin';
                
                redirect('dashboard');
                exit;
            } else {
                // In un'implementazione reale, dovremmo controllare le credenziali nel database
                $db = new Database();
                $conn = $db->connect();
                
                $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
                $stmt->execute(['username' => $username]);
                $user = $stmt->fetch();
                
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['fullname'] = $user['fullname'];
                    $_SESSION['role'] = $user['role'];
                    
                    redirect('dashboard');
                    exit;
                } else {
                    $error = "Credenziali non valide. Riprova.";
                    require_once 'views/auth/login.php';
                }
            }
        } else {
            redirect('auth', 'login');
            exit;
        }
    }
    
    public function logout() {
        // Distruggere la sessione
        session_unset();
        session_destroy();
        
        // Reindirizzare al login
        redirect('auth', 'login');
        exit;
    }
}
?>
