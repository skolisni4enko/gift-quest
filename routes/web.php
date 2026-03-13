<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestController;

Route::get('/', [AuthController::class, 'index']);
Route::post('/enter', [AuthController::class, 'enter'])->middleware('throttle:5,1');
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/quest', [QuestController::class, 'index']);
Route::get('/secret', [QuestController::class, 'secret']);
