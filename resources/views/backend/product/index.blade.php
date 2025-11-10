@extends('layouts.app')
@section('title', 'Product')
@section('page-title', 'Home')
@section('page-subtitle', 'Product List')
@section('content')
    <style>
        thead tr th {
            background-color: #198754 !important;
            color: white !important;
        }
    </style>
    {{-- <div class="ml-auto d-flex">
        

        <div class="btn-group ms-auto">
            <a class="btn btn-primary" href="{{ route('product.index') }}"><i class="fa fa-list"></i></a>
        </div>
    </div> --}}
    <hr>
    <section class="section">
        <div class="row">
            <div class="col-sm-12 d-flex">
                <div class="btn-group">
                    <a class="btn btn-outline-primary" href="{{ route('product.reportForm') }}">Report</a>
                </div>
                <div class="mx-2">
                    <input type="text" id="liveSearch" class="form-control" placeholder="Search products by name, cost code, or origin...">
                </div>
                <div class="ms-auto d-flex" style="float: right">
                    <form action="{{ route('product.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by name, code, or origin" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-outline-success">Search</button>
                            <a href="{{ route('product.index') }}" class="btn btn-outline-warning">Reset</a>
                        </div>
                    </form>
                    <div class="btn-group mx-1">
                        <a class="btn btn-primary" href="{{ route('product.create') }}"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Total:{{ $products->total() }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="table-data">
                            @include('backend.product.partials.table', ['products' => $products])
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 🧠 Ajax Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    function fetch_data(query = '', page = 1) {
        $.ajax({
            url: "{{ route('product.search') }}",
            method: "GET",
            data: { query: query, page: page },
            success: function (data) {
                $('#table-data').html(data.table_data);
            }
        });
    }

    // 🔍 When typing in search box
    $('#liveSearch').on('keyup', function () {
        let query = $(this).val();
        fetch_data(query);
    });

    // 🔄 Handle pagination links
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#liveSearch').val();
        fetch_data(query, page);
    });
});
</script>
    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     const searchInput = document.getElementById("liveSearch");
        //     const tableRows = document.querySelectorAll("table tbody tr");

        //     searchInput.addEventListener("keyup", function() {
        //         const searchText = this.value.toLowerCase();

        //         tableRows.forEach(function(row) {
        //             const rowText = row.textContent.toLowerCase();
        //             row.style.display = rowText.includes(searchText) ? "" : "none";
        //         });
        //     });
        // });
        // $(document).ready(function() {
        //     $('#liveSearch').on('keyup', function() {
        //         let query = $(this).val();
        //         fetch_data(query);
        //     });

        //     function fetch_data(query = '') {
        //         $.ajax({
        //             url: "{{ route('product.search') }}",
        //             method: 'GET',
        //             data: {
        //                 query: query
        //             },
        //             success: function(data) {
        //                 $('tbody').html(data.table_data);
        //                 $('#pagination').html(data.pagination);
        //             }
        //         });
        //     }
        // });
    </script>

@endsection
