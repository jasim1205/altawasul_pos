<!DOCTYPE html>
<html>

<head>
    <title>Yearly Purchase Report</title>
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
        thead tr th {
            background-color: #198754 !important;
            color: white !important;
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
    <h5 class="text-center">Purchase Report of- {{ $selectedYear }}</h5>
    <hr>
    <table class="table table-striped table-bordered" id="monthrow" style="width:100%">
        <thead class="text-center">
            <tr>
                <th scope="col">{{ __('#SL') }}</th>
                <th>{{ __('Year') }}</th>
                <th>{{ __('Month') }}</th>
                <th>{{ __('Total Amount') }}</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @forelse ($monthlyPurchase as $value)
                <tr>
                    <td class="text-center">{{ __(++$loop->index) }}</td>
                    <td>{{ __($value['year']) }}</td>
                    <td>{{ __(\Carbon\Carbon::create()->month($value['month'])->format('F')) }}</td>
                    <td>{{ __(number_format($value['amount'], 2)) }}</td>

                    {{-- <td class="white-space-nowrap">
                        <div>
                            <a href="{{ route('Monthly_purchase_details', ['year' => $value['year'], 'month' => $value['month']]) }}"
                                class="btn btn-primary">Details</a>
                        </div>
                    </td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center fw-bolder">Purchase Not Found This Year</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
