@extends('layouts.app')
@section('title', 'Daily Expense')
@section('page-title', 'Home')
@section('page-subtitle', 'Create Daily Expense')
@section('content')
<div id="stepper1" class="bs-stepper">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New</h4>
        </div>
        <div class="card-body">
            <div class="bs-stepper-content">
                <form action="{{route('dailyexpense.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                        <div class="row g-3">
                            <div class="col-12 col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        Expense Title
                                    </span>
                                    <input type="text" name="expense_title" value="{{ old('expense_title') }}" id="" class="form-control">
                                @error('expense_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-text">Amount</span>
                                    <input type="text" name="amount"  value="{{ old('amount') }}" id="" class="form-control">
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-text">Date</span>
                                    <input type="date" name="date" class="form-control" value="{{ old('date') }}" id="current_date" p/>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-text">Remarks</span>
                                    <textarea name="remarks" id="" class="form-control">{{old('remarks')}}</textarea>
                                </div>
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
