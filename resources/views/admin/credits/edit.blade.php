@extends('admin.layout')

@section('content')
<h1>Edit Credit</h1>

<form action="{{ route('credits.update', $credit) }}" method="POST">
    @csrf
    @method('PATCH')
    <div>
        <label for="lender">Lender:</label>
        <input type="text" name="lender" id="lender" value="{{ old('lender', $credit->lender) }}" required>
        @error('lender') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" step="0.01" value="{{ old('amount', $credit->amount) }}" required>
        @error('amount') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" value="{{ old('date', $credit->date) }}" required>
        @error('date') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="notes">Notes (optional):</label>
        <textarea name="notes" id="notes">{{ old('notes', $credit->notes) }}</textarea>
    </div>
    <div>
        <button type="submit">Update Credit</button>
        <a href="{{ route('credits.index') }}">Cancel</a>
    </div>
</form>
@endsection
