@extends('admin.layout')

@section('content')
<h1>Deposit Details</h1>

<div>
    <p><strong>ID:</strong> {{ $deposit->id }}</p>
    <p><strong>Payer:</strong> {{ $deposit->payer }}</p>
    <p><strong>Amount:</strong> {{ $deposit->amount }}</p>
    <p><strong>Date:</strong> {{ $deposit->date }}</p>
    <p><strong>Notes:</strong> {{ $deposit->notes ?? 'N/A' }}</p>
</div>

<a href="{{ route('deposits.index') }}">Back to List</a>
<a href="{{ route('deposits.edit', $deposit) }}">Edit</a>
<form action="{{ route('deposits.destroy', $deposit) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection
