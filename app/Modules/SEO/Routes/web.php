<?php

use App\Modules\SEO\Http\Controllers\Admin\SeoAdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/seo')
    ->middleware(['web', 'auth', 'admin'])
    ->group(function () {
        Route::get('/', [SeoAdminController::class, 'index'])->name('admin.seo.index');
        Route::get('/edit/{entity_type}/{entity_id}', [SeoAdminController::class, 'edit'])->name('admin.seo.edit');
        Route::put('/update/{entity_type}/{entity_id}', [SeoAdminController::class, 'update'])->name('admin.seo.update');
        Route::get('/redirects', [SeoAdminController::class, 'redirects'])->name('admin.seo.redirects');
        Route::post('/redirects', [SeoAdminController::class, 'storeRedirect'])->name('admin.seo.redirects.store');
        Route::delete('/redirects/{redirect}', [SeoAdminController::class, 'destroyRedirect'])->name('admin.seo.redirects.destroy');
    });
