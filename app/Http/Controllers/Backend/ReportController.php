<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use Illuminate\Http\Request;

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

    public function purchaseMonthlyDetails($year, $month)
    {
        $monthlydetails = Purchase::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();
        return view('backend.report.monthlypurchasedetails', compact('monthlydetails', 'year', 'month'));
    }
}