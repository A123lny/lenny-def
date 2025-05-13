<?php
/**
 * Vista per le impostazioni di sistema
 */
require_once 'views/layout/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="my-4">Impostazioni di Sistema</h1>

            <div class="card">
                <div class="card-body">
                    <form id="systemSettingsForm">
                        <h5 class="mb-3">Impostazioni Generali</h5>

                        <div class="mb-3">
                            <label for="appName" class="form-label">Nome Applicazione</label>
                            <input type="text" class="form-control" id="appName" value="<?php echo APP_NAME; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="debugMode" class="form-label">Modalità Debug</label>
                            <select class="form-select" id="debugMode">
                                <option value="1" <?php echo DEBUG_MODE ? 'selected' : ''; ?>>Attivata</option>
                                <option value="0" <?php echo !DEBUG_MODE ? 'selected' : ''; ?>>Disattivata</option>
                            </select>
                        </div>

                        <h5 class="mt-4 mb-3">Impostazioni Database</h5>

                        <div class="mb-3">
                            <label for="dbHost" class="form-label">Host Database</label>
                            <input type="text" class="form-control" id="dbHost" value="<?php echo DB_HOST; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="dbName" class="form-label">Nome Database</label>
                            <input type="text" class="form-control" id="dbName" value="<?php echo DB_NAME; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="dbUser" class="form-label">Utente Database</label>
                            <input type="text" class="form-control" id="dbUser" value="<?php echo DB_USER; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="dbPass" class="form-label">Password Database</label>
                            <input type="password" class="form-control" id="dbPass" value="●●●●●●">
                        </div>

                        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                        <button type="button" class="btn btn-secondary ms-2">Testa Connessione</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>