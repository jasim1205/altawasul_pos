@extends('layouts.app')
@section('title', trans('Product'))
@section('page', trans('List'))
@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Stock List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto d-flex">
            {{-- <form action="{{ route('stock.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search by product name, model, origin, or code" value="{{ request('search') }}"
                        style="padding:5px;">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                    <a href="{{ route('stock.index') }}" class="btn btn-outline-warning">Reset</a>
                </div>

            </form> --}}
        </div>
        {{-- <h2>Generate Product PDF Report</h2> --}}


    </div>
    <hr />
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
