
<?php
/**
 * Vista per il profilo utente
 */
require_once 'views/layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profilo Utente</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img id="profileAvatar" src="<?php echo asset('images/profilo.jpg'); ?>" alt="Immagine Profilo" class="img-fluid rounded-circle mb-3" style="max-width: 200px; width: 200px; height: 200px; object-fit: cover;">
                                <div class="position-absolute bottom-0 end-0 mb-3 me-3">
                                    <button type="button" class="btn btn-sm btn-primary rounded-circle" id="changeAvatarBtn" title="Cambia avatar">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="file" id="avatarUpload" class="d-none" accept="image/jpeg, image/png, image/gif">
                            <div class="mt-2 mb-3">
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="resetAvatarBtn">
                                    <i class="fas fa-undo me-1"></i>Ripristina avatar predefinito
                                </button>
                            </div>
                            <h5><?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Utente'; ?></h5>
                            <p class="text-muted"><?php echo isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'Ruolo non definito'; ?></p>
                        </div>
                        <div class="col-md-8">
                            <form id="profileForm">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nome Utente</label>
                                    <input type="text" class="form-control" id="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" id="fullname" value="<?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="currentPassword" class="form-label">Password Attuale</label>
                                    <input type="password" class="form-control" id="currentPassword">
                                </div>
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">Nuova Password</label>
                                    <input type="password" class="form-control" id="newPassword">
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Conferma Password</label>
                                    <input type="password" class="form-control" id="confirmPassword">
                                </div>
                                <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                            </form>
                            
                            <hr class="my-4">
                            
                            <!-- Sezione Elimina Profilo -->
                            <div class="mt-4">
                                <h5 class="text-danger">Elimina Profilo</h5>
                                <p class="text-muted">L'eliminazione del profilo è un'operazione irreversibile. Tutti i tuoi dati personali verranno rimossi dal sistema.</p>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteProfileModal">
                                    <i class="fas fa-user-times me-2"></i>Elimina il mio profilo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Conferma Eliminazione Profilo -->
<div class="modal fade" id="deleteProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Conferma Eliminazione Profilo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Attenzione:</strong> Questa operazione non può essere annullata.
                </div>
                <p>Sei sicuro di voler eliminare permanentemente il tuo profilo? Questa azione comporterà:</p>
                <ul>
                    <li>Eliminazione di tutti i tuoi dati personali</li>
                    <li>Perdita di accesso a tutti i servizi associati</li>
                    <li>Rimozione di tutte le tue impostazioni e preferenze</li>
                </ul>
                <div class="mb-3">
                    <label for="deleteConfirmPassword" class="form-label">Inserisci la tua password per confermare:</label>
                    <input type="password" class="form-control" id="deleteConfirmPassword" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteProfile">Elimina definitivamente</button>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
