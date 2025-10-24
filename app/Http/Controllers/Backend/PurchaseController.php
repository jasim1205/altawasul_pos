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
        $supplier = Supplier::get();
        return view('backend.purchase.create',compact('company','category','product','supplier'));
    }

    public function getCategoriesByCompany(Request $request)
    {
        $company_id = $request->input('company_id');

        // Assuming you have a 'categories' table with 'id' and 'category_name' columns
        $categories = Category::where('company_id', $company_id)->pluck('category_name', 'id');

        return response()->json($categories);
    }

    // public function getProductsByCategoryAndCompany(Request $request)
    // {
    //     $company_id = $request->input('company_id');
    //     $category_id = $request->input('category_id');

    //     // Assuming you have a 'products' table with 'id' and 'product_name' columns
    //     $products = Product::where('company_id', $company_id)
    //                         ->where('category_id', $category_id)
    //                         ->pluck('product_name', 'id');
    //     // $products = Product::join('stocks', 'products.id', '=', 'stocks.product_id')
    //     //                     ->where('products.company_id', $company_id)
    //     //                     ->where('products.category_id', $category_id)
    //     //                     ->where('stocks.quantity', '>', 0)
    //     //                     ->pluck('products.product_name', 'products.id');

    //     return response()->json($products);
    // }

    public function getProductsByCategoryAndCompany(Request $request)
    {
        // $category_id = $request->input('category_id');
        $company_id = $request->input('company_id');

        // Assuming you have a Product model related to the Stock model
        $products = Product::where('company_id', $company_id)
                            // ->where('category_id', $category_id)
                            ->with('stock') // Ensure you have a relationship with the Stock model
                            ->get();

        $response = [];
        foreach($products as $product) {
            $stockQuantity = $product->stock ? $product->stock->quantity : 0; // Get stock quantity or default to 0
            $response[$product->id] = $product->product_name . ' (' . $stockQuantity . ')'; // Include stock in parentheses
        }

        return response()->json($response);
    }

    //**
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // // Save supplier information
            // $supplier = new Supplier;
            // $supplier->supplier_name = $request->supplier_name;
            // $supplier->email = $request->email;
            // $supplier->contact_no = $request->contact_no;
            // $supplier->date = $request->date;
            // $supplier->save();

            // Save purchase information
            $purchase = new Purchase;
            $purchase->supplier_id = $request->supplier_id; // Link purchase to supplier
            $purchase->date = $request->date;
            $purchase->tm_no = $request->tm_no;
            $purchase->rf_no = $request->rf_no;
            $purchase->explanation = $request->explanation;
            $purchase->total_quantity = $request->total_quantity;
            $purchase->total_quantity_amount = $request->total_quantity_amount;
            $purchase->total_discount = $request->total_discount;
            $purchase->total_tax = $request->total_tax;
            $purchase->total_tax_amount = $request->total_tax_amount;
            $purchase->total_subamount = $request->total_subamount;
            $purchase->grand_total_amount = $request->grand_total_amount;
            $purchase->pay_amount = $request->pay_amount;
            $purchase->status = $request->status;
            $purchase->save();

            // Save purchase details
            if ($request->has('product_id')) {
                foreach ($request->product_id as $key => $productId) {
                    $purchaseDetail = new PurchaseDetails;
                    $purchaseDetail->purchase_id = $purchase->id; // Link purchase detail to purchase
                    // $purchaseDetail->company_id = $request->company_id[$key];
                    // $purchaseDetail->category_id = $request->category_id[$key];
                    $purchaseDetail->product_id = $productId;
                    $purchaseDetail->unit_price = $request->unit_price[$key];
                    $purchaseDetail->quantity = $request->quantity[$key];
                    $purchaseDetail->amount = $request->amount[$key];
                    $purchaseDetail->sub_amount = $request->sub_amount[$key];
                    $purchaseDetail->tax = $request->tax[$key];
                    $purchaseDetail->tax_amount = $request->tax_amount[$key];
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
        $supplier = Supplier::get();
        $category = [];
        // $product = Product::get();
        $product = [];
        $purchase = Purchase::findOrFail(encryptor('decrypt',$id));
        $purchaseDetails = $purchase->purchasedetails;
        // $purchaseDetail = PurchaseDetails::where('purchase_id',$id)->get();
        return view('backend.purchase.edit',compact('company','category','product','purchase','purchaseDetails','supplier'));
    }

    /**
     * Update the specified resource in storage.
     */

    // public function update(Request $request, $id)
    // {
    //     try {
    //         DB::beginTransaction();

    //         // Update purchase information
    //         $purchase = Purchase::findOrFail(encryptor('decrypt', $id));
    //         $purchase->date = $request->date;
    //         $purchase->total_quantity = $request->total_quantity;
    //         $purchase->total_quantity_amount = $request->total_quantity_amount;
    //         $purchase->total_discount = $request->total_discount;
    //         $purchase->total_tax = $request->total_tax;
    //         $purchase->total_subamount = $request->total_subamount;
    //         $purchase->grand_total_amount = $request->grand_total_amount;
    //         $purchase->status = $request->status;
    //         $purchase->save();

    //         $supplier = Supplier::find($purchase->id);
    //         $supplier->supplier_name = $request->supplier_name;
    //         $supplier->email = $request->email;
    //         $supplier->contact_no = $request->contact_no;
    //         $supplier->date = $request->date;
    //         $supplier->save();

    //         // Update purchase details
    //         if ($request->has('company_id')) {
    //             foreach ($request->company_id as $key => $companyId) {
    //                 if($companyId){

    //                     $purchaseDetail = PurchaseDetails::where('purchase_id', encryptor('decrypt', $id))->skip($key)->first();
    //                     if($purchaseDetail){

    //                         $purchaseDetail->company_id = $companyId;
    //                         $purchaseDetail->category_id = $request->category_id[$key];
    //                         $purchaseDetail->product_id = $request->product_id[$key];
    //                         $purchaseDetail->unit_price = $request->unit_price[$key];
    //                         $purchaseDetail->quantity = $request->quantity[$key];
    //                         $purchaseDetail->amount = $request->amount[$key];
    //                         $purchaseDetail->sub_amount = $request->sub_amount[$key];
    //                         $purchaseDetail->tax = $request->tax[$key];
    //                         $purchaseDetail->discount_type = $request->discount_type[$key];
    //                         $purchaseDetail->discount = $request->discount[$key];
    //                         $purchaseDetail->total_amount = $request->total_amount[$key];
    //                         $purchaseDetail->save();
    //                     } else {
    //                         // If $purchaseDetail doesn't exist, create a new one
    //                         $purchaseDetail = new PurchaseDetails;
    //                         $purchaseDetail->purchase_id = $purchase->id; // Link purchase detail to purchase
    //                         $purchaseDetail->company_id = $companyId;
    //                         $purchaseDetail->category_id = $request->category_id[$key];
    //                         $purchaseDetail->product_id = $request->product_id[$key];
    //                         $purchaseDetail->unit_price = $request->unit_price[$key];
    //                         $purchaseDetail->quantity = $request->quantity[$key];
    //                         $purchaseDetail->amount = $request->amount[$key];
    //                         $purchaseDetail->sub_amount = $request->sub_amount[$key];
    //                         $purchaseDetail->tax = $request->tax[$key];
    //                         $purchaseDetail->discount_type = $request->discount_type[$key];
    //                         $purchaseDetail->discount = $request->discount[$key];
    //                         $purchaseDetail->total_amount = $request->total_amount[$key];
    //                         $purchaseDetail->save();


    //                     }
    //                 }
    //             }
    //         }
    //         // foreach ($request->product_id as $key => $productId) {
    //         //     $quantity = $request->quantity[$key];

    //         //     $stock = Stock::where('product_id', $productId)->first();
    //         //     if (!$stock) {
    //         //         // Create new stock entry
    //         //         $stock = new Stock;
    //         //         $stock->product_id = $productId;
    //         //         $stock->purchase_id = $purchase->id;
    //         //         $stock->quantity = $quantity;
    //         //         $stock->save();
    //         //     } else {
    //         //         // Update existing stock entry
    //         //         $stock->quantity = $quantity;
    //         //         $stock->product_id = $productId;
    //         //         $stock->save();
    //         //     }
    //         // }
    //         foreach ($request->product_id as $key => $productId) {
    //             $quantity = $request->quantity[$key];

    //             // Find the corresponding purchase detail
    //             $purchaseDetail = PurchaseDetails::where('product_id', $productId)->where('purchase_id', $purchase->id)->first();

    //             if ($purchaseDetail) {
    //                 // Deduct the old quantity from stock
    //                 $oldQuantity = $purchaseDetail->quantity;
    //                 $stock = Stock::where('product_id', $productId)->first();
    //                 $stock->quantity -= $oldQuantity;

    //                 // Add the new quantity to stock
    //                 if ($stock) {
    //                     $stock->quantity += $quantity;
    //                     $stock->save();
    //                 } else {
    //                     // If there is no existing stock entry, create a new one
    //                     $stock = new Stock;
    //                     $stock->product_id = $productId;
    //                     $stock->purchase_id = $purchase->id;
    //                     $stock->quantity = $quantity;
    //                     $stock->save();
    //                 }
    //             }
    //         }

    //         DB::commit();
    //         return redirect()->route('purchase.index')->with('success', 'Purchase details successfully updated');
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         dd($e); // You can remove this line after debugging
    //         return redirect()->route('purchase.edit', $id)->with('error', 'Something went wrong! Please try again.');
    //     }
    // }
    // public function update(Request $request, $id)
    // {
    //     try {
    //         DB::beginTransaction();

    //         // Update purchase information
    //         $purchase = Purchase::findOrFail(encryptor('decrypt', $id));
    //         $purchase->date = $request->date;
    //         $purchase->total_quantity = $request->total_quantity;
    //         $purchase->total_quantity_amount = $request->total_quantity_amount;
    //         $purchase->total_discount = $request->total_discount;
    //         $purchase->total_tax = $request->total_tax;
    //         $purchase->total_subamount = $request->total_subamount;
    //         $purchase->grand_total_amount = $request->grand_total_amount;
    //         $purchase->status = $request->status;
    //         $purchase->save();

    //         $supplier = Supplier::find($purchase->supplier_id);
    //         $supplier->supplier_name = $request->supplier_name;
    //         $supplier->email = $request->email;
    //         $supplier->contact_no = $request->contact_no;
    //         $supplier->date = $request->date;
    //         $supplier->save();

    //         // Delete existing purchase details
    //         PurchaseDetails::where('purchase_id', $purchase->id)->delete();

    //         // Reset stock quantities for products
    //         foreach ($request->product_id as $key => $productId) {
    //             $stock = Stock::where('product_id', $productId)->first();
    //             if ($stock) {
    //                 $purchaseDetail = PurchaseDetails::where('purchase_id', $purchase->id)->where('product_id', $productId)->first();
    //                 if ($purchaseDetail) {
    //                     $oldQuantity = $purchaseDetail->quantity;
    //                     $stock->quantity -= $oldQuantity;
    //                     $stock->save();
    //                 }
    //             }
    //         }

    //         // Store new purchase details and update stock
    //         if ($request->has('company_id')) {
    //             foreach ($request->company_id as $key => $companyId) {
    //                 if ($companyId) {
    //                     // Store new purchase detail
    //                     $purchaseDetail = new PurchaseDetails;
    //                     $purchaseDetail->purchase_id = $purchase->id; // Link purchase detail to purchase
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
    //                     $purchaseDetail->save();

    //                     // Update stock
    //                     $stock = Stock::where('product_id', $request->product_id[$key])->first();
    //                     if ($stock) {
    //                         $stock->quantity += $request->quantity[$key];
    //                         $stock->save();
    //                     } else {
    //                         // Create new stock entry if it doesn't exist
    //                         $stock = new Stock;
    //                         $stock->product_id = $request->product_id[$key];
    //                         $stock->purchase_id = $purchase->id;
    //                         $stock->quantity = $request->quantity[$key];
    //                         $stock->save();
    //                     }
    //                 }
    //             }
    //         }

    //         DB::commit();
    //         return redirect()->route('purchase.index')->with('success', 'Purchase details successfully updated');
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return redirect()->route('purchase.edit', $id)->with('error', 'Something went wrong! Please try again.');
    //     }
    // }
public function update(Request $request, $id)
{
    try {
        DB::beginTransaction();

        // Update purchase information
        $purchase = Purchase::findOrFail(encryptor('decrypt', $id));
        $purchase->supplier_id = $request->supplier_id; // Link purchase to supplier
        $purchase->date = $request->date;
        $purchase->tm_no = $request->tm_no;
        $purchase->rf_no = $request->rf_no;
        $purchase->explanation = $request->explanation;
        $purchase->total_quantity = $request->total_quantity;
        $purchase->total_quantity_amount = $request->total_quantity_amount;
        $purchase->total_discount = $request->total_discount;
        $purchase->total_tax = $request->total_tax;
        $purchase->total_tax_amount = $request->total_tax_amount;
        $purchase->total_subamount = $request->total_subamount;
        $purchase->grand_total_amount = $request->grand_total_amount;
        $purchase->pay_amount = $request->pay_amount;
        $purchase->status = $request->status;
        $purchase->save();

        // $supplier = Supplier::find($purchase->supplier_id);
        // $supplier->supplier_name = $request->supplier_name;
        // $supplier->email = $request->email;
        // $supplier->contact_no = $request->contact_no;
        // $supplier->date = $request->date;
        // $supplier->save();

        // Delete existing purchase details and adjust stock
        $existingPurchaseDetails = PurchaseDetails::where('purchase_id', $purchase->id)->get();
        foreach ($existingPurchaseDetails as $existingDetail) {
            $stock = Stock::where('product_id', $existingDetail->product_id)->first();
            if ($stock) {
                // Deduct the quantity from the existing stock
                $stock->quantity -= $existingDetail->quantity;
                $stock->save();
            }
        }
        // Delete existing purchase details
        PurchaseDetails::where('purchase_id', $purchase->id)->delete();

        // Store new purchase details and update stock
        if ($request->has('product_id')) {
            foreach ($request->product_id as $key => $productId) {
                if ($productId) {
                    // Store new purchase detail
                    $purchaseDetail = new PurchaseDetails;
                    $purchaseDetail->purchase_id = $purchase->id; // Link purchase detail to purchase
                    // $purchaseDetail->company_id = $companyId;
                    // $purchaseDetail->category_id = $request->category_id[$key];
                    $purchaseDetail->product_id = $request->product_id[$key];
                    $purchaseDetail->unit_price = $request->unit_price[$key];
                    $purchaseDetail->quantity = $request->quantity[$key];
                    $purchaseDetail->amount = $request->amount[$key];
                    $purchaseDetail->sub_amount = $request->sub_amount[$key];
                    $purchaseDetail->tax = $request->tax[$key];
                    $purchaseDetail->tax_amount = $request->tax_amount[$key];
                    $purchaseDetail->discount_type = $request->discount_type[$key];
                    $purchaseDetail->discount = $request->discount[$key];
                    $purchaseDetail->total_amount = $request->total_amount[$key];
                    $purchaseDetail->save();

                    // Update stock
                    $stock = Stock::where('product_id', $request->product_id[$key])->first();
                    if ($stock) {
                        $stock->quantity += $request->quantity[$key];
                        $stock->save();
                    } else {
                        // Create new stock entry if it doesn't exist
                        $stock = new Stock;
                        $stock->product_id = $request->product_id[$key];
                        // $stock->purchase_id = $purchase->id;
                        $stock->quantity = $request->quantity[$key];
                        $stock->save();
                    }
                }
            }
        }

        DB::commit();
        return redirect()->route('purchase.index')->with('success', 'Purchase details successfully updated');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('purchase.edit', $id)->with('error', 'Something went wrong! Please try again.');
    }
}


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

        return view('backend.purchase.purchasepdf', compact('purchase', 'fromDate', 'toDate'));
    }

    // Assuming this is your controller method
    public function getStockByProduct(Request $request)
    {
        $product_id = $request->input('product_id');

        // Assuming you have a Stock model with a 'product_id' and 'quantity' column
        $stock = Stock::where('product_id', $product_id)->get();
                //   ->where('quantity', '>', 0) // Filter out products with zero quantity
                //   ->first();


            return response()->json(['quantity' => $stock->quantity]);

    }

}