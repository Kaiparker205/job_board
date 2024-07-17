<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

 Route::middleware('admin')->group(function () {
       Route::resource('admin', AdminController::class)->except(['show', 'delete', 'edit']);
        Route::get('admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('admin/rapport', [AdminController::class, 'rapports'])->name('admin.rapport');
        Route::get('admin/rank', [AdminController::class, 'rank'])->name('admin.rank');
        Route::get('admin/company', [AdminController::class, 'company'])->name('admin.company');
        Route::get('admin/static', [AdminController::class, 'static'])->name('admin.static');
        Route::post('admin/send', [AdminController::class, 'send_rapport'])->name('admin.send');
        Route::delete('/admin/jobs/{id}', [AdminController::class, 'deleteJob'])->name('admin.jobs.delete');
        Route::get('admin/jobs/filter', [AdminController::class, 'filter'])->name('admin.jobs.filter');

    });
