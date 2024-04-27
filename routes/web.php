<?php

use App\Livewire\Superadmin\Home;
use App\Livewire\Superadmin\ManajemenUser;
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

// login, register

// route livewire
Route::get('/superadmin/manajemen-user', ManajemenUser::class)->name('superadmin.manajemen-user');
Route::get('/superadmin/home', Home::class)->name('superadmin.home');
