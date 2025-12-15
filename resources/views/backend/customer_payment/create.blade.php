@extends('layouts.app')
@section('title', 'Customer Payment')
@section('page-title', 'Home')
@section('page-subtitle', 'Customer Payment Create')
@section('content')
    <style>
        .form-control {
            height: 35px;
            border-color: black
        }

        .form-select {
            /* height: 30px; */
            border-color: black
        }

        label {
            font-weight: bold
        }
    </style>
    
    <div id="stepper1" class="bs-stepper">
        <div class="card">
            {{-- <div class="card-header">
                <h4 class="card-title">Create New Credit Purchase</h4>
            </div> --}}
            <div class="card-body">
                <div class="bs-stepper-content">
                    <form action="{{ route('customerpayment.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 mt-2">
                                <label for="">Customer Name</label>
                                <select class="select2 form-select" name="customer_id">
                                    <option value="">Select customer</option>
                                    @foreach ($customer as $value)
                                        <option value="{{ $value->id }}">{{ $value->customer_name }}-{{ $value->contact_no }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        
                            <div class="col-sm-6 mt-2">
                                <label for="">Amount</label>
                                <input type="text" name="amount" id="" class="form-control"
                                    placeholder="Enter Amount">
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Payment Method</label>
                                <select name="payment_method" id="" class="form-select">
                                    <option value="">Select Payment Method</option>
                                    <option value="Cash">Cash</option>
                                    <option value="bank">Bank</option>
                                </select>
                                {{-- <input type="text" name="payment_method" id="" class="form-control"
                                    placeholder="Enter Payment Method"> --}}
                            </div>
                            {{-- <div class="col-sm-6 mt-2 d-flex">
                                <label for="">Credit/Cash</label>
                                <select name="credit_cash" id="credit_cash" class="form-control"
                                    style="width:100%; height:35px">
                                    <option value="1">Credit</option>
                                    <option value="2">Cash</option>
                                </select>
                            </div> --}}
                            <div class="col-sm-6 mt-3 d-flex">
                                <button type="submit" class="btn btn-primary  px-5">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                // width: '75%',
                placeholder: "Select Customer",
            });
        });
    </script>
@endsection
