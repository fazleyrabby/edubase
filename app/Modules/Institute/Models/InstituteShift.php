<?php

namespace App\Modules\Institute\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstituteShift extends Model
{
    protected $fillable = [
        'uuid', 'institute_id', 'shift_name',
        'time_start', 'time_end', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'time_start' => 'string',
            'time_end' => 'string',
        ];
    }

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }
}
