@extends('layouts.app')
@section('title',trans('Purchase'))
@section('page',trans('Create'))
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Purchase</h3>
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
                    <form action="{{route('purchase.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="">Supplier Name</label>
                                <input type="text" name="supplier_name" id="" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <label for="">Email</label>
                                <input type="text" name="email" id="" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <label for="">Contact</label>
                                <input type="text" name="contact_no" id="" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <label for="">Date</label>
                                <input type="date" name="date" id="" class="form-control">
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
                                                <th scope="col">{{__('Sub Amount')}}</th>
                                                <th scope="col">{{__('Tax')}}</th>
                                                <th scope="col">{{__('Discount Type')}}</th>
                                                <th scope="col">{{__('Discount')}}</th>
                                                <th scope="col">{{__('Total Amount')}}</th>
                                                <th class="white-space-nowrap">{{__('Action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="purchaseHead">
                                            <tr>
                                                <td>
                                                    <select name="company_id" id="" class="form-control">
                                                        <option value="">select company</option>
                                                        @foreach ($company as $value)
                                                            <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="category_id" id="" class="form-control">
                                                        <option value="">select Category</option>
                                                        @foreach ($category as $value)
                                                            <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="product_id" id="" class="form-control">
                                                        <option value="">select Product</option>
                                                        @foreach ($product as $value)
                                                            <option value="{{ $value->id }}">{{ $value->product_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td><input class="form-control amount" type="text" name="unit_price" placeholder="Enter amount"></td>
                                                <td><input class="form-control" type="text" name="quantity"></td>
                                                <td><input class="form-control" type="text" name="sub_amount"></td>
                                                <td><input class="form-control" type="text" name="tax"></td>
                                                <td><input class="form-control" type="text" name="discount_type"></td>
                                                <td><input class="form-control" type="text" name="discount"></td>
                                                <td><input class="form-control" type="text" name="total_amount"></td>
                                                <td>
                                                    {{--  <span onClick='removeRow(this);' class="delete-row text-danger"><i class="bi bi-trash-fill"></i></span>  --}}
                                                    <span onClick='addRow();' class="add-row text-primary"><i class="bi bi-plus-square-fill"></i></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <th colspan="2">Total Quantity</th>
                                            <th><span class="total_quantity" id="total_quantity"></span></th>
                                        </tfoot>
                                        {{-- <tfoot>
                                            <tr>
                                                <th colspan="2" class="text-end">Total Processing Expenses</th>
                                                <th class="text-center">
                                                    <span class="total_processing" name="total_processing"></span>
                                                </th>
                                            </tr>
                                        </tfoot> --}}
                                    </table>
                             </div>
                           
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
        let counter = 0;
    function addRow(){
var row=`<tr>
            <td>
                <select class="select2 company_id" id="company_id" onchange="doData(this);" name="company_id[]">
                    <option value="">Select Product</option>
                    @foreach ($company as $value)
                        <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="select2 category_id" id="category_id" onchange="doData(this);" name="category_id[]">
                    <option value="">Select Category</option>
                    @foreach ($category as $value)
                        <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="select2 product_id" id="product_id" onchange="doData(this);" name="product_id[]">
                    <option value="">Select Product</option>
                    @foreach ($product as $value)
                        <option value="{{ $value->id }}">{{ $value->product_name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input class="form-control amount" type="text" name="unit_price" placeholder="Enter amount"></td>
            <td><input class="form-control" type="text" name="quantity[]"></td>
            <td><input class="form-control" type="text" name="sub_amount[]"></td>
            <td><input class="form-control" type="text" name="tax[]"></td>
            <td><input class="form-control" type="text" name="discount_type[]"></td>
            <td><input class="form-control" type="text" name="discount[]"></td>
            <td><input class="form-control" type="text" name="total_amount[]"></td>
            <td>
                 <span onClick='RemoveRow(this);' class="delete-row text-danger"><i class="bi bi-trash-fill"></i></span> 
                {{-- <span onClick='addRow();' class="add-row text-primary"><i class="bi bi-plus-square-fill"></i></span>--}}
            </td>
        </tr>`;
    $('#purchaseHead').append(row);
}

function RemoveRow(e) {
    if (confirm("Are you sure you want to remove this row?")) {
        $(e).closest('tr').remove();
    }
}

    function calculateUnitPrice() {
        let totalUnitPrice = 0;
        $('#purchaseHead .amount').each(function() {
            const amount = parseFloat($(this).val());
            if (!isNaN(amount)) {
                totalReceiptable += amount;
            }
        });
        $('[name="total_receiptable"]').val(totalReceiptable.toFixed(2)); // Update hidden input field
        $('.total_receiptable').text(totalReceiptable.toFixed(2)); // Display total amount
    }
</script>
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