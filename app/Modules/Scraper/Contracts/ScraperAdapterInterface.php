<?php

namespace App\Modules\Scraper\Contracts;

use App\Modules\Scraper\Models\ScraperSource;

interface ScraperAdapterInterface
{
    public function fetch(ScraperSource $source): string;

    public function parse(string $rawContent, ScraperSource $source): array;

    public function normalize(array $parsedData, ScraperSource $source): array;

    public function getConfidence(array $normalizedData): float;
}
