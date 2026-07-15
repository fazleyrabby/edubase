<?php

use App\Modules\Institute\Http\Controllers\InstitutePublicController;
use Illuminate\Support\Facades\Route;

Route::get('/institutes', [InstitutePublicController::class, 'index'])->name('institutes.index');
Route::get('/institutes/{institute}', [InstitutePublicController::class, 'show'])->name('institutes.show');
