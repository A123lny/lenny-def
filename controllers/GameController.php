<?php
/**
 * Controller dei giochi completamente ricreato da zero
 */
class GameControllerNew {
    
    /**
     * Mostra la panoramica dei giochi disponibili
     */
    public function overview() {
        // Dati statici per le stat card
        $stats = [
            [
                'title' => 'Giochi Attivi',
                'value' => '1',
                'icon' => 'fa-gamepad',
                'color' => 'primary'
            ],
            [
                'title' => 'Premi Distribuiti',
                'value' => '254',
                'icon' => 'fa-gift',
                'color' => 'success'
            ],
            [
                'title' => 'Giocate Totali',
                'value' => '1,782',
                'icon' => 'fa-play-circle',
                'color' => 'info'
            ],
            [
                'title' => 'Tasso di Conversione',
                'value' => '24.5%',
                'icon' => 'fa-chart-line',
                'color' => 'warning'
            ]
        ];
        
        // Dati statici per la tabella dei giochi
        $games = [
            [
                'id' => 1,
                'name' => 'Ruota e Vinci',
                'description' => 'Ruota la ruota per vincere sconti sui tuoi piatti preferiti.',
                'total_plays' => 1782,
                'total_wins' => 254,
                'prize_type' => 'Sconto',
                'status' => 'Attivo'
            ]
        ];
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/5-pages/games/overview.js'
        ];
        
        // Carica la vista
        include("views/games/overview.php");
    }
    
    /**
     * Mostra le statistiche dettagliate dei giochi
     */
    public function statistics() {
        // Statistiche mensili per i giochi (dati statici semplificati)
        $monthlyStats = [
            'Gennaio' => ['plays' => 250, 'wins' => 35],
            'Febbraio' => ['plays' => 340, 'wins' => 56],
            'Marzo' => ['plays' => 580, 'wins' => 89],
            'Aprile' => ['plays' => 612, 'wins' => 74],
        ];
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/5-pages/games/statistics.js'
        ];
        
        // Carica la vista
        include("views/games/statistics.php");
    }
}
?>