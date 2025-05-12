<?php
/**
 * Tab Statistiche per il modal dei dettagli del ristorante
 */
?>
<!-- Tab Statistiche -->
<div class="tab-pane fade" id="stats" role="tabpanel" aria-labelledby="stats-tab">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-hover">
                <div class="card-body p-0">
                    <div class="card-header bg-light border-0 d-flex justify-content-between align-items-center p-3">
                        <h5 class="card-title d-flex align-items-center m-0">
                            <span class="icon-circle bg-primary-light driver-text-primary me-2">
                                <i class="fas fa-chart-bar"></i>
                            </span>
                            Andamento ordini e fatturato
                        </h5>
                        <div class="period-filter">
                            <button class="period-btn active" data-period="week">7 giorni</button>
                            <button class="period-btn" data-period="month">30 giorni</button>
                            <button class="period-btn" data-period="year">12 mesi</button>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <canvas id="restaurantOrdersChart" height="125"></canvas>
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
                            <i class="fas fa-tachometer-alt"></i>
                        </span>
                        Performance ultimi 30 giorni
                    </h5>
                    <div class="table-responsive custom-table-container mt-3">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>Metrica</th>
                                    <th class="text-center">Valore</th>
                                    <th class="text-end">Trend</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="icon-circle bg-primary-soft driver-text-primary me-2" style="width: 24px; height: 24px;">
                                                <i class="fas fa-clock"></i>
                                            </span>
                                            <span>Tempo medio di consegna</span>
                                        </div>
                                    </td>
                                    <td class="text-center">32 minuti</td>
                                    <td class="text-end text-success">
                                        <i class="fas fa-arrow-down me-1"></i> -3%
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="icon-circle bg-info-soft driver-text-info me-2" style="width: 24px; height: 24px;">
                                                <i class="fas fa-shopping-cart"></i>
                                            </span>
                                            <span>Valore medio ordine</span>
                                        </div>
                                    </td>
                                    <td class="text-center">€ 24,60</td>
                                    <td class="text-end text-success">
                                        <i class="fas fa-arrow-up me-1"></i> +5.2%
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="icon-circle bg-success-soft driver-text-success me-2" style="width: 24px; height: 24px;">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                            <span>Tasso di ordini completati</span>
                                        </div>
                                    </td>
                                    <td class="text-center">98.3%</td>
                                    <td class="text-end text-success">
                                        <i class="fas fa-arrow-up me-1"></i> +0.5%
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="icon-circle bg-warning-soft driver-text-warning me-2" style="width: 24px; height: 24px;">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <span>Tasso di reclami</span>
                                        </div>
                                    </td>
                                    <td class="text-center">1.7%</td>
                                    <td class="text-end text-danger">
                                        <i class="fas fa-arrow-up me-1"></i> +0.3%
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="icon-circle bg-secondary-soft driver-text-secondary me-2" style="width: 24px; height: 24px;">
                                                <i class="fas fa-redo"></i>
                                            </span>
                                            <span>Tasso di riordino</span>
                                        </div>
                                    </td>
                                    <td class="text-center">42%</td>
                                    <td class="text-end text-success">
                                        <i class="fas fa-arrow-up me-1"></i> +3.1%
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