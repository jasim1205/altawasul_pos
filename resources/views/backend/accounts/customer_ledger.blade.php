@extends('layouts.app')
@section('title', 'Customer Ledger')
@section('page-title', 'Home')
@section('page-subtitle', 'Customer Ledger Report')
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
            <div class="row">
                <div class="col-sm-9">
                    <form action="{{ route('customer-ledger-report') }}" method="get">
                        <div class="d-flex flex-wrap align-items-center     justify-content-between">

                            <div class="col-md-4">
                                <label class="form-label">Customer</label>
                                <select name="customer_id" class="form-select" required>
                                    <option value="">-- Select Customer --</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->customer_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="from_date" class="col-auto">From Date:</label>
                                <input class="form-control" type="date" name="from_date"value="{{ request('from_date') }}"
                                    required style="height: 35px">
                            </div>
                            <div class="col-md-4">
                                <label for="to_date" class="col-auto">To Date:</label>
                                <input class="form-control" type="date" name="to_date" value="{{ request('to_date') }}"
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
                            <th>Date</th>
                            <th>Description</th>
                            <th class="text-end">Debit</th>
                            <th class="text-end">Credit</th>
                            <th class="text-end">Balance</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        {{-- Opening Balance --}}
                        <tr>
                            <td colspan="4"><strong>Opening Balance</strong></td>
                            <td class="text-end">
                                <strong>{{ number_format($openingBalance ?? 0,2) }}</strong>
                            </td>
                        </tr>
                
                        @php $runningBalance = $openingBalance ?? 0; @endphp
                
                        @forelse($ledger as $row)
                            @php
                                $runningBalance += ($row->debit - $row->credit);
                            @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($row->journalEntry->date)->format('d-m-Y') }}</td>
                                <td>{{ $row->journalEntry->description }}</td>
                
                                <td class="text-end">
                                    {{ $row->debit > 0 ? number_format($row->debit,2) : '-' }}
                                </td>
                
                                <td class="text-end">
                                    {{ $row->credit > 0 ? number_format($row->credit,2) : '-' }}
                                </td>
                
                                <td class="text-end">
                                    <span class="{{ $runningBalance >= 0 ? 'text-danger' : 'text-success' }}">
                                        {{ number_format(abs($runningBalance),2) }}
                                        {{ $runningBalance >= 0 ? 'Dr' : 'Cr' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No transactions found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
