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
    public function index(Request $request)
    {
        $fromDate = $request->input('from_date')." 00:00:00";
        $toDate = $request->input('to_date')." 23:59:59";
        $purchase = Purchase::get();
        return view('backend.purchase.index',compact('purchase','fromDate','toDate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = Company::get();
        $category = Category::get();
        $product = Product::get();
        return view('backend.purchase.create',compact('company','category','product'));
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
        // $products = Product::join('stocks', 'products.id', '=', 'stocks.product_id')
        //                     ->where('products.company_id', $company_id)
        //                     ->where('products.category_id', $category_id)
        //                     ->where('stocks.quantity', '>', 0)
        //                     ->pluck('products.product_name', 'products.id');

        return response()->json($products);
    }
    //**
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
   


    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $company = Company::get();
        $category = Category::get();
        $product = Product::get();
        $purchase = Purchase::findOrFail(encryptor('decrypt',$id));
        $purchaseDetails = $purchase->purchasedetails;
        // $purchaseDetail = PurchaseDetails::where('purchase_id',$id)->get();
        return view('backend.purchase.show',compact('company','category','product','purchase','purchaseDetails'));
    }
    public function invoice($id)
    {
        $company = Company::get();
        $category = Category::get();
        $product = Product::get();
        $purchase = Purchase::findOrFail(encryptor('decrypt',$id));
        $purchaseDetails = $purchase->purchasedetails;
        // $purchaseDetail = PurchaseDetails::where('purchase_id',$id)->get();
        return view('backend.purchase.invoice',compact('company','category','product','purchase','purchaseDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = Company::get();
        $category = Category::get();
        $product = Product::get();
        $purchase = Purchase::findOrFail(encryptor('decrypt',$id));
        $purchaseDetails = $purchase->purchasedetails;
        // $purchaseDetail = PurchaseDetails::where('purchase_id',$id)->get();
        return view('backend.purchase.edit',compact('company','category','product','purchase','purchaseDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     try {
    //         DB::beginTransaction();

    //         // Update purchase information if it exists
    //         $purchase = Purchase::findOrFail(encryptor('decrypt', $id));
    //         if ($purchase) {
    //             $purchase->date = $request->date;
    //             $purchase->total_quantity = $request->total_quantity;
    //             $purchase->total_quantity_amount = $request->total_quantity_amount;
    //             $purchase->total_discount = $request->total_discount;
    //             $purchase->total_tax = $request->total_tax;
    //             $purchase->total_subamount = $request->total_subamount;
    //             $purchase->grand_total_amount = $request->grand_total_amount;
    //             $purchase->status = $request->status;
    //             $purchase->save();
    //         } else {
    //             // Handle the case where the purchase doesn't exist
    //             // You can choose to return an error message or handle it based on your application logic
    //         }

    //         // Update or create supplier information
    //         $supplier = Supplier::find($purchase->id);
    //         if ($supplier) {
    //             $supplier->supplier_name = $request->supplier_name;
    //             $supplier->email = $request->email;
    //             $supplier->contact_no = $request->contact_no;
    //             $supplier->save();
    //         } else {
    //             $supplier = new Supplier();
    //             $supplier->supplier_name = $request->supplier_name;
    //             $supplier->email = $request->email;
    //             $supplier->contact_no = $request->contact_no;
    //             $supplier->save();
    //         }

    //         // Update or create purchase details
    //         if ($request->has('company_id')) {
    //             foreach ($request->company_id as $key => $companyId) {
    //                 $purchaseDetail = PurchaseDetails::where('purchase_id', encryptor('decrypt', $id))->first();
    //                 if ($purchaseDetail) {
    //                     // Update existing purchase detail attributes
    //                     $purchaseDetail->company_id = $companyId;
    //                     $purchaseDetail->category_id = $request->category_id[$key];
    //                     $purchaseDetail->product_id = $request->product_id[$key];
    //                     $purchaseDetail->unit_price = $request->unit_price[$key];
    //                     $purchaseDetail->quantity = $request->quantity[$key];
    //                     $purchaseDetail->amount = $request->amount[$key];
    //                     $purchaseDetail->sub_amount = $request->sub_amount[$key];
    //                     $purchaseDetail->tax = $request->tax[$key];
    //                     $purchaseDetail->discount_type = $request->discount_type[$key];
    //                     $purchaseDetail->discount = $request->discount[$key];
    //                     $purchaseDetail->total_amount = $request->total_amount[$key];
    //                     $purchaseDetail->save(); // Save the updated purchase detail

    //                     // Update stock
    //                     $stock = Stock::where('product_id', $request->product_id[$key])->where('purchase_id', $purchase->id)->first();
    //                     if ($stock) {
    //                         // Deduct the quantity from the current stock
    //                         $stock->quantity -= $request->quantity[$key];
    //                         $stock->save();
    //                     } else {
    //                         // If stock item doesn't exist, create a new one
    //                         $newStock = new Stock();
    //                         $newStock->product_id = $request->product_id[$key];
    //                         $newStock->purchase_id = $purchase->id;
    //                         $newStock->quantity = $request->quantity[$key]; // Negative quantity to represent deduction
    //                         $newStock->save();
    //                     }
    //                 } else {
    //                     // Create new purchase detail
    //                     $newPurchaseDetail = new PurchaseDetails();
    //                     $newPurchaseDetail->purchase_id = $purchase->id;
    //                     $newPurchaseDetail->company_id = $companyId;
    //                     $newPurchaseDetail->category_id = $request->category_id[$key];
    //                     $newPurchaseDetail->product_id = $request->product_id[$key];
    //                     $newPurchaseDetail->unit_price = $request->unit_price[$key];
    //                     $newPurchaseDetail->quantity = $request->quantity[$key];
    //                     $newPurchaseDetail->amount = $request->amount[$key];
    //                     $newPurchaseDetail->sub_amount = $request->sub_amount[$key];
    //                     $newPurchaseDetail->tax = $request->tax[$key];
    //                     $newPurchaseDetail->discount_type = $request->discount_type[$key];
    //                     $newPurchaseDetail->discount = $request->discount[$key];
    //                     $newPurchaseDetail->total_amount = $request->total_amount[$key];
    //                     $newPurchaseDetail->save();

    //                     // Update stock for the new purchase detail
    //                     $newStock = new Stock();
    //                     $newStock->product_id = $request->product_id[$key];
    //                     $newStock->purchase_id = $purchase->id;
    //                     $newStock->quantity = $request->quantity[$key]; // Negative quantity to represent deduction
    //                     $newStock->save();
    //                 }
    //             }
    //         }

    //         DB::commit();
    //         return redirect()->route('purchase.index')->with('success', 'Product purchase details successfully updated');
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         dd($e); // You can remove this line after debugging
    //         return redirect()->route('purchase.edit', $id)->with('error', 'Something went wrong! Please try again.');
    //     }
    // }

 public function update(Request $request, $id)
{
    try {
        DB::beginTransaction();
        // Update purchase information
        $purchase = Purchase::findOrFail(encryptor('decrypt',$id));
        $purchase->date = $request->date;
        $purchase->total_quantity = $request->total_quantity;
        $purchase->total_quantity_amount = $request->total_quantity_amount;
        $purchase->total_discount = $request->total_discount;
        $purchase->total_tax = $request->total_tax;
        $purchase->total_subamount = $request->total_subamount;
        $purchase->grand_total_amount = $request->grand_total_amount;
        $purchase->status = $request->status;
        $purchase->save();
        $supplier = Supplier::find($purchase->id);        
        $supplier->supplier_name = $request->supplier_name;
        $supplier->email = $request->email;
        $supplier->contact_no = $request->contact_no;
        $supplier->date = $request->date;
        $supplier->save();
        // Update purchase details
        if ($request->has('company_id')) {
            foreach ($request->company_id as $key => $companyId) {
                 $purchaseDetail = PurchaseDetails::where('purchase_id', encryptor('decrypt', $id))->skip($key)->first();
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

                // Calculate difference in quantity
$originalQuantity = $purchaseDetail->getOriginal('quantity');
$editedQuantity = $request->quantity[$key];
$quantityDifference = $editedQuantity - $originalQuantity;

// Update stock
$productId = $request->product_id[$key];
$stock = Stock::where('product_id', $productId)->first();

if (!$stock) {
    // If stock does not exist, create a new stock record
    $stock = new Stock();
    $stock->product_id = $productId;
}

// Update the quantity
$stock->quantity += $quantityDifference;
$stock->save();

            }
        }

        DB::commit();
        return redirect()->route('purchase.index')->with('success', 'Purchase details successfully updated');
    } catch (Exception $e) {
        DB::rollBack();
        dd($e); // You can remove this line after debugging
        return redirect()->route('purchase.edit', $id)->with('error', 'Something went wrong! Please try again.');
    }
}
    // public function update(Request $request, $id)
    // {
    //     try {
    //         DB::beginTransaction();

    //         // Update supplier information if it exists
    //         $supplier = Supplier::where('id',$id)->first();
    //         if ($supplier) {
    //             $supplier->supplier_name = $request->supplier_name;
    //             $supplier->email = $request->email;
    //             $supplier->contact_no = $request->contact_no;
    //             $supplier->date = $request->date;
    //             $supplier->save();
    //         } else {
    //             // Handle the case where the supplier doesn't exist
    //             // You can choose to return an error message or handle it based on your application logic
    //         }

    //         // Update purchase information if supplier was found
    //         if ($supplier) {
    //             $purchase = Purchase::findOrFail(encryptor('decrypt',$id));
    //                 $purchase->date = $request->date;
    //                 $purchase->total_quantity = $request->total_quantity;
    //                 $purchase->total_quantity_amount = $request->total_quantity_amount;
    //                 $purchase->total_discount = $request->total_discount;
    //                 $purchase->total_tax = $request->total_tax;
    //                 $purchase->total_subamount = $request->total_subamount;
    //                 $purchase->grand_total_amount = $request->grand_total_amount;
    //                 $purchase->status = $request->status;
    //                 $purchase->save();
    //         }

    //         // Update purchase details if purchase and supplier were found
    //         if ($request->has('company_id')) {
    //             foreach ($request->company_id as $key => $companyId) {
    //                 $purchaseDetail = PurchaseDetails::where('purchase_id',encryptor('decrypt', $id))->first();
    //                 if ($purchaseDetail) {
    //                 // Update purchase detail attributes
    //                 $purchaseDetail->company_id = $companyId;
    //                 $purchaseDetail->category_id = $request->category_id[$key];
    //                 $purchaseDetail->product_id = $request->product_id[$key];
    //                 $purchaseDetail->unit_price = $request->unit_price[$key];
    //                 $purchaseDetail->quantity = $request->quantity[$key];
    //                 $purchaseDetail->amount = $request->amount[$key];
    //                 $purchaseDetail->sub_amount = $request->sub_amount[$key];
    //                 $purchaseDetail->tax = $request->tax[$key];
    //                 $purchaseDetail->discount_type = $request->discount_type[$key];
    //                 $purchaseDetail->discount = $request->discount[$key];
    //                 $purchaseDetail->total_amount = $request->total_amount[$key];
    //                 $purchaseDetail->save(); // Save the updated purchase detail
    //             } else {
    //                 // Handle the case where the purchase detail doesn't exist
    //                 // You can choose to return an error message or handle it based on your application logic
    //             }

    //                 // Update stock
    //                 $stock = Stock::where('product_id', $request->product_id[$key])->first();
    //                 if ($stock) {
    //                     $stock->quantity = $request->quantity[$key];
    //                     $stock->save();
    //                 }
    //             }
    //         }

    //     DB::commit();
    //     return redirect()->route('purchase.index')->with('success', 'Product purchase details successfully updated');
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         dd($e); // You can remove this line after debugging
    //         return redirect()->route('purchase.edit', $id)->with('error', 'Something went wrong! Please try again.');
    //     }
    // }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
    public function PurchaseReport(Request $request)
    {
        $fromDate = $request->input('from_date')." 00:00:00";
        $toDate = $request->input('to_date')." 23:59:59";

        $purchase = Purchase::whereBetween('date', [$fromDate, $toDate])->get();

        return view('backend.purchase.index', compact('purchase', 'fromDate', 'toDate'));
    }
}
