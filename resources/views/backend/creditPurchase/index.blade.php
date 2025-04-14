@extends('layouts.app')
@section('title', trans('Credit Purchase'))
@section('page', trans('List'))
@section('content')
    <style>
        th {
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
    </style>
    {{-- <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Credit Purchase</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-primary" href="{{ route('product.create') }}"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div> --}}
    <!--end breadcrumb-->
    {{-- <h6 class="mb-0 text-uppercase">Purchase</h6> --}}
    <hr />
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0 text-uppercase">Credit Purchase</h6>
            <div class="row">
                <div class="col-sm-3">
                    <h5 class="card-title">
                        <a class="btn btn-primary mt-3" href="{{ route('creditpurchase.create') }}"
                            style="width:80px;height:35px"><i class="fa fa-plus"></i></a>
                    </h5>
                </div>
                <div class="col-sm-9">
                    <form action="{{ route('phurchasereport') }}" method="get">
                        <div class="d-flex flex-wrap align-items-center     justify-content-between">
                            <div class="col-md-4">
                                <label for="from_date" class="col-auto">From Date:</label>
                                <input class="form-control" type="date" name="from_date" value="{{ $fromDate ?? '' }}"
                                    required style="height: 35px">
                            </div>
                            <div class="col-md-4">
                                <label for="to_date" class="col-auto">To Date:</label>
                                <input class="form-control" type="date" name="to_date" value="{{ $toDate ?? '' }}"
                                    required style="height: 35px">
                            </div>
                            <div class="col-md-3 mt-3">
                                <button type="submit" class="btn btn-primary text-end" style="height: 35px">Generate
                                    Report</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead class="text-center">
                        {{-- @if ($fromDate && $toDate)
                            @php
                                $fromDate = \Carbon\Carbon::parse($fromDate);
                                $toDate = \Carbon\Carbon::parse($toDate);
                            @endphp

                            <h6 class="text-center text-primary">Purchase Report from :{{ date('d-M-Y',strtotime($fromDate->toDateString())) }} to {{  date('d-M-Y',strtotime($toDate->toDateString())) }}
                            </h6>
                        @endif --}}
                        <tr>
                            {{-- <th scope="col">{{ __('#SL') }}</th> --}}
                            <th>{{ __('Supplier') }}</th>
                            <th>{{ __('Date') }}</th>
                            {{-- <th>{{ __('Total Quantity') }}</th> --}}
                            {{-- <th>{{ __('Total Discount') }}</th> --}}
                            <th>{{ __('Total Amount(without Tax)') }}</th>
                            <th>{{ __('Total Tax(5%)') }}</th>
                            <th>{{ __('Total Inc Tax') }}</th>
                            <th>{{ __('Pay Amount') }}</th>
                            <th>{{ __('Due Amount') }}</th>
                            <th>{{ __('Credit/Cash') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($creditPurchase as $value)
                            <tr>
                                {{-- <td class="text-center">{{ __(++$loop->index) }}</td> --}}
                                <td>{{ __($value->supplier?->supplier_name) }}</td>
                                <td>{{ __(date('d-M-Y', strtotime($value->date))) }}</td>
                                {{-- <td>{{ __($value->total_quantity) }}</td> --}}
                                {{-- <td>{{ __($value->total_discount) }}</td> --}}
                                <td>{{ __($value->total_before_vat) }}</td>
                                <td>{{ __($value->total_tax) }}</td>
                                <td>{{ __($value->total_after_vat) }}</td>
                                <td>{{ __($value->pay_amount) }}</td>
                                <td>{{ __($value->due_amount) }}</td>
                                <td>
                                    @if ($value->credit_cash == 1)
                                        {{ __('Credit') }}
                                        @else{{ __('Cash') }}
                                    @endif
                                </td>
                                <td
                                    style="color: @if ($value->status == 1) red @elseif($value->status == 2) yellow @else green @endif; font-weight:bold;">
                                    <i
                                        class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
                                    @if ($value->status == 1)
                                        {{ __('Unpaid') }}
                                    @elseif($value->status == 2)
                                        {{ __('Due') }}
                                        @else{{ __('Paid') }}
                                    @endif
                                </td>
                                <td class="white-space-nowrap">
                                    <div class="d-flex">
                                        <a href="{{ route('creditpurchase.edit', encryptor('encrypt', $value->id)) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('creditpurchase.show', encryptor('encrypt', $value->id)) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        {{-- <a href="{{ route('invoice', encryptor('encrypt', $value->id)) }}">
                                            <i class="fa fa-list"></i>
                                        </a> --}}
                                        <form
                                            action="{{ route('creditpurchase.destroy', encryptor('encrypt', $value->id)) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border:none">
                                                <span class=""><i class="fa fa-trash text-danger"></i></span>
                                            </button>
                                        </form>
                                    </div>
                                    {{-- <a href="javascript:void()" onclick="$('#form{{$value->id}}').submit()" class="text-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form id="form{{$value->id}}" action="{{route('company.destroy',encryptor('encrypt',$value->id))}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center fw-bolder">Purchase No found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Purchase</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">list</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title m-0">
                    <a class="btn btn-primary" href="{{route('purchase.create')}}"><i class="fa fa-plus"></i></a>
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th scope="col">{{__('#SL')}}</th>
                            <th>{{ __('Supplier') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Total Quantity') }}</th>
                            <th>{{ __('Total Discount') }}</th>
                            <th>{{ __('Total Tax') }}</th>
                            <th>{{ __('Grand Total Amount') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($purchase as $value)
                            <tr>
                                <td>{{ __(++$loop->index) }}</td>
                                <td>{{ __($value->supplier?->supplier_name) }}</td>
                                <td>{{ __($value->date) }}</td>
                                <td>{{ __($value->total_quantity) }}</td>
                                <td>{{ __($value->total_discount) }}</td>
                                <td>{{ __($value->total_tax) }}</td>
                                <td>{{ __($value->grand_total_amount) }}</td>
                                <td class="white-space-nowrap">
                                    <div class="d-flex">
                                        <a href="{{route('purchase.edit',encryptor('encrypt',$value->id))}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('purchase.show',encryptor('encrypt',$value->id))}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <form action="{{route('purchase.destroy',encryptor('encrypt',$value->id))}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border:none">
                                                    <span class=""><i class="fa fa-trash text-danger"></i></span>
                                                </button>
                                            </form>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center fw-bolder">Product No found</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div> --}}
@endsection
