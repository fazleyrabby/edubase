<?php

namespace App\Modules\Scraper\Commands;

use App\Modules\Scraper\Models\ScraperRun;
use App\Modules\Scraper\Models\ScraperSource;
use Illuminate\Console\Command;

class ScraperSourceCommand extends Command
{
    protected $signature = 'scraper:source {id : The source ID to run}';
    protected $description = 'Run a specific scraper source immediately';

    public function handle(): int
    {
        $source = ScraperSource::find($this->argument('id'));

        if (! $source) {
            $this->error("Source [{$this->argument('id')}] not found.");
            return 1;
        }

        $this->info("Running source: {$source->name}");

        try {
            $job = new \App\Modules\Scraper\Jobs\ProcessScraperJob($source);
            $job->handle(
                app(\App\Modules\Scraper\Services\ScraperAdapterFactory::class),
                app(\App\Modules\Scraper\Services\ChangeDetector::class),
                app(\App\Modules\Scraper\Services\ConfidenceScorer::class),
            );
            $this->info('Done.');
        } catch (\Throwable $e) {
            $this->error("Failed: {$e->getMessage()}");
            return 1;
        }

        return 0;
    }
}
