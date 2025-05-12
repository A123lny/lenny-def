<?php
/**
 * Router per gestire le Pretty URL
 * Questo file gestisce le rotte dell'applicazione Lenny Food Delivery
 */
class Router {
    private $routes = [];
    private $baseUrl;
    
    /**
     * Costruttore
     * @param string $baseUrl Il percorso base dell'applicazione (opzionale)
     */
    public function __construct($baseUrl = null) {
        // Determina automaticamente il baseUrl basato sull'host
        if ($baseUrl === null) {
            $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
            if (strtolower($host) === 'lenny1.test') {
                $this->baseUrl = '/';
            } else {
                $this->baseUrl = '/lenny1/';
            }
        } else {
            $this->baseUrl = $baseUrl;
        }
    }
    
    /**
     * Aggiunge una rotta
     * @param string $pattern Pattern URL (es. 'drivers/turni')
     * @param string $controller Nome del controller
     * @param string $action Nome dell'action
     */
    public function add($pattern, $controller, $action) {
        $this->routes[$pattern] = [
            'controller' => $controller,
            'action' => $action
        ];
    }
    
    /**
     * Cerca una corrispondenza tra l'URI richiesta e le rotte registrate
     * @param string $uri L'URI richiesta
     * @return array|null Dati della rotta o null se non trovata
     */
    public function match($uri) {
        // Rimuove la parte iniziale del path se presente
        if (strpos($uri, $this->baseUrl) === 0) {
            $uri = substr($uri, strlen($this->baseUrl));
        }
        
        // Rimuove la query string se presente
        if (($pos = strpos($uri, '?')) !== false) {
            $uri = substr($uri, 0, $pos);
        }
        
        // Rimuove lo slash iniziale e finale se presente
        $uri = trim($uri, '/');
        
        // Se l'URI è vuota, restituisci il controller e l'action di default
        if (empty($uri)) {
            return [
                'controller' => 'main',
                'action' => 'index',
                'params' => []
            ];
        }
        
        // Verifica le rotte statiche
        if (isset($this->routes[$uri])) {
            return [
                'controller' => $this->routes[$uri]['controller'],
                'action' => $this->routes[$uri]['action'],
                'params' => []
            ];
        }
        
        // Gestione delle rotte dinamiche
        $uriParts = explode('/', $uri);
        
        if (count($uriParts) >= 1) {
            $controller = $uriParts[0];
            $action = isset($uriParts[1]) ? $uriParts[1] : 'index';
            $params = array_slice($uriParts, 2);
            
            return [
                'controller' => $controller,
                'action' => $action,
                'params' => $params
            ];
        }
        
        // Nessuna corrispondenza trovata
        return null;
    }
    
    /**
     * Genera un URL basato su controller/action
     * @param string $controller Nome del controller
     * @param string $action Nome dell'action (opzionale)
     * @param array $params Parametri aggiuntivi (opzionale)
     * @return string URL completo
     */
    public function generateUrl($controller, $action = 'index', $params = []) {
        $url = $this->baseUrl . $controller;
        
        if ($action != 'index') {
            $url .= '/' . $action;
        }
        
        if (!empty($params)) {
            foreach ($params as $param) {
                $url .= '/' . $param;
            }
        }
        
        return $url;
    }

    /**
     * Restituisce il baseUrl corrente
     * @return string Il baseUrl configurato
     */
    public function getBaseUrl() {
        return $this->baseUrl;
    }
}