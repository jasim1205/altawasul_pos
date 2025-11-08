<!DOCTYPE html>
<html>

<head>
    <title>Order Report</title>
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
            /* background: #f2f2f2; */
        }

        header {
            /* background: skyblue */
        }
    </style>
</head>

<body>
    <header>
        <h2 style="text-align: center; margin-bottom: 2px;">AL-TAWASUL AUTO SPARE PARTS TRADING LLC</h2>
        <div style="text-align: center; margin: 0;">
            <span>Mob: 0507704816</span>
            <span>Mob: 0555611560</span>
            {{-- <p>Mob</p><b class="mx-2">:</b><p>0507704816</p>
            <p>Mob</p><b class="mx-2">:</b><p>0555611560</p> --}}
            <p style="margin: 0;">Behind Rak Mall, R.A.K., U.A.E.</p>
        </div>

        {{-- <p style="text-align: center;">
            {{ config('app.address') }} <br>
            Phone: {{ config('app.phone') }}, Email: {{ config('app.email') }}
        </p> --}}
    </header>
    <h3 style="margin:0;">Stock Report:
        <span style="color: {{ $stock_type == 'low' ? 'red' : 'green' }}">
            {{ ucfirst($stock_type ?? 'All') }} Stock Report
            @if ($start_date && $end_date)
                <br><small>{{ $start_date->format('d M Y') }} - {{ $end_date->format('d M Y') }}</small>
            @endif
        </span>
    </h3>
    <hr>

    <table>
        <thead>
            <tr style="background: rgb(17, 130, 243); color: white;">
                <th>SL</th>
                <th>Product Name/Model</th>
                <th>Image</th>
                <th>Stock</th>
                <th>Status</th>
                <th>OEM</th>
                <th>Cross Reference</th>
                <th>Code</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stocks as $key => $stock)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $stock->product?->product_name }}-{{ $stock->product?->oem }}-{{ $stock->product?->origin }}</td>
                    <td><img src="{{ public_path('uploads/product/' . $stock->product?->product_image) }}" width="50px">
                    </td>
                    <td style="color: {{ $stock->quantity <= 5 ? 'red' : 'green' }};font-weight:bold">
                        {{ __($stock->quantity) }}</td>
                    <td style="color: {{ $stock->quantity <= 5 ? 'red' : 'green' }};font-weight:bold">
                        {{ $stock->quantity <= 5 ? 'Low Stock' : 'Available' }}
                    </td>
                    <td>{{ $stock->product?->oem }}</td>
                    <td>{{ $stock->product?->cross_reference }}</td>
                    <td>{{ $stock->product?->cost_code }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center;">No data found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
