<?php

use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\PostuleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

 Route::resource('postule', PostuleController::class)->except(['show','edit']);
 Route::get('postule/confirme', [PostuleController::class,'confirme'])->name('postule.confirme');
 Route::get('postule/boite', [PostuleController::class,'boite_list'])->name('postule.boite');
 Route::get('postule/offers', [PostuleController::class,'offres_list'])->name('postule.offer');
 Route::resource('competence', CompetenceController::class)->except(['show','index']);
 Route::resource('profile', ProfileController::class);
 Route::put('profile/cv/edit', [ProfileController::class,'update_profil'])->name('cv.update');
 Route::get('profile/cv', [ProfileController::class,'edit_profil'])->name('cv.edit');
 Route::post('profile/cv', [ProfileController::class,'store_profil'])->name('cv.store');
 Route::delete('profile/cv', [ProfileController::class,'store_profil'])->name('cv.destroy');
 Route::resource('diplome', DiplomeController::class)->except(['show','index']);
 Route::resource('emploi', EmploiController::class);

