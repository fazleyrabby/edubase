<?php

namespace App\Modules\Institute\Listeners;

use App\Modules\Institute\Events\InstituteArchived;
use App\Modules\Institute\Events\InstituteUpdated;
use Illuminate\Support\Facades\Cache;

class ClearInstituteCache
{
    public function handle(InstituteUpdated|InstituteArchived $event): void
    {
        Cache::forget("institute:{$event->institute->uuid}");
        Cache::forget("institute:{$event->institute->id}");
    }
}
