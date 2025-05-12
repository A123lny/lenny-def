/**
 * Script per la gestione del modal wizard per la creazione di un nuovo driver
 */

const DriverNewWizard = (function() {
    'use strict';
    
    // Variabili private
    let currentStep = 1;
    let formValidator = null;
    
    /**
     * Inizializza il modulo
     */
    function init() {
        setupWizardSteps();
        setupFormValidation();
        setupEventListeners();
    }
    
    /**
     * Configura i passi del wizard
     */
    function setupWizardSteps() {
        // Nasconde tutti i passi tranne il primo
        document.querySelectorAll('.wizard-step').forEach(step => {
            if (!step.classList.contains('active')) {
                step.style.display = 'none';
            }
        });
    }
    
    /**
     * Configura la validazione del form
     */
    function setupFormValidation() {
        // Ottiene il form
        const form = document.querySelector('#newDriverForm');
        
        // Disabilita la validazione predefinita del browser
        form.setAttribute('novalidate', '');
        
        // Aggiunge l'evento submit
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            if (validateForm()) {
                saveDriver();
            }
        });
    }
    
    /**
     * Configura gli event listener per i pulsanti del wizard
     */
    function setupEventListeners() {
        // Pulsanti "Avanti"
        document.querySelectorAll('.wizard-next-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const nextStep = parseInt(this.dataset.nextStep);
                
                // Valida lo step corrente prima di procedere
                if (validateStep(currentStep)) {
                    goToStep(nextStep);
                    
                    // Se siamo all'ultimo step, aggiorna il riepilogo
                    if (nextStep === 5) {
                        updateSummary();
                    }
                }
            });
        });
        
        // Pulsanti "Indietro"
        document.querySelectorAll('.wizard-prev-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const prevStep = parseInt(this.dataset.prevStep);
                goToStep(prevStep);
            });
        });
        
        // Gestione evento change sul tipo di pagamento
        const paymentMethodSelect = document.querySelector('#paymentMethod');
        if (paymentMethodSelect) {
            paymentMethodSelect.addEventListener('change', function() {
                const bankDetailsSection = document.querySelector('#bankDetails');
                
                if (this.value === 'Bonifico') {
                    bankDetailsSection.style.display = 'block';
                } else {
                    bankDetailsSection.style.display = 'none';
                }
            });
        }
        
        // Gestione evento change sul tipo di veicolo
        const vehicleTypeSelect = document.querySelector('#vehicleType');
        if (vehicleTypeSelect) {
            vehicleTypeSelect.addEventListener('change', function() {
                const vehicleDetailsSection = document.querySelector('#vehicleDetailsSection');
                
                if (this.value) {
                    vehicleDetailsSection.style.display = 'block';
                } else {
                    vehicleDetailsSection.style.display = 'none';
                }
            });
        }
    }
    
    /**
     * Gestisce il passaggio tra i vari step del wizard
     * @param {number} step - Il numero del passo da visualizzare
     */
    function goToStep(step) {
        // Nasconde lo step corrente
        const currentStepElement = document.querySelector(`.wizard-step[id="step${currentStep}"]`);
        if (currentStepElement) {
            currentStepElement.style.display = 'none';
            currentStepElement.classList.remove('active');
        }
        
        // Mostra il nuovo step
        const newStepElement = document.querySelector(`.wizard-step[id="step${step}"]`);
        if (newStepElement) {
            newStepElement.style.display = 'block';
            newStepElement.classList.add('active');
        }
        
        // Aggiorna gli indicatori di progresso
        updateProgressSteps(step);
        
        // Aggiorna lo step corrente
        currentStep = step;
    }
    
    /**
     * Aggiorna gli indicatori di progresso
     * @param {number} step - Il numero del passo attivo
     */
    function updateProgressSteps(step) {
        document.querySelectorAll('.progress-step').forEach((element, index) => {
            const stepNumber = index + 1;
            
            if (stepNumber < step) {
                element.classList.add('completed');
                element.classList.remove('active');
            } else if (stepNumber === step) {
                element.classList.add('active');
                element.classList.remove('completed');
            } else {
                element.classList.remove('active', 'completed');
            }
        });
    }
    
    /**
     * Valida il form completo
     * @returns {boolean} - True se il form è valido, false altrimenti
     */
    function validateForm() {
        const form = document.querySelector('#newDriverForm');
        
        if (form.checkValidity() === false) {
            form.classList.add('was-validated');
            return false;
        }
        
        form.classList.add('was-validated');
        return true;
    }
    
    /**
     * Valida uno step specifico
     * @param {number} step - Il numero dello step da validare
     * @returns {boolean} - True se lo step è valido, false altrimenti
     */
    function validateStep(step) {
        const stepElement = document.querySelector(`#step${step}`);
        if (!stepElement) return true;
        
        const inputs = stepElement.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;
        
        inputs.forEach(input => {
            if (!input.checkValidity()) {
                input.reportValidity();
                isValid = false;
            }
        });
        
        return isValid;
    }
    
    /**
     * Aggiorna il riepilogo prima della creazione
     */
    function updateSummary() {
        // Dati anagrafici
        document.getElementById('summaryName').textContent = document.getElementById('driverName').value || '-';
        document.getElementById('summaryEmail').textContent = document.getElementById('driverEmail').value || '-';
        document.getElementById('summaryPhone').textContent = document.getElementById('driverPhone').value || '-';
        document.getElementById('summaryFiscalCode').textContent = document.getElementById('driverFiscalCode').value || '-';
        
        // Composizione indirizzo completo
        const address = document.getElementById('driverAddress').value || '';
        const city = document.getElementById('driverCity').value || '';
        const province = document.getElementById('driverProvince').value || '';
        const zip = document.getElementById('driverZip').value || '';
        const fullAddress = [address, city, province, zip].filter(Boolean).join(', ');
        document.getElementById('summaryAddress').textContent = fullAddress || '-';
        
        // Stato
        const statusSelect = document.getElementById('driverStatus');
        document.getElementById('summaryStatus').textContent = statusSelect.options[statusSelect.selectedIndex].text || '-';
        
        // Documenti
        document.getElementById('summaryLicense').textContent = document.getElementById('driverLicense').value || '-';
        document.getElementById('summaryLicenseExpiry').textContent = formatDate(document.getElementById('driverLicenseExpiry').value) || '-';
        
        // Pagamenti
        const contractTypeSelect = document.getElementById('contractType');
        document.getElementById('summaryContractType').textContent = contractTypeSelect.options[contractTypeSelect.selectedIndex].text || '-';
        
        const paymentMethodSelect = document.getElementById('paymentMethod');
        document.getElementById('summaryPaymentMethod').textContent = paymentMethodSelect.options[paymentMethodSelect.selectedIndex].text || '-';
        
        document.getElementById('summaryBaseRate').textContent = document.getElementById('baseRate').value || '0.00';
        document.getElementById('summaryDeliveryRate').textContent = document.getElementById('deliveryRate').value || '0.00';
        
        // Veicolo
        const vehicleTypeSelect = document.getElementById('vehicleType');
        document.getElementById('summaryVehicleType').textContent = vehicleTypeSelect.value ? vehicleTypeSelect.options[vehicleTypeSelect.selectedIndex].text : '-';
        
        const brand = document.getElementById('vehicleBrand').value || '';
        const model = document.getElementById('vehicleModel').value || '';
        document.getElementById('summaryVehicleModel').textContent = brand && model ? `${brand} ${model}` : '-';
        
        document.getElementById('summaryVehiclePlate').textContent = document.getElementById('vehiclePlate').value || '-';
        
        const vehicleOwnershipSelect = document.getElementById('vehicleOwnership');
        document.getElementById('summaryVehicleOwnership').textContent = vehicleOwnershipSelect.options[vehicleOwnershipSelect.selectedIndex].text || '-';
    }
    
    /**
     * Formatta una data in formato leggibile
     * @param {string} dateString - La data in formato yyyy-mm-dd
     * @returns {string} - La data formattata
     */
    function formatDate(dateString) {
        if (!dateString) return '';
        
        const date = new Date(dateString);
        if (isNaN(date.getTime())) return dateString;
        
        return date.toLocaleDateString('it-IT', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
    }
    
    /**
     * Salva i dati del nuovo driver
     */
    function saveDriver() {
        // Qui si inserirà la logica per salvare i dati del driver
        // Per ora simuliamo solo una risposta positiva
        
        // Nascondi il modale
        const modal = bootstrap.Modal.getInstance(document.getElementById('newDriverModal'));
        if (modal) {
            modal.hide();
        }
        
        // Mostra un messaggio di successo
        showToast('Nuovo driver creato con successo!', 'success');
        
        // Ricarica la pagina o aggiorna la tabella dei driver
        setTimeout(() => {
            window.location.reload();
        }, 1500);
    }
    
    /**
     * Mostra un toast di notifica
     * @param {string} message - Il messaggio da mostrare
     * @param {string} type - Il tipo di toast (success, error, warning, info)
     */
    function showToast(message, type = 'info') {
        // Verifica se esiste una funzione globale per i toast
        if (typeof window.showToast === 'function') {
            window.showToast('Successo', message, type);
        } else {
            // Fallback: alert standard
            alert(message);
        }
    }
    
    /**
     * Mostra il modale
     */
    function showModal() {
        const modalElement = document.getElementById('newDriverModal');
        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        } else {
            console.error('Modal non trovato nel DOM');
        }
    }
    
    /**
     * Reset del form e del wizard
     */
    function resetWizard() {
        // Reset del form
        document.getElementById('newDriverForm').reset();
        document.getElementById('newDriverForm').classList.remove('was-validated');
        
        // Torna al primo step
        goToStep(1);
    }
    
    // API pubblica del modulo
    return {
        init,
        showModal,
        resetWizard
    };
})();

// Inizializza il modulo quando il DOM è pronto
document.addEventListener('DOMContentLoaded', function() {
    DriverNewWizard.init();
    
    // Aggiungi event listener al pulsante "Nuovo Driver" se presente
    const newDriverBtn = document.getElementById('newDriverBtn');
    if (newDriverBtn) {
        newDriverBtn.addEventListener('click', function() {
            DriverNewWizard.showModal();
        });
    }
});