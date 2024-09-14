@extends('layouts.app')
@section('title',trans('Purchase'))
@section('page',trans('List'))
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Sales</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Monthly Sales Details</li>
                </ol>
            </nav>
        </div>
    </div>

    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table  class="table table-striped table-bordered"  style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">{{__('#SL')}}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Customer') }}</th>
                            <th>{{ __('Customer No') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Total Tax') }}</th>
                            <th>{{ __('Total Discount') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Total Amount') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                         @forelse ($monthlydetails as $value)
                            <tr>
                                <td class="text-center">{{ __(++$loop->index) }}</td>
                                <td>{{ __($value->date) }}</td>
                                <td>{{ __($value->customer?->customer_name) }}</td>
                                <td>{{ __($value->customer?->contact_no) }}</td>
                                <td>{{ __($value->total_quantity) }}</td>
                                <td>{{ __($value->total_tax) }}</td>
                                <td>{{ __($value->total_discount) }}</td>
                                <td>{{ __($value->grand_total_amount) }}</td>
                               <td style="color: @if($value->status==1) red @else green @endif; font-weight:bold;"><i class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
                                @if($value->status==1){{__('Unpaid')}} @else{{__('Paid')}} @endif</td>
                                <td class="white-space-nowrap">
                                    <div class="d-flex">
                                       <a href="{{route('sale.edit',encryptor('encrypt',$value->id))}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                       <a href="{{route('sale.show',encryptor('encrypt',$value->id))}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center fw-bolder">Purchase Not Found This Year</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
