<!DOCTYPE html>
<html>

<head>
    <title>Product Report</title>
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

        /* th {
            background: #f2f2f2;
        } */
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
    <h3>Product Report ({{ $start_date }} to {{ $end_date }})</h3>
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
            @forelse($products as $key => $product)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $product->product_name }}-{{ $product->product_model }}
                        <br>
                        Size: {{ $product->size }}
                        <br>
                        Oem: {{ $product->oem }}
                        <br>
                        Cost Code: {{ $product->cost_code }}
                    </td>
                    <td><img src="{{ public_path('uploads/product/' . $product->product_image) }}" width="50px"></td>
                    <td style="color: {{ $product->stock?->quantity <= 5 ? 'red' : 'green' }};font-weight:bold">
                        {{ __($product->stock?->quantity) }}</td>
                    <td style="color: {{ $product->stock?->quantity <= 5 ? 'red' : 'green' }};font-weight:bold">
                        {{ $product->stock?->quantity <= 5 ? 'Low Stock' : 'Available' }}
                    </td>
                    <td>{{ $product->oem }}</td>
                    <td>{{ $product->cross_reference }}</td>
                    <td>{{ $product->cost_code }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">No data found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
