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
    return view('mobile.auth.login');
});

Route::get('/mobile_dashboard', function () {
    return view('mobile.page.dashboard.dashboard');
});

Route::get('/mobile_kasir', function () {
    return view('mobile.page.croscek.croscek');
});

Route::get('/mobile_sembako', function () {
    return view('mobile.page.sembako.sembako');
});

Route::get('/pay', function () {
    return view('mobile.page.pay.pay');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});