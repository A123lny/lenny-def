<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Mezzi</title>
    <?php require_once 'views/layout/header.php'; ?>
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.css' rel='stylesheet' />
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="my-4">Gestione Mezzi</h1>
                
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-4" id="vehiclesTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="fleet-tab" data-bs-toggle="tab" data-bs-target="#fleet" type="button" role="tab">
                            <i class="fas fa-car me-2"></i>Flotta
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab">
                            <i class="fas fa-file-alt me-2"></i>Documenti
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="stats-tab" data-bs-toggle="tab" data-bs-target="#stats" type="button" role="tab">
                            <i class="fas fa-chart-pie me-2"></i>Statistiche
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="maintenance-tab" data-bs-toggle="tab" data-bs-target="#maintenance" type="button" role="tab">
                            <i class="fas fa-tools me-2"></i>Manutenzione
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="performance-tab" data-bs-toggle="tab" data-bs-target="#performance" type="button" role="tab">
                            <i class="fas fa-tachometer-alt me-2"></i>Performance
                        </button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Tab Flotta -->
                    <div class="tab-pane fade show active" id="fleet" role="tabpanel">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                                <h5 class="mb-0">Lista Mezzi</h5>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
                                    <i class="fas fa-plus me-1"></i> Aggiungi Mezzo
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="vehiclesTable" class="table table-hover display responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tipo</th>
                                                <th>Targa</th>
                                                <th>Stato</th>
                                                <th>Scadenza Bollo</th>
                                                <th>Scadenza Assicurazione</th>
                                                <th class="text-end">Azioni</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($vehicles) && !empty($vehicles)): ?>
                                                <?php foreach($vehicles as $vehicle): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($vehicle['id']); ?></td>
                                                        <td><?php echo htmlspecialchars($vehicle['tipo']); ?></td>
                                                        <td><?php echo htmlspecialchars($vehicle['targa']); ?></td>
                                                        <td>
                                                            <span class="badge bg-<?php echo $vehicle['stato'] == 'disponibile' ? 'success' : 'danger'; ?>">
                                                                <?php echo htmlspecialchars($vehicle['stato']); ?>
                                                            </span>
                                                        </td>
                                                        <td><?php echo isset($vehicle['scadenza_bollo']) ? date('d/m/Y', strtotime($vehicle['scadenza_bollo'])) : '-'; ?></td>
                                                        <td><?php echo isset($vehicle['scadenza_assicurazione']) ? date('d/m/Y', strtotime($vehicle['scadenza_assicurazione'])) : '-'; ?></td>
                                                        <td class="text-end">
                                                            <button type="button" class="btn btn-light btn-sm" onclick="editVehicle(<?php echo $vehicle['id']; ?>)" 
                                                                    data-bs-toggle="tooltip" title="Modifica">
                                                                <i class="fas fa-edit text-primary"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-light btn-sm" onclick="deleteVehicle(<?php echo $vehicle['id']; ?>)"
                                                                    data-bs-toggle="tooltip" title="Elimina">
                                                                <i class="fas fa-trash text-danger"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Documenti -->
                    <div class="tab-pane fade" id="documents" role="tabpanel">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0">Documenti Archiviati</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="documentsTable" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Mezzo</th>
                                                        <th>Tipo Documento</th>
                                                        <th>Data Caricamento</th>
                                                        <th>Scadenza</th>
                                                        <th>Stato</th>
                                                        <th>Azioni</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Populated by JavaScript -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0">Carica Documento</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="documentUploadForm">
                                            <div class="mb-3">
                                                <label for="docVehicle" class="form-label">Mezzo</label>
                                                <select class="form-select" id="docVehicle" required>
                                                    <!-- Populated by JavaScript -->
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="docType" class="form-label">Tipo Documento</label>
                                                <select class="form-select" id="docType" required>
                                                    <option value="libretto">Libretto</option>
                                                    <option value="assicurazione">Assicurazione</option>
                                                    <option value="revisione">Revisione</option>
                                                    <option value="bollo">Bollo</option>
                                                    <option value="altro">Altro</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="docFile" class="form-label">File</label>
                                                <input type="file" class="form-control" id="docFile" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="docExpiry" class="form-label">Data Scadenza</label>
                                                <input type="date" class="form-control" id="docExpiry">
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="docNotify">
                                                    <label class="form-check-label" for="docNotify">
                                                        Notifica scadenza
                                                    </label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-upload me-1"></i> Carica
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Statistiche -->
                    <div class="tab-pane fade" id="stats" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0">Distribuzione Mezzi per Tipo</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="vehicleTypeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0">Scadenze Prossimi 3 Mesi</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="expiryChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0">Statistiche di Utilizzo</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="usageChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Manutenzione -->
                    <div class="tab-pane fade" id="maintenance" role="tabpanel">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0">Calendario Manutenzioni</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="maintenanceCalendar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0">Nuova Manutenzione</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="maintenanceForm">
                                            <div class="mb-3">
                                                <label for="maintVehicle" class="form-label">Mezzo</label>
                                                <select class="form-select" id="maintVehicle" required>
                                                    <!-- Populated by JavaScript -->
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="maintType" class="form-label">Tipo Intervento</label>
                                                <select class="form-select" id="maintType" required>
                                                    <option value="revisione">Revisione</option>
                                                    <option value="tagliando">Tagliando</option>
                                                    <option value="riparazione">Riparazione</option>
                                                    <option value="altro">Altro</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="maintDate" class="form-label">Data</label>
                                                <input type="date" class="form-control" id="maintDate" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="maintCost" class="form-label">Costo Previsto</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">€</span>
                                                    <input type="number" class="form-control" id="maintCost" step="0.01">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="maintNotes" class="form-label">Note</label>
                                                <textarea class="form-control" id="maintNotes" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i> Salva
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Performance -->
                    <div class="tab-pane fade" id="performance" role="tabpanel">
                        <!-- Filtro date (Aggiunto dalla sezione Analisi) -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Filtro Periodo</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label class="form-label">Data Inizio</label>
                                            <input type="date" class="form-control" id="analysisStartDate">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label class="form-label">Data Fine</label>
                                            <input type="date" class="form-control" id="analysisEndDate">
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <div class="mb-3 w-100">
                                            <button type="button" class="btn btn-primary w-100" id="btnFilterAnalysis">
                                                <i class="fas fa-filter"></i> Filtra
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-secondary" onclick="setAnalysisPeriod('month')">Ultimo mese</button>
                                            <button type="button" class="btn btn-outline-secondary" onclick="setAnalysisPeriod('quarter')">Ultimo trimestre</button>
                                            <button type="button" class="btn btn-outline-secondary" onclick="setAnalysisPeriod('year')">Ultimo anno</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- Prima riga: Grafici di monitoraggio (Performance esistente) -->
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0">Monitoraggio Consumi</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="consumptionChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0">Costi per Mezzo</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="costsChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Seconda riga: Riepilogo Flotta (Aggiunto dalla sezione Analisi) -->
                            <div class="col-md-12 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                                        <h5 class="mb-0">Riepilogo Flotta</h5>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-primary" onclick="exportReport('pdf')">
                                                <i class="fas fa-file-pdf me-1"></i> PDF
                                            </button>
                                            <button type="button" class="btn btn-outline-primary" onclick="exportReport('excel')">
                                                <i class="fas fa-file-excel me-1"></i> Excel
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive mb-4">
                                            <table id="analysisTable" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Veicolo</th>
                                                        <th>Km Percorsi</th>
                                                        <th>Consumo Carburante</th>
                                                        <th>Costo Carburante</th>
                                                        <th>Costi Manutenzione</th>
                                                        <th>Costo Totale</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Populated by JavaScript -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Terza riga: Report efficienza (Performance esistente) -->
                            <div class="col-md-12">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                                        <h5 class="mb-0">Report Efficienza</h5>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-primary" onclick="exportEfficiencyReport('pdf')">
                                                <i class="fas fa-file-pdf me-1"></i> PDF
                                            </button>
                                            <button type="button" class="btn btn-outline-primary" onclick="exportEfficiencyReport('excel')">
                                                <i class="fas fa-file-excel me-1"></i> Excel
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="efficiencyTable" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Mezzo</th>
                                                        <th>Km Percorsi</th>
                                                        <th>Consumo Medio</th>
                                                        <th>Costo/Km</th>
                                                        <th>Manutenzioni</th>
                                                        <th>Giorni Attività</th>
                                                        <th>Score</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Populated by JavaScript -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal per aggiungere/modificare mezzi -->
    <div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVehicleModalLabel">Aggiungi Mezzo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="vehicleForm">
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo Mezzo</label>
                            <select class="form-select" id="tipo" name="tipo" required>
                                <option value="">Seleziona tipo...</option>
                                <option value="auto">Auto</option>
                                <option value="furgone">Furgone</option>
                                <option value="auto_privata">Auto Privata</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="targa" class="form-label">Targa</label>
                            <input type="text" class="form-control" id="targa" name="targa" required>
                        </div>
                        <div class="mb-3">
                            <label for="stato" class="form-label">Stato</label>
                            <select class="form-select" id="stato" name="stato" required>
                                <option value="disponibile">Disponibile</option>
                                <option value="manutenzione">In Manutenzione</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="scadenza_bollo" class="form-label">Scadenza Bollo</label>
                            <input type="date" class="form-control" id="scadenza_bollo" name="scadenza_bollo">
                            <div class="form-text">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="notifica_bollo" name="notifica_bollo">
                                    <label class="form-check-label" for="notifica_bollo">
                                        Imposta notifica
                                    </label>
                                </div>
                                <div id="notifica_bollo_days_container" class="mt-2 d-none">
                                    <label for="notifica_bollo_days" class="form-label">Giorni di anticipo per la notifica</label>
                                    <select class="form-select form-select-sm" id="notifica_bollo_days" name="notifica_bollo_days">
                                        <option value="7">7 giorni prima</option>
                                        <option value="15">15 giorni prima</option>
                                        <option value="30">30 giorni prima</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="scadenza_assicurazione" class="form-label">Scadenza Assicurazione</label>
                            <input type="date" class="form-control" id="scadenza_assicurazione" name="scadenza_assicurazione">
                            <div class="form-text">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="notifica_assicurazione" name="notifica_assicurazione">
                                    <label class="form-check-label" for="notifica_assicurazione">
                                        Imposta notifica
                                    </label>
                                </div>
                                <div id="notifica_assicurazione_days_container" class="mt-2 d-none">
                                    <label for="notifica_assicurazione_days" class="form-label">Giorni di anticipo per la notifica</label>
                                    <select class="form-select form-select-sm" id="notifica_assicurazione_days" name="notifica_assicurazione_days">
                                        <option value="7">7 giorni prima</option>
                                        <option value="15">15 giorni prima</option>
                                        <option value="30">30 giorni prima</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="saveVehicle()">Salva</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Preview Modal -->
    <div class="modal fade" id="documentPreviewModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Anteprima Documento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="documentPreview" class="ratio ratio-16x9">
                        <!-- Preview content loaded here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="downloadDocument()">
                        <i class="fas fa-download me-1"></i> Scarica
                    </button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'views/layout/footer.php'; ?>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.8/main.min.js'></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom JS -->
    <script src="/assets/js/vehicles.js"></script>
</body>
</html>