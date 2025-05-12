<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title d-flex align-items-center">
                        <span class="icon-circle bg-primary-light driver-text-primary me-2">
                            <i class="fas fa-history"></i>
                        </span>
                        Storico Utilizzo Mezzi
                    </h5>
                    <div class="period-filter">
                        <button type="button" class="period-btn active" data-period="all">
                            <i class="fas fa-calendar-alt me-2"></i> Tutti
                        </button>
                        <button type="button" class="period-btn" data-period="current">
                            <i class="fas fa-calendar-day me-2"></i> Attuali
                        </button>
                        <button type="button" class="period-btn" data-period="past">
                            <i class="fas fa-history me-2"></i> Passati
                        </button>
                    </div>
                </div>
                
                <div class="table-responsive custom-table-container">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Veicolo</th>
                                <th>Tipo</th>
                                <th>Targa/ID</th>
                                <th>Proprietà</th>
                                <th>Inizio Utilizzo</th>
                                <th>Fine Utilizzo</th>
                                <th>Stato</th>
                                <th>Dettagli</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="icon-circle bg-primary-soft driver-text-primary me-2" style="width: 28px; height: 28px;">
                                            <i class="fas fa-motorcycle"></i>
                                        </span>
                                        <span>Honda SH 125</span>
                                    </div>
                                </td>
                                <td>Scooter</td>
                                <td>AB12345</td>
                                <td><span class="badge-pill bg-primary-light text-primary">Aziendale</span></td>
                                <td>01/03/2025</td>
                                <td>In uso</td>
                                <td><span class="badge-pill bg-success-light text-success">Attivo</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Dettagli">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="icon-circle bg-success-soft driver-text-success me-2" style="width: 28px; height: 28px;">
                                            <i class="fas fa-bicycle"></i>
                                        </span>
                                        <span>Trek FX 3</span>
                                    </div>
                                </td>
                                <td>Bicicletta</td>
                                <td>BIKE-2023-12</td>
                                <td><span class="badge-pill bg-accent-2-light driver-text-accent-2">Proprio</span></td>
                                <td>01/02/2025</td>
                                <td>In uso</td>
                                <td><span class="badge-pill bg-success-light text-success">Attivo</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Dettagli">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="icon-circle bg-info-soft driver-text-info me-2" style="width: 28px; height: 28px;">
                                            <i class="fas fa-car"></i>
                                        </span>
                                        <span>Fiat Panda</span>
                                    </div>
                                </td>
                                <td>Auto</td>
                                <td>CD67890</td>
                                <td><span class="badge-pill bg-accent-2-light driver-text-accent-2">Proprio</span></td>
                                <td>10/01/2025</td>
                                <td>In uso</td>
                                <td><span class="badge-pill bg-success-light text-success">Attivo</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Dettagli">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="icon-circle bg-warning-soft driver-text-warning me-2" style="width: 28px; height: 28px;">
                                            <i class="fas fa-motorcycle"></i>
                                        </span>
                                        <span>Yamaha XMAX 300</span>
                                    </div>
                                </td>
                                <td>Scooter</td>
                                <td>EF78901</td>
                                <td><span class="badge-pill bg-primary-light text-primary">Aziendale</span></td>
                                <td>15/10/2024</td>
                                <td>30/12/2024</td>
                                <td><span class="badge-pill bg-secondary-light text-secondary">Storico</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Dettagli">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="icon-circle bg-secondary-soft driver-text-secondary me-2" style="width: 28px; height: 28px;">
                                            <i class="fas fa-bicycle"></i>
                                        </span>
                                        <span>Bianchi Via Nirone</span>
                                    </div>
                                </td>
                                <td>Bicicletta</td>
                                <td>BIKE-2022-05</td>
                                <td><span class="badge-pill bg-accent-2-light driver-text-accent-2">Proprio</span></td>
                                <td>01/05/2024</td>
                                <td>15/01/2025</td>
                                <td><span class="badge-pill bg-secondary-light text-secondary">Storico</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Dettagli">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
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

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center">
                    <span class="icon-circle bg-info-light driver-text-info me-2">
                        <i class="fas fa-clipboard-list"></i>
                    </span>
                    Documenti dei Veicoli
                </h5>
                <div class="table-responsive custom-table-container mt-4">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Veicolo</th>
                                <th>Documento</th>
                                <th>Numero</th>
                                <th>Data Emissione</th>
                                <th>Data Scadenza</th>
                                <th>Stato</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Honda SH 125</td>
                                <td>Assicurazione</td>
                                <td>POL-2023-456789</td>
                                <td>15/07/2024</td>
                                <td>15/07/2025</td>
                                <td><span class="badge-pill bg-success-light text-success">Valido</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Visualizza">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Scarica">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Honda SH 125</td>
                                <td>Libretto</td>
                                <td>LIB-2022-987654</td>
                                <td>10/10/2022</td>
                                <td>-</td>
                                <td><span class="badge-pill bg-success-light text-success">Valido</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Visualizza">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Scarica">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Fiat Panda</td>
                                <td>Assicurazione</td>
                                <td>POL-2024-123456</td>
                                <td>10/05/2024</td>
                                <td>10/05/2025</td>
                                <td><span class="badge-pill bg-warning-light text-warning">In Scadenza</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Visualizza">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Scarica">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Fiat Panda</td>
                                <td>Revisione</td>
                                <td>REV-2023-001122</td>
                                <td>20/06/2023</td>
                                <td>20/06/2025</td>
                                <td><span class="badge-pill bg-success-light text-success">Valido</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Visualizza">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Scarica">
                                            <i class="fas fa-download"></i>
                                        </a>
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

<style>
/* Stile per il tab Mezzi */
#vehicles .bg-secondary-light {
    background-color: rgba(108, 117, 125, 0.1);
}

#vehicles .text-secondary {
    color: #6c757d !important;
}

#vehicles .bg-accent-2-light {
    background-color: rgba(255, 170, 0, 0.1);
}

#vehicles .driver-text-accent-2 {
    color: #FFAA00 !important;
}

#vehicles .bg-success-soft {
    background-color: rgba(40, 167, 69, 0.1);
}

#vehicles .driver-text-success {
    color: #28a745 !important;
}

#vehicles .bg-info-soft {
    background-color: rgba(54, 209, 220, 0.1);
}

#vehicles .driver-text-info {
    color: #36D1DC !important;
}

#vehicles .bg-warning-soft {
    background-color: rgba(255, 170, 0, 0.1);
}

#vehicles .driver-text-warning {
    color: #FFA500 !important;
}

#vehicles .bg-primary-soft {
    background-color: rgba(255, 90, 95, 0.1);
}

/* Stile per i filtri periodo */
#vehicles .period-filter {
    display: flex;
    background-color: #f8f9fa;
    border-radius: 0.5rem;
    padding: 2px;
    border: 1px solid #dee2e6;
}

#vehicles .period-btn {
    background: none;
    border: none;
    color: var(--color-grey-700);
    padding: 4px 10px;
    border-radius: var(--border-radius);
    font-size: 0.875rem;
    font-weight: 600;
    transition: all 0.2s ease;
}

#vehicles .period-btn:hover {
    color: var(--color-primary);
}

#vehicles .period-btn.active {
    background: var(--gradient-primary);
    color: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
    #vehicles .period-filter {
        flex-wrap: nowrap;
        overflow-x: auto;
        padding: 1px;
    }
    
    #vehicles .period-btn {
        white-space: nowrap;
        font-size: 0.8rem;
        padding: 4px 8px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inizializza i tooltip
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => {
        new bootstrap.Tooltip(tooltip);
    });
    
    // Gestione filtri periodo
    const periodButtons = document.querySelectorAll('#vehicles .period-btn');
    periodButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Rimuovi la classe active da tutti i bottoni
            periodButtons.forEach(b => b.classList.remove('active'));
            // Aggiungi la classe active al bottone cliccato
            this.classList.add('active');
            
            const period = this.dataset.period;
            console.log(`Filtraggio per periodo: ${period}`);
            
            // Qui andrebbe implementata la logica di filtro della tabella
            // Per ora è solo un esempio visivo
        });
    });
});
</script>