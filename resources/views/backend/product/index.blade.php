@extends('layouts.app')
@section('title', trans('Product'))
@section('page', trans('List'))
@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        {{-- <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Product List</li>
                </ol>
            </nav>
        </div> --}}
        
        <div class="">
            <div class="btn-group">
                <a class="btn btn-primary" href="{{ route('product.reportForm') }}">Report</a>
            </div>
        </div>
        
        <div class="ms-auto d-flex">
            <form action="{{ route('product.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, code, or origin" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-success" >Search</button>
                    <a href="{{ route('product.index') }}" class="btn btn-outline-warning"  >Reset</a>
                </div>
            </form>
            <div class="btn-group mx-1">
                <a class="btn btn-primary" href="{{ route('product.create') }}"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    {{-- <h6 class="mb-0 text-uppercase">Product</h6> --}}
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
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
                                {{-- <td>{!! QrCode::size(100)->generate($value->product_name) !!}
                                </td> --}}
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
                                        <a href="{{ route('product.edit', encryptor('encrypt', $value->id)) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('product.destroy', encryptor('encrypt', $value->id)) }}"
                                            method="post">
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
                                <td colspan="9" class="text-center fw-bolder">Product No found</td>
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
