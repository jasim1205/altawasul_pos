<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Traits\ImageHandleTraits;
Use File;

class ProductController extends Controller
{
    use ImageHandleTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::get();
        return view('backend.product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = Company::get();
        // $category = Category::get();
        return view('backend.product.create',compact('company'));
    }
    public function getCategoriesByCompany(Request $request)
    {
        $company_id = $request->get('company_id');

        // Fetch categories associated with the given company_id
        $categories = Category::where('company_id', $company_id)->pluck('category_name', 'id');

        return response()->json($categories);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'company_id' => 'required|integer',
                'category_id' => 'required|integer',
                'product_name' => 'required|string',
                'product_model' => 'required|string',
                // 'unit_price' => 'required|numeric',
                'file' => 'nullable|mimes:jpeg,jpg,png|max:3072', // Adjust max file size as needed (2048 KB = 3 MB)
            ]);

            $product = new Product;
            $product->company_id = $request->company_id;
            $product->category_id = $request->company_id;
            $product->product_name = $request->product_name;
            $product->product_model = $request->product_model;
            $product->unit_price = $request->unit_price;
            if($request->hasFile('product_image')){
                $imageName = rand(111,999).'.'.$request->product_image->extension();
                $request->product_image->move(public_path('uploads/product'),$imageName);
                $product->product_image = $imageName;
            }
            if($product->save()){
                $this->notice::success('Product Successfully Saved');
                return redirect()->route('product.index');
            }
        }catch(Exception $e){
            $this->notice::success('Something Wrong! Please try again');
            return redirect()->route('product.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = Company::get();
        $category = Category::get();
        $product = Product::findOrFail(encryptor('decrypt',$id));
        return view('backend.product.edit',compact('product','company','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $product = Product::findOrFail(encryptor('decrypt',$id));
            $product->company_id = $request->company_id;
            $product->category_id = $request->company_id;
            $product->product_name = $request->product_name;
            $product->product_model = $request->product_model;
            $product->unit_price = $request->unit_price;
            // if($request->hasFile('product_image')){
            //     $imageName = rand(111,999).'.'.$request->product_image->extension();
            //     $request->product_image->move(public_path('uploads/product'),$imageName);
            //     $product->product_image = $imageName;
            // }
            $path = 'uploads/product';

            if ($request->hasFile('product_image')) {
                $image = $request->file('product_image');

                // Delete the old image
                $this->deleteImage($product->product_image, $path);

                $imageName = rand(111, 999) . '.' . $image->extension();
                $imagePath = public_path("$path/$imageName");

                $product->product_image = $imageName;
            }
            if($product->save()){
                $this->notice::success('Product Successfully Saved');
                return redirect()->route('product.index');
            }
        }catch(Exception $e){
            $this->notice::success('Something Wrong! Please try again');
            return redirect()->route('product.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $product = Product::findOrFail(encryptor('decrypt',$id));
       if($product->delete()){
            $this->notice::success('Product Successfully Delete');
            return redirect()->route('product.index');
       }
    }
}
