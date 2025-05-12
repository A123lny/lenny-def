<?php require_once 'views/layout/header.php'; ?>

<div class="section-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="section-title">Giochi Promozionali</h2>
        <p class="section-subtitle">Gestisci e testa i giochi disponibili nell'app mobile per i tuoi clienti</p>
    </div>
</div>

<!-- Statistiche principali nello stile della dashboard -->
<div class="stats-grid mb-4">
    <div class="stat-card stat-card-primary animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-gamepad"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Giochi Attivi</div>
            <div class="stat-value">5</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 1 in più rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-secondary animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-gift"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Premi Distribuiti</div>
            <div class="stat-value">1.254</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 8.3% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-1 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-play-circle"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Giocate Totali</div>
            <div class="stat-value">15.782</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 12.6% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-2 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-chart-line"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Tasso di Conversione</div>
            <div class="stat-value">24.5%</div>
            <div class="stat-change negative">
                <i class="fas fa-arrow-down"></i> 1.2% rispetto al mese scorso
            </div>
        </div>
    </div>
</div>

<!-- Tabella giochi -->
<div class="games-container mb-4">
    <!-- Intestazione -->
    <div class="games-header">
        <div class="d-flex align-items-center flex-wrap">
            <div class="input-group search-box me-2 mb-2">
                <span class="input-group-text">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control" id="searchQuery" placeholder="Cerca gioco...">
            </div>
        </div>
    </div>

    <!-- Tabella giochi -->
    <div class="games-table">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome Gioco</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Giocate Totali</th>
                    <th scope="col">Vincite</th>
                    <th scope="col">Tipo Premio</th>
                    <th scope="col">Stato</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                <!-- Gioco 1 -->
                <tr>
                    <td><strong>1</strong></td>
                    <td>Ruota e Vinci</td>
                    <td>Ruota la ruota e vinci premi istantanei come sconti, consegne gratuite o piatti omaggio</td>
                    <td>5.240</td>
                    <td>1.245</td>
                    <td><span class="status-badge badge-success">Vari</span></td>
                    <td><span class="status-badge badge-primary">Attivo</span></td>
                    <td>
                        <div class="action-buttons">
                            <a href="#" class="action-btn view-btn test-game" data-bs-toggle="tooltip" title="Testa" data-id="1" data-name="Ruota e Vinci">
                                <i class="fas fa-gamepad"></i>
                            </a>
                            <a href="#" class="action-btn edit-btn edit-game" data-bs-toggle="tooltip" title="Modifica" data-id="1" data-name="Ruota e Vinci">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                
                <!-- Gioco 2 -->
                <tr>
                    <td><strong>2</strong></td>
                    <td>Quiz Gastronomico</td>
                    <td>Rispondi a domande sul cibo e sulla cucina per vincere premi esclusivi</td>
                    <td>3.890</td>
                    <td>782</td>
                    <td><span class="status-badge badge-info">Sconto</span></td>
                    <td><span class="status-badge badge-primary">Attivo</span></td>
                    <td>
                        <div class="action-buttons">
                            <a href="#" class="action-btn view-btn test-game" data-bs-toggle="tooltip" title="Testa" data-id="2" data-name="Quiz Gastronomico">
                                <i class="fas fa-gamepad"></i>
                            </a>
                            <a href="#" class="action-btn edit-btn edit-game" data-bs-toggle="tooltip" title="Modifica" data-id="2" data-name="Quiz Gastronomico">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                
                <!-- Gioco 3 -->
                <tr>
                    <td><strong>3</strong></td>
                    <td>Memory Food</td>
                    <td>Trova le coppie di piatti identici prima che scada il tempo per vincere premi</td>
                    <td>2.970</td>
                    <td>543</td>
                    <td><span class="status-badge badge-warning">Punti</span></td>
                    <td><span class="status-badge badge-primary">Attivo</span></td>
                    <td>
                        <div class="action-buttons">
                            <a href="#" class="action-btn view-btn test-game" data-bs-toggle="tooltip" title="Testa" data-id="3" data-name="Memory Food">
                                <i class="fas fa-gamepad"></i>
                            </a>
                            <a href="#" class="action-btn edit-btn edit-game" data-bs-toggle="tooltip" title="Modifica" data-id="3" data-name="Memory Food">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                
                <!-- Gioco 4 -->
                <tr>
                    <td><strong>4</strong></td>
                    <td>Slot della Fortuna</td>
                    <td>Fai girare la slot machine a tema food per vincere consegne gratuite e sconti</td>
                    <td>2.345</td>
                    <td>512</td>
                    <td><span class="status-badge badge-accent">Consegna</span></td>
                    <td><span class="status-badge badge-primary">Attivo</span></td>
                    <td>
                        <div class="action-buttons">
                            <a href="#" class="action-btn view-btn test-game" data-bs-toggle="tooltip" title="Testa" data-id="4" data-name="Slot della Fortuna">
                                <i class="fas fa-gamepad"></i>
                            </a>
                            <a href="#" class="action-btn edit-btn edit-game" data-bs-toggle="tooltip" title="Modifica" data-id="4" data-name="Slot della Fortuna">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                
                <!-- Gioco 5 -->
                <tr>
                    <td><strong>5</strong></td>
                    <td>Chef Challenge</td>
                    <td>Sfida virtuale: indovina gli ingredienti segreti di un piatto per vincere premi</td>
                    <td>1.337</td>
                    <td>217</td>
                    <td><span class="status-badge badge-success">Piatto</span></td>
                    <td><span class="status-badge badge-primary">Attivo</span></td>
                    <td>
                        <div class="action-buttons">
                            <a href="#" class="action-btn view-btn test-game" data-bs-toggle="tooltip" title="Testa" data-id="5" data-name="Chef Challenge">
                                <i class="fas fa-gamepad"></i>
                            </a>
                            <a href="#" class="action-btn edit-btn edit-game" data-bs-toggle="tooltip" title="Modifica" data-id="5" data-name="Chef Challenge">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Paginazione e info -->
    <div class="games-footer">
        <div class="text-muted small">
            Mostrando <strong>5</strong> di <strong>5</strong> giochi
        </div>
    </div>
</div>

<!-- Modal Test Gioco -->
<div class="modal fade" id="testGameModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="testGameModalLabel"><i class="fas fa-gamepad me-2"></i>Testa Gioco: <span id="gameTestTitle"></span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <span id="gameRules">Caricamento regole in corso...</span>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div id="gameTestContainer" class="game-container">
                            <!-- Il contenuto del gioco sarà caricato qui dinamicamente -->
                            <div class="text-center py-5">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Caricamento...</span>
                                </div>
                                <p class="mt-2">Caricamento del gioco in corso...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Modifica Gioco -->
<div class="modal fade" id="editGameModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-secondary text-white">
                <h5 class="modal-title" id="editGameModalLabel"><i class="fas fa-edit me-2"></i>Modifica Gioco: <span id="gameEditTitle"></span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editGameForm">
                <div class="modal-body">
                    <input type="hidden" id="gameId" name="id">
                    
                    <div class="mb-3">
                        <label for="gameName" class="form-label">Nome del Gioco</label>
                        <input type="text" class="form-control" id="gameName" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="gameDescription" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="gameDescription" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Premi</label>
                        <div id="gamePrizes">
                            <div class="prize-item mb-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="prizes[]" placeholder="Premio">
                                    <input type="number" class="form-control" name="probability[]" placeholder="% Probabilità" min="0" max="100">
                                    <button type="button" class="btn btn-danger remove-prize"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-success mt-2" id="addPrize">
                            <i class="fas fa-plus-circle"></i> Aggiungi Premio
                        </button>
                    </div>
                    
                    <div class="mb-3">
                        <label for="gameStatus" class="form-label">Stato</label>
                        <select class="form-select" id="gameStatus" name="status">
                            <option value="Attivo">Attivo</option>
                            <option value="Inattivo">Inattivo</option>
                            <option value="In Manutenzione">In Manutenzione</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="gameDifficulty" class="form-label">Difficoltà</label>
                        <div class="range">
                            <input type="range" class="form-range" id="gameDifficulty" name="difficulty" min="1" max="10" value="5">
                            <div class="d-flex justify-content-between">
                                <span>Facile</span>
                                <span>Medio</span>
                                <span>Difficile</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Container principale per i giochi - scope limitato con prefisso .games- */
    .games-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    /* Intestazione con i filtri */
    .games-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
        border-bottom: 1px solid #edf2f7;
        background-color: #fdfdfd;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    /* Configurazione del box di ricerca */
    .games-container .search-box {
        max-width: 350px;
        flex-grow: 1;
    }
    
    .games-container .search-box .input-group-text {
        background-color: white;
        border-right: none;
    }
    
    .games-container .search-box .form-control {
        border-left: none;
    }
    
    .games-container .search-box .form-control:focus {
        box-shadow: none;
        border-color: #ced4da;
    }
    
    /* Tabella giochi */
    .games-table {
        overflow-x: auto;
    }
    
    .games-container .table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse;
    }
    
    .games-container .table th, 
    .games-container .table td {
        padding: 0.75rem 1rem;
        vertical-align: middle;
    }
    
    .games-container .table th {
        font-weight: 600;
        border-bottom: 1px solid var(--color-grey-200);
        background-color: #f9fafb;
        color: #64748b;
    }
    
    .games-container .table td {
        border-bottom: 1px solid rgba(0,0,0,0.05);
        white-space: nowrap; /* Impedisce che il testo vada a capo */
    }
    
    .games-container .table tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Status Badge - usando lo stile della dashboard */
    .status-badge {
        display: inline-block;
        padding: 0.35em 0.8em;
        font-size: 0.75em;
        font-weight: 600;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 50rem;
    }
    
    .badge-primary {
        background-color: rgba(255, 90, 95, 0.1);
        color: #ff5a5f;
    }
    
    .badge-info {
        background-color: rgba(0, 149, 255, 0.1);
        color: #0095ff;
    }
    
    .badge-warning {
        background-color: rgba(255, 170, 0, 0.1);
        color: #ffaa00;
    }
    
    .badge-success {
        background-color: rgba(0, 214, 143, 0.1);
        color: #00d68f;
    }
    
    .badge-accent {
        background-color: rgba(138, 43, 226, 0.1);
        color: #8a2be2;
    }
    
    /* Pulsanti azioni */
    .games-container .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .games-container .action-btn {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--border-radius);
        color: white;
        text-decoration: none;
        transition: var(--transition-base);
        font-size: 0.8rem;
    }
    
    .games-container .view-btn {
        background: var(--gradient-primary);
    }
    
    .games-container .edit-btn {
        background: var(--gradient-secondary);
    }
    
    .games-container .action-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        color: white;
    }
    
    /* Footer con paginazione */
    .games-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 12px 16px;
        background-color: #fdfdfd;
        border-top: 1px solid #edf2f7;
    }
    
    /* Game container */
    .game-container {
        min-height: 400px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        background-color: #f8f9fa;
    }
    
    /* Wheel Game Styles - Redesigned with corrected text positioning */
    .wheel-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        padding-top: 20px;
    }
    
    .wheel-wrapper {
        position: relative;
        width: 320px;
        height: 320px;
        margin: 0 auto 30px;
    }
    
    .wheel {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        position: relative;
        overflow: hidden;
        border: 8px solid #333;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1), 0 6px 10px rgba(0,0,0,0.15), 0 0 0 15px rgba(255, 90, 95, 0.1);
        transition: transform 4s cubic-bezier(0.17, 0.67, 0.12, 1);
        transform: rotate(0deg);
        background: repeating-conic-gradient(
            #FF6B6B 0deg calc(360deg / 8), 
            #FFD166 calc(360deg / 8) calc(360deg / 8 * 2),
            #FF6B6B calc(360deg / 8 * 2) calc(360deg / 8 * 3),
            #FFD166 calc(360deg / 8 * 3) calc(360deg / 8 * 4),
            #FF6B6B calc(360deg / 8 * 4) calc(360deg / 8 * 5),
            #FFD166 calc(360deg / 8 * 5) calc(360deg / 8 * 6),
            #FF6B6B calc(360deg / 8 * 6) calc(360deg / 8 * 7),
            #FFD166 calc(360deg / 8 * 7) 360deg
        );
    }
    
    .wheel-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        background: #333;
        border-radius: 50%;
        border: 4px solid white;
        z-index: 10;
        box-shadow: 0 0 0 4px #FF6B6B;
    }
    
    .wheel-slice {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        transform-origin: 50% 50%;
        clip-path: polygon(50% 50%, 50% 0%, 100% 0%, 100% 50%);
    }
    
    .wheel-text {
        position: absolute;
        right: 0;
        text-align: center;
        width: 85px;
        top: 40px;
        transform-origin: center;
        color: #333;
        font-weight: bold;
        font-size: 14px;
        text-shadow: 1px 1px 1px rgba(255,255,255,0.7);
        -webkit-font-smoothing: antialiased;
        z-index: 5;
        padding-right: 20px;
    }
    
    .wheel-marker {
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 40px;
        z-index: 5;
    }
    
    .wheel-marker svg {
        width: 100%;
        height: 100%;
        filter: drop-shadow(0px 2px 2px rgba(0,0,0,0.3));
    }
    
    .spin-button {
        background: linear-gradient(135deg, #FF6B6B, #FF8C61);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(255, 90, 95, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .spin-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(255, 90, 95, 0.4);
    }
    
    .spin-button:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(255, 90, 95, 0.4);
    }
    
    .spin-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: all 0.6s;
    }
    
    .spin-button:hover::before {
        left: 100%;
    }
    
    .wheel-shine {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(255,255,255,0.25) 0%, rgba(255,255,255,0) 60%);
        pointer-events: none;
    }
    
    .result-container {
        height: 60px;
        margin-top: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .win-animation {
        display: none;
        margin-top: 20px;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        color: #FF6B6B;
        animation: winPulse 0.5s infinite alternate;
    }
    
    @keyframes winPulse {
        from {
            transform: scale(1);
            text-shadow: 0 0 10px rgba(255, 107, 107, 0.5);
        }
        to {
            transform: scale(1.1);
            text-shadow: 0 0 20px rgba(255, 107, 107, 0.8);
        }
    }
    
    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        opacity: 0;
    }
    
    @keyframes confetti-fall {
        0% {
            transform: translateY(-100px) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(300px) rotate(360deg);
            opacity: 0;
        }
    }
    
    /* Quiz Game Styles */
    .quiz-container {
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Memory Game Styles */
    .memory-container {
        max-width: 600px;
        margin: 0 auto;
    }
    
    .memory-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        margin-top: 20px;
    }
    
    .memory-card {
        height: 80px;
        background-color: #007bff;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
        cursor: pointer;
        transition: transform 0.3s;
    }
    
    /* Slot Machine Styles */
    .slot-machine {
        max-width: 400px;
        margin: 0 auto;
        text-align: center;
    }
    
    .slot-window {
        display: flex;
        justify-content: space-around;
        background-color: #333;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    
    .slot-reel {
        width: 80px;
        height: 80px;
        background-color: white;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 40px;
    }
    
    /* Chef Challenge Styles */
    .chef-challenge {
        max-width: 500px;
        margin: 0 auto;
    }
    
    /* Prize item */
    .prize-item {
        position: relative;
    }
    
    .remove-prize {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }
    
    /* Range styles */
    .range {
        position: relative;
        padding-top: 5px;
        padding-bottom: 5px;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inizializzazione dei tooltip di Bootstrap
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => {
        new bootstrap.Tooltip(tooltip);
    });
    
    // Ricerca nella tabella
    const searchInput = document.getElementById('searchQuery');
    if(searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('.games-table tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if(text.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Aggiorna conteggio
            updateGamesCount();
        });
    }
    
    // Test Game Modal Handlers
    const testButtons = document.querySelectorAll('.test-game');
    if (testButtons) {
        testButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const gameId = this.getAttribute('data-id');
                const gameName = this.getAttribute('data-name');
                
                document.getElementById('gameTestTitle').textContent = gameName;
                
                // Show the modal
                const modal = new bootstrap.Modal(document.getElementById('testGameModal'));
                modal.show();
                
                // Simula il caricamento dei dati del gioco
                setTimeout(() => {
                    let gameData;
                    
                    // Simuliamo i dati di gioco in base all'ID
                    switch(parseInt(gameId)) {
                        case 1: // Ruota e Vinci
                            gameData = {
                                rules: 'Gira la ruota e vinci uno sconto sul tuo prossimo ordine! Ogni sezione della ruota contiene un premio diverso.',
                                type: 'wheel',
                                options: ['5% Sconto', '10% Sconto', '15% Sconto', 'Nessun premio', 'Consegna gratuita', 'Nessun premio', '20% Sconto', 'Nessun premio']
                            };
                            break;
                        case 2: // Quiz Gastronomico
                            gameData = {
                                rules: 'Rispondi a 3 domande sul cibo. Per vincere un premio devi indovinare almeno 2 risposte!',
                                type: 'quiz',
                                questions: [
                                    {question: 'Qual è l\'ingrediente principale della pizza Margherita?', options: ['Mozzarella', 'Prosciutto', 'Tonno', 'Salmone'], correct: 0},
                                    {question: 'Quale è il piatto tradizionale della cucina romana?', options: ['Risotto', 'Carbonara', 'Pesto', 'Tiramisu'], correct: 1},
                                    {question: 'Da dove ha origine la pizza?', options: ['Roma', 'Milano', 'Napoli', 'Firenze'], correct: 2}
                                ]
                            };
                            break;
                        case 3: // Memory Food
                            gameData = {
                                rules: 'Trova tutte le coppie di cibi identici prima che scada il tempo! Hai 60 secondi per completare il gioco.',
                                type: 'memory',
                                items: ['🍕', '🍔', '🍟', '🌮', '🍣', '🍜', '🍱', '🥗']
                            };
                            break;
                        case 4: // Slot della Fortuna
                            gameData = {
                                rules: 'Fai girare la slot machine! Se ottieni tre simboli uguali vinci un premio speciale. Due simboli uguali ti danno un premio minore.',
                                type: 'slot',
                                symbols: ['🍕', '🍔', '🍟', '🌮', '🍣']
                            };
                            break;
                        case 5: // Chef Challenge
                            gameData = {
                                rules: 'Lo chef ha preparato un piatto segreto! Indovina gli ingredienti principali entro 5 tentativi per vincere.',
                                type: 'chef-challenge',
                                ingredients: ['basilico', 'pomodoro', 'parmigiano', 'pepe', 'cipolla', 'aglio', 'zucchero', 'sale']
                            };
                            break;
                    }
                    
                    // Aggiorna il contenuto della modale
                    document.getElementById('gameRules').textContent = gameData.rules;
                    
                    // Imposta il contenuto del gioco
                    const gameContainer = document.getElementById('gameTestContainer');
                    
                    switch(gameData.type) {
                        case 'wheel':
                            gameContainer.innerHTML = createWheelGame(gameData);
                            initWheelGame(gameData);
                            break;
                        case 'quiz':
                            gameContainer.innerHTML = createQuizGame(gameData);
                            initQuizGame(gameData);
                            break;
                        case 'memory':
                            gameContainer.innerHTML = createMemoryGame(gameData);
                            initMemoryGame(gameData);
                            break;
                        case 'slot':
                            gameContainer.innerHTML = createSlotGame(gameData);
                            initSlotGame(gameData);
                            break;
                        case 'chef-challenge':
                            gameContainer.innerHTML = createChefChallenge(gameData);
                            initChefChallenge(gameData);
                            break;
                    }
                }, 1000);
            });
        });
    }
    
    // Edit Game Modal Handlers
    const editButtons = document.querySelectorAll('.edit-game');
    if (editButtons) {
        editButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const gameId = this.getAttribute('data-id');
                const gameName = this.getAttribute('data-name');
                
                document.getElementById('gameEditTitle').textContent = gameName;
                document.getElementById('gameId').value = gameId;
                document.getElementById('gameName').value = gameName;
                
                // Ottieni altri dati dal DOM
                const row = this.closest('tr');
                document.getElementById('gameDescription').value = row.querySelector('td:nth-child(3)').textContent;
                
                // Popola i premi in base al gioco
                let prizes = [];
                switch(parseInt(gameId)) {
                    case 1: // Ruota e Vinci
                        prizes = [
                            {name: "5% Sconto", probability: 25},
                            {name: "10% Sconto", probability: 15},
                            {name: "15% Sconto", probability: 10},
                            {name: "Consegna gratuita", probability: 10},
                            {name: "20% Sconto", probability: 5}
                        ];
                        break;
                    case 2: // Quiz Gastronomico
                        prizes = [
                            {name: "15% Sconto", probability: 60},
                            {name: "30% Sconto", probability: 40}
                        ];
                        break;
                    case 3: // Memory Food
                        prizes = [
                            {name: "50 Punti Fedeltà", probability: 70},
                            {name: "100 Punti Fedeltà", probability: 30}
                        ];
                        break;
                    case 4: // Slot della Fortuna
                        prizes = [
                            {name: "Consegna Gratuita", probability: 50},
                            {name: "Consegna Gratuita + 10% Sconto", probability: 25},
                            {name: "Consegna Gratuita + 20% Sconto", probability: 10}
                        ];
                        break;
                    case 5: // Chef Challenge
                        prizes = [
                            {name: "Piatto Omaggio", probability: 80},
                            {name: "Menu Completo", probability: 20}
                        ];
                        break;
                }
                
                // Popola il container dei premi
                const prizesContainer = document.getElementById('gamePrizes');
                prizesContainer.innerHTML = '';
                
                prizes.forEach(prize => {
                    const prizeItem = document.createElement('div');
                    prizeItem.className = 'prize-item mb-2';
                    prizeItem.innerHTML = `
                        <div class="input-group">
                            <input type="text" class="form-control" name="prizes[]" value="${prize.name}" placeholder="Premio">
                            <input type="number" class="form-control" name="probability[]" value="${prize.probability}" placeholder="% Probabilità" min="0" max="100">
                            <button type="button" class="btn btn-danger remove-prize"><i class="fas fa-trash"></i></button>
                        </div>
                    `;
                    prizesContainer.appendChild(prizeItem);
                    
                    // Aggiungi l'event listener al pulsante rimuovi
                    prizeItem.querySelector('.remove-prize').addEventListener('click', function() {
                        prizeItem.remove();
                    });
                });
                
                // Imposta lo stato e la difficoltà
                document.getElementById('gameStatus').value = "Attivo";
                document.getElementById('gameDifficulty').value = 5;
                
                // Mostra la modale
                const modal = new bootstrap.Modal(document.getElementById('editGameModal'));
                modal.show();
            });
        });
    }
    
    // Add Prize Button Handler
    document.getElementById('addPrize').addEventListener('click', function() {
        const prizeItem = document.createElement('div');
        prizeItem.className = 'prize-item mb-2';
        prizeItem.innerHTML = `
            <div class="input-group">
                <input type="text" class="form-control" name="prizes[]" placeholder="Premio">
                <input type="number" class="form-control" name="probability[]" placeholder="% Probabilità" min="0" max="100">
                <button type="button" class="btn btn-danger remove-prize"><i class="fas fa-trash"></i></button>
            </div>
        `;
        document.getElementById('gamePrizes').appendChild(prizeItem);
        
        // Aggiungi l'event listener al pulsante rimuovi
        prizeItem.querySelector('.remove-prize').addEventListener('click', function() {
            prizeItem.remove();
        });
    });
    
    // Edit Game Form Submit Handler
    document.getElementById('editGameForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Simuliamo il salvataggio
        const gameId = document.getElementById('gameId').value;
        const gameName = document.getElementById('gameName').value;
        
        // Feedback all'utente
        alert(`Le modifiche al gioco "${gameName}" sono state salvate con successo!`);
        
        // Chiudi la modale
        bootstrap.Modal.getInstance(document.getElementById('editGameModal')).hide();
    });
    
    // Funzione per aggiornare il conteggio dei giochi visualizzati
    function updateGamesCount() {
        const visibleGames = document.querySelectorAll('.games-table tbody tr:not([style*="display: none"])');
        const countElement = document.querySelector('.games-footer .text-muted strong:first-child');
        
        if (countElement) {
            countElement.textContent = visibleGames.length;
        }
    }
    
    // Funzioni per creare i contenuti dei giochi
    function createWheelGame(data) {
        return `
            <div class="wheel-container">
                <div class="wheel-wrapper">
                    <div class="wheel-marker">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#333">
                            <path d="M12 2L2 22h20L12 2z"/>
                        </svg>
                    </div>
                    <div class="wheel" id="wheel">
                        <div class="wheel-shine"></div>
                    </div>
                    <div class="wheel-center"></div>
                </div>
                <div class="result-container">
                    <div class="win-animation" id="win-animation">
                        <span id="win-text"></span> <i class="fas fa-gift"></i>
                    </div>
                </div>
                <button id="spin-button" class="spin-button">
                    <i class="fas fa-sync-alt me-2"></i> GIRA LA RUOTA!
                </button>
            </div>
        `;
    }
    
    function createQuizGame(data) {
        return `
            <div class="quiz-container">
                <div id="question" class="mb-4"></div>
                <div id="options" class="d-grid gap-2"></div>
                <button id="next-button" class="btn btn-primary mt-3">Prossima</button>
        `;
    }
    
    function createMemoryGame(data) {
        return `
            <div class="memory-container">
                <div class="memory-timer">Tempo: <span id="timer">60</span>s</div>
                <div class="memory-grid" id="memory-grid"></div>
            </div>
        `;
    }
    
    function createSlotGame(data) {
        return `
            <div class="slot-machine">
                <div class="slot-window" id="slot-window">
                    <div class="slot-reel" id="reel1"></div>
                    <div class="slot-reel" id="reel2"></div>
                    <div class="slot-reel" id="reel3"></div>
                </div>
                <button id="spin-slot" class="btn btn-danger mt-3">Gira!</button>
            </div>
        `;
    }
    
    function createChefChallenge(data) {
        return `
            <div class="chef-challenge">
                <div class="chef-image text-center mb-3">
                    <i class="fas fa-user-chef fa-5x"></i>
                </div>
                <div class="ingredient-guess">
                    <input type="text" id="guess-input" class="form-control mb-2" placeholder="Inserisci un ingrediente">
                    <button id="guess-button" class="btn btn-success">Indovina!</button>
                </div>
                <div id="guesses-list" class="mt-3"></div>
            </div>
        `;
    }
    
    // Funzioni per inizializzare la logica dei giochi
    function initWheelGame(data) {
        const wheelContainer = document.querySelector('.wheel-container');
        const wheel = document.getElementById('wheel');
        const spinButton = document.getElementById('spin-button');
        const winAnimation = document.getElementById('win-animation');
        const winText = document.getElementById('win-text');
        
        // Clear any existing content
        while (wheel.firstChild) {
            if (wheel.lastChild.className !== 'wheel-shine') {
                wheel.removeChild(wheel.lastChild);
            } else {
                break;
            }
        }
        
        // Create wheel sections with properly positioned text
        const options = data.options;
        const sectionAngle = 360 / options.length;
        
        options.forEach((option, index) => {
            // Create a unique slice for each option
            const sliceAngle = index * sectionAngle;
            const slice = document.createElement('div');
            slice.className = 'wheel-slice';
            slice.style.transform = `rotate(${sliceAngle}deg)`;
            
            // Create the text label
            const textLabel = document.createElement('div');
            textLabel.className = 'wheel-text';
            textLabel.textContent = option;
            textLabel.style.transform = `rotate(${sectionAngle/2}deg)`;
            
            slice.appendChild(textLabel);
            wheel.appendChild(slice);
        });
        
        // Initial position
        let isSpinning = false;
        
        // Spin functionality
        spinButton.addEventListener('click', function() {
            if (isSpinning) return;
            isSpinning = true;
            
            // Hide previous win
            winAnimation.style.display = 'none';
            
            // Create confetti for win effect
            createConfetti();
            
            // Reset rotation to prevent issues with multiple spins
            wheel.style.transition = 'none';
            wheel.style.transform = 'rotate(0deg)';
            
            // Force reflow to make the transition reset work
            void wheel.offsetWidth;
            
            const spins = 5; // Number of full spins
            const extraAngle = Math.floor(Math.random() * 360); // Random final position
            const totalRotation = spins * 360 + extraAngle;
            
            wheel.style.transition = 'transform 4s cubic-bezier(0.17, 0.67, 0.12, 1)';
            wheel.style.transform = `rotate(${totalRotation}deg)`;
            
            // Disable button during spin with visual feedback
            spinButton.disabled = true;
            spinButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Girando...';
            
            // Result after spinning
            setTimeout(() => {
                const winningIndex = Math.floor(options.length - (extraAngle / sectionAngle) % options.length) % options.length;
                const prize = options[winningIndex];
                
                // Show winning animation
                winText.textContent = prize;
                winAnimation.style.display = 'block';
                
                // Re-enable button
                spinButton.disabled = false;
                spinButton.innerHTML = '<i class="fas fa-sync-alt me-2"></i> GIRA ANCORA!';
                isSpinning = false;
                
                // Launch confetti if it's a prize (not "Nessun premio")
                if (!prize.toLowerCase().includes('nessun premio')) {
                    launchWinConfetti();
                }
            }, 4000);
        });
        
        // Function to create confetti elements
        function createConfetti() {
            const colors = ['#FF6B6B', '#FFD166', '#06D6A0', '#118AB2', '#073B4C'];
            
            // Clear previous confetti
            document.querySelectorAll('.confetti').forEach(el => el.remove());
            
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.width = Math.random() * 10 + 5 + 'px';
                confetti.style.height = Math.random() * 10 + 5 + 'px';
                confetti.style.opacity = '0';
                wheelContainer.appendChild(confetti);
            }
        }
        
        // Function to launch win confetti animation
        function launchWinConfetti() {
            // ...existing code...
        }
    }
    
    function initQuizGame(data) {
        const questions = data.questions;
        let currentQuestion = 0;
        let correctAnswers = 0;
        
        const questionElement = document.getElementById('question');
        const optionsElement = document.getElementById('options');
        const nextButton = document.getElementById('next-button');
        
        function showQuestion() {
            const question = questions[currentQuestion];
            questionElement.innerHTML = `<h4>${question.question}</h4>`;
            
            optionsElement.innerHTML = '';
            question.options.forEach((option, index) => {
                const button = document.createElement('button');
                button.className = 'btn btn-outline-primary';
                button.textContent = option;
                button.onclick = () => selectAnswer(index);
                optionsElement.appendChild(button);
            });
            
            nextButton.style.display = 'none';
        }
        
        function selectAnswer(index) {
            const question = questions[currentQuestion];
            const buttons = optionsElement.querySelectorAll('button');
            
            buttons.forEach(button => {
                button.disabled = true;
            });
            
            if (index === question.correct) {
                buttons[index].classList.remove('btn-outline-primary');
                buttons[index].classList.add('btn-success');
                correctAnswers++;
            } else {
                buttons[index].classList.remove('btn-outline-primary');
                buttons[index].classList.add('btn-danger');
                buttons[question.correct].classList.remove('btn-outline-primary');
                buttons[question.correct].classList.add('btn-success');
            }
            
            currentQuestion++;
            
            if (currentQuestion < questions.length) {
                nextButton.style.display = 'block';
                nextButton.textContent = 'Prossima Domanda';
                nextButton.onclick = showQuestion;
            } else {
                nextButton.style.display = 'block';
                nextButton.textContent = 'Mostra Risultato';
                nextButton.onclick = showResult;
            }
        }
        
        function showResult() {
            questionElement.innerHTML = `<h4>Hai completato il quiz!</h4>`;
            optionsElement.innerHTML = `<p>Hai risposto correttamente a ${correctAnswers} domande su ${questions.length}.</p>`;
            
            if (correctAnswers >= questions.length * 0.7) {
                optionsElement.innerHTML += `<div class="alert alert-success mt-3">Congratulazioni! Hai vinto un premio!</div>`;
            } else {
                optionsElement.innerHTML += `<div class="alert alert-warning mt-3">Peccato! Riprova per vincere un premio.</div>`;
            }
            
            nextButton.style.display = 'none';
        }
        
        showQuestion();
    }
    
    function initMemoryGame(data) {
        const grid = document.getElementById('memory-grid');
        const timer = document.getElementById('timer');
        
        const items = [...data.items, ...data.items]; // Duplicate for pairs
        let timeLeft = 60;
        let flippedCards = [];
        let matchedPairs = 0;
        let timerInterval;
        
        // Shuffle items
        items.sort(() => Math.random() - 0.5);
        
        // Create cards
        items.forEach((item, index) => {
            const card = document.createElement('div');
            card.className = 'memory-card';
            card.dataset.item = item;
            card.dataset.index = index;
            card.innerHTML = '<span class="hidden-content"></span>';
            card.onclick = () => flipCard(card);
            grid.appendChild(card);
        });
        
        function flipCard(card) {
            if (flippedCards.length < 2 && !card.classList.contains('flipped') && !card.classList.contains('matched')) {
                card.classList.add('flipped');
                card.innerHTML = card.dataset.item;
                flippedCards.push(card);
                
                if (flippedCards.length === 2) {
                    setTimeout(checkMatch, 500);
                }
            }
        }
        
        function checkMatch() {
            const [first, second] = flippedCards;
            
            if (first.dataset.item === second.dataset.item) {
                first.classList.add('matched');
                second.classList.add('matched');
                first.style.backgroundColor = '#28a745';
                second.style.backgroundColor = '#28a745';
                matchedPairs++;
                
                if (matchedPairs === items.length / 2) {
                    clearInterval(timerInterval);
                    alert('Complimenti! Hai trovato tutte le coppie!');
                }
            } else {
                first.classList.remove('flipped');
                second.classList.remove('flipped');
                first.innerHTML = '<span class="hidden-content"></span>';
                second.innerHTML = '<span class="hidden-content"></span>';
            }
            
            flippedCards = [];
        }
        
        // Start timer
        timerInterval = setInterval(() => {
            timeLeft--;
            timer.textContent = timeLeft;
            
            if (timeLeft === 0) {
                clearInterval(timerInterval);
                alert('Tempo scaduto!');
                
                // Disable all cards
                document.querySelectorAll('.memory-card').forEach(card => {
                    card.onclick = null;
                });
            }
        }, 1000);
    }
    
    function initSlotGame(data) {
        const symbols = data.symbols;
        const reels = [
            document.getElementById('reel1'),
            document.getElementById('reel2'),
            document.getElementById('reel3')
        ];
        const spinButton = document.getElementById('spin-slot');
        
        // Initialize reels
        reels.forEach(reel => {
            reel.textContent = symbols[Math.floor(Math.random() * symbols.length)];
        });
        
        spinButton.addEventListener('click', () => {
            // Disable button during spin
            spinButton.disabled = true;
            
            // Animation
            let spins = 0;
            const totalSpins = 10; // Total number of animation frames
            const spinInterval = setInterval(() => {
                reels.forEach(reel => {
                    reel.textContent = symbols[Math.floor(Math.random() * symbols.length)];
                });
                
                spins++;
                if (spins >= totalSpins) {
                    clearInterval(spinInterval);
                    checkResult();
                    spinButton.disabled = false;
                }
            }, 100);
        });
        
        function checkResult() {
            const results = reels.map(reel => reel.textContent);
            
            // Count occurrences of each symbol
            const counts = {};
            results.forEach(result => {
                counts[result] = (counts[result] || 0) + 1;
            });
            
            // Check for matches
            const maxCount = Math.max(...Object.values(counts));
            
            if (maxCount === 3) {
                alert('JACKPOT! Hai ottenuto tre simboli uguali!');
            } else if (maxCount === 2) {
                alert('Hai vinto! Due simboli uguali!');
            } else {
                alert('Nessuna combinazione vincente. Riprova!');
            }
        }
    }
    
    function initChefChallenge(data) {
        const ingredients = data.ingredients;
        const secretIngredient = ingredients[Math.floor(Math.random() * ingredients.length)];
        const guessInput = document.getElementById('guess-input');
        const guessButton = document.getElementById('guess-button');
        const guessesList = document.getElementById('guesses-list');
        
        let attempts = 0;
        const maxAttempts = 5;
        
        guessButton.addEventListener('click', () => {
            const guess = guessInput.value.trim().toLowerCase();
            
            if (guess === '') {
                return;
            }
            
            attempts++;
            
            // Create guess item
            const guessItem = document.createElement('div');
            guessItem.className = 'alert';
            
            if (guess === secretIngredient) {
                guessItem.className += ' alert-success';
                guessItem.innerHTML = `<i class="fas fa-check-circle"></i> ${guess} - Corretto! Hai indovinato!`;
                guessInput.disabled = true;
                guessButton.disabled = true;
                alert('Complimenti! Hai indovinato l\'ingrediente segreto!');
            } else {
                guessItem.className += ' alert-danger';
                guessItem.innerHTML = `<i class="fas fa-times-circle"></i> ${guess} - Sbagliato!`;
                
                if (attempts >= maxAttempts) {
                    guessInput.disabled = true;
                    guessButton.disabled = true;
                    alert(`Tentativi esauriti! L'ingrediente segreto era: ${secretIngredient}`);
                }
            }
            
            guessesList.appendChild(guessItem);
            guessInput.value = '';
        });
        
        guessInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                guessButton.click();
            }
        });
    }
});
</script>

<?php require_once 'views/layout/footer.php'; ?>