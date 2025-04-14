@extends('layouts.app')
@section('title', trans('Credit Purchase'))
@section('page', trans('Create'))
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
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Forms</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Purchase</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-primary" href="{{ route('creditpurchase.index') }}"><i class="fa fa-list"></i></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr>
    <div id="stepper1" class="bs-stepper">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create New Credit Purchase</h4>
            </div>
            <div class="card-body">
                <div class="bs-stepper-content">
                    <form action="{{ route('creditpurchase.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 mt-2">
                                <label for="">Supplier Name</label>
                                <select class="select2 form-select" name="supplier_id">
                                    <option value="">Select supplier</option>
                                    @foreach ($supplier as $value)
                                        <option value="{{ $value->id }}">{{ $value->supplier_name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <input type="text" name="supplier_name" id="" class="form-control" style="height:30px;"> --}}
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Tm No</label>
                                <input type="text" name="tm_no" id="" class="form-control"
                                    style="height:30px;">
                                @error('tm_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Invoice No</label>
                                <input type="text" name="invoice_no" id="" class="form-control"
                                    style="height:30px;">
                                @error('invoice_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Rf No</label>
                                <input type="text" name="rf_no" id="" class="form-control"
                                    style="height:30px;">
                                @error('rf_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Explanation</label>
                                <input type="text" name="explanation" id="" class="form-control"
                                    style="height:30px;">
                                @error('explanation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Date</label>
                                <input type="date" name="date" id="current_date" class="form-control"
                                    style="height:30px;">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Total Quantity</label>
                                <input type="text" name="total_quantity" id="" class="form-control"
                                    style="height:30px;">
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Total Before Vat</label>
                                <input type="text" name="total_before_vat" id="" class="form-control"
                                    style="height:30px;">
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Total Tax(5%)</label>
                                <input type="text" name="total_tax" id="" class="form-control"
                                    style="height:30px;">
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Total After Vat</label>
                                <input type="text" name="total_after_vat" id="" class="form-control"
                                    style="height:30px;">
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Pay Amount</label>
                                <input type="text" name="pay_amount" id="pay_amount" class="form-control"
                                    placeholder="Enter amount">
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Due</label>
                                <input type="text" name="due_amount" id="pay_amount" class="form-control"
                                    placeholder="Enter amount">
                            </div>
                            <div class="col-sm-6 mt-2 d-flex">
                                <label for="">Credit/Cash</label>
                                <select name="credit_cash" id="credit_cash" class="form-control"
                                    style="width:100%; height:35px">
                                    <option value="1">Credit</option>
                                    <option value="2">Cash</option>
                                </select>
                            </div>
                            <div class="col-sm-6 mt-2 d-flex">
                                <label for="">Payment Status</label>
                                <select name="status" id="status" class="form-control"
                                    style="width:100%; height:35px">
                                    <option value="1">Unpaid</option>
                                    <option value="2">Due</option>
                                    <option value="3">Paid</option>
                                </select>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="">Image</label>
                                <input type="file" name="file" id="file" class="form-control"
                                    >
                            </div>
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
                    let dueAmount = totalAfterVat - payAmount;

                    $("input[name='total_tax']").val(tax.toFixed(2)); // Set tax
                    $("input[name='total_after_vat']").val(totalAfterVat.toFixed(2)); // Set total after VAT
                    $("input[name='due_amount']").val(dueAmount.toFixed(2)); // Set due amount

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
