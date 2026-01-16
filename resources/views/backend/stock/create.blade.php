@extends('layouts.app')
@section('title', 'Stock')
@section('page-title', 'Home')
@section('page-subtitle', 'Create Stock')
@section('content')
    <style>
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
        <div class="card-body">
            <form action="{{ route('stock.store') }}" method="post">
                @csrf
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label input-group-text">Product Name<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <select name="product_id" id="product_id" class="form-control product_id" required>
                            <option value="">-- Select Product --</option>
                            @foreach ($product as $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->product_name }} - {{ $value->oem }} - {{ $value->origin }} - {{ $value->size }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <input type="text" class="form-control" value="{{ $stock->product->product_name }}-{{ $stock->product->oem }}-{{ $stock->product->origin }}-{{ $stock->product->size }}" readonly> --}}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label input-group-text">Stock<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" name="quantity" class="form-control" value="" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save Stock</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.product_id').select2();
        });
    </script>
@endsection