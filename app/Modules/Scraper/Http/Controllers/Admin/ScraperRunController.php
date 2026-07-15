<?php

namespace App\Modules\Scraper\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Scraper\Models\ScraperRun;
use Illuminate\View\View;

class ScraperRunController extends Controller
{
    public function index(): View
    {
        $runs = ScraperRun::with('source:id,name')
            ->latest()
            ->paginate(30);

        return view('admin.scrapers.runs', compact('runs'));
    }

    public function show(ScraperRun $run): View
    {
        $run->load(['source', 'logs' => fn ($q) => $q->latest()->limit(200)]);

        return view('admin.scrapers.run-detail', compact('run'));
    }

    public function log(ScraperRun $run): View
    {
        $logs = $run->logs()->latest()->paginate(100);

        return view('admin.scrapers.run-logs', compact('run', 'logs'));
    }
}
