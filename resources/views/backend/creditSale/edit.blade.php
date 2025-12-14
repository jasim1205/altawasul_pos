@extends('layouts.app')
@section('title', 'Credit Sale')
@section('page-title', 'Home')
@section('page-subtitle', 'Credit Sale Edit')
@section('content')
    <style>
        .form-control {
            height: 35px;
            border-color: black
        }

        .form-select {
            height: 30px;
            border-color: black
        }

        label {
            font-weight: bold
        }
    </style>
    
    <hr>
    <div id="stepper1" class="bs-stepper">
        <div class="card">
            <div class="card-body">
                <div class="bs-stepper-content">
                    <form action="{{ route('creditsale.update',encryptor('encrypt',$creditSale->id)) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('Patch')
                        <div class="row">
                            <div class="col-sm-6 mt-2">
                                <label for="">Customer Name</label>
                                <select class="select2 form-select" name="customer_id">
                                    <option value="">Select Customer</option>
                                    @foreach ($customer as $value)
                                        <option value="{{ $value->id }}" {{ old('customer_id',$creditSale->customer_id==$value->id?"selected":"") }}>{{ $value->customer_name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <input type="text" name="supplier_name" id="" class="form-control" style="height:30px;"> --}}
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">TRN No</label>
                                <input type="text" name="trn_no" value="{{old('trn_no',$creditSale->trn_no)}}" id="" class="form-control"
                                    style="height:30px;">
                                @error('tm_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="col-sm-6 mt-2">
                                <label for="">Invoice No</label>
                                <input type="text" name="invoice_no" value="{{old('invoice_no',$creditSale->invoice_no)}}" id="" class="form-control"
                                    style="height:30px;">
                                @error('invoice_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            <div class="col-sm-6 mt-2">
                                <label for="">Rf No</label>
                                <input type="text" name="rf_no" value="{{old('rf_no',$creditSale->rf_no)}}" id="" class="form-control"
                                    style="height:30px;">
                                @error('rf_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="col-sm-6 mt-2">
                                <label for="">Explanation</label>
                                <input type="text" name="explanation" value="{{old('explanation',$creditSale->explanation)}}" id="" class="form-control"
                                    style="height:30px;">
                                @error('explanation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            <div class="col-sm-6 mt-2">
                                <label for="">Date</label>
                                <input type="date" name="date" value="{{old('date',$creditSale->date)}}" id="current_date" class="form-control"
                                    style="height:30px;">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="col-sm-6 mt-2">
                                <label for="">Total Quantity</label>
                                <input type="text" name="total_quantity" value="{{old('total_quantity',$creditSale->total_quantity)}}" id="" class="form-control"
                                    style="height:30px;">
                            </div> --}}
                            <div class="col-sm-6 mt-2">
                                <label for="">Total Before Vat</label>
                                <input type="text" name="total_before_vat" value="{{old('total_before_vat',$creditSale->total_before_vat)}}" id="" class="form-control"
                                    style="height:30px;">
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Total Tax(5%)</label>
                                <input type="text" name="total_tax" value="{{old('total_tax',$creditSale->total_tax)}}" id="" class="form-control"
                                    style="height:30px;">
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Total After Vat</label>
                                <input type="text" name="total_after_vat" value="{{old('total_after_vat',$creditSale->total_after_vat)}}"  id="" class="form-control"
                                    style="height:30px;">
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Pay Amount</label>
                                <input type="text" name="pay_amount" value="{{old('pay_amount',$creditSale->pay_amount)}}"  id="pay_amount" class="form-control"
                                    placeholder="Enter amount">
                            </div>
                            {{-- <div class="col-sm-6 mt-2">
                                <label for="">Due</label>
                                <input type="text" name="due_amount" value="{{old('due_amount',$creditSale->due_amount)}}" id="pay_amount" class="form-control"
                                    placeholder="Enter amount">
                            </div> --}}
                            
                            <div class="col-sm-6 mt-2 d-flex">
                                <label for="">Credit/Cash</label>
                                <select name="credit_cash" id="credit_cash" class="form-control"
                                    style="width:100%; height:35px">
                                    <option value="1" @if(old('credit_cash',$creditSale->credit_cash)==1) selected @endif>Credit</option>
                                    <option value="2" @if(old('credit_cash',$creditSale->credit_cash)==2) selected @endif>Cash</option>
                                </select>
                            </div>
                            {{-- <div class="col-sm-6 mt-2 d-flex">
                                <label for="">Payment Status</label>
                                <select name="status" id="status" class="form-control"
                                    style="width:100%; height:35px">
                                    <option value="1" @if(old('status',$creditSale->status)==1) selected @endif>Unpaid</option>
                                    <option value="2" @if(old('status',$creditSale->status)==2) selected @endif>Due</option>
                                    <option value="3" @if(old('status',$creditSale->status)==3) selected @endif>Paid</option>
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
        // Set current date to the date input field
        document.addEventListener('DOMContentLoaded', function() {
            var currentDate = new Date().toISOString().split('T')[0]; // Get current date in "YYYY-MM-DD" format
            document.getElementById('current_date').value = currentDate;
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to calculate tax and total after VAT
            $(document).ready(function() {
                function calculateTax() {
                    let totalBeforeVat = parseFloat($("input[name='total_before_vat']").val()) || 0;
                    let tax = totalBeforeVat * 0.05; // 5% tax
                    let totalAfterVat = totalBeforeVat + tax;
                    let payAmount = parseFloat($("input[name='pay_amount']").val()) || 0;
                    // let dueAmount = totalAfterVat - payAmount;
                    let dueAmount = totalAfterVat;
                    $("input[name='total_tax']").val(tax.toFixed(2)); // Set tax
                    $("input[name='total_after_vat']").val(totalAfterVat.toFixed(2)); // Set total after VAT
                    $("input[name='due_amount']").val(dueAmount.toFixed(2)); // Set due amount
                    $("input[name='pay_amount']").val(dueAmount.toFixed(2)); // Set due amount

                    // Update status dropdown
                    updateStatus(payAmount, totalAfterVat);
                }

                function updateStatus(payAmount, totalAfterVat) {
                    if (payAmount === 0 || isNaN(payAmount)) {
                        $("#status").val(1); // Unpaid
                    } else if (payAmount < totalAfterVat) {
                        $("#status").val(2); // Due
                    } else if (payAmount === totalAfterVat) {
                        $("#status").val(3); // Paid
                    }
                }

                // Trigger calculation when Total Before VAT or Pay Amount changes
                $("input[name='total_before_vat'], input[name='pay_amount']").on("input", function() {
                    calculateTax();
                });
            });

        });
    </script>


@endsection
