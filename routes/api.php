<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::patch('/admin/{id}', [App\Http\Controllers\RoleController::class, 'ChangeRole']);
Route::post('/product', [App\Http\Controllers\ProductController::class, 'store']);
Route::delete('/product/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/product2', [App\Http\Controllers\ProductController::class, 'index2']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

