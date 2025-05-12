<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center">
                    <span class="icon-circle bg-primary-light driver-text-primary me-2">
                        <i class="fas fa-chart-line"></i>
                    </span>
                    Performance
                </h5>
                
                <!-- Statistiche in card affiancate e colorate -->
                <div class="stats-grid mt-4">
                    <div class="stat-card stat-card-primary animate-float">
                        <div class="stat-pattern"></div>
                        <div class="stat-icon">
                            <i class="fas fa-truck-loading"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-title">Consegne completate</div>
                            <div class="stat-value">158</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i> 12% rispetto al mese scorso
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card stat-card-accent-1 animate-float">
                        <div class="stat-pattern"></div>
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-title">Rating medio</div>
                            <div class="stat-value">4.8</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i> 0.2 punti rispetto al mese scorso
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card stat-card-accent-2 animate-float">
                        <div class="stat-pattern"></div>
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-title">Puntualità</div>
                            <div class="stat-value">98%</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i> 3% rispetto al mese scorso
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card stat-card-secondary animate-float">
                        <div class="stat-pattern"></div>
                        <div class="stat-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-title">Tasso reclami</div>
                            <div class="stat-value">1.5%</div>
                            <div class="stat-change negative">
                                <i class="fas fa-arrow-up"></i> 0.5% rispetto al mese scorso
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title d-flex align-items-center">
                        <span class="icon-circle bg-info-light driver-text-info me-2">
                            <i class="fas fa-history"></i>
                        </span>
                        Ultime Consegne
                    </h5>
                    <div class="period-filter">
                        <button type="button" class="period-btn active" data-period="today">
                            <i class="fas fa-calendar-day me-2"></i> Oggi
                        </button>
                        <button type="button" class="period-btn" data-period="week">
                            <i class="fas fa-calendar-week me-2"></i> Settimana
                        </button>
                        <button type="button" class="period-btn" data-period="month">
                            <i class="fas fa-calendar-alt me-2"></i> Mese
                        </button>
                    </div>
                </div>
                
                <!-- Consegne di oggi (visibile di default) -->
                <div class="time-period today-data">
                    <div class="table-responsive custom-table-container">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>ID Ordine</th>
                                    <th>Cliente</th>
                                    <th>Ristorante</th>
                                    <th>Orario</th>
                                    <th>Importo</th>
                                    <th>Stato</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1245</td>
                                    <td>Giulia Rossi</td>
                                    <td>Pizzeria Napoli</td>
                                    <td>Oggi, 12:45</td>
                                    <td>€28.50</td>
                                    <td><span class="badge-pill bg-success-light text-success">Consegnato</span></td>
                                    <td>
                                        <div class="rating-mini">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1243</td>
                                    <td>Marco Verdi</td>
                                    <td>Sushi House</td>
                                    <td>Oggi, 11:20</td>
                                    <td>€45.00</td>
                                    <td><span class="badge-pill bg-success-light text-success">Consegnato</span></td>
                                    <td>
                                        <div class="rating-mini">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="far fa-star text-muted"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1240</td>
                                    <td>Anna Bianchi</td>
                                    <td>Burger King</td>
                                    <td>Oggi, 10:05</td>
                                    <td>€22.00</td>
                                    <td><span class="badge-pill bg-success-light text-success">Consegnato</span></td>
                                    <td>
                                        <div class="rating-mini">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Consegne della settimana (nascosto inizialmente) -->
                <div class="time-period week-data" style="display: none;">
                    <div class="table-responsive custom-table-container">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>ID Ordine</th>
                                    <th>Cliente</th>
                                    <th>Ristorante</th>
                                    <th>Orario</th>
                                    <th>Importo</th>
                                    <th>Stato</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1245</td>
                                    <td>Giulia Rossi</td>
                                    <td>Pizzeria Napoli</td>
                                    <td>Oggi, 12:45</td>
                                    <td>€28.50</td>
                                    <td><span class="badge-pill bg-success-light text-success">Consegnato</span></td>
                                    <td>
                                        <div class="rating-mini">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1243</td>
                                    <td>Marco Verdi</td>
                                    <td>Sushi House</td>
                                    <td>Oggi, 11:20</td>
                                    <td>€45.00</td>
                                    <td><span class="badge-pill bg-success-light text-success">Consegnato</span></td>
                                    <td>
                                        <div class="rating-mini">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="far fa-star text-muted"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1228</td>
                                    <td>Roberto Neri</td>
                                    <td>McDonalds</td>
                                    <td>Ieri, 19:30</td>
                                    <td>€16.90</td>
                                    <td><span class="badge-pill bg-success-light text-success">Consegnato</span></td>
                                    <td>
                                        <div class="rating-mini">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="far fa-star text-muted"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1215</td>
                                    <td>Chiara Bianchi</td>
                                    <td>Pizza Hut</td>
                                    <td>2 giorni fa, 13:15</td>
                                    <td>€32.50</td>
                                    <td><span class="badge-pill bg-success-light text-success">Consegnato</span></td>
                                    <td>
                                        <div class="rating-mini">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Consegne del mese (nascosto inizialmente) -->
                <div class="time-period month-data" style="display: none;">
                    <div class="table-responsive custom-table-container">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>ID Ordine</th>
                                    <th>Cliente</th>
                                    <th>Ristorante</th>
                                    <th>Orario</th>
                                    <th>Importo</th>
                                    <th>Stato</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1245</td>
                                    <td>Giulia Rossi</td>
                                    <td>Pizzeria Napoli</td>
                                    <td>Oggi, 12:45</td>
                                    <td>€28.50</td>
                                    <td><span class="badge-pill bg-success-light text-success">Consegnato</span></td>
                                    <td>
                                        <div class="rating-mini">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1228</td>
                                    <td>Roberto Neri</td>
                                    <td>McDonalds</td>
                                    <td>Ieri, 19:30</td>
                                    <td>€16.90</td>
                                    <td><span class="badge-pill bg-success-light text-success">Consegnato</span></td>
                                    <td>
                                        <div class="rating-mini">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="far fa-star text-muted"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1155</td>
                                    <td>Francesca Verdi</td>
                                    <td>KFC</td>
                                    <td>15 giorni fa, 20:10</td>
                                    <td>€24.90</td>
                                    <td><span class="badge-pill bg-success-light text-success">Consegnato</span></td>
                                    <td>
                                        <div class="rating-mini">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="far fa-star text-muted"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1087</td>
                                    <td>Giovanni Rossi</td>
                                    <td>Old Wild West</td>
                                    <td>23 giorni fa, 21:30</td>
                                    <td>€42.80</td>
                                    <td><span class="badge-pill bg-success-light text-success">Consegnato</span></td>
                                    <td>
                                        <div class="rating-mini">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                            <i class="far fa-star text-muted"></i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestione dei filtri temporali per le consegne
        const timeFilterButtons = document.querySelectorAll('.period-filter button');
        const timePeriodData = document.querySelectorAll('.time-period');
        
        timeFilterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Reset tutti i bottoni e nascondi tutti i dati
                timeFilterButtons.forEach(btn => btn.classList.remove('active'));
                timePeriodData.forEach(data => data.style.display = 'none');
                
                // Attiva il bottone cliccato
                this.classList.add('active');
                
                // Mostra i dati corrispondenti
                const period = this.dataset.period;
                document.querySelector(`.${period}-data`).style.display = 'block';
            });
        });
    });
</script>

<style>
    /* Stile specifico per il tab Attività */
    #activity .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    /* Stile per le card nella dashboard */
    #activity .stat-card {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
        display: flex;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: white;
        border: none;
    }
    
    #activity .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }
    
    #activity .stat-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.1;
        background-image: url('data:image/svg+xml;utf8,<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"><g fill="white"><circle cx="3" cy="3" r="1"/><circle cx="13" cy="13" r="1"/></g></svg>');
        z-index: 0;
    }
    
    #activity .stat-card-primary {
        background: linear-gradient(135deg, #ff5a5f 0%, #ff8f6b 100%);
        color: white;
    }
    
    #activity .stat-card-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
    }
    
    #activity .stat-card-accent-1 {
        background: linear-gradient(135deg, #36D1DC 0%, #5B86E5 100%);
        color: white;
    }
    
    #activity .stat-card-accent-2 {
        background: linear-gradient(135deg, #ffaa00 0%, #ff6a00 100%);
        color: white;
    }
    
    #activity .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-right: 1rem;
    }
    
    #activity .stat-content {
        flex: 1;
        z-index: 1;
    }
    
    #activity .stat-title {
        font-size: 0.8rem;
        opacity: 0.8;
        margin-bottom: 0.25rem;
    }
    
    #activity .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        line-height: 1;
    }
    
    #activity .stat-change {
        font-size: 0.75rem;
        display: flex;
        align-items: center;
    }
    
    #activity .stat-change i {
        font-size: 0.7rem;
        margin-right: 0.25rem;
    }
    
    #activity .stat-change.positive {
        color: rgba(255, 255, 255, 0.9);
    }
    
    #activity .stat-change.negative {
        color: rgba(255, 255, 255, 0.9);
    }
    
    /* Stile per le card animazione float */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
        100% { transform: translateY(0px); }
    }
    
    #activity .animate-float {
        animation: float 5s ease-in-out infinite;
    }
    
    #activity .animate-float:nth-child(1) { animation-delay: 0s; }
    #activity .animate-float:nth-child(2) { animation-delay: 1s; }
    #activity .animate-float:nth-child(3) { animation-delay: 2s; }
    #activity .animate-float:nth-child(4) { animation-delay: 3s; }
    
    /* Stile per i pulsanti di filtro - usando lo stile della dashboard */
    #activity .period-chart-buttons {
        display: flex;
        gap: 8px;
    }

    #activity .period-chart-btn {
        display: flex;
        align-items: center;
        background-color: white;
        color: var(--color-grey-700);
        border: 1px solid var(--color-grey-200);
        padding: 0.5rem 1rem;
        border-radius: var(--border-radius);
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
        cursor: pointer;
        box-shadow: var(--shadow-sm);
    }

    #activity .period-chart-btn:hover {
        background-color: var(--color-grey-100);
        border-color: var(--color-grey-300);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    #activity .period-chart-btn.active {
        background: var(--gradient-primary);
        color: white;
        border-color: transparent;
    }

    #activity .period-chart-btn.active:hover {
        transform: translateY(-1px);
        opacity: 0.95;
    }

    @media (max-width: 768px) {
        #activity .period-chart-buttons {
            flex-wrap: wrap;
        }
        
        #activity .period-chart-btn {
            font-size: 0.75rem;
            padding: 0.4rem 0.75rem;
        }
    }
    
    /* Stile per il rating */
    #activity .rating-mini {
        font-size: 0.8rem;
    }
    
    /* Responsive per le card */
    @media (max-width: 768px) {
        #activity .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        #activity .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Stile per il periodo filtro a pillola */
    #activity .period-filter {
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
        border-radius: var(--border-radius);
        padding: 2px;
        border: 1px solid #dee2e6;
    }

    #activity .period-btn {
        background: none;
        border: none;
        color: var(--color-grey-700);
        padding: 4px 10px;
        border-radius: var(--border-radius);
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    #activity .period-btn:hover {
        color: var(--color-primary);
    }

    #activity .period-btn.active {
        background: var(--gradient-primary);
        color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 576px) {
        #activity .period-filter {
            flex-wrap: nowrap;
            overflow-x: auto;
            padding: 1px;
        }
        
        #activity .period-btn {
            white-space: nowrap;
            font-size: 0.8rem;
            padding: 4px 8px;
        }
    }
</style>