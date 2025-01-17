@extends('layouts.user')

@section('content1')

<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>



<div class="row">
    <!-- Charts -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Pie Chart</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Bar Chart Example
            </div>
            <div class="card-body">
                <canvas id="myBarChart" width="100%" height="40"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var myPieChart = new Chart(pieChart, {
		type: 'pie',
		data: {
			datasets: [{
				data: [50, 35, 15],
				backgroundColor :["#1d7af3","#f3545d","#fdaf4b"],
				borderWidth: 0
			}],
			labels: ['New Visitors', 'Subscribers', 'Active Users']
		},
		options : {
			responsive: true,
			maintainAspectRatio: false,
			legend: {
				position : 'bottom',
				labels : {
					fontColor: 'rgb(154, 154, 154)',
					fontSize: 11,
					usePointStyle : true,
					padding: 20
				}
			},
			pieceLabel: {
				render: 'percentage',
				fontColor: 'white',
				fontSize: 14,
			},
			tooltips: false,
			layout: {
				padding: {
					left: 20,
					right: 20,
					top: 20,
					bottom: 20
				}
			}
		}
	})

    // Bar Chart
    var barChartCtx = document.getElementById('myBarChart').getContext('2d');
    var barChart = new Chart(barChartCtx, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Sales",
                backgroundColor: 'rgb(23, 125, 255)',
                data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
            }]
        },
        options: { responsive: true }
    });

</script>

@endsection
