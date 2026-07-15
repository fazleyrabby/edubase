<?php

namespace App\Modules\Scraper\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScraperLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'scraper_run_id', 'log_level', 'message', 'context', 'created_at',
    ];

    protected function casts(): array
    {
        return [
            'context' => 'json',
            'created_at' => 'datetime',
        ];
    }

    public function run(): BelongsTo
    {
        return $this->belongsTo(ScraperRun::class, 'scraper_run_id');
    }
}
