@extends('layouts.user')

@section('content1')
    <div class="content content-documentation mt-20">
        <div class="container-fluid mt-4">
            <div class="card card-documentation">
                <div class="card-header">
                    <h4>Дансны мэдээлэл</h4>
                    <p>Энд таны дансны мэдээллийг удирдах боломжтой.</p>
                </div>
                <form action="{{ route('import.transactions') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="csv_file">Upload CSV File:</label>
                        <input type="file" name="csv_file" id="csv_file" required>
                    </div>
                    <button type="submit">Import Transactions</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#add-row').DataTable();
        });
    </script>
@endsection
