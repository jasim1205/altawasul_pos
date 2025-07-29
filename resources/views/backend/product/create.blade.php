@extends('layouts.app')
@section('title',trans('Product'))
@section('page',trans('Create'))
@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Forms</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a class="btn btn-primary" href="{{route('product.index')}}"><i class="fa fa-list"></i></a>
        </div>
    </div>
</div>
<!--end breadcrumb-->
<!--start stepper one--> 
<h6 class="text-uppercase">Product</h6>
<hr>
<div id="stepper1" class="bs-stepper">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New</h4>
        </div>
        <div class="card-body">
            <div class="bs-stepper-content">
                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                        <div class="row g-3">
                            <div class="col-12 col-lg-6">
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
                            </div>
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
                            </div>--}}
                            <div class="col-12 col-lg-6">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control" id="" placeholder="Enter a product name"/>
                                @error('product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label">Old Price</label>
                                <input type="text" name="old_price" class="form-control" id="" placeholder="Enter a unit price"/>
                                @error('old_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label">Unit Price</label>
                                <input type="text" name="unit_price" class="form-control" id="" placeholder="Enter a unit price"/>
                                @error('unit_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                               <label for="name" class="form-label">Product Model</label>
                                <input type="text" name="product_model" class="form-control" id="" placeholder="Enter a product model"/>
                                @error('product_model')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label">Image</label>
                                <input type="file" name="product_image" class="form-control" id=""/>
                            </div>
                            <div class="col-12 col-lg-6">
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
            if(company_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('getCategoriesByCompany') }}",
                    data: {'company_id': company_id},
                    dataType: "json",
                    success: function(res) {
                        if(res) {
                            $("#category_id").empty();
                            $.each(res, function(key, value) {
                                $("#category_id").append('<option value="'+ key +'">'+ value +'</option>');
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