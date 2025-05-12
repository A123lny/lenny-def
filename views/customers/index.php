<?php require_once 'views/layout/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Clienti</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-download me-1"></i> Esporta
            </button>
            <button type="button" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-print me-1"></i> Stampa
            </button>
        </div>
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
            <i class="fas fa-plus me-1"></i> Nuovo cliente
        </button>
    </div>
</div>

<!-- Ricerca clienti -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="input-group">
            <span class="input-group-text bg-white">
                <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text" class="form-control" id="customerSearch" placeholder="Cerca cliente...">
            <button class="btn btn-primary" type="button">Cerca</button>
        </div>
    </div>
    <div class="col-md-3">
        <select class="form-select">
            <option value="all">Tutti i clienti</option>
            <option value="active">Clienti attivi</option>
            <option value="inactive">Clienti inattivi</option>
        </select>
    </div>
    <div class="col-md-3">
        <select class="form-select">
            <option value="name">Ordina per nome</option>
            <option value="orders">Ordina per numero ordini</option>
            <option value="spent">Ordina per totale speso</option>
            <option value="recent">Ordina per più recenti</option>
        </select>
    </div>
</div>

<!-- Lista clienti -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Ordini</th>
                        <th scope="col">Totale speso</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($customers)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">Nessun cliente trovato</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($customers as $customer): ?>
                            <tr class="animate__animated animate__fadeIn">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center">
                                                <?= strtoupper(substr($customer['name'], 0, 1)) ?>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0"><?= $customer['name'] ?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $customer['email'] ?></td>
                                <td><?= $customer['phone'] ?></td>
                                <td><?= $customer['address'] ?></td>
                                <td><span class="badge bg-primary"><?= $customer['orders_count'] ?></span></td>
                                <td><?= number_format($customer['total_spent'], 2, ',', '.') ?>€</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-outline-primary view-customer" data-id="<?= $customer['id'] ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-primary edit-customer" data-id="<?= $customer['id'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger delete-customer" 
                                                data-id="<?= $customer['id'] ?>" 
                                                data-name="<?= $customer['name'] ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Paginazione -->
<nav class="mt-4 d-flex justify-content-center">
    <ul class="pagination">
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

<!-- Modal Nuovo Cliente -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCustomerForm">
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Nome completo</label>
                        <input type="text" class="form-control" id="customerName" required>
                    </div>
                    <div class="mb-3">
                        <label for="customerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="customerEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="customerPhone" class="form-label">Telefono</label>
                        <input type="tel" class="form-control" id="customerPhone" required>
                    </div>
                    <div class="mb-3">
                        <label for="customerAddress" class="form-label">Indirizzo</label>
                        <textarea class="form-control" id="customerAddress" rows="2" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary">Salva cliente</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Elimina Cliente -->
<div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Conferma eliminazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Sei sicuro di voler eliminare il cliente <strong id="deleteCustomerName"></strong>?</p>
                <p class="text-danger">Questa azione non può essere annullata. Gli ordini associati rimarranno nel sistema ma senza riferimento al cliente.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteCustomer">Elimina</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestione eliminazione cliente
        const deleteButtons = document.querySelectorAll('.delete-customer');
        const deleteCustomerModal = new bootstrap.Modal(document.getElementById('deleteCustomerModal'));
        const deleteCustomerNameEl = document.getElementById('deleteCustomerName');
        let customerIdToDelete = null;
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                customerIdToDelete = this.dataset.id;
                deleteCustomerNameEl.textContent = this.dataset.name;
                deleteCustomerModal.show();
            });
        });
        
        // Conferma eliminazione cliente
        document.getElementById('confirmDeleteCustomer').addEventListener('click', function() {
            // In un'app reale, qui faremmo una richiesta AJAX per eliminare il cliente
            
            // Simulare eliminazione
            const rowToDelete = document.querySelector(`.delete-customer[data-id="${customerIdToDelete}"]`).closest('tr');
            rowToDelete.classList.add('animate__animated', 'animate__fadeOut');
            
            setTimeout(() => {
                rowToDelete.remove();
                deleteCustomerModal.hide();
                
                // Mostrare notifica
                const toast = `
                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050">
                        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong class="me-auto">Notifica</strong>
                                <small>Adesso</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Cliente eliminato con successo!
                            </div>
                        </div>
                    </div>
                `;
                
                document.body.insertAdjacentHTML('beforeend', toast);
                
                // Rimuovere il toast dopo 3 secondi
                setTimeout(() => {
                    document.querySelector('.toast').remove();
                }, 3000);
            }, 500);
        });
    });
</script>

<?php require_once 'views/layout/footer.php'; ?>
