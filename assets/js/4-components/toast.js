/**
 * Toast Notification Component
 * Gestisce la visualizzazione di notifiche toast nell'interfaccia utente
 * @module ToastComponent
 */

const ToastComponent = (function() {
    /**
     * Mostra un toast con messaggio
     * @param {string} title - Titolo del toast
     * @param {string} message - Messaggio del toast
     * @param {string} type - Tipo di toast (primary, success, warning, danger, info)
     */
    function showToast(title, message, type = 'primary') {
        // Rimuovi eventuali toast esistenti
        const existingToasts = document.querySelectorAll('.toast-container');
        existingToasts.forEach(toast => toast.remove());
        
        // Crea nuovo toast
        const toastHTML = `
            <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
                <div class="toast-box toast-animate-in">
                    <div class="toast-icon bg-${type}">
                        <i class="fas fa-${getToastIcon(type)}"></i>
                    </div>
                    <div class="toast-content">
                        <div class="toast-header">
                            <strong>${title}</strong>
                            <button type="button" class="btn-close-toast" onclick="this.closest('.toast-container').remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="toast-body">
                            ${message}
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Aggiungi al DOM
        document.body.insertAdjacentHTML('beforeend', toastHTML);
        
        // Rimuovi automaticamente dopo un po'
        setTimeout(() => {
            const toastContainer = document.querySelector('.toast-container');
            if (toastContainer) {
                const toastBox = toastContainer.querySelector('.toast-box');
                toastBox.classList.replace('toast-animate-in', 'toast-animate-out');
                
                setTimeout(() => {
                    toastContainer.remove();
                }, 500);
            }
        }, 5000);
    }

    /**
     * Ottieni l'icona appropriata per un toast
     * @private
     * @param {string} type - Tipo di toast
     * @return {string} Nome dell'icona Font Awesome
     */
    function getToastIcon(type) {
        switch (type) {
            case 'success': return 'check-circle';
            case 'danger': return 'exclamation-circle';
            case 'warning': return 'exclamation-triangle';
            case 'info': return 'info-circle';
            default: return 'bell';
        }
    }

    // API pubblica
    return {
        show: showToast
    };
})();

// Esposizione globale per mantenere la compatibilità con il codice esistente
window.showToast = ToastComponent.show;