<?php

namespace App\Http\Controllers\Backend;

use App\Models\Accounts;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\JournalEntryDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CustomerLedgerController extends Controller
{
    public function customerLedger(Request $request)
    {
        $customers = Customer::orderBy('customer_name')->get();

        $ledger = collect();
        $openingBalance = 0;

        if ($request->filled('customer_id')) {

            $customerId = $request->customer_id;

            // Accounts Receivable account
            $arAccount = Accounts::where('name','Accounts Receivable')->firstOrFail();

            // Opening balance (before from_date)
            if ($request->filled('from_date')) {
                $openingBalance = JournalEntryDetail::where('account_id', $arAccount->id)
                    ->whereHas('journalEntry', function ($q) use ($customerId, $request) {
                        $q->where('reference_type','sale')
                        ->where('reference_id',$customerId)
                        ->whereDate('date','<',$request->from_date);
                    })
                    ->sum(DB::raw('debit - credit'));
            }

            // Ledger rows
            $ledger = JournalEntryDetail::with('journalEntry')
                ->where('account_id', $arAccount->id)
                ->whereHas('journalEntry', function ($q) use ($customerId, $request) {
                    $q->where('reference_type','sale')
                    ->where('reference_id',$customerId);

                    if ($request->filled('from_date')) {
                        $q->whereDate('date','>=',$request->from_date);
                    }
                    if ($request->filled('to_date')) {
                        $q->whereDate('date','<=',$request->to_date);
                    }
                })
                ->orderBy('id')
                ->get();
                dd($ledger);
        }

        return view('backend.accounts.customer_ledger', compact(
            'customers',
            'ledger',
            'openingBalance'
        ));
    }
}
