<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;

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

Route::get('/',[HomeController::class,'index']);

Route::get('/test',function(){
    // $q = \App\Models\Page::create([

    // ]);

    dd($q); 
});

Route::middleware('guest')->prefix('account')->group(function(){
    // Route::view('/login','account.login')->name('account.login');
    // Route::view('/register','account.register')->name('account.register');
    // Route::view('/forgot-password','account.forgot-password')->name('account.forgot-password');
});

Route::prefix('page')->group(function(){
    Route::get('/{slug}',[PageController::class,'show']);
});