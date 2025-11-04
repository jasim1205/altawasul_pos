@extends('layouts.app')
@section('title', 'Purchase')
@section('page-title', 'Home')
@section('page-subtitle', 'Purchase Report')
@section('content')
    <style>
        thead tr th {
            background-color: #198754 !important;
            color: white !important;
        }

        .input-group-text {
            background-color: #3A58B3;
            color: white;
            width: 150px;
        }

        .star {
            color: rgb(248, 62, 62);
        }
    </style>
    {{-- <style>
        /* Custom print styles */
        @media print {
            body {
                font-size: 12px;
                /* Reduce font size for printing */
                color: black;
                /* Ensure text color is black */
            }

            .btn,
            .breadcrumb,
            #searchInput,
            #monthSelect,
            .no-print {
                display: none;
                /* Hide buttons, inputs, and other unnecessary elements when printing */
            }

            table {
                width: 100%;
                /* Ensure table takes full width */
                border-collapse: collapse;
            }

            table th,
            table td {
                border: 1px solid black;
                padding: 8px;
            }

            h5.text-center {
                font-size: 16px;
                /* Adjust heading size for print */
            }

            /* Customize the table for print */
            th,
            td {
                text-align: left;
                padding: 8px;
            }

            .table-responsive {
                overflow: visible !important;
                /* Ensure full table is visible in print */
            }

            /* Optional: remove any background color or images */
            * {
                background: transparent !important;
                box-shadow: none !important;
            }

            /* Add more print-specific customizations as needed */
        }
    </style> --}}
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{ route('yearly_purchase') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span for="year" class="input-group-text">Select a year:</span>
                                    <select id="year" name="year" class="form-control">
                                        <option value="">Select A Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-outline-primary">Generate Report</button>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span for="searchJobNumber" class="input-group-text">Search: </span>
                                    <input type="text" class="form-control" style="height: 35px;" id="searchInput"
                                        placeholder="Search by month">
                                </div>
                            </div>
                            <div class="col-md-3 text-end ms-auto">
                                <button type="button" class="btn btn-primary" onclick="printDiv('print_area')">Export as
                                    PDF</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-6 mb-3 ">
                <select id="monthSelect" name="month" class="w-50 form-select">
                    <option value="">All Month</option>
                </select>
            </div>
            <div class="table-responsive" id="print_area">
                <h5 class="text-center">Purchase Report of- {{ $selectedYear }}</h5>
                <table class="table table-striped table-bordered" id="monthrow" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">{{ __('#SL') }}</th>
                            <th>{{ __('Year') }}</th>
                            <th>{{ __('Month') }}</th>
                            <th>{{ __('Total Amount') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($monthlyPurchase as $value)
                            <tr>
                                <td class="text-center">{{ __(++$loop->index) }}</td>
                                <td>{{ __($value['year']) }}</td>
                                <td>{{ __(\Carbon\Carbon::create()->month($value['month'])->format('F')) }}</td>
                                <td>{{ __(number_format($value['amount'], 2)) }}</td>

                                <td class="white-space-nowrap">
                                    <div>
                                        <a href="{{ route('Monthly_purchase_details', ['year' => $value['year'], 'month' => $value['month']]) }}"
                                            class="btn btn-primary">Details</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center fw-bolder">Purchase Not Found This Year</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tableBodies = document.querySelectorAll('.table tbody');

            function filterRows() {
                const searchValue = searchInput.value.trim().toLowerCase();

                tableBodies.forEach(tbody => {
                    const rows = tbody.querySelectorAll('tr');
                    rows.forEach(row => {
                        const month = row.cells[2]?.textContent.trim().toLowerCase() || '';

                        if (month.includes(searchValue)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }

            searchInput.addEventListener('input', filterRows);
        });
    </script>

    <script>
        // Get the select element
        var selectYear = document.getElementById("year");

        // Generate options for years
        var currentYear = new Date().getFullYear();
        for (var i = currentYear; i >= currentYear - 4; i--) {
            var option = document.createElement("option");
            option.text = i;
            option.value = i;
            selectYear.appendChild(option);
        };

        // Generate options for Month
        let select_month = document.getElementById('monthSelect');
        let monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
            "November", "December"
        ];

        for (let i = 0; i < 12; i++) {
            let option = document.createElement('option');
            option.text = monthNames[i];
            option.value = i + 1;
            select_month.appendChild(option);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const monthSelect = document.getElementById('monthSelect');
            const tableRows = document.querySelectorAll('#monthrow tbody tr');

            function filterRows() {
                const selectedMonth = monthSelect.value;

                tableRows.forEach(row => {
                    const monthCell = row.cells[2].textContent.trim().toLowerCase();
                    const monthIndex = new Date(Date.parse(monthCell + " 1, 2022")).getMonth() +
                        1; // Get the month index (1-12)

                    if (selectedMonth === '' || monthIndex == selectedMonth) {
                        row.style.display = ''; // Show the row
                    } else {
                        row.style.display = 'none'; // Hide the row
                    }
                });
            }
            monthSelect.addEventListener('change', filterRows);
        });
    </script>
@endsection
