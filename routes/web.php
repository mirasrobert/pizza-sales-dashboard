<?php

use Illuminate\Support\Facades\Route;

// This route serves the main application view for a single-page application (SPA).
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
