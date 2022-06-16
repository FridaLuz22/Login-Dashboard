<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//Route::view('/','welcome');
//Route::view('/login','login');
//Route::view('/principal','principal');

Route::get('/login', function(){ return view('login'); })->name('login')->middleware('guest');


Route::get('/principal', function(){ return view('principal'); });
Route::view('index','index')->middleware('auth');

Route::post('/login', function(){ 
    $datos = request()->only('email','password');
    if (Auth::attempt($datos)) {

        request()->session()->regenerate();  // cambian los tokens CSRF
        return redirect('index');

    }
    return redirect('login');
});