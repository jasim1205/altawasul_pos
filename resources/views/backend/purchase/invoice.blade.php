@extends('layouts.app')
@section('title',trans('Purchase'))
@section('page',trans('Invoice'))
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Purchase</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-primary" href="{{route('purchase.index')}}"><i class="fa fa-list"></i></a>
            </div>
        </div>
    </div>
    <hr/>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4"><label for="">Supplier Name</label></div>
                        <div class="col-sm-1"><b class="ms-2">:</b></div>
                        <div class="col-sm-6"><span><b>{{ $purchase->supplier?->supplier_name }}</b></span></div>
                    </div>
                    
                    {{-- <span><b>{{ $purchase->supplier?->supplier_name }}</b></span> --}}
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4"><label for="">Email</label>
                        </div>
                        <div class="col-sm-1"><b class="ms-2">:</b></div>
                        <div class="col-sm-6"><span><b>{{ $purchase->supplier?->email }}</b></span></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4"><label for="">Contact</label>
                        </div>
                        <div class="col-sm-1"><b class="mx-2">:</b></div>
                        <div class="col-sm-6"><span><b>{{ $purchase->supplier?->contact_no }}</b></span></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4"><label for="">Date</label>
                        </div>
                        <div class="col-sm-1"><b class="mx-2">:</b></div>
                        <div class="col-sm-6"><span><b>{{ $purchase->supplier?->date }}</b></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            
                
                <div class="table-responsive">
                    <table class="table table-striped mb-0 mt-3">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">{{__('Company')}}</th>
                                <th scope="col">{{__('Category')}}</th>
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
                            @foreach($purchaseDetails as $purdetail)
                            <tr>
                                <td>
                                    {{ $purdetail->company?->company_name }}
                                </td?>
                                <td>
                                    {{ $purdetail->category?->category_name }}
                                </td>
                                <td>
                                    {{ $purdetail->product?->product_name }}
                                </td>
                                <td>
                                    <img src="{{ asset('public/uploads/product/'.$purdetail->product?->product_image) }}" alt="product_image" width="50px">
                                </td>
                                <td>
                                    {{ $purdetail->unit_price }}
                                </td>
                                <td>
                                    {{ $purdetail->quantity }}
                                </td>
                                <td>
                                    {{ $purdetail->amount }}
                                </td>
                                <td>
                                    {{ $purdetail->tax }}%
                                </td>
                                <td>
                                        {{ $purdetail->sub_amount }}
                                </td>
                                <td>
                                    @if($purdetail->discount_type==1){{__('%')}} @else{{__('Fixed')}} @endif
                                </td>
                                <td>
                                    {{ $purdetail->discount }}
                                </td>
                                <td>
                                    {{ $purdetail->total_amount }}
                                </td>
                                {{-- <td>
                                    <span onClick='addRow();' class="add-row text-primary"><i class="bi bi-plus-square-fill"></i></span>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th colspan="5" class="text-end">Total</th>
                            {{-- <th><span class="total_unitprice" id="total_unitprice" >{{ $purchase->total_unitprice }}</span></th> --}}
                            <th><span class="total_quantity" id="total_quantity" >{{ $purchase->total_quantity }}</span></th>
                            <th><span class="total_amount" id="total_amount">{{ $purchase->total_quantity_amount }}</span></th>
                            <th><span class="total_tax" id="total_tax">{{ $purchase->total_tax }}</span></th>
                            <th><span class="total_subamount" id="total_subamount">{{ $purchase->total_subamount }}</span></th>
                            <th></th>
                            <th colspan=""><span class="total_discount" id="total_discount">{{ $purchase->total_discount }}</span></th>
                            <th colspan="2"><span class="grand_total_amount" id="grand_total_amount">{{ $purchase->grand_total_amount }}</span></th>
                        </tfoot>
                    </table>
                </div>
            
        </div>
    </div>


{{-- <div class="page-heading">
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
                    Show
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
                    
                </div>
                <div class="card-body">
                    <form action="{{route('purchase.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4"><label for="">Supplier Name</label></div>
                                    <div class="col-sm-1"><b class="ms-2">:</b></div>
                                    <div class="col-sm-6"><span><b>{{ $purchase->supplier?->supplier_name }}</b></span></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4"><label for="">Email</label>
                                    </div>
                                    <div class="col-sm-1"><b class="ms-2">:</b></div>
                                    <div class="col-sm-6"><span><b>{{ $purchase->supplier?->email }}</b></span></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4"><label for="">Contact</label>
                                    </div>
                                    <div class="col-sm-1"><b class="mx-2">:</b></div>
                                    <div class="col-sm-6"><span><b>{{ $purchase->supplier?->contact_no }}</b></span></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4"><label for="">Date</label>
                                    </div>
                                    <div class="col-sm-1"><b class="mx-2">:</b></div>
                                    <div class="col-sm-6"><span><b>{{ $purchase->supplier?->date }}</b></span></div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 mt-3">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">{{__('Company')}}</th>
                                            <th scope="col">{{__('Category')}}</th>
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
                                        </tr>
                                    </thead>
                                    <tbody id="purchaseHead">
                                        
                                        @foreach($purchaseDetails as $purdetail)
                                        <tr>
                                            <td>
                                                {{ $purdetail->company?->company_name }}
                                            </td?>
                                            <td>
                                                {{ $purdetail->category?->category_name }}
                                            </td>
                                            <td>
                                                {{ $purdetail->product?->product_name }}
                                            </td>
                                            <td>
                                                <img src="{{ asset('public/uploads/product/'.$purdetail->product?->product_image) }}" alt="product_image" width="50px">
                                            </td>
                                            <td>
                                                {{ $purdetail->unit_price }}
                                            </td>
                                            <td>
                                                {{ $purdetail->quantity }}
                                            </td>
                                            <td>
                                                {{ $purdetail->amount }}
                                            </td>
                                            <td>
                                                {{ $purdetail->tax }}%
                                            </td>
                                            <td>
                                                    {{ $purdetail->sub_amount }}
                                            </td>
                                            <td>
                                                @if($purdetail->discount_type==1){{__('%')}} @else{{__('Fixed')}} @endif
                                            </td>
                                            <td>
                                                {{ $purdetail->discount }}
                                            </td>
                                            <td>
                                                {{ $purdetail->total_amount }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th colspan="5" class="text-end">Total</th>
                                        
                                        <th><span class="total_quantity" id="total_quantity" >{{ $purchase->total_quantity }}</span></th>
                                        <th><span class="total_amount" id="total_amount">{{ $purchase->total_quantity_amount }}</span></th>
                                        <th><span class="total_tax" id="total_tax">{{ $purchase->total_tax }}</span></th>
                                        <th><span class="total_subamount" id="total_subamount">{{ $purchase->total_subamount }}</span></th>
                                        <th></th>
                                        <th colspan=""><span class="total_discount" id="total_discount">{{ $purchase->total_discount }}</span></th>
                                        <th colspan="2"><span class="grand_total_amount" id="grand_total_amount">{{ $purchase->grand_total_amount }}</span></th>
                                    </tfoot>
                                </table>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mt-3">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div> --}}
@endsection