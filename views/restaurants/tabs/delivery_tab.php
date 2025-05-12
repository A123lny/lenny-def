<?php
/**
 * Tab Consegne per il modal dei dettagli del ristorante
 */
?>
<!-- Tab Consegne -->
<div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
    <div class="card border-0 shadow-hover mb-4">
        <div class="card-body">
            <h5 class="card-title d-flex align-items-center">
                <span class="icon-circle bg-primary-light driver-text-primary me-2">
                    <i class="fas fa-map-marked-alt"></i>
                </span>
                Zone di consegna
            </h5>
            <div class="table-responsive custom-table-container mt-3">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>Zona</th>
                            <th class="text-center">Costo</th>
                            <th>Tempo stimato</th>
                            <th>Ordine minimo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="icon-circle bg-success-soft driver-text-success me-2" style="width: 24px; height: 24px;">
                                        <i class="fas fa-map-pin"></i>
                                    </span>
                                    <span>Centro Milano</span>
                                </div>
                            </td>
                            <td class="text-center"><span class="badge-pill bg-success-light text-success">€0,00</span></td>
                            <td>15-25 min</td>
                            <td>€10,00</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="icon-circle bg-primary-soft driver-text-primary me-2" style="width: 24px; height: 24px;">
                                        <i class="fas fa-map-pin"></i>
                                    </span>
                                    <span>Milano Nord</span>
                                </div>
                            </td>
                            <td class="text-center"><span class="badge-pill bg-primary-light driver-text-primary">€1,50</span></td>
                            <td>25-40 min</td>
                            <td>€15,00</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="icon-circle bg-primary-soft driver-text-primary me-2" style="width: 24px; height: 24px;">
                                        <i class="fas fa-map-pin"></i>
                                    </span>
                                    <span>Milano Sud</span>
                                </div>
                            </td>
                            <td class="text-center"><span class="badge-pill bg-primary-light driver-text-primary">€2,50</span></td>
                            <td>30-45 min</td>
                            <td>€15,00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>