@extends('layouts.app')
@section('title', 'Sales')
@section('page-title', 'Home')
@section('page-subtitle', 'Sales Report')
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
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{ route('yearly_sale') }}" method="get">
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


                            <div class="col-md-4 ">
                                <button type="submit" class="btn btn-primary">Generate Report</button>
                            </div>
                            <div class="col-md-4">
                                <a href="{{route('yearlyPurchase.report.pdf',['year' => request('year')])}}" target="_blank" class="btn btn-primary">Export as PDF</a>
                                {{-- <button type="button" class="btn btn-primary" onclick="printPDF('print_area')">Export as
                                    PDF</button> --}}
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
            <div class="table-responsive">
                <h5 class="text-center">Sale Report of- {{ $selectedYear }}</h5>
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
                        @forelse ($monthlySale as $value)
                            <tr>
                                <td class="text-center">{{ __(++$loop->index) }}</td>
                                <td>{{ __($value['year']) }}</td>
                                <td>{{ __(\Carbon\Carbon::create()->month($value['month'])->format('F')) }}</td>
                                <td>{{ __(number_format($value['amount'], 2)) }}</td>

                                <td class="white-space-nowrap">
                                    <div>
                                        <a href="{{ route('Monthly_sale_Details', ['year' => $value['year'], 'month' => $value['month']]) }}"
                                            class="btn btn-primary">Details</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center fw-bolder">Sale Not Found This Year</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>



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
