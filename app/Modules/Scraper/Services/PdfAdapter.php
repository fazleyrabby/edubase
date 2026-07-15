<?php

namespace App\Modules\Scraper\Services;

use App\Modules\Scraper\Contracts\ScraperAdapterInterface;
use App\Modules\Scraper\Models\ScraperSource;
use Illuminate\Support\Facades\Http;
use Smalot\PdfParser\Parser as PdfParser;

class PdfAdapter implements ScraperAdapterInterface
{
    public function fetch(ScraperSource $source): string
    {
        $config = $source->config ?? [];
        $timeout = $config['timeout'] ?? 60;

        $response = Http::timeout($timeout)
            ->withHeaders(['User-Agent' => 'Mozilla/5.0 (compatible; ILMATLAS-Bot/1.0)'])
            ->get($source->base_url);

        $response->throw();

        return $response->body();
    }

    public function parse(string $rawContent, ScraperSource $source): array
    {
        $parser = new PdfParser;
        $pdf = $parser->parseContent($rawContent);
        $text = $pdf->getText();

        $data = [];
        $config = $source->config ?? [];
        $patterns = $config['regex_patterns'] ?? [];

        foreach ($patterns as $field => $pattern) {
            if (preg_match($pattern, $text, $matches)) {
                $data[$field] = trim($matches[1] ?? $matches[0]);
            }
        }

        if (empty($patterns)) {
            $data['raw_text'] = $text;
        }

        return $data;
    }

    public function normalize(array $parsedData, ScraperSource $source): array
    {
        $mapping = $source->config['field_mapping'] ?? [];
        $normalized = [];

        foreach ($parsedData as $key => $value) {
            $targetKey = $mapping[$key] ?? $key;

            if (is_string($value)) {
                $value = preg_replace('/[^\d,.-]/', '', $value);
                $value = str_replace(',', '', $value);
            }

            $normalized[$targetKey] = $value;
        }

        return $normalized;
    }

    public function getConfidence(array $normalizedData): float
    {
        return app(ConfidenceScorer::class)->score(
            trustLevel: 'review_required',
            normalizedData: $normalizedData,
        );
    }
}
