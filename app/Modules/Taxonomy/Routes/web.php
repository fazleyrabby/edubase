<?php

use App\Modules\Taxonomy\Http\Controllers\TaxonomyPublicController;
use Illuminate\Support\Facades\Route;

Route::get('/categories/{category}', [TaxonomyPublicController::class, 'category'])->name('categories.show');
