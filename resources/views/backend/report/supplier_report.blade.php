@extends('layouts.app')
@section('title',trans('Purchase'))
@section('page',trans('Statement'))
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{ route('supplier_report') }}" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" name="start_date" id="start_date" value="{{ request('start_date') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" value="{{ request('end_date') }}" name="end_date" id="end_date" required>
                        </div>
                        <div class="col-3 mb-2">
                            <label for="">Supplier Name</label>
                            <select class="form-control px-4 p1-2" name="supplier_id" >
                                <option value="">All Supplier</option>
                                @foreach($supplier as $value)
                                <option value="{{ $value->id }}" {{ request('supplier_id') == $value->id ? 'selected' :'' }}>{{ $value->supplier_name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-4 mt-4">
                            <button type="submit" class="btn btn-primary">Generate Report</button>
                        </div>
                        <div class="col-md-4 mt-4 text-end ms-auto">
                            <button type="button" class="btn btn-primary" onclick="printPDF('print_area')">Export as PDF</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        @if($reportData->isNotEmpty())
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Debtor Balance Report</h4>
                    <p>Statement Value Date</p>
                </div>
                <div class="col-md-6">
                    <p>{{$selectedSupplier->supplier_name}}</p>
                    <p>Period : <span>{{$startDate}} -{{$endDate}}</span></p>
                </div>
            </div>
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
                    @foreach ($reportData as $value)
                        <tr>
                            <td>{{ __(++$loop->index) }}</td>
                            <td>{{__($value->tm_no)}}</td>
                            <td>{{__($value->rf_no)}}</td>
                            <td>{{__($value->explanation)}}</td>
                            <td>{{__($value->grand_total_amount)}}</td>
                            <td>{{__($value->pay_amount)}}</td>
                            <td>{{$value->grand_total_amount - $value->pay_amount}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
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
    let select_month =document.getElementById('monthSelect');
    let monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];

    for(let i = 0; i<12; i++){
        let option = document.createElement('option');
        option.text = monthNames[i];
        option.value = i+1;
        select_month.appendChild(option);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const monthSelect = document.getElementById('monthSelect');
        const tableRows = document.querySelectorAll('#monthrow tbody tr');

        function filterRows() {
            const selectedMonth = monthSelect.value;

            tableRows.forEach(row => {
                const monthCell = row.cells[2].textContent.trim().toLowerCase();
                const monthIndex = new Date(Date.parse(monthCell + " 1, 2022")).getMonth() + 1; // Get the month index (1-12)

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
