<?php

namespace App\Modules\Taxonomy\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['uuid', 'name', 'slug', 'subject_group', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
