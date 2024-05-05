<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fromDate = $request->input('from_date')." 00:00:00";
        $toDate = $request->input('to_date')." 23:59:59";
        $sale = Sales::get();
        return view('backend.sale.index',compact('sale','fromDate','toDate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = Company::get();
        $category = Category::get();
        $product = Product::get();
        return view('backend.sale.create',compact('company','category','product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Save supplier information
            $customer = new Supplier;
            $customer->customer_name = $request->customer_name;
            $customer->email = $request->email;
            $customer->contact_no = $request->contact_no;
            $customer->date = $request->date;
            $customer->save();

            // Save purchase information
            $purchase = new Purchase;
            $purchase->customer_id = $customer->id; // Link purchase to supplier
            $purchase->date = $request->date;
            $purchase->total_quantity = $request->total_quantity;
            $purchase->total_quantity_amount = $request->total_quantity_amount;
            $purchase->total_discount = $request->total_discount;
            $purchase->total_tax = $request->total_tax;
            $purchase->total_subamount = $request->total_subamount;
            $purchase->grand_total_amount = $request->grand_total_amount;
            $purchase->status = $request->status;
            $purchase->save();

            // Save purchase details
            if ($request->has('company_id')) {
                foreach ($request->company_id as $key => $companyId) {
                    $purchaseDetail = new PurchaseDetails;
                    $purchaseDetail->purchase_id = $purchase->id; // Link purchase detail to purchase
                    $purchaseDetail->company_id = $companyId;
                    $purchaseDetail->category_id = $request->category_id[$key];
                    $purchaseDetail->product_id = $request->product_id[$key];
                    $purchaseDetail->unit_price = $request->unit_price[$key];
                    $purchaseDetail->quantity = $request->quantity[$key];
                    $purchaseDetail->amount = $request->amount[$key];
                    $purchaseDetail->sub_amount = $request->sub_amount[$key];
                    $purchaseDetail->tax = $request->tax[$key];
                    $purchaseDetail->discount_type = $request->discount_type[$key];
                    $purchaseDetail->discount = $request->discount[$key];
                    $purchaseDetail->total_amount = $request->total_amount[$key];
                    $purchaseDetail->save();

                    // Update or create stock
                    $stock = Stock::where('product_id', $request->product_id[$key])->first();
                    if (!$stock) {
                        $stock = new Stock;
                        $stock->product_id = $request->product_id[$key];
                        // $stock->purchase_id = $purchase->id;
                        $stock->quantity = $request->quantity[$key];
                    } else {
                        $stock->quantity += $request->quantity[$key];
                    }
                    $stock->save();
                }
            }

            DB::commit();
            return redirect()->route('purchase.index')->with('success', 'Product successfully purchased');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e); // You can remove this line after debugging
            return redirect()->route('purchase.create')->with('error', 'Something went wrong! Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sales)
    {
        //
    }
}
