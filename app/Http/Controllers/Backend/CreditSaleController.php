<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use App\Models\CreditSale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreditSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fromDate = $request->input('from_date')." 00:00:00";
        $toDate = $request->input('to_date')." 23:59:59";
        $creditSale = CreditSale::get();
        return view('backend.creditSale.index',compact('creditSale','fromDate','toDate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = Customer::get();
        return view('backend.creditSale.create',compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'      => 'required|exists:customers,id',
            'date'             => 'required|date',
        ]);
        try{
            $creditSale = new CreditSale();
            $creditSale->customer_id = $request->customer_id; // Link purchase to customer
            $creditSale->date = $request->date;
            $creditSale->trn_no = $request->trn_no;
            $creditSale->rf_no = $request->rf_no;
            // $creditSale->invoice_no = $request->invoice_no;
            $creditSale->explanation = $request->explanation;
            $creditSale->total_quantity = $request->total_quantity;
            $creditSale->total_before_vat = $request->total_before_vat;
            $creditSale->total_discount = $request->total_discount;
            $creditSale->total_tax = $request->total_tax;
            // $creditSale->total_subamount = $request->total_subamount;
            $creditSale->total_after_vat = $request->total_after_vat;
            $creditSale->pay_amount = $request->pay_amount;
            $creditSale->due_amount = $request->due_amount;
            $creditSale->credit_cash = $request->credit_cash;
            // $creditSale->status = 3;
            $creditSale->save();
            $this->notice::success('Credit Purchase Added Successfully');
            return redirect()->route('creditsale.index');
        }catch(\Exception $e){
            dd($e);
            $this->notice::error('Please Try Again');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CreditSale $creditSale)
    {
        return view('backend.creditSale.show',compact('creditSale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = Customer::get();
        $creditSale = CreditSale::findOrFail(encryptor('decrypt',$id));
        return view('backend.creditSale.edit',compact('creditSale','customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id'      => 'required|exists:customers,id',
            'date'             => 'required|date',
        ]);
        try{
            $creditSale = CreditSale::findOrFail(encryptor('decrypt',$id));
            $creditSale->customer_id = $request->customer_id; // Link purchase to customer
            $creditSale->date = $request->date;
            $creditSale->trn_no = $request->trn_no;
            $creditSale->rf_no = $request->rf_no;
            $creditSale->invoice_no = $request->invoice_no;
            $creditSale->explanation = $request->explanation;
            $creditSale->total_quantity = $request->total_quantity;
            $creditSale->total_before_vat = $request->total_before_vat;
            $creditSale->total_discount = $request->total_discount;
            $creditSale->total_tax = $request->total_tax;
            // $creditSale->total_subamount = $request->total_subamount;
            $creditSale->total_after_vat = $request->total_after_vat;
            $creditSale->pay_amount = $request->pay_amount;
            $creditSale->due_amount = $request->due_amount;
            $creditSale->credit_cash = $request->credit_cash;
            // $creditSale->status = 3;
           
            $creditSale->save();
            $this->notice::success('Credit Sale Added Successfully');
            return redirect()->route('creditsale.index');
        }catch(\Exception $e){
            dd($e);
            $this->notice::error('Please Try Again');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $creditSale = CreditSale::findOrFail(encryptor('decrypt',$id));
        $creditSale->delete();
        $this->notice::success('Credit Sale Deleted Successfully');
        return redirect()->route('creditsale.index');
    }
}
