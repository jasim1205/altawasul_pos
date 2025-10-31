@extends('layouts.app')
@section('title', 'Stock')
@section('page-title', 'Home')
@section('page-subtitle', 'Stock List')
@section('content')
<style>
    thead tr th {
        background-color: #198754 !important;
        color: white !important;
    }

    .input-group-text {
        background-color: #3A58B3;
        color: white;
        width: 150px;
    }

    .star {
        color: rgb(248, 62, 62);
    }
</style>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="btn-group">
            <a class="btn btn-outline-primary mx-2" href="{{ route('stock.reportForm') }}">Report</a>
        </div>
        <div class="ms-auto d-flex">
            <form action="{{ route('stock.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search by product name, model, origin, or code" value="{{ request('search') }}"
                        style="padding:5px;">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                    <a href="{{ route('stock.index') }}" class="btn btn-outline-warning">Reset</a>
                </div>

            </form>
        </div>

        {{-- <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-primary" href="{{route('product.create')}}"><i class="fa fa-plus"></i></a>
            </div>
        </div> --}}
    </div>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('#SL') }}</th>
                            {{-- <th>Company</th>
                            <th>Category</th> --}}
                            <th>Product Name</th>
                            <th>Product Model</th>
                            <th>Stock</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stock as $value)
                            <tr>
                                <td>{{ __(++$loop->index) }}</td>
                                {{-- <td>{{ __($value->product->company?->company_name) }}</td>
                                <td>{{ __($value->product->category?->category_name) }}</td> --}}
                                <td>{{ __($value->product?->product_name) }}</td>
                                <td>{{ __($value->product?->product_model) }}</td>
                                <td style="color: {{ $value->quantity <= 5 ? 'red' : 'green' }};font-weight:bold">
                                    {{ __($value->quantity) }}</td>
                                <td style="color: {{ $value->quantity <= 5 ? 'red' : 'green' }};font-weight:bold">
                                    {{ $value->quantity <= 5 ? 'Low Stock' : 'Available' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center fw-bolder">Product No found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="page-heading">
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
</div> --}}
@endsection
