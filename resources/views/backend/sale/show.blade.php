@extends('layouts.app')
@section('title', 'Sale')
@section('page-title', 'Home')
@section('page-subtitle', 'Sale Details')
@section('content')
<style>
    thead tr th {
        background-color: #198754 !important;
        color: white !important;
    }

    .input-group-text {
        background-color: #3A58B3;
        color: white;
        width: 150px;
    }

    .star {
        color: rgb(248, 62, 62);
    }
</style>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-primary" href="{{route('sale.index')}}"><i class="fa fa-list"></i></a>
            </div>
        </div>
    </div>
    <hr/>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4"><label for=""><strong>Customer Name</strong> </label></div>
                        <div class="col-sm-1"><b class="ms-2">:</b></div>
                        <div class="col-sm-6"><span><b>{{ $sale->customer?->customer_name }}</b></span></div>
                    </div>

                    {{-- <span><b>{{ $sale->customer?->customer_name }}</b></span> --}}
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4"><label for=""><strong>Email</strong></label>
                        </div>
                        <div class="col-sm-1"><b class="ms-2">:</b></div>
                        <div class="col-sm-6"><span><b>{{ $sale->customer?->email }}</b></span></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4"><label for=""><strong>Contact</strong></label>
                        </div>
                        <div class="col-sm-1"><b class="mx-2">:</b></div>
                        <div class="col-sm-6"><span><b>{{ $sale->customer?->contact_no }}</b></span></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4"><label for=""><strong>Date</strong></label>
                        </div>
                        <div class="col-sm-1"><b class="mx-2">:</b></div>
                        <div class="col-sm-6"><span><b>{{ date('d-M-Y', strtotime($sale->customer->date)) }}</b></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            
                
                <div class="table-responsive">
                    <table class="table table-striped mb-0 mt-3">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">{{__('Product')}}</th>
                                <th scope="col">{{__('Image')}}</th>
                                <th scope="col">{{__('Unit Price')}}</th>
                                <th scope="col">{{__('Quantity')}}</th>
                                <th scope="col">{{__('Amount')}}</th>
                                <th scope="col">{{__('Tax')}}</th>
                                <th scope="col">{{__('Sub Amount')}}</th>
                                <th scope="col">{{__('Discount Type')}}</th>
                                <th scope="col">{{__('Discount')}}</th>
                                <th scope="col">{{__('Total Amount')}}</th>
                                {{-- <th class="white-space-nowrap">{{__('Action')}}</th> --}}
                            </tr>
                        </thead>
                        <tbody id="purchaseHead">
                            {{-- @foreach($purchase->purchasedetails as $purdetail)
                            <p>{{ $purdetail->company_id }}</p>
                            @endforeach --}}
                            @foreach($saledetails as $saledetail)
                            <tr>
                                <td>
                                    {{ $saledetail->product?->product_name }}
                                </td>
                                <td>
                                    <img src="{{ asset('public/uploads/product/'.$saledetail->product?->product_image) }}" alt="product_image" width="50px">
                                </td>
                                <td>
                                    {{ $saledetail->unit_price }}
                                </td>
                                <td>
                                    {{ $saledetail->quantity }}
                                </td>
                                <td>
                                    {{ $saledetail->amount }}
                                </td>
                                <td>
                                    {{ $saledetail->tax }}%
                                </td>
                                <td>
                                        {{ $saledetail->sub_amount }}
                                </td>
                                <td>
                                    @if($saledetail->discount_type==1){{__('%')}} @else{{__('Fixed')}} @endif
                                </td>
                                <td>
                                    {{ $saledetail->discount }}
                                </td>
                                <td>
                                    {{ $saledetail->total_amount }}
                                </td>
                                {{-- <td>
                                    <span onClick='addRow();' class="add-row text-primary"><i class="bi bi-plus-square-fill"></i></span>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th colspan="3" class="text-end">Total</th>
                            {{-- <th><span class="total_unitprice" id="total_unitprice" >{{ $purchase->total_unitprice }}</span></th> --}}
                            <th><span class="total_quantity" id="total_quantity" >{{ $sale->total_quantity }}</span></th>
                            <th><span class="total_amount" id="total_amount">{{ $sale->total_quantity_amount }}</span></th>
                            <th><span class="total_tax" id="total_tax">{{ $sale->total_tax }}</span></th>
                            <th><span class="total_subamount" id="total_subamount">{{ $sale->total_subamount }}</span></th>
                            <th></th>
                            <th colspan=""><span class="total_discount" id="total_discount">{{ $sale->total_discount }}</span></th>
                            <th colspan="2"><span class="grand_total_amount" id="grand_total_amount">{{ $sale->grand_total_amount }}</span></th>
                        </tfoot>
                    </table>
                </div>
            
        </div>
    </div>
@endsection