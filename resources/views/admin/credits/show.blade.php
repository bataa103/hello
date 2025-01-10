@extends('admin.layout')

@section('content')
<h1>Credit Details</h1>

<div>
    <p><strong>ID:</strong> {{ $credit->id }}</p>
    <p><strong>Lender:</strong> {{ $credit->lender }}</p>
    <p><strong>Amount:</strong> {{ $credit->amount }}</p>
    <p><strong>Date:</strong> {{ $credit->date }}</p>
    <p><strong>Notes:</strong> {{ $credit->notes ?? 'N/A' }}</p>
</div>

<a href="{{ route('credits.index') }}">Back to List</a>
<a href="{{ route('credits.edit', $credit) }}">Edit</a>
<form action="{{ route('credits.destroy', $credit) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection
