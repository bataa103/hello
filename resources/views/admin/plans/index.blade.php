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

    <!-- Display plans (if needed) -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($plans as $plan)
                <tr>
                    <td>{{ $plan->id }}</td>
                    <td>{{ $plan->name }}</td>
                    <td>{{ $plan->description }}</td>
                    <td>{{ $plan->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
