<?php

use App\Modules\Location\Http\Controllers\LocationPublicController;
use Illuminate\Support\Facades\Route;

Route::get('/divisions/{division}', [LocationPublicController::class, 'division'])->name('locations.division');
Route::get('/districts/{district}', [LocationPublicController::class, 'district'])->name('locations.district');
Route::get('/upazilas/{upazila}', [LocationPublicController::class, 'upazila'])->name('locations.upazila');
