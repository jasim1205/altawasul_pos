@extends('layouts.app')
@section('title', 'Credit Purchase')
@section('page-title', 'Home')
@section('page-subtitle', 'Credit Purchase List')
@section('content')
    <style>
        th {
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        thead tr th {
            background-color: #198754 !important;
            color: white !important;
        }

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
        <div class="card-header">
            {{-- <h6 class="mb-0 text-uppercase">Credit Purchase</h6> --}}
            <div class="row">
                <div class="col-sm-3">
                    <h5 class="card-title">
                        <a class="btn btn-primary mt-3" href="{{ route('creditsale.create') }}"
                            style="width:80px;height:35px"><i class="fa fa-plus"></i></a>
                    </h5>
                </div>
                {{-- <div class="col-sm-9">
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
                </div> --}}
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
                            <th>{{ __('Customer') }}</th>
                            <th>{{ __('Date') }}</th>
                            {{-- <th>{{ __('Total Quantity') }}</th> --}}
                            {{-- <th>{{ __('Total Discount') }}</th> --}}
                            <th>{{ __('Total Amount(without Tax)') }}</th>
                            <th>{{ __('Total Tax(5%)') }}</th>
                            <th>{{ __('Total Inc Tax') }}</th>
                            <th>{{ __('Pay Amount') }}</th>
                            {{-- <th>{{ __('Due Amount') }}</th> --}}
                            <th>{{ __('Credit/Cash') }}</th>
                            {{-- <th>{{ __('Status') }}</th> --}}
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($creditSale as $value)
                            <tr>
                                {{-- <td class="text-center">{{ __(++$loop->index) }}</td> --}}
                                <td>{{ __($value->customer?->customer_name) }}</td>
                                <td>{{ __(date('d-M-Y', strtotime($value->date))) }}</td>
                                {{-- <td>{{ __($value->total_quantity) }}</td> --}}
                                {{-- <td>{{ __($value->total_discount) }}</td> --}}
                                <td>{{ __($value->total_before_vat) }}</td>
                                <td>{{ __($value->total_tax) }}</td>
                                <td>{{ __($value->total_after_vat) }}</td>
                                <td>{{ __($value->pay_amount) }}</td>
                                {{-- <td>{{ __($value->due_amount) }}</td> --}}
                                <td>
                                    @if ($value->credit_cash == 1)
                                        {{ __('Credit') }}
                                        @else{{ __('Cash') }}
                                    @endif
                                </td>
                                {{-- <td
                                    style="color: @if ($value->status == 1) red @elseif($value->status == 2) yellow @else green @endif; font-weight:bold;">
                                    <i
                                        class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
                                    @if ($value->status == 1)
                                        {{ __('Unpaid') }}
                                    @elseif($value->status == 2)
                                        {{ __('Due') }}
                                        @else{{ __('Paid') }}
                                    @endif
                                </td> --}}
                                <td class="white-space-nowrap">
                                    <div class="d-flex">
                                        <a href="{{ route('creditsale.edit', encryptor('encrypt', $value->id)) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('creditsale.show', encryptor('encrypt', $value->id)) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        {{-- <a href="{{ route('invoice', encryptor('encrypt', $value->id)) }}">
                                            <i class="fa fa-list"></i>
                                        </a> --}}
                                        {{-- <form
                                            action="{{ route('creditsale.destroy', encryptor('encrypt', $value->id)) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border:none">
                                                <span class=""><i class="fa fa-trash text-danger"></i></span>
                                            </button>
                                        </form> --}}
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
@endsection
