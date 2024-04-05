<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::ger;
        return view('backend.category.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $category = new Category;
            $category->category = $request->category;
            if($category->save()){
                $this->notice::success('Data successfully saved');
                return redirect()->route('category.index');
            }
        }catch(Exception $e){
            $this->notice::error('something wrong!Please try again');
            return redirect()->route('category.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $category = Company::findOrFail(encryptor('decrypt',$id));
       return view('backend.company.eidt',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $category = Company::findOrFail(encryptor('decrypt',$id));
            $category->category = $request->category;
            if($category->save()){
                $this->notice::success('Data successfully Updated');
                return redirect()->route('category.index');
            }
        }catch(Exception $e){
            $this->notice::error('something wrong!Please try again');
            return redirect()->route('category.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Company::findOrFail(encryptor('decrypt',$id));
        if($category->delete()){
            $this->notice::success('Data successfully Deleted');
            return redirect()->route('category.index');
        }
    }
}
