@extends('layouts.app')
@section('title', 'Customer')
@section('page-title', 'Home')
@section('page-subtitle', 'Edit Customer')
@section('content')
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
                    <form action="{{ route('customer.update', encryptor('encrypt', $customer->id)) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Customer Name <span
                                                class="star">*</span></span>
                                        <input type="text" class="form-control" name="customer_name"
                                            value="{{ old('customer_name', $customer->customer_name) }}"
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
                                        <input type="email;" name="email" value="{{ old('email', $customer->email) }}"
                                            class="form-control" id="name" placeholder="Enter a customer Email" />
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Customer Phone</span>
                                        <input type="text" name="contact_no"
                                            value="{{ old('contact_no', $customer->contact_no) }}" class="form-control"
                                            id="name" placeholder="Enter a customer contact" />
                                        @error('contact_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Address</span>
                                        <input type="text" name="address" value="{{ old('address', $customer->address) }}"
                                            class="form-control" id="name" placeholder="Enter a customer address" />
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
