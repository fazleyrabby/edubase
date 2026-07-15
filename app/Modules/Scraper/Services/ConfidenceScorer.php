<?php

namespace App\Modules\Scraper\Services;

class ConfidenceScorer
{
    public function score(
        string $trustLevel,
        array $normalizedData,
        int $validationErrors = 0,
    ): float {
        $score = 0.0;

        $score += match ($trustLevel) {
            'trusted' => 0.80,
            'review_required' => 0.50,
            'untrusted' => 0.20,
            default => 0.30,
        };

        $score += $this->completenessBonus($normalizedData);

        $score += $this->structureBonus($normalizedData);

        $score -= $validationErrors * 0.05;

        return round(max(0.0, min(1.0, $score)), 2);
    }

    private function completenessBonus(array $data): float
    {
        if (empty($data)) {
            return 0.0;
        }

        $keysWithValues = 0;
        $totalKeys = 0;

        array_walk_recursive($data, function ($v) use (&$keysWithValues, &$totalKeys) {
            $totalKeys++;
            if ($v !== null && $v !== '' && $v !== []) {
                $keysWithValues++;
            }
        });

        if ($totalKeys === 0) {
            return 0.0;
        }

        return ($keysWithValues / $totalKeys) * 0.30;
    }

    private function structureBonus(array $data): float
    {
        $expectedKeys = ['amount', 'frequency', 'fee_type', 'academic_session'];
        $found = count(array_intersect_key(array_flip($expectedKeys), $data));

        return ($found / count($expectedKeys)) * 0.10;
    }
}
