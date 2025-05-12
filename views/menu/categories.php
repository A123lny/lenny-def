<?php require_once 'views/layout/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Categorie Menu</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus me-1"></i> Nuova categoria
        </button>
    </div>
</div>

<!-- Ricerca categorie -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="input-group">
            <span class="input-group-text bg-white">
                <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text" class="form-control" id="categorySearch" placeholder="Cerca categoria...">
        </div>
    </div>
</div>

<!-- Lista categorie -->
<div class="row g-4" id="categories-container">
    <?php foreach ($categories as $category): ?>
        <div class="col-md-6 col-xl-4 category-item animate__animated animate__fadeIn" data-name="<?= strtolower($category['name']) ?>">
            <div class="card h-100 border-0 shadow-sm">
                <div class="position-relative">
                    <div class="category-img">
                        <img src="assets/images/menu/<?= $category['image'] ?>" class="card-img-top" alt="<?= $category['name'] ?>">
                    </div>
                    <span class="badge bg-primary position-absolute top-0 end-0 mt-2 me-2">
                        <?= $category['items_count'] ?> prodotti
                    </span>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $category['name'] ?></h5>
                    <p class="card-text text-muted">
                        <?= $category['description'] ?>
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                    <a href="index.php?controller=menu&action=items&category=<?= $category['id'] ?>" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye me-1"></i> Visualizza prodotti
                    </a>
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-outline-primary edit-category" data-id="<?= $category['id'] ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger delete-category" data-id="<?= $category['id'] ?>" data-name="<?= $category['name'] ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal Nuova Categoria -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCategoryForm">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Nome categoria</label>
                        <input type="text" class="form-control" id="categoryName" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoryDescription" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="categoryDescription" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="categoryImage" class="form-label">Immagine</label>
                        <input type="file" class="form-control" id="categoryImage">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary">Salva categoria</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Elimina Categoria -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Conferma eliminazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Sei sicuro di voler eliminare la categoria <strong id="deleteCategoryName"></strong>?</p>
                <p class="text-danger">Questa azione non può essere annullata e tutti i prodotti associati verranno rimossi dalla categoria.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteCategory">Elimina</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ricerca categorie
        const categorySearch = document.getElementById('categorySearch');
        const categoryItems = document.querySelectorAll('.category-item');
        
        categorySearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            categoryItems.forEach(item => {
                const name = item.dataset.name;
                
                if (name.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
        
        // Gestione eliminazione categoria
        const deleteButtons = document.querySelectorAll('.delete-category');
        const deleteCategoryModal = new bootstrap.Modal(document.getElementById('deleteCategoryModal'));
        const deleteCategoryNameEl = document.getElementById('deleteCategoryName');
        let categoryIdToDelete = null;
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                categoryIdToDelete = this.dataset.id;
                deleteCategoryNameEl.textContent = this.dataset.name;
                deleteCategoryModal.show();
            });
        });
        
        // Conferma eliminazione
        document.getElementById('confirmDeleteCategory').addEventListener('click', function() {
            // In un'app reale, qui faremmo una richiesta AJAX per eliminare la categoria
            console.log('Eliminazione categoria ID:', categoryIdToDelete);
            
            // Simulare eliminazione
            document.querySelector(`.category-item[data-id="${categoryIdToDelete}"]`).remove();
            
            deleteCategoryModal.hide();
            
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
                            Categoria eliminata con successo!
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
</script>

<?php require_once 'views/layout/footer.php'; ?>
