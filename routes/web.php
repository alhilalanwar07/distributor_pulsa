<?php

use App\Livewire\Superadmin\Cabang;
use App\Livewire\Superadmin\Home;
use App\Livewire\Superadmin\KategoriProduk;
use App\Livewire\Superadmin\ManajemenUser;
use App\Livewire\Superadmin\Outlet;
use App\Livewire\Superadmin\Produk;
use App\Livewire\Superadmin\Sales;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;







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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// route livewire
Route::get('/superadmin/manajemen-user', ManajemenUser::class)->name('superadmin.manajemen-user');
Route::get('/superadmin/home', Home::class)->name('superadmin.home');
Route::get('/superadmin/cabang', Cabang::class)->name('superadmin.cabang');
Route::get('/superadmin/outlet', Outlet::class)->name('superadmin.outlet');
Route::get('/superadmin/kategori-produk', KategoriProduk::class)->name('superadmin.kategori-produk');
Route::get('/superadmin/produk', Produk::class)->name('superadmin.produk');
Route::get('/superadmin/sales', Sales::class)->name('superadmin.sales');
