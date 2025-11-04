@extends('layouts.app')
@section('title', 'Product')
@section('page-title', 'Home')
@section('page-subtitle', 'Product Search')
@section('content')
    <style>
        thead tr th {
            background-color: #198754 !important;
            color: white !important;
        }

        .input-group-text {
            background-color: #3A58B3;
            color: white;
            width: 150px;
        }
    </style>
    <div class="ml-auto d-flex">
        <div class="btn-group ms-auto">
            <a class="btn btn-primary" href="{{ route('product.index') }}"><i class="fa fa-list"></i></a>
        </div>
    </div>
    <hr>
    <section class="section">
        <div class="row">
            <div class="col-sm-12 d-flex">

                <div class="d-flex">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Product OEM </span>
                        <input type="text" id="oemNo" name="oem" onchange="getProductInfo()" class="form-control" placeholder="Search by OEM"
                            value="">
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(function() {
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $("#oemNo").autocomplete({
                minLength: 1,
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('productAutoComplete') }}",
                        type: "POST",
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        success: function(data) {
                            response(data);
                        },
                        error: function(xhr) {
                            console.log("Error:", xhr.responseText);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#oemNo').val(ui.item.value);
                    return false;
                }
            });
        });

        function getProductInfo() {
            var oemNo = $("#oemNo").val();
            let url = '{{ url('admin/getProductInfo/') }}/' + oemNo;

            fetch(url)
                .then(resp => resp.json())
                .then(function(response) {
                    console.log("data", response);

                    if (!response.status) {
                        alert(response.message || 'Product not found');
                        return;
                    }

                    // Clear old table rows
                    // $('#moneyReceiptTable tbody').empty();

                    // Fill input fields
                    console.log("oem", response.oem);
                    // console.log("from_date", response.from_date);
                    // $("#bl_ref").val(response.bl_ref);

                    // $("#invoiceID").val(response.invoice_id);
                    // // $("#vessel").val(response.vessel_name);
                    // $("#vessel").val(response.vessel_name);
                    // $("#voyage").val(response.voyage);
                    // $("#rotation_no").val(response.rotation_no);
                    // $("#principal").val(response.principal);
                    // $("#description").val(response.description);
                    // $("#doNote").val(response.do_note);
                    // $("#upto_date").val(response.upto_date);
                    // $("#from_date").val(response.from_date);
                    // $("#duration").val(response.duration);
                    // $("#chargeable_days").val(response.chargeable_days);
                    // $("#remarks").val(response.remarks);
                    // $("#client_id").val(response.client_id);
                    // $("#clientName").val(response.clientName ?? '');
                    // $("#free_time").val(response.free_time);
                })
                .catch(function() {
                    // $("#vessel,#voyage,#description,#doNote,#rotation_no,#from_date,#principal,#upto_date,#free_time,#tillDate, #duration,#free_time,#chargeable_days, #cleaningAmount, #client_id, #clientName")
                    //     .val(null);
                    // $("#totalContainers").text(null);
                    // $("#containerList").empty();
                });
        }
    </script>
@endpush
