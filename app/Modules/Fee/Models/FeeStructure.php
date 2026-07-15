<?php

namespace App\Modules\Fee\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeStructure extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid', 'institute_id', 'fee_type_id', 'academic_session',
        'amount', 'currency', 'frequency', 'unit_label', 'is_negotiable',
        'grade_range_start', 'grade_range_end',
        'verification_status', 'moderation_status', 'confidence_score',
        'verified_by', 'verified_at', 'source_url', 'source_type', 'source_notes',
        'is_published', 'published_at', 'scraper_run_id',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'is_negotiable' => 'boolean',
            'is_published' => 'boolean',
            'confidence_score' => 'decimal:2',
            'published_at' => 'datetime',
            'verified_at' => 'datetime',
        ];
    }
}
