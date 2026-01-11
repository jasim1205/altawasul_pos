<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customer Statement</title>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        .page {
            border: 2px solid #000;
            padding: 10px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 10px;
            display: flex;
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
        }

        .header p {
            margin: 2px 0;
            font-size: 11px;
        }

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin: 10px 0;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid #000;
            padding: 5px;
        }

        .no-border td {
            border: none;
        }

        .left-box {
            width: 60%;
            vertical-align: top;
        }

        .right-box {
            width: 40%;
            vertical-align: top;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .items th {
            background: #f2f2f2;
            text-align: center;
        }

        .footer {
            margin-top: 15px;
            font-size: 11px;
        }
        .logo {
            text-align: left !important;
            /* margin-top: 100px; */
        }
    </style>
</head>
<body>

<div class="page">

    {{-- COMPANY HEADER --}}
    {{-- <div class="header">
        <div class="logo">
            <img src="{{ public_path('images/almuneer-logo.png') }}" alt="Company Logo" height="60">
        </div>
        <h2>AL MUNEER GENERAL TRADING L.L.C</h2>
        <p>Old Etisalat Road, Al Nakheel, Ras Al Khaimah, UNITED ARAB EMIRATES</p>
        <p>Tel: +971 7 235 7714 | +971 50 502 8284</p>
        <p>Email: almuneertrd@gmail.com</p>
        <p><strong>TRN: 104269517900003</strong></p>
    </div> --}}
    <table class="no-border" style="width:100%;">
        <tr>
            <td style="width:10%;">
                <img src="{{ public_path('assets/logo.png') }}" style="height:70px;">
            </td>
            <td style="width:90%; text-align:;">
                <h2 class="" style="text-transform: uppercase;">Al-Tawasul Auto spare parts TRADING L.L.C</h2>
                <p style="text-transform: uppercase;">In Behind RAK Mal, Ras Al Khaimah, UAE</p>
                <p>Tel: +971 55 561 1560 | +971 50 770 4816</p>
                <p>Email: altawasulauto@gmail.com</p>
                <p><strong>TRN: 100063093700003</strong></p>
            </td>
        </tr>
    </table>
    
    <hr style="border:1px solid #000">
    {{-- TITLE --}}
    <div class="title">Customer Statement</div>

    {{-- CUSTOMER + DOCUMENT INFO --}}
    <table class="no-border">
        <tr>
            <td class="left-box">
                <strong>{{ $customer?->customer_name }}</strong><br>
                {{ $customer?->address ?? '' }}<br>
                Tel: {{ $customer?->contact_no }}<br>
                TRN: {{ $customer?->trn_no ?? 'N/A' }}
            </td>

            <td class="right-box">
                <table>
                    <tr>
                        <td class="bold">Statement No</td>
                        <td>ST-{{ date('ymd') }}</td>
                    </tr>
                    <tr>
                        <td class="bold">From Date</td>
                        <td>{{ date('d/m/Y', strtotime($request->from_date)) }}</td>
                    </tr>
                    <tr>
                        <td class="bold">To Date</td>
                        <td>{{ date('d/m/Y', strtotime($request->to_date)) }}</td>
                    </tr>
                    <tr>
                        <td class="bold">Payment</td>
                        <td>Credit</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- STATEMENT TABLE --}}
    <table id="example" class="table table-striped" style="width:100%">
        <thead class="text-center">
            {{-- @if ($fromDate && $toDate)
                @php
                    $fromDate = \Carbon\Carbon::parse($fromDate);
                    $toDate = \Carbon\Carbon::parse($toDate);
                @endphp

                <h6 class="text-center text-primary">Purchase Report from :{{ date('d-M-Y',strtotime($fromDate->toDateString())) }} to {{  date('d-M-Y',strtotime($toDate->toDateString())) }}
                </h6>
            @endif --}}
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th class="text-end">Debit</th>
                <th class="text-end">Credit</th>
                <th class="text-end">Balance</th>
            </tr>
        </thead>
    
        <tbody>
            {{-- Opening Balance --}}
            <tr>
                <td colspan="4"><strong>Opening Balance</strong></td>
                <td class="text-end">
                    <strong>{{ number_format($openingBalance ?? 0,2) }}</strong>
                </td>
            </tr>
    
            @php $runningBalance = $openingBalance ?? 0; @endphp
    
            @forelse($ledger as $row)
                @php
                    $runningBalance += ($row->debit - $row->credit);
                @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($row->journalEntry->date)->format('d-m-Y') }}</td>
                    <td>{{ $row->journalEntry->description }}</td>
    
                    <td class="text-end">
                        {{ $row->debit > 0 ? number_format($row->debit,2) : '-' }}
                    </td>
    
                    <td class="text-end">
                        {{ $row->credit > 0 ? number_format($row->credit,2) : '-' }}
                    </td>
    
                    <td class="text-end">
                        <span class="{{ $runningBalance >= 0 ? 'text-danger' : 'text-success' }}">
                            {{ number_format(abs($runningBalance),2) }}
                            {{ $runningBalance >= 0 ? 'Dr' : 'Cr' }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        No transactions found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- FOOTER --}}
    <div class="footer">
        <p><strong>Note:</strong> This is a system generated statement.</p>
    </div>
    <table class="no-border" style="margin-top:20px;">
        <tr>
            <td style="width:60%;"></td>
            <td style="width:40%; text-align:center;">
                <p>______________________________</p>
                <strong>Authorized Signature</strong><br>
                <span style="text-transform: uppercase">For Al-Tawasul Auto spare parts TRADING L.L.C</span>
            </td>
        </tr>
    </table>
    

</div>

</body>
</html>
