@extends('layouts.user')

@section('content1')

    <form action="{{ route('user.income.importBankTransactions') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="bank_file">Upload Bank Transactions File:</label>
        <input type="file" name="bank_file" id="bank_file" accept=".xls,.xlsx" required>
        <button type="submit">Import Transactions</button>
    </form>


@endsection
