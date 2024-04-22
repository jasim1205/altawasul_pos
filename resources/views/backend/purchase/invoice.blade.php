@extends('layouts.app')
@section('title',trans('Purchase'))
@section('page',trans('Invoice'))
@section('content')
<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Applications</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Invoice</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="card">
					<div class="card-body">
						<div id="invoice">
							<div class="toolbar hidden-print">
								<div class="text-end">
									<button type="button" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
									<button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
								</div>
								<hr/>
							</div>
							<div class="invoice overflow-auto">
								<div style="min-width: 600px">
									<main>
										<div class="row contacts">
											<div class="col invoice-to">
												<div class="text-gray-light">Supplier:</div>
												<h2 class="to">{{ $purchase->supplier?->supplier_name }}</h2>
												<div class="address">
                                                    {{ $purchase->supplier?->contact_no }}
                                                </div>
												<div class="email"><a href="mailto:john@example.com">{{ $purchase->supplier?->email }}</a>
												</div>
											</div>
											<div class="col invoice-details">
												<h4 class="invoice-id">PURCHASE INVOICE NO:{{ $purchase->id }}</h4>
												<div class="date">Date of Invoice: {{ date('d-M-Y', strtotime($purchase->supplier->date)) }}</div>
											</div>
										</div>
										<table>
											<thead class="text-center fw-bold">
												<tr>
													<th>{{__('#SL')}}</th>
													<th class="text-left">{{ __('Product') }}</th>
													<th class="text-right">{{ __('Unit Price') }}</th>
													<th class="text-right">{{ __('Quantity') }}</th>
													<th class="text-right">{{ __('Tax') }}</th>
													<th class="text-right">{{ __('Sub Amount') }}</th>
													<th class="text-right">{{ __('Percentage') }}</th>
													<th class="text-right">{{ __('TOTAL') }}</th>
												</tr>
											</thead>
											<tbody class="text-center">
                                                @foreach($purchaseDetails as $purdetail)
												<tr>
													<td>{{++$loop->index}}</td>
													<td class="text-left">
                                                        <b>{{ $purdetail->product?->product_name }}</b>
                                                         <br>
                                                        {{ $purdetail->company?->company_name }}
                                                        {{ $purdetail->category?->category_name }}
                                                    </td>
													<td class="">
                                                        {{ $purdetail->unit_price }}
                                                    </td>
                                                    
{{-- {{ $purdetail->tax }}%
{{ $purdetail->discount }}
{{ $purdetail->total_amount }} --}}
													<td class="">{{ $purdetail->quantity }}</td>
													<td class="">{{ $purdetail->tax }}%</td>
													<td class="">{{ $purdetail->sub_amount }}</td>
                                                    <td class="">
                                                    @if($purdetail->discount_type==1)
													{{ $purdetail->discount }}%
                                                    @else
                                                    {{ $purdetail->discount }}
                                                    @endif
                                                    </td>
													<td class="">{{ $purdetail->total_amount }}</td>
												</tr>
                                                
                                                @endforeach
											</tbody>
											<tfoot class="ms-auto">
												<tr>
													<td colspan="4"></td>
													<td colspan="3">SUBTOTAL</td>
													<td>${{ $purchase->total_subamount }}</td>
												</tr>
												<tr>
													<td colspan="4"></td>
													<td colspan="3">DISCOUNT AMOUNT</td>
													<td>${{ $purchase->total_discount }}</td>
												</tr>
												<tr>
													<td colspan="4"></td>
													<td colspan="3">GRAND TOTAL</td>
													<td>${{ $purchase->grand_total_amount }}</td>
												</tr>
											</tfoot>
										</table>
										{{-- <div class="thanks">Signature & Date</div> --}}
										<div class="notices">
                                            <div>Write in word:
                                                <span class="fw-bold">{{ ucwords(strtolower(convert_number_to_words($purchase->grand_total_amount))) }}</span>
                                            </div>
										</div>
									</main>
									<footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
								</div>
								<!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
								<div></div>
							</div>
						</div>
					</div>
				</div>

{{-- <?php

function convert_number_to_words($number)
{
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'forty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int)($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int)($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string)$fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
?> --}}

    {{-- <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
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
            
        </div>
    </div> --}}
@endsection