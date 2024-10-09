@extends('layouts.app')
@section('title',trans('Product'))
@section('page',trans('List'))
@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Daily Expense List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-primary" href="{{route('dailyexpense.create')}}"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    {{-- <h6 class="mb-0 text-uppercase">Product</h6> --}}
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">{{__('#SL')}}</th>
                            <th>Purpose</th>
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
                                <td>{{ __($value->purpose_title) }}</td>
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
@endsection
