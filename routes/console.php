<?php

use App\Modules\Scraper\Commands\ScraperCleanupCommand;
use App\Modules\Scraper\Commands\ScraperListCommand;
use App\Modules\Scraper\Commands\ScraperRunCommand;
use App\Modules\Scraper\Commands\ScraperSourceCommand;
use App\Modules\Scraper\Commands\ScraperTestCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::registerCommand(new ScraperRunCommand);
Artisan::registerCommand(new ScraperSourceCommand);
Artisan::registerCommand(new ScraperListCommand);
Artisan::registerCommand(new ScraperTestCommand);
Artisan::registerCommand(new ScraperCleanupCommand);

Schedule::command('scraper:run --frequency=hourly')->hourly();
Schedule::command('scraper:run --frequency=daily')->dailyAt('03:00');
Schedule::command('scraper:run --frequency=weekly')->weeklyOn(0, '02:00');
Schedule::command('scraper:run --frequency=monthly')->monthlyOn(1, '02:00');
Schedule::command('scraper:cleanup --older-than=90')->daily();
