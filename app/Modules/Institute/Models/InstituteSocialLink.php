<?php

namespace App\Modules\Institute\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstituteSocialLink extends Model
{
    protected $fillable = [
        'uuid', 'institute_id', 'platform', 'url',
        'label', 'is_public', 'sort_order',
    ];

    protected function casts(): array
    {
        return ['is_public' => 'boolean'];
    }

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }
}
