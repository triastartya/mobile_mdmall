<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login',[App\Http\Controllers\UserController::class, 'login']);
Route::post('login_admin',[App\Http\Controllers\UserController::class, 'login_admin']);

Route::get('getAllUser',[App\Http\Controllers\UserController::class, 'getAllUser']);
Route::post('postUser',[App\Http\Controllers\UserController::class, 'postUser']);
Route::post('editUser',[App\Http\Controllers\UserController::class, 'editUser']);
Route::post('deleteUser',[App\Http\Controllers\UserController::class, 'deleteUser']);

Route::post('register',[App\Http\Controllers\UserController::class, 'register']);

Route::post('TransSaldoKasir/insert',[App\Http\Controllers\TransSaldoKasir::class, 'insert']);
Route::post('testing',[App\Http\Controllers\TransSaldoKasir::class, 'TransSaldoKasir_tes']);
Route::post('mob/login',[App\Http\Controllers\authMobileController::class, 'login']);
Route::post('mob/get_croscek',[App\Http\Controllers\TransSaldoKasir::class, 'get_croscek']);
Route::post('mob/get_sembako',[App\Http\Controllers\TransSaldoKasir::class, 'get_sembako']);
Route::post('mob/get_sembako_lokasi',[App\Http\Controllers\TransSaldoKasir::class, 'get_sembako_lokasi']);

