<?php

use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ReturPembelianController;
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

Route::get('/', function () {
    return view('welcome');
});

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
