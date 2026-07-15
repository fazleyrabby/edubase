<?php

namespace App\Modules\Media\Models;

use Illuminate\Database\Eloquent\Model;

class InstituteMedia extends Model
{
    protected $fillable = [
        'uuid', 'institute_id', 'media_type',
        'file_path', 'file_name', 'file_size', 'mime_type', 'disk',
        'title', 'alt_text', 'caption',
        'sort_order', 'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'file_size' => 'integer',
        ];
    }
}
