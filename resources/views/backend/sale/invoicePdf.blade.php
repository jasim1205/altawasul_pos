<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>Invoice</title>

<style>
    body {
        font-family: 'amiri', sans-serif;
        font-size: 12px;
    }

    .row {
        width: 100%;
        display: inline-block;
    }

    .col-6 {
        width: 50%;
        float: left;
    }

    .text-right { text-align: right; }
    .text-center { text-align: center; }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #3d57c2;
        padding: 3px;
    }

    .no-border td {
        border: none;
    }

    .big-border {
        border: 2px solid #1635cd;
    }

</style>
</head>

<body>

<!-- HEADER AREA -->
<div class="row" style="overflow:hidden; margin-bottom:10px;">
    <div class="col-6">
        <h3 style="margin:0;">AL TAWASUL AUTO SPARE PARTS TRADING L.L.C.</h3>
        <p style="margin:0;">Mob: 055-5611560</p>
        <p style="margin:0;">Mob: 050-7704816</p>
        <p style="margin:0;">P.O.Box: -</p>
        <p style="margin:0;">Behind RAK Mall, R.A.K., U.A.E.</p>
    </div>

    <div class="col-6 text-right" dir="">
        <h3 style="margin:0;">التواصل لتجارة قطع غيار السيارات ش.ذ.م.م</h3>
        <p style="margin:0;">٠٥٥٥٦١١٥٦٠ : جوال</p>
        <p style="margin:0;">٠٥٠٧٧٠٤٨١٦ : جوال</p>
        <p style="margin:0;">: ص.ب</p>
        <p style="margin:0;">خلف راك مول، ر.أ.ك، الإمارات العربية المتحدة</p>
    </div>
</div>

<div style="clear:both;"></div>

<!-- TRN Section -->
<table class="big-border">
    <tr>
        <td style="width:50%; font-size:14px;">TRN. 100063093700003</td>
        <td style="width:50%; font-size:14px;">Cust. TRN. {{$sale->tm_no}}</td>
    </tr>
</table>

<br>

<!-- Invoice No + Date + Title -->
<table class="big-border no-border" style="width:100%; border:0;">
    <tr>
        <td style="width:33%; font-size:14px;">
            Invoice No: <b>{{ $sale->invoice_no }}</b>
        </td>

        <td class="text-center" style="width:33%; padding:0; background:rgb(25, 25, 188);">
            <div style="color:white;]">
                <h3 style="margin:0;">فاتورة ضريبية</h3>
                <h4 style="margin:0;">TAX INVOICE</h4>
            </div>
        </td>

        <td style="width:33%; font-size:14px;" class="text-right">
            Date: {{ \Carbon\Carbon::parse($sale->date)->format('d-M-Y') }}
        </td>
    </tr>
</table>

<br>

<!-- Customer Name -->
<table class="big-border">
    <tr>
        <td style="width:20%;">Mr./Mrs.</td>
        <td style="border-bottom:1px dotted #000; width:60%; text-align:center;">
            {{ $sale->customer->customer_name }}
        </td>
        <td style="width:20%;" dir="rtl">السيد/السيدة</td>
    </tr>
</table>

<br>

<!-- ITEMS TABLE -->
<table class="">
    <tr>
        <th style="" class="text-center">#SL<br></th>
        <th style="width:40%;" class="text-center">DESCRIPTION<br><span dir="rtl">التفاصيل</span></th>
        <th style="width:10%;" class="text-center">Qty<br><span dir="rtl">الكمية</span></th>
        <th style="width:12%;" class="text-center">Rate<br>Dhs.</th>
        <th style="width:13%;" class="text-center">Taxable Amount<br>Dhs.</th>
        <th style="width:12%;" class="text-center">VAT 5%<br>Dhs.</th>
        {{-- <th style="width:12%;" class="text-center">Discount <br>Dhs.</th> --}}
        <th style="width:13%;" class="text-center">Total Amount<br>Dhs.</th>
    </tr>

    @foreach($saledetail as $item)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{ $item->product->product_name }}-{{ $item->product->oem }}-{{ $item->product->origin }}</td>
        <td class="text-center">{{ $item->quantity }}</td>
        <td class="text-center">{{ $item->unit_price }}</td>
        <td class="text-center">{{ $item->amount }}</td>
        <td class="text-center">{{ $item->tax_amount }}</td>
        {{-- <td class="text-center">{{ $item->discount }}</td> --}}
        <td class="text-center">{{ $item->sub_amount }}</td>
    </tr>
    @endforeach

    <!-- Empty Rows to match printed form -->
    {{-- @for($i = 0; $i < 10; $i++)
    <tr>
        <td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    @endfor --}}
</table>

<br>
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
<!-- TOTALS SECTION -->
<table class="big-border">
    <tr>
        <td rowspan="4" style="width:70%;">TOTAL Dhs (In Word): {{$grandTotalInWordsAr}}</td>
        <td style="width:30%;">Total Before Amount (Dhs): </td>
        <td><b>{{$sale->total_quantity_amount}}</b></td>
    </tr>
    <tr>
        <td>Vat(5%):</td>
        <td><b>{{$sale->total_tax_amount}}</b></td>
    </tr>
    <tr>
        <td>Discount (Dhs): </td>
        <td><b>{{$sale->total_discount}}</b></td>
    </tr>
    <tr>
        <td><b>Grand Total (Dhs):</b></td>
        <td><b>{{$sale->grand_total_amount}}</b></td>
    </tr>
</table>

<br><br>

<!-- SIGNATURE -->
<table class="no-border" style="width:100%;">
    <tr>
        <td style="width:50%;">Receiver’s Sign: ____________________</td>
        <td style="width:50%; text-align:right;" dir="rtl">التوقيع : ____________________</td>
    </tr>
</table>

<footer>
    
</footer>
</body>
</html>
