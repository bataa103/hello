@extends('layouts.user')

@section('content')
<h1>Add New Expense</h1>

<form action="{{ route('expenses.store') }}" method="POST">
    @csrf
    <div>
        <label for="category">Category:</label>
        <input type="text" name="category" id="category" value="{{ old('category') }}" required>
        @error('category') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" step="0.01" value="{{ old('amount') }}" required>
        @error('amount') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" value="{{ old('date') }}" required>
        @error('date') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="notes">Notes (optional):</label>
        <textarea name="notes" id="notes">{{ old('notes') }}</textarea>
    </div>
    <div>
        <button type="submit">Add Expense</button>
        <a href="{{ route('expenses.index') }}">Cancel</a>
    </div>
</form>
@endsection
