<?php

namespace App\Modules\Institute\Actions;

use App\Modules\Institute\Events\InstitutePublished;
use App\Modules\Institute\Models\Institute;

class PublishInstituteAction
{
    public function execute(Institute $institute): Institute
    {
        $institute->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        $institute->searchable();

        event(new InstitutePublished($institute));

        return $institute;
    }
}
