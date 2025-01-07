<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\RdailyPaymentRecController;
use App\Http\Controllers\ReturPembelianController;
use App\Http\Controllers\RinventoryCategoryController;
use App\Http\Controllers\RpaymentReceivedGroupController;
use App\Http\Controllers\RsalesSummaryController;
use App\Http\Controllers\SjReturController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'postLogin'])->name('postlogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/packlist', [TransaksiController::class, 'index'])->name('packlist');
    Route::get('/packlist/update', [TransaksiController::class, 'update'])->name('packlistupdate');
    Route::post('/getnosj', [TransaksiController::class, 'getNoSj'])->name('getnosj');
    Route::post('/getitem', [TransaksiController::class, 'getItem'])->name('getitem');
    Route::post('/getcodeitem', [TransaksiController::class, 'getCodeItem'])->name('getcodeitem');

    Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian');
    Route::get('/pembelian/update', [PembelianController::class, 'update'])->name('pembelianupdate');
    Route::post('/getdetailitem', [PembelianController::class, 'getDetailItem'])->name('getdetailitem');

    Route::get('/sjretur', [SjReturController::class, 'index'])->name('sjretur');
    Route::post('/getdetailretur', [SjReturController::class, 'getDetailItem'])->name('getdetailretur');
    Route::get('/sjretur/update', [SjReturController::class, 'update'])->name('sjreturupdate');

    Route::get('/returpembelian', [ReturPembelianController::class, 'index'])->name('returpembelian');
    Route::get('/returpembelian/update', [ReturPembelianController::class, 'update'])->name('returpembelianupdate');
    Route::post('/getreturdetailitem', [ReturPembelianController::class, 'getDetailItem'])->name('getreturdetailitem');

    // REPORTS
    Route::get('/rdailypaymentrcv', [RdailyPaymentRecController::class, 'index'])->name('rdailypaymentrcv');
    Route::get('/rpaymentrcvgroup', [RpaymentReceivedGroupController::class, 'index'])->name('rpaymentrcvgroup');
    Route::get('/rsalessummary', [RsalesSummaryController::class, 'index'])->name('rsalessummary');
    Route::get('/inventcategory', [RinventoryCategoryController::class, 'index'])->name('inventcategory');
});
