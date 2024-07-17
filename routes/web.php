<?php
use App\Http\Controllers\HomePage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::middleware(['auth', 'verified'])->group(function () {
    require __DIR__ . '/admin.php';
    require __DIR__ . '/user.php';
    require __DIR__ . '/employeur.php';
    });
require __DIR__ . '/auth.php';
