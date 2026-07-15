<?php

namespace App\Modules\Scraper\Services;

use App\Modules\Scraper\Contracts\ScraperAdapterInterface;
use App\Modules\Scraper\Models\ScraperSource;
use InvalidArgumentException;

class ScraperAdapterFactory
{
    private array $resolved = [];

    public function make(ScraperSource $source): ScraperAdapterInterface
    {
        $class = $source->adapter_class;

        if (! class_exists($class)) {
            throw new InvalidArgumentException("Adapter class [{$class}] not found.");
        }

        if (! isset($this->resolved[$class])) {
            $instance = app($class);

            if (! $instance instanceof ScraperAdapterInterface) {
                throw new InvalidArgumentException(
                    "Adapter [{$class}] must implement ScraperAdapterInterface."
                );
            }

            $this->resolved[$class] = $instance;
        }

        return $this->resolved[$class];
    }
}
