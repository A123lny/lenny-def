<?php
// Configurazione dell'applicazione
define('APP_NAME', 'Lenny Food Delivery');
define('APP_URL', 'https://' . (getenv('REPL_SLUG') && getenv('REPL_OWNER') ? getenv('REPL_SLUG') . '.' . getenv('REPL_OWNER') . '.repl.co' : 'localhost:5000'));
define('APP_VERSION', '1.0.0');

// Configurazione del database
define('DB_HOST', 'localhost');
define('DB_NAME', 'lenny1db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_PORT', 3306);

// Configurazione delle credenziali di login
define('ADMIN_USER', 'luca');
define('ADMIN_PASS', 'lenny');

// Impostazioni varie
define('DEBUG_MODE', true);

// Gestione degli errori
if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}
?>
