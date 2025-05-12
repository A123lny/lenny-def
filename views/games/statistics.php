<?php
// Include header
include("views/layout/header.php");
?>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">Statistiche Giochi</h1>
            <p class="page-subtitle">Analisi delle performance dei giochi</p>
        </div>
    </div>
</div>

<!-- Grafico principale -->
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between align-items-center mb-3">
                    <h5>Andamento Mensile</h5>
                </div>
                <div class="chart-container" style="position: relative; height:350px;">
                    <canvas id="monthlyStatsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dati per il grafico
    const months = <?= json_encode(array_keys($monthlyStats)) ?>;
    const plays = <?= json_encode(array_column($monthlyStats, 'plays')) ?>;
    const wins = <?= json_encode(array_column($monthlyStats, 'wins')) ?>;
    
    // Grafico Andamento Mensile
    const ctx = document.getElementById('monthlyStatsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Giocate',
                    data: plays,
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                },
                {
                    label: 'Vincite',
                    data: wins,
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>

<?php
// Include footer
include("views/layout/footer.php");
?>