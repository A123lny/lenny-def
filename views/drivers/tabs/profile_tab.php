<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-hover h-100 profile-card">
            <div class="profile-banner"></div>
            <div class="card-body text-center position-relative pt-5">
                <div class="profile-image-container mx-auto">
                    <div class="profile-image-wrapper">
                        <img id="driverPhoto" src="<?= asset('images/profilo.jpg') ?>" alt="Foto profilo" class="rounded-circle profile-image">
                    </div>
                </div>
                <h4 class="mt-4 mb-2" id="driverFullName">Marco Bianchi</h4>
                
                <div class="driver-rating-large mb-3 d-flex justify-content-center align-items-center">
                    <span class="rating-bubble me-2" id="driverRating">4.8</span>
                    <div class="rating-stars">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star-half-alt text-warning"></i>
                    </div>
                </div>
                
                <div class="mb-4">
                    <span class="status-badge status-active" id="driverStatusBadge">Attivo</span>
                </div>
                
                <div class="contact-buttons">
                    <a href="tel:3331122334" class="btn driver-btn-action driver-btn-primary-soft me-2" data-bs-toggle="tooltip" title="Chiama">
                        <i class="fas fa-phone-alt"></i>
                    </a>
                    <a href="mailto:marco.bianchi@example.com" class="btn driver-btn-action driver-btn-info-soft me-2" data-bs-toggle="tooltip" title="Email">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <a href="https://wa.me/393331122334" target="_blank" class="btn driver-btn-action driver-btn-success-soft" data-bs-toggle="tooltip" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 mb-4">
        <div class="card border-0 shadow-hover h-100">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center">
                    <span class="icon-circle bg-primary-light driver-text-primary me-2">
                        <i class="fas fa-info-circle"></i>
                    </span>
                    Informazioni Personali
                </h5>
                
                <div class="info-grid">
                    <div class="info-item">
                        <div class="detail-label">ID Driver</div>
                        <div class="detail-value" id="driverId">DR-1001</div>
                    </div>
                    <div class="info-item">
                        <div class="detail-label">Tipo Contratto</div>
                        <div class="detail-value" id="contractType">Indeterminato</div>
                    </div>
                    <div class="info-item">
                        <div class="detail-label">Email</div>
                        <div class="detail-value" id="driverEmail">marco.bianchi@example.com</div>
                    </div>
                    <div class="info-item">
                        <div class="detail-label">Telefono</div>
                        <div class="detail-value" id="driverPhone">3331122334</div>
                    </div>
                    <div class="info-item">
                        <div class="detail-label">Data di Nascita</div>
                        <div class="detail-value" id="driverBirthDate">15/05/1990</div>
                    </div>
                    <div class="info-item">
                        <div class="detail-label">Codice Fiscale</div>
                        <div class="detail-value" id="driverFiscalCode">BNCMRC90E15F205Z</div>
                    </div>
                    <div class="info-item">
                        <div class="detail-label">Indirizzo</div>
                        <div class="detail-value" id="driverAddress">Via Roma 123, Milano</div>
                    </div>
                    <div class="info-item">
                        <div class="detail-label">Data Assunzione</div>
                        <div class="detail-value" id="driverHireDate">01/03/2022</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center">
                    <span class="icon-circle bg-info-light driver-text-info me-2">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    Documenti
                </h5>
                <div class="table-responsive custom-table-container">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Numero</th>
                                <th>Scadenza</th>
                                <th>Stato</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="icon-circle bg-primary-soft driver-text-primary me-2">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                        <span>Patente</span>
                                    </div>
                                </td>
                                <td>AB1234567</td>
                                <td>15/05/2028</td>
                                <td><span class="badge-pill bg-success-light text-success">Valido</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Visualizza">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Scarica">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="icon-circle bg-info-soft driver-text-info me-2">
                                            <i class="fas fa-passport"></i>
                                        </span>
                                        <span>Carta d'Identità</span>
                                    </div>
                                </td>
                                <td>CA12345BB</td>
                                <td>10/10/2030</td>
                                <td><span class="badge-pill bg-success-light text-success">Valido</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Visualizza">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Scarica">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="icon-circle bg-warning-soft driver-text-warning me-2">
                                            <i class="fas fa-shield-alt"></i>
                                        </span>
                                        <span>Assicurazione</span>
                                    </div>
                                </td>
                                <td>POL-2023-456789</td>
                                <td>01/01/2024</td>
                                <td><span class="badge-pill bg-warning-light text-warning">In Scadenza</span></td>
                                <td>
                                    <div class="driver-action-buttons">
                                        <a href="#" class="action-btn view-btn" data-bs-toggle="tooltip" title="Visualizza">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="action-btn download-btn" data-bs-toggle="tooltip" title="Scarica">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-0 shadow-hover">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center">
                    <span class="icon-circle bg-warning-light driver-text-warning me-2">
                        <i class="fas fa-comment-alt"></i>
                    </span>
                    Note
                </h5>
                <div class="notes-container p-3 bg-light rounded">
                    <p id="driverNotes" class="mb-0">Driver affidabile e puntuale. Preferisce turni mattutini e serali. Ha una buona conoscenza della città e un ottimo rapporto con i clienti.</p>
                </div>
            </div>
        </div>
    </div>
</div>