@extends('layouts.user')
@section('content')
    <div class="container-fluid">
        <div class="card card-documentation">
            <div class="card-header">
                <h4>DataTables</h4>
                <p>Add advanced interaction controls
                    to your HTML tables the free & easy way. Read <a href="https://datatables.net/">Full Documentation</a>
                </p>
            </div>
            <div class="card-body">
                <div class="table-content">
                    <span class="title">Table of Contents</span>
                    <ul>
                        <li>
                            <a href="#examples">Examples</a>
                            <ol>
                                <li>
                                    <a href="#basic">Basic</a>
                                </li>
                                <li>
                                    <a href="#multifilter">Multi Filter Select</a>
                                </li>
                                <li>
                                    <a href="#addrow">Орлого нэмэх</a>
                                </li>
                            </ol>
                        </li>
                    </ul>
                </div>
                <h4 class="subcontent-title" id="examples"><span>
                        Examples
                    </span></h4>


                <h5 id="addrow">Орлого нэмэх</h5>
                <div class="bd-example">

                    <!-- Button -->
                    <div class="d-flex">
                        <button class="btn btn-primary btn-round ms-auto mb-3" data-bs-toggle="modal"
                            data-bs-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Орлого нэмэх
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">
                                            Шинэ</span>
                                        <span class="fw-light">
                                            Орлог
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Create a new row using this form, make sure you fill them all</p>
                                    <form method="POST" action="{{ route('admin.income.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="source">Орлогын үүсгэвэр</label>
                                            <input type="text" name="source" id="source" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Орлогын хэмжээ</label>
                                            <input type="number" name="amount" id="amount" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Огноо</label>
                                            <input type="date" name="date" id="date" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Тайлбар</label>
                                            <input type="text" name="description" id="description" class="form-control">
                                        </div>
                                        <button type="submit">Submit</button>
                                        </form>


                                </div>
                                <div class="modal-footer border-0">
                                    <!-- Remove 'Add' button or use it as a form submit button -->
                                    <button type="submit" form="addRowModal" class="btn btn-primary">Add</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Орлогын үүсгэвэр</th>
                                    <th>Орлогын хэмжээ</th>
                                    <th>Огноо</th>
                                    <th>Тайлбар</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($incomes as $income)
                                    <tr>
                                        <td>{{ $income->source }}</td>
                                        <td>{{ $income->amount }}</td>
                                        <td>{{ $income->date }}</td>
                                        <td>{{ $income->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Орлогын үүсгэвэр</th>
                                    <th>Орлогын хэмжээ</th>
                                    <th>Огноо</th>
                                    <th>Тайлбар</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                </div>


            </div>
        </div>
    </div>
    </div>
@endsection
