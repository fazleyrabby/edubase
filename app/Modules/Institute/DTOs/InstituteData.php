<?php

namespace App\Modules\Institute\DTOs;

class InstituteData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $shortName,
        public readonly string $slug,
        public readonly int $instituteTypeId,
        public readonly int $countryId,
        public readonly int $divisionId,
        public readonly int $districtId,
        public readonly ?int $upazilaId,
        public readonly ?int $areaId,
        public readonly ?int $establishedYear,
        public readonly ?string $description,
        public readonly ?string $instituteCode,
        public readonly ?int $primaryCategoryId,
        public readonly ?string $religiousOrientation,
        public readonly ?string $methodology,
        public readonly string $gender,
        public readonly ?string $fullAddress,
        public readonly ?string $postalCode,
        public readonly ?float $latitude,
        public readonly ?float $longitude,
        public readonly ?string $googleMapsUrl,
        public readonly ?string $nearbyLandmark,
        public readonly string $status,
        public readonly array $categoryIds,
        public readonly array $curriculumIds,
        public readonly array $boardIds,
        public readonly array $programIds,
        public readonly array $facilityIds,
        public readonly array $languageIds,
    ) {}
}
