@extends('layouts.user')

@section('content')
<h1>Income Details</h1>

<div>
    <p><strong>ID:</strong> {{ $income->id }}</p>
    <p><strong>Source:</strong> {{ $income->source }}</p>
    <p><strong>Amount:</strong> {{ $income->amount }}</p>
    <p><strong>Date:</strong> {{ $income->date }}</p>
    <p><strong>Notes:</strong> {{ $income->notes ?? 'N/A' }}</p>
</div>

<a href="{{ route('incomes.index') }}">Back to List</a>
<a href="{{ route('incomes.edit', $income) }}">Edit</a>
<form action="{{ route('incomes.destroy', $income) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection
