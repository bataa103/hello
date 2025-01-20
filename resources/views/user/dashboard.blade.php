@extends('layouts.user')

@section('content1')
<div class="d-flex">
    <!-- Үндсэн Агуулга -->
    <div class="main-content flex-grow-1 p-4">
        <!-- Кредит Картны Хэсэг -->
        <div class="row align-items-center">
            <!-- Үлдэгдэл Card -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Үлдэгдэл</h5>
                        <p class="card-text text-success">
                            {{ number_format($creditDetails->sum('balance'), 2) }}.₮
                        </p>
                        <p class="card-text text-danger">
                            {{ number_format($creditDetails->sum('totalExpenses'), 2) }}.₮
                        </p>
                        <h6 class="card-subtitle text-muted">Нийт Кредит Карт</h6>
                    </div>
                </div>
            </div>
            <!-- Dropdown Menu to Choose Bank -->
            <div class="col-md-8">
                <div class="mb-4">
                    <label for="bankSelector" class="form-label">Банк сонгох</label>
                    <div class="input-group">
                        <select id="bankSelector" class="form-select">
                            <option value="">Бүх банк</option>
                            @foreach ($creditDetails as $credit)
                                <option value="{{ $credit['bank'] }}">{{ $credit['bank'] }}</option>
                            @endforeach
                        </select>
                        <button id="showBankButton" class="btn btn-primary">Харах</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



            <!-- Credit Card Details Section -->
            <div id="bankDetails" class="row">
                @foreach ($creditDetails as $credit)
                    <div class="col-md-4 bank-card" data-bank="{{ $credit['bank'] }}" style="display: none;">
                        <div class="card">
                            <div class="card-header">{{ $credit['bank'] }}</div>
                            <div class="card-body">
                                <p>Нийт Орлого: <span
                                        class="text-success">{{ number_format($credit['totalIncomes'], 2) }}.₮</span></p>
                                <p>Нийт Зарлага: <span
                                        class="text-danger">{{ number_format($credit['totalExpenses'], 2) }}.₮</span></p>
                                <p>Үлдэгдэл: <span
                                        class="text-primary">{{ number_format($credit['balance'], 2) }}.₮</span></p>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{ $credit['totalExpenses'] / max($credit['totalIncomes'], 1) * 100 }}%;"
                                        aria-valuenow="{{ $credit['totalExpenses'] / max($credit['totalIncomes'], 1) * 100 }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

            <!-- Графикийн Хэсэг -->
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Сарын Зарлага</div>
                        <div class="card-body">
                            <canvas id="barChartMonthlyExpenses"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Сарын Орлого</div>
                        <div class="card-body">
                            <canvas id="barChartMonthlyIncomes"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chart.js Скриптүүд -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Сарын Зарлагын График
            const barExpenseLabels = @json($barExpenseLabels);
            const barExpenseValues = @json($barExpenseValues);

            const barMonthlyExpensesCtx = document.getElementById('barChartMonthlyExpenses').getContext('2d');
            new Chart(barMonthlyExpensesCtx, {
                type: 'bar',
                data: {
                    labels: barExpenseLabels,
                    datasets: [{
                        label: 'Зарлага (MNT)',
                        data: barExpenseValues,
                        backgroundColor: '#f3545d',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Зарлага (MNT)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Сарын Өдрүүд'
                            }
                        }
                    }
                }
            });

            // Сарын Орлогын График
            const barIncomeLabels = @json($barIncomeLabels);
            const barIncomeValues = @json($barIncomeValues);

            const barMonthlyIncomesCtx = document.getElementById('barChartMonthlyIncomes').getContext('2d');
            new Chart(barMonthlyIncomesCtx, {
                type: 'bar',
                data: {
                    labels: barIncomeLabels,
                    datasets: [{
                        label: 'Орлого (MNT)',
                        data: barIncomeValues,
                        backgroundColor: '#4caf50',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Орлого (MNT)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Сарын Өдрүүд'
                            }
                        }
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bankSelector = document.getElementById('bankSelector');
            const showBankButton = document.getElementById('showBankButton');
            const bankCards = document.querySelectorAll('.bank-card');

            showBankButton.addEventListener('click', function () {
                const selectedBank = bankSelector.value;

                bankCards.forEach(card => {
                    const cardBank = card.dataset.bank;

                    if (selectedBank === "" || cardBank === selectedBank) {
                        card.style.display = "block";
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        });
    </script>
@endsection
