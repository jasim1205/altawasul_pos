@extends('layouts.app')
@section('title',trans('Purchase'))
@section('page',trans('Create'))
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Forms</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Add New Sale</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a class="btn btn-primary" href="{{route('sale.index')}}"><i class="fa fa-list"></i></a>
        </div>
    </div>
</div>
<!--end breadcrumb-->

<hr>
<div id="stepper1" class="bs-stepper">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create New sale</h4>
        </div>
        <div class="card-body">
            <div class="bs-stepper-content">
                <form action="{{route('sale.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="">Supplier Name</label>
                            <input type="text" name="customer_name" id="" class="form-control" style="height:30px;">
                        </div>
                        <div class="col-sm-3">
                            <label for="">Email</label>
                            <input type="text" name="email" id="" class="form-control" style="height:30px;">
                        </div>
                        <div class="col-sm-3">
                            <label for="">Contact</label>
                            <input type="text" name="contact_no" id="" class="form-control" style="height:30px;">
                        </div>
                        <div class="col-sm-3">
                            <label for="">Date</label>
                            <input type="date" name="date" id="current_date" class="form-control" style="height:30px;">
                        </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 mt-3">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">{{__('Company')}}</th>
                                            <th scope="col">{{__('Category')}}</th>
                                            <th scope="col">{{__('Product')}}</th>
                                            <th scope="col">{{__('Unit Price')}}</th>
                                            <th scope="col">{{__('Quantity')}}</th>
                                            <th scope="col">{{__('Amount')}}</th>
                                            <th scope="col">{{__('Tax(%)')}}</th>
                                            <th scope="col">{{__('Sub Amount')}}</th>
                                            <th scope="col">{{__('Discount Type')}}</th>
                                            <th scope="col">{{__('Discount')}}</th>
                                            <th scope="col">{{__('Total Amount')}}</th>
                                            <th class="white-space-nowrap">{{__('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="purchaseHead">
                                        <tr>
                                            <td>
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
                                            </td>
                                            <td>
                                                <select class="select2 product_id" onchange="doData(this);" name="product_id[]">
                                                    <option value="">Select Product</option>
                                                </select>
                                            </td>
                                            <td><input class="form-control uprice" type="text" name="unit_price[]" style="width: 80px; height:25px;"></td>
                                            <td><input class="form-control toquantity" type="text" name="quantity[]" style="width: 80px; height:25px;"></td>
                                            <td><input class="form-control amount" type="text" name="amount[]" style="width: 100px; height:25px;"></td>
                                            <td><input class="form-control totax"  type="text" name="tax[]" style="width: 80px; height:25px;"></td>
                                            <td><input class="form-control subamount" type="text" name="sub_amount[]" style="width: 100px; height:25px;"></td>
                                            <td><select name="discount_type[]" id="" class="form-control discount_type p-0 text-center" style="width: 80px; height:25px;">
                                                <option value="">select</option>
                                                <option value="1">%</option>
                                                <option value="0">Fixed</option>
                                            </select></td>
                                            <td><input class="form-control todiscount" type="text" name="discount[]" style="width: 80px; height:25px;"></td>
                                            <td><input class="form-control toamount" type="text" name="total_amount[]" style="width: 100px; height:25px;"></td>
                                            <td>
                                                {{--  <span onClick='removeRow(this);' class="delete-row text-danger"><i class="bi bi-trash-fill"></i></span>  --}}
                                                <span onClick='addRow();' class="add-row text-primary"><i class="fa fa-plus"></i></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <th colspan="3">Total</th>
                                        <th><span class="total_unitprice" id="total_unitprice" ></span></th>
                                        <th><span class="total_quantity" id="total_quantity" ></span></th>
                                        <th><span class="total_amount" id="total_amount"></span></th>
                                        <th><span class="total_tax" id="total_tax"></span></th>
                                        <th><span class="total_subamount" id="total_subamount"></span></th>
                                        <th></th>
                                        <th colspan=""><span class="total_discount" id="total_discount"></span></th>
                                        <th colspan="2"><span class="grand_total_amount" id="grand_total_amount"></span></th>
                                        


                                        <input type="hidden" name="total_quantity" id="total_quantity_hidden">
                                        <input type="hidden" name="total_quantity_amount" id="total_quantity_amount_hidden">
                                        <input type="hidden" name="total_discount" id="total_discount_hidden">
                                        <input type="hidden" name="total_tax" id="total_tax_hidden">
                                        <input type="hidden" name="total_subamount" id="total_subamount_hidden">
                                        <input type="hidden" name="grand_total_amount" id="grand_total_amount_hidden">
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-sm-8 mt-3 d-flex">
                                <select name="status" id="" class="form-control" style="width:100%; height:35px">
                                    <option value="1">Unpaid</option>
                                    <option value="2">Paid</option>
                                </select>
                                <button type="submit" class="btn btn-primary mx-3 px-5">Save</button>
                            </div>
                            <div>
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
    // Function to calculate amount, subamount, total amount, and other values
    function calculateAmounts() {
        $('#purchaseHead tr').each(function() {
            var row = $(this);
            var unitPrice = parseFloat(row.find('.uprice').val()) || 0;
            var quantity = parseFloat(row.find('.toquantity').val()) || 0;
            var tax = parseFloat(row.find('.totax').val()) || 0;
            var discountType = row.find('.discount_type').val();
            var discount = parseFloat(row.find('.todiscount').val()) || 0;
            
            var amount = unitPrice * quantity;
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
        }

        // Add event listeners for input changes
        $(document).on('input', '#purchaseHead .uprice, #purchaseHead .toquantity, #purchaseHead .totax, #purchaseHead .todiscount, #purchaseHead .discount_type', function() {
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
                        <td>
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
                        </td>
                        <td>
                            <select class="select2 product_id" onchange="doData(this);" name="product_id[]">
                                <option value="">Select Product</option>
                            </select>
                        </td>
                        <td><input class="form-control uprice" type="text" name="unit_price[]" style="width: 80px; height:25px;"></td>
                        <td><input class="form-control toquantity" type="text" name="quantity[]"style="width: 80px; height:25px;"></td>
                        <td><input class="form-control amount" type="text" name="amount[]" style="width: 100px; height:25px;"></td>
                        <td><input class="form-control totax" type="text" name="tax[]"style="width: 80px; height:25px;"></td>
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

        if(company_id) {
            $.ajax({
                type: "GET",
                url: "{{ route('getCategoriesByCompany') }}",
                data: {'company_id': company_id},
                dataType: "json",
                success: function(res) {
                    if(res) {
                        var categorySelect = row.find('.category_id');
                        categorySelect.empty();
                        categorySelect.append('<option value="">Select Category</option>');
                        $.each(res, function(key, value) {
                            categorySelect.append('<option value="'+ key +'">'+ value +'</option>');
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
    $(document).on('change', '.category_id', function() {
    var category_id = $(this).val();
    var row = $(this).closest('tr');
    var company_id = row.find('.company_id').val();

    if(category_id && company_id) {
        $.ajax({
            type: "GET",
            url: "{{ route('getProductsByCategoryAndCompany') }}",
            data: {'category_id': category_id, 'company_id': company_id},
            dataType: "json",
            success: function(res) {
                if(res) {
                    var productSelect = row.find('.product_id');
                    productSelect.empty();
                    productSelect.append('<option value="">Select product</option>');
                    $.each(res, function(key, value) {
                        // Fetch stock information for each product
                        $.ajax({
                            type: "GET",
                            url: "{{ route('salegetStockByProduct') }}",
                            data: {'product_id': key},
                            dataType: "json",
                            success: function(stock) {
                                var stockText = stock ? ' (Stock: ' + stock.quantity + ')' : '';
                                productSelect.append('<option value="'+ key +'">'+ value + stockText +'</option>');
                                
                            }
                        });
                    });
                }
            }
        });
    } else {
        row.find('.product_id').empty();
    }
});

});

</script>

@endsection