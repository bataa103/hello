@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}!</p>

    <h2>Overview</h2>
    <ul>
        <li>Total Users: {{ $users->count() }}</li>
        <li>Total Active Plans: {{ $plans->count() }}</li>
        <li>Total Messages: {{ $messages->count() }}</li>
    </ul>
</div>
@endsection
