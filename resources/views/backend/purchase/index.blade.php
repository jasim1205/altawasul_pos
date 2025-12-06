@extends('layouts.app')
@section('title', 'Purchase')
@section('page-title', 'Home')
@section('page-subtitle', 'Purchase List')
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
                <form action="{{ route('phurchasereport') }}" method="get">
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
                    <a class="btn btn-primary" href="{{ route('purchase.create') }}"><i class="fa fa-plus"></i></a>
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
                            <table id="example" class="table table-bordered" style="width:100%">
                                <thead class="">
                                    <tr>
                                        <th scope="col">{{ __('#SL') }}</th>
                                        <th>{{ __('Supplier') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Total Quantity') }}</th>
                                        <th>{{ __('Total Discount') }}</th>
                                        <th>{{ __('Total Tax') }}</th>
                                        <th>{{ __('Grand Total Amount') }}</th>
                                        <th>{{ __('Invoice No') }}</th>
                                        <th>{{ __('Voucher File') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
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
                                            <td>{{ __($value->invoice_no) }}</td>
                                            <td>
                                                @if($value->voucher_file)
                                                    <a href="{{ asset('storage/voucher_files/' . $value->voucher_file) }}" target="_blank">{{ __('View File') }}</a>
                                                @else
                                                    {{ __('No File') }}
                                                @endif
                                            </td>
                                            <td>
                                                @foreach($value->purchaseDetails as $item)
                                                    {{ __($item->product->product_name) }}<br>
                                                @endforeach
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
                                                    <a
                                                        href="{{ route('purchase.edit', encryptor('encrypt', $value->id)) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a
                                                        href="{{ route('purchase.show', encryptor('encrypt', $value->id)) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('invoice', encryptor('encrypt', $value->id)) }}">
                                                        <i class="fa fa-list"></i>
                                                    </a>
                                                    {{-- <form
                                                        action="{{ route('purchase.destroy', encryptor('encrypt', $value->id)) }}"
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
                                            <td colspan="7" class="text-center fw-bolder">Product No found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $purchase->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
