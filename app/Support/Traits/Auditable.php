<?php

namespace App\Support\Traits;

use App\Modules\Audit\Models\AuditLog;
use App\Modules\Audit\Services\AuditService;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Auditable
{
    protected static function bootAuditable(): void
    {
        static::created(function ($model) {
            app(AuditService::class)->logCreate($model, $model->auditTags ?? null);
        });

        static::updated(function ($model) {
            if ($model->isClean()) {
                return;
            }
            app(AuditService::class)->logUpdate($model, $model->getOriginal(), $model->auditTags ?? null);
        });

        static::deleted(function ($model) {
            app(AuditService::class)->logDelete($model, $model->auditTags ?? null);
        });
    }

    public function auditLogs(): MorphMany
    {
        return $this->morphMany(AuditLog::class, 'auditable');
    }
}
