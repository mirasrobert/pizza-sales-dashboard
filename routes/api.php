<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\PizzaController;
use App\Http\Controllers\Api\V1\PizzaTypeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('pizza-types', [PizzaTypeController::class, 'index']);
    Route::get('pizza-types/{id}', [PizzaTypeController::class, 'show']);

    Route::apiResource('pizzas', PizzaController::class);
    Route::apiResource('orders', OrderController::class);
});
