<?php

namespace App\Http\Controllers\Backend;

use App\Models\CreditPurchase;
use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreditPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fromDate = $request->input('from_date')." 00:00:00";
        $toDate = $request->input('to_date')." 23:59:59";
        $creditPurchase = CreditPurchase::get();
        return view('backend.creditPurchase.index',compact('creditPurchase','fromDate','toDate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplier = Supplier::get();
        return view('backend.creditPurchase.create',compact('supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'      => 'required|exists:suppliers,id',
            'date'             => 'required|date',
            // 'tm_no'            => 'required|string|max:50',
            // 'rf_no'            => 'required|string|max:50',
            'invoice_no'       => 'required|string|max:50',
            // 'explanation'      => 'nullable|string|max:255',
            'file'             => 'nullable|file|mimes:jpg,png,pdf|max:2048', // Max 2MB file
        ]);
        try{
            $creditPurchase = new CreditPurchase();
            $creditPurchase->supplier_id = $request->supplier_id; // Link purchase to supplier
            $creditPurchase->date = $request->date;
            $creditPurchase->tm_no = $request->tm_no;
            $creditPurchase->rf_no = $request->rf_no;
            $creditPurchase->invoice_no = $request->invoice_no;
            $creditPurchase->explanation = $request->explanation;
            $creditPurchase->total_quantity = $request->total_quantity;
            $creditPurchase->total_before_vat = $request->total_before_vat;
            $creditPurchase->total_discount = $request->total_discount;
            $creditPurchase->total_tax = $request->total_tax;
            // $creditPurchase->total_subamount = $request->total_subamount;
            $creditPurchase->total_after_vat = $request->total_after_vat;
            $creditPurchase->pay_amount = $request->pay_amount;
            $creditPurchase->due_amount = $request->due_amount;
            $creditPurchase->credit_cash = $request->credit_cash;
            $creditPurchase->status = $request->status;
            if($request->hasFile('file')){
                $imageName = rand(111,999).'.'.$request->file->extension();
                $request->file->move(public_path('uploads/CreditPurchase'),$imageName);
                $product->file = $imageName;
            }
            $creditPurchase->save();
            $this->notice::success('Credit Purchase Added Successfully');
            return redirect()->route('creditpurchase.index');
        }catch(\Exception $e){
            dd($e);
            $this->notice::error('Please Try Again');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CreditPurchase $creditPurchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = Supplier::get();
        $creditPurchase = CreditPurchase::findOrFail(encryptor('decrypt',$id));
        return view('backend.creditPurchase.edit',compact('creditPurchase','supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id'      => 'required|exists:suppliers,id',
            'date'             => 'required|date',
            // 'tm_no'            => 'required|string|max:50',
            // 'rf_no'            => 'required|string|max:50',
            'invoice_no'       => 'required|string|max:50',
            // 'explanation'      => 'nullable|string|max:255',
            'file'             => 'nullable|file|mimes:jpg,png,pdf|max:2048', // Max 2MB file
        ]);
        try{
            $creditPurchase = CreditPurchase::findOrFail(encryptor('decrypt',$id));
            $creditPurchase->supplier_id = $request->supplier_id; // Link purchase to supplier
            $creditPurchase->date = $request->date;
            $creditPurchase->tm_no = $request->tm_no;
            $creditPurchase->rf_no = $request->rf_no;
            $creditPurchase->invoice_no = $request->invoice_no;
            $creditPurchase->explanation = $request->explanation;
            $creditPurchase->total_quantity = $request->total_quantity;
            $creditPurchase->total_before_vat = $request->total_before_vat;
            $creditPurchase->total_discount = $request->total_discount;
            $creditPurchase->total_tax = $request->total_tax;
            // $creditPurchase->total_subamount = $request->total_subamount;
            $creditPurchase->total_after_vat = $request->total_after_vat;
            $creditPurchase->pay_amount = $request->pay_amount;
            $creditPurchase->due_amount = $request->due_amount;
            $creditPurchase->credit_cash = $request->credit_cash;
            $creditPurchase->status = $request->status;
            if($request->hasFile('file')){
                $imageName = rand(111,999).'.'.$request->file->extension();
                $request->file->move(public_path('uploads/CreditPurchase'),$imageName);
                $product->file = $imageName;
            }
            $creditPurchase->save();
            $this->notice::success('Credit Purchase Added Successfully');
            return redirect()->route('creditpurchase.index');
        }catch(\Exception $e){
            dd($e);
            $this->notice::error('Please Try Again');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CreditPurchase $creditPurchase)
    {
        //
    }
}
