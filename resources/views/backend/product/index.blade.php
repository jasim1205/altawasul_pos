@extends('layouts.app')
@section('title',trans('Product'))
@section('page',trans('List'))
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Product</h3>
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
                    <a class="btn btn-primary" href="{{route('product.create')}}"><i class="fa fa-plus"></i></a>
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th scope="col">{{__('#SL')}}</th>
                            <th>Company</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>Product Model</th>
                            <th>Unit Price</th>
                            <th>Product Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($product as $value)
                            <tr> 
                                <td>{{ __(++$loop->index) }}</td>
                                <td>{{ __($value->company?->company_name) }}</td>
                                <td>{{ __($value->category?->category_name) }}</td>
                                <td>{{ __($value->product_name) }}</td>
                                <td>{{ __($value->product_model) }}</td>
                                <td>{{ __($value->unit_price) }}</td>
                                <td><img src="{{ asset('public/uploads/product/'.$value->product_image) }}" width="50px"></td>
                                <td class="white-space-nowrap">
                                    <div class="d-flex">
                                        <a href="{{route('product.edit',encryptor('encrypt',$value->id))}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{route('product.destroy',encryptor('encrypt',$value->id))}}" method="post">
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