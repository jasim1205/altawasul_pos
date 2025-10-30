@extends('layouts.app')
@section('title', 'Product')
@section('page-title', 'Home')
@section('page-subtitle', 'Product List')
@section('content')
    <style>
        thead tr th {
            background-color: #198754 !important;
            color: white !important;
        }
    </style>
    <div class="ml-auto d-flex">
        <div class="btn-group ms-auto">
            <a class="btn btn-primary" href="{{ route('product.index') }}"><i class="fa fa-list"></i></a>
        </div>
    </div>
    <hr>
    <section class="section">
        <div class="row">
            <div class="col-sm-12 d-flex">
                <div class="btn-group">
                    <a class="btn btn-outline-primary" href="{{ route('product.reportForm') }}">Report</a>
                </div>
                <div class="ms-auto d-flex" style="float: right">
                    <form action="{{ route('product.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by name, code, or origin" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-outline-success">Search</button>
                            <a href="{{ route('product.index') }}" class="btn btn-outline-warning">Reset</a>
                        </div>
                    </form>
                    <div class="btn-group mx-1">
                        <a class="btn btn-primary" href="{{ route('product.create') }}"><i class="fa fa-plus"></i></a>
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
                            <table id="example" class="table table-bordered" style="width:100%">
                                <thead class="">
                                    <tr class="bg-success text-white">
                                        <th scope="col">{{ __('#SL') }}</th>
                                        {{-- <th>Company</th> --}}
                                        {{-- <th>Category</th> --}}
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Stock</th>
                                        <th>Product Model</th>
                                        <th>Cost Code</th>
                                        <th>OEM</th>
                                        <th>Origin</th>
                                        <th>Cross Reference</th>
                                        {{-- <th>Old Price</th> --}}
                                        <th>Cost Unit Price</th>
                                        <th>QR Code</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($product as $value)
                                        <tr>
                                            <td>{{ __(++$loop->index) }}</td>
                                            {{-- <td>{{ __($value->company?->company_name) }}</td> --}}
                                            {{-- <td>{{ __($value->category?->category_name) }}</td> --}}
                                            <td>{{ __($value->product_name) }}</td>
                                            <td><img src="{{ asset('public/uploads/product/' . $value->product_image) }}"
                                                    width="50px">
                                            </td>
                                            <td>{{ __($value->stock?->quantity ?? 0) }}</td>
                                            <td>{{ __($value->product_model) }}</td>
                                            <td>{{ __($value->cost_code) }}</td>
                                            <td>{{ __($value->oem) }}</td>
                                            <td>{{ __($value->origin) }}</td>
                                            <td>{{ __($value->cross_reference) }}</td>
                                            {{-- <td>{{ __($value->old_price) }}</td> --}}
                                            <td>{{ __($value->cost_unit_price) }}</td>
                                            
                                            <td>
                                                {!! QrCode::size(50)->generate(
                                                    "Product: {$value->product_name}\n" .
                                                        "Model: {$value->product_model}\n" .
                                                        "Category: {$value->category?->category_name}\n" .
                                                        'Mobile: 0555611560',
                                                ) !!}
                                            </td>

                                            <td class="white-space-nowrap">
                                                <div class="d-flex">
                                                    <a href="{{ route('product.edit', encryptor('encrypt', $value->id)) }}"
                                                        class="btn btn-warning text-white" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('product.destroy', encryptor('encrypt', $value->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="border:none"
                                                            onclick="return confirm('Are you sure to delete?')"
                                                            title="Delete" class="btn btn-danger ms-2">
                                                            <span class=""><i class="fa fa-trash"></i></span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center fw-bolder">Product No found</td>
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
