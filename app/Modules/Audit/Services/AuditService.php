<?php

namespace App\Modules\Audit\Services;

use App\Modules\Audit\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditService
{
    public function log(
        string $event,
        Model $auditable,
        ?array $oldValues = null,
        ?array $newValues = null,
        ?string $tags = null,
    ): void {
        AuditLog::create([
            'user_id' => Auth::id(),
            'event' => $event,
            'auditable_type' => $auditable->getMorphClass(),
            'auditable_id' => $auditable->getKey(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'tags' => $tags,
        ]);
    }

    public function logCreate(Model $auditable, ?string $tags = null): void
    {
        $this->log('created', $auditable, null, $auditable->toArray(), $tags);
    }

    public function logUpdate(Model $auditable, array $original, ?string $tags = null): void
    {
        $this->log('updated', $auditable, $original, $auditable->getChanges(), $tags);
    }

    public function logDelete(Model $auditable, ?string $tags = null): void
    {
        $this->log('deleted', $auditable, $auditable->toArray(), null, $tags);
    }
}
