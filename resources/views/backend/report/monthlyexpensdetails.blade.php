@extends('layouts.app')
@section('title',trans('Expense'))
@section('page',trans('List'))
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Expense</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Monthly Expense Details</li>
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
            <div class="table-responsive">
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
                         @forelse ($monthlyexpensedetails as $value)
                            <tr>
                                <td class="text-center">{{ __(++$loop->index) }}</td>
                                <td>{{ __($value->date) }}</td>
                                <td>{{ __($value->purpose_title) }}</td>
                                <td>{{ __($value->amount) }}</td>
                                <td class="white-space-nowrap">
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
