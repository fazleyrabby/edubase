<?php

namespace App\Modules\SEO\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoMetadata extends Model
{
    protected $fillable = [
        'uuid', 'seoable_type', 'seoable_id', 'route_name',
        'meta_title', 'meta_description', 'meta_keywords',
        'og_title', 'og_description', 'og_image', 'og_type',
        'twitter_card', 'canonical_url',
        'noindex', 'nofollow', 'schema_type',
    ];

    protected function casts(): array
    {
        return [
            'noindex' => 'boolean',
            'nofollow' => 'boolean',
        ];
    }

    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}
