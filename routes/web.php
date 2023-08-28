<?php

use App\Http\Controllers\DefaultController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InsproductController;
use App\Http\Controllers\AutoproductController;
use App\Http\Controllers\BulkproductController;
use App\Http\Controllers\PartsproductController;
use App\Http\Controllers\RepairproductController;
use App\Http\Controllers\InsrepairproductController;
use App\Http\Controllers\AutorepairproductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnreproductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
// use Barryvdh\DomPDF\Facade as PDF;
// use Illuminate\Http\Request;
// use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/login');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/fetch-type-options', 'ProductController@fetchTypeOptions')->name('fetchTypeOptions');

    // // Route PDF
    // Route::get('/download-pdf', function (Request $request) {
    //     $pdf = PDF::loadView('products.show');
        
    //     // You can customize the PDF filename
    //     $filename = 'document.pdf';
        
    //     return $pdf->download($filename);
    // })->name('download-pdf');
    
    // Route::get('/download-show-pdf', 'ProductController@downloadpdf')->name('show.pdf');
    // Route::get('/products/pdf/{id}', 'ProductController@generatePdf')->name('products.pdf');
    // Route::get('/autoproducts/{id}/pdf', 'AutoproductController@generatePdf')->name('autoproducts.pdf');
    // Route::get('/autorepairproducts/{id}/pdf', 'AutorepairproductController@generatePdf')->name('autorepairproducts.pdf');
    // Route::get('/bulkproducts/{id}/pdf', 'BulkproductController@generatePdf')->name('bulkproducts.pdf');
    // Route::get('/insproducts/{id}/pdf', 'InsproductController@generatePdf')->name('insproducts.pdf');
    // Route::get('/insrepairproducts/{id}/pdf', 'InsrepairproductController@generatePdf')->name('insrepairproducts.pdf');
    // Route::get('/partsproducts/{id}/pdf', 'PartsproductController@generatePdf')->name('partsproducts.pdf');
    // Route::get('/repairproducts/{id}/pdf', 'RepairproductController@generatePdf')->name('repairproducts.pdf');
    // Route::get('/unreproducts/{id}/pdf', 'UnreproductController@generatePdf')->name('unreproducts.pdf');
    // Route::get('/download-show-pdf', [ProductController::class, 'downloadpdf'])->name('show.pdf');
    Route::get('/download-pdf/{id}', [ProductController::class, 'download'])->name('download-pdf');

    // // Route Products
    Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');
    Route::get('/products/import', [ProductController::class, 'import'])->name('products.import');
    Route::post('/products/import', [ProductController::class, 'handleImport'])->name('products.handleImport');
    Route::resource('/products', ProductController::class);

    // // Route Insproducts
    Route::get('/insproducts/export', [InsproductController::class, 'export'])->name('insproducts.export');
    Route::get('/insproducts/import', [InsproductController::class, 'import'])->name('insproducts.import');
    Route::post('/insproducts/import', [InsproductController::class, 'handleImport'])->name('insproducts.handleImport');
    Route::resource('/insproducts', InsproductController::class);

     // // Route Autoproducts
     Route::get('/autoproducts/export', [AutoproductController::class, 'export'])->name('autoproducts.export');
     Route::get('/autoproducts/import', [AutoproductController::class, 'import'])->name('autoproducts.import');
     Route::post('/autoproducts/import', [AutoproductController::class, 'handleImport'])->name('autoproducts.handleImport');
     Route::resource('/autoproducts', AutoproductController::class);
     
     // // Route Bulkproducts
     Route::get('/bulkproducts/export', [BulkproductController::class, 'export'])->name('bulkproducts.export');
     Route::get('/bulkproducts/import', [BulkproductController::class, 'import'])->name('bulkproducts.import');
     Route::post('/bulkproducts/import', [BulkproductController::class, 'handleImport'])->name('bulkproducts.handleImport');
     Route::resource('/bulkproducts', BulkproductController::class);

     // // Route partsproducts
    Route::get('/partsproducts/export', [PartsproductController::class, 'export'])->name('partsproducts.export');
    Route::get('/partsproducts/import', [PartsproductController::class, 'import'])->name('partsproducts.import');
    Route::post('/partsproducts/import', [PartsproductController::class, 'handleImport'])->name('partsproducts.handleImport');
    Route::resource('/partsproducts', PartsproductController::class);

    // // Route Repairproducts
    Route::get('/repairproducts/export', [RepairproductController::class, 'export'])->name('repairproducts.export');
    Route::get('/repairproducts/import', [RepairproductController::class, 'import'])->name('repairproducts.import');
    Route::post('/repairproducts/import', [RepairproductController::class, 'handleImport'])->name('repairproducts.handleImport');
    Route::resource('/repairproducts', RepairproductController::class);
    
    // // Route Autorepairproducts
    Route::get('/autorepairproducts/export', [AutorepairproductController::class, 'export'])->name('autorepairproducts.export');
    Route::get('/autorepairproducts/import', [AutorepairproductController::class, 'import'])->name('autorepairproducts.import');
    Route::post('/autorepairproducts/import', [AutorepairproductController::class, 'handleImport'])->name('autorepairproducts.handleImport');
    Route::resource('/autorepairproducts', AutorepairproductController::class);

    // // Route Insrepairproducts
    Route::get('/insrepairproducts/export', [InsrepairproductController::class, 'export'])->name('insrepairproducts.export');
    Route::get('/insrepairproducts/import', [InsrepairproductController::class, 'import'])->name('insrepairproducts.import');
    Route::post('/insrepairproducts/import', [InsrepairproductController::class, 'handleImport'])->name('insrepairproducts.handleImport');
    Route::resource('/insrepairproducts', InsrepairproductController::class);

    // // Route unreproducts
    Route::get('/unreproducts/export', [UnreproductController::class, 'export'])->name('unreproducts.export');
    Route::get('/unreproducts/import', [UnreproductController::class, 'import'])->name('unreproducts.import');
    Route::post('/unreproducts/import', [UnreproductController::class, 'handleImport'])->name('unreproducts.handleImport');
    Route::resource('/unreproducts', UnreproductController::class);
    
    // Default Controller
    Route::get('/get-all-product', [DefaultController::class, 'GetProducts'])->name('get-all-product');
    Route::get('/get-all-insproduct', [DefaultController::class, 'GetInsproducts'])->name('get-all-insproduct');
    Route::get('/get-all-autoproduct', [DefaultController::class, 'GetAutoproducts'])->name('get-all-autoproduct');

    // User Management
    Route::resource('/users', UserController::class)->except(['show']);
    Route::put('/user/change-password/{username}', [UserController::class, 'updatePassword'])->name('users.updatePassword');
});

require __DIR__.'/auth.php';
