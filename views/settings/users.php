
<?php
/**
 * Vista per la gestione degli utenti
 */
require_once 'views/layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Gestione Utenti</h4>
                    <a href="<?php echo url('settings'); ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Torna alle Impostazioni
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cerca utenti..." id="searchUsers">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <select class="form-select ms-3" id="filterRole">
                                <option value="all">Tutti i ruoli</option>
                                <option value="admin">Amministratore</option>
                                <option value="manager">Manager</option>
                                <option value="operator">Operatore</option>
                                <option value="viewer">Visualizzatore</option>
                            </select>
                        </div>
                        <button class="btn btn-success" id="addUserBtn">
                            <i class="fas fa-plus me-1"></i> Nuovo Utente
                        </button>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Ruolo</th>
                                    <th>Ultimo accesso</th>
                                    <th>Stato</th>
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
                                    <td>Oggi, 14:30</td>
                                    <td><span class="badge bg-success">Attivo</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary me-1" title="Modifica">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info me-1" title="Impersona">
                                            <i class="fas fa-user-secret"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" title="Disabilita" disabled>
                                            <i class="fas fa-user-slash"></i>
                                        </button>
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
                                    <td>Ieri, 18:45</td>
                                    <td><span class="badge bg-success">Attivo</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary me-1" title="Modifica">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info me-1" title="Impersona">
                                            <i class="fas fa-user-secret"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" title="Disabilita">
                                            <i class="fas fa-user-slash"></i>
                                        </button>
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
                                    <td>15/05/2025, 09:10</td>
                                    <td><span class="badge bg-success">Attivo</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary me-1" title="Modifica">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info me-1" title="Impersona">
                                            <i class="fas fa-user-secret"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" title="Disabilita">
                                            <i class="fas fa-user-slash"></i>
                                        </button>
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
                                    <td>10/05/2025, 11:25</td>
                                    <td><span class="badge bg-success">Attivo</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary me-1" title="Modifica">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info me-1" title="Impersona">
                                            <i class="fas fa-user-secret"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" title="Disabilita">
                                            <i class="fas fa-user-slash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2 bg-danger">FC</div>
                                            Franco Colombo
                                        </div>
                                    </td>
                                    <td>franco.colombo@lenny.it</td>
                                    <td><span class="badge bg-info">Operatore</span></td>
                                    <td>01/05/2025, 14:20</td>
                                    <td><span class="badge bg-secondary">Inattivo</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary me-1" title="Modifica">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info me-1" title="Impersona">
                                            <i class="fas fa-user-secret"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Attiva">
                                            <i class="fas fa-user-check"></i>
                                        </button>
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

<?php require_once 'views/layout/footer.php'; ?>
