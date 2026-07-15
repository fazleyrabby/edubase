<?php

use App\Modules\Institute\Http\Controllers\InstitutePublicController;
use Illuminate\Support\Facades\Route;

Route::get('/institutes', [InstitutePublicController::class, 'index'])->name('institutes.index');
Route::get('/institutes/type/{type}', [InstitutePublicController::class, 'byType'])->name('institutes.by.type');
Route::get('/institutes/district/{district}', [InstitutePublicController::class, 'byDistrict'])->name('institutes.by.district');
Route::get('/institutes/{type}/{district}', [InstitutePublicController::class, 'byTypeAndDistrict'])->name('institutes.pseo');
Route::get('/institutes/{institute}', [InstitutePublicController::class, 'show'])->name('institutes.show');
