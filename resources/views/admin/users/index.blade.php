@extends('layouts.admin')

@section('admin')
    <div class="content content-documentation mt-20">
        <div class="container-fluid mt-4">
            <div class="card card-documentation">
                <div class="card-header">
                    <h4>Хэрэглэгчид болон Планы удирдах</h4>
                    <p>Энд таны үйлчилгээний планыг болон хэрэглэгчдийн мэдээллийг удирдах боломжтой.</p>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="users-table" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
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
            $('#users-table').DataTable();
            $('#plans-table').DataTable();
        });
    </script>
@endsection
