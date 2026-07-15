<?php

namespace App\Modules\Taxonomy\Models;

use Illuminate\Database\Eloquent\Model;

class EducationBoard extends Model
{
    protected $fillable = ['uuid', 'name', 'slug', 'short_name', 'website', 'description', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
