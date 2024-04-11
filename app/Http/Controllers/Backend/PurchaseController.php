<?php

namespace App\Http\Controllers\Backend;

use App\Models\Purchase;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\PurchaseDetails;
use App\Models\Product;
use App\Models\Company;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase = Purchase::get();
        return view('backend/purchase/index',compact('purchase'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = Company::get();
        $category = Category::get();
        $product = Product::get();
        return view('backend/purchase/create',compact('company','category','product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $supplier = new Supplier;
            $supplier->supplier_name = $request->supplier_name;
            $supplier->email = $request->email;
            $supplier->contact_no = $request->contact_no;
            // $supplier->product_id = $request->product_id;
            $supplier->date = $request->date;
            if($supplier->save()){
                $purchase = new Purchase;
                $purchase->supplier_id = $supplier->id;
                $purchase->total_quantity = $request->total_quantity;
                $purchase->date = $request->date;
                $purchase->total_discount = $request->total_discount;
                $purchase->total_tax = $request->total_tax;
                $purchase->grand_total_amount = $request->grand_total_amount;
                if($purchase->save()){
                    $purchasedetails = new PurchaseDetails;
                    foreach($purchasedetails as $purdetails){
                        $purdetails->purchase_id = $purchase->id;
                        $purdetails->company_id = $request->company_id;
                        $purdetails->category_id = $request->category_id;
                        $purdetails->product_id = $request->product_id;
                        $purdetails->unit_price = $request->unit_price;
                        $purdetails->quantity = $request->quantity;
                        $purdetails->sub_amount = $request->sub_amount;
                        $purdetails->tax = $request->tax;
                        $purdetails->discount_type = $request->discount_type;
                        $purdetails->discount = $request->discount;
                        $purdetails->total_amount = $request->total_amount;
                        if($purdetails->save()){
                            DB::commit();
                            $stock = new Stock;
                            $stock->purchase_id = $purchase->id;
                            $stock->product_id = $request->product_id;
                            $stock->quantity = $request->quantity;
                            if($stock->save()){
                                $this->notice::success('Product successfully purchased');
                                return redirect()->route('purchase.index');
                            }
                        }
                    }
                }
            }
        }catch(Exception $e){
            dd($e);
            $this->notice::error('something wrong!please try again');
            return redirect()->route('purchase.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
