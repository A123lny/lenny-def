<?php
/**
 * Modal per la creazione di un nuovo rimborso
 * Questo file contiene il codice HTML per il modal di creazione rimborso
 */
?>
<!-- Modal per Nuovo Rimborso -->
<div class="modal fade" id="newRefundModal" tabindex="-1" aria-labelledby="newRefundModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="newRefundModalLabel"><i class="fas fa-exchange-alt me-2"></i>Nuovo Rimborso</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="newRefundForm" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="orderSearch" class="form-label">ID Ordine</label>
                        <div class="search-container">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" id="orderSearch" placeholder="Cerca ordine..." autocomplete="off" required>
                            </div>
                            <div class="autocomplete-results" id="orderResults"></div>
                            <div class="invalid-feedback">Seleziona un ordine</div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="refundReason" class="form-label">Motivazione</label>
                        <select class="form-select" id="refundReason" required>
                            <option value="">Seleziona...</option>
                            <option value="Consegna in ritardo">Consegna in ritardo</option>
                            <option value="Ordine errato">Ordine errato</option>
                            <option value="Prodotto danneggiato">Prodotto danneggiato</option>
                            <option value="Qualità del cibo">Qualità del cibo</option>
                            <option value="Ordine incompleto">Ordine incompleto</option>
                            <option value="Altro">Altro</option>
                        </select>
                        <div class="invalid-feedback">Seleziona una motivazione</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="refundAmount" class="form-label">Importo</label>
                        <div class="input-group">
                            <span class="input-group-text">€</span>
                            <input type="number" class="form-control" id="refundAmount" step="0.01" required>
                            <div class="invalid-feedback">Inserisci l'importo</div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="refundNotes" class="form-label">Note</label>
                        <textarea class="form-control" id="refundNotes" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="saveRefundBtn">
                    <i class="fas fa-save me-1"></i> Salva
                </button>
            </div>
        </div>
    </div>
</div>