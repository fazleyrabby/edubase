<?php

namespace App\Modules\Search\Services;

use App\Modules\Institute\Models\Institute;
use Laravel\Scout\Builder;

class SearchService
{
    public function search(string $query, array $filters = [], int $perPage = 20): Builder
    {
        $search = Institute::search($query);

        foreach ($filters as $field => $value) {
            if ($value !== null && $value !== '') {
                $search->where($field, $value);
            }
        }

        return $search;
    }

    public function autocomplete(string $query, int $limit = 8): array
    {
        return Institute::search($query)
            ->take($limit)
            ->get()
            ->map(fn (Institute $institute) => [
                'uuid' => $institute->uuid,
                'name' => $institute->name,
                'slug' => $institute->slug,
                'type' => $institute->type?->name,
                'district' => $institute->district?->name,
                'fee' => $institute->estimated_monthly_fee,
                'logo_url' => $institute->logo_url,
            ])
            ->toArray();
    }
}
