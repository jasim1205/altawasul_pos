<?php

namespace App\Http\Controllers\Backend;

use App\Models\HomeExpense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $homeexpense = HomeExpense::orderBy('date','Desc')->get();
        return view('backend.homeexpense.index',compact('homeexpense'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.homeexpense.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try{
            $request->validate([
                'expense_title' => 'required|string',
                'amount' => 'required',
                // 'remarks' => 'required|string',
                // 'product_model' => 'required|string',
                // 'unit_price' => 'required|numeric',
                'file' => 'nullable|mimes:jpeg,jpg,png|max:3072', // Adjust max file size as needed (2048 KB = 3 MB)
            ]);

            $expense = new HomeExpense;
            $expense->expense_title = $request->expense_title;
            $expense->amount = $request->amount;
            $expense->date = $request->date;
            $expense->remarks = $request->remarks;
            // if($request->hasFile('product_image')){
            //     $imageName = rand(111,999).'.'.$request->product_image->extension();
            //     $request->product_image->move(public_path('uploads/product'),$imageName);
            //     $product->product_image = $imageName;
            // }

            if($expense->save()){
                $this->notice::success('Home Expense Successfully Saved');
                return redirect()->route('homeexpense.index');
            }
        }catch(Exception $e){

            dd($e);
            $this->notice::success('Something Wrong! Please try again');
            return redirect()->route('homeexpense.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeExpense $homeExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $homeexpense = HomeExpense::findOrFail(encryptor('decrypt',$id));
        return view('backend.homeexpense.edit',compact('homeexpense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'expense_title' => 'required|string',
                'amount' => 'required',
                // 'remarks' => 'required|string',
                // 'product_model' => 'required|string',
                // 'unit_price' => 'required|numeric',
                'file' => 'nullable|mimes:jpeg,jpg,png|max:3072', // Adjust max file size as needed (2048 KB = 3 MB)
            ]);

            $expense = homeexpense::findOrFail(encryptor('decrypt',$id));
            $expense->expense_title = $request->expense_title;
            $expense->amount = $request->amount;
            $expense->date = $request->date;
            $expense->remarks = $request->remarks;


            if($expense->save()){
                $this->notice::success('HOme Expense Successfully Update');
                return redirect()->route('homeexpense.index');
            }
        }catch(Exception $e){

            dd($e);
            $this->notice::success('Something Wrong! Please try again');
            return redirect()->route('homeexpense.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $homeexpense = HomeExpense::findOrFail(encryptor('decrypt',$id));
        if($homeexpense->delete()){
            $this->notice::success('Home Expense Successfully Delete');
            return redirect()->route('homeexpense.index');
        }
    }
}
