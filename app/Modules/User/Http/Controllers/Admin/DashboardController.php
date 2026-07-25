<?php

namespace App\Modules\User\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Institute\Models\Institute;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalInstitutes' => Institute::count(),
            'publishedInstitutes' => Institute::where('status', 'published')->count(),
            'pendingReview' => Institute::whereIn('status', ['draft', 'pending_review'])->count(),
        ]);
    }
}
