<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Company::get();
        return view('backend.company.index',compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'company_name' => 'required|string',
                'email' => 'required|email',
                'contact_no' => 'required|integer',
                'address' => 'required|string',
            ]);
            $company = new Company;
            $company->company_name = $request->company_name;
            $company->email = $request->email;
            $company->contact_no = $request->contact_no;
            $company->address = $request->address;
            if($company->save()){
                $this->notice::success('Data successfully saved');
                return redirect()->route('company.index');
            }
        }catch(Exception $e){
            $this->notice::error('something wrong!Please try again');
            return redirect()->route('company.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = Company::findOrFail(encryptor('decrypt',$id));
        return view('backend.company.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $company = Company::findOrFail(encryptor('decrypt',$id));
            $company->company_name = $request->company_name;
            $company->email = $request->email;
            $company->contact_no = $request->contact_no;
            $company->address = $request->address;
            // $companylist = explode(',',$request->address);
            // $company->address = $companylist;
            if($company->save()){
                $this->notice::success('Data successfully saved');
                return redirect()->route('company.index');
            }
        }catch(Exception $e){
            $this->notice::error('something wrong!Please try again');
            return redirect()->route('company.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = Company::findOrFail(encryptor('decrypt',$id));
        if($company->delete()){
            $this->notice::success('Data successfully Deleted');
            return redirect()->route('company.index');
        }
    }
}
