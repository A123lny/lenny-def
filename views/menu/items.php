<?php require_once 'views/layout/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Prodotti Menu</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
            <i class="fas fa-plus me-1"></i> Nuovo prodotto
        </button>
    </div>
</div>

<!-- Ricerca e filtri -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="input-group">
            <span class="input-group-text bg-white">
                <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text" class="form-control" id="itemSearch" placeholder="Cerca prodotto...">
        </div>
    </div>
    <div class="col-md-3">
        <select class="form-select" id="categoryFilter">
            <option value="all">Tutte le categorie</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <!-- ...existing code... -->
</div>

<!-- Tabella prodotti -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th scope="col">Prodotto</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Disponibilità</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($menuItems)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">Nessun prodotto trovato</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($menuItems as $item): ?>
                            <tr class="menu-item" data-name="<?= strtolower($item['name']) ?>" data-category="<?= $item['category_id'] ?>" data-available="<?= $item['is_available'] ?>">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/menu/<?= $item['image'] ?>" class="rounded" width="40" height="40" style="object-fit: cover;">
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0"><?= $item['name'] ?></h6>
                                            <span class="text-muted small"><?= substr($item['description'], 0, 50) ?>...</span>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $item['category_name'] ?></td>
                                <td><?= number_format($item['price'], 2, ',', '.') ?>€</td>
                                <td>
                                    <?php if ($item['is_available']): ?>
                                        <span class="badge bg-success-subtle text-success">Disponibile</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger">Non disponibile</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-outline-primary edit-item" data-id="<?= $item['id'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-primary toggle-availability" 
                                                data-id="<?= $item['id'] ?>" 
                                                data-available="<?= $item['is_available'] ?>">
                                            <?php if ($item['is_available']): ?>
                                                <i class="fas fa-eye"></i>
                                            <?php else: ?>
                                                <i class="fas fa-eye-slash"></i>
                                            <?php endif; ?>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger delete-item" 
                                                data-id="<?= $item['id'] ?>" 
                                                data-name="<?= $item['name'] ?>">
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

<!-- Modal Nuovo Prodotto -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Prodotto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addItemForm">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="itemName" class="form-label">Nome prodotto</label>
                            <input type="text" class="form-control" id="itemName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="itemCategory" class="form-label">Categoria</label>
                            <select class="form-select" id="itemCategory" required>
                                <option value="" selected disabled>Seleziona categoria</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="itemPrice" class="form-label">Prezzo</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" class="form-control" id="itemPrice" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="itemDescription" class="form-label">Descrizione</label>
                            <textarea class="form-control" id="itemDescription" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="itemImage" class="form-label">Immagine</label>
                            <input type="file" class="form-control" id="itemImage">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Disponibilità</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="itemAvailability" checked>
                                <label class="form-check-label" for="itemAvailability">
                                    Prodotto disponibile
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary">Salva prodotto</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Elimina Prodotto -->
<div class="modal fade" id="deleteItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Conferma eliminazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Sei sicuro di voler eliminare il prodotto <strong id="deleteItemName"></strong>?</p>
                <p class="text-danger">Questa azione non può essere annullata.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteItem">Elimina</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ricerca prodotti
        const itemSearch = document.getElementById('itemSearch');
        const menuItems = document.querySelectorAll('.menu-item');
        
        itemSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            menuItems.forEach(item => {
                const name = item.dataset.name;
                
                if (name.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
        
        // Filtro per categoria
        const categoryFilter = document.getElementById('categoryFilter');
        
        categoryFilter.addEventListener('change', function() {
            const selectedCategory = this.value;
            
            menuItems.forEach(item => {
                if (selectedCategory === 'all' || item.dataset.category === selectedCategory) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
        
        // Filtro per disponibilità
        const availabilityFilter = document.getElementById('availabilityFilter');
        
        availabilityFilter.addEventListener('change', function() {
            const selectedAvailability = this.value;
            
            menuItems.forEach(item => {
                if (selectedAvailability === 'all' || item.dataset.available === selectedAvailability) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
        
        // Gestione eliminazione prodotto
        const deleteButtons = document.querySelectorAll('.delete-item');
        const deleteItemModal = new bootstrap.Modal(document.getElementById('deleteItemModal'));
        const deleteItemNameEl = document.getElementById('deleteItemName');
        let itemIdToDelete = null;
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                itemIdToDelete = this.dataset.id;
                deleteItemNameEl.textContent = this.dataset.name;
                deleteItemModal.show();
            });
        });
        
        // Conferma eliminazione
        document.getElementById('confirmDeleteItem').addEventListener('click', function() {
            // In un'app reale, qui faremmo una richiesta AJAX per eliminare il prodotto
            
            // Simulare eliminazione
            const rowToDelete = document.querySelector(`.delete-item[data-id="${itemIdToDelete}"]`).closest('tr');
            rowToDelete.classList.add('animate__animated', 'animate__fadeOut');
            
            setTimeout(() => {
                rowToDelete.remove();
                deleteItemModal.hide();
                
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
                                Prodotto eliminato con successo!
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
        
        // Toggle disponibilità
        const toggleButtons = document.querySelectorAll('.toggle-availability');
        
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.dataset.id;
                const currentAvailability = this.dataset.available === '1';
                const newAvailability = !currentAvailability;
                
                // In un'app reale, qui faremmo una richiesta AJAX per aggiornare la disponibilità
                
                // Aggiornare l'interfaccia
                this.dataset.available = newAvailability ? '1' : '0';
                const parentRow = this.closest('tr');
                parentRow.dataset.available = newAvailability ? '1' : '0';
                
                // Aggiornare l'icona
                const icon = this.querySelector('i');
                if (newAvailability) {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
                
                // Aggiornare il badge
                const badge = parentRow.querySelector('.badge');
                if (newAvailability) {
                    badge.textContent = 'Disponibile';
                    badge.classList.remove('bg-danger-subtle', 'text-danger');
                    badge.classList.add('bg-success-subtle', 'text-success');
                } else {
                    badge.textContent = 'Non disponibile';
                    badge.classList.remove('bg-success-subtle', 'text-success');
                    badge.classList.add('bg-danger-subtle', 'text-danger');
                }
                
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
                                Disponibilità aggiornata con successo!
                            </div>
                        </div>
                    </div>
                `;
                
                document.body.insertAdjacentHTML('beforeend', toast);
                
                // Rimuovere il toast dopo 3 secondi
                setTimeout(() => {
                    document.querySelector('.toast').remove();
                }, 3000);
            });
        });
    });
</script>

<?php require_once 'views/layout/footer.php'; ?>er.php'; ?>