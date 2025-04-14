<?php

namespace App\Http\Controllers\Backend;

use App\Models\UsedPurchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsedPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usedPurchase = UsedPurchase::orderBy('date','Desc')->get();;
        return view('backend.usedPurchase.index',compact('usedPurchase'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.usedPurchase.create');
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
            $usedPurchase = new UsedPurchase();
            $usedPurchase->purchase_title = $request->purchase_title;
            $usedPurchase->amount = $request->amount;
            $usedPurchase->date = $request->date;
            $usedPurchase->remarks = $request->remarks;
            $usedPurchase->save();
            $this->notice::success('Used Purchase Created Successfully');
            return redirect()->route('usedpurchase.index');
        }
        catch(Exception $e){

            dd($e);
            $this->notice::success('Something Wrong! Please try again');
            return redirect()->route('usedpurchase.create');
        }
            
    }

    /**
     * Display the specified resource.
     */
    public function show(UsedPurchase $usedPurchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usedPurchase = UsedPurchase::findOrFail(encryptor('decrypt',$id));
        return view('backend.usedPurchase.edit',compact('usedPurchase'));
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
            $usedPurchase = UsedPurchase::findOrFail(encryptor('decrypt',$id));
            $usedPurchase->purchase_title = $request->purchase_title;
            $usedPurchase->amount = $request->amount;
            $usedPurchase->date = $request->date;
            $usedPurchase->remarks = $request->remarks;
            $usedPurchase->save();
            $this->notice::success('Used Purchase Updated Successfully');
            return redirect()->route('usedpurchase.index');
        }
        catch(Exception $e){
            dd($e);
            $this->notice::success('Something Wrong! Please try again');
            return redirect()->route('usedpurchase.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usedPurchase= UsedPurchase::findOrFail(encryptor('decrypt',$id));
        $usedPurchase->delete();
        $this->notice::success('Used Purchase Deleted Successfully');
        return redirect()->route('usedpurchase.index');
    }
}
