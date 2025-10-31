@extends('layouts.app')
@section('title', 'Sale')
@section('page-title', 'Home')
@section('page-subtitle', 'Edit Sale')
@section('content')
    <style>
        thead tr th {
            background-color: #198754 !important;
            color: white !important;
        }

        .input-group-text {
            background-color: #3A58B3;
            color: white;
            width: 35%;
        }

        .star {
            color: rgb(248, 62, 62);
        }
    </style>
    <div class="ml-auto d-flex">
        <div class="btn-group ms-auto">
            <a class="btn btn-primary" href="{{ route('purchase.index') }}"><i class="fa fa-list"></i></a>
        </div>
    </div>
    <hr>
    <div id="stepper1" class="bs-stepper">
        <div class="card">
            <div class="card-body">
                <div class="bs-stepper-content">
                    <form action="{{ route('sale.update', encryptor('encrypt', $sale->id)) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('Patch')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Customer<span
                                            class="star">*</span></span>
                                    <select class="select2 form-select" width="60%" name="customer_id" style="width:60% !important;" required>
                                        <option value="">Select customer</option>
                                        @foreach ($customer as $value)
                                            <option value="{{ $value->id }}"
                                                {{ old('customer', $sale->customer_id) == $value->id ? 'selected' : '' }}>
                                                {{ $value->customer_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <label for="">Customer Name</label>
                            <select class="select2 form-select" name="customer_id">
                                <option value="">Select Customer</option>
                                @foreach ($customer as $value)
                                    <option value="{{ $value->id }}" {{old('customer',$sale->customer_id)== $value->id ? 'selected': ''}}>{{ $value->customer_name }}</option>
                                @endforeach
                            </select> --}}
                                {{-- <input type="text" name="supplier_name" id="" class="form-control" style="height:30px;"> --}}
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Tm No<span
                                            class="star">*</span></span>
                                    <input type="text" name="tm_no" id=""
                                        value="{{ old('tm_no', $sale->tm_no) }}" class="form-control" aria-label="Username"
                                        aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Reference No</span>
                                    <input type="text" name="rf_no" id=""
                                        value="{{ old('rf_no', $sale->rf_no) }}" class="form-control"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            
                            
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Explanation</span>
                                    <input type="text" name="explanation" id=""
                                        value="{{ old('explanation', $sale->explanation) }}" class="form-control"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Date<span
                                            class="star">*</span></span>
                                    <input type="date" name="date" id="current_date"
                                        value="{{ old('date', $sale->date) }}" class="form-control"
                                        aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 mt-3">
                                    <thead>
                                        <tr class="text-center">
                                            {{-- <th scope="col">{{__('Company')}}</th> --}}
                                            {{-- <th scope="col">{{__('Category')}}</th> --}}
                                            <th scope="col">{{ __('Product') }}</th>
                                            <th scope="col">{{ __('Unit Price') }}</th>
                                            <th scope="col">{{ __('Quantity') }}</th>
                                            <th scope="col">{{ __('Amount') }}</th>
                                            <th scope="col">{{ __('Tax(%)') }}</th>
                                            <th scope="col">{{ __('Tax(%)-Amount') }}</th>
                                            <th scope="col">{{ __('Sub Amount') }}</th>
                                            <th scope="col">{{ __('Discount Type') }}</th>
                                            <th scope="col">{{ __('Discount') }}</th>
                                            <th scope="col">{{ __('Total Amount') }}</th>
                                            <th class="white-space-nowrap">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="purchaseHead">
                                        @foreach ($saledetail as $sdetail)
                                            <tr>
                                                {{-- <td>
                                                <select class="select2 company_id" onchange="doData(this);" name="company_id[]" readonly>
                                                    <option value="">Select Company</option>
                                                    @foreach ($company as $value)
                                                        <option value="{{ $value->id }}" {{ old('company_id', $sdetail->company_id) == $value->id ? "selected" : ""}}>{{ $value->company_name }}</option>
                                                    @endforeach
                                                </select>
                                            </td> --}}
                                                {{-- <td>
                                                @php
                                                   $company_id = $sdetail->company_id;
                                                   $category = DB::table('categories')->where('company_id',$company_id)->get();
                                                @endphp
                                                <select class="select2 category_id" onchange="doData(this);" name="category_id[]" readonly>
                                                    @foreach ($category as $value)
                                                        <option value="{{ $value->id }}" {{ old('category_id', $sdetail->category_id) == $value->id ? "selected" : ""}}>{{ $value->category_name }}</option>
                                                    @endforeach

                                                </select>
                                                <select class="select2 category_id" onchange="doData(this);" name="category_id[]">
                                                    <option value="">Select Category</option>
                                                </select> 
                                            </td> --}}
                                                <td>
                                                    @php
                                                        // $company_id = $sdetail->company_id;
                                                        $product = DB::table('products')->get();
                                                    @endphp
                                                    <select class="select2" width="100%" name="product_id[]">
                                                        @foreach ($product as $value)
                                                            <option value="{{ $value->id }}"
                                                                {{ old('product_id', $sdetail->product_id) == $value->id ? 'selected' : '' }}>
                                                                {{ $value->product_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <select class="select2 product_id" onchange="doData(this);" name="product_id[]">
                                                    <option value="">Select Product</option>
                                                </select> --}}
                                                </td>
                                                <td><input class="form-control uprice" type="text" name="unit_price[]"
                                                        value="{{ old('unit_price', $sdetail->unit_price) }}"
                                                        style="width: 80px; height:25px;"></td>
                                                <td><input class="form-control toquantity" type="text" name="quantity[]"
                                                        value="{{ old('quantity', $sdetail->quantity) }}"
                                                        style="width: 80px; height:25px;"></td>
                                                <td><input class="form-control amount" type="text" name="amount[]"
                                                        value="{{ old('amount', $sdetail->amount) }}"
                                                        style="width: 100px; height:25px;"></td>
                                                <td><input class="form-control totax" type="text" name="tax[]"
                                                        value="{{ old('tax', $sdetail->tax) }}"
                                                        style="width: 80px; height:25px;"></td>
                                                <td><input class="form-control totax_amount" type="text"
                                                        name="tax_amount[]"
                                                        value="{{ old('tax_amount', $sdetail->tax_amount) }}"
                                                        style="width: 80px; height:25px;"></td>
                                                <td><input class="form-control subamount" type="text"
                                                        name="sub_amount[]"
                                                        value="{{ old('sub_amount', $sdetail->sub_amount) }}"
                                                        style="width: 100px; height:25px;"></td>
                                                <td>
                                                    <select name="discount_type[]" id=""
                                                        class="select2 form-control discount_type p-0 text-center"
                                                        style="width: 80px; height:25px;">
                                                        <option value="1"
                                                            @if (old('discount_type', $sdetail->discount_type) == 1) selected @endif>%</option>
                                                        <option value="0"
                                                            @if (old('discount_type', $sdetail->discount_type) == 0) selected @endif>Fixed</option>
                                                    </select>
                                                </td>
                                                <td><input class="form-control todiscount" type="text"
                                                        name="discount[]"
                                                        value="{{ old('discount', $sdetail->discount) }}"
                                                        style="width: 80px; height:25px;"></td>
                                                <td><input class="form-control toamount" type="text"
                                                        name="total_amount[]"
                                                        value="{{ old('total_amount', $sdetail->total_amount) }}"
                                                        style="width: 100px; height:25px;"></td>
                                                <td>
                                                    {{--  <span onClick='removeRow(this);' class="delete-row text-danger"><i class="bi bi-trash-fill"></i></span>  --}}
                                                    <span onClick='addRow();' class="add-row text-primary"><i
                                                            class="fa fa-plus"></i></span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th colspan="2">Total</th>
                                        <th><span class="total_unitprice" id="total_unitprice"></span></th>
                                        <th><span class="total_quantity" id="total_quantity"></span></th>
                                        <th><span class="total_amount" id="total_amount"></span></th>
                                        <th><span class="total_tax" id="total_tax"></span></th>
                                        <th><span class="total_tax_amount" id="total_tax_amount"></span></th>
                                        <th><span class="total_subamount" id="total_subamount"></span></th>
                                        <th></th>
                                        <th colspan=""><span class="total_discount" id="total_discount"></span></th>
                                        <th colspan="2"><span class="grand_total_amount"
                                                id="grand_total_amount"></span></th>



                                        <input type="hidden" name="total_quantity" id="total_quantity_hidden">
                                        <input type="hidden" name="total_quantity_amount"
                                            id="total_quantity_amount_hidden">
                                        <input type="hidden" name="total_discount" id="total_discount_hidden">
                                        <input type="hidden" name="total_tax" id="total_tax_hidden">
                                        <input type="hidden" name="total_tax_amount" id="total_tax_amount_hidden">
                                        <input type="hidden" name="total_subamount" id="total_subamount_hidden">
                                        <input type="hidden" name="grand_total_amount" id="grand_total_amount_hidden">
                                    </tfoot>
                                </table>
                            </div>

                            <div class="col-sm-4 mt-3 d-flex">
                                <input type="text" name="paid" id="paid"
                                    value="{{ old('paid', $sale->paid) }}" class="form-control"
                                    placeholder="Enter amount">
                            </div>
                            <div class="col-sm-4 mt-3 d-flex">
                                <select name="status" id="status" class="form-control">
                                    <option value="1" @if (old('status', $sale->status) == 1) selected @endif>Unpaid
                                    </option>
                                    <option value="2" @if (old('status', $sale->status) == 2) selected @endif>Due</option>
                                    <option value="3" @if (old('status', $sale->status) == 3) selected @endif>Paid</option>
                                </select>
                            </div>
                            <div class="col-sm-4 mt-3 d-flex">
                                <button type="submit" class="btn btn-primary mx-3 px-5 py-0">Save</button>
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
            // Initialize Select2
            $('.select2').select2({
                // width: '75%',
                // placeholder: "Select Product"
            });
        });
    </script>
    <script>
        // Set current date to the date input field
        document.addEventListener('DOMContentLoaded', f2nction() {
            var currentDate = new Date().toISOString().split('T')[0]; // Get current date in "YYYY-MM-DD" format
            document.getElementById('current_date').value = currentDate;
        });

        $(document).ready(function() {
            function updateStatus() {
                var amount = parseFloat($('#paid').val());
                var grandTotal = parseFloat($('#grand_total_amount').text());

                // Ensure the amount is a valid number before comparison
                if (!isNaN(amount) && amount > 0 && amount < grandTotal) {
                    $('#status').val('2'); // Change status to "Due"
                } else if (!isNaN(amount) && amount === grandTotal) {
                    $('#status').val('3'); // Change status to "Paid"
                } else {
                    $('#status').val('1'); // Change status to "Unpaid"
                }
            }

            // Trigger the check on page load to set the correct status initially
            updateStatus();

            // Trigger the check when the input value changes
            $('#paid').on('input', updateStatus);
        });
    </script>
    <script>
        $(document).ready(function() {
            // Function to calculate amount, subamount, total amount, and other values
            function calculateAmounts() {
                $('#purchaseHead tr').each(function() {
                    var row = $(this);
                    var unitPrice = parseFloat(row.find('.uprice').val()) || 0;
                    var quantity = parseFloat(row.find('.toquantity').val()) || 0;
                    var tax = parseFloat(row.find('.totax').val()) || 0;
                    var tax_amount = parseFloat(row.find('.totax_amount').val()) || 0;
                    var discountType = row.find('.discount_type').val();
                    var discount = parseFloat(row.find('.todiscount').val()) || 0;

                    var amount = unitPrice * quantity;
                    var tax_amount = amount * tax / 100;
                    var subAmount = amount + (amount * tax / 100);
                    var totalAmount;

                    if (discountType == 1) { // Percentage discount
                        totalAmount = subAmount - (subAmount * discount / 100);
                    } else if (discountType == 0) { // Fixed discount
                        totalAmount = subAmount - discount;
                    } else {
                        totalAmount = subAmount;
                    }

                    row.find('.amount').val(amount.toFixed(2));
                    row.find('.totax_amount').val(tax_amount.toFixed(2));
                    row.find('.subamount').val(subAmount.toFixed(2));
                    row.find('.toamount').val(totalAmount.toFixed(2));
                });
                // Recalculate total values
                calculateTotalUnitPrice();
                calculateTotalQuantity();
                calculateTotalAmount();
                calculateTotalTax();
                calculateTotalSubAmount();
                calculateTotalDiscount();
                calculateGrandTotalAmount();
                calculateTotalTaxAmount();
            }

            // Add event listeners for input changes
            $(document).on('input',
                '#purchaseHead .uprice, #purchaseHead .toquantity, #purchaseHead .totax, #purchaseHead .totax_amount, #purchaseHead .todiscount, #purchaseHead .discount_type',
                function() {
                    calculateAmounts();
                });

            // Initial calculation when the page is loaded
            calculateAmounts();
        });



        // Function to calculate total unit price
        function calculateTotalUnitPrice() {
            let totalUnitPrice = 0;
            $('#purchaseHead .uprice').each(function() {
                const unitPrice = parseFloat($(this).val()) || 0;
                totalUnitPrice += unitPrice;
            });
            $('#total_unitprice').text(totalUnitPrice.toFixed(2));
        }

        // Function to calculate total quantity
        function calculateTotalQuantity() {
            let totalQuantity = 0;
            $('#purchaseHead .toquantity').each(function() {
                const quantity = parseFloat($(this).val()) || 0;
                totalQuantity += quantity;
            });
            $('#total_quantity').text(totalQuantity);
            $('[name="total_quantity"]').val(totalQuantity); // Update hidden input field
        }

        // Function to calculate total amount
        function calculateTotalAmount() {
            let totalAmount = 0;
            $('#purchaseHead .amount').each(function() {
                const amount = parseFloat($(this).val()) || 0;
                totalAmount += amount;
            });
            $('#total_amount').text(totalAmount.toFixed(2));
            $('[name="total_quantity_amount"]').val(totalAmount.toFixed(2));
        }

        // Function to calculate total tax
        function calculateTotalTax() {
            let totalTax = 0;
            $('#purchaseHead .totax').each(function() {
                const tax = parseFloat($(this).val()) || 0;
                totalTax += tax;
            });
            $('#total_tax').text(totalTax);
            $('[name="total_tax"]').val(totalTax); // Update hidden input field
        }

        function calculateTotalTaxAmount() {
            let totalTaxAmount = 0;
            $('#purchaseHead .totax_amount').each(function() {
                const tax_amount = parseFloat($(this).val()) || 0;
                totalTaxAmount += tax_amount;
            });
            $('#total_tax_amount').text(totalTaxAmount.toFixed(2));
            $('[name="total_tax_amount"]').val(totalTaxAmount.toFixed(2)); // Update hidden input field
        }

        // Function to calculate total sub amount
        function calculateTotalSubAmount() {
            let totalSubAmount = 0;
            $('#purchaseHead .subamount').each(function() {
                const subAmount = parseFloat($(this).val()) || 0;
                totalSubAmount += subAmount;
            });
            $('#total_subamount').text(totalSubAmount.toFixed(2));
            $('[name="total_subamount"]').val(totalSubAmount.toFixed(2)); // Update hidden input field
        }

        // Function to calculate total discount
        function calculateTotalDiscount() {
            let totalDiscount = 0;
            $('#purchaseHead tr').each(function() {
                var row = $(this);
                var discountType = row.find('.discount_type').val();
                var discount = parseFloat(row.find('.todiscount').val()) || 0;

                if (discountType === '1') { // Percentage discount
                    var unitPrice = parseFloat(row.find('.uprice').val()) || 0;
                    var quantity = parseFloat(row.find('.toquantity').val()) || 0;
                    var amount = unitPrice * quantity;
                    var tax = parseFloat(row.find('.totax').val()) || 0;
                    var subAmount = amount + (amount * tax / 100);
                    totalDiscount += subAmount * discount / 100;
                } else if (discountType === '0') { // Fixed discount
                    totalDiscount += discount;
                }
            });
            $('#total_discount').text(totalDiscount.toFixed(2));
            $('[name="total_discount"]').val(totalDiscount.toFixed(2)); // Update hidden input field
        }


        // Function to calculate grand total amount
        function calculateGrandTotalAmount() {
            let grandTotalAmount = 0;
            $('#purchaseHead .toamount').each(function() {
                const totalAmount = parseFloat($(this).val()) || 0;
                grandTotalAmount += totalAmount;
            });
            $('#grand_total_amount').text(grandTotalAmount.toFixed(2));
            $('[name="grand_total_amount"]').val(grandTotalAmount.toFixed(2)); // Update hidden input field
        }

        // Function to add a new row
        function addRow() {
            var row = `<tr>
                        {{-- <td>
                            <select class="select2 company_id" onchange="doData(this);" name="company_id[]">
                                <option value="">Select Company</option>
                                @foreach ($company as $value)
                                    <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="select2 category_id" onchange="doData(this);" name="category_id[]">
                                <option value="">Select Category</option>
                            </select>
                        </td> --}}
                        <td>
                            <select class="select2 product_id"  name="product_id[]">
                                <option value="">Select Product</option>
                                @foreach ($product as $value)
                                    <option value="{{ $value->id }}" data-price="{{ $value->cost_unit_price }}">{{ $value->product_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input class="form-control uprice" type="text" name="unit_price[]" style="width: 80px; height:25px;"></td>
                        <td><input class="form-control toquantity" type="text" name="quantity[]"style="width: 80px; height:25px;"></td>
                        <td><input class="form-control amount" type="text" name="amount[]" style="width: 100px; height:25px;"></td>
                        <td><input class="form-control totax" type="text" name="tax[]"style="width: 80px; height:25px;"></td>
                        <td><input class="form-control totax_amount" type="text" name="tax_amount[]"style="width: 80px; height:25px;"></td>
                        <td><input class="form-control subamount" type="text" name="sub_amount[]"style="width: 100px; height:25px;"></td>
                        <td><select name="discount_type[]" id="" class="select2 text-center p-0 form-control discount_type" style="width: 80px; height:25px;">
                                <option value="">select</option>
                                <option value="1">%</option>
                                <option value="0">Fixed</option>
                            </select>
                        </td>
                        <td><input class="form-control todiscount" type="text" name="discount[]" style="width: 80px; height:25px;"></td>
                        <td><input class="form-control toamount" type="text" name="total_amount[]" style="width: 100px; height:25px;"></td>
                        <td>
                            <span onClick='RemoveRow(this);' class="delete-row text-danger"><i class="fa fa-trash"></i></span>
                        </td>
                    </tr>`;
            $('#purchaseHead').append(row);
            $('#purchaseHead tr:last').find('.select2').select2({
                width: '100%',
                height: '35px',
                placeholder: "Select Product"
            });
        };

        function RemoveRow(e) {
            if (confirm("Are you sure you want to remove this row?")) {
                $(e).closest('tr').remove();
                calculateTotalUnitPrice();
                calculateTotalQuantity();
                calculateTotalAmount();
                calculateTotalTax();
                calculateTotalSubAmount();
                calculateTotalDiscount();
                calculateGrandTotalAmount(); // Recalculate total amount after removing row
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            // Delegate change event to a parent element
            $(document).on('change', '.company_id', function() {
                var company_id = $(this).val();
                var row = $(this).closest('tr');

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
                                var categorySelect = row.find('.category_id');
                                categorySelect.empty();
                                categorySelect.append(
                                    '<option value="">Select Category</option>');
                                $.each(res, function(key, value) {
                                    categorySelect.append('<option value="' + key +
                                        '">' + value + '</option>');
                                });
                            }
                        }
                    });
                } else {
                    row.find('.category_id').empty();
                    row.find('.product_id').empty();
                }
            });

            // $(document).on('change', '.category_id', function() {
            //     var category_id = $(this).val();
            //     var row = $(this).closest('tr');
            //     var company_id = row.find('.company_id').val();

            //     if(category_id && company_id) {
            //         $.ajax({
            //             type: "GET",
            //             url: "{{ route('getProductsByCategoryAndCompany') }}",
            //             data: {'category_id': category_id, 'company_id': company_id},
            //             dataType: "json",
            //             success: function(res) {
            //                 if(res) {
            //                     var productSelect = row.find('.product_id');
            //                     productSelect.empty();
            //                     productSelect.append('<option value="">Select product</option>');
            //                     $.each(res, function(key, value) {
            //                         productSelect.append('<option value="'+ key +'">'+ value + '</option>');
            //                     });
            //                 }
            //             }
            //         });
            //     } else {
            //         row.find('.product_id').empty();
            //     }
            // });
            // $(document).on('change', '.category_id', function() {
            //     var category_id = $(this).val();
            //     var row = $(this).closest('tr');
            //     var company_id = row.find('.company_id').val();

            //     if(category_id && company_id) {

            //     console.log('Category ID:', category_id, 'Company ID:', company_id);
            //         $.ajax({
            //             type: "GET",
            //             url: "{{ route('getProductsByCategoryAndCompany') }}",
            //             data: {'category_id': category_id, 'company_id': company_id},
            //             dataType: "json",
            //             success: function(res) {
            //                 console.log('Product Response:', res);
            //                 if(res) {
            //                     var productSelect = row.find('.product_id');
            //                     productSelect.empty();
            //                     productSelect.append('<option value="">Select product</option>');
            //                     $.each(res, function(key, value) {
            //                         // Fetch stock information for each product
            //                         $.ajax({
            //                             type: "GET",
            //                             url: "{{ route('getStockByProduct') }}",
            //                             data: {'product_id': key},
            //                             dataType: "json",
            //                             success: function(stock) {
            //                                 var stockText = stock ? ' (Stock: ' + stock.quantity + ')' : '';
            //                                 productSelect.append('<option value="'+ key +'">'+ value + stockText +'</option>');

            //                             }
            //                         });
            //                     });
            //                 }
            //             }
            //         });
            //     } else {
            //         row.find('.product_id').empty();
            //     }
            // });

            // $(document).on('change', '.category_id', function() {
            //     var category_id = $(this).val();
            //     var row = $(this).closest('tr');
            //     var company_id = row.find('.company_id').val();

            //     if(category_id && company_id) {
            //         console.log('Category ID:', category_id, 'Company ID:', company_id);
            //         $.ajax({
            //             type: "GET",
            //             url: "{{ route('getProductsByCategoryAndCompany') }}",
            //             data: {'category_id': category_id, 'company_id': company_id},
            //             dataType: "json",
            //             success: function(res) {
            //                 console.log('Product Response:', res);
            //                 if(res) {
            //                     var productSelect = row.find('.product_id');
            //                     productSelect.empty();
            //                     productSelect.append('<option value="">Select product</option>');
            //                     $.each(res, function(key, value) {
            //                         // Fetch stock information for each product
            //                         $.ajax({
            //                             type: "GET",
            //                             url: "{{ route('salegetStockByProduct') }}",
            //                             data: {'product_id': key},
            //                             dataType: "json",
            //                             success: function(stock) {
            //                                 console.log('Product Response:', stock);
            //                                 var stockText = stock ? ' (Stock: ' + stock.quantity + ')' : '';
            //                                 productSelect.append('<option value="'+ key +'">'+ value + stockText +'</option>');

            //                             }
            //                         });
            //                     });
            //                 }
            //             }
            //         });
            //     } else {
            //         row.find('.product_id').empty();
            //     }
            // });


            $(document).on('change', '.category_id', function() {
                var category_id = $(this).val();
                var row = $(this).closest('tr');
                var company_id = row.find('.company_id').val();

                if (category_id && company_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('getProductsByCategoryAndCompany') }}",
                        data: {
                            'category_id': category_id,
                            'company_id': company_id
                        },
                        dataType: "json",
                        success: function(res) {
                            if (res) {
                                var productSelect = row.find('.product_id');
                                productSelect.empty();
                                productSelect.append(
                                '<option value="">Select product</option>');
                                $.each(res, function(key, value) {
                                    var stockQuantity = value.match(
                                    /\((\d+)\)/); // Extract stock quantity from parentheses
                                    var stock = stockQuantity ? parseInt(stockQuantity[
                                        1]) : 0;

                                    if (stock <=
                                        5) { // Highlight products with low stock in red
                                        productSelect.append('<option value="' + key +
                                            '" style="color:red;" data-stock="' +
                                            stock + '">' + value + '</option>');
                                    } else {
                                        productSelect.append('<option value="' + key +
                                            '" data-stock="' + stock + '">' +
                                            value + '</option>');
                                    }
                                });
                            }
                        }
                    });
                } else {
                    row.find('.product_id').empty();
                }
            });

            // Check stock on product selection
            $(document).on('change', '.product_id', function() {
                var selectedOption = $(this).find('option:selected'); // Get the selected product option
                var stock = selectedOption.data('stock'); // Get the stock value from data attribute

                if (stock === 0) {
                    alert("This product is out of stock and cannot be selected.");
                    $(this).val(''); // Reset the selection
                }
            });



        });
    </script>

@endsection
