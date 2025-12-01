<?php

namespace App\Http\Controllers\Backend;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::get();
        return view('backend.supplier.index',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try{
            $request->validate([
                'supplier_name' => 'required|unique:suppliers,supplier_name',
                // 'email' => 'nullable|email|unique:suppliers,email',
                'contact_no' => 'required|string|unique:suppliers,contact_no',
            ]);
            $data = new Supplier;
            $data->supplier_name = $request->supplier_name;
            $data->email = $request->email;
            $data->contact_no = $request->contact_no;
            $data->address = $request->address;
            if($data->save()){
                $this->notice::success('Data successfully saved');
                return redirect()->route('supplier.index');
            }
        }catch(Exception $e){
            $this->notice::error('something wrong!Please try again');
            return redirect()->route('supplier.create')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail(encryptor('decrypt',$id));
        return view('backend.supplier.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'supplier_name' => 'required|unique:suppliers,supplier_name,'.encryptor('decrypt',$id),
                // 'email' => 'required|email|unique:suppliers,email,'.encryptor('decrypt',$id),
                'contact_no' => 'required|integer|unique:suppliers,contact_no,'.encryptor('decrypt',$id),
            ]);
            $data = Supplier::findOrFail(encryptor('decrypt',$id));
            $data->supplier_name = $request->supplier_name;
            $data->email = $request->email;
            $data->contact_no = $request->contact_no;
            $data->address = $request->address;
            if($data->save()){
                $this->notice::success('Data successfully Updated');
                return redirect()->route('supplier.index');
            }
        }catch(Exception $e){
            $this->notice::error('something wrong!Please try again');
            return redirect()->route('supplier.create')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Supplier::findOrFail(encryptor('decrypt',$id));
        if($data->delete()){
            $this->notice::success('Data successfully Deleted');
            return redirect()->route('supplier.index');
        }
    }
}
