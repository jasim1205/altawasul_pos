@extends('layouts.app')
@section('title', 'Daily Expense')
@section('page-title', 'Home')
@section('page-subtitle', 'Daily Expense List')
@section('content')

<style>
    thead tr th {
        background-color: #198754 !important;
        color: white !important;
    }
</style>
<section class="section">
    <div class="row">
        <div class="col-sm-12 d-flex">
            <div class="ms-auto d-flex" style="float: right">
                <div class="btn-group mx-1">
                    <a class="btn btn-primary" href="{{ route('dailyexpense.create') }}"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th>Expense Title</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @forelse ($dailyexpense as $value)
                                    <tr>
                                        <td>{{ __(++$loop->index) }}</td>
                                        <td>{{ __($value->expense_title) }}</td>
                                        <td>{{ __($value->amount) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($value->date)->format('d/M/Y') }}</td>
                                        {{-- <td>{{ date('j-M-y',strtotime($value->date)) }}</td> --}}
                                        <td>{{ __($value->remarks) }}</td>
                                        {{-- <td><img src="{{ asset('public/uploads/product/'.$value->product_image) }}" width="50px"></td> --}}
                                        <td class="white-space-nowrap">
                                            <div class="d-flex">
                                                <a href="{{route('dailyexpense.edit',encryptor('encrypt',$value->id))}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{route('dailyexpense.destroy',encryptor('encrypt',$value->id))}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="border:none">
                                                            <span class=""><i class="fa fa-trash text-danger"></i></span>
                                                        </button>
                                                    </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center fw-bolder">Daily Expense No found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
