@extends('layouts.user')

@section('content1')
    <div class="content content-documentation mt-20">
        <div class="container-fluid mt-4">
            <div class="card card-documentation">
                <div class="card-header">
                    <h4>Зарлагын мэдээлэл</h4>
                    <p>Та энд зарлагын мэдээллүүдийг удирдах боломжтой.</p>
                </div>
                <div class="card-body">
                    <!-- Add Expense Button -->
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-primary btn-round me-2" data-bs-toggle="modal" data-bs-target="#addRowModal">
                            <i class="fa fa-plus"></i> Мөр нэмэх
                        </button>
                        <button class="btn btn-secondary btn-round" data-bs-toggle="modal" data-bs-target="#uploadExcelModal">
                            <i class="fa fa-file-excel"></i> Excel-ээр нэмэх
                        </button>
                    </div>

                    <!-- Add Expense Modal -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="addRowModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">Шинэ</span>
                                        <span class="fw-light">Зарлага</span>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Энэхүү формоор шинэ зарлага нэмнэ үү. Бүх шаардлагатай талбаруудыг бөглөнө үү.</p>
                                    <form action="{{ route('user.expense.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="type">Зардлын төрөл</label>
                                            <select name="type" id="type" class="form-control" required>
                                                <option value="" disabled selected>Зардлын төрлөө сонгоно уу</option>
                                                @foreach (\App\Enum\ExpenseType::cases() as $type)
                                                    <option value="{{ $type->value }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="amount">Дүн</label>
                                            <input type="number" step="0.01" name="amount" class="form-control" required>
                                            @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Тайлбар</label>
                                            <textarea name="description" class="form-control" rows="3"></textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Зарлагын огноо</label>
                                            <input type="date" name="date" id="date" class="form-control"
                                                required>
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="credit_id">Холбогдох данс</label>
                                            <select name="credit_id" id="credit_id" class="form-control" required>
                                                <option value="" disabled selected>Данс сонгоно уу</option>
                                                @foreach ($credits as $credit)
                                                    <option value="{{ $credit->id }}">{{ $credit->bank }} - {{ $credit->IBAN }}</option>
                                                @endforeach
                                            </select>
                                            @error('credit_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Нэмэх</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Болих</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Excel Upload Modal -->
                    <div class="modal fade" id="uploadExcelModal" tabindex="-1" role="dialog" aria-labelledby="uploadExcelModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">Excel</span>
                                        <span class="fw-light">Файл Нэмэх</span>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Энэхүү функц нь Excel файл ашиглан олон зарлагын мэдээллийг нэг дор нэмэх боломжийг олгоно.</p>
                                    <form action="{{route('user.income.import.transactions')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="excelFile">Excel файл</label>
                                            <input type="file" name="excelFile" id="excelFile" class="form-control" accept=".xlsx, .xls" required>
                                            @error('excelFile')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Хадгалах</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Болих</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                          <div class="card">
                            <div class="card-body">
                              <div class="d-flex justify-content-between">
                                <div>
                                  <h5><b>Өнөөдрийн зарлага</b></h5>
                                  <p class="text-muted">All Customs Value</p>
                                </div>
                                <h3 class="text-info fw-bold">"34.000₮</h3>
                              </div>
                              <div class="progress progress-sm">
                                <div
                                  class="progress-bar bg-info-1 w-75"
                                  role="progressbar"
                                  aria-valuenow="75"
                                  aria-valuemin="0"
                                  aria-valuemax="100"
                                ></div>
                              </div>
                              <div class="d-flex justify-content-between mt-2">
                                <p class="text-muted mb-0">Change</p>
                                <p class="text-muted mb-0">45%</p>
                              </div>
                            </div>
                          </div>
                        </div>
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


                    <!-- Expenses Table -->
                    <div class="table-responsive">
                        <table id="expensesTable" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Зардлын төрөл</th>
                                    <th>Дүн</th>
                                    <th>Тайлбар</th>
                                    <th>Зарлагын огноо</th>
                                    <th>Холбогдох данс</th>
                                    <th>Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenses as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ number_format($item->amount, 2) }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date)->format('F j, Y') }}</td>
                                        <td>{{ $item->credit->IBAN ?? 'N/A' }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-warning btn-sm me-3" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form action="{{ route('user.expense.destroy', $item->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Устгахдаа итгэлтэй байна уу?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">Засварлах</span>
                                                        <span class="fw-light">Мөр</span>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('user.expense.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="type">Зардлын төрөл</label>
                                                            <select name="type" class="form-control" required>
                                                                <option value="" disabled>Зардлын төрлөө сонгоно уу</option>
                                                                @foreach (\App\Enum\ExpenseType::cases() as $type)
                                                                    <option value="{{ $type->value }}" {{ $item->type == $type->value ? 'selected' : '' }}>
                                                                        {{ $type->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="amount">Дүн</label>
                                                            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $item->amount }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Тайлбар</label>
                                                            <textarea name="description" class="form-control" rows="3">{{ $item->description }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="credit_id">Холбогдох данс</label>
                                                            <select name="credit_id" id="credit_id" class="form-control" required>
                                                                <option value="" disabled>Данс сонгоно уу</option>
                                                                @foreach ($credits as $credit)
                                                                    <option value="{{ $credit->id }}" {{ $item->credit_id == $credit->id ? 'selected' : '' }}>
                                                                        {{ $credit->bank }} - {{ $credit->IBAN }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Хадгалах</button>
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Болих</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#expensesTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/mn.json"
                }
            });
        });
    </script>
@endsection
