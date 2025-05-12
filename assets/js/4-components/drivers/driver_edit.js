/**
 * Script per la gestione del modale di modifica driver
 */

document.addEventListener('DOMContentLoaded', function() {
    setupEditModal();
});

/**
 * Configura gli event listener per il modale di modifica
 */
function setupEditModal() {
    // Gestione dei pulsanti di modifica
    const editButtons = document.querySelectorAll('.edit-driver-btn');
    editButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const driverId = this.dataset.driverId;
            
            try {
                // Otteniamo i dati della riga corrispondente
                const driverRow = btn.closest('tr');
                const driverName = driverRow.querySelector('td:first-child strong').textContent;
                
                // Popoliamo i dati nel modale di modifica
                updateEditModalData(driverName);
                
                // Mostriamo il modale di modifica
                showModal('editDriverModal');
                console.log('Modale di modifica aperto per il driver ID:', driverId);
            } catch (error) {
                console.error('Si è verificato un errore durante l\'apertura del modale di modifica:', error);
                alert('Si è verificato un errore durante l\'apertura del modale di modifica. Controlla la console per dettagli.');
            }
        });
    });
    
    // Gestione del pulsante "Salva Modifiche" nel modale di modifica
    const saveDriverChangesBtn = document.getElementById('saveDriverChanges');
    if (saveDriverChangesBtn) {
        saveDriverChangesBtn.addEventListener('click', function() {
            alert('Driver modificato con successo!');
            hideModal('editDriverModal');
        });
    }
}

/**
 * Aggiorna i dati nel modale di modifica
 */
function updateEditModalData(driverName) {
    const editModalDriverName = document.getElementById('editModalDriverName');
    if (editModalDriverName) editModalDriverName.textContent = driverName;
    
    const editDriverNameInput = document.getElementById('editDriverName');
    if (editDriverNameInput) editDriverNameInput.value = driverName;
}

/**
 * Mostra un modale tramite bootstrap
 */
function showModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
    }
}

/**
 * Nasconde un modale tramite bootstrap
 */
function hideModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        const bootstrapModal = bootstrap.Modal.getInstance(modal);
        if (bootstrapModal) {
            bootstrapModal.hide();
        }
    }
}
