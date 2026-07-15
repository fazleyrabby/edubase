<?php

namespace App\Modules\Institute\Actions;

use App\Modules\Institute\Events\InstituteArchived;
use App\Modules\Institute\Models\Institute;

class ArchiveInstituteAction
{
    public function execute(Institute $institute): Institute
    {
        $institute->update([
            'status' => 'archived',
        ]);

        $institute->unsearchable();

        event(new InstituteArchived($institute));

        return $institute;
    }
}
