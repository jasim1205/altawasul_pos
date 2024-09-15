@extends('layouts.app')
@section('title',trans('Monthly Report'))
@section('page',trans('List'))
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Monthly Report</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Monthly Report Details</li>
                </ol>
            </nav>
        </div>
    </div>

    <hr/>
    <div class="card">
        <div class="card-header">
            <div class="col-md-6 d-flex">
                <label for="searchJobNumber" class="form-label me-2 fw-bold">Search: </label>
                <input type="text" class="form-control" style="height: 35px;" id="searchInput" placeholder="Search by month">
            </div>
        </div>
        <div class="card-body">
            <h3 class="text-center">Monthly Details of {{ DateTime::createFromFormat('!m', $month)->format('F') }}- {{ $year }}</h3>
            <div class="table-responsive">
                <h4>Purchase Report</h4>
                <table  class="table table-striped table-bordered"  style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">{{__('#SL')}}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Supplier') }}</th>
                            <th>{{ __('Total Amount') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                         @forelse ($purchases  as $value)
                            <tr>
                                <td class="text-center">{{ __(++$loop->index) }}</td>
                                <td>{{ __($value->date) }}</td>
                                <td>{{ __($value->supplier?->supplier_name) }}</td>
                                <td>{{ __($value->grand_total_amount) }}</td>
                               <td style="color: @if($value->status==1) red @else green @endif; font-weight:bold;"><i class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
                                @if($value->status==1){{__('Unpaid')}} @else{{__('Paid')}} @endif</td>
                                <td class="">
                                    <div class="d-flex">
                                       <a href="{{route('purchase.edit',encryptor('encrypt',$value->id))}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                       <a href="{{route('purchase.show',encryptor('encrypt',$value->id))}}">
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
            <div class="table-responsive">
                <h4>Expense Report</h4>
                <table  class="table table-striped table-bordered"  style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">{{__('#SL')}}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Expense Head') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                         @forelse ($expenses  as $value)
                            <tr>
                                <td class="text-center">{{ __(++$loop->index) }}</td>
                                <td>{{ __($value->date) }}</td>
                                <td>{{ __($value->purpose_title) }}</td>
                                <td>{{ __($value->amount) }}</td>
                                <td class="">
                                    <div class="d-flex">
                                       <a href="{{route('dailyexpense.edit',encryptor('encrypt',$value->id))}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                       <a href="{{route('dailyexpense.show',encryptor('encrypt',$value->id))}}">
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
            <div class="table-responsive">
                <h4>Sales Report</h4>
                <table  class="table table-striped table-bordered"  style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">{{__('#SL')}}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Customer') }}</th>
                            <th>{{ __('Total Amount') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                         @forelse ($sales  as $value)
                            <tr>
                                <td class="text-center">{{ __(++$loop->index) }}</td>
                                <td>{{ __($value->date) }}</td>
                                <td>{{ __($value->customer?->customer_name) }}</td>
                                <td>{{ __($value->grand_total_amount) }}</td>
                               <td style="color: @if($value->status==1) red @else green @endif; font-weight:bold;"><i class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
                                @if($value->status==1){{__('Unpaid')}} @else{{__('Paid')}} @endif</td>
                                <td class="">
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
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-end">Total Purchase:</th>
                            <th>{{ number_format($totalPurchase, 2) }}</th>
                        </tr>
                        <tr>
                            <th colspan="5"  class="text-end">Total Expense:</th>
                            <th>{{ number_format($totalExpense, 2) }}</th>
                        </tr>
                        <tr>
                            <th colspan="5"  class="text-end">Total Sale:</th>
                            <th>{{ number_format($totalSale, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

     <script>
         document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const tableBodies = document.querySelectorAll('.table tbody');

            function filterRows() {
                const searchValue = searchInput.value.trim().toLowerCase();

                tableBodies.forEach(tbody => {
                    const rows = tbody.querySelectorAll('tr');
                    rows.forEach(row => {
                        const date = row.cells[1]?.textContent.trim().toLowerCase() || '';
                        const supplier = row.cells[2]?.textContent.trim().toLowerCase() || '';

                        if (date.includes(searchValue) || supplier.includes(searchValue)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }

            searchInput.addEventListener('input', filterRows);
        });
    </script>
@endsection
