@extends('layouts.app')
@section('title', 'Customer')
@section('page-title', 'Home')
@section('page-subtitle', 'Create Customer')
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
        <a class="btn btn-primary" href="{{ route('customer.index') }}"><i class="fa fa-list"></i></a>
    </div>
</div>
<hr>
<div id="stepper1" class="bs-stepper">
    <div class="card">
        <div class="card-body">
            <div class="bs-stepper-content">
                <form action="{{route('customer.store')}}" method="post">
                        @csrf
                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Customer Name <span
                                            class="star">*</span></span>
                                    <input type="text" class="form-control" name="customer_name"
                                        placeholder="Enter a customer name" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                    @error('customer_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Customer Email</span>
                                    <input type="email;" name="email" class="form-control" id="name"
                                        placeholder="Enter a Customer Email" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Customer Phone</span>
                                    <input type="text" name="contact_no" class="form-control" id="name"
                                        placeholder="Enter a Customer contact" />
                                    @error('contact_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Customer Address</span>
                                    <input type="text" name="address" class="form-control" id="name"
                                        placeholder="Enter a Customer address" />
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
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