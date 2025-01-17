@extends('layouts.user')

@section('content1')
    <div class="content content-documentation mt-20">
        <div class="container-fluid mt-4">
            <div class="card card-documentation">
                <div class="card-header">
                    <h4> Орлогын мэдээлэл</h4>
                    <p>Та энд өөрийн орлогын мэдээллүүддээ удирдах боломжтой.</p>
                </div>
                <div class="card-body">
                    <!-- Add Income Button -->
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-primary btn-round me-2" data-bs-toggle="modal" data-bs-target="#addRowModal">
                            <i class="fa fa-plus"></i> Мөр нэмэх
                        </button>
                        <button class="btn btn-secondary btn-round" data-bs-toggle="modal"
                            data-bs-target="#uploadExcelModal">
                            <i class="fa fa-file-excel"></i> Excel-ээр нэмэх
                        </button>
                    </div>

                    <!-- Мөр нэмэх Modal -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog"
                        aria-labelledby="addRowModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">Шинэ</span>
                                        <span class="fw-light">Орлого</span>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Энэхүү формоор шинэ орлого нэмнэ үү. Бүх шаардлагатай талбаруудыг
                                        бөглөнө үү.</p>
                                    <form action="{{ route('user.income.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="incomeType">Орлогын төрөл</label>
                                            <select name="incomeType" id="incomeType" class="form-control" required>
                                                <option value="" disabled selected>Орлогын төрлөө сонгоно уу</option>
                                                @foreach (\App\Enum\IncomeType::cases() as $type)
                                                    <option value="{{ $type->value }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="amount">Дүн</label>
                                            <input type="number" step="0.01" name="amount" class="form-control"
                                                required>
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
                                            <label for="date">Гүйлгээний огноо</label>
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
                                                    <option value="{{ $credit->id }}">{{ $credit->bank }} -
                                                        {{ $credit->IBAN }}</option>
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
                    <div class="modal fade" id="uploadExcelModal" tabindex="-1" role="dialog"
                        aria-labelledby="uploadExcelModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">Excel</span>
                                        <span class="fw-light">Файл Нэмэх</span>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Энэхүү функц нь Excel файл ашиглан олон орлогын мэдээллийг нэг дор
                                        нэмэх боломжийг олгоно.</p>
                                    <form action="{{ route('user.income.import.transactions') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="csv_file">Excel файл</label>
                                            <input type="file" name="csv_file" id="csv_file" class="form-control"
                                                accept=".csv,.xlsx,.xls" required>
                                            @error('csv_file')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Импорт</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Болих</button>
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
                          <h5><b>Өнөөдрийн орлого</b></h5>
                          <p class="text-muted">All Customs Value</p>
                        </div>
                        <h3 class="text-info fw-bold">170.000₮</h3>
                      </div>
                      <div class="progress progress-sm">
                        <div
                          class="progress-bar bg-info w-75"
                          role="progressbar"
                          aria-valuenow="75"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                      <div class="d-flex justify-content-between mt-2">
                        <p class="text-muted mb-0">Change</p>
                        <p class="text-muted mb-0">75%</p>
                      </div>
                    </div>
                  </div>
                </div>
                    <!-- Incomes Table -->
                    <div class="table-responsive">
                        <table id="incomesTable" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Орлогын төрөл</th>
                                    <th>Дүн</th>
                                    <th>Тайлбар</th>
                                    <th>Гүйлгээний огноо</th>
                                    <th>Холбогдох данс</th>
                                    <th>Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($incomes as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->incomeType }}</td>
                                        <td>{{ number_format($item->amount, 2) }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date)->format('F j, Y') }}</td>
                                        <td>{{ $item->credit->IBAN ?? 'N/A' }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-warning btn-sm me-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form action="{{ route('user.income.destroy', $item->id) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Устгахдаа итгэлтэй байна уу?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editModalLabel{{ $item->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">Засварлах</span>
                                                        <span class="fw-light">Мөр</span>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('user.income.update', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="incomeType">Орлогын төрөл</label>
                                                            <select name="incomeType" id="incomeType"
                                                                class="form-control" required>
                                                                <option value="" disabled selected>Орлогын төрлөө
                                                                    сонгоно уу</option>
                                                                @foreach (\App\Enum\IncomeType::cases() as $type)
                                                                    <option value="{{ $type->value }}"
                                                                        {{ $item->incomeType == $type->value ? 'selected' : '' }}>
                                                                        {{ $type->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="amount">Дүн</label>
                                                            <input type="text" id="amount" name="amount"
                                                                class="form-control"
                                                                value="{{ number_format($item->amount, 0, '.', ',') }}"
                                                                required oninput="formatNumberNoDecimals(this)">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Тайлбар</label>
                                                            <textarea name="description" class="form-control" rows="3">{{ $item->description }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="data">Гүйлгээний огноо</label>
                                                            <textarea name="date" class="form-control" rows="3">{{ $item->description }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="credit_id">Холбогдох данс</label>
                                                            <select name="credit_id" id="credit_id" class="form-control"
                                                                required>
                                                                <option value="" disabled>Данс сонгоно уу</option>
                                                                @foreach ($credits as $credit)
                                                                    <option value="{{ $credit->id }}"
                                                                        {{ $item->credit_id == $credit->id ? 'selected' : '' }}>
                                                                        {{ $credit->bank }} - {{ $credit->IBAN }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Хадгалах</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Болих</button>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#incomesTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/mn.json"
                }
            });
        });
    </script>
    <script>
        function formatNumberNoDecimals(input) {
            // Remove any existing commas
            let value = input.value.replace(/,/g, '');

            // Ensure it's a valid number
            if (!isNaN(value) && value !== '') {
                // Format the number with commas, no decimals
                input.value = parseInt(value, 10).toLocaleString('en-US');
            }
        }
    </script>
@endsection
