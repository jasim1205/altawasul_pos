@extends('layouts.app')
@section('title', 'Stock')
@section('page-title', 'Home')
@section('page-subtitle', 'Stock Report')
@section('content')

    
    <form action="{{ route('stock.generatePDF') }}" method="POST">
        @csrf

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group">
                        <label class="input-label fs-5 me-3">Filter:</label>
                        <select name="filter" id="filter" class="form-select" onchange="toggleDateFields(this.value)">
                            <option value="all">All</option>
                            <option value="7days">Last 7 Days</option>
                            <option value="30days">Last 30 Days</option>
                            <option value="custom">Custom Date Range</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <label class="input-label fs-5 me-3">Stock Type</label>
                        <select name="stock_type" class="form-select">
                            <option value="">All</option>
                            <option value="low">Low Stock (&lt; 5)</option>
                            <option value="available">Available Stock (&ge; 5)</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-outline-primary">Generate PDF</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" id="dateRangeFields" style="display:none; margin-top:10px;">
                    <div class="input-group">
                        <label class="input-label fs-5 me-3">Start Date:</label>
                        <input type="date" class="form-control me-2" name="start_date">

                        <label class="input-label fs-5 me-3">End Date:</label>
                        <input type="date" class="form-control" name="end_date">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function toggleDateFields(value) {
            document.getElementById('dateRangeFields').style.display = (value === 'custom') ? 'block' : 'none';
        }
    </script>

@endsection
