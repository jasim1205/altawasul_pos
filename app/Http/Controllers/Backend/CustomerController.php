<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::get();
        return view('backend.customer.index',compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'customer_name' => 'required|unique:customers,customer_name',
                'email' => 'required|email|unique:customers,email',
                'contact_no' => 'required|integer|unique:customers,contact_no',
            ]);
            $data = new Customer;
            $data->customer_name = $request->customer_name;
            $data->email = $request->email;
            $data->contact_no = $request->contact_no;
            $data->address = $request->address;
            if($data->save()){
                $this->notice::success('Data successfully saved');
                return redirect()->route('customer.index');
            }
        }catch(Exception $e){
            $this->notice::error('something wrong!Please try again');
            return redirect()->route('customer.create')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $customer = Customer::findOrFail(encryptor('decrypt',$id));
        return view('backend.customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'customer_name' => 'required|unique:customers,customer_name,'.encryptor('decrypt',$id),
                'email' => 'required|email|unique:customers,email,'.encryptor('decrypt',$id),
                'contact_no' => 'required|integer|unique:customers,contact_no,'.encryptor('decrypt',$id),
            ]);
            $data = Customer::findOrFail(encryptor('decrypt',$id));
            $data->customer_name = $request->customer_name;
            $data->email = $request->email;
            $data->contact_no = $request->contact_no;
            $data->address = $request->address;
            if($data->save()){
                $this->notice::success('Data successfully Updated');
                return redirect()->route('customer.index');
            }
        }catch(Exception $e){
            $this->notice::error('something wrong!Please try again');
            return redirect()->route('customer.create')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Customer::findOrFail(encryptor('decrypt',$id));
        if($data->delete()){
            $this->notice::success('Data successfully Deleted');
            return redirect()->route('customer.index');
        }
    }
}
