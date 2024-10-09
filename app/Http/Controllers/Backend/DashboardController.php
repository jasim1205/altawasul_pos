<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Sales;
use App\Models\DailyExpense;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        if(fullAccess()){
            $currentDate = Carbon::now();
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
             // Format current date
            $dayName = $currentDate->format('l');
            $currentDay = $currentDate->day; // Full day name (e.g., Monday)
            $monthName = $currentDate->format('F'); // Full month name (e.g., January)
            $currentYear = $currentDate->year; // Current year


            $purchase = Purchase::whereDate('date', $currentDate->toDateString())->sum('total_quantity');
            $sale = Sales::whereDate('date', $currentDate->toDateString())->sum('total_quantity');
            $expense = DailyExpense::whereDate('date', $currentDate->toDateString())->sum('amount');

            // $purchase = Purchase::where('date',$currentDate)->sum('total_quantity');
            // $sale = Sales::where('date',$currentDate)->sum('total_quantity');
            // $expense = DailyExpense::where('date',$currentDate)->sum('amount');

            $monthlypurchase = Purchase::whereBetween('date',[$startOfMonth,$endOfMonth])->sum('total_quantity');
            $monthlysale = Sales::whereBetween('date',[$startOfMonth,$endOfMonth])->sum('total_quantity');
            $monthlyexpense = DailyExpense::whereBetween('date',[$startOfMonth,$endOfMonth])->sum('amount');

            $totalpurchase = Purchase::sum('total_quantity');
            $totalsale = Sales::sum('total_quantity');
            $totalexpense = DailyExpense::sum('amount');
            return view('admindashboard',compact('currentDate','purchase','sale','expense','monthlypurchase','monthlysale','monthlyexpense','totalpurchase','totalsale','totalexpense'));
        }else{
            return view('dashboard');
        }
    }
}