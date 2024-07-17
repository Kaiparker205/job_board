<?php

use App\Http\Controllers\BoiteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmployeurController;
use Illuminate\Support\Facades\Route;

   Route::middleware(['Employeur'])->group(function () {
    Route::resource('employeur', EmployeurController::class)->except(['show']);
    Route::resource('contact', ContactController::class)->except(['show','index']);
    Route::resource('boite', BoiteController::class)->except(['show']);
    Route::get('send', [BoiteController::class, 'send'])->name('send');
});
