<?php

namespace App\Modules\Taxonomy\Models;

use Illuminate\Database\Eloquent\Model;

class InstituteType extends Model
{
    protected $fillable = ['uuid', 'name', 'slug', 'description', 'icon', 'sort_order', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
