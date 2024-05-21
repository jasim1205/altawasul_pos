@extends('layouts.app')
@section('title',trans('Sale'))
@section('page',trans('List'))
@section('content')
<div class="card">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-uppercase text-center">التواصل لتجارة قطع غيار السيارات ش.ذ</h1>
                <h3 class="text-uppercase text-center">al tawasul auto spare parts trading l.l.c</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="d-flex">
                    <p>Mob</p><b class="mx-2">:</b><p>0507704816</p>
                </div>
                <div class="d-flex">
                    <p>Mob</p><b class="mx-2">:</b><p>0555611560</p>
                </div>
                <div class="d-flex">
                    <p>P.O.Box :</p>
                </div>
                <div class="d-flex">
                    <p>Behind Rak Mall, R.A.K., U.A.E.</p>
                </div>
            </div>
            <div class="col-lg-6 text-right" dir="ltr">
                <div class="d-flex justify-content-end">
                    <p>٠٥٠٧٧٠٤٨١٦</p><b class="mx-2">:</b><p>جوال</p>
                </div>
                <div class="d-flex justify-content-end">
                    <p>٠٥٥٥٦١١٥٦٠</p><b class="mx-2">:</b><p>جوال</p>
                </div>
                <div class="d-flex justify-content-end">
                    <b class="mx-1">:</b><p>ص.ب</p>
                </div>
                <div class="d-flex justify-content-end">
                    <p>خلف راك مول، ر.أ.ك، الإمارات العربية المتحدة</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 d-flex mt-2">
                <h3>NO</h3><b class="m-1">:</b><h3>{{ $sale->id }}</h3>
            </div>
            <div class="col-lg-4 text-center">
                <h3 class="">فاتورة ضريبية</h3>
                <hr class="m-0 mx-auto" style="font-weight: bolder; width:150px; color:black;">
                <h3 class="">TAX INVOICE</h3>
            </div>
            <div class="col-lg-4 d-flex justify-content-end mt-2">
                <h3>Date :</h3><b class="mt-2 mx-2">{{ $sale->date }}</b><h3>تاريخ</h3>
            </div>
        </div>
        <div class="row gx-2">
            <div class="col-lg-5" style="border: 1px solid black;">
                <span class="fs-3 py-0 px-0">TRN. 100063093700003</span>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-6" style="border: 1px solid black;">
                <span class="fs-3 py-0 px-0">Cust. TRN. </span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 d-flex">
                <h3>Mr./Mrs.</h3><b class="fs-4 text-center" style="border-bottom: 2px dotted black; width:70%;">{{ $sale->customer->customer_name }}</b><h3 class="ms-5">السيد/السيدة</h3>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th rowspan="2">الوصف
                               <br> Description
                            </th>
                            {{-- <th>Description</th>
                            <th>Description</th>
                            <th>Description</th> --}}
                            <th rowspan="2">الكمية
                                <br> Quantity</th>
                            <th colspan="2">Rate السعر</th>
                            <th colspan="6">Amount المبلغ</th>
                        </tr>
                        <tr>
                            <th>درهم
                                <br>Dhs.</th>
                            <th>فلس
                                <br>Fils.</th>
                            <th>Quantity Amount</th>
                            <th>Tax(5%)</th>
                            <th>Sub_Amount(with tax)</th>
                            <th>Discount(amount)</th>
                            <th>درهم
                                <br>Dhs.</th>
                            <th>فلس
                                <br>Fils.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($saledetail as $s)
                        <tr>
                            <td>{{ $s->product->product_name }}</td>
                            <td>{{ $s->quantity }}</td>
                            <td>{{ $s->unit_price }}</td>
                            <td></td>
                            <td>{{ $s->amount }}</td>
                            <td>{{ $s->tax }}</td>
                            <td>{{ $s->sub_amount }}</td>
                            <td>{{ $s->discount }}</td>
                            <td>{{ $s->total_amount }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
@php
    use NumberToWords\NumberToWords;

    // Initialize the number to words "factory"
    $numberToWords = new NumberToWords();

    // Create a new number transformer using the chosen language
    $numberTransformer = $numberToWords->getNumberTransformer('en');
    $grandTotalInWords = $numberTransformer->toWords($sale->grand_total_amount);

    $numberTransformerAr = $numberToWords->getNumberTransformer('ar');
    $grandTotalInWordsAr = $numberTransformerAr->toWords($sale->grand_total_amount);
@endphp

                    <tfoot>
                        <tr>
                            <th rowspan="5" colspan="7">
                                <p><span class="text-bold fs-6">Total Dhs</span>: ({{ $grandTotalInWords }}) dirham</p>
                                <p>({{ $grandTotalInWordsAr  }}) :<span class="text-bold fs-6">إجمالي الدراهم</span></p>
                            </th>
                            <th>Total Quantity Amount</th>
                            <th>{{ $sale->total_quantity_amount }}</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Vat 5%</th>
                            <th>{{ $sale->total_tax }}</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Total Sub Amount</th>
                            <th>{{ $sale->total_subamount }}</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Total Discount</th>
                            <th>{{ $sale->total_discount }}</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Grand Total Amount</th>
                            <th>{{ $sale->grand_total_amount }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-6">
                <h5>Receiver's Signature .........................................توقيع المستلم</h5>
            </div>
            <div class="col-lg-6">
                <h5>Owner's Signature..............................................وقيع المالك</h5>
            </div>
        </div>
    </div>
</div>
@endsection