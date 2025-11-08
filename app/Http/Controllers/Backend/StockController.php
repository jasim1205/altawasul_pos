<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Stock;
use App\Models\Company;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $stock = Stock::with('product')
            ->when($search, function ($query, $search) {
                $query->whereHas('product', function ($q) use ($search) {
                    $q->where('product_name', 'like', "%{$search}%")
                    ->orWhere('product_model', 'like', "%{$search}%")
                    ->orWhere('origin', 'like', "%{$search}%")
                    ->orWhere('cost_code', 'like', "%{$search}%")
                    ->orWhere('oem', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('backend.stock.index', compact('stock', 'search'));
    }
    public function stockReportForm()
    {
        return view('backend.stock.reportForm');
    }
    public function generateStockPDF(Request $request)
    {
        $request->validate([
            'filter' => 'required', // date filter
            'stock_type' => 'nullable|in:low,available', // stock type filter
        ]);
    
        $query = Stock::with('product');
    
        // Initialize date variables
        $start_date = null;
        $end_date = null;
    
        // 🔹 Date range filter
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
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
    
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date = Carbon::parse($request->end_date)->endOfDay();
    
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }
    
        // 🔹 Stock type filter
        if ($request->stock_type === 'low') {
            $query->where('quantity', '<', 5);
        } elseif ($request->stock_type === 'available') {
            $query->where('quantity', '>=', 5);
        }
    
        // 🔹 Fetch records
        $stocks = $query->orderBy('id', 'desc')->get();
    
        // 🔹 Prepare data
        $data = [
            'stocks' => $stocks,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'filter' => $request->filter,
            'stock_type' => $request->stock_type,
        ];
    
        // 🔹 Generate PDF
        $pdf = Pdf::loadView('backend.stock.stockReportPDF', $data)
                  ->setPaper('a4', 'portrait');
    
        $fileName = 'stock_report_' . ($request->stock_type ?? 'all') . '.pdf';
        return $pdf->stream($fileName);
    }  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
