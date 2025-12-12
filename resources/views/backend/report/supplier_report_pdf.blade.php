<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Supplier Report PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }

        .report_heading {
            border-top: 2px solid black;
            border-bottom: 2px solid black;
        }
    </style>
</head>
<body>

    <div class="card-body">
        <div class="row report_heading">
            <h3 class="text-uppercase">Al-Tawasul Auto spare parts l.l.c</h3>
            <p class="m-0">In Behind RAK Mal</p>
            <p class="m-0">Mob: +5457587854547, +4567896786978</p>
            <p class="m-0">Ras Al Kaimah UAE</p>
        </div>
        <div class="row" style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div class="col-md-6" >
                <h4>Debtor Balance Report</h4>
                <p>Statement Value Date</p>
            </div>
            <div class="col-md-6 text-end">
                <p>{{ $selectedSupplier?->supplier_name }}</p>
                <p>Period : <span>{{ $startDate }} -{{ $endDate }}</span></p>
            </div>
        </div>
        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Tm No</th>
                        <th>Rf No</th>
                        <th>Explanation</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $balance = 0; // starting balance
                    @endphp
                    @foreach ($reportData as $value)
                        <tr>
                            <td>{{ __(++$loop->index) }}</td>
                            <td>{{ __($value->tm_no) }}</td>
                            <td>{{ __($value->rf_no) }}</td>
                            <td>{{ __($value->explanation) }}</td>
                            <td>
                                @if ($value->credit_cash == 1)
                                    {{ __($value->pay_amount) }}
                                @endif
                                {{-- {{__($value->grand_total_amount)}} --}}
                            </td>
                            <td>
                                @if ($value->credit_cash == 2)
                                    {{ __($value->pay_amount) }}
                                @endif
                                {{-- {{__($value->pay_amount)}} --}}
                            </td>
                            <td>
                                @php
                                    if ($value->credit_cash == 1) {
                                        // Credit → add
                                        $balance += $value->pay_amount;
                                    } else {
                                        // Cash → subtract
                                        $balance -= $value->pay_amount;
                                    }
                                @endphp
    
                                {{ $balance }}
                            </td>
                        </tr>
                    @endforeach
                    tr>
                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                    <td>
                        <strong>
                            {{ __($reportData->where('credit_cash', 1)->sum('pay_amount')) }}
                        </strong>
                    </td>
                    <td>
                        <strong>
                            {{ __($reportData->where('credit_cash', 2)->sum('pay_amount')) }}
                        </strong>
                    </td>
                    <td>
                        <strong>{{ $balance }}</strong>
                    </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
