@extends('layouts.user')

@section('content1')
<div class="content content-documentation mt-20">
    <div class="container-fluid mt-4">
        <div class="card card-documentation">
            <div class="card-header">
                <h4>Зарлагын төрлийн мэдээлэл</h4>
                <p>Та энд зарлагын төрлийн мэдээллүүдийг харах боломжтой.</p>
            </div>
            <div class="card-body">

                <div class="row">
                    <!-- Pie Chart -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Зарлагын төрөл (Хувь)</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Bar Chart -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Зарлагын төрөл (Мөнгө)</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="barChart" style="width: 100%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Get data from the backend
    const pieData = @json($pieChartData);
    const barData = @json($barChartData);

    // Pie Chart: Percentage
    const pieChartLabels = pieData.map(item => item.type);
    const pieChartValues = pieData.map(item => item.percentage.toFixed(2)); // Rounded percentages

    var pieChartCtx = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(pieChartCtx, {
        type: 'pie',
        data: {
            labels: pieChartLabels,
            datasets: [{
                data: pieChartValues,
                backgroundColor: ['#1d7af3', '#f3545d', '#fdaf4b', '#4caf50', '#ff9800'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.label}: ${tooltipItem.raw}%`;
                        }
                    }
                },
                legend: {
                    position: 'bottom',
                },
            },
        }
    });

    // Bar Chart: Amount
    const barChartLabels = barData.map(item => item.type);
    const barChartValues = barData.map(item => item.total_amount);

    var barChartCtx = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(barChartCtx, {
        type: 'bar',
        data: {
            labels: barChartLabels,
            datasets: [{
                label: "Зарлагын хэмжээ (MNT)",
                data: barChartValues,
                backgroundColor: '#1d7af3',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.raw} MNT`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Мөнгөний хэмжээ (MNT)',
                    }
                }
            }
        }
    });
</script>

@endsection
