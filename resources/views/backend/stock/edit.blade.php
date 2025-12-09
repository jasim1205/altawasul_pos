@extends('layouts.app')
@section('title', 'Stock')
@section('page-title', 'Home')
@section('page-subtitle', 'Edit Stock')
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
            <form action="{{ route('stock.update', $stock->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label input-group-text">Product Name<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $stock->product->product_name }}-{{ $stock->product->oem }}-{{ $stock->product->origin }}-{{ $stock->product->size }}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label input-group-text">Stock<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" name="quantity" class="form-control" value="{{ $stock->quantity }}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Stock</button>
            </form>
        </div>
    </div>
@endsection