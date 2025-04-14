<?php

namespace App\Http\Controllers\Backend;

use App\Models\BngPurchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BngPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bngPurchase = BngPurchase::orderBy('date','Desc')->get();
        return view('backend.bngpurchase.index',compact('bngPurchase'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.bngpurchase.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'purchase_title' => 'required|string',
                'amount' => 'required',
                'date' => 'required',
                // 'remarks' => 'required|string',
                // 'product_model' => 'required|string',
                // 'unit_price' => 'required|numeric',
                // 'file' => 'nullable|mimes:jpeg,jpg,png|max:3072', // Adjust max file size as needed (2048 KB = 3 MB)
            ]);
            $bngPurchase = new BngPurchase();
            $bngPurchase->purchase_title = $request->purchase_title;
            $bngPurchase->amount = $request->amount;
            $bngPurchase->date = $request->date;
            $bngPurchase->remarks = $request->remarks;
            $bngPurchase->save();
            $this->notice::success('Bng Purchase Created Successfully');
            return redirect()->route('bngpurchase.index');
            }catch (\Exception $e) {
                $this->notice::error('Something went wrong. Please try again later.');
                return redirect()->back();
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(BngPurchase $bngPurchase)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bngPurchase = BngPurchase::findOrFail(encryptor('decrypt',$id));
        return view('backend.bngpurchase.edit',compact('bngPurchase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'purchase_title' => 'required|string',
                'amount' => 'required',
                'date' => 'required',
                // 'remarks' => 'required|string',
                // 'product_model' => 'required|string',
                // 'unit_price' => 'required|numeric',
                // 'file' => 'nullable|mimes:jpeg,jpg,png|max:3072', // Adjust max file size as needed (2048 KB = 3 MB)
            ]);
            $bngPurchase = BngPurchase::findOrFail(encryptor('decrypt',$id));
            $bngPurchase->purchase_title = $request->purchase_title;
            $bngPurchase->amount = $request->amount;
            $bngPurchase->date = $request->date;
            $bngPurchase->remarks = $request->remarks;
            $bngPurchase->save();
            $this->notice::success('Bng Purchase Updated Successfully');
            return redirect()->route('bngpurchase.index');
        }catch (\Exception $e){
            $this->notice::error('Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bngPurchase = BngPurchase::findOrFail(encryptor('decrypt',$id));
        $bngPurchase->delete();
        $this->notice::success('Bng Purchase Deleted Successfully');
        return redirect()->route('bngpurchase.index');
    }
}
