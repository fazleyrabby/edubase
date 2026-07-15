<?php

namespace App\Modules\Scraper\Events;

use App\Modules\Scraper\Models\ScraperRun;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScraperRunCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public ScraperRun $run,
    ) {}
}
