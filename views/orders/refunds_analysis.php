<?php require_once 'views/layout/header.php'; ?>

<div class="section-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="section-title">Analisi Rimborsi</h2>
        <p class="section-subtitle">Statistiche e dati sui rimborsi per migliorare il tuo business</p>
    </div>
    <div>
        <a href="<?php echo url('orders', 'refunds'); ?>" class="btn btn-sm btn-primary">
            <i class="fas fa-arrow-left me-1"></i> Torna ai Rimborsi
        </a>
    </div>
</div>

<!-- Statistiche generali -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Tasso di Rimborso</h5>
                <div class="d-flex align-items-center justify-content-between mt-4">
                    <div class="d-flex align-items-center">
                        <div class="display-4 fw-bold text-primary me-3"><?= $refundRatioData['refund_rate'] ?>%</div>
                        <div class="small">
                            <div class="fw-bold"><?= $refundRatioData['refunded_orders'] ?> ordini rimborsati</div>
                            <div class="text-muted">su <?= $refundRatioData['total_orders'] ?> ordini totali</div>
                        </div>
                    </div>
                    <div class="refund-trend ms-2">
                        <span class="badge bg-success"><i class="fas fa-arrow-down me-1"></i>1.2%</span>
                        <div class="small text-muted text-center">vs mese scorso</div>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar" role="progressbar" style="width: <?= $refundRatioData['refund_rate'] ?>%"></div>
                </div>
                
                <!-- Statistiche aggiuntive per sfruttare lo spazio -->
                <div class="small mt-4">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="text-muted">Importo medio rimborsi:</div>
                        <div class="fw-bold">24.50€</div>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <div class="text-muted">Tempo medio elaborazione:</div>
                        <div class="fw-bold">1.2 giorni</div>
                    </div>
                </div>
                
                <!-- Breakdown delle motivazioni principali -->
                <h6 class="mt-4 mb-3">Motivazioni principali</h6>
                <div class="refund-reason-breakdown">
                    <div class="reason-item">
                        <div class="d-flex justify-content-between">
                            <span>Prodotto danneggiato</span>
                            <span class="fw-bold">32%</span>
                        </div>
                        <div class="progress mt-1 mb-2" style="height: 4px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 32%"></div>
                        </div>
                    </div>
                    <div class="reason-item">
                        <div class="d-flex justify-content-between">
                            <span>Consegna in ritardo</span>
                            <span class="fw-bold">28%</span>
                        </div>
                        <div class="progress mt-1 mb-2" style="height: 4px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 28%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Andamento Mensile</h5>
                <div class="card-actions">
                    <div class="period-pill-selector">
                        <a href="#" class="period-pill active" data-period="week">Settimana</a>
                        <a href="#" class="period-pill" data-period="month">Mese</a>
                        <a href="#" class="period-pill" data-period="3months">3 mesi</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="monthlyRefundsChart" height="230"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Motivazioni rimborsi e ristoranti -->
<div class="row g-4 mb-4">
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Motivazioni Rimborsi</h5>
                <div class="card-actions">
                    <div class="period-pill-selector">
                        <a href="#" class="period-pill active" data-period="1month">1 mese</a>
                        <a href="#" class="period-pill" data-period="3months">3 mesi</a>
                        <a href="#" class="period-pill" data-period="6months">6 mesi</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="refundReasonsChart" height="260"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-7">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Rimborsi per Ristorante</h5>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <div class="chart-container" style="flex: 1;">
                        <canvas id="restaurantRefundsChart" height="260"></canvas>
                    </div>
                    <div id="restaurantChartLegend" class="chart-legend ms-3" style="width: 140px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Insights e tabella -->
<div class="row g-4">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Insights</h5>
            </div>
            <div class="card-body">
                <div class="insight-item">
                    <div class="insight-icon insight-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="insight-content">
                        <h6>Aumento dei rimborsi</h6>
                        <p>Il ristorante "Sushi Fusion" ha registrato un aumento del 12% nei rimborsi questo mese.</p>
                    </div>
                </div>
                
                <div class="insight-item">
                    <div class="insight-icon insight-success">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="insight-content">
                        <h6>Tendenza positiva</h6>
                        <p>Il tasso di rimborsi è diminuito dell'1.5% rispetto al mese precedente.</p>
                    </div>
                </div>
                
                <div class="insight-item">
                    <div class="insight-icon insight-info">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="insight-content">
                        <h6>Motivazione principale</h6>
                        <p>"Prodotto danneggiato" è la motivazione più comune per i rimborsi (32%).</p>
                    </div>
                </div>
                
                <div class="insight-item">
                    <div class="insight-icon insight-primary">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="insight-content">
                        <h6>Suggerimento</h6>
                        <p>Verifica la qualità dei contenitori per la consegna per ridurre i danni ai prodotti.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Dettaglio statistiche mensili</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Periodo</th>
                                <th>Ordini totali</th>
                                <th>Rimborsi</th>
                                <th>Tasso</th>
                                <th>Media €</th>
                                <th>Trend</th>
                                <th>Andamento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Aprile 2025</td>
                                <td>223</td>
                                <td>18</td>
                                <td>8.1%</td>
                                <td>24,50€</td>
                                <td><span class="trend-badge success"><i class="fas fa-arrow-down me-1"></i>2.1%</span></td>
                                <td><span class="sparkline success" data-values="12,10,7,9,8,6"></span></td>
                            </tr>
                            <tr>
                                <td>Marzo 2025</td>
                                <td>256</td>
                                <td>28</td>
                                <td>10.9%</td>
                                <td>22,80€</td>
                                <td><span class="trend-badge danger"><i class="fas fa-arrow-up me-1"></i>0.3%</span></td>
                                <td><span class="sparkline warning" data-values="8,10,12,13,11,14"></span></td>
                            </tr>
                            <tr>
                                <td>Febbraio 2025</td>
                                <td>192</td>
                                <td>24</td>
                                <td>12.5%</td>
                                <td>25,10€</td>
                                <td><span class="trend-badge danger"><i class="fas fa-arrow-up me-1"></i>1.2%</span></td>
                                <td><span class="sparkline danger" data-values="9,10,11,12,13,15"></span></td>
                            </tr>
                            <tr>
                                <td>Gennaio 2025</td>
                                <td>210</td>
                                <td>24</td>
                                <td>11.4%</td>
                                <td>26,30€</td>
                                <td><span class="trend-badge danger"><i class="fas fa-arrow-up me-1"></i>0.9%</span></td>
                                <td><span class="sparkline danger" data-values="10,10,12,12,14,13"></span></td>
                            </tr>
                            <tr>
                                <td>Dicembre 2024</td>
                                <td>283</td>
                                <td>30</td>
                                <td>10.6%</td>
                                <td>25,70€</td>
                                <td><span class="trend-badge success"><i class="fas fa-arrow-down me-1"></i>0.8%</span></td>
                                <td><span class="sparkline success" data-values="15,14,13,12,11,10"></span></td>
                            </tr>
                            <tr>
                                <td>Novembre 2024</td>
                                <td>178</td>
                                <td>20</td>
                                <td>11.2%</td>
                                <td>23,20€</td>
                                <td><span class="trend-badge neutral"><i class="fas fa-equals me-1"></i>0%</span></td>
                                <td><span class="sparkline neutral" data-values="11,12,11,12,11,11"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Riepilogo dei trend mensili -->
                <div class="monthly-stats-summary mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Riepilogo trend</h6>
                        <div class="badge bg-light text-dark">Ultimo semestre</div>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="trend-summary-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="text-muted small">Tasso rimborsi medio</div>
                                        <div class="fw-bold">10.8%</div>
                                    </div>
                                    <div class="trend-indicator">
                                        <i class="fas fa-arrow-down text-success"></i>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 60%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="trend-summary-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="text-muted small">Valore medio rimborso</div>
                                        <div class="fw-bold">24.60€</div>
                                    </div>
                                    <div class="trend-indicator">
                                        <i class="fas fa-arrow-up text-danger"></i>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 45%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="trend-summary-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="text-muted small">Risposta ai rimborsi</div>
                                        <div class="fw-bold">1.4 giorni</div>
                                    </div>
                                    <div class="trend-indicator">
                                        <i class="fas fa-arrow-down text-success"></i>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script per Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Colori personalizzati per i grafici
        const chartColors = {
            primary: '#ff5a5f',
            secondary: '#00d1b2',
            accent1: '#ffbc1f',
            accent2: '#8a4fff',
            accent3: '#00c4b4',
            accent4: '#fd7e14',
            accent5: '#20c997',
            grey100: '#f7f9fc',
            grey300: '#d9e2ef',
            grey500: '#8f9bb3',
            white: '#ffffff',
            transparent: 'rgba(255, 255, 255, 0.1)'
        };
        
        // Configurazione tema Chart.js
        Chart.defaults.font.family = "'Nunito', sans-serif";
        Chart.defaults.color = '#6c757d';
        Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(0, 0, 0, 0.7)';
        Chart.defaults.plugins.tooltip.titleFont = { weight: 'bold' };
        Chart.defaults.plugins.legend.labels.usePointStyle = true;
        
        // Dati per grafico mensile dei rimborsi (impostato inizialmente per settimana)
        const monthlyRefundsData = {
            labels: ['Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab', 'Dom'],
            datasets: [
                {
                    label: 'Numero rimborsi',
                    data: [2, 3, 1, 4, 2, 5, 3],
                    backgroundColor: chartColors.primary,
                    borderColor: chartColors.primary,
                    borderWidth: 2,
                    tension: 0.3,
                    pointRadius: 4,
                    pointBackgroundColor: chartColors.white,
                    pointBorderColor: chartColors.primary,
                    pointBorderWidth: 2
                }
            ]
        };
        
        // Grafico mensile dei rimborsi
        const monthlyRefundsCtx = document.getElementById('monthlyRefundsChart').getContext('2d');
        const monthlyRefundsChart = new Chart(monthlyRefundsCtx, {
            type: 'line',
            data: monthlyRefundsData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            title: (items) => {
                                return `${items[0].label} - Dicembre 2025`;
                            },
                            label: (item) => {
                                return `Rimborsi: ${item.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: chartColors.grey300
                        },
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
        
        // Dati per grafico motivazioni rimborsi
        const refundReasonsData = {
            labels: <?php echo json_encode(array_keys($refundReasonData)); ?>,
            datasets: [
                {
                    data: <?php echo json_encode(array_values($refundReasonData)); ?>,
                    backgroundColor: [
                        chartColors.primary,
                        chartColors.secondary,
                        chartColors.accent1,
                        chartColors.accent2,
                        chartColors.accent4  // Cambio da accent5 a accent4 per evitare colori ripetuti
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }
            ]
        };
        
        // Grafico motivazioni rimborsi
        const refundReasonsCtx = document.getElementById('refundReasonsChart').getContext('2d');
        const refundReasonsChart = new Chart(refundReasonsCtx, {
            type: 'doughnut',
            data: refundReasonsData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            boxWidth: 12,
                            font: {
                                size: 11
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: (item) => {
                                const total = item.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((item.raw / total) * 100);
                                return `${item.label}: ${item.raw} (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
        
        // Dati per grafico rimborsi per ristorante
        const restaurantData = {
            labels: <?php echo json_encode(array_keys($restaurantRefundsData)); ?>,
            datasets: [
                {
                    label: 'Numero rimborsi',
                    data: <?php echo json_encode(array_values($restaurantRefundsData)); ?>,
                    backgroundColor: [
                        chartColors.primary,
                        chartColors.secondary,
                        chartColors.accent1,
                        chartColors.accent2,
                        chartColors.accent4  // Cambio da accent3 a accent4 per evitare colori ripetuti
                    ],
                    borderRadius: 5
                }
            ]
        };
        
        // Grafico rimborsi per ristorante
        const restaurantRefundsCtx = document.getElementById('restaurantRefundsChart').getContext('2d');
        const restaurantRefundsChart = new Chart(restaurantRefundsCtx, {
            type: 'bar',
            data: restaurantData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: chartColors.grey300
                        },
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
        
        // Crea legende personalizzate
        const restaurantLegend = document.getElementById('restaurantChartLegend');
        if (restaurantLegend) {
            restaurantData.labels.forEach((label, index) => {
                const legendItem = document.createElement('div');
                legendItem.classList.add('legend-item');
                
                const legendColor = document.createElement('span');
                legendColor.classList.add('legend-color');
                legendColor.style.backgroundColor = restaurantData.datasets[0].backgroundColor[index];
                
                const legendText = document.createElement('span');
                legendText.classList.add('legend-text');
                legendText.textContent = label;
                
                legendItem.appendChild(legendColor);
                legendItem.appendChild(legendText);
                restaurantLegend.appendChild(legendItem);
            });
        }
        
        // Gestione selettori a pillola per il grafico mensile
        const monthlyPeriodPills = document.querySelectorAll('.period-pill-selector:first-of-type .period-pill');
        if (monthlyPeriodPills.length > 0) {
            monthlyPeriodPills.forEach(pill => {
                pill.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Rimuovi classe attiva da tutte le pillole del selettore
                    this.closest('.period-pill-selector').querySelectorAll('.period-pill').forEach(el => {
                        el.classList.remove('active');
                    });
                    
                    // Aggiungi classe attiva alla pillola cliccata
                    this.classList.add('active');
                    
                    // Simulazione aggiornamento dati (in produzione si farebbero chiamate AJAX)
                    const period = this.dataset.period;
                    updateMonthlyChart(period);
                });
            });
        }
        
        // Gestione selettori a pillola per il grafico delle motivazioni
        const reasonsPeriodPills = document.querySelectorAll('.period-pill-selector:nth-of-type(2) .period-pill');
        if (reasonsPeriodPills.length > 0) {
            reasonsPeriodPills.forEach(pill => {
                pill.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Rimuovi classe attiva da tutte le pillole del selettore
                    this.closest('.period-pill-selector').querySelectorAll('.period-pill').forEach(el => {
                        el.classList.remove('active');
                    });
                    
                    // Aggiungi classe attiva alla pillola cliccata
                    this.classList.add('active');
                    
                    // Simulazione aggiornamento dati (in produzione si farebbero chiamate AJAX)
                    const period = this.dataset.period;
                    updateReasonsChart(period);
                });
            });
        }
        
        // Gestire il cambio periodo per il grafico mensile
        const chartPeriodLinks = document.querySelectorAll('.chart-period');
        if (chartPeriodLinks.length > 0) {
            chartPeriodLinks.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Rimuovi classe attiva da tutti gli elementi
                    document.querySelectorAll('.chart-period').forEach(el => {
                        el.classList.remove('active');
                    });
                    
                    // Aggiungi classe attiva all'elemento cliccato
                    this.classList.add('active');
                    
                    // Aggiorna il testo del dropdown
                    const periodText = this.textContent;
                    const dropdownTrigger = document.getElementById('monthly-chart-period');
                    if (dropdownTrigger) {
                        dropdownTrigger.textContent = periodText;
                    }
                    
                    // Simulazione aggiornamento dati (in produzione si farebbero chiamate AJAX)
                    const period = this.dataset.period;
                    updateMonthlyChart(period);
                });
            });
        }
        
        // Gestire il cambio periodo per il grafico delle motivazioni
        const reasonsPeriodLinks = document.querySelectorAll('.reasons-period');
        if (reasonsPeriodLinks.length > 0) {
            reasonsPeriodLinks.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Rimuovi classe attiva da tutti gli elementi
                    document.querySelectorAll('.reasons-period').forEach(el => {
                        el.classList.remove('active');
                    });
                    
                    // Aggiungi classe attiva all'elemento cliccato
                    this.classList.add('active');
                    
                    // Aggiorna il testo del dropdown
                    const periodText = this.textContent;
                    const dropdownTrigger = document.getElementById('reasons-chart-period');
                    if (dropdownTrigger) {
                        dropdownTrigger.textContent = periodText;
                    }
                    
                    // Simulazione aggiornamento dati (in produzione si farebbero chiamate AJAX)
                    const period = this.dataset.period;
                    updateReasonsChart(period);
                });
            });
        }
        
        // Funzione per aggiornare il grafico mensile (simulazione)
        function updateMonthlyChart(period) {
            // Qui si dovrebbe fare una chiamata AJAX per ottenere dati reali
            // Simuliamo dati statici per ogni periodo
            switch(period) {
                case 'week':
                    monthlyRefundsChart.data.labels = ['Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab', 'Dom'];
                    monthlyRefundsChart.data.datasets[0].data = [2, 3, 1, 4, 2, 5, 3];
                    monthlyRefundsChart.options.plugins.tooltip.callbacks.title = (items) => {
                        return `${items[0].label} - Dicembre 2025`;
                    };
                    break;
                case 'month':
                    monthlyRefundsChart.data.labels = ['1-7 Dic', '8-14 Dic', '15-21 Dic', '22-31 Dic'];
                    monthlyRefundsChart.data.datasets[0].data = [8, 12, 9, 7];
                    monthlyRefundsChart.options.plugins.tooltip.callbacks.title = (items) => {
                        return `${items[0].label} 2025`;
                    };
                    break;
                case '3months':
                    monthlyRefundsChart.data.labels = ['Ott', 'Nov', 'Dic'];
                    monthlyRefundsChart.data.datasets[0].data = [16, 10, 9];
                    monthlyRefundsChart.options.plugins.tooltip.callbacks.title = (items) => {
                        return `${items[0].label} 2025`;
                    };
                    break;
            }
            
            monthlyRefundsChart.update();
        }
        
        // Funzione per aggiornare il grafico delle motivazioni (simulazione)
        function updateReasonsChart(period) {
            // Qui si dovrebbe fare una chiamata AJAX per ottenere dati reali
            // Simuliamo cambiamenti nei dati
            let newData;
            
            switch(period) {
                case '1month':
                    newData = [32, 28, 22, 18, 10];
                    break;
                case '3months':
                    newData = [30, 25, 24, 15, 6];
                    break;
                case '6months':
                    newData = [28, 30, 20, 17, 5];
                    break;
                default:
                    newData = [32, 28, 22, 18, 10];
            }
            
            refundReasonsChart.data.datasets[0].data = newData;
            refundReasonsChart.update();
        }
        
        // Effetto di caricamento per le card statistiche
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('animate__animated', 'animate__fadeInUp');
        });
        
        // Inizializza le sparkline
        const sparklines = document.querySelectorAll('.sparkline');
        sparklines.forEach(sparkline => {
            const values = sparkline.dataset.values.split(',').map(Number);
            const maxValue = Math.max(...values);
            
            let html = '<svg class="sparkline-svg" width="80" height="24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">';
            html += '<polyline points="';
            
            // Calcola i punti per la sparkline
            const width = 80;
            const height = 20;
            const segmentWidth = width / (values.length - 1);
            
            values.forEach((value, index) => {
                const x = index * segmentWidth;
                const y = height - (value / maxValue * height);
                html += `${x},${y} `;
            });
            
            html += '" fill="none" />';
            html += '</svg>';
            
            sparkline.innerHTML = html;
        });
    });
</script>

<style>
    /* Stile specifico per la pagina analisi rimborsi */
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .card-actions {
        display: flex;
        align-items: center;
    }
    
    .chart-legend-horizontal {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        margin-right: 10px;
        cursor: pointer;
    }
    
    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 2px;
        margin-right: 5px;
        display: inline-block;
    }
    
    .legend-text {
        font-size: 11px;
        color: var(--color-grey-700);
    }
    
    /* Stili per gli insight */
    .insight-item {
        display: flex;
        margin-bottom: 20px;
        border-radius: 8px;
        padding: 15px;
        background-color: #f8f9fa;
        border-left: 3px solid var(--color-primary);
    }
    
    .insight-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: white;
        flex-shrink: 0;
    }
    
    .insight-warning {
        background-color: #ffc107;
    }
    
    .insight-success {
        background-color: #28a745;
    }
    
    .insight-info {
        background-color: #17a2b8;
    }
    
    .insight-primary {
        background-color: var(--color-primary);
    }
    
    .insight-content h6 {
        margin: 0 0 5px 0;
        font-weight: 600;
    }
    
    .insight-content p {
        color: var(--color-grey-600);
        font-size: 0.9rem;
    }
    
    /* Stile per la card del tasso di rimborso */
    .refund-trend .badge {
        font-size: 0.85rem;
        padding: 0.4rem 0.6rem;
        border-radius: 50px;
    }
    
    .progress {
        background-color: #e9ecef;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .progress-bar {
        background: var(--gradient-primary);
        transition: width 0.6s ease;
    }
    
    .reason-item {
        font-size: 0.85rem;
    }
    
    .reason-item .progress-bar.bg-primary {
        background: var(--gradient-primary);
    }
    
    .reason-item .progress-bar.bg-info {
        background: var(--gradient-secondary);
    }
    
    /* Stile per i badge di trend e sparkline */
    .trend-badge {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .trend-badge.success {
        background-color: rgba(25, 135, 84, 0.15);
        color: #198754;
    }
    
    .trend-badge.danger {
        background-color: rgba(220, 53, 69, 0.15);
        color: #dc3545;
    }
    
    .trend-badge.warning {
        background-color: rgba(255, 193, 7, 0.15);
        color: #ffc107;
    }
    
    .trend-badge.neutral {
        background-color: rgba(108, 117, 125, 0.15);
        color: #6c757d;
    }
    
    .sparkline {
        display: inline-block;
        vertical-align: middle;
    }
    
    .sparkline-svg {
        overflow: visible;
    }
    
    .sparkline.success polyline {
        stroke: #198754;
    }
    
    .sparkline.warning polyline {
        stroke: #ffc107;
    }
    
    .sparkline.danger polyline {
        stroke: #dc3545;
    }
    
    .sparkline.neutral polyline {
        stroke: #6c757d;
    }
    
    /* Migliora l'aspetto della tabella */
    .table thead th {
        background-color: #f8f9fa;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-top: none;
    }
    
    .table td {
        vertical-align: middle;
        padding: 0.75rem;
    }
    
    /* Stile per il riepilogo dei trend mensili */
    .monthly-stats-summary {
        border-top: 1px solid #e9ecef;
        padding-top: 1rem;
    }
    
    .trend-summary-card {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 12px;
        height: 100%;
    }
    
    .trend-indicator {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    }
    
    .progress .bg-warning {
        background: var(--gradient-accent-1);
    }
    
    .progress .bg-info {
        background: var(--gradient-secondary);
    }
    
    /* Stile per i selettori a pillola */
    .period-pill-selector {
        display: flex;
        background-color: #f0f2f5;
        border-radius: 20px;
        padding: 2px;
        gap: 2px;
    }
    
    .period-pill {
        padding: 4px 10px;
        border-radius: 18px;
        font-size: 0.75rem;
        color: #6c757d;
        text-decoration: none;
        transition: all 0.2s ease;
        font-weight: 500;
    }
    
    .period-pill:hover {
        color: var(--color-primary);
        background-color: rgba(255, 90, 95, 0.05);
    }
    
    .period-pill.active {
        background-color: white;
        color: var(--color-primary);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
</style>

<?php require_once 'views/layout/footer.php'; ?>
