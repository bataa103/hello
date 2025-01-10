@extends('admin.layout')

@section('content')
<h1>Add New Deposit</h1>

<form action="{{ route('deposits.store') }}" method="POST">
    @csrf
    <div>
        <label for="payer">Payer:</label>
        <input type="text" name="payer" id="payer" value="{{ old('payer') }}" required>
        @error('payer') <span>{{ $message }}</span> @enderror
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
        <button type="submit">Add Deposit</button>
        <a href="{{ route('deposits.index') }}">Cancel</a>
    </div>
</form>
@endsection
