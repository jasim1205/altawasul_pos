<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // public function frontend(){
    //     $company = Company::get();
    //     $product = Product::paginate(12);
    //     return view('frontend.index', compact('product','company'));
    // }
    
    public function frontend(Request $request)
    {
        $company = Company::all();
        $query = Product::query();

        // Filter by company if selected
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        // Filter by product name if searched
        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        $product = $query->paginate(12);

        return view('frontend.index', compact('product', 'company'));
    }

    public function productDetail($id){
        $product = Product::find($id);
        return view('frontend.productDetail', compact('product'));
    }
}
