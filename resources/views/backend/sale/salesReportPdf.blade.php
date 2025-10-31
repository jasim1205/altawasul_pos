<!DOCTYPE html>
<html>

<head>
    <title>Sales Report</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>
    <header>
        <h4 style="text-align: center;">AL-TAWASUL AUTO SPARE PARTS TRADING LLC</h4>
        <div
            style="text-align: center; display: flex; justify-content: center; align-items: center;margin-bottom:0px;margin-top:0px;">
            <span>Mob: 0507704816</span>
            <span>Mob: 0555611560</span>
            {{-- <p>Mob</p><b class="mx-2">:</b><p>0507704816</p>
            <p>Mob</p><b class="mx-2">:</b><p>0555611560</p> --}}
            <p>Behind Rak Mall, R.A.K., U.A.E.</p>
        </div>

        {{-- <p style="text-align: center;">
            {{ config('app.address') }} <br>
            Phone: {{ config('app.phone') }}, Email: {{ config('app.email') }}
        </p> --}}
    </header>
    <h3>Sales Report :
        @if($fromDate && $toDate)
        @php
            $fromDate = \Carbon\Carbon::parse($fromDate);
            $toDate = \Carbon\Carbon::parse($toDate);
        @endphp
        {{ date('d-M-Y',strtotime($fromDate->toDateString())) }} to {{  date('d-M-Y',strtotime($toDate->toDateString())) }}
    @endif</h3>
    <hr>

    <table id="" class="table table-striped table-border text-center" style="width:100%">
        <thead class="text-center">
            {{-- @if($fromDate && $toDate)
                @php
                    $fromDate = \Carbon\Carbon::parse($fromDate);
                    $toDate = \Carbon\Carbon::parse($toDate);
                @endphp

                <h6 class="text-center text-primary">Purchase Report from :{{ date('d-M-Y',strtotime($fromDate->toDateString())) }} to {{  date('d-M-Y',strtotime($toDate->toDateString())) }}
                </h6>
            @endif --}}
            <tr>
                <th scope="col">{{__('#SL')}}</th>
                <th>{{ __('Supplier') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Total Quantity') }}</th>
                <th>{{ __('Total Discount') }}</th>
                <th>{{ __('Total Tax') }}</th>
                <th>{{ __('Grand Total Amount') }}</th>
                <th>{{ __('Status') }}</th>
            </tr>
        </thead>
        <tbody>
             @forelse ($sale as $value)
                <tr>
                    <td class="text-center">{{ __(++$loop->index) }}</td>
                    <td>{{ __($value->customer?->customer_name) }}</td>
                    <td>{{ __(date('d-M-Y', strtotime($value->date))) }}</td>
                    <td>{{ __($value->total_quantity) }}</td>
                    <td>{{ __($value->total_discount) }}</td>
                    <td>{{ __($value->total_tax) }}</td>
                    <td>{{ __($value->grand_total_amount) }}</td>
                    <td style="color: @if($value->status==1) red @elseif($value->status==2) yellow @else green @endif; font-weight:bold;"><i class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
                        @if($value->status==1){{__('Unpaid')}}
                        @elseif($value->status==2){{__('Due')}}
                        @else{{__('Paid')}}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center fw-bolder">Product No found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>