@extends('layouts.app')
@section('title',trans('Customer'))
@section('page',trans('List'))
@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Forms</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Add New Supplier</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a class="btn btn-primary" href="{{route('customer.index')}}"><i class="fa fa-list"></i></a>
        </div>
    </div>
</div>
<!--end breadcrumb-->
<!--start stepper one--> 
<h6 class="text-uppercase">Supplier</h6>
<hr>
<div id="stepper1" class="bs-stepper">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New</h4>
        </div>
        <div class="card-body">
            <div class="bs-stepper-content">
                <form action="{{route('customer.store')}}" method="post">
                        @csrf
                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                        <div class="row g-3">
                            <div class="col-12 col-lg-6">
                                <label for="FisrtName" class="form-label">Customer Name</label>
                                <input type="text" name="customer_name" class="form-control" id="name" placeholder="Enter a Customer name"/>
                                @error('customer_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="name" class="form-label">Customer Email</label>
                                <input type="email;" name="email" class="form-control" id="name" placeholder="Enter a Customer Email"/>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="name" class="form-label">Customer Phone</label>
                                <input type="text" name="contact_no" class="form-control" id="name" placeholder="Enter a Customer contact"/>
                                @error('contact_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="name" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" id="name" placeholder="Enter a Customer name"/>
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
@endsection