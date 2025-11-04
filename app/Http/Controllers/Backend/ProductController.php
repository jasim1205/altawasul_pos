<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Company;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
Use File;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageHandleTraits;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends Controller
{
    use ImageHandleTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $product = Product::get();
        // return view('backend.product.index',compact('product'));
        $search = $request->input('search');

        $product = Product::when($search, function ($query, $search) {
            $query->where('product_name', 'like', "%{$search}%")
                ->orWhere('cost_code', 'like', "%{$search}%")
                ->orWhere('product_model', 'like', "%{$search}%")
                ->orWhere('origin', 'like', "%{$search}%");
        })
        ->orderBy('id', 'desc')
        ->paginate(10); // optional pagination

        return view('backend.product.index', compact('product', 'search'));
    }

    public function reportForm()
    {
        // dd('here');
        return view('backend.product.reportForm');
    }
    
    public function generatePDF(Request $request)
    {
        $request->validate([
            'filter' => 'required',
        ]);
    
        $query = Product::query();
    
        // Determine date range
        if ($request->filter === '7days') {
            $start_date = Carbon::now()->subDays(7)->startOfDay();
            $end_date = Carbon::now()->endOfDay();
            $query->whereBetween('created_at', [$start_date, $end_date]);
    
        } elseif ($request->filter === '30days') {
            $start_date = Carbon::now()->subDays(30)->startOfDay();
            $end_date = Carbon::now()->endOfDay();
            $query->whereBetween('created_at', [$start_date, $end_date]);
    
        } elseif ($request->filter === 'custom') {
            $request->validate([
                'start_date' => 'required|date',
                'end_date'   => 'required|date|after_or_equal:start_date',
            ]);
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$start_date, $end_date]);
    
        } else {
            // "all" selected
            $start_date = null;
            $end_date = null;
        }
    
        $products = $query->get();
    
        $data = [
            'products' => $products,
            'start_date' => $start_date ? $start_date->format('Y-m-d') : 'All',
            'end_date' => $end_date ? $end_date->format('Y-m-d') : 'All',
            'filter' => $request->filter,
        ];
    
        $pdf = Pdf::loadView('backend.product.productPdf', $data)->setPaper('a4', 'portrait');
    
        return $pdf->stream('product_report_'.$request->filter.'.pdf');
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
                // 'company_id' => 'required|integer',
                // 'category_id' => 'required|integer',
                'product_name' => 'required|string',
                'product_model' => 'required|string',
                'location_rak' => 'required|string',
                // 'unit_price' => 'required|numeric',
                'file' => 'nullable|mimes:jpeg,jpg,png|max:3072', // Adjust max file size as needed (2048 KB = 3 MB)
            ]);

            $product = new Product;
            // $product->company_id = $request->company_id;
            // $product->category_id = $request->company_id;
            $product->product_name = $request->product_name;
            $product->product_model = $request->product_model;
            $product->location_rak = $request->location_rak;
            $product->cost_code = $request->cost_code;
            // $product->old_price = $request->old_price;
            $product->oem = $request->oem;
            $product->cross_reference = $request->cross_reference;
            $product->origin = $request->origin;
            $product->cost_unit_price = $request->cost_unit_price;
            $product->sale_price_one = $request->sale_price_one;
            $product->sale_price_two = $request->sale_price_two;
            $product->description = $request->description;
            $product->size = $request->size;
            if($request->hasFile('product_image')){
                $imageName = rand(111,999).'.'.$request->product_image->extension();
                $request->product_image->move(public_path('uploads/product'),$imageName);
                $product->product_image = $imageName;
            }
            if($request->hasFile('product_image_two')){
                $imageName = rand(111,999).'.'.$request->product_image_two->extension();
                $request->product_image_two->move(public_path('uploads/product'),$imageName);
                $product->product_image_two = $imageName;
            }
            if($request->hasFile('product_image_three')){
                $imageName = rand(111,999).'.'.$request->product_image_three->extension();
                $request->product_image_three->move(public_path('uploads/product'),$imageName);
                $product->product_image_three = $imageName;
            }
            if($request->hasFile('product_image_four')){
                $imageName = rand(111,999).'.'.$request->product_image_four->extension();
                $request->product_image_four->move(public_path('uploads/product'),$imageName);
                $product->product_image_four = $imageName;
            }
            //  if ($product->save()) {
            //     // Generate QR Code Data
            //     $qrData = "Product: {$product->product_name}\n";
            //     $qrData .= "Company: " . $product->company->name . "\n";
            //     $qrData .= "Code: {$product->id}\n";
            //     $qrData .= "Price: {$product->unit_price}";

            //     // Generate and save the QR code
            //     $qrCodePath = 'uploads/qr_codes/' . $product->id . '.svg';
            //     QrCode::format('svg')->size(200)->generate($qrData, public_path($qrCodePath));

            //     // Save QR code path in the database
            //     $product->qr_code = $qrCodePath;
            //     $product->save();

            //     $this->notice::success('Product Successfully Saved with QR Code');
            //     return redirect()->route('product.index');
            // }
          
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
            // $product->company_id = $request->company_id;
            // $product->category_id = $request->company_id;
            $product->product_name = $request->product_name;
            $product->product_model = $request->product_model;
            $product->location_rak = $request->location_rak;
            $product->cost_code = $request->cost_code;
            $product->oem = $request->oem;
            $product->cross_reference = $request->cross_reference;
            $product->origin = $request->origin;
            $product->cost_unit_price = $request->cost_unit_price;
            $product->sale_price_one = $request->sale_price_one;
            $product->sale_price_two = $request->sale_price_two;
            $product->description = $request->description;
            $product->size = $request->size;
            $path = 'uploads/product';
            if($request->hasFile('product_image')){
                $this->deleteImage($product->product_image, $path);
                $imageName = rand(111,999).'.'.$request->product_image->extension();
                $request->product_image->move(public_path('uploads/product'),$imageName);
                $product->product_image = $imageName;
            }
            if($request->hasFile('product_image_two')){
                $this->deleteImage($product->product_image_two, $path);
                $imageName = rand(111,999).'.'.$request->product_image_two->extension();
                $request->product_image_two->move(public_path('uploads/product'),$imageName);
                $product->product_image_two = $imageName;
            }
            if($request->hasFile('product_image_three')){
                $imageName = rand(111,999).'.'.$request->product_image_three->extension();
                $request->product_image_three->move(public_path('uploads/product'),$imageName);
                $product->product_image_three = $imageName;
            }
            if($request->hasFile('product_image_four')){
                $imageName = rand(111,999).'.'.$request->product_image_four->extension();
                $request->product_image_four->move(public_path('uploads/product'),$imageName);
                $product->product_image_four = $imageName;
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
        $product = Product::findOrFail(encryptor('decrypt', $id));

        $path = 'uploads/product';
    
        // ✅ Check and delete existing image file
        if ($product->product_image && file_exists(public_path($path . '/' . $product->product_image))) {
            unlink(public_path($path . '/' . $product->product_image));
        }
    
        if ($product->delete()) {
            $this->notice::success('Product Successfully Deleted');
            return redirect()->route('product.index');
        } else {
            $this->notice::error('Failed to delete the product');
            return redirect()->back();
        }
    }
    // Route::post('/product-autocomplete', [ProductController::class, 'productAutoComplete'])->name('productAutoComplete');
    // Route::get('getProductInfo/{oemNo}', [ProductController::class, 'getProductInfo'])->name('getProductInfo');

    public function productSearch(){
        return view('backend.product.productSearch');
    }
    public function productAutoComplete(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $products = Product::limit(10)->get(['oem']);
        } else {
            $products = Product::where('oem', 'like', '%' . $search . '%')->distinct('oem')->limit(10)->get(['oem']);
        }
        $response = array();
        foreach ($products as $product) {
            $response[] = array("label" => $product->oem, "value" => $product->oem);
        }
        return response()->json($response);

        // return response()->json($response);
    }

    public function getProductInfo(Request $request, $oemNo = null)
    {
        try {
            $search = $request->search;

            // Autocomplete: only if search is present
            if ($search) {
                $products = Product::with('stock')
                    ->where('oem', 'like', '%' . $search . '%')
                    ->limit(10)
                    ->get();

                return response()->json([
                    'status' => true,
                    'data' => $products
                ]);
            }

            if ($oemNo) {
                $product = Product::with('stock')
                    ->where('oem', $oemNo)
                    ->first();

                if (!$product) {
                    return response()->json(['status' => false, 'message' => 'Product not found'], 404);
                }

                return response()->json([
                    'status' => true,
                    'product_name'=> $product->product_name,
                    'product_model'=> $product->product_model,
                    'location_rak'=> $product->location_rak,
                    'cost_code'=> $product->cost_code,
                    'oem'=> $product->oem,
                    'cross_reference'=> $product->cross_reference,
                    'origin'=> $product->origin,
                    'cost_unit_price'=> $product->cost_unit_price,
                    'sale_price_one'=> $product->sale_price_one,
                    'sale_price_two'=> $product->sale_price_two,
                    'product_image'=> $product->product_image,
                    'product_image_two'=> $product->product_image_two,
                    'product_image_three'=> $product->product_image_three,
                    'product_image_four'=> $product->product_image_four,
                ]);
            }

            return response()->json(['status' => false, 'message' => 'No search or Oem Number provided'], 400);
        } catch (Throwable $e) {
            Log::error('Error in getProductInfo: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Server Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
