<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\PizzaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\V1\AnalyticsController;
use App\Http\Controllers\Api\V1\PizzaTypeController;
use App\Http\Controllers\Settings\ProfileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::get('pizza-types', [PizzaTypeController::class, 'index']);
    Route::get('pizza-types/{id}', [PizzaTypeController::class, 'show']);

    Route::apiResource('pizzas', PizzaController::class);
    Route::apiResource('orders', OrderController::class);

    Route::prefix('analytics')->group(function () {
        Route::get('sales-summary', [AnalyticsController::class, 'salesSummary']);
        Route::get('top-pizzas', [AnalyticsController::class, 'topPizzas']);
        Route::get('sales-by-date', [AnalyticsController::class, 'salesByDate']);
        Route::get('sales-by-month', [AnalyticsController::class, 'salesByMonth']);
        Route::get('recent-sales', [AnalyticsController::class, 'recentSales']);
    });

    Route::prefix('settings')->group(function () {
        Route::put('/profile', [ProfileController::class, 'update']);
        Route::delete('/profile/delete', [ProfileController::class, 'destroy']);
    });

});

Route::prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'store']);
    Route::post('register', [RegisterController::class, 'store']);
    Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth:sanctum');
});
