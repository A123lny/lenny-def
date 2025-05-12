<?php
require_once __DIR__ . '/../../config/config.php';
$pageTitle = "Report Mezzi";
require_once __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Report Mezzi</h1>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs mb-4" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#controlli">Controlli</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#rifornimenti">Rifornimenti</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#costi">Altri Costi</a>
        </li>
    </ul>

    <!-- Tab content -->
    <div class="tab-content">
        <!-- Controlli Tab -->
        <div class="tab-pane fade show active" id="controlli">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Controlli Giornalieri</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkModal">
                        <i class="fas fa-plus"></i> Nuovo Controllo
                    </button>
                </div>
                <div class="card-body">
                    <!-- Filtro date per controlli -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label">Data Inizio</label>
                                <input type="date" class="form-control" id="checksStartDate">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label">Data Fine</label>
                                <input type="date" class="form-control" id="checksEndDate">
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <div class="mb-2 w-100">
                                <button type="button" class="btn btn-primary w-100" id="btnFilterChecks">
                                    <i class="fas fa-filter"></i> Filtra
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="checksTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Veicolo</th>
                                    <th>Km Odierni</th>
                                    <th>Stato</th>
                                    <th>Note</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rifornimenti Tab -->
        <div class="tab-pane fade" id="rifornimenti">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Rifornimenti</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#refuelModal">
                        <i class="fas fa-plus"></i> Nuovo Rifornimento
                    </button>
                </div>
                <div class="card-body">
                    <!-- Filtro date per rifornimenti -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label">Data Inizio</label>
                                <input type="date" class="form-control" id="refuelStartDate">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label">Data Fine</label>
                                <input type="date" class="form-control" id="refuelEndDate">
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <div class="mb-2 w-100">
                                <button type="button" class="btn btn-primary w-100" id="btnFilterRefuel">
                                    <i class="fas fa-filter"></i> Filtra
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="refuelTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Veicolo</th>
                                    <th>Litri</th>
                                    <th>Tipo</th>
                                    <th>Costo</th>
                                    <th>Pagamento</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Altri Costi Tab -->
        <div class="tab-pane fade" id="costi">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Altri Costi</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#costModal">
                        <i class="fas fa-plus"></i> Nuovo Costo
                    </button>
                </div>
                <div class="card-body">
                    <!-- Filtro date per altri costi -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label">Data Inizio</label>
                                <input type="date" class="form-control" id="costsStartDate">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label">Data Fine</label>
                                <input type="date" class="form-control" id="costsEndDate">
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <div class="mb-2 w-100">
                                <button type="button" class="btn btn-primary w-100" id="btnFilterCosts">
                                    <i class="fas fa-filter"></i> Filtra
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="costsTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Veicolo</th>
                                    <th>Tipo</th>
                                    <th>Descrizione</th>
                                    <th>Importo</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- Controllo Modal -->
<div class="modal fade" id="checkModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuovo Controllo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="checkForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Data</label>
                        <input type="date" class="form-control" id="checkDate" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Veicolo</label>
                        <select class="form-select" id="checkVehicle" required>
                            <option value="">Seleziona veicolo...</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Km Odierni</label>
                        <input type="number" class="form-control" id="kmToday" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Controlli</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkLivelli">
                            <label class="form-check-label">Livelli (olio, acqua, etc.)</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkPneumatici">
                            <label class="form-check-label">Pneumatici</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkDanni">
                            <label class="form-check-label">Danni Esterni</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkPulizia">
                            <label class="form-check-label">Pulizia</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea class="form-control" id="checkNotes" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" class="form-control" id="checkPhotos" multiple accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-primary">Salva</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Rifornimento Modal -->
<div class="modal fade" id="refuelModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuovo Rifornimento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="refuelForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Data</label>
                        <input type="date" class="form-control" id="refuelDate" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Veicolo</label>
                        <select class="form-select" id="refuelVehicle" required>
                            <option value="">Seleziona veicolo...</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Litri</label>
                        <input type="number" step="0.1" class="form-control" id="refuelLiters" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo Carburante</label>
                        <select class="form-select" id="fuelType" required>
                            <option value="benzina">Benzina</option>
                            <option value="diesel">Diesel</option>
                            <option value="gpl">GPL</option>
                            <option value="metano">Metano</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" id="refuelCost" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Metodo Pagamento</label>
                        <select class="form-select" id="paymentMethod" required>
                            <option value="carta_carburante">Carta Carburante</option>
                            <option value="contanti">Contanti</option>
                            <option value="carta_credito">Carta di Credito</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea class="form-control" id="refuelNotes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-primary">Salva</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Costo Modal -->
<div class="modal fade" id="costModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuovo Costo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="costForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Data</label>
                        <input type="date" class="form-control" id="costDate" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Veicolo</label>
                        <select class="form-select" id="costVehicle" required>
                            <option value="">Seleziona veicolo...</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" id="costType" required>
                            <option value="lavaggio">Lavaggio</option>
                            <option value="pedaggio">Pedaggio</option>
                            <option value="multa">Multa</option>
                            <option value="altro">Altro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descrizione</label>
                        <textarea class="form-control" id="costDescription" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Importo</label>
                        <input type="number" step="0.01" class="form-control" id="costAmount" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Documento</label>
                        <input type="file" class="form-control" id="costDocument" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-primary">Salva</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Anteprima Documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="previewContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                <button type="button" class="btn btn-primary" onclick="downloadDocument()">
                    <i class="fas fa-download"></i> Scarica
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Required JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../../assets/js/vehicle_reports.js"></script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>