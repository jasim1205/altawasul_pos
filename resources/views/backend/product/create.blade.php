@extends('layouts.app')
@section('title', 'Product')
@section('page-title', 'Home')
@section('page-subtitle', 'Create Product')
@section('content')
    <style>
        .input-group-text {
            background-color: #3A58B3;
            color: white;
            width: 150px;
        }
        .star {
            color: rgb(248, 62, 62);
        }
    </style>

    <!--breadcrumb-->

    <div class="ml-auto d-flex">
        <div class="btn-group ms-auto">
            <a class="btn btn-primary" href="{{ route('product.index') }}"><i class="fa fa-list"></i></a>
        </div>
    </div>
    <hr>
    <div id="stepper1" class="bs-stepper">
        <div class="card">
            <div class="card-body">
                <div class="bs-stepper-content">
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                            <div class="row g-3">
                                {{-- <div class="col-12 col-lg-6">
                                <label for="FisrtName" class="form-label">Company Name</label>
                                <select name="company_id" id="company_id" class="form-control">
                                    <option value="">Select Company</option>
                                    @foreach ($company as $value)
                                        <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                                {{--  <div class="col-12 col-lg-6">
                                <label for="name" class="form-label">Category Name</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                </select>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $value)
                                        <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                                    @endforeach
                                </select> 
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Product Name <span class="star">*</span></span>
                                        <input type="text" class="form-control" name="product_name"
                                            placeholder="Enter a product name" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        @error('product_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- <label for="name" class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control" id="" placeholder="Enter a product name"/>
                                @error('product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Product Model</span>
                                        <input type="text" name="product_model" class="form-control" id=""
                                            placeholder="Enter a product model" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        @error('product_model')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Origin/Made</span>
                                        <input type="text" name="origin" class="form-control" id=""
                                            placeholder="Enter a origin" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        @error('origin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Location(rak)</span>
                                        <input type="text" name="location_rak" class="form-control" id=""
                                            placeholder="Enter a location" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        @error('location_rak')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Cost Unit Price</span>
                                        <input type="text" class="form-control" name="cost_unit_price"
                                            placeholder="Enter a unit price" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        @error('cost_unit_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Cost Code</span>
                                        <input type="text" class="form-control" name="cost_code"
                                            placeholder="Enter a cost code" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        @error('cost_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">OEM</span>
                                        <input type="text" name="oem" class="form-control" id=""
                                            placeholder="Enter OEM" aria-label="Username" aria-describedby="basic-addon1">
                                        @error('oem')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Cross Reference</span>
                                        <input type="text" name="cross_reference" class="form-control" id=""
                                            placeholder="Enter Cross Reference" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        @error('cross_reference')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Image</span>
                                        <input type="file" name="product_image" class="form-control"
                                            aria-describedby="basic-addon1">
                                        @error('product_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex align-items-end ml-auto" style="justify-content: end;">
                                    <button type="submit" class="btn btn-primary px-4">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end stepper one-->

    {{-- 
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Product</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
            <nav
                aria-label="breadcrumb"
                class="breadcrumb-header float-start float-lg-end"
            >
                <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Create
                </li>
                </ol>
            </nav>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Company Name</label>
                                    <select name="company_id" id="company_id" class="form-control">
                                        <option value="">Select Company</option>
                                        @foreach ($company as $value)
                                            <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" id="name" placeholder="Enter a product name"/>
                                    @error('product_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Unit Price</label>
                                    <input type="text" name="unit_price" class="form-control" id="name" placeholder="Enter a unit price"/>
                                    @error('unit_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-4">Save</button>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                    </select>
                                   
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Product Model</label>
                                    <input type="text" name="product_model" class="form-control" id="name" placeholder="Enter a product model"/>
                                    @error('product_model')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" name="product_image" class="form-control" id=""/>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div> --}}


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#company_id').change(function() {
                var company_id = $(this).val();
                if (company_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('getCategoriesByCompany') }}",
                        data: {
                            'company_id': company_id
                        },
                        dataType: "json",
                        success: function(res) {
                            if (res) {
                                $("#category_id").empty();
                                $.each(res, function(key, value) {
                                    $("#category_id").append('<option value="' + key +
                                        '">' + value + '</option>');
                                });
                            } else {
                                $("#category_id").empty();
                            }
                        }
                    });
                } else {
                    $("#category_id").empty();
                }
            });
        });
    </script>
@endsection
