<?php

namespace App\Modules\Institute\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstituteContact extends Model
{
    protected $fillable = [
        'uuid', 'institute_id', 'contact_type', 'contact_value',
        'label', 'is_primary', 'is_public', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
            'is_public' => 'boolean',
        ];
    }

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }
}
