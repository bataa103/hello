@extends('admin.layout')

@section('content')
<h1>Expense Details</h1>

<div>
    <p><strong>ID:</strong> {{ $expense->id }}</p>
    <p><strong>Category:</strong> {{ $expense->category }}</p>
    <p><strong>Amount:</strong> {{ $expense->amount }}</p>
    <p><strong>Date:</strong> {{ $expense->date }}</p>
    <p><strong>Notes:</strong> {{ $expense->notes ?? 'N/A' }}</p>
</div>

<a href="{{ route('expenses.index') }}">Back to List</a>
<a href="{{ route('expenses.edit', $expense) }}">Edit</a>
<form action="{{ route('expenses.destroy', $expense) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection
