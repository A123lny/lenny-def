<?php 
// Recupera le informazioni sulla pagina corrente
$pageTitle = isset($_GET['page']) ? $_GET['page'] : 'Pagina';
$pageUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
$pageInfo = [
    'title' => $pageTitle,
    'url' => $pageUrl
];
require_once 'views/layout/header.php';
?>

<div class="wip-container">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-title rainbow-text">🚧 Ops! Lavori in corso! 🚧</h2>
            <p class="section-subtitle">Questa pagina sta cucinando... come una pizza che aspetta il forno!</p>
        </div>
        <div class="wip-timer">
            <div class="wip-timer-circle">
                <i class="fas fa-hourglass-half"></i>
            </div>
        </div>
    </div>
    
    <!-- Nuovi elementi decorativi animati -->
    <div class="floating-elements">
        <div class="floating-element" id="float1"><i class="fas fa-pizza-slice"></i></div>
        <div class="floating-element" id="float2"><i class="fas fa-hamburger"></i></div>
        <div class="floating-element" id="float3"><i class="fas fa-code"></i></div>
        <div class="floating-element" id="float4"><i class="fas fa-coffee"></i></div>
        <div class="floating-element" id="float5"><i class="fas fa-cookie-bite"></i></div>
    </div>
    
    <div class="row g-4">
        <!-- Colonna principale con messaggio e progress -->
        <div class="col-lg-7">
            <div class="row g-4">
                <!-- Card principale -->
                <div class="col-12">
                    <div class="wip-card main-card">
                        <div class="wip-chef">
                            <div class="chef-hat"></div>
                            <div class="chef-face">
                                <div class="chef-eyes">
                                    <div class="chef-eye"></div>
                                    <div class="chef-eye"></div>
                                </div>
                                <div class="chef-mouth"></div>
                            </div>
                        </div>
                        
                        <div class="wip-message-container">
                            <div class="wip-message active" data-message="1">
                                <h3>😅 Ops! Hai trovato il nostro cantiere digitale!</h3>
                                <p>Nostro chef digitale sta preparando questa sezione con la massima cura. Probabilmente è andato a prendere un caffè... o forse sta cercando un bug nascosto dietro il frigorifero!</p>
                            </div>
                            
                            <div class="wip-message" data-message="2">
                                <h3>🍕 Questa pagina è come una pizza in preparazione...</h3>
                                <p>L'impasto c'è, la salsa pure, ma mancano ancora i condimenti! Il nostro pizzaiolo digitale sta selezionando gli ingredienti migliori per sorprenderti.</p>
                            </div>
                            
                            <div class="wip-message" data-message="3">
                                <h3>🤖 I nostri robot da cucina sono al lavoro!</h3>
                                <p>Mescolano codice come se fosse un impasto perfetto! In realtà è solo uno sviluppatore sovraccarico di lavoro e sovraccarico di caffè che cerca di fare magie!</p>
                            </div>
                            
                            <div class="wip-message" data-message="4">
                                <h3>🚗 Come un rider in pausa pranzo...</h3>
                                <p>Questa funzionalità arriverà a destinazione presto! Nel frattempo, perché non esplorare le altre golose sezioni del nostro menù digitale?</p>
                            </div>
                            
                            <div class="wip-message" data-message="5">
                                <h3>⏱️ "Pronto tra poco" in gergo tecnologico...</h3>
                                <p>Potrebbe significare stasera, domani, o quando i ristoranti faranno consegne con piccioni viaggiatori robotici. Puntiamo comunque a sorprenderti prima di quanto pensi!</p>
                            </div>
                        </div>
                        
                        <div class="wip-progress-container">
                            <div class="wip-cooking-progress">
                                <div class="cooking-pot">
                                    <div class="steam steam1"></div>
                                    <div class="steam steam2"></div>
                                    <div class="steam steam3"></div>
                                    <div class="pot-lid"></div>
                                    <div class="pot-body"></div>
                                    <div class="pot-handle left"></div>
                                    <div class="pot-handle right"></div>
                                    <div class="flame"></div>
                                </div>
                                <div class="cooking-text">
                                    <div class="cooking-label">Cottura in corso...</div>
                                    <div class="wip-progress-bar">
                                        <div class="wip-progress-fill"></div>
                                    </div>
                                    <div class="wip-progress-text">
                                        <span class="wip-percentage">27%</span> completato
                                        <span class="wip-estimation">Sarà pronto quando sarà pronto! 🍳</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="wip-controls">
                            <button class="btn btn-neon wip-message-btn" title="Messaggio precedente">
                                <i class="fas fa-arrow-left"></i>
                            </button>
                            <button class="btn btn-neon-primary wip-message-btn" title="Messaggio successivo">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                        
                        <div class="wip-decoration">
                            <div class="wip-tools">
                                <i class="fas fa-hammer"></i>
                                <i class="fas fa-wrench"></i>
                                <i class="fas fa-screwdriver"></i>
                                <i class="fas fa-paint-roller"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Fun Fact Card -->
                <div class="col-12">
                    <div class="wip-card fun-fact-card">
                        <div class="fun-fact-container">
                            <h4><i class="fas fa-brain"></i> Lo sapevi che...?</h4>
                            <div class="fact-content">
                                <p id="randomFact">Un Luca medio beve circa 3-5 tazze di caffè al giorno. Questo spiega perché stiamo lavorando così velocemente su questa pagina!</p>
                            </div>
                            <button id="newFactBtn" class="btn-fun-fact">
                                <i class="fas fa-sync-alt"></i> Altro fatto divertente
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Colonna con form feedback -->
        <div class="col-lg-5">
            <div class="wip-card feedback-card">
                <div class="wip-feedback-container">
                    <div class="feedback-header">
                        <div class="feedback-icon pulse-animation">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div>
                            <h4 class="feedback-title">Hai un'idea per la sezione "<?= htmlspecialchars($pageTitle) ?>"?</h4>
                            <p>Dicci cosa vorresti vedere in questa sezione!</p>
                        </div>
                    </div>
                    
                    <form id="whatsappForm" class="wip-feedback-form">
                        <div class="mb-4">
                            <label for="suggestion" class="form-label">La tua idea brillante 💡</label>
                            <div class="input-group custom-input-group">
                                <span class="input-group-text"><i class="fas fa-lightbulb"></i></span>
                                <textarea class="form-control custom-textarea" id="suggestion" rows="3" placeholder="Descrivi qui la tua idea... più è dettagliata, meglio è!"></textarea>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Quanto è importante per te? 🌟</label>
                            <div class="priority-selector">
                                <div class="priority-option" data-priority="1">
                                    <div class="priority-radio"></div>
                                    <div class="priority-label">
                                        <div class="priority-icon"><i class="far fa-meh"></i></div>
                                        <div class="priority-text">Sarebbe carino averlo</div>
                                    </div>
                                </div>
                                <div class="priority-option" data-priority="2">
                                    <div class="priority-radio"></div>
                                    <div class="priority-label">
                                        <div class="priority-icon"><i class="far fa-smile"></i></div>
                                        <div class="priority-text">Mi sarebbe utile</div>
                                    </div>
                                </div>
                                <div class="priority-option" data-priority="3">
                                    <div class="priority-radio"></div>
                                    <div class="priority-label">
                                        <div class="priority-icon"><i class="far fa-grin-stars"></i></div>
                                        <div class="priority-text">È assolutamente fondamentale!</div>
                                    </div>
                                </div>
                                <input type="hidden" id="priority" value="1">
                            </div>
                        </div>
                        
                        <div class="whatsapp-send-container">
                            <div class="whatsapp-animation">
                                <div class="whatsapp-bubble"></div>
                                <div class="whatsapp-bubble"></div>
                                <div class="whatsapp-bubble"></div>
                            </div>
                            
                            <button type="button" class="btn-whatsapp" id="whatsappBtn">
                                <i class="fab fa-whatsapp"></i>
                                <span>Inviami un messaggio</span>
                                <div class="btn-whatsapp-wave"></div>
                            </button>
                        </div>
                        
                        <!-- Campo nascosto per la pagina corrente -->
                        <input type="hidden" id="currentPage" value="<?= htmlspecialchars($pageTitle) ?>">
                        <input type="hidden" id="currentUrl" value="<?= htmlspecialchars($pageUrl) ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --wip-color-1: #FF6B6B;
        --wip-color-2: #4ECDC4;
        --wip-color-3: #FFE66D;
        --wip-color-4: #1A535C;
        --wip-color-5: #F9F7F7;
        --wip-gradient: linear-gradient(135deg, var(--wip-color-1), var(--wip-color-2));
        --neon-pink: #ff47da;
        --neon-blue: #00e1ff;
        --neon-yellow: #ffde59;
        --neon-green: #47ff8b;
    }

    /* Container principale con spaziatura ottimizzata */
    .wip-container {
        animation: fadeIn 0.6s ease-in-out;
        padding-bottom: 2rem;
        position: relative;
        z-index: 2;
        overflow: hidden;
    }
    
    /* Aggiunge spazio tra le righe per evitare compressione */
    .g-4 {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 1.5rem;
    }

    /* Titolo animato arcobaleno */
    .rainbow-text {
        background: linear-gradient(90deg, #ff47da, #ff6b6b, #ffde59, #47ff8b, #00e1ff, #7d66ff);
        background-size: 400% 400%;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        animation: rainbow 8s ease infinite;
    }

    @keyframes rainbow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Elementi decorativi fluttuanti */
    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }

    .floating-element {
        position: absolute;
        color: rgba(255,255,255,0.1);
        animation: float 10s ease-in-out infinite;
        font-size: 3rem;
    }

    #float1 {
        top: 10%;
        left: 15%;
        animation-delay: 0s;
        color: rgba(255, 107, 107, 0.1);
        font-size: 4rem;
    }

    #float2 {
        top: 25%;
        right: 10%;
        animation-delay: -2s;
        color: rgba(78, 205, 196, 0.1);
        font-size: 3.5rem;
    }

    #float3 {
        bottom: 20%;
        left: 8%;
        animation-delay: -4s;
        color: rgba(255, 230, 109, 0.1);
        font-size: 5rem;
    }

    #float4 {
        bottom: 30%;
        right: 15%;
        animation-delay: -6s;
        color: rgba(26, 83, 92, 0.1);
        font-size: 3.2rem;
    }

    #float5 {
        top: 60%;
        left: 50%;
        animation-delay: -8s;
        color: rgba(255, 107, 107, 0.1);
        font-size: 4.2rem;
    }

    @keyframes float {
        0% {transform: translate(0, 0) rotate(0deg);}
        25% {transform: translate(5px, 15px) rotate(5deg);}
        50% {transform: translate(10px, 5px) rotate(0deg);}
        75% {transform: translate(5px, -5px) rotate(-5deg);}
        100% {transform: translate(0, 0) rotate(0deg);}
    }

    /* Card ottimizzate per una migliore visualizzazione */
    .wip-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        height: auto; /* Altezza automatica invece di 100% */
        border: none;
        transition: all 0.3s ease;
    }

    .wip-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }

    .main-card {
        border-top: 5px solid var(--wip-color-1);
    }

    .feedback-card {
        border-top: 5px solid var(--wip-color-2);
        height: 100%; /* Assicura che la card del feedback si estenda per l'intera altezza */
    }

    .fun-fact-card {
        border-top: 5px solid var(--wip-color-3);
    }

    /* Contenitore dei messaggi - altezza ridotta */
    .wip-message-container {
        min-height: 150px; /* Ridotta da 180px */
        position: relative;
    }

    .wip-message {
        position: absolute;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.5s ease;
        width: 100%;
    }

    .wip-message.active {
        opacity: 1;
        transform: translateY(0);
    }

    .wip-message h3 {
        color: var(--wip-color-4);
        font-weight: 700;
        font-size: 1.4rem; /* Ridotta da 1.5rem */
        margin-bottom: 0.5rem; /* Ridotta da 0.75rem */
        display: flex;
        align-items: center;
    }

    .wip-message p {
        font-size: 1rem; /* Ridotta da 1.05rem */
        color: #666;
        line-height: 1.5; /* Ridotta da 1.6 */
    }

    /* Chef animato */
    .wip-chef {
        position: absolute;
        top: -35px;
        right: 25px;
        width: 70px;
        height: 70px;
        z-index: 10;
    }

    .chef-hat {
        position: absolute;
        top: 0;
        left: 10px;
        width: 50px;
        height: 35px;
        background: #fff;
        border-radius: 50% 50% 0 0;
        z-index: 1;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .chef-hat:before {
        content: '';
        position: absolute;
        top: -10px;
        left: 0;
        width: 50px;
        height: 15px;
        background: #fff;
        border-radius: 50%;
    }

    .chef-face {
        position: absolute;
        top: 25px;
        left: 15px;
        width: 40px;
        height: 40px;
        background: #ffcd94;
        border-radius: 50%;
        z-index: 2;
    }

    .chef-eyes {
        position: relative;
        top: 12px;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .chef-eye {
        width: 8px;
        height: 8px;
        background: #333;
        border-radius: 50%;
        animation: blink 3s infinite;
    }

    @keyframes blink {
        0%, 45%, 50%, 100% {transform: scaleY(1);}
        48% {transform: scaleY(0.1);}
    }

    .chef-mouth {
        position: absolute;
        bottom: 10px;
        left: 12px;
        width: 15px;
        height: 7px;
        border-bottom: 2px solid #333;
        border-radius: 0 0 50% 50%;
    }

    /* Progressbar di cottura - spaziatura ridotta */
    .wip-progress-container {
        margin: 1.5rem 0; /* Ridotta da 2rem */
    }
    
    .wip-cooking-progress {
        display: flex;
        align-items: center;
        gap: 15px; /* Ridotta da 20px */
    }

    .cooking-pot {
        position: relative;
        width: 70px; /* Ridotta da 80px */
        height: 70px; /* Ridotta da 80px */
        flex-shrink: 0;
    }

    .pot-body {
        position: absolute;
        bottom: 0;
        left: 15px;
        width: 40px; /* Ridotta da 50px */
        height: 35px; /* Ridotta da 40px */
        background: #d1d1d1;
        border-radius: 5px 5px 15px 15px;
        overflow: hidden;
    }

    .pot-body:before {
        content: '';
        position: absolute;
        top: 5px;
        left: 5px;
        right: 5px;
        bottom: 5px;
        background: #eee;
        border-radius: 3px;
    }

    .pot-lid {
        position: absolute;
        bottom: 30px; /* Ridotta da 35px */
        left: 10px;
        width: 50px; /* Ridotta da 60px */
        height: 8px; /* Ridotta da 10px */
        background: #b8b8b8;
        border-radius: 50%;
        animation: shake 1s infinite;
    }

    @keyframes shake {
        0%, 100% {transform: translateX(0);}
        25% {transform: translateX(-1px);}
        75% {transform: translateX(1px);}
    }

    .pot-handle {
        position: absolute;
        top: 22px; /* Ridotta da 25px */
        width: 8px; /* Ridotta da 10px */
        height: 18px; /* Ridotta da 20px */
        background: #b8b8b8;
        border-radius: 10px;
    }

    .pot-handle.left {
        left: 5px;
    }

    .pot-handle.right {
        right: 5px;
    }

    .flame {
        position: absolute;
        bottom: -10px;
        left: 15px; /* Adattata */
        width: 40px;
        height: 15px;
        background: linear-gradient(to top, #FF9900, #FF6600);
        border-radius: 5px;
        animation: flame 0.5s infinite alternate;
    }

    @keyframes flame {
        from {opacity: 0.8; transform: scaleX(1) scaleY(1);}
        to {opacity: 1; transform: scaleX(1.1) scaleY(1.1);}
    }

    .steam {
        position: absolute;
        bottom: 40px; /* Ridotta da 45px */
        width: 8px;
        height: 10px;
        background: rgba(255,255,255,0.7);
        border-radius: 50%;
        animation: steam 3s infinite ease-out;
        opacity: 0;
    }

    .steam1 { left: 15px; animation-delay: 0.2s; }
    .steam2 { left: 30px; animation-delay: 1s; }
    .steam3 { left: 45px; animation-delay: 1.8s; }

    @keyframes steam {
        0% { transform: translateY(0) scale(1); opacity: 0; }
        20% { opacity: 0.8; }
        40% { opacity: 0.5; }
        60% { opacity: 0.3; }
        80% { transform: translateY(-20px) scale(1.5); opacity: 0; }
        100% { transform: translateY(-30px) scale(2); opacity: 0; }
    }

    .cooking-text {
        flex-grow: 1;
    }

    .cooking-label {
        font-weight: 600;
        color: var(--wip-color-4);
        margin-bottom: 0.5rem;
    }

    /* Barra di progresso più compatta */
    .wip-progress-bar {
        height: 10px; /* Ridotta da 12px */
        background: rgba(0, 0, 0, 0.05);
        border-radius: 5px;
        overflow: hidden;
        position: relative;
    }

    .wip-progress-fill {
        position: absolute;
        width: 27%;
        height: 100%;
        background: linear-gradient(135deg, var(--neon-pink), var(--neon-blue));
        border-radius: 5px;
        animation: progressPulse 2s infinite;
    }

    .wip-progress-text {
        display: flex;
        justify-content: space-between;
        margin-top: 0.5rem;
        color: var(--wip-color-4);
        font-size: 0.85rem;
    }

    .wip-percentage {
        font-weight: 700;
        color: var(--neon-pink);
    }

    .wip-estimation {
        font-style: italic;
    }

    /* Controlli dei messaggi */
    .wip-controls {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 1rem; /* Ridotta da 1.5rem */
    }

    .btn-neon, .btn-neon-primary {
        border: 2px solid var(--neon-blue);
        background-color: transparent;
        color: var(--neon-blue);
        border-radius: 50px;
        padding: 0.4rem 0.9rem; /* Ridotta da 0.5rem 1rem */
        font-weight: 600;
        position: relative;
        overflow: hidden;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .btn-neon:after, .btn-neon-primary:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 0%;
        background-color: var(--neon-blue);
        transition: all 0.3s ease;
        z-index: -1;
    }

    .btn-neon:hover, .btn-neon-primary:hover {
        color: white;
    }

    .btn-neon:hover:after, .btn-neon-primary:hover:after {
        height: 100%;
    }

    .btn-neon-primary {
        border-color: var(--neon-pink);
        color: var(--neon-pink);
    }

    .btn-neon-primary:after {
        background-color: var(--neon-pink);
    }

    /* Decorazioni */
    .wip-decoration {
        position: absolute;
        bottom: -20px;
        right: -20px;
        width: 80px; /* Ridotta da 100px */
        height: 80px; /* Ridotta da 100px */
        background: rgba(255, 107, 107, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .wip-tools {
        position: relative;
        width: 40px; /* Ridotta da 50px */
        height: 40px; /* Ridotta da 50px */
    }

    .wip-tools i {
        position: absolute;
        color: rgba(255, 107, 107, 0.7);
        animation: toolSpin 10s linear infinite;
        font-size: 0.9rem; /* Ridotta */
    }

    .wip-tools i:nth-child(1) {
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        animation-delay: 0s;
    }

    .wip-tools i:nth-child(2) {
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        animation-delay: -2.5s;
    }

    .wip-tools i:nth-child(3) {
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        animation-delay: -5s;
    }

    .wip-tools i:nth-child(4) {
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        animation-delay: -7.5s;
    }

    /* Header form feedback */
    .feedback-header {
        display: flex;
        align-items: center;
        gap: 12px; /* Ridotta da 15px */
        margin-bottom: 0.75rem; /* Ridotta da 1rem */
    }

    .feedback-icon {
        width: 45px; /* Ridotta da 50px */
        height: 45px; /* Ridotta da 50px */
        border-radius: 50%;
        background: linear-gradient(135deg, var(--neon-yellow), var(--neon-green));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.3rem; /* Ridotta da 1.5rem */
    }

    .feedback-title {
        color: var(--wip-color-4);
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {transform: scale(1);}
        50% {transform: scale(1.1);}
        100% {transform: scale(1);}
    }

    /* Form feedback ottimizzato */
    .wip-feedback-form {
        margin-top: 1rem; /* Ridotta da 1.5rem */
    }

    .custom-input-group {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    }

    .custom-input-group .input-group-text {
        background: linear-gradient(to bottom, var(--neon-yellow), var(--neon-green));
        color: white;
        border: none;
    }

    .custom-textarea {
        border: none;
        padding: 0.75rem; /* Ridotta da 1rem */
        font-size: 1rem;
    }

    .custom-textarea:focus {
        box-shadow: none;
    }

    /* Priorità selettore - dimensioni ottimizzate */
    .priority-selector {
        display: flex;
        flex-direction: column;
        gap: 8px; /* Ridotta da 10px */
    }

    .priority-option {
        display: flex;
        align-items: center;
        gap: 10px; /* Ridotta da 12px */
        padding: 6px 10px; /* Ridotta da 8px 12px */
        border-radius: 10px; /* Ridotta da 12px */
        border: 2px solid #eee;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .priority-option:hover {
        border-color: #ddd;
    }

    .priority-option.selected {
        border-color: var(--neon-green);
    }

    .priority-radio {
        width: 18px; /* Ridotta da 20px */
        height: 18px; /* Ridotta da 20px */
        border: 2px solid #ddd;
        border-radius: 50%;
        position: relative;
    }

    .priority-option.selected .priority-radio:before {
        content: '';
        position: absolute;
        top: 3px;
        left: 3px;
        width: 8px; /* Ridotta da 10px */
        height: 8px; /* Ridotta da 10px */
        background: var(--neon-green);
        border-radius: 50%;
    }

    .priority-label {
        display: flex;
        align-items: center;
        gap: 8px; /* Ridotta da 10px */
        flex-grow: 1;
    }

    .priority-icon {
        color: #999;
        font-size: 1.1rem; /* Ridotta da 1.2rem */
    }

    .priority-option.selected .priority-icon {
        color: var(--neon-green);
    }

    .priority-option[data-priority="3"].selected .priority-icon {
        color: var(--neon-pink);
    }

    .priority-text {
        font-weight: 500;
        font-size: 0.95rem; /* Dimensione ridotta */
    }

    /* Pulsante WhatsApp ottimizzato */
    .whatsapp-send-container {
        display: flex;
        justify-content: center;
        margin-top: 1.25rem; /* Ridotta da 1.5rem */
        position: relative;
    }

    .btn-whatsapp {
        background: #25D366;
        color: white;
        border: none;
        padding: 0.8rem 1.3rem; /* Ridotta da 1rem 1.5rem */
        border-radius: 50px;
        font-size: 1rem; /* Ridotta da 1.1rem */
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px; /* Ridotta da 10px */
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .btn-whatsapp i {
        font-size: 1.2rem; /* Ridotta da 1.3rem */
    }

    .btn-whatsapp:hover {
        background: #128C7E;
    }

    .btn-whatsapp-wave {
        position: absolute;
        width: 25px; /* Ridotta da 30px */
        height: 25px; /* Ridotta da 30px */
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        transform: scale(0);
        animation: wave 1.5s infinite;
    }

    @keyframes wave {
        0% {transform: scale(0); opacity: 1;}
        100% {transform: scale(2.5); opacity: 0;}
    }

    .whatsapp-animation {
        position: absolute;
        bottom: -12px; /* Alzata da -15px */
        left: 15px;
        display: flex;
        gap: 5px;
        align-items: flex-end;
    }

    .whatsapp-bubble {
        width: 10px; /* Ridotta da 12px */
        height: 10px; /* Ridotta da 12px */
        background: #25D366;
        border-radius: 50%;
        animation: bubbleJump 1.5s infinite;
    }

    .whatsapp-bubble:nth-child(2) {
        animation-delay: 0.2s;
    }

    .whatsapp-bubble:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes bubbleJump {
        0%, 100% {transform: translateY(0);}
        50% {transform: translateY(-8px);} /* Ridotta da -10px */
    }

    /* Fun fact card ottimizzata */
    .fun-fact-container {
        text-align: center;
    }

    .fun-fact-container h4 {
        color: var(--wip-color-4);
        font-weight: 700;
        margin-bottom: 0.75rem; /* Ridotta da 1rem */
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 1.1rem; /* Dimensione ridotta */
    }

    .fact-content {
        background: #f9f9f9;
        border-radius: 12px;
        padding: 1rem; /* Ridotta da 1.2rem */
        margin-bottom: 0.75rem; /* Ridotta da 1rem */
        min-height: 80px; /* Ridotta da 100px */
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.3s ease;
    }

    .fact-content p {
        margin: 0;
        font-style: italic;
        color: #555;
        font-size: 0.95rem; /* Ridotta da 1.05rem */
    }

    .btn-fun-fact {
        background: linear-gradient(135deg, var(--neon-yellow), var(--wip-color-3));
        border: none;
        color: var(--wip-color-4);
        padding: 0.5rem 1rem; /* Ridotta da 0.6rem 1.2rem */
        border-radius: 50px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px; /* Ridotta da 8px */
        font-size: 0.9rem; /* Dimensione ridotta */
    }

    .btn-fun-fact:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(0,0,0,0.08);
    }

    /* Animazioni */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes progressPulse {
        0% { opacity: 0.8; }
        50% { opacity: 1; }
        100% { opacity: 0.8; }
    }

    @keyframes toolSpin {
        from { transform: rotate(0deg) translateX(15px) rotate(0deg); } /* Raggio ridotto */
        to { transform: rotate(360deg) translateX(15px) rotate(-360deg); }
    }

    /* Responsive - migliori adattamenti */
    @media (max-width: 991px) {
        .wip-cooking-progress {
            flex-direction: column;
        }
        
        .cooking-pot {
            margin-bottom: 10px;
        }
    }
    
    @media (max-width: 767px) {
        .wip-message-container {
            min-height: 180px; /* Aumentata per dispositivi mobili */
        }
        
        .wip-chef {
            display: none;
        }
        
        .fact-content {
            min-height: 100px; /* Aumentata per dispositivi mobili */
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestione dei messaggi
        const messages = document.querySelectorAll('.wip-message');
        const messageBtns = document.querySelectorAll('.wip-message-btn');
        let currentMessageIndex = 0;
        const totalMessages = messages.length;
        
        // Pulsanti per cambiare messaggio
        messageBtns.forEach((btn, index) => {
            btn.addEventListener('click', function() {
                // Nascondi tutti i messaggi
                messages.forEach(msg => msg.classList.remove('active'));
                
                if (index === 0) {
                    // Pulsante precedente
                    currentMessageIndex = (currentMessageIndex - 1 + totalMessages) % totalMessages;
                } else {
                    // Pulsante successivo
                    currentMessageIndex = (currentMessageIndex + 1) % totalMessages;
                }
                
                // Mostra il messaggio corrente
                messages[currentMessageIndex].classList.add('active');
            });
        });
        
        // Gestione fatto divertente casuale
        const funFacts = [
            "Un Luca medio beve circa 3-5 tazze di caffè al giorno. Questo spiega perché stiamo lavorando così velocemente su questa pagina!",
            "Quando un Luca dice 'pronto tra 5 minuti', in realtà significa tra 2 ore... o forse domani.",
            "Il 90% dello sviluppo è cercare di capire perché il codice non funziona. L'altro 10% è cercare di capire perché ora funziona.",
            "I bug non sono errori, sono 'funzionalità non documentate'... almeno così diciamo ai nostri capi!",
            "Il termine 'bug' è nato quando un insetto reale è rimasto intrappolato in un relè di un vecchio computer, causando un errore nel 1947.",
            "Se stessi cercando di catturare un Pokémon raro, sapresti che questo è in fase di sviluppo e arriverà presto!",
            "L'80% del codice viene scritto durante la notte, spesso accompagnato da pizza fredda e bevande energetiche.",
            "Secondo alcuni studi, leggere il proprio codice di 6 mesi fa è come leggere codice scritto da uno sconosciuto.",
            "I codici di stato HTTP: 200 significa OK, 404 significa Non Trovato e 418 significa 'Sono una teiera'. Sì, è un vero codice di stato!",
            "Gli sviluppatori passano circa il 30% del loro tempo a risolvere codice scritto da altri sviluppatori."
        ];
        
        const randomFactElement = document.getElementById('randomFact');
        const newFactBtn = document.getElementById('newFactBtn');
        
        if (newFactBtn && randomFactElement) {
            newFactBtn.addEventListener('click', function() {
                const factContent = document.querySelector('.fact-content');
                factContent.style.opacity = '0';
                
                setTimeout(() => {
                    const randomIndex = Math.floor(Math.random() * funFacts.length);
                    randomFactElement.textContent = funFacts[randomIndex];
                    factContent.style.opacity = '1';
                }, 300);
            });
        }
        
        // Gestione delle opzioni di priorità
        const priorityOptions = document.querySelectorAll('.priority-option');
        const priorityInput = document.getElementById('priority');
        
        priorityOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Rimuovi la selezione da tutte le opzioni
                priorityOptions.forEach(opt => opt.classList.remove('selected'));
                
                // Seleziona questa opzione
                this.classList.add('selected');
                
                // Aggiorna il valore dell'input nascosto
                if (priorityInput) {
                    priorityInput.value = this.getAttribute('data-priority');
                }
            });
        });
        
        // Seleziona la prima opzione di default
        if (priorityOptions.length > 0) {
            priorityOptions[0].classList.add('selected');
            if (priorityInput) priorityInput.value = '1';
        }
        
        // Gestione pulsante WhatsApp
        const whatsappBtn = document.getElementById('whatsappBtn');
        const suggestionInput = document.getElementById('suggestion');
        const currentPage = document.getElementById('currentPage').value;
        const currentUrl = document.getElementById('currentUrl').value;
        
        if (whatsappBtn) {
            whatsappBtn.addEventListener('click', function() {
                const suggestion = suggestionInput ? suggestionInput.value.trim() : '';
                const priority = priorityInput ? priorityInput.value : '1';
                
                if (suggestion) {
                    // Prepara il messaggio per WhatsApp
                    const priorityText = priority === '1' ? 'Bassa' : (priority === '2' ? 'Media' : 'Alta');
                    const message = `Nuova idea per la pagina "${currentPage}"!\n\nLink: ${window.location.origin}${currentUrl}\n\nDescrizione: ${suggestion}\nPriorità: ${priorityText}`;
                    
                    // Numero WhatsApp di esempio (da cambiare con il numero reale)
                    const phoneNumber = '3277344600';
                    
                    // Crea URL per WhatsApp
                    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
                    
                    // Apri WhatsApp in una nuova finestra
                    window.open(whatsappUrl, '_blank');
                } else {
                    alert('Per favore, inserisci la tua idea prima di inviare!');
                }
            });
        }
    });
</script>

<?php require_once 'views/layout/footer.php'; ?>