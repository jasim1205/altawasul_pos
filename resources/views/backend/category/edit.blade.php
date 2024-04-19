@extends('layouts.app')
@section('title',trans('Category'))
@section('page',trans('Edit'))
@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Forms</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Add New Category</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a class="btn btn-primary" href="{{route('category.index')}}"><i class="fa fa-list"></i></a>
        </div>
    </div>
</div>
<!--end breadcrumb-->
<!--start stepper one--> 
<h6 class="text-uppercase">Category</h6>
<hr>
<div id="stepper1" class="bs-stepper">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New</h4>
        </div>
        <div class="card-body">
            <div class="bs-stepper-content">
                <form action="{{route('category.update',encryptor('encrypt',$category->id))}}" method="post">
                        @csrf
                        @method('Patch')
                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                        <div class="row g-3">
                            <div class="col-12 col-lg-6">
                                <label for="FisrtName" class="form-label">Company Name</label>
                                <select name="company_id" id="" class="form-control">
                                    <option value="">Select Company</option>
                                    @foreach ($company as $value)
                                        <option value="{{ $value->id }}" {{ old('company_id',$category->company_id)==$value->id?"selected":""}}>{{ $value->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" name="category_name" value="{{ old('category_name',$category->category_name) }}" class="form-control" id="name" placeholder="Enter a Category name"/>
                            </div>
                            <div class="col-12 col-lg-6">
                                <button type="submit" class="btn btn-primary px-4">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stepper one--> 



{{-- <div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Category</h3>
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
                    Edit
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
                    <form action="{{route('category.update',encryptor('encrypt',$category->id))}}" method="post">
                        @csrf
                        @method('Patch')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Company Name</label>
                                    <select name="company_id" id="" class="form-control">
                                        <option value="">Select Company</option>
                                        @foreach ($company as $value)
                                            <option value="{{ $value->id }}" {{ old('company_id',$category->company_id)==$value->id?"selected":""}}>{{ $value->company_name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" name="category_name" value="{{ old('category_name',$category->category_name) }}" class="form-control" id="name" placeholder="Enter a Category name"/>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4">Save</button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div> --}}
@endsection