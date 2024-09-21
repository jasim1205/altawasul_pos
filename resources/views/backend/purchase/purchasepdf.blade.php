@extends('layouts.app')
@section('title',trans('Purchase'))
@section('page',trans('List'))
@section('content')
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Purchase</li>
                </ol>
            </nav>
        </div>
    </div>
    <hr/>
    <div class="card">
        <div class="card-header">
            <div class="row">
               <div class="col-md-3 mt-4 text-end ms-auto">
                    <button type="button" class="btn btn-primary" onclick="printDiv('print_area')">Export as PDF</button>
                </div>
                
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="print_area">
                <table id="" class="table table-striped table-border text-center" style="width:100%">
                    <thead class="text-center">
                        @if($fromDate && $toDate)
                            @php
                                $fromDate = \Carbon\Carbon::parse($fromDate);
                                $toDate = \Carbon\Carbon::parse($toDate);
                            @endphp

                            <h6 class="text-center text-primary">Purchase Report from :{{ date('d-M-Y',strtotime($fromDate->toDateString())) }} to {{  date('d-M-Y',strtotime($toDate->toDateString())) }}
                            </h6>
                        @endif
                        <tr>
                            <th scope="col">{{__('#SL')}}</th>
                            <th>{{ __('Supplier') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Total Quantity') }}</th>
                            <th>{{ __('Total Discount') }}</th>
                            <th>{{ __('Total Tax') }}</th>
                            <th>{{ __('Grand Total Amount') }}</th>
                            <th>{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                         @forelse ($purchase as $value)
                            <tr>
                                <td class="text-center">{{ __(++$loop->index) }}</td>
                                <td>{{ __($value->supplier?->supplier_name) }}</td>
                                <td>{{ __(date('d-M-Y', strtotime($value->date))) }}</td>
                                <td>{{ __($value->total_quantity) }}</td>
                                <td>{{ __($value->total_discount) }}</td>
                                <td>{{ __($value->total_tax) }}</td>
                                <td>{{ __($value->grand_total_amount) }}</td>
                                <td style="color: @if($value->status==1) red @elseif($value->status==2) yellow @else green @endif; font-weight:bold;"><i class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
                                    @if($value->status==1){{__('Unpaid')}}
                                    @elseif($value->status==2){{__('Due')}}
                                    @else{{__('Paid')}}
                                    @endif
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
    </div>
@endsection
