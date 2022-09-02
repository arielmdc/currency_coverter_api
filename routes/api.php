<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teste;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['cors'])->group(function () {
    
    Route::post('/login', [UserController::class, 'login']);

    Route::post('/auth', [UserController::class, 'autentication']);
    Route::post('/exchange/post', [ExchangeController::class, 'store']);
    Route::get('/user/history/{id}', [UserHistoryController::class, 'getUserHistory']);
});
