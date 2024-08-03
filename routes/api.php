<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;

Route::apiResource('genres', GenreController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::apiResource('movies', MovieController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::post('movies/{movie}/publish', [MovieController::class, 'publish']);