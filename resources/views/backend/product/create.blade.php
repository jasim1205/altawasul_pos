@extends('layouts.app')
@section('title',trans('Product'))
@section('page',trans('Create'))
@section('content')
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
                                    {{-- <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($category as $value)
                                            <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                                        @endforeach
                                    </select> --}}
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
</div>


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