@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold">Messages</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Received At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
            <tr>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->message }}</td>
                <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


