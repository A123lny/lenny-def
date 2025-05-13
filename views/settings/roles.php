
<?php
/**
 * Vista per la gestione dei ruoli e permessi
 */
require_once 'views/layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Ruoli e Permessi</h4>
                    <a href="<?php echo url('settings'); ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Torna alle Impostazioni
                    </a>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs custom-tabs mb-4" id="rolesTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="roles-tab" data-bs-toggle="tab" data-bs-target="#roles" type="button" role="tab" aria-controls="roles" aria-selected="true">
                                <i class="fas fa-users me-2"></i> Ruoli
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="permissions-tab" data-bs-toggle="tab" data-bs-target="#permissions" type="button" role="tab" aria-controls="permissions" aria-selected="false">
                                <i class="fas fa-key me-2"></i> Permessi
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="assignments-tab" data-bs-toggle="tab" data-bs-target="#assignments" type="button" role="tab" aria-controls="assignments" aria-selected="false">
                                <i class="fas fa-user-tag me-2"></i> Assegnazioni
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="rolesTabContent">
                        <!-- Tab Ruoli -->
                        <div class="tab-pane fade show active" id="roles" role="tabpanel" aria-labelledby="roles-tab">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">Gestione Ruoli</h5>
                                <button class="btn btn-sm btn-primary" id="addRoleBtn">
                                    <i class="fas fa-plus me-1"></i> Nuovo Ruolo
                                </button>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nome Ruolo</th>
                                            <th>Descrizione</th>
                                            <th>Utenti Assegnati</th>
                                            <th>Livello</th>
                                            <th class="text-center">Azioni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="badge bg-danger">Amministratore</span></td>
                                            <td>Accesso completo a tutte le funzionalità</td>
                                            <td>2 utenti</td>
                                            <td>1 (massimo)</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary me-1" title="Modifica">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary" title="Visualizza" disabled>
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge bg-warning text-dark">Manager</span></td>
                                            <td>Gestione ristoranti, ordini e reports</td>
                                            <td>4 utenti</td>
                                            <td>2</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary me-1" title="Modifica">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Elimina">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge bg-info">Operatore</span></td>
                                            <td>Gestione ordini e supporto clienti</td>
                                            <td>8 utenti</td>
                                            <td>3</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary me-1" title="Modifica">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Elimina">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge bg-secondary">Visualizzatore</span></td>
                                            <td>Solo visualizzazione dati</td>
                                            <td>5 utenti</td>
                                            <td>4</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary me-1" title="Modifica">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Elimina">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Tab Permessi -->
                        <div class="tab-pane fade" id="permissions" role="tabpanel" aria-labelledby="permissions-tab">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">Permessi del Sistema</h5>
                                <div>
                                    <select class="form-select form-select-sm" id="roleFilter">
                                        <option value="all">Tutti i ruoli</option>
                                        <option value="admin">Amministratore</option>
                                        <option value="manager">Manager</option>
                                        <option value="operator">Operatore</option>
                                        <option value="viewer">Visualizzatore</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="accordion" id="permissionsAccordion">
                                <!-- Sezione Dashboard -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingDashboard">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDashboard" aria-expanded="true" aria-controls="collapseDashboard">
                                            <i class="fas fa-chart-line me-2"></i> Dashboard
                                        </button>
                                    </h2>
                                    <div id="collapseDashboard" class="accordion-collapse collapse show" aria-labelledby="headingDashboard" data-bs-parent="#permissionsAccordion">
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                <table class="table table-sm">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Permesso</th>
                                                            <th class="text-center">Admin</th>
                                                            <th class="text-center">Manager</th>
                                                            <th class="text-center">Operatore</th>
                                                            <th class="text-center">Visualizzatore</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Visualizzare Dashboard</td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked disabled></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Visualizzare metriche finanziarie</td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked disabled></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input"></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Esportare reports</td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked disabled></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input"></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Sezione Ristoranti -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingRestaurants">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRestaurants" aria-expanded="false" aria-controls="collapseRestaurants">
                                            <i class="fas fa-utensils me-2"></i> Ristoranti
                                        </button>
                                    </h2>
                                    <div id="collapseRestaurants" class="accordion-collapse collapse" aria-labelledby="headingRestaurants" data-bs-parent="#permissionsAccordion">
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                <table class="table table-sm">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Permesso</th>
                                                            <th class="text-center">Admin</th>
                                                            <th class="text-center">Manager</th>
                                                            <th class="text-center">Operatore</th>
                                                            <th class="text-center">Visualizzatore</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Visualizzare ristoranti</td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked disabled></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Aggiungere ristoranti</td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked disabled></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input"></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Modificare ristoranti</td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked disabled></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input"></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Eliminare ristoranti</td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input" checked disabled></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input"></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input"></td>
                                                            <td class="text-center"><input type="checkbox" class="form-check-input"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Altre sezioni con accordion -->
                            </div>
                            
                            <div class="mt-4 text-end">
                                <button type="button" class="btn btn-primary">Salva Modifiche</button>
                            </div>
                        </div>
                        
                        <!-- Tab Assegnazioni -->
                        <div class="tab-pane fade" id="assignments" role="tabpanel" aria-labelledby="assignments-tab">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">Assegnazione Ruoli agli Utenti</h5>
                                <div>
                                    <input type="text" class="form-control form-control-sm" placeholder="Cerca utente..." id="userSearch">
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Utente</th>
                                            <th>Email</th>
                                            <th>Ruolo Attuale</th>
                                            <th>Assegna Ruolo</th>
                                            <th class="text-center">Azioni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-2 bg-primary">MA</div>
                                                    Mario Rossi
                                                </div>
                                            </td>
                                            <td>mario.rossi@lenny.it</td>
                                            <td><span class="badge bg-danger">Amministratore</span></td>
                                            <td>
                                                <select class="form-select form-select-sm" disabled>
                                                    <option value="admin" selected>Amministratore</option>
                                                    <option value="manager">Manager</option>
                                                    <option value="operator">Operatore</option>
                                                    <option value="viewer">Visualizzatore</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-secondary" disabled>Salva</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-2 bg-success">LV</div>
                                                    Laura Verdi
                                                </div>
                                            </td>
                                            <td>laura.verdi@lenny.it</td>
                                            <td><span class="badge bg-warning text-dark">Manager</span></td>
                                            <td>
                                                <select class="form-select form-select-sm">
                                                    <option value="admin">Amministratore</option>
                                                    <option value="manager" selected>Manager</option>
                                                    <option value="operator">Operatore</option>
                                                    <option value="viewer">Visualizzatore</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary">Salva</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-2 bg-info">GP</div>
                                                    Giorgio Perri
                                                </div>
                                            </td>
                                            <td>giorgio.perri@lenny.it</td>
                                            <td><span class="badge bg-info">Operatore</span></td>
                                            <td>
                                                <select class="form-select form-select-sm">
                                                    <option value="admin">Amministratore</option>
                                                    <option value="manager">Manager</option>
                                                    <option value="operator" selected>Operatore</option>
                                                    <option value="viewer">Visualizzatore</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary">Salva</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-2 bg-warning">SB</div>
                                                    Sara Belli
                                                </div>
                                            </td>
                                            <td>sara.belli@lenny.it</td>
                                            <td><span class="badge bg-secondary">Visualizzatore</span></td>
                                            <td>
                                                <select class="form-select form-select-sm">
                                                    <option value="admin">Amministratore</option>
                                                    <option value="manager">Manager</option>
                                                    <option value="operator">Operatore</option>
                                                    <option value="viewer" selected>Visualizzatore</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary">Salva</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <nav aria-label="Paginazione" class="mt-4">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Precedente</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Successiva</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
