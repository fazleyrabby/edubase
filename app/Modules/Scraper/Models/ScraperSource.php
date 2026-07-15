<?php

namespace App\Modules\Scraper\Models;

use Illuminate\Database\Eloquent\Model;

class ScraperSource extends Model
{
    protected $fillable = [
        'uuid', 'institute_id', 'name', 'source_type', 'adapter_class',
        'base_url', 'config', 'trust_level', 'schedule_frequency',
        'last_successful_run_at', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'config' => 'json',
            'is_active' => 'boolean',
            'last_successful_run_at' => 'datetime',
        ];
    }
}
