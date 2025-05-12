<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center">
                    <span class="icon-circle bg-primary-light driver-text-primary me-2">
                        <i class="fas fa-university"></i>
                    </span>
                    Dati Bancari
                </h5>
                <form class="mt-4">
                    <div class="mb-3">
                        <label for="bankName" class="form-label">Banca</label>
                        <input type="text" class="form-control" id="bankName" value="Banca Intesa San Paolo" placeholder="Nome banca">
                    </div>
                    <div class="mb-3">
                        <label for="accountHolder" class="form-label">Intestatario</label>
                        <input type="text" class="form-control" id="accountHolder" value="Marco Bianchi" placeholder="Nome intestatario">
                    </div>
                    <div class="mb-3">
                        <label for="iban" class="form-label">IBAN</label>
                        <input type="text" class="form-control" id="iban" value="IT60X0542811101000000123456" placeholder="IBAN">
                    </div>
                    <div class="mb-3">
                        <label for="swift" class="form-label">SWIFT/BIC</label>
                        <input type="text" class="form-control" id="swift" value="BCITITMM" placeholder="SWIFT/BIC">
                    </div>
                    <button type="submit" class="btn btn-primary driver-modal-button">
                        <i class="fas fa-save me-1"></i> Salva Modifiche
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center">
                    <span class="icon-circle bg-info-light driver-text-info me-2">
                        <i class="fas fa-cog"></i>
                    </span>
                    Preferenze Pagamento
                </h5>
                <form class="mt-4">
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Metodo di Pagamento</label>
                        <select class="form-select" id="paymentMethod">
                            <option value="bank_transfer" selected>Bonifico Bancario</option>
                            <option value="paypal">PayPal</option>
                            <option value="cash">Contanti</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="paymentFrequency" class="form-label">Frequenza di Pagamento</label>
                        <select class="form-select" id="paymentFrequency">
                            <option value="monthly" selected>Mensile</option>
                            <option value="biweekly">Bisettimanale</option>
                            <option value="weekly">Settimanale</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="paymentDay" class="form-label">Giorno di Pagamento</label>
                        <select class="form-select" id="paymentDay">
                            <option value="1" selected>1 del mese</option>
                            <option value="5">5 del mese</option>
                            <option value="10">10 del mese</option>
                            <option value="15">15 del mese</option>
                            <option value="last">Ultimo giorno del mese</option>
                        </select>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="instantPaySwitch" checked>
                        <label class="form-check-label" for="instantPaySwitch">Abilita pagamenti istantanei</label>
                        <small class="form-text text-muted d-block">Consenti al driver di richiedere pagamenti anticipati per le consegne completate</small>
                    </div>
                    <button type="submit" class="btn btn-primary driver-modal-button">
                        <i class="fas fa-save me-1"></i> Salva Preferenze
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center">
                    <span class="icon-circle bg-accent-2-light driver-text-accent-2 me-2">
                        <i class="fas fa-file-invoice"></i>
                    </span>
                    Impostazioni Fatturazione
                    <div class="form-check form-switch ms-auto">
                        <input class="form-check-input" type="checkbox" id="enableInvoicingSwitch" checked>
                        <label class="form-check-label" for="enableInvoicingSwitch">Abilita fatturazione</label>
                    </div>
                </h5>
                <form class="mt-4" id="invoicingForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="taxId" class="form-label">Codice Fiscale</label>
                                <input type="text" class="form-control" id="taxId" value="BNCMRC90E15F205Z" placeholder="Codice Fiscale">
                            </div>
                            <div class="mb-3">
                                <label for="vatNumber" class="form-label">Partita IVA</label>
                                <input type="text" class="form-control" id="vatNumber" value="" placeholder="Partita IVA (se disponibile)">
                            </div>
                            <div class="mb-3">
                                <label for="taxRegime" class="form-label">Regime Fiscale</label>
                                <select class="form-select" id="taxRegime">
                                    <option value="employee" selected>Dipendente</option>
                                    <option value="forfeit">Forfettario</option>
                                    <option value="ordinary">Ordinario</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="billingAddress" class="form-label">Indirizzo Fatturazione</label>
                                <textarea class="form-control" id="billingAddress" rows="3">Via Roma 123, 20100 Milano (MI)</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="sdiCode" class="form-label">Codice SDI/PEC</label>
                                <input type="text" class="form-control" id="sdiCode" value="0000000" placeholder="Codice SDI o PEC">
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input invoicing-control" type="checkbox" id="autoInvoiceSwitch" checked>
                                <label class="form-check-label" for="autoInvoiceSwitch">Generazione automatica fattura</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary driver-modal-button" id="saveInvoicingBtn">
                        <i class="fas fa-save me-1"></i> Salva Impostazioni
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Stile per il tab Impostazioni Pagamenti */
#payment-settings .bg-accent-2-light {
    background-color: rgba(255, 170, 0, 0.1);
}

#payment-settings .driver-text-accent-2 {
    color: #FFAA00 !important;
}

#payment-settings .form-control:focus, 
#payment-settings .form-select:focus {
    border-color: rgba(255, 90, 95, 0.25);
    box-shadow: 0 0 0 0.25rem rgba(255, 90, 95, 0.25);
}

#payment-settings .form-check-input:checked {
    background-color: #ff5a5f;
    border-color: #ff5a5f;
}

#payment-settings .form-check-input:focus {
    box-shadow: 0 0 0 0.25rem rgba(255, 90, 95, 0.25);
}

/* Stile per la sezione di fatturazione disabilitata */
.invoicing-disabled {
    opacity: 0.6;
    pointer-events: none;
    user-select: none;
}

.invoicing-disabled:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.5);
    z-index: 10;
}
</style>

<script>
// Script per gestire l'abilitazione/disabilitazione della sezione fatturazione
document.addEventListener('DOMContentLoaded', function() {
    const invoicingSwitch = document.getElementById('enableInvoicingSwitch');
    const invoicingForm = document.getElementById('invoicingForm');
    const saveInvoicingBtn = document.getElementById('saveInvoicingBtn');
    
    // Funzione per toggle della sezione fatturazione
    function toggleInvoicingSection() {
        if (invoicingSwitch.checked) {
            invoicingForm.classList.remove('invoicing-disabled');
            const inputs = invoicingForm.querySelectorAll('input, select, textarea');
            inputs.forEach(input => input.removeAttribute('disabled'));
            saveInvoicingBtn.removeAttribute('disabled');
        } else {
            invoicingForm.classList.add('invoicing-disabled');
            const inputs = invoicingForm.querySelectorAll('input, select, textarea');
            inputs.forEach(input => input.setAttribute('disabled', 'disabled'));
            saveInvoicingBtn.setAttribute('disabled', 'disabled');
        }
    }
    
    // Imposta lo stato iniziale
    toggleInvoicingSection();
    
    // Aggiungi l'event listener per il cambiamento dello switch
    invoicingSwitch.addEventListener('change', toggleInvoicingSection);
});
</script>