@extends('layouts.app')
@section('title', 'Product')
@section('page-title', 'Home')
@section('page-subtitle', 'Product PDF Report')
@section('content')

    <h2>Generate Product PDF Report</h2>

    <form action="{{ route('product.generatePDF') }}" method="POST" target="_blank">
        @csrf

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <label>Filter:</label>
                    <select name="filter" id="filter" onchange="toggleDateFields(this.value)">
                        <option value="all">All</option>
                        <option value="7days">Last 7 Days</option>
                        <option value="30days">Last 30 Days</option>
                        <option value="custom">Custom Date Range</option>
                    </select>

                    <div id="dateRangeFields" style="display:none; margin-top:10px;">
                        <label>Start Date:</label>
                        <input type="date" name="start_date">

                        <label>End Date:</label>
                        <input type="date" name="end_date">
                    </div>
                    <button type="submit" class="btn btn-primary">Generate PDF</button>
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
