@extends('layouts.app')
@section('title', 'Sale')
@section('page-title', 'Home')
@section('page-subtitle', 'Sale List')
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

        .star {
            color: rgb(248, 62, 62);
        }
    </style>
    <section class="section">
        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('salesreport') }}" method="get">
                    <div class="d-flex">
                        <div class="input-group">
                            <span for="from_date" class="input-group-text" id="basic-addon1">From Date:</span>
                            <input type="date" class="form-control" name="from_date" value="{{ $fromDate ?? '' }}"
                                required aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group ms-2">
                            <span for="to_date" class="input-group-text" id="basic-addon2">To Date:</span>
                            <input class="form-control" type="date" name="to_date" value="{{ $toDate ?? '' }}" required
                                placeholder="" aria-label="Username" aria-describedby="basic-addon2">
                        </div>
                        <div class="input-group ms-3">
                            <button type="submit" class="btn btn-primary text-end">
                                Report</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="btn-group ms-auto" style="float: right">
                    <a class="btn btn-primary" href="{{ route('sale.create') }}"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            {{-- <div class="col-sm-12 d-flex"> --}}

            {{-- </div> --}}
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table datatable table-bordered" style="width:100%">
                                <thead class="text-center">
                                    @if ($fromDate && $toDate)
                                        @php
                                            $fromDate = \Carbon\Carbon::parse($fromDate);
                                            $toDate = \Carbon\Carbon::parse($toDate);
                                        @endphp

                                        <h6 class="text-center text-primary">Sales Report from
                                            :{{ date('d-M-Y', strtotime($fromDate->toDateString())) }} to
                                            {{ date('d-M-Y', strtotime($toDate->toDateString())) }}
                                        </h6>
                                    @endif
                                    <tr>
                                        <th scope="col">{{ __('#SL') }}</th>
                                        <th>{{ __('Customer') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Total Quantity') }}</th>
                                        <th>{{ __('Total Discount') }}</th>
                                        <th>{{ __('Total Tax') }}</th>
                                        <th>{{ __('Grand Total Amount') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sale as $value)
                                        <tr>
                                            <td class="text-center">{{ __(++$loop->index) }}</td>
                                            <td>{{ __($value->customer?->customer_name) }}</td>
                                            <td>{{ __(date('d-M-Y', strtotime($value->date))) }}</td>
                                            <td>{{ __($value->total_quantity) }}</td>
                                            <td>{{ __($value->total_discount) }}</td>
                                            <td>{{ __($value->total_tax) }}</td>
                                            <td>{{ __($value->grand_total_amount) }}</td>
                                            <td
                                                style="color:  @if ($value->status == 1) red @elseif($value->status == 2) yellow @else green @endif; font-weight:bold;">
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
                                                    <a href="{{ route('sale.edit', encryptor('encrypt', $value->id)) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('sale.show', encryptor('encrypt', $value->id)) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('sale.invoice', $value->id) }}">
                                                        {{-- <i class="fa fa-eye"></i> --}}invoice
                                                    </a>
                                                    {{-- <a href="{{route('invoice',encryptor('encrypt',$value->id))}}">
                                                    <i class="fa fa-list"></i>
                                                </a> --}}
                                                    {{-- <form
                                                        action="{{ route('sale.destroy', encryptor('encrypt', $value->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="border:none">
                                                            <span class=""><i
                                                                    class="fa fa-trash text-danger"></i></span>
                                                        </button>
                                                    </form> --}}
                                                </div>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center fw-bolder">Product No found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
