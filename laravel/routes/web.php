<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AiController;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'show_home'])->name('show_home');
Route::get('/Home', [MainController::class, 'show_home'])->name('show_home');
Route::get('/download_csv/{csv_file_name}', [MainController::class, 'download_csv'])->name('download_csv');

Route::post('/generate', [AiController::class, 'generate'])->name('generate');
