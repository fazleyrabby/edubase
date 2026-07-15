<?php

namespace App\Modules\Institute\Events;

use App\Modules\Institute\Models\Institute;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InstituteArchived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Institute $institute,
    ) {}
}
