<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Sales;
use App\Models\Customer;
use App\Models\Company;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\SaleDetails;
use Illuminate\Http\Request;
use DB;

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
            $customer = new Customer;
            $customer->customer_name = $request->customer_name;
            $customer->email = $request->email;
            $customer->contact_no = $request->contact_no;
            $customer->date = $request->date;
            $customer->save();

            // Save purchase information
            $sale = new Sales;
            $sale->customer_id = $customer->id; // Link purchase to supplier
            $sale->date = $request->date;
            $sale->total_quantity = $request->total_quantity;
            $sale->total_quantity_amount = $request->total_quantity_amount;
            $sale->total_discount = $request->total_discount;
            $sale->total_tax = $request->total_tax;
            $sale->total_subamount = $request->total_subamount;
            $sale->grand_total_amount = $request->grand_total_amount;
            $sale->paid = $request->paid;
            $sale->status = $request->status;
            $sale->save();

            // Save purchase details
            if ($request->has('company_id')) {
                foreach ($request->company_id as $key => $companyId) {
                    $saledetails = new SaleDetails;
                    $saledetails->sale_id = $sale->id; // Link purchase detail to purchase
                    $saledetails->company_id = $companyId;
                    $saledetails->category_id = $request->category_id[$key];
                    $saledetails->product_id = $request->product_id[$key];
                    $saledetails->unit_price = $request->unit_price[$key];
                    $saledetails->quantity = $request->quantity[$key];
                    $saledetails->amount = $request->amount[$key];
                    $saledetails->sub_amount = $request->sub_amount[$key];
                    $saledetails->tax = $request->tax[$key];
                    $saledetails->discount_type = $request->discount_type[$key];
                    $saledetails->discount = $request->discount[$key];
                    $saledetails->total_amount = $request->total_amount[$key];
                    $saledetails->save();

                    // Update or create stock
                    $stock = Stock::where('product_id', $request->product_id[$key])->first();
                    if ($stock) {
                        $stock->quantity -= $request->quantity[$key];
                    } else {

                    }
                    $stock->save();
                }
            }

            DB::commit();
            return redirect()->route('sale.index')->with('success', 'Product successfully saled');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e); // You can remove this line after debugging
            return redirect()->route('sale.create')->with('error', 'Something went wrong! Please try again.');
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
        $saledetail = SaleDetails::where('sale_id',$id)->get();
        $sale = Sales::findOrFail(encryptor('decrypt',$id));
        return view('backend.sale.show',compact('company','category','product','sale','saledetail'));
    }
    public function invoice($id)
    {
        $company = Company::get();
        $category = Category::get();
        $product = Product::get();
        // $saledetail = SaleDetails::where('sale_id',$id)->get();
        $sale = Sales::findOrFail(encryptor('decrypt',$id));
        $saledetail = $sale->saledetails;
        return view('backend.sale.invoice',compact('company','category','product','sale','saledetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = Company::get();
        $category = [];
        // $product = Product::get();
        $product = [];
        $sale = Sales::findOrFail(encryptor('decrypt',$id));
        $saledetail = SaleDetails::where('sale_id',$sale->id)->get();
        return view('backend.sale.edit',compact('company','category','product','sale','saledetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Retrieve existing sale and customer
            $sale = Sales::findOrFail(encryptor('decrypt',$id));
            $customer = Customer::find($sale->customer_id);

            // Retrieve old sale details
            $oldSaleDetails = SaleDetails::where('sale_id', $sale->id)->get();

            // Update customer information
            $customer->customer_name = $request->customer_name;
            $customer->email = $request->email;
            $customer->contact_no = $request->contact_no;
            $customer->date = $request->date;
            $customer->save();

            // Update sale information
            $sale->date = $request->date;
            $sale->total_quantity = $request->total_quantity;
            $sale->total_quantity_amount = $request->total_quantity_amount;
            $sale->total_discount = $request->total_discount;
            $sale->total_tax = $request->total_tax;
            $sale->total_subamount = $request->total_subamount;
            $sale->grand_total_amount = $request->grand_total_amount;
            $sale->paid = $request->paid;
            $sale->status = $request->status;
            $sale->save();

            // Return stock quantities from old sale details
            foreach ($oldSaleDetails as $detail) {
                $stock = Stock::where('product_id', $detail->product_id)->first();
                if ($stock) {
                    $stock->quantity += $detail->quantity;
                    $stock->save();
                }
            }

            // Remove old sale details
            SaleDetails::where('sale_id', $sale->id)->delete();

            // Save new sale details and update stock
            if ($request->has('company_id')) {
                foreach ($request->company_id as $key => $companyId) {
                    $saledetails = new SaleDetails;
                    $saledetails->sale_id = $sale->id;
                    $saledetails->company_id = $companyId;
                    $saledetails->category_id = $request->category_id[$key];
                    $saledetails->product_id = $request->product_id[$key];
                    $saledetails->unit_price = $request->unit_price[$key];
                    $saledetails->quantity = $request->quantity[$key];
                    $saledetails->amount = $request->amount[$key];
                    $saledetails->sub_amount = $request->sub_amount[$key];
                    $saledetails->tax = $request->tax[$key];
                    $saledetails->discount_type = $request->discount_type[$key];
                    $saledetails->discount = $request->discount[$key];
                    $saledetails->total_amount = $request->total_amount[$key];
                    $saledetails->save();

                    // Update stock for new sale details
                    $stock = Stock::where('product_id', $request->product_id[$key])->first();
                    if ($stock) {
                        $stock->quantity -= $request->quantity[$key];
                        $stock->save();
                    }
                }
            }

            DB::commit();
            return redirect()->route('sale.index')->with('success', 'Product successfully updated');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e); // Remove after debugging
            return redirect()->route('sale.edit', $id)->with('error', 'Something went wrong! Please try again.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sales)
    {
        //
    }

    public function salesReport(Request $request)
    {
        $fromDate = $request->input('from_date')." 00:00:00";
        $toDate = $request->input('to_date')." 23:59:59";

        $sale = Sales::whereBetween('date', [$fromDate, $toDate])->get();

        return view('backend.sale.index', compact('sale', 'fromDate', 'toDate'));
    }

    public function salegetStockByProduct(Request $request)
    {
        $product_id = $request->input('product_id');

        // Assuming you have a Stock model with a 'product_id' and 'quantity' column
        $stock = Stock::where('product_id', $product_id)
                  ->where('quantity', '>', 0) // Filter out products with zero quantity
                  ->first();


            return response()->json(['quantity' => $stock->quantity]);

    }
}
