@extends('layouts.app')
@section('title', 'Product')
@section('page-title', 'Home')
@section('page-subtitle', 'Create Product')
@section('content')
    <style>
        .input-group-text {
            background-color: #3A58B3;
            color: white;
            width: 150px;
        }

        .form-control {
            border-color: #3A58B3 !important;
        }

        .star {
            color: rgb(248, 62, 62);
        }
    </style>

    <!--breadcrumb-->

    <div class="ml-auto d-flex">
        <div class="btn-group ms-auto">
            <a class="btn btn-primary" href="{{ route('product.index') }}"><i class="fa fa-list"></i></a>
        </div>
    </div>
    <hr>
    <div id="stepper1" class="bs-stepper">
        <div class="card">
            <div class="card-body">
                <div class="bs-stepper-content">
                    <form action="{{ route('secure.products.check') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="pin" class="col-sm-2 col-form-label">Enter PIN <span class="star">*</span></label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="pin" name="pin"
                                    placeholder="Enter PIN" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-8 text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
@endsection
