@extends('layouts.app')
@section('title',trans('Product'))
@section('page',trans('Create'))
@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Forms</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a class="btn btn-primary" href="{{route('product.index')}}"><i class="fa fa-list"></i></a>
        </div>
    </div>
</div>
<!--end breadcrumb-->
<!--start stepper one-->
<h6 class="text-uppercase">Product</h6>
<hr>
<div id="stepper1" class="bs-stepper">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New</h4>
        </div>
        <div class="card-body">
            <div class="bs-stepper-content">
                <form action="{{route('dailyexpense.update',encryptor('encrypt',$dailyexpense->id))}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('Patch')
                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                        <div class="row g-3">
                            <div class="col-12 col-lg-6">
                                <label for="FisrtName" class="form-label">Purpose</label>
                               <input type="text" name="purpose_title" value="{{ old('purpose_title',$dailyexpense->purpose_title) }}" id="" class="form-control">
                                @error('purpose_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="name" class="form-label">Amount</label>
                                <input type="text" name="amount"  value="{{ old('amount',$dailyexpense->amount) }}" id="" class="form-control">
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="name" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" value="{{ old('date',$dailyexpense->date) }}" id="current_date" p/>

                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label">Remarks</label>
                                <textarea name="remarks" id="" class="form-control">{{old('remarks',$dailyexpense->remarks)}}</textarea>
                            </div>
                            <div class="col-12 col-lg-6">
                                <button type="submit" class="btn btn-primary px-4">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stepper one-->



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Set current date to the date input field
    document.addEventListener('DOMContentLoaded', function() {
        var currentDate = new Date().toISOString().split('T')[0]; // Get current date in "YYYY-MM-DD" format
        document.getElementById('current_date').value = currentDate;
    });
</script>
<script>
    $(document).ready(function() {
        $('#company_id').change(function() {
            var company_id = $(this).val();
            if(company_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('getCategoriesByCompany') }}",
                    data: {'company_id': company_id},
                    dataType: "json",
                    success: function(res) {
                        if(res) {
                            $("#category_id").empty();
                            $.each(res, function(key, value) {
                                $("#category_id").append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        } else {
                            $("#category_id").empty();
                        }
                    }
                });
            } else {
                $("#category_id").empty();
            }
        });
    });
</script>
@endsection
