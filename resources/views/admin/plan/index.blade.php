@extends('layouts.admin')

@section('admin')
    <div class="content content-documentation mt-20">
        <div class="container-fluid mt-4">
            <div class="card card-documentation">
                <div class="card-header">
                    <h4>Планы удирдах</h4>
                    <p>Энд таны үйлчилгээний планыг удирдах боломжтой.</p>
                </div>
                <div class="card-body">
                    <!-- Планы нэмэх товч -->
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addPlanModal">
                            <i class="fa fa-plus"></i> План нэмэх
                        </button>
                    </div>

                    <!-- Планы нэмэх Modal -->
                    <div class="modal fade" id="addPlanModal" tabindex="-1" role="dialog"
                        aria-labelledby="addPlanModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">Шинэ</span>
                                        <span class="fw-light">План</span>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Энэхүү формоор шинэ план нэмнэ үү. Бүх шаардлагатай талбаруудыг бөглөнө үү.</p>
                                    <form action="{{ route('admin.plan.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Планы нэр</label>
                                            <input type="text" name="name" class="form-control" id="name" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Тайлбар</label>
                                            <textarea name="description" id="description" class="form-control"></textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Үнэ</label>
                                            <input type="number" name="price" class="form-control" id="price" required>
                                            @error('price')
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

                    <!-- Планы хүснэгт -->
                    <div class="table-responsive">
                        <table id="plans-table" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Нэр</th>
                                    <th>Тайлбар</th>
                                    <th>Үнэ</th>
                                    <th>Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->id }}</td>
                                        <td>{{ $plan->name }}</td>
                                        <td>{{ $plan->description }}</td>
                                        <td>{{ $plan->price }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-warning btn-sm me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editPlanModal{{ $plan->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                <!-- Delete Form -->
                                                <form action="{{ route('admin.plan.destroy', $plan->id) }}" method="POST" class="d-inline-block">
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
                                    <div class="modal fade" id="editPlanModal{{ $plan->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="editPlanModalLabel{{ $plan->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">Засварлах</span>
                                                        <span class="fw-light">План</span>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.plan.update', $plan->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="name">Нэр</label>
                                                            <input type="text" name="name" class="form-control" id="name" value="{{ $plan->name }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Тайлбар</label>
                                                            <textarea name="description" id="description" class="form-control">{{ $plan->description }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="price">Үнэ</label>
                                                            <input type="number" name="price" class="form-control" id="price" value="{{ $plan->price }}" required>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#plans-table').DataTable();
        });
    </script>
@endsection
