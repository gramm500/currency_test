<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CurrencyRateController;
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

Route::group(
    [],
    static function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    }
);

Route::group(
    ['middleware' => 'auth:sanctum'],
    static function () {
        Route::get('/currency', [CurrencyRateController::class, 'index']);
        Route::get('/currency/{currency}', [CurrencyRateController::class, 'show']);
    }
);
