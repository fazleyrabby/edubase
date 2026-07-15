<?php

namespace App\Modules\Location\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = [
        'uuid', 'name', 'slug', 'code', 'currency_code',
        'phone_code', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function divisions(): HasMany
    {
        return $this->hasMany(Division::class);
    }
}
