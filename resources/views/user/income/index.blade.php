@extends('layouts.user')

@section('content1')
    <div class="content content-documentation mt-20">
        <div class="container-fluid mt-4">
            <div class="card card-documentation">Excel-ээр нэмэх
                <div class="card-header">
                    <h4> Орлогын мэдээлэл</h4>
                    <p>Та энд өөрийн орлогын мэдээллүүддээ удирдах боломжтой.</p>
                </div>
                <div class="card-body">
                    <!-- Add Income Button -->
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-primary btn-round me-2" data-bs-toggle="modal" data-bs-target="#addRowModal">
                            <i class="fa fa-plus"></i> Орлого нэмэх
                        </button>
                        {{-- <form action="{{ route('income.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Upload File</label>
                                <input type="file" name="file" id="file" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Import Incomes</button>
                        </form> --}}


                    </div>

                    <!-- Орлого нэмэх Modal -->
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
                                                <span class="text-danger">{{ $message }}</span>we
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
                    {{-- <div class="modal fade" id="uploadExcelModal" tabindex="-1" role="dialog"
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
                                <form action="{{ route('income.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" required>
                                    <button type="submit">Import Income</button>
                                </form>

                            </div>
                        </div>
                    </div> --}}

                    <div class="mt-4">
                        <!-- Date Picker and Apply Button -->
                        {{-- <div class="d-flex align-items-center">
                            <input type="date" id="income-date" class="form-control w-auto me-2">
                            <button id="apply-date" class="btn btn-primary">Apply</button>
                        </div> --}}

                        <!-- Display Selected Date and Total Income -->
                        {{-- <h5 id="selected-date" class="font-bold mt-3">Selected Date:</h5>
                        <h3 id="total-income" class="text-blue-600 font-bold"></h3>
                        <input type="text" id="total-income" class="form-control text-blue-600 font-bold mt-2" readonly>
                    </div> --}}

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
                                                            <label for="date">Гүйлгээний огноо</label>
                                                                <input type="date" name="date" id="date" class="form-control" value="{{ $item->date }}" required>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    @endsection

    @section('scripts')



    <script>
    // document.getElementById("apply-date").addEventListener("click", () => {
    //     const selectedDate = document.getElementById("income-date").value;

    //     if (!selectedDate) {
    //         alert("Please select a date.");
    //         return;
    //     }

    //     const incomeData = {
    //         "2025-01-01": 1500,
    //         "2025-01-02": 2000,
    //         "2025-01-03": 2500
    //     };

    //     const totalIncome = incomeData[selectedDate] || 0;
    //     const formattedIncome = totalIncome.toLocaleString('en-US');

    //     document.getElementById("selected-date").innerText = `Selected Date: ${selectedDate}`;
    //     document.getElementById("total-income").value = formattedIncome;
    // });

    //


    // sss
        document.getElementById('income-date').addEventListener('change', function () {
        const selectedDate = this.value;

        fetch(`/income/date?date=${selectedDate}`)
            .then(response => response.json())
            .then(data => {
                const totalIncome = data.totalIncome || 0;

                // Update chart
                incomeChart.data.datasets[0].data = [totalIncome];
                incomeChart.update();
            })
            .catch(error => {
                console.error('Error updating chart:', error);
            });
    });


    </script>


    @endsection
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
    <script>
        document.getElementById('income-date').addEventListener('change', function () {
            const selectedDate = this.value;

            // Format selected date
            const formattedDate = new Date(selectedDate).toLocaleDateString('mn-MN', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('selected-date').textContent = `Орлого (${formattedDate})`;

            // Fetch income data from the backend
            fetch(`/income/total?date=${selectedDate}`)
                .then(response => response.json())
                .then(data => {
                    const totalIncome = data.totalIncome || 0;

                    // Update income display
                    document.getElementById('total-income').textContent = `${totalIncome}₮`;

                    // Update progress bar (Assume target income is 100,000₮ for demonstration)
                    const targetIncome = 100000;
                    const percentage = Math.min((totalIncome / targetIncome) * 100, 100);
                    document.getElementById('progress-bar').style.width = `${percentage}%`;
                    document.getElementById('progress-percentage').textContent = `${Math.round(percentage)}%`;
                })
                .catch(error => console.error('Error fetching income data:', error));
        });
    </script>
    <script>
    document.getElementById('income-date').addEventListener('change', function () {
        const selectedDate = this.value;

        // Fetch income data for the selected date
        fetch(`/income/date?date=${selectedDate}`)
            .then(response => response.json())
            .then(data => {
                // Update total income display
                const totalIncome = data.totalIncome || 0;
                document.getElementById('total-income').textContent = `${totalIncome}₮`;

                // Update progress bar (example target of 100,000₮)
                const targetIncome = 100000;
                const percentage = Math.min((totalIncome / targetIncome) * 100, 100);
                document.getElementById('progress-bar').style.width = `${percentage}%`;
                document.getElementById('progress-percentage').textContent = `${Math.round(percentage)}%`;
            })
            .catch(error => console.error('Error fetching income data:', error));
    });
    </script>
