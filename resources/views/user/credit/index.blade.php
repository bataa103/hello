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
                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="addRowModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">Шинэ</span>
                                    <span class="fw-light">Мөр</span>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="small">Энэхүү формоор шинэ мөр нэмнэ үү. Бүх шаардлагатай талбаруудыг бөглөнө үү.</p>
                                <form enctype="multipart/form-data" action="{{route('user.credit.store')}}">
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
                                        <input type="number" name="IBAN" class="form-control" id="IBAN" required>
                                        @error('IBAN')
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
                                </form>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" id="addRowButton" class="btn btn-primary">Нэмэх</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Хүснэгт -->
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Зураг</th>
                                <th>Банкны нэр</th>
                                <th>Дансны дугаар</th>
                                <th>Дасны үлдэгдэл</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($credits as $credit)
                                <tr>
                                    <td>{{ $credit->id }}</td>
                                    <td>
                                        @if ($credit->thumbnail)
                                            <img src="{{ asset('storage/' . $credit->thumbnail) }}" alt="Thumbnail"
                                                width="50" class="img-thumbnail">
                                        @else
                                            <span>Зураг байхгүй</span>
                                        @endif
                                    </td>
                                    <td>{{ App\Enum\Bank::from($credit->bank)->name }}</td>
                                    <td>{{ $credit->IBAN }}</td>
                                    <td>{{ $credit->balance}}</td>

                                </tr>
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

    $('#addRowButton').click(function() {
        alert('Мөр нэмэх үйлдэл хараахан хэрэгжээгүй байна.');
        // Энд таны хэрэгжүүлэлтийн логикийг нэмнэ үү
    });
</script>
@endsection
