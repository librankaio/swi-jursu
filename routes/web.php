<?php

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
    phpinfo();
    return view('welcome');
});

Route::get('/packlist', [TransaksiController::class, 'index'])->name('packlist');
Route::get('/packlist/update', [TransaksiController::class, 'update'])->name('packlistupdate');
Route::post('/getnosj', [TransaksiController::class, 'getNoSj'])->name('getnosj');
Route::post('/getitem', [TransaksiController::class, 'getItem'])->name('getitem');
Route::post('/getcodeitem', [TransaksiController::class, 'getCodeItem'])->name('getcodeitem');
