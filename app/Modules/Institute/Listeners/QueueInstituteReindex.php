<?php

namespace App\Modules\Institute\Listeners;

use App\Modules\Institute\Events\InstituteCreated;
use App\Modules\Institute\Events\InstitutePublished;
use App\Modules\Institute\Events\InstituteUpdated;

class QueueInstituteReindex
{
    public function handle(InstituteCreated|InstituteUpdated|InstitutePublished $event): void
    {
        $event->institute->searchable();
    }
}
