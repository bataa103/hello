@extends('layouts.user')

@section('content1')
    <div class="content content-documentation mt-20">
        <div class="container-fluid mt-4">
            <div class="card card-documentation">
                <div class="card-header">
                    <h4>Дансны мэдээлэл</h4>
                    <p>Энд таны дансны мэдээллийг удирдах боломжтой.</p>
                </div>
                <div class="card-body">
                    <!-- Мөр нэмэх товч -->
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addRowModal">
                            <i class="fa fa-plus"></i> Мөр нэмэх
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
                                        <span class="fw-light">Мөр</span>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Энэхүү формоор шинэ мөр нэмнэ үү. Бүх шаардлагатай талбаруудыг бөглөнө
                                        үү.</p>
                                    <form enctype="multipart/form-data" action="{{ route('user.credit.store') }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="bank_name">Банкны нэр</label>
                                            <select name="bank" id="bank_name" class="form-control" required>
                                                <option value="" disabled selected>Банк сонгоно уу</option>
                                                @foreach (App\Enum\Bank::cases() as $bank)
                                                    <option value="{{ $bank->value }}">{{ $bank->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('bank')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="IBAN">Дансны дугаар</label>
                                            <input type="number" name="IBAN" class="form-control" id="IBAN"
                                                required>
                                            @error('IBAN')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="balance">Дансны үлдэгдэл</label>
                                            <input type="number" name="balance" class="form-control" id="balance"
                                                required>
                                            @error('balance')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="thumbnail">Зураг</label>
                                            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                            @error('thumbnail')
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

                    <!-- Хүснэгт -->
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Зураг</th>
                                    <th>Банкны нэр</th>
                                    <th>Дансны дугаар</th>
                                    <th>Дансны үлдэгдэл</th>
                                    <th>Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($credits as $credit)
                                    <tr>
                                        <td>{{ $credit->id }}</td>
                                        <td>
                                            @if ($credit->thumbnail)
                                                <img src="{{ $credit->thumbnail ? asset($credit->thumbnail) : asset('images/1736655480.jpeg') }}"
                                                    alt="{{ $credit->id }}" width="100" class="img-thumbnail rounded">
                                            @else
                                                <span>Зураг байхгүй</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $bankName =
                                                    is_string($credit->bank) || is_int($credit->bank)
                                                        ? App\Enum\Bank::from($credit->bank)->name
                                                        : $credit->bank->name;
                                            @endphp
                                            {{ $bankName }}
                                        </td>
                                        <td>{{ $credit->IBAN }}</td>
                                        <td>{{ $credit->balance }}</td>
                                        <td class="editDelete">
                                            <div class="d-flex justify-between">
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-warning btn-sm me-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $credit->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                <!-- Delete Form -->
                                                <form action="{{ route('user.credit.destroy', $credit->id) }}"
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

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $credit->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editModalLabel{{ $credit->id }}"
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
                                                    <form enctype="multipart/form-data"
                                                        action="{{ route('user.credit.update', $credit->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="bank_name">Банкны нэр</label>
                                                            <select name="bank" id="bank_name" class="form-control"
                                                                required>
                                                                <option value="" disabled>Банк сонгоно уу</option>
                                                                @foreach (App\Enum\Bank::cases() as $bank)
                                                                    <option value="{{ $bank->value }}"
                                                                        {{ $credit->bank == $bank->value ? 'selected' : '' }}>
                                                                        {{ $bank->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('bank')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="IBAN">Дансны дугаар</label>
                                                            <input type="number" name="IBAN" class="form-control"
                                                                id="IBAN" value="{{ $credit->IBAN }}" required>
                                                            @error('IBAN')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="balance">Дансны үлдэгдэл</label>
                                                            <input type="number" name="balance" class="form-control"
                                                                id="balance" value="{{ $credit->balance }}" required>
                                                            @error('balance')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="thumbnail">Зураг</label>
                                                            <input type="file" name="thumbnail" id="thumbnail"
                                                                class="form-control">
                                                            @if ($credit->thumbnail)
                                                                <img src="{{ asset($credit->thumbnail) }}"
                                                                    alt="Thumbnail" width="50"
                                                                    class="img-thumbnail mt-2">
                                                            @endif
                                                            @error('thumbnail')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
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
            $('#add-row').DataTable();
        });
    </script>
@endsection
