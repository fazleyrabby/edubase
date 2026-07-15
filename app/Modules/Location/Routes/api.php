<?php

use App\Modules\Location\Http\Controllers\LocationApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/locations')->group(function () {
    Route::get('divisions/{division}/districts', [LocationApiController::class, 'districts']);
    Route::get('districts/{district}/upazilas', [LocationApiController::class, 'upazilas']);
    Route::get('upazilas/{upazila}/areas', [LocationApiController::class, 'areas']);
});
