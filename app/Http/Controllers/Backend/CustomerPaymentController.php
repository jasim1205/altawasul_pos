<?php

namespace App\Http\Controllers\Backend;

use App\Models\Accounts;
use App\Models\Customer;
use App\Models\JournalEntry;
use Illuminate\Http\Request;
use App\Models\CustomerPayment;
use App\Models\JournalEntryDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CustomerPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = Customer::select('id','customer_name', 'contact_no')->get();
        return view('backend.customer_payment.create',compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // $amount = $request->amount;
            // 1️⃣ Save payment first
            $payment = CustomerPayment::create([
                'customer_id' => $request->customer_id,
                'date'        => now(),
                'amount'      => $request->amount,
                'payment_method' => $request->payment_method,
                // 'note'        => $request->note,
            ]);

            $cashAccount = Accounts::where('name','Cash')->first();
            $arAccount   = Accounts::where('name','Accounts Receivable')->first();

            $journal = JournalEntry::create([
                'date' => now(),
                'description' => 'Customer Payment',
                'reference_type' => 'customer',
                'reference_id' => $request->customer_id,
                'source_type'    => 'payment',
                'source_id'      => $payment->id,
            ]);

            JournalEntryDetail::insert([
                [
                    'journal_entry_id' => $journal->id,
                    'account_id' => $cashAccount->id,
                    'debit' => $payment->amount,
                    'credit' => 0,
                ],
                [
                    'journal_entry_id' => $journal->id,
                    'account_id' => $arAccount->id,
                    'debit' => 0,
                    'credit' => $payment->amount,
                ],
            ]);

            DB::commit();
            $this->notice::success('Payment received successfully');
            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            $this->notice::error('Please Try Again');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerPayment $customerPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerPayment $customerPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerPayment $customerPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerPayment $customerPayment)
    {
        //
    }
}
