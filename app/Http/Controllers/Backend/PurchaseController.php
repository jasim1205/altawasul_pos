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

    public function getCategoriesByCompany(Request $request)
    {
        $company_id = $request->input('company_id');

        // Assuming you have a 'categories' table with 'id' and 'category_name' columns
        $categories = Category::where('company_id', $company_id)->pluck('category_name', 'id');

        return response()->json($categories);
    }

    public function getProductsByCategoryAndCompany(Request $request)
    {
        $company_id = $request->input('company_id');
        $category_id = $request->input('category_id');

        // Assuming you have a 'products' table with 'id' and 'product_name' columns
        $products = Product::where('company_id', $company_id)
                            ->where('category_id', $category_id)
                            ->pluck('product_name', 'id');

        return response()->json($products);
    }
    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     try{
    //         DB::beginTransaction();
    //         $supplier = new Supplier;
    //         $supplier->supplier_name = $request->supplier_name;
    //         $supplier->email = $request->email;
    //         $supplier->contact_no = $request->contact_no;
    //         // $supplier->product_id = $request->product_id;
    //         $supplier->date = $request->date;
    //         if($supplier->save()){
    //             $purchase = new Purchase;
    //             $purchase->supplier_id = $supplier->id;
    //             $purchase->total_quantity = $request->total_quantity;
    //             $purchase->date = $request->date;
    //             $purchase->total_discount = $request->total_discount;
    //             $purchase->total_tax = $request->total_tax;
    //             $purchase->total_subamount = $request->total_subamount;
    //             $purchase->grand_total_amount = $request->grand_total_amount;
    //             if($purchase->save()){
    //                 {foreach($request->purchasedetails as $purdetails){

    //                     $purchasedetail = new PurchaseDetails;

    //                     $purchasedetail->purchase_id = $purchase->id;
    //                     $purchasedetail->company_id = $purdetails['company_id'];
    //                     $purchasedetail->category_id = $purdetails['category_id'];
    //                     $purchasedetail->product_id = $purdetails['product_id'];
    //                     $purchasedetail->unit_price = $purdetails['unit_price'];
    //                     $purchasedetail->quantity = $purdetails['quantity'];
    //                     $purchasedetail->sub_amount = $purdetails['sub_amount'];
    //                     $purchasedetail->tax = $purdetails['tax'];
    //                     $purchasedetail->discount_type = $purdetails['discount_type'];
    //                     $purchasedetail->discount = $purdetails['discount'];
    //                     $purchasedetail->total_amount = $purdetails['total_amount'];
    //                     if($purdetails->save()){
    //                         DB::commit();
    //                         $stock = new Stock;
    //                         $stock->purchase_id = $purchase->id;
    //                         $stock->product_id = $request->product_id;
    //                         $stock->quantity = $request->quantity;
    //                         if($stock->save()){
    //                             $this->notice::success('Product successfully purchased');
    //                             return redirect()->route('purchase.index');
    //                         }
    //                     }
    //                 }}
    //             }
    //         }
    //     }catch(Exception $e){
    //         dd($e);
    //         $this->notice::error('something wrong!please try again');
    //         return redirect()->route('purchase.create');
    //     }
    // }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Save supplier information
            $supplier = new Supplier;
            $supplier->supplier_name = $request->supplier_name;
            $supplier->email = $request->email;
            $supplier->contact_no = $request->contact_no;
            $supplier->date = $request->date;
            $supplier->save();

            // Save purchase information
            $purchase = new Purchase;
            $purchase->supplier_id = $supplier->id; // Link purchase to supplier
            $purchase->date = $request->date;
            $purchase->total_quantity = $request->total_quantity;
            $purchase->total_discount = $request->total_discount;
            $purchase->total_tax = $request->total_tax;
            $purchase->total_subamount = $request->total_subamount;
            $purchase->grand_total_amount = $request->grand_total_amount;
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
                        $stock->purchase_id = $purchase->id;
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

    // public function store(Request $request)
    // {
    //     try {
    //         // dd($request->all()) ;
    //         DB::beginTransaction();

    //         $supplier = new Supplier;
    //         $supplier->supplier_name = $request->supplier_name;
    //         $supplier->email = $request->email;
    //         $supplier->contact_no = $request->contact_no;
    //         $supplier->date = $request->date;

    //         if (!$supplier->save()) {
    //             throw new \Exception('Failed to save supplier.');
    //         }

    //         $purchase = new Purchase;
    //         $purchase->supplier_id = $supplier->id;
    //         $purchase->total_quantity = $request->total_quantity;
    //         $purchase->date = $request->date;
    //         $purchase->total_discount = $request->total_discount;
    //         $purchase->total_tax = $request->total_tax;
    //         $purchase->total_subamount = $request->total_subamount;
    //         $purchase->grand_total_amount = $request->grand_total_amount;

    //         if (!$purchase->save()) {
    //             throw new \Exception('Failed to save purchase.');
    //         }

    //         // Loop through purchase details fields directly
    //         $purchaseDetails = $request->only([
    //             'company_id',
    //             'category_id',
    //             'product_id',
    //             'unit_price',
    //             'quantity',
    //             'sub_amount',
    //             'tax',
    //             'discount_type',
    //             'discount',
    //             'total_amount'
    //         ]);

    //         foreach ($purchaseDetails['company_id'] as $key => $companyId) {
    //             $purchasedetail = new PurchaseDetails;
    //             $purchasedetail->purchase_id = $purchase->id;
    //             $purchasedetail->company_id = $companyId;
    //             $purchasedetail->category_id = $purchaseDetails['category_id'][$key];
    //             $purchasedetail->product_id = $purchaseDetails['product_id'][$key];
    //             $purchasedetail->unit_price = $purchaseDetails['unit_price'][$key];
    //             $purchasedetail->quantity = $purchaseDetails['quantity'][$key];
    //             $purchasedetail->sub_amount = $purchaseDetails['sub_amount'][$key];
    //             $purchasedetail->tax = $purchaseDetails['tax'][$key];
    //             $purchasedetail->discount_type = $purchaseDetails['discount_type'][$key];
    //             $purchasedetail->discount = $purchaseDetails['discount'][$key];
    //             $purchasedetail->total_amount = $purchaseDetails['total_amount'][$key];

    //             if (!$purchasedetail->save()) {
    //                 throw new \Exception('Failed to save purchase details.');
    //             }

    //             // Update or create stock
    //             $stock = Stock::where('product_id', $purchasedetail->product_id)->first();
    //             if (!$stock) {
    //                 $stock = new Stock;
    //                 $stock->product_id = $purchasedetail->product_id;
    //                 $stock->quantity = $purchasedetail->quantity;
    //             } else {
    //                 $stock->quantity += $purchasedetail->quantity;
    //             }
    //             $stock->save();
    //         }

    //         DB::commit();
    //         return redirect()->route('purchase.index')->with('success', 'Product successfully purchased');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->route('purchase.create')->with('error', $e->getMessage());
    //     }
    // }

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
