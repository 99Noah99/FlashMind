<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AiController;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'show_home'])->name('show_home');
Route::get('/Home', [MainController::class, 'show_home'])->name('show_home');

Route::post('/generate', [AiController::class, 'generate'])->name('generate');
