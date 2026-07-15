<?php

namespace App\Modules\Taxonomy\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FacilityGroup extends Model
{
    protected $fillable = ['uuid', 'name', 'slug', 'icon', 'sort_order', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function facilities(): HasMany
    {
        return $this->hasMany(Facility::class);
    }
}
