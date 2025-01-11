@extends('layouts.user')

@section('content')
<h1>Edit Income</h1>

<form action="{{ route('incomes.update', $income) }}" method="POST">
    @csrf
    @method('PATCH')
    <div>
        <label for="source">Source:</label>
        <input type="text" name="source" id="source" value="{{ old('source', $income->source) }}" required>
        @error('source') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" step="0.01" value="{{ old('amount', $income->amount) }}" required>
        @error('amount') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" value="{{ old('date', $income->date) }}" required>
        @error('date') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="notes">Notes (optional):</label>
        <textarea name="notes" id="notes">{{ old('notes', $income->notes) }}</textarea>
    </div>
    <div>
        <button type="submit">Update Income</button>
        <a href="{{ route('incomes.index') }}">Cancel</a>
    </div>
</form>
@endsection
