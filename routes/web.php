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
use App\Http\Controllers\Backend\HomeExpenseController as homeexpense;
use App\Http\Controllers\Backend\ReportController as report;
use App\Http\Controllers\Backend\SupplierController as supplier;
use App\Http\Controllers\Backend\CustomerController as customer;
use App\Http\Controllers\Backend\UsedPurchaseController as usedPurchase;
use App\Http\Controllers\Backend\BngPurchaseController as bngpurchase;
use App\Http\Controllers\Backend\CreditPurchaseController as creditpurchase;
use App\Http\Controllers\Backend\CreditSaleController as creditsale;
use App\Http\Controllers\FrontendController as frontend;
use App\Http\Controllers\Backend\ForgotPasswordController;
use App\Http\Controllers\Backend\ResetPasswordController;
use App\Http\Controllers\Backend\CustomerPaymentController as customerpayment;
use App\Http\Controllers\Backend\CustomerLedgerController as customerledger;

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
// Route::get('/', [frontend::class, 'frontend'])->name('frontend');
Route::get('/product/{id}',[frontend::class, 'productDetail'])->name('productid');


Route::get('/register', [auth::class,'signUpForm'])->name('register');
Route::post('/register', [auth::class,'signUpStore'])->name('register.store');
Route::get('/', [auth::class,'signInForm'])->name('login');
Route::post('/login', [auth::class,'signInCheck'])->name('login.check');
Route::get('/logout', [auth::class,'signOut'])->name('logOut');
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

Route::middleware(['checkauth','prevent-back-history'])->prefix('admin')->group(function () {
    Route::get('dashboard', [dashboard::class, 'index'])->name('dashboard');
});


Route::middleware(['checkrole','prevent-back-history'])->prefix('admin')->group(function(){
    Route::resource('user', user::class);
    Route::resource('role', role::class);
    Route::get('permission/{role}', [permission::class,'index'])->name('permission.list');
    Route::post('permission/{role}', [permission::class,'save'])->name('permission.save');
    Route::resource('company', company::class);
    Route::resource('category', category::class);
    Route::resource('product', product::class);
    Route::resource('supplier', supplier::class);
    Route::resource('customer', customer::class);
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
    Route::get('sales/{id}/return', [sale::class, 'sales_return'])->name('sales.return');
    Route::post('sales/{id}/return', [sale::class, 'sales_return_store'])->name('sales.return.store');

    Route::resource('dailyexpense', dailyexpense::class);
    Route::resource('homeexpense', homeexpense::class);
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
    Route::get('/supplier-report/pdf', [report::class, 'supplier_report_pdf'])->name('supplier.report.pdf');
    Route::get('customer-report', [report::class, 'customer_report'])->name('customer_report');
    Route::resource('usedpurchase', usedPurchase::class);
    Route::resource('bngpurchase', bngpurchase::class);
    Route::resource('creditpurchase', creditpurchase::class);
    Route::resource('creditsale', creditsale::class);
    Route::resource('customerpayment', customerpayment::class);
    Route::get('customer-ledger', [customerledger::class, 'customerLedger'])->name('customer-ledger-report');


    Route::get('product-report', [product::class, 'reportForm'])->name('product.reportForm');
    Route::post('product/generate', [product::class, 'generatePDF'])->withoutMiddleware('prevent-back-history')->name('product.generatePDF');
    Route::get('stock-report', [stock::class, 'stockReportForm'])->name('stock.reportForm');
    Route::post('stock/generate', [stock::class, 'generateStockPDF'])->withoutMiddleware('prevent-back-history')->name('stock.generatePDF');


    Route::post('/product-autocomplete', [product::class, 'productAutoComplete'])->name('productAutoComplete');
    Route::get('getProductInfo/{oemNo}', [product::class, 'getProductInfo'])->name('getProductInfo');
    Route::get('product-search', [product::class, 'productSearch'])->name('productSearch');


    // web.php
    Route::get('/secure-products', [product::class, 'showPinForm'])->name('secure.products.pin');
    Route::post('/secure-products', [product::class, 'checkPin'])->name('secure.products.check');
    Route::get('/products-list', [product::class, 'secureProductList'])->name('secure.products.list');
    Route::get('/products/search', [product::class, 'search'])->name('product.search');

    Route::get('/yearly-purchase-report/pdf', [report::class, 'yearlyPurchaseReportPdf'])
    ->name('yearlyPurchase.report.pdf');

    
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