<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RestoController;
use App\Http\Controllers\ArticleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/transaction',[TransactionController::class, 'index']);
// Route::post('/transaction',[TransactionController::class,'store']);
// Route::put('/transaction/{id}',[TransactionController::class,'update']);
// Route::get('/transaction/{id}',[TransactionController::class,'show']);
// Route::delete('/transaction/{id}',[TransactionController::class,'destroy']);

Route::resource('/transaction',TransactionController::class)->except(['create', 'edit']);
Route::resource('/resto',RestoController::class)->except(['create', 'edit']);



// Route::get('/article', [UserController::class, 'index']);
// Route::get('/article/{id}', [UserController::class, 'show']);
// Route::post('/article', [UserController::class, 'store']);
// Route::put('/article/{id}', [UserController::class, 'update']);
// Route::delete('/article/{id}', [UserController::class, 'destroy']);
Route::resource('/article',ArticleController::class);