<?php

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
    $q = \App\Models\Category::parent()->active()->with(['sub_cats'])->get();

    dd($q); 
});


Route::middleware('guest')->prefix('account')->group(function(){
    Route::view('/login','account.login')->name('account.login');
    Route::view('/register','account.register')->name('account.register');
    Route::view('/forgot-password','account.forgot-password')->name('account.forgot-password');
});