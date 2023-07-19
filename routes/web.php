<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Lwitem;
use App\Http\Livewire\Lwkasir;
use App\Http\Livewire\Lwtransaksi;
use App\Http\Controllers\TransaksiController;
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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', Dashboard::class, );
    Route::get('/kasir', Lwkasir::class, );
    Route::get('/item', Lwitem::class, );
    Route::get('/transaksi', Lwtransaksi::class, );
    Route::get('/transaksi/{kode}', [TransaksiController::class, 'index'])->name('transaksi');
});
