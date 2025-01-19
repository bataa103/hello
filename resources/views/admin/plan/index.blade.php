@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage Plans</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- File upload form for importing users -->
    <form action="{{ route('admin.users.import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Upload Users CSV</label>
            <input type="file" name="file" id="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Import Users</button>
    </form>

    <div class="container">
        <h1>Manage User Plans</h1>
        <form action="{{ route('admin.plan.save') }}" method="POST">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Plan</th>
                        <th>Status Start Date</th>
                        <th>Status End Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <select name="plans[{{ $user->id }}][plan_id]" class="form-control">
                                <option value="">Select Plan</option>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}" {{ $user->plan_id == $plan->id ? 'selected' : '' }}>
                                        {{ $plan->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="date" name="plans[{{ $user->id }}][start_date]" value="{{ $user->status_start_date }}" class="form-control"></td>
                        <td><input type="date" name="plans[{{ $user->id }}][end_date]" value="{{ $user->status_end_date }}" class="form-control"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Save Plans</button>
        </form>
    </div>
</div>
@endsection
