<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthenticationController as auth;
use App\Http\Controllers\Backend\UserController as user;
use App\Http\Controllers\Backend\RoleController as role;
use App\Http\Controllers\Backend\DashboardController as dashboard;
use App\Http\Controllers\Backend\PermissionController as permission;
use App\Http\Controllers\Backend\CompanyController as company;
use App\Http\Controllers\Backend\CategoryController as category;
use App\Http\Controllers\Backend\ProductController as product;
use App\Http\Controllers\Backend\PurchaseController as purchase;
use App\Http\Controllers\Backend\StockController as stock;
use App\Http\Controllers\Backend\SalesController as sale;
use App\Http\Controllers\Backend\DailyExpenseController as dailyexpense;
use App\Http\Controllers\Backend\ReportController as report;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/register', [auth::class,'signUpForm'])->name('register');
Route::post('/register', [auth::class,'signUpStore'])->name('register.store');
Route::get('/', [auth::class,'signInForm'])->name('login');
Route::post('/login', [auth::class,'signInCheck'])->name('login.check');
Route::get('/logout', [auth::class,'signOut'])->name('logOut');

Route::middleware(['checkauth'])->prefix('admin')->group(function () {
    Route::get('dashboard', [dashboard::class, 'index'])->name('dashboard');
});


Route::middleware(['checkrole'])->prefix('admin')->group(function(){
    Route::resource('user', user::class);
    Route::resource('role', role::class);
    Route::get('permission/{role}', [permission::class,'index'])->name('permission.list');
    Route::post('permission/{role}', [permission::class,'save'])->name('permission.save');
    Route::resource('company', company::class);
    Route::resource('category', category::class);
    Route::resource('product', product::class);
    Route::resource('stock', stock::class);
    Route::resource('purchase', purchase::class);
    Route::get('invoice/{id}',[purchase::class, 'invoice'])->name('invoice');
    Route::get('phurchasereport', [purchase::class,'PurchaseReport'])->name('phurchasereport'); //2nd one is function name
    // Route::get('/get-categories-by-company', [product::class,'getCategoriesByCompany'])->name('getCategoriesByCompany');
    Route::get('/get-categories-by-company', [purchase::class, 'getCategoriesByCompany'])->name('getCategoriesByCompany');
    // Route::get('/get-categories-by-company', [purchase::class, 'getCategory'])->name('getCategories');

    // Route for getting products by category and company ID
    Route::get('/get-products-by-category-and-company', [purchase::class, 'getProductsByCategoryAndCompany'])->name('getProductsByCategoryAndCompany');
    Route::get('/getStockByProduct', [purchase::class, 'getStockByProduct'])->name('getStockByProduct');
    Route::resource('sale', sale::class);
    Route::get('sale_invoice/{id}', [sale::class,'invoice'])->name('sale.invoice');
    Route::get('salesreport', [sale::class,'salesReport'])->name('salesreport'); //2nd one is function name
    Route::get('/salegetStockByProduct', [sale::class, 'salegetStockByProduct'])->name('salegetStockByProduct');
    Route::resource('dailyexpense', dailyexpense::class);
    Route::get('yearly-purchase', [report::class, 'yearlypurchasereport'])->name('yearly_purchase');
    Route::get('monthly-purchase/{year}/{month}', [report::class, 'purchaseMonthlyDetails'])->name('Monthly_purchase_details');
    Route::get('yearly-sale', [report::class, 'yearlysalesreport'])->name('yearly_sale');
    Route::get('monthly-sale/{year}/{month}', [report::class, 'salesMonthlyDetails'])->name('Monthly_sale_Details');
    Route::get('yearly-expense', [report::class, 'yearlyExpense'])->name('yearly_expense');
    Route::get('monthly-expense/{year}/{month}', [report::class, 'monthlyexpensdetails'])->name('Monthly_expense_Details');
    Route::get('yearly-report', [report::class, 'yearlyReport'])->name('yearly_report');
    // routes/web.php
    Route::get('monthly-details/{year}/{month}', [report::class, 'monthlyDetailsReport'])->name('Monthly_Details');
    Route::get('supplier-report', [report::class, 'supplier'])->name('supplier_report');

});

// Route::get('/', function () {
//     return view('admindashboard');
// });
// Route::get('/login', function () {
//     return view('authentication.login');
// });
// Route::get('/register', function () {
//     return view('authentication.register');
// });