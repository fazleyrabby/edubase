<?php

namespace App\Modules\Institute\Services;

use App\Modules\Institute\Actions\ArchiveInstituteAction;
use App\Modules\Institute\Actions\CreateInstituteAction;
use App\Modules\Institute\Actions\PublishInstituteAction;
use App\Modules\Institute\Actions\UpdateInstituteAction;
use App\Modules\Institute\DTOs\InstituteData;
use App\Modules\Institute\Models\Institute;

class InstituteService
{
    public function __construct(
        private CreateInstituteAction $createAction,
        private UpdateInstituteAction $updateAction,
        private PublishInstituteAction $publishAction,
        private ArchiveInstituteAction $archiveAction,
    ) {}

    public function create(InstituteData $data): Institute
    {
        return $this->createAction->execute($data);
    }

    public function update(Institute $institute, InstituteData $data): Institute
    {
        return $this->updateAction->execute($institute, $data);
    }

    public function publish(Institute $institute): Institute
    {
        return $this->publishAction->execute($institute);
    }

    public function archive(Institute $institute): Institute
    {
        return $this->archiveAction->execute($institute);
    }
}
