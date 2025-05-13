<?php
// Debug temporaneo per capire il problema
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Informazioni sul server e sui percorsi
$debug_info = [
    'HTTP_HOST' => $_SERVER['HTTP_HOST'] ?? 'non definito',
    'REQUEST_URI' => $_SERVER['REQUEST_URI'] ?? 'non definito',
    'DOCUMENT_ROOT' => $_SERVER['DOCUMENT_ROOT'] ?? 'non definito',
    'SCRIPT_FILENAME' => $_SERVER['SCRIPT_FILENAME'] ?? 'non definito',
    'SCRIPT_NAME' => $_SERVER['SCRIPT_NAME'] ?? 'non definito',
    'PHP_SELF' => $_SERVER['PHP_SELF'] ?? 'non definito',
    'laragon_folder' => realpath(__DIR__) ?? 'non definito',
    'asset_test' => file_exists(realpath(__DIR__) . '/assets') ? 'Cartella assets trovata' : 'Cartella assets NON trovata'
];

session_start();
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'config/Router.php';
require_once 'config/helpers.php';
require_once 'controllers/MainController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/OrderController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/MenuController.php';
require_once 'controllers/CustomerController.php';
require_once 'controllers/DriverController.php';
require_once 'controllers/RestaurantController.php';
require_once 'controllers/CRMController.php';
require_once 'controllers/GameController.php';

// Inizializza il router
$router = new Router();

// Ottieni l'URI corrente
$requestUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
// Se c'è PATH_INFO, usa quello, altrimenti usa REQUEST_URI
$pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : $requestUri;

// Aggiungi informazioni di debug sul routing
$debug_info['raw_request_uri'] = $requestUri;
$debug_info['path_info'] = $pathInfo;
$debug_info['router_base_url'] = $router->getBaseUrl(); // Aggiungiamo questo metodo

// Analizza l'URI per determinare il controller e l'azione
$route = $router->match($pathInfo);

// Aggiungi informazioni sulla route trovata
$debug_info['route_match_result'] = $route ? 'Route trovata' : 'Nessuna route trovata';
if ($route) {
    $debug_info['controller'] = $route['controller'];
    $debug_info['action'] = $route['action'];
    $debug_info['params'] = $route['params'];
}

// Solo se l'URL contiene 'debug=1', mostra le informazioni e termina
if (isset($_GET['debug']) && $_GET['debug'] == '1') {
    echo '<pre>';
    print_r($debug_info);
    echo '</pre>';
    exit;
}

// Se non c'è corrispondenza o se stiamo utilizzando ancora il vecchio sistema GET
if ($route === null) {
    // Mantieni il sistema vecchio per retrocompatibilità
    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'main';
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';
    $params = [];
} else {
    // Usa il nuovo sistema di routing
    $controller = $route['controller'];
    $action = $route['action'];
    $params = $route['params'];
}

// Controllo autenticazione
if (!isset($_SESSION['user_id']) && $controller != 'auth') {
    redirect('auth', 'login');
    exit;
}

// Routing ai controller
switch ($controller) {
    case 'auth':
        $authController = new AuthController();
        if ($action == 'login') {
            $authController->login();
        } elseif ($action == 'logout') {
            $authController->logout();
        } elseif ($action == 'authenticate') {
            $authController->authenticate();
        }
        break;
    case 'dashboard':
        $dashboardController = new DashboardController();
        $dashboardController->index();
        break;
    case 'orders':
        $orderController = new OrderController();
        if ($action == 'index') {
            $orderController->index();
        } elseif ($action == 'active') {
            $orderController->active();
        } elseif ($action == 'refunds') {
            $orderController->refunds();
        } elseif ($action == 'refunds_analysis') {
            $orderController->refunds_analysis();
        } elseif ($action == 'analysis') {
            $orderController->analysis();
        } elseif ($action == 'view') {
            // Passa l'ID dell'ordine come parametro se disponibile
            $id = isset($params[0]) ? $params[0] : null;
            $orderController->view($id);
        }
        break;
    case 'menu':
        $menuController = new MenuController();
        if ($action == 'index') {
            $menuController->index();
        } elseif ($action == 'categories') {
            $menuController->categories();
        } elseif ($action == 'items') {
            $menuController->items();
        }
        break;
    case 'customers':
        $customerController = new CustomerController();
        if ($action == 'index') {
            $customerController->index();
        }
        break;
    case 'drivers':
        $driverController = new DriverController();
        if ($action == 'panoramica') {
            $driverController->panoramica();
        } elseif ($action == 'turni') {
            $driverController->turni();
        } elseif ($action == 'gestione_turni_driver') {
            $driverController->gestione_turni_driver();
        } elseif ($action == 'contratti') {
            $driverController->contratti();
        } elseif ($action == 'mezzi') {
            $driverController->mezzi();
        } elseif ($action == 'pagamenti') {
            $driverController->pagamenti();
        } elseif ($action == 'performance') {
            $driverController->performance();
        } elseif ($action == 'initialize') {
            $driverController->initialize();
        } elseif ($action == 'index') {
            $driverController->index();
        }
        break;
    case 'restaurants':
        $restaurantController = new RestaurantController();
        // Tutte le funzionalità sono gestite da index tramite modali
        $restaurantController->index();
        break;
    case 'crm':
        $crmController = new CRMController();
        if ($action == 'clients') {
            $crmController->clients();
        } elseif ($action == 'restaurants') {
            $crmController->restaurants();
        } elseif ($action == 'orders') {
            $crmController->orders();
        } elseif ($action == 'reviews') {
            $crmController->reviews();
        } elseif ($action == 'complaints') {
            $crmController->complaints();
        } elseif ($action == 'suggestions') {
            $crmController->suggestions();
        }
        break;
    case 'games':
        // Utilizziamo il nuovo controller dei giochi
        $gameController = new GameControllerNew();
        if ($action == 'overview') {
            $gameController->overview();
        } elseif ($action == 'statistics') {
            $gameController->statistics();
        }
        break;
    default:
        $mainController = new MainController();
        $mainController->index();
        break;
}
?>
