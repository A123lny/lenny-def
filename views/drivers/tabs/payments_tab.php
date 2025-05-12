<div class="row mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-hover h-100">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center">
                    <span class="icon-circle bg-primary-light driver-text-primary me-2">
                        <i class="fas fa-hand-holding-usd"></i>
                    </span>
                    Riepilogo Pagamenti
                </h5>
                <div class="mb-4 mt-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted">Guadagno Totale</span>
                        <span class="fw-bold">€3,450.00</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted">Mese Corrente</span>
                        <span class="fw-bold">€680.50</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted">In Sospeso</span>
                        <span class="fw-bold">€120.00</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-muted">Bonus</span>
                        <span class="fw-bold text-success">€75.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-hover h-100">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center">
                    <span class="icon-circle bg-accent-1-light driver-text-accent-1 me-2">
                        <i class="fas fa-chart-pie"></i>
                    </span>
                    Panoramica Guadagni
                </h5>
                <div id="earning-chart" class="mt-3" style="height: 200px; width: 100%;">
                    <!-- Grafico a barre semplificato con HTML/CSS -->
                    <div class="earnings-chart">
                        <div class="chart-container">
                            <div class="chart-bar" style="height: 60%;" data-bs-toggle="tooltip" title="Novembre: €580.50">
                                <div class="chart-label">Nov</div>
                            </div>
                            <div class="chart-bar" style="height: 75%;" data-bs-toggle="tooltip" title="Dicembre: €725.75">
                                <div class="chart-label">Dic</div>
                            </div>
                            <div class="chart-bar" style="height: 85%;" data-bs-toggle="tooltip" title="Gennaio: €810.00">
                                <div class="chart-label">Gen</div>
                            </div>
                            <div class="chart-bar" style="height: 70%;" data-bs-toggle="tooltip" title="Febbraio: €650.75">
                                <div class="chart-label">Feb</div>
                            </div>
                            <div class="chart-bar" style="height: 78%;" data-bs-toggle="tooltip" title="Marzo: €720.25">
                                <div class="chart-label">Mar</div>
                            </div>
                            <div class="chart-bar accent-1" style="height: 65%;" data-bs-toggle="tooltip" title="Aprile: €680.50">
                                <div class="chart-label">Apr</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title d-flex align-items-center">
                        <span class="icon-circle bg-info-light driver-text-info me-2">
                            <i class="fas fa-history"></i>
                        </span>
                        Storico Pagamenti
                    </h5>
                    <div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">Filtra per</span>
                            <select class="form-select" id="payment-period-filter">
                                <option value="all" selected>Tutti</option>
                                <option value="month">Questo Mese</option>
                                <option value="quarter">Ultimo Trimestre</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive custom-table-container">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>ID Pagamento</th>
                                <th>Data</th>
                                <th>Periodo</th>
                                <th>Importo</th>
                                <th>Tipo</th>
                                <th>Stato</th>
                                <th>Dettagli</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PAY-2023-0358</td>
                                <td>01/04/2025</td>
                                <td>Marzo 2025</td>
                                <td>€680.50</td>
                                <td>Stipendio</td>
                                <td><span class="badge-pill bg-success-light text-success">Pagato</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Fattura">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>PAY-2023-0320</td>
                                <td>01/03/2025</td>
                                <td>Febbraio 2025</td>
                                <td>€650.75</td>
                                <td>Stipendio</td>
                                <td><span class="badge-pill bg-success-light text-success">Pagato</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Fattura">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>PAY-2023-0278</td>
                                <td>01/02/2025</td>
                                <td>Gennaio 2025</td>
                                <td>€720.25</td>
                                <td>Stipendio</td>
                                <td><span class="badge-pill bg-success-light text-success">Pagato</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Fattura">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>PAY-2023-0232</td>
                                <td>01/01/2025</td>
                                <td>Dicembre 2024</td>
                                <td>€810.00</td>
                                <td>Stipendio</td>
                                <td><span class="badge-pill bg-success-light text-success">Pagato</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Fattura">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>PAY-BONUS-052</td>
                                <td>15/12/2024</td>
                                <td>Dicembre 2024</td>
                                <td>€75.00</td>
                                <td>Bonus</td>
                                <td><span class="badge-pill bg-success-light text-success">Pagato</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Fattura">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <nav aria-label="Paginazione pagamenti">
                        <ul class="pagination pagination-sm">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><i class="fas fa-angle-left"></i></a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestione del filtro per i pagamenti
    const paymentFilter = document.getElementById('payment-period-filter');
    if (paymentFilter) {
        paymentFilter.addEventListener('change', function() {
            // In una implementazione reale qui si filtrerebbero i pagamenti
            console.log(`Filtraggio pagamenti per periodo: ${this.value}`);
        });
    }
    
    // Inizializza i tooltip
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => {
        new bootstrap.Tooltip(tooltip);
    });
});
</script>

<style>
/* Stile per il tab Pagamenti */
#payments .bg-accent-1-light {
    background-color: rgba(54, 209, 220, 0.1);
}

#payments .driver-text-accent-1 {
    color: #36D1DC !important;
}

#payments .driver-invoice-btn {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
}

#payments .driver-invoice-btn:hover {
    transform: scale(1.1);
    color: white;
}

/* Stile per il grafico guadagni */
#payments .earnings-chart {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    padding: 10px 0;
}

#payments .chart-container {
    display: flex;
    justify-content: space-around;
    align-items: flex-end;
    width: 100%;
    height: 100%;
}

#payments .chart-bar {
    background: linear-gradient(135deg, #ff5a5f 0%, #ff8f6b 100%);
    width: 14%;
    border-radius: 4px 4px 0 0;
    position: relative;
    transition: all 0.3s ease;
    min-height: 20px;
}

#payments .chart-bar.accent-1 {
    background: linear-gradient(135deg, #36D1DC 0%, #5B86E5 100%);
}

#payments .chart-bar:hover {
    transform: scaleY(1.05);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#payments .chart-label {
    position: absolute;
    bottom: -25px;
    width: 100%;
    text-align: center;
    font-size: 0.8rem;
    color: #6c757d;
}
</style>