<?php

use App\Http\Controllers\CodeController;

use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');
Route::post('/save-file', [CodeController::class, 'saveFile']);
Route::post('/get-file', [CodeController::class, 'getFile']);
