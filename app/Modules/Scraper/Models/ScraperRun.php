<?php

namespace App\Modules\Scraper\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScraperRun extends Model
{
    protected $fillable = [
        'uuid', 'scraper_source_id', 'status',
        'started_at', 'finished_at',
        'items_processed', 'items_changed', 'items_failed',
        'error_message', 'raw_payload',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
            'items_processed' => 'integer',
            'items_changed' => 'integer',
            'items_failed' => 'integer',
        ];
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(ScraperSource::class, 'scraper_source_id');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(ScraperLog::class);
    }
}
