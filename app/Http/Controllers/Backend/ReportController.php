<?php

namespace App\Http\Controllers\Backend;

use App\Models\Sales;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\SaleDetails;
use App\Models\DailyExpense;
use Illuminate\Http\Request;
use App\Models\CreditPurchase;
use App\Models\PurchaseDetails;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function yearlypurchasereport(Request $request){
        $selectedYear = $request->year;
        $years = array_reverse(range(2020, date('Y')));
        $monthlyPurchase = Purchase::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(grand_total_amount) as amount')
            ->whereYear('date', $selectedYear)
            ->groupBy('year', 'month')
            ->get();
        return view('backend.report.monthlypurchase',compact('selectedYear','years','monthlyPurchase'));
    }
    public function yearlyPurchaseReportPdf(Request $request){

        $selectedYear = $request->year;
        $years = array_reverse(range(2020, date('Y')));
        $monthlyPurchase = Purchase::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(grand_total_amount) as amount')
            ->whereYear('date', $selectedYear)
            ->groupBy('year', 'month')
            ->get();
        $pdf = Pdf::loadView('backend.report.yearlyPurchasePdf', compact('selectedYear', 'years', 'monthlyPurchase'))->setPaper('a4', 'portrait');

        return $pdf->stream('yearlyPurchase_report_'.$selectedYear.'.pdf');
    }

    public function purchaseMonthlyDetails($year, $month)
    {
        $monthlydetails = Purchase::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();
        return view('backend.report.monthlypurchasedetails', compact('monthlydetails', 'year', 'month'));
    }

    public function yearlysalesreport(Request $request){
        $selectedYear = $request->year;
        $years = array_reverse(range(2020, date('Y')));
        $monthlySale = Sales::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(grand_total_amount) as amount')
            ->whereYear('date', $selectedYear)
            ->groupBy('year', 'month')
            ->get();
        return view('backend.report.monthlsale',compact('selectedYear','years','monthlySale'));
    }

    public function salesMonthlyDetails($year, $month)
    {
        $monthlydetails = Sales::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();
        return view('backend.report.monthlysalesdetails', compact('monthlydetails', 'year', 'month'));
    }

    public function yearlyExpense(Request $request){
        $selectedYear = $request->year;
        $years = array_reverse(range(2020, date('Y')));
        $yearlyexpense = DailyExpense::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as amount')
            ->whereYear('date', $selectedYear)
            ->groupBy('year', 'month')
            ->get();
        return view('backend.report.yearlyexpens', compact('yearlyexpense', 'years','selectedYear'));
    }

    public function monthlyexpensdetails($year, $month){
        $monthlyexpensedetails = DailyExpense::whereYear('date',$year)->whereMonth('date',$month)->get();
        return view('backend.report.monthlyexpensdetails', compact('monthlyexpensedetails', 'year', 'month'));
    }

    
   
    public function yearlyReport(Request $request) {
        $selectedYear = $request->year;
        $years = array_reverse(range(2020, date('Y')));

        // Fetching Monthly Purchases
        $monthlyPurchase = Purchase::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(grand_total_amount) as amount')
            ->whereYear('date', $selectedYear)
            ->groupBy('year', 'month')
            ->get();

        // Fetching Monthly Sales
        $monthlySale = Sales::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(grand_total_amount) as amount')
            ->whereYear('date', $selectedYear)
            ->groupBy('year', 'month')
            ->get();

        // Fetching Monthly Expenses
        $yearlyExpense = DailyExpense::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as amount')
            ->whereYear('date', $selectedYear)
            ->groupBy('year', 'month')
            ->get();

        // Generate report combining purchases, sales, and expenses
        $report = $monthlyPurchase->map(function ($purchase) use ($monthlySale, $yearlyExpense) {
            // Find the matching sale for the same year and month
            $sale = $monthlySale->first(function ($item) use ($purchase) {
                return $item->year == $purchase->year && $item->month == $purchase->month;
            });

            // Find the matching expense for the same year and month
            $expense = $yearlyExpense->first(function ($item) use ($purchase) {
                return $item->year == $purchase->year && $item->month == $purchase->month;
            });

            return [
                'year' => $purchase->year,
                'month' => $purchase->month,
                'purchase_amount' => $purchase->amount,
                'sale_amount' => $sale ? $sale->amount : 0,  // If no sale, default to 0
                'expense_amount' => $expense ? $expense->amount : 0,  // If no expense, default to 0
                'balance' =>($sale ? $sale->amount : 0)- ($purchase->amount + ($expense ? $expense->amount : 0) ),
            ];
        });

        return view('backend.report.yearlyreport', compact('selectedYear', 'years', 'report'));
    }

    public function monthlyDetailsReport($year, $month) {
        // Fetch purchases for the specific month and year
        $purchases = Purchase::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        // Fetch sales for the specific month and year
        $sales = Sales::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        // Fetch expenses for the specific month and year
        $expenses = DailyExpense::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        // You can calculate totals here if needed
        $totalPurchase = $purchases->sum('grand_total_amount');
        $totalSale = $sales->sum('grand_total_amount');
        $totalExpense = $expenses->sum('amount');

        return view('backend.report.monthlydetails', compact('year', 'month', 'purchases', 'sales', 'expenses', 'totalPurchase', 'totalSale', 'totalExpense'));
    }

    public function supplier(Request $request){
        // Get start date and end date from the request
        $startDate = $request->start_date ?? \Carbon\Carbon::now()->format('Y-m-d');
        $endDate = $request->end_date ?? \Carbon\Carbon::now()->format('Y-m-d');
        $supplier = Supplier::get();
        $reportData = [];
        // Initialize the purchase report query
    
        $selectedSupplier = null;
        // // Apply supplier filter if a supplier is selected
        if($request->start_date && $request->end_date){
            $report = CreditPurchase::whereBetween('date', [$startDate, $endDate]);
            if($request->supplier_id){
                $report->where('supplier_id', $request->supplier_id);
                $selectedSupplier = Supplier::find($request->supplier_id); // Get the selected supplier
            } 
            $reportData = $report->get();
        }
       
        // Execute the query to get the data
        // dd($request->all());
        return view('backend.report.supplier_report',compact('startDate','endDate','supplier','reportData','selectedSupplier'));
    }

    public function supplier_report_pdf(Request $request){
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $selectedSupplier = null;
        $reportData = [];
        if($request->start_date && $request->end_date){
            $report = CreditPurchase::whereBetween('date', [$startDate, $endDate]);
            if($request->supplier_id){
                $report->where('supplier_id', $request->supplier_id);
                $selectedSupplier = Supplier::find($request->supplier_id); // Get the selected supplier
            } 
            $reportData = $report->get();
        }
        $pdf = Pdf::loadView('backend.report.supplier_report_pdf', compact('startDate','endDate','reportData','selectedSupplier'))->setPaper('a4', 'portrait');

        return $pdf->stream('supplier_report_'.$startDate.'_to_'.$endDate.'.pdf');
    }

    public function customer_report(Request $request){
        // Get start date and end date from the request
        $startDate = $request->start_date ?? \Carbon\Carbon::now()->format('Y-m-d');
        $endDate = $request->end_date ?? \Carbon\Carbon::now()->format('Y-m-d');
        $customer = Customer::get();
        $reportData = [];
        // Initialize the purchase report query
    
        $selectedCustomer = null;
        // // Apply supplier filter if a supplier is selected
        if($request->start_date && $request->end_date){
            $report = Sales::whereBetween('date', [$startDate, $endDate]);
            if($request->customer_id){
                $report->where('customer_id', $request->customer_id);
                $selectedCustomer = Customer::find($request->customer_id); // Get the selected supplier
            }
            $reportData = $report->get();
        }
       
        // Execute the query to get the data
        // dd($request->all());
        return view('backend.report.customer_report',compact('startDate','endDate','customer','reportData','selectedCustomer'));
    }
    

}