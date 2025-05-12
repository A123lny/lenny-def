<?php
/**
 * Funzioni helper per l'applicazione
 * Questo file contiene funzioni di utilità per l'applicazione Lenny Food Delivery
 */

// Istanza globale del router
global $router;

/**
 * Genera un URL per un controller e action
 * @param string $controller Nome del controller
 * @param string $action Nome dell'action (default: 'index')
 * @param array $params Parametri aggiuntivi (opzionale)
 * @return string URL completo
 */
function url($controller, $action = 'index', $params = []) {
    global $router;
    return $router->generateUrl($controller, $action, $params);
}

/**
 * Genera un URL per una risorsa statica con timestamp per evitare il caching
 * @param string $path Percorso della risorsa
 * @return string URL completo alla risorsa
 */
function asset($path) {
    // Determina il percorso base corretto basato sull'host
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
    
    // Rimuovi eventuali 'assets/' all'inizio del percorso se presente
    $path = ltrim($path, '/');
    if (strpos($path, 'assets/') === 0) {
        $path = substr($path, 7); // Rimuovi 'assets/'
    }
    
    if (strtolower($host) === 'lenny1.test') {
        // Per lenny1.test, il percorso base è solo /assets/
        $basePath = '/assets/';
        
        // Il percorso reale del file potrebbe essere in DOCUMENT_ROOT stesso o in DOCUMENT_ROOT/assets
        $possiblePaths = [
            $_SERVER['DOCUMENT_ROOT'] . '/assets/' . $path,
            rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/assets/' . $path
        ];
    } else {
        // Per localhost, il percorso base include /lenny1/
        $basePath = '/lenny1/assets/';
        
        // Il percorso reale del file è in DOCUMENT_ROOT/lenny1/assets
        $possiblePaths = [
            $_SERVER['DOCUMENT_ROOT'] . '/lenny1/assets/' . $path
        ];
    }
    
    // Verifica quale dei possibili percorsi esiste
    $timestamp = '';
    foreach ($possiblePaths as $testPath) {
        if (file_exists($testPath)) {
            $timestamp = '?v=' . filemtime($testPath);
            break;
        }
    }
    
    // Restituisci il percorso URL completo
    return $basePath . $path . $timestamp;
}

/**
 * Reindirizza a un'altra pagina
 * @param string $controller Nome del controller
 * @param string $action Nome dell'action (default: 'index')
 * @param array $params Parametri aggiuntivi (opzionale)
 */
function redirect($controller, $action = 'index', $params = []) {
    global $router;
    $url = $router->generateUrl($controller, $action, $params);
    header("Location: $url");
    exit;
}