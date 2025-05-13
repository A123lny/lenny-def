<?php
/**
 * Vista per le impostazioni del profilo utente
 */
require_once 'views/layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="my-4">Impostazioni Profilo</h1>

            <div class="card">
                <div class="card-body">
                    <form id="profileForm">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" value="<?php echo ADMIN_USER; ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="admin@lennyfood.com">
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>