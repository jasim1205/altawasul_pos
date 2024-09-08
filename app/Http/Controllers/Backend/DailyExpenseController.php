<?php


namespace App\Http\Controllers\Backend;



use App\Models\DailyExpense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DailyExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dailyexpense = DailyExpense::orderBy('date','Desc')->get();
        return view('backend.dailyexpense.index',compact('dailyexpense'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.dailyexpense.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'purpose_title' => 'required|string',
                'amount' => 'required',
                'remarks' => 'required|string',
                // 'product_model' => 'required|string',
                // 'unit_price' => 'required|numeric',
                'file' => 'nullable|mimes:jpeg,jpg,png|max:3072', // Adjust max file size as needed (2048 KB = 3 MB)
            ]);

            $expense = new DailyExpense;
            $expense->purpose_title = $request->purpose_title;
            $expense->amount = $request->amount;
            $expense->date = $request->date;
            $expense->remarks = $request->remarks;
            // if($request->hasFile('product_image')){
            //     $imageName = rand(111,999).'.'.$request->product_image->extension();
            //     $request->product_image->move(public_path('uploads/product'),$imageName);
            //     $product->product_image = $imageName;
            // }

            if($expense->save()){
                $this->notice::success('Daily Expense Successfully Saved');
                return redirect()->route('dailyexpense.index');
            }
        }catch(Exception $e){

            dd($e);
            $this->notice::success('Something Wrong! Please try again');
            return redirect()->route('product.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyExpense $dailyExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $dailyexpense = DailyExpense::findOrFail(encryptor('decrypt',$id));
        return view('backend.dailyexpense.edit',compact('dailyexpense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'purpose_title' => 'required|string',
                'amount' => 'required',
                'remarks' => 'required|string',
                // 'product_model' => 'required|string',
                // 'unit_price' => 'required|numeric',
                'file' => 'nullable|mimes:jpeg,jpg,png|max:3072', // Adjust max file size as needed (2048 KB = 3 MB)
            ]);

            $expense = DailyExpense::findOrFail(encryptor('decrypt',$id));
            $expense->purpose_title = $request->purpose_title;
            $expense->amount = $request->amount;
            $expense->date = $request->date;
            $expense->remarks = $request->remarks;


            if($expense->save()){
                $this->notice::success('Daily Expense Successfully Update');
                return redirect()->route('dailyexpense.index');
            }
        }catch(Exception $e){

            dd($e);
            $this->notice::success('Something Wrong! Please try again');
            return redirect()->route('product.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $expense = DailyExpense::findOrFail(encryptor('decrypt',$id));
        if($expense->delete()){
            $this->notice::success('Daily Expense Successfully Delete');
            return redirect()->route('dailyexpense.index');
        }
    }
}
