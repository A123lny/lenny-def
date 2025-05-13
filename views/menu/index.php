<?php require_once 'views/layout/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Menu</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-download me-1"></i> Esporta
            </button>
            <button type="button" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-print me-1"></i> Stampa
            </button>
        </div>
        <div class="dropdown">
            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-plus me-1"></i> Aggiungi
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#"><i class="fas fa-tag me-2"></i> Nuova categoria</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-utensils me-2"></i> Nuovo prodotto</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Statistiche del menu -->
<div class="row g-4 mb-4 animate__animated animate__fadeIn">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="fas fa-utensils fa-2x text-primary"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Prodotti totali</h6>
                        <h3 class="mb-0"><?= count($menuItems) ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="fas fa-tags fa-2x text-success"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Categorie</h6>
                        <h3 class="mb-0"><?= count($categories) ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="fas fa-euro-sign fa-2x text-info"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Prezzo medio</h6>
                        <?php
                        $totalPrice = 0;
                        foreach ($menuItems as $item) {
                            $totalPrice += $item['price'];
                        }
                        $avgPrice = count($menuItems) > 0 ? $totalPrice / count($menuItems) : 0;
                        ?>
                        <h3 class="mb-0"><?= number_format($avgPrice, 2, ',', '.') ?>€</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ricerca e filtri -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="input-group">
            <span class="input-group-text bg-white">
                <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text" class="form-control" id="menuSearch" placeholder="Cerca nel menu...">
        </div>
    </div>
    <div class="col-md-4">
        <select class="form-select" id="categoryFilter">
            <option value="all">Tutte le categorie</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2">
        <select class="form-select" id="sortMenu">
            <option value="name-asc">Nome A-Z</option>
            <option value="name-desc">Nome Z-A</option>
            <option value="price-asc">Prezzo crescente</option>
            <option value="price-desc">Prezzo decrescente</option>
        </select>
    </div>
</div>

<!-- Menu diviso per categorie -->
<div class="menu-container">
    <?php foreach ($categories as $category): ?>
        <div class="category-section mb-5 animate__animated animate__fadeIn" data-category-id="<?= $category['id'] ?>">
            <div class="d-flex align-items-center mb-3">
                <h4 class="mb-0"><?= $category['name'] ?></h4>
                <span class="badge bg-primary ms-2"><?= $category['items_count'] ?></span>
                <a href="#" class="btn btn-sm btn-light ms-auto">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
            
            <div class="row g-4 mb-2">
                <?php 
                $categoryItems = array_filter($menuItems, function($item) use ($category) {
                    return $item['category_id'] == $category['id'];
                });
                
                foreach ($categoryItems as $item): 
                ?>
                    <div class="col-md-6 col-lg-4 col-xl-3 menu-item" data-name="<?= strtolower($item['name']) ?>" data-price="<?= $item['price'] ?>">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="position-relative">
                                <div class="menu-item-img">
                                    <img src="assets/images/menu/<?= $item['image'] ?>" class="card-img-top" alt="<?= $item['name'] ?>">
                                </div>
                                <?php if ($item['is_available']): ?>
                                    <span class="badge bg-success position-absolute top-0 end-0 mt-2 me-2">Disponibile</span>
                                <?php else: ?>
                                    <span class="badge bg-danger position-absolute top-0 end-0 mt-2 me-2">Non disponibile</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="card-title mb-0"><?= $item['name'] ?></h6>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        <?= number_format($item['price'], 2, ',', '.') ?>€
                                    </span>
                                </div>
                                <p class="card-text small text-muted mt-2">
                                    <?= $item['description'] ?>
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-0 d-flex justify-content-end">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <?php if (count($categoryItems) === 0): ?>
                    <div class="col-12">
                        <div class="alert alert-light">
                            <i class="fas fa-info-circle me-2"></i>
                            Nessun prodotto in questa categoria.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ricerca nel menu
        const menuSearch = document.getElementById('menuSearch');
        const menuItems = document.querySelectorAll('.menu-item');
        const categorySections = document.querySelectorAll('.category-section');
        
        menuSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            menuItems.forEach(item => {
                const name = item.dataset.name;
                
                if (name.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Mostrare/nascondere le sezioni delle categorie
            categorySections.forEach(section => {
                const visibleItems = section.querySelectorAll('.menu-item[style="display: block"]');
                if (visibleItems.length === 0 && searchTerm !== '') {
                    section.style.display = 'none';
                } else {
                    section.style.display = 'block';
                }
            });
        });
        
        // Filtro per categoria
        const categoryFilter = document.getElementById('categoryFilter');
        
        categoryFilter.addEventListener('change', function() {
            const selectedCategory = this.value;
            
            if (selectedCategory === 'all') {
                categorySections.forEach(section => {
                    section.style.display = 'block';
                });
            } else {
                categorySections.forEach(section => {
                    if (section.dataset.categoryId === selectedCategory) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
            }
        });
        
        // Ordinamento
        const sortMenu = document.getElementById('sortMenu');
        
        sortMenu.addEventListener('change', function() {
            const sortValue = this.value;
            const [field, direction] = sortValue.split('-');
            
            categorySections.forEach(section => {
                const items = Array.from(section.querySelectorAll('.menu-item'));
                
                items.sort((a, b) => {
                    let valueA, valueB;
                    
                    if (field === 'name') {
                        valueA = a.dataset.name;
                        valueB = b.dataset.name;
                    } else if (field === 'price') {
                        valueA = parseFloat(a.dataset.price);
                        valueB = parseFloat(b.dataset.price);
                    }
                    
                    if (direction === 'asc') {
                        return valueA > valueB ? 1 : -1;
                    } else {
                        return valueA < valueB ? 1 : -1;
                    }
                });
                
                const itemsContainer = section.querySelector('.row');
                
                // Rimuovere e riaggiungere gli elementi in ordine
                items.forEach(item => {
                    itemsContainer.appendChild(item);
                });
            });
        });
    });
</script>

<?php require_once 'views/layout/footer.php'; ?>; ?>
