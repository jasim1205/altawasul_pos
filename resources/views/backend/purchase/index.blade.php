@extends('layouts.app')
@section('title',trans('Purchase'))
@section('page',trans('List'))
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Purchase</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">list</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <a class="btn btn-primary" href="{{route('purchase.create')}}"><i class="fa fa-plus"></i></a>
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Date</th>
                            <th>Total Quantity</th>
                            <th>Total Discount</th>
                            <th>Total Tax</th>
                            <th>Grand Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($purchase as $value)
                            <tr>
                                <td>{{ __($value->supplier?->supplier_name) }}</td>
                                <td>{{ __($value->date) }}</td>
                                <td>{{ __($value->total_quantity) }}</td>
                                <td>{{ __($value->total_discount) }}</td>
                                <td>{{ __($value->total_tax) }}</td>
                                <td>{{ __($value->grand_total_amount) }}</td>
                                <td class="white-space-nowrap">
                                    <div class="d-flex">
                                        <a href="{{route('purchase.edit',encryptor('encrypt',$value->id))}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{route('purchase.destroy',encryptor('encrypt',$value->id))}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border:none">
                                                    <span class=""><i class="fa fa-trash text-danger"></i></span>
                                                </button>
                                            </form>
                                    </div>
                                    {{-- <a href="javascript:void()" onclick="$('#form{{$value->id}}').submit()" class="text-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form id="form{{$value->id}}" action="{{route('company.destroy',encryptor('encrypt',$value->id))}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center fw-bolder">Product No found</td>
                            </tr>
                        @endforelse
                        
                       
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection