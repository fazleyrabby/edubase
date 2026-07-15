<?php

use App\Modules\Search\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/search', SearchController::class)->name('search');
Route::get('/api/search/autocomplete', [SearchController::class, 'autocomplete']);
